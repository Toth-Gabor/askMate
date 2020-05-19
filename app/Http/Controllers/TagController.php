<?php

namespace App\Http\Controllers;

use App\QuestionTag;
use App\Tag;
use DB;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function add(Request $request)
    {
        $questionId = $request->id;
        $tagList = Tag::all();
        return view('tag.create', ['question_id' => $questionId, 'tagList' => $tagList]);
    }

    public function store(Request $request)
    {
        $questionId = $request->id;
        $tagId = $request->tag_id;
        $questionTag = new QuestionTag();
        $questionTag->question_id = $questionId;
        $questionTag->tag_id = $tagId;
        $questionTag->save();

        return redirect(route('question.show', ['id' => $questionId]))->with(['status' => 'Tag added successfully.']);
    }

    public function create(Request $request)
    {
        // Form validation
        $request->validate([
            'id' => 'exist:questions,id',
            'name' => 'required|unique:tags|max:20'
        ]);
        $questionId = $request->id;
        $tagName = $request->name;

        //todo:a meglévő tag-ek használata
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        $tagId = $tag->getIdByName($tag->name);

        $questionTag = new QuestionTag();
        $questionTag->question_id = $questionId;
        $questionTag->tag_id = $tagId;
        $questionTag->save();

        return redirect(route('question.show', ['id' => $questionId]))->with(['status' => 'Tag added successfully.']);
    }

    public function delete(Request $request)
    {
        $questionId = $request->question_id;
        $tagId = $request->id;
        DB::table('question_tags')
            ->where(['question_id' => $questionId, 'tag_id'=> $tagId])
            ->delete();
        return redirect(route('question.show', ['id' => $questionId]))->with(['status' => 'Tag deleted successfully.']);
    }
}
