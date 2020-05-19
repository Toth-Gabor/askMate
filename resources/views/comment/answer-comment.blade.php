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
                    <a href="{{{ route('comment.edit', ['id'=> $comment->id, 'question_id' => $question->id])}}}">
                        <i class="fa fa-pen" aria-hidden="true"></i>
                    </a>
                    <a href="{{{ route('comment.delete', ['id'=> $comment->id, 'question_id' => $question->id])}}}">
                        <i class="fa fa-trash-alt" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
