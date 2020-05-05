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
        // Form validation
        $request->validate([
            'id' => 'int',
            'question_id' => 'int'
        ]);

        $commentId = $request->id;
        $questionId = $request->question_id;
        $comment = Comment::find($commentId);

        return view('comment.update', ['comment' => $comment, 'question_id' => $questionId]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request)
    {
        // Form validation
        $request->validate([
            'id' => 'int',
            'question_id' => 'int',
            'message' => 'string|max:500'
        ]);

        $commentId = $request->id;
        $questionId = $request->question_id;
        $comment = Comment::find($commentId);

        // Update comment data
        $comment->message = $request->message;
        // Persist comment record to database
        $comment->save();
        // Return user back and show a flash message
        return redirect(route('question.show', ['id' => $questionId ]))->with(['status' => 'Comment was updated successfully.']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function delete(Request $request)
    {
        // Form validation
        $request->validate([
            'id' => 'int',
            'question_id' => 'int',
            'message' => 'string|max:500'
        ]);

        $commentId = $request->id;
        $questionId = $request->question_id;
        $comment = Comment::find($commentId);
        // Delete comment record from database
        $comment->delete();
        // Return user back and show a flash message
        return redirect(route('question.show', ['id' => $questionId ]))->with(['status' => 'Comment was deleted successfully.']);
    }
}
