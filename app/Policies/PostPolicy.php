<?php
// php artisan make:policy PostPolicy --model=Post

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    public function before(User $user) {
        return $user->name === 'SUPER';
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return ($user->role === 'admin' || $user->id === $post->user_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        // pelo perfil
        // return ($user->role !== 'visitor');

        // pelas permissões
        // get information from database (v1)
        // return $user->permissions()->where('permission', 'create_post')->exists();
        // get information from database (v2)
        // foreach (Auth::user()->permissions as $permission) {
        //     if($permission['permission'] == 'created_post') {
        //         return true;
        //     }
        // }
        // return false;
        // get information from database (v3)
        // return $user->permissions->contains('permission', 'create_post');

        // Outras saidas
        if($user->permissions->contains('permission', 'create_post')){
            return Response::allow();
        } else {
            return Response::denyWithStatus(403, 'Você não tem permissão para criar');
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        // return $user->id === $post->user_id;
        return $user->permissions->contains('permission', 'update_post');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        // return $user->role === 'admin';
        return $user->permissions->contains('permission', 'delete_post');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }
}
