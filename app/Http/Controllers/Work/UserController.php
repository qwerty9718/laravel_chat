<?php

namespace App\Http\Controllers\Work;

use App\Http\Controllers\Controller;
use App\Http\Requests\Work\UserImageRequest;
use App\Http\Requests\Work\UserRequest;
use App\Models\User;
use App\Models\UserImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function updateUser(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id']);


        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'surname' => $data['surname'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'city' => $data['city'],
        ]);

    }


    public function uploadImg(UserImageRequest $request){
        $data = $request->validated();
        $image = $data['avatar'];

        $user = User::find($data['user_id']);
        $current_image = $user->images;
        if (count($current_image) > 0){
            foreach ($current_image as $del_image){
                Storage::disk('public')->delete($del_image->path);
                $del_image->delete($del_image);
            }
        }


        $name = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
        $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);
        $user_image =  UserImage::create([
            'path' => $filePath,
            'url' => url('/storage/' . $filePath),
            'user_id' => $data['user_id']
        ]);

        $user->update([
            'avatar_url' => $user_image['url']
        ]);

        return $user_image['url'];
    }


    public function getUserImage($id){
        $user = User::find($id);
        $image = $user->images;
        return $image[0];
    }


}
