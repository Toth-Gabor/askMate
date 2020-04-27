<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Storage;

class AnswerController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function add(Request $request)
    {
        $questionId = $request->id;
        return view('answer.create', ['questionId' => $questionId]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function create(Request $request)
    {
        // Form validation
        $request->validate([
            'message' => 'required|unique:answers|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $questionId = $request->id;
        // Get current user
        $user = User::findOrFail(auth()->user()->id);
        $question = Question::find($questionId);

        $answer = new Answer();

        // Check if an image has been uploaded
        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Create file name
            $fileName = Auth()->user()->name . '_' . time() . '.' . $image->getClientOriginalExtension();
            // Define folder path
            $folder = 'storage/uploads/answer';
            // Upload image
            $filePath = $image->storeAs($folder, $fileName, 'public');
            $answer->image = $filePath;
        }
        // New answer
        $answer->question_id = $questionId;
        $answer->user_id = $user->id;
        $answer->message = $request->message;

        // Persist answer record to database
        $answer->save();
        // Return user back and show a flash message
        return view('question.show', ['question' => $question, 'user' => $user])->with(['status' => 'New answer added successfully.']);
    }

    public function edit(Request $request)
    {
        //
    }

    public function update(Request $request)
    {
        //
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function delete(Request $request)
    {
        $answerId = $request->id;
        $answer = Answer::find($answerId);
        // delete belonging image to question
        if (file_exists($answer->image)){
            Storage::delete($answer->image);
        }
        $answer->delete();
        // Return user back and show a flash message
        return redirect(route('question.show', ['id' => $answer->question_id ]))->with(['status' => 'Answer was deleted successfully.']);
    }
}
