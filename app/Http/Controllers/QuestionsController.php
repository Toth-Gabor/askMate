<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionsController extends Controller
{
    public function index()
    {
        $questionList = Question::all()->sortBy('submission_time', SORT_REGULAR,'desc');
        //dd($questionList);
        return view('questions.index', ['questionList' => $questionList]);
    }
}
