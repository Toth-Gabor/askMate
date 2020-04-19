<?php

namespace App\Http\Controllers;

use App\Traits\UploadTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\View\View;
use Str;
use Symfony\Component\Console\Input\Input;


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
        $questionList = Question::all()->sortBy('submission_time', SORT_REGULAR, 'desc');

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
     * create new question with|without image and save into DataBase
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function create(Request $request)
    {
        // Form validation
        $request->validate([
            'title'     =>  'required|unique:questions|max:255',
            'message'   =>  'required|unique:questions|max:500',
            'image'     =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Get current user
        $user = User::findOrFail(auth()->user()->id);
        $filePath = null;
        // New question
        $question = new Question();

        // Check if an image has been uploaded
        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/question';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);

        }

        $question->title = $request->title;
        $question->user_id = $user->id;
        $question->message = $request->message;
        $question->image = $filePath;
        // Persist question record to database
        $question->save();


        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'New question created successfully.']);

    }
}
