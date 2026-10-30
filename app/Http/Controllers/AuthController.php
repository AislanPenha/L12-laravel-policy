<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    //
    public function login_user(int $id): RedirectResponse
    {
        // $user = User::findOrFail($id);
        $user = User::with('permissions')->findOrFail($id);
        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function update(int $id)
    {
        // update post
        $post = Post::findOrFail($id);

        // verify if the user is allowed to update the post
        if(Gate::denies('update', $post)) {
            abort(403,'Você não tem permissão para atulizar o post.');
        } else {
            echo 'Atualizando...';
        }
    }

    public function delete(int $id)
    {
        // delete post
        $post = Post::findOrFail($id);

        // verify if the user is allowed to delete the post
        if(Gate::denies('delete', $post)) {
            abort(403,'Você não tem permissão para deletar o post.');
        } else {
            echo 'Deletando...';
        }
    }

    public function create()
    {
        // verify if the user is allowed to create the post
        // if(Gate::denies('create', Post::class)) {
        //     abort(403,'Você não tem permissão para criar o post.');
        // } else {
        //     echo 'Criando...';
        // }

        $response = Gate::inspect('create', Post::class);
        // if($response->allowed()) {
        //     echo "Criando...";
        // } else {
        //     echo $response->message();
        // }
        if($response->allowed()) {
            echo "Criando...";
        } else {
            if($response->status() === 403){
                abort(403, $response->message());
            }
        }
    }
}
