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
use OpenApi\Annotations as OA;

class UserController extends BaseController
{
    public function __construct(private UserService $userService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/v1/users",
     *      operationId="getUsersList",
     *      tags={"Users"},
     *      summary="Get list of users",
     *      description="Returns list of users",
     *      @OA\Parameter(
     *          name="page",
     *          description="page",
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
     *              example=1
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="count",
     *          description="count",
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
     *              example=6
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="users",
     *                  type="object",
     *                  description="Users objects",
     *                  @OA\Property(
     *                      format="integer",
     *                      description="id",
     *                      default="1",
     *                      property="id",
     *                  ),
     *                  @OA\Property(
     *                      format="string",
     *                      description="name",
     *                      default="Dr. Isabell Bartoletti",
     *                      property="name",
     *                  ),
     *                  @OA\Property(
     *                      format="string",
     *                      description="email",
     *                      default="lleuschke@example.org",
     *                      property="email",
     *                  ),
     *                 @OA\Property(
     *                      format="string",
     *                      description="phone",
     *                      default="1-586-986-4004",
     *                      property="phone",
     *                  ),
     *                 @OA\Property(
     *                      format="string",
     *                      description="position",
     *                      default="Content manager",
     *                      property="position",
     *                  ),
     *                  @OA\Property(
     *                      format="integer",
     *                      description="position_id",
     *                      default="3",
     *                      property="position_id",
     *                  ),
     *                  @OA\Property(
     *                      format="integer",
     *                      description="registration_timestamp",
     *                      default="1685273824",
     *                      property="registration_timestamp",
     *                  ),
     *                  @OA\Property(
     *                      format="string",
     *                      description="photo",
     *                      default="https://via.placeholder.com/640x480.png/0000cc?text=reiciendis",
     *                      property="photo",
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="links",
     *                  type="object",
     *                  description="Pagination links",
     *                  @OA\Property(
     *                      format="string",
     *                      description="first",
     *                      default="http://127.0.0.1:8000/api/v1/users?page=1",
     *                      property="first",
     *                  ),
     *                  @OA\Property(
     *                      format="string",
     *                      description="last",
     *                      default="http://127.0.0.1:8000/api/v1/users?page=9",
     *                      property="last",
     *                  ),
     *                  @OA\Property(
     *                      format="string",
     *                      description="prev",
     *                      default="http://127.0.0.1:8000/api/v1/users?page=9",
     *                      property="prev",
     *                  ),
     *                  @OA\Property(
     *                      format="string",
     *                      description="next",
     *                      default="http://127.0.0.1:8000/api/v1/users?page=9",
     *                      property="next",
     *                  ),
     *               ),
     *               @OA\Property(
     *                  property="meta",
     *                  type="object",
     *                  description="Pagination meta",
     *                  @OA\Property(
     *                      format="integer",
     *                      description="current_page",
     *                      default="1",
     *                      property="current_page",
     *                  ),
     *                  @OA\Property(
     *                      format="integer",
     *                      description="from",
     *                      default="1",
     *                      property="from",
     *                  ),
     *                  @OA\Property(
     *                      format="integer",
     *                      description="last_page",
     *                      default="9",
     *                      property="last_page",
     *                  ),
     *                  @OA\Property(
     *                  property="links",
     *                  type="object",
     *                  description="links",
     *                      @OA\Property(
     *                          format="string",
     *                          description="url",
     *                          default="http://127.0.0.1:8000/api/v1/users?page=1",
     *                          property="url",
     *                      ),
     *                      @OA\Property(
     *                          format="integer",
     *                          description="label",
     *                          default="1",
     *                          property="label",
     *                      ),
     *                      @OA\Property(
     *                          format="boolean",
     *                          description="active",
     *                          default="true",
     *                          property="active",
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      format="string",
     *                      description="path",
     *                      default="http://127.0.0.1:8000/api/v1/users",
     *                      property="path",
     *                  ),
     *                  @OA\Property(
     *                      format="integer",
     *                      description="per_page",
     *                      default="5",
     *                      property="per_page",
     *                  ),
     *                  @OA\Property(
     *                      format="integer",
     *                      description="to",
     *                      default="5",
     *                      property="to",
     *                  ),
     *                  @OA\Property(
     *                      format="integer",
     *                      description="total",
     *                      default="45",
     *                      property="total",
     *                  ),
     *               ),
     *              @OA\Property(
     *                      format="boolean",
     *                      description="success",
     *                      default="true",
     *                      property="success",
     *                  ),
     *          )
     *       ),
     *     )
     */
    public function index(ListUserRequest $request)
    {
        $validated = $request->validated();

        $users = User::query()->orderByDesc('registration_timestamp')->paginate($validated['count']);

        return new UserListCollection($users);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/users/{user}",
     *      operationId="getSingleUser",
     *      tags={"Users"},
     *      summary="Get single user",
     *      description="Get single user",
     *     @OA\Parameter(
     *          name="user",
     *          description="User id",
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              example=1
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  format="user",
     *                  type="object",
     *                  description="User objects",
     *                  property="user",
     *                  @OA\Property(
     *                      format="integer",
     *                      description="id",
     *                      default="1",
     *                      property="id",
     *                  ),
     *                  @OA\Property(
     *                      format="string",
     *                      description="name",
     *                      default="Dr. Isabell Bartoletti",
     *                      property="name",
     *                  ),
     *                  @OA\Property(
     *                      format="string",
     *                      description="email",
     *                      default="lleuschke@example.org",
     *                      property="email",
     *                  ),
     *                 @OA\Property(
     *                      format="string",
     *                      description="phone",
     *                      default="1-586-986-4004",
     *                      property="phone",
     *                  ),
     *                 @OA\Property(
     *                      format="string",
     *                      description="position",
     *                      default="Content manager",
     *                      property="position",
     *                  ),
     *                  @OA\Property(
     *                      format="integer",
     *                      description="position_id",
     *                      default="3",
     *                      property="position_id",
     *                  ),
     *                  @OA\Property(
     *                      format="integer",
     *                      description="registration_timestamp",
     *                      default="1685273824",
     *                      property="registration_timestamp",
     *                  ),
     *                  @OA\Property(
     *                      format="string",
     *                      description="photo",
     *                      default="https://via.placeholder.com/640x480.png/0000cc?text=reiciendis",
     *                      property="photo",
     *                  ),
     *              ),
     *              @OA\Property(
     *                      format="boolean",
     *                      description="success",
     *                      default="true",
     *                      property="success",
     *                  ),
     *          )
     *       ),
     *     )
     */
    public function show(User $user)
    {
        return UserResource::make($user);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/user",
     *      operationId="createUser",
     *      tags={"Users"},
     *      summary="Create user",
     *      description="Create user",
     *      @OA\Parameter(
     *         name="Token",
     *         in="header",
     *         description="Token",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\RequestBody(
     *      required=true,
     *      description="Create user parameters",
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="name", type="string", format="string",),
     *               @OA\Property(property="email", type="string", format="string",),
     *               @OA\Property(property="phone", type="string", format="string",),
     *               @OA\Property(property="position_id", type="integer", format="integer", description="id from positions list"),
     *              @OA\Property(property="photo", type="string", format="binary"),
     *            )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=200,
     *      description="Success response",
     *      @OA\JsonContent(
     *          @OA\Property(property="success", type="boolean", example="true"),
     *          @OA\Property(property="user_id", type="integer", example="46"),
     *          @OA\Property(property="message", type="string", example="New user successfully registered"),
     *      )
     *     ),
     * )
     *
     * )
     */
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
