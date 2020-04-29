<div class="title col-md-8 ">
    <h6>{{{ sizeof($questionCommentList) > 0 ? sizeof($questionCommentList) . ' Comments' : 'No comment added yet!'}}}</h6>
</div>
@foreach($questionCommentList as $comment)
    <div class="row justify-content-center">
        <div class="col-md-10 float-right">
            <div class="text-secondary">
                <span>{{{ $comment->message }}}</span>
                <a href="#">{{{ App\User::find($comment->user_id)->name }}}</a>
                <span>{{{ $comment->created_at->diffForHumans() }}}</span>
            </div>
        </div>
    </div>
@endforeach


