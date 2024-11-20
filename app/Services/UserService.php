<?php

namespace App\Services;

use App\Models\User;

class UserService
{
  public function store($data)
  {
    return User::create([
      'name' => $data['ProfileName'],
      'phone' => '+' . $data['WaId'],
    ]);
  }
}
