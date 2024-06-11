<?php

namespace App\Http\Controllers\Api;

use App\Application\DTOs\UserDTO;
use App\Application\Inputs\UserInput;
use App\Application\Services\UserService;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Helpers;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    protected $userService;
    protected $code;
    protected $message;
    protected $return;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function login(Request $request)
    {
        $this->return = $this->userService->authenticate($request->email, $request->password);
        $this->code = 200;
        $this->message = 'Users retrieved successfully.';

        return Helpers::collection($this->return, $this->code, $this->message);
    }
    public function register(StoreUserRequest $request)
    {
        $input = new UserInput($request);
        $userDTO = new UserDTO(null, $input->name, $input->email, $input->password);
        $user = $this->userService->create($userDTO);
        $this->return = new UserResource($user);
        $this->code = 201;
        $this->message = 'User created successfully.';

        return Helpers::collection($this->return, $this->code, $this->message);
    }
    public function forgotPassword(Request $request)
    {
        $this->return = $this->userService->forgotPassword($request->email);
        $this->code = 200;
        $this->message = '';

        return Helpers::collection($this->return, $this->code, $this->message);
    }
    public function registerNewPassword(ResetPasswordRequest $request)
    {
        $user = $this->userService->updatePassword($request->email, $request->password);

        if (!$user) {
            $this->code = 404;
            $this->message = 'User not found.';
            $this->return = null;
        }
        else {
            $this->return = new UserResource($user);
            $this->code = 200;
            $this->message = 'User updated successfully.';
        }

        return Helpers::collection($this->return, $this->code, $this->message);
    }
    public function logOut(Request $request)
    {
        $this->return = $this->userService->logOut($request->email);
        $this->code = 200;
        $this->message = '';

        return Helpers::collection($this->return, $this->code, $this->message);
    }

}
