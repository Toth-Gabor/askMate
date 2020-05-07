<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * Show the matching records from the DB
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function index(Request $request)
    {
        $search = $request->search;
        // Search in the DB
        $questionList = DB::table('questions')
            ->where('title', 'LIKE', '%'. $search. '%')
            ->orWhere('message', 'LIKE', '%'. $search. '%')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($questionList->count() < 1) {
            // No result!
            return redirect()->back()->with(['status' => 'No result!']);
        }
        return view('search.search', ['questionList' => $questionList]);
    }
}
