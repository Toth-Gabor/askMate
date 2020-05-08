<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Collection;

class SearchController extends Controller
{
    /**
     * Show the matching records from the DB
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function index(Request $request)
    {
        // Form validation
        $request->validate([
            'search' => 'string|max:255'
        ]);
        $search = $request->search;
        // Search in the DB
        $questionList = DB::table('questions')
            ->where('title', 'LIKE', '%'. $search. '%')
            ->orWhere('message', 'LIKE', '%'. $search. '%')
            ->orderBy('created_at', 'desc')
            ->get();

        $tempList = $this->getQuestionsOfMatchingAnswer($search);
        if (!$tempList->isEmpty()){
            foreach ($tempList as $question) {
                $questionList->push($question->first());
            }
        }

        // Check result list is empty
        if ($questionList->isEmpty()) {
            // No result!
            return redirect()->back()->with(['status' => 'No result!']);
        }
        // Show results
        return view('search.search', ['questionList' => $questionList]);
    }

    /**
     * Find questions of matching answers
     * @param $search
     * @return \Illuminate\Support\Collection
     */
    private function getQuestionsOfMatchingAnswer($search)
    {
        $questionList = collect();
        $answerList = DB::table('answers')
            ->where('message', 'LIKE', '%'. $search. '%')
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($answerList as $answer){
            $questionList->push(DB::table('questions')
                ->where('id', '=', $answer->question_id)
                ->get());
        }
        return $questionList;
    }
}
