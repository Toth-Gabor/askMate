<div class="title text-center">
    <h4>{{{ sizeof($answerList) > 0 ? sizeof($answerList) . ' Answers' : 'Not answered yet!'}}}</h4>
</div>
@foreach($answerList as $answer)
    <div class="row justify-content-center">
        <!--answer vote section-->
        <div class="col-xs-6 float-left " style="width: 50px">
            <div class="vote-section">
                <h5>Vote</h5>
                <a href="{{{ route('answer.vote_up', ['id'=> $answer->id ])}}}">
                    <svg class="bi bi-caret-up-fill" width="2em" height="2em" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 00.753-1.659l-4.796-5.48a1 1 0 00-1.506 0z"/>
                    </svg>
                </a>
            </div>
            <div class="vote-section">{{{ $answer->vote_number }}}</div>
            <div class="vote-section">
                <a href="{{{ route('answer.vote_down', ['id'=> $answer->id ])}}}">
                    <svg class="bi bi-caret-down-fill" width="2em" height="2em" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 01.753 1.659l-4.796 5.48a1 1 0 01-1.506 0z"/>
                    </svg>
                </a>
            </div>
        </div>
        <!--answer vote section end-->
        <div class="col-md-10 float-right">
            <div class="card shadow">
                <div class="card-header light-grey">
                    {{{ ' Answered: ' . $answer->created_at->diffForHumans()
                      . ' by ' . \App\User::find($answer->user_id)->name }}}
                    <div class="float-right">

                        <a href="{{{ route('answer.edit', ['id'=> $answer->id ])}}}"
                           class="btn btn-secondary">
                            Edit
                        </a>
                        <a href="{{{ route('answer.delete', ['id'=> $answer->id ])}}}"
                           class="btn btn-danger">
                            Delete
                        </a>
                    </div>
                </div>
                <div class="card-body ">{{{ $answer->message }}}</div>
                <div class="img-responsive">
                    <img class="align-content-center" src='{{{ asset($answer->image) }}}' alt="">
                </div>
                <!-- comments of answer -->
                <div class="card-body">
                    @include('comment.answer-comment')
                </div>
                <div class="card-body">
                    <a class="btn btn-sm btn-primary" href="{{{ route('comment.add',
                        ['question_id'=> $question->id, 'answer_id' => $answer->id, 'type' => 'answer'])}}}">
                        add a comment
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach

