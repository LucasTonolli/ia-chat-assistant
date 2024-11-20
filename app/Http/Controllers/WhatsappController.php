<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewUserNotification;
use App\Services\ConversationalService;
use App\Services\StripeService;
use App\Services\UserService;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function __construct(protected UserService $userService, protected StripeService $stripeService, protected ConversationalService $conversionalService) {}
    public function new_message(Request $request)
    {
        $phone = "+" . $request->post('WaId');
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            $user = $this->userService->store($request->all());
        }

        if (!$user->subscribed()) {
            $this->stripeService->payment($user);
        }

        $user->last_whatsapp_at = now();
        $user->save();


        $this->conversionalService->setUser($user);
        $this->conversionalService->handleIncomingMessage($request->all());
    }
}
