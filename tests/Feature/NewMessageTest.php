<?php

use App\Models\Task;
use App\Models\User;
use App\Notifications\GenericNotification;
use App\Notifications\MenuNotification;
use App\Notifications\NewUserNotification;
use App\Notifications\ScheduleListNotification;
use App\Services\ConversationalService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Notification;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;
use Twilio\Security\RequestValidator;

function generateTwilioSignature($url, $data)
{
  $validator = new RequestValidator(config('twilio.auth_token'));

  return $validator->computeSignature($url, $data);
}

test('new message creates user if not exists', function () {
  $phone = "82984175026";
  $profileName = fake()->name();

  $request = [
    'From' => 'whatsapp:+' . $phone,
    'ProfileName' => $profileName,
    'Body' => 'Hello',
    'WaId' => $phone,
    'To' =>  str_replace('+', '', config('twilio.from'))
  ];

  logger('Request: ', [
    'request' => $request,
  ]);

  $signature = generateTwilioSignature(config('twilio.new_message_url'), $request);
  $response  = $this->withHeaders([
    'X-Twilio-Signature' => $signature,
  ])->postJson('/api/new_message', $request);

  $response->assertStatus(200);
  $this->assertDatabaseHas('users', [
    'phone' => '+' . $phone,
    'name' => $profileName
  ]);
});


test('Unsubscribed user gets payment link', function () {
  $user = User::factory()->create();
  Notification::fake();
  $request = [
    'From' => 'whatsapp:' .   $user->phone,
    'ProfileName' => $user->name,
    'Body' => 'Hello',
    'WaId' => str_replace('+', '', $user->phone),
    'To' => config('twilio.from')
  ];

  $signature = generateTwilioSignature(config('twilio.new_message_url'), $request);
  $response  = $this->withHeaders([
    'X-Twilio-Signature' => $signature,
  ])->postJson('/api/new_message', $request);

  $response->assertStatus(200);
  Notification::assertSentTo($user, NewUserNotification::class);
});

test('handle menu command', function () {
  Notification::fake();
  $user = User::factory()->create();

  $service = new ConversationalService();
  $service->setUser($user);
  $service->handleIncomingMessage([
    'Body' => '!menu'
  ]);
  Notification::assertSentTo($user, MenuNotification::class);
});

test('handle agenda command', function () {
  Notification::fake();
  $user = User::factory()->create();

  $service = new ConversationalService();
  $service->setUser($user);
  $service->handleIncomingMessage([
    'Body' => '!agenda'
  ]);
  Notification::assertSentTo($user, ScheduleListNotification::class);
});

test('handle insights command', function () {
  Notification::fake();
  $user = User::factory()->create();
  $task = Task::factory()->create([
    'user_id' => $user->id,
    'due_at' => now()->addDays(2)
  ]);

  $service = new ConversationalService();
  $service->setUser($user);
  $service->handleIncomingMessage([
    'Body' => '!insights'
  ]);
  Notification::assertSentTo($user, GenericNotification::class);
});

test('create tasks successfully', function () {
  $user = User::factory()->create();
  $service = new ConversationalService();
  $service->setUser($user);
  $task = [
    'description' => fake()->text(),
    'due_at' => fake()->dateTime(),
    'meta' => fake()->text(),
    'reminder_at' => fake()->dateTime(),
    'additional_info' => fake()->text(),
  ];

  $task = $service->createUserTask(...$task);

  $this->assertDatabaseHas('tasks', [
    'id' => $task->id,
    'user_id' => $user->id
  ]);
});

test('updates tasks successfully', function () {
  $user = User::factory()->create();
  $service = new ConversationalService();
  $service->setUser($user);

  $task = Task::factory()->create([
    'user_id' => $user->id,
    'description' => 'Antes',
    'due_at' => now()->addDays(2)
  ]);

  $updateData = [
    'taskid' => $task->id,
    'description' => 'Depois',
  ];

  $service->updateUserTask(...$updateData);

  $this->assertDatabaseHas('tasks', [
    'id' => $task->id,
    'user_id' => $user->id,
    'description' => $updateData['description']
  ]);

  $this->assertDatabaseMissing('tasks', [
    'id' => $task->id,
    'user_id' => $user->id,
    'description' => 'Antes'
  ]);
});
