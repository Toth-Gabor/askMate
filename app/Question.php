<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'questions';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'message', 'image'
    ];

    /**
     * @return HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }


}
