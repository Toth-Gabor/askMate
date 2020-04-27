<div class="title col-md-8 ">
    <h4>{{{ sizeof($answerList) > 0 ? sizeof($answerList) . ' Answers' : 'Not answered yet!'}}}</h4>
</div>
@foreach($answerList as $answer)
    <div class="row justify-content-center">
        <!--answer vote section-->
        <div class="col-xs-6 float-left " style="width: 50px">
            <div class="vote-section">
                <h5>Vote</h5>
                <a href="{{{ route('question.vote_up', ['id'=> $question->id ])}}}">
                    <svg class="bi bi-caret-up-fill" width="2em" height="2em" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 00.753-1.659l-4.796-5.48a1 1 0 00-1.506 0z"/>
                    </svg>
                </a>
            </div>
            <div class="vote-section">{{{ $question->vote_number }}}</div>
            <div class="vote-section">
                <a href="{{{ route('question.vote_down', ['id'=> $question->id ])}}}">
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
                    {{{ ' Answered: ' . $answer->created_at
                      . ' by: ' . \App\User::find($answer->user_id)->name }}}
                    <div class="float-right">

                        <a href="{{{ route('answer.edit', ['id'=> $answer->answer_id ])}}}"
                           class="btn btn-secondary">
                            Edit
                        </a>
                        <a href="{{{ route('answer.delete', ['id'=> $answer->answer_id ])}}}"
                           class="btn btn-danger">
                            Delete
                        </a>
                    </div>
                </div>
                <div class="card-body ">{{{ $answer->message }}}</div>
                <div class="img-responsive">
                    <img class="align-content-center" src='{{{ asset($answer->image) }}}' alt="">
                </div>
            </div>
        </div>
    </div>
@endforeach

