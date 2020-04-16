<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
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
        $questionList = Question::all()->sortBy('submission_time', SORT_REGULAR, 'desc');

        return view('questions.index', ['questionList' => $questionList]);
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function question(int $id)
    {
        $question = Question::find($id);

        return view('questions.question', ['question' => $question]);
    }
}
