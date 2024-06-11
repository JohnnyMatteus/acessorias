<?php

namespace App\Http\Controllers\Api;

use App\Application\DTOs\UserDTO;
use App\Application\Inputs\UserInput;
use App\Application\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Helpers;

class UserController extends Controller
{
    protected $userService;
    protected $code;
    protected $message;
    protected $return;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAll();
        $this->return = UserResource::collection($users);
        $this->code = 200;
        $this->message = 'Users retrieved successfully.';

        return Helpers::collection($this->return, $this->code, $this->message);
    }

    public function show($id)
    {
        $user = $this->userService->findById($id);

        if (!$user) {
            $this->code = 404;
            $this->message = 'User not found.';
            $this->return = null;
        } else {
            $this->return = new UserResource($user);
            $this->code = 200;
            $this->message = 'User retrieved successfully.';
        }

        return Helpers::collection($this->return, $this->code, $this->message);
    }

    public function store(StoreUserRequest $request)
    {
        $input = new UserInput($request);
        $userDTO = new UserDTO(null, $input->name, $input->email, $input->password);
        $user = $this->userService->create($userDTO);
        $this->return = new UserResource($user);
        $this->code = 201;
        $this->message = 'User created successfully.';

        return Helpers::collection($this->return, $this->code, $this->message);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $input = new UserInput($request);
        $userDTO = new UserDTO($id, $input->name, $input->email, $input->password);
        $user = $this->userService->update($id, $userDTO);

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

    public function destroy($id)
    {
        $success = $this->userService->delete($id);

        if (!$success) {
            $this->code = 404;
            $this->message = 'User not found.';
            $this->return = null;
        } else {
            $this->code = 204;
            $this->message = 'User deleted successfully.';
            $this->return = null;
        }

        return Helpers::collection($this->return, $this->code, $this->message);
    }
}
