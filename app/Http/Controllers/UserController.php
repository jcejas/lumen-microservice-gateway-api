<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get All
     *
     * @return void
     */
    public function index()
    {
        $users = User::all();
        return $this->validResponse($users->toArray());
    }

    /**
     * Create New user
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ])->validate();

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);
        
        $user = User::create($fields);

        return $this->validResponse($user->toArray(), Response::HTTP_CREATED);
    }

    /**
     * Get By user ID
     *
     * @param integer $user
     * @return void
     */
    public function show(int $user = 0)
    {
        $user = User::findOrFail($user);
        return $this->validResponse($user->toArray());
    }

    /**
     * Update user by ID
     *
     * @param Request $request
     * @param integer $user
     * @return void
     */
    public function update(Request $request, int $user)
    {
        Validator::make($request->all(), [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,' . $user,
            'password' => 'min:8|confirmed'
        ])->validate();

        $user = User::findOrFail($user);
        $user->fill($request->all());

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();

        return $this->validResponse($user->toArray());
    }

    /**
     * Delete user by ID
     *
     * @param integer $user
     * @return void
     */
    public function destroy(int $user)
    {
        $user = User::findOrFail($user);
        $user->delete();

        return $this->validResponse($user->toArray());
    }
}
