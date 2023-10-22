<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository {

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll() {
        return $this->user
            ->where('role', 'User')
            ->select('id', 'name', 'email')
            ->paginate(Helper::COUNT_PER_PAGE);
    }

    public function getById($id) {
        return $this->user->where('role', 'User')->find($id);
    }

    public function store($data) {

        $user           = new $this->user;
        $user->name     = $data['name'];
        $user->email    = $data['email'];
        $user->password = Hash::make($data['password_confirmation']);
        $user->save();

        return $user;
    }

    public function update($data, $id) {

        $user           =  $this->user->where('role', 'User')->find($id);
        $user->name     = $data['name'];
        $user->email    = $data['email'];
        $user->save();

        return $user;
    }

    public function destroy($id) {

        $user  =  $this->user->where('role', 'User')->find($id);
        if($user)
            $user->delete();
        return $user;
    }

    public function getUsersForDropDown() {
        if(auth()->user()->role == 'Admin') {
            return $this->user->where('role', 'User')->select('id', 'name')->get();
        }

        return [];
    }
}