<?php
namespace App\Services;

use App\Models\Book;
use Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserService{
public function getUser(){

    $users=User::all();
    return $users;
}
/**
 * createUser
 * @param array $data
 * @return TModel
 */
public function createUser(array $data){
    $user=User::create([
        'name'=> $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'is_admin' => $data['is_admin'] ?? false,

    ]);
    return $user;
    //Log::info('Book created successfully:', ['book' => $book]);
}
/**
 * deletUser
 * @param User $user
 * @return User
 */
public function deletUser(User $user)
{
    $user->delete();
    return $user;
}
/**
 * updateUser
 * @param mixed $id
 * @param array $data
 * @return TModel|\Illuminate\Database\Eloquent\Collection|null
 */
public function updateUser($id, array $data)
{
    $user = User::find($id);

    if ($user) {
        $user->update([
            'name' => $data['name'] ?? $user->name,
                'email' => $data['email'] ?? $user->email,
                'password' => isset($data['password']) ? bcrypt($data['password']) : $user->password,
                'is_admin' => $data['is_admin'] ?? $user->is_admin,

        ]);
        return $user; 
    }

    return null; 
}

}