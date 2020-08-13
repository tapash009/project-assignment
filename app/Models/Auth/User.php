<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Relationship\UserRelationship;
use App\Models\Auth\Traits\Scope\UserScope;

/**
 * Class User.
 */
class User extends BaseUser
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;


    /**
     * Get User address information
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_address(){
        return $this->hasOne('App\Models\Auth\UserAddress', 'user_id', 'id');
    }
}
