<?php

namespace App\Application\Inputs;

use Illuminate\Http\Request;

class UserInput
{
    public $name;
    public $email;
    public $password;

    public function __construct(Request $request)
    {
        $this->name = $request->input('name');
        $this->email = $request->input('email');
        $this->password = $request->input('password');
    }
}
