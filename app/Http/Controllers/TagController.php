<?php

namespace App\Http\Controllers;

use App\QuestionTag;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function add(Request $request)
    {
        $questionId = $request->id;
        $tagList = Tag::all();
        return view('tag.create', ['question_id' => $questionId, 'tagList' => $tagList]);
    }

    public function create(Request $request)
    {
        // Form validation
        $request->validate([
            'question_id' => 'exist:questions,id',
            'name' => 'required|unique:tags|max:20'
        ]);
        $questionId = $request->question_id;
        $tagName = $request->name;

        //todo:a meglévő tag-ek használata
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        $tag = Tag::query()->where('name', '=', $tagName)->get();

        $questionTag = new QuestionTag();
        $questionTag->question_id = $questionId;
        $questionTag->tag_id = $tag[0]->id;

        $questionTag->save();

        return redirect(route('question.show', ['id' => $questionId]))->with(['status' => 'New comment added successfully.']);

    }

    public function delete(Request $request)
    {
        //
    }
}
