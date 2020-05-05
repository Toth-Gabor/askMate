<div class="title col-md-8 ">
    <h6>{{{ count($questionCommentList) > 0 ? count($questionCommentList) . ' Comments' : 'No comment added yet!'}}}</h6>
</div>
@foreach($questionCommentList as $comment)
    <div class="row justify-content-center">
        <div class="col-md-10 float-right">
            <div class="text-secondary">
                <span>{{{ $comment->message }}}</span>
                <a href="">{{{ App\User::find($comment->user_id)->name }}}</a>
                <span>{{{ $comment->created_at->diffForHumans() }}}</span>
                <a href="{{{ route('comment.edit', ['id'=> $comment->id, 'question_id' => $question->id])}}}">edit</a>
                <a href="{{{ route('comment.delete', ['id'=> $comment->id, 'question_id' => $question->id])}}}">delete</a>
            </div>
        </div>
    </div>
@endforeach


