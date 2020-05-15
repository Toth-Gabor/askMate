<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class Tag extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tags';


    /**
     * @return Builder
     */
    public function getDistinctTags()
    {
        return DB::table('tags')
            ->distinct('name');
    }

    public function create(Request $request)
    {
        $questionId = $request->id;
        $tagName = $request->name;
        //DB::table('tags')->insert('name', $tagName);

    }

    public function isExist($name)
    {
        return self::query()->where('name', '=', $name)->first() === null ? false: true;
    }
}
