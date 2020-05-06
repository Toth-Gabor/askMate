<div class="title col-md-8">
    <h6>{{{ count($answer->comments) > 0 ? count($answer->comments) . ' Comments' : 'No comment added yet!'}}}</h6>
</div>
@foreach($answer->comments as $comment)
    <div class="row justify-content-center">
        <div class="col-md-10 float-right">
            <div class="text-secondary">
                <span>{{{ $comment->message }}}</span>
                <a href="">{{{ App\User::find($comment->user_id)->name }}}</a>
                <span>{{{ $comment->created_at->diffForHumans() }}}</span>
                <div class="float-right">
                    <a class="btn-sm btn-secondary" href="{{{ route('comment.edit', ['id'=> $comment->id, 'question_id' => $question->id])}}}">edit</a>
                    <a class="btn-sm btn-danger" href="{{{ route('comment.delete', ['id'=> $comment->id, 'question_id' => $question->id])}}}">delete</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
