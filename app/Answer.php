<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Answer extends Model
{
    //protected $primaryKey = 'id';
    protected $table = 'answers';

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
