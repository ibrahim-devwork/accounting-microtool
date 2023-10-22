<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() {
        try {
            $users = $this->userRepository->getAll();
            return view('users.users', compact('users'));

        } catch(\Exception $error) {
            Log::error('UserController - (index) : ' . $error->getMessage());
        }
    }

    public function create() {
        try {

            $user = null;
            return view('users.createOrEditUser', compact('user'));

        } catch(\Exception $error) {
            Log::error('UserController - (create) : ' . $error->getMessage());
        }      
    }

    public function edit($id)
    {
        try {

            $user  = $this->userRepository->getById($id);
            return view('users.createOrEditUser', compact('user'));

        } catch(\Exception $error) {
            Log::error('UserController - (edit) : ' . $error->getMessage());
        }        
    }

    public function store(UserRequest $request) {
        try {

            $data  = $request->validated();
            $this->userRepository->store($data);
            return redirect()->route('users.create')->with('success', 'User created successfully');

        } catch(\Exception $error) {
            Log::error('UserController - (store) : ' . $error->getMessage());
        }
    }

    public function update(UserRequest $request, $id) {
        try {

            $data  = $request->validated();
            $this->userRepository->update($data, $id);
            return redirect()->route('users')->with('success', 'User updated successfully');

        } catch(\Exception $error) {
            Log::error('UserController - (update) : ' . $error->getMessage());
        }
    }

    public function destroy($id) {
        try {

            $this->userRepository->destroy($id);
            return redirect()->route('users')->with('success', 'User deleted successfully');

        } catch(\Exception $error) {
            Log::error('UserController - (destroy) : ' . $error->getMessage());
        }
    }

}   