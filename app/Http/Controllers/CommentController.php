<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function add(Request $request)
    {
        $type = $request->type;
        $questionId = $request->question_id;
        $answerId = $request->answer_id;
        return view('comment.create', [
            'question_id' => $questionId,
            'answer_id' => $answerId,
            'type' => $type
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function create(Request $request)
    {
        // Form validation
        $request->validate([
            'question_id' => 'int',
            'answer_id' => 'int',
            'message' => 'required|max:500',
            'type' => 'required|max:200',
        ]);

        // Get current user
        $user = auth()->user();
        // New comment
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->message = $request->message;
        $questionId = $request->question_id;
        $answerId = $request->answer_id;
        $type = $request->type;

        // comment of question or answer
        if ($type === 'question'){
            $comment->question_id = $questionId;
            $comment->answer_id = null;
        } else {
            $comment->answer_id = $answerId;
            $comment->question_id = null;
        }
        // Persist comment record to database
        $comment->save();
        // Return user back and show a flash message
        return redirect(route('question.show', ['id' => $questionId ]))->with(['status' => 'New comment added successfully.']);
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
            $filePath = $this->uploadOne($request, $this->folder);
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
        return redirect(route('question.show', ['id' => $answer->question_id ]))->with(['status' => 'Answer was updated successfully.']);
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
