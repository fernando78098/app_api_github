<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository{

    /**
     * instantiate the model
     *
     * @return void
     */
    public function user()
    {
        $user = new User();
        return $user;
    }

    /**
     * return list users local
     *
     * @return void
     */
    public function getUserLocal()
    {
        $user = self::user();
        $user->get();
        return $user;
    }

    /**
     * write database user
     *
     * @param [object] $data
     * @return bolean
     */
    public function storeUser( $data )
    {
        $user = self::user()->create([
            'login' => $data->login,
            'data' => serialize($data),
        ]);
        return true;
    }
}