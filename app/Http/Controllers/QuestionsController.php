<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\View\View;


class QuestionsController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $user = User::find(1);
        $questionList = Question::all()->sortBy('submission_time', SORT_REGULAR, 'desc');

        return view('questions.index', ['questionList' => $questionList, 'user' => $user]);
    }

    /**
     * @return Factory|View
     */
    public function question()
    {
        $questionId = \request('id');
        $user = User::find(1);

        $question = Question::find($questionId);

        return view('questions.question', ['question' => $question, 'user' => $user]);
    }
}
