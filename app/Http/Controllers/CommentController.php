<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment;
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
        $id = $request->id;
        return view('comment.create', ['id' => $id, 'type' => $type]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function create(Request $request)
    {
        // Form validation
        $request->validate([
            'message' => 'required|max:500',
            'type' => 'required|max:500',
        ]);

        // Get current user
        $user = auth()->user();
        // New comment
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->message = $request->message;

        $id = $request->id;
        $type = $request->type;

        if ($type === 'question'){
            $comment->question_id = $id;
            $questionId = $id;
        } else {
            $comment->answer_id = $id;
            $questionId = Answer::find($id)->question_id;
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
