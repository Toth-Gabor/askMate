<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function add(Request $request)
    {
        $questionId = $request->id;
        return view('answer.create', ['questionId' => $questionId]);
    }

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
            $filePath = $request->image->storeAs($folder, $fileName , 'public');
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

    public function delete(Request $request)
    {
        //
    }
}
