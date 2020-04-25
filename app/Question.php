<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }


}
