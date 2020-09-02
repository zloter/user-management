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
     * @return UserCollection
     */
    public function index(): UserCollection
    {
        return new UserCollection(User::with('employee', 'lecturer')->paginate(25));
    }

    /**
     * @param User $user
     * @return UserResource
     */
    public function get(User $user): UserResource
    {
        return new UserResource(User::with(['employee', 'lecturer'])->find($user->id));
    }

    /**
     * @param UserRequest $request
     * @return false|string
     */
    public function create(UserRequest $request)
    {
        $params = $request->all();
        $user = User::create($params);
        if (!empty($params['is_lecturer'])) {
            $user->lecturer()->create($params);
        }
        if (!empty($params['is_employee'])) {
            $user->employee()->create($params);
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
        $params = $request->all();
        $user->update($params);
        if (!empty($params['is_lecturer'])) {
            $user->lecturer()->exists() ? $user->lecturer()->first()->update($params) : $user->lecturer()->create($params);
        } else {
            $user->lecturer()->delete();
        }
        if (!empty($params['is_employee'])) {
            $user->employee()->exists() ? $user->employee()->first()->update($params) : $user->employee()->create($params);
        } else {
            $user->employee()->delete($request);
        }
        return json_encode([
            'status' => 200,
            'message' => "Successfully updated user!"
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
