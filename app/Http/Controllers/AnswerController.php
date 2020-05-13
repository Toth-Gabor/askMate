<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Traits\UploadTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Storage;

class AnswerController extends Controller
{
    use UploadTrait;
    private $defaultStorage = 'storage/uploads/answer';

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
     * @return RedirectResponse|Redirector
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
        $user = auth()->user();
        $filePath = null;

        // Check if an image has been uploaded
        if ($request->has('image')) {
            // Upload image
            $filePath = $this->uploadOne($request, $this->defaultStorage);
        }
        // New Answer
        $answer = new Answer();
        $answer->question_id = $questionId;
        $answer->user_id = $user->id;
        $answer->message = $request->message;
        $answer->image = $filePath;

        // Persist answer record to database
        $answer->save();
        // Return user back and show a flash message
        return redirect(route('question.show', ['id' => $answer->question_id ]))
            ->with(['status' => 'New answer added successfully.']);

    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function edit(Request $request)
    {
        $answerId = $request->id;
        $answer = Answer::find($answerId);

        return view('answer.update', ['answer' => $answer]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request)
    {
        // Form validation
        $request->validate([
            'message' => 'string|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $answerId = $request->id;
        $answer = Answer::find($answerId);

        // Check if an image has been uploaded
        if ($request->has('image')) {
            // Upload image
            $filePath = $this->uploadOne($request, $this->defaultStorage);
            // Get old image path
            $oldImage = $answer->image;
            // Set new image path
            $answer->image = $filePath;
            // delete belonging old image for question
            if (file_exists($oldImage)){
                Storage::delete($oldImage);
            }
        }
        // Update answer data
        $answer->message = $request->message;
        // Persist answer record to database
        $answer->save();
        // Return user back and show a flash message
        return redirect(route('question.show', ['id' => $answer->question_id ]))
            ->with(['status' => 'Answer was updated successfully.']);
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
        return redirect(route('question.show', ['id' => $answer->question_id ]))
            ->with(['status' => 'Answer was deleted successfully.']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function voteUp(Request $request)
    {
        $answerId = $request->id;
        $answer = Answer::find($answerId);
        $answer->vote_number++;
        $answer->save();

        return redirect(route('question.show', ['id' => $answer->question_id ]))
            ->with(['status' => 'Your vote saved successfully.']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function voteDown(Request $request)
    {
        $answerId = $request->id;
        $answer = Answer::find($answerId);
        $answer->vote_number--;
        $answer->save();

        return redirect(route('question.show', ['id' => $answer->question_id ]))
            ->with(['status' => 'Your vote saved successfully.']);
    }
}
