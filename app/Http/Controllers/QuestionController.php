<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\View\View;


class QuestionController extends Controller
{
    /**
     * all questions
     * @return Factory|View
     */
    public function index()
    {
        $user = User::find(1);
        $questionList = Question::all()->sortBy('submission_time', SORT_REGULAR, 'desc');

        return view('question.index', ['questionList' => $questionList, 'user' => $user]);
    }

    /**
     * the details of the question and the answers to it.
     * @return Factory|View
     */
    public function show()
    {
        $questionId = \request('id');
        $user = User::find(1);

        $question = Question::find($questionId);

        return view('question.show', ['question' => $question, 'user' => $user]);
    }

    /**
     * add new question
     */
    public function create()
    {
        //Question::query()->insert();
        return view('question.create');
    }
}
