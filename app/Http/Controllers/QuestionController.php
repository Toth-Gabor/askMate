<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Traits\UploadTrait;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Storage;

class QuestionController extends Controller
{
    use UploadTrait;
    // todo: konstansba tenni
    private $defaultStorage = 'storage/uploads/question';
    private $indexParams = '?order_by=created_at&order_direction=desc';

    /**
     * all questions
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $request->validate([
            'order_by' => 'string|max:255',
            'order_direction' => 'string|max:255',
        ]);

        $orderBy = $request->order_by;
        $orderDirection = $request->order_direction;

        $questionList = DB::table('questions')
            ->orderBy($orderBy, $orderDirection)
            ->get();
        return view('question.index', ['questionList' => $questionList]);
    }

    /**
     * the details of the question and the answers to it.
     * @param Request $request
     * @return Factory|View
     */
    public function show(Request $request)
    {
        $questionId = $request->id;

        $question = Question::find($questionId);
        // Get answers of question
        $answerList = $question->answers;
        // Increase view count
        // todo:eloquint increse megnézni
        $question->view_number++;
        $question->save();

        $user = User::find($question->user_id);
        // Get comments of question
        $questionCommentList = $question->comments;
        $tagList = Tag::all();

        return view('question.show', [
            'question' => $question,
            'user' => $user,
            'answerList' => $answerList,
            'answerCount' => count($answerList),
            'questionCommentList' => $questionCommentList,
            'tagList' => $tagList
        ]);
    }

    /**
     * @return Factory|View
     */
    public function add()
    {
        return view('question.create');
    }

    /**
     * create new question with or without image and save it into the DataBase
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function create(Request $request)
    {
        // Form validation
        $request->validate([
            'title' => 'required|unique:questions|max:255',
            'message' => 'required|unique:questions|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Get current user
        $user = auth()->user();
        $filePath = null;

        // Check if an image has been uploaded
        if ($request->has('image')) {
            $filePath = $this->uploadOne($request, $this->defaultStorage);
        }
        // New question
        $question = new Question();
        $question->title = $request->title;
        $question->user_id = $user->id;
        $question->message = $request->message;
        $question->image = $filePath;
        // Persist question record to database
        $question->save();
        // Return user back and show a flash message
        return redirect(route('question.index') . $this->indexParams)
            ->with(['status' => 'New question created successfully.']);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function edit(Request $request)
    {
        $questionId = $request->id;
        $question = Question::find($questionId);

        return view('question.update', ['question' => $question]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request)
    {
        // Form validation
        $request->validate([
            'title' => 'string|max:255',
            'message' => 'string|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $questionId = $request->id;
        $question = Question::find($questionId);

        // Check if an image has been uploaded
        if ($request->has('image')) {
            $filePath = $this->uploadOne($request, $this->defaultStorage);
            // Get old image path
            $oldImage = $question->image;
            // Set new image path
            $question->image = $filePath;
            // delete belonging old image for question
            if (file_exists($oldImage)) {
                Storage::delete($oldImage);
            }
        }
        // Update question data
        $question->title = $request->title;
        $question->message = $request->message;
        // Persist question record to database
        $question->save();
        // Return user back and show a flash message

        return redirect(route('question.index') . $this->indexParams)
            ->with(['status' => 'New question created successfully.']);
    }

    /**
     * Delete question and the belonging image
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request)
    {
        $questionId = $request->id;
        $question = Question::find($questionId);
        // delete belonging image to question
        if (file_exists($question->image)) {
            Storage::delete($question->image);
        }
        $question->delete();
        // Return user back and show a flash message
        return redirect(route('question.index') . $this->indexParams)
            ->with(['status' => 'Question was deleted successfully.']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function voteUp(Request $request)
    {
        $questionId = $request->id;
        $question = Question::find($questionId);
        $question->vote_number++;
        $question->save();

        return redirect(route('question.index') . $this->indexParams)
            ->with(['status' => 'Your vote saved successfully.']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function voteDown(Request $request)
    {
        $questionId = $request->id;
        $question = Question::find($questionId);
        $question->vote_number--;
        $question->save();

        return redirect(route('question.index') . $this->indexParams)
            ->with(['status' => 'Your vote saved successfully.']);
    }
}

