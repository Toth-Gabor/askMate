<?php

namespace App\Http\Controllers;

use App\Traits\UploadTrait;
use File;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\View\View;
use Storage;
use Str;


class QuestionController extends Controller
{
    use UploadTrait;

    /**
     * all questions
     * @return Factory|View
     */
    public function index()
    {
        $user = User::find(1);
        $questionList = Question::all()->sortBy('created_at', SORT_REGULAR, 'desc');

        return view('question.index', ['questionList' => $questionList, 'user' => $user]);
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
        $user = User::find($question->user_id);

        return view('question.show', ['question' => $question, 'user' => $user]);
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
        $user = User::findOrFail(auth()->user()->id);
        $filePath = null;

        // Check if an image has been uploaded
        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Define folder path
            $folder = 'public/uploads/question';
            // Upload image
            $filePath = Storage::putFile($folder, $image , 'public');
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

        return redirect(route('question.index'))->with(['status' => 'New question created successfully.']);
    }

    /**
     * @return Factory|View
     */
    public function edit()
    {
        return view('question.update');
    }

    public function update()
    {
        //
    }

    public function delete(Request $request)
    {
        $questionId = $request->id;
        $question = Question::find($questionId);
        //dd(file_exists(str_replace('\\', '/', public_path()) . $question->image));
        // delete image if question has it
        if (Storage::exists($question->image)){
            Storage::delete($question->image);
        }
        $question->delete();
        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Question was deleted successfully.']);
    }

}

