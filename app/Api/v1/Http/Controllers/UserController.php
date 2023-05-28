<?php

declare(strict_types=1);

namespace App\Api\v1\Http\Controllers;

use App\Api\v1\DTO\CreateUser;
use App\Api\v1\Http\Collections\UserListCollection;
use App\Api\v1\Http\Requests\CreateUserRequest;
use App\Api\v1\Http\Requests\ListUserRequest;
use App\Api\v1\Http\Resources\UserResource;
use App\Api\v1\Services\UserService;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    public function __construct(private UserService $userService)
    {
    }


    public function index(ListUserRequest $request)
    {
        $validated = $request->validated();

        $users = User::query()->orderByDesc('registration_timestamp')->paginate($validated['count']);

        return new UserListCollection($users);
    }

    public function show(User $user)
    {
        return UserResource::make($user);
    }

    public function store(CreateUserRequest $request)
    {
        DB::beginTransaction();

        try {
            $userData = CreateUser::fromRequest($request);

            $user = $this->userService
                ->markTokenAsUsed($userData->token)
                ->prepareUserData($userData)
                ->save();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->errorInternalError($e->getMessage());
        }

        DB::commit();

        return $this->respondWithArray([
            'success' => true,
            'user_id' => $user->id,
            'message' => 'New user successfully registered'
        ]);
    }
}
