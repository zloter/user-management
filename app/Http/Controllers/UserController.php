<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\Request;
use \App\Http\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserCollection::collection(User::paginate());
    }

    /**
     * @param int $id
     * @return UserResource
     */
    public function get(int $id): UserResource
    {
        return new UserResource(User::find($id));
    }

    /**
     * @param UserRequest $request
     * @return false|string
     */
    public function create(UserRequest $request)
    {
        $user = User::create($request);
        if ($request->is_lecturer) {
            $user->lecturer()->create($request);
        }
        if ($request->is_employee) {
            $user->employee()->create($request);
        }

        return json_encode([
            'status' => 200,
            'message' => "Successfully created user!"
        ]);
    }

    /**
     * @param User $user
     * @param UserRequest $request
     * @return false|string
     */
    public function update(User $user, UserRequest $request)
    {
        $user = User::create($request);
        if ($request->is_lecturer) {
            $user->lecturer()->exists() ? $user->lecturer()->update($request) : $user->lecturer()->create($request);
        } else {
            $user->lecturer()->delete();
        }
        if ($request->is_employee) {
            $user->employee()->exists() ? $user->employee()->update($request) : $user->employee()->create($request);
        } else {
            $user->employee()->delete($request);
        }
        return json_encode([
            'status' => 200,
            'message' => "Successfully created user!"
        ]);
    }

    /**
     * @param User $user
     * @return false|string
     * @throws \Exception
     */
    public function delete(User $user)
    {
        $user->delete();
        return json_encode([
            'status' => 200,
            'message' => "Successfully deleted user!"
        ]);
    }
}
