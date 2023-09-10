<?php

namespace App\Http\Controllers\Work;

use App\Http\Controllers\Controller;
use App\Http\Requests\Work\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateUser(UserRequest $request){
        $data = $request->validated();
        $user = User::find($data['id']);

        $user->update([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'surname'=>$data['surname'],
            'phone'=>$data['phone'],
            'country'=>$data['country'],
            'city'=>$data['city'],
            ]);

    }
}
