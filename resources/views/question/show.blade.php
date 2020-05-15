@extends('layouts.app')

@section('content')
    <div class="container">
        @include('alert')
        <div class="grid--cell ws-nowrap mr16 mb10 text-center">
            <div class="grid--cell ws-nowrap mr16 mb8" title="2019-08-19 15:57:39Z">
                <span class="fc-light mr2">Asked</span>
                <time itemprop="dateCreated"
                      datetime="2019-08-19T15:57:39">{{{ $question->created_at->diffForHumans() }}}</time>
                <span class="fc-light mr2">Viewed </span>{{{ $question->view_number }}}
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- Question vote section-->
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
            <!-- Question vote section end-->
            <!-- Question details section start-->
            <div class="col-md-10 float-right">
                <div class="card shadow">
                    <div class="card-header light-grey question-header">
                        <div class="float-left">
                            {{{ $question->title }}}
                        </div>
                        <div class="float-right">
                            <a href="{{{ route('question.edit', ['id'=> $question->id ])}}}"
                               class="btn btn-secondary">
                                Edit
                            </a>
                            <a href="{{{ route('question.delete', ['id'=> $question->id ])}}}"
                               class="btn btn-danger">
                                Delete
                            </a>
                            <a href="{{{ route('answer.add', ['id'=> $question->id ])}}}"
                               class="btn btn-primary">
                                Answer it
                            </a>
                        </div>
                    </div>
                    <div class="card-body"><h5>{{{ $question->message }}}</h5></div>
                    <div class="img-responsive">
                        <img class="align-content-center" src='{{{ asset($question->image) }}}' alt="">
                    </div>

                    <div class="card-body">
                        <div class="grid ps-relative d-block">
                            <h7>tags:</h7>
                            @foreach($tagList as $tag)
                                <a class="btn btn-sm btn-light" href="#">{{{ $tag->name }}}</a>
                            @endforeach
                        </div>
                        <div class="">
                            <a class="btn btn-sm btn-primary" href="{{{ route('tag.add', ['id'=> $question->id]) }}}">add
                                tag</a>
                        </div>
                    </div>

                    <!-- comments of question -->
                    <div class="card-body">
                        @include('comment.question-comment')
                    </div>
                    <div class="card-body">
                        <a class="btn btn-sm btn-primary"
                           href="{{{ route('comment.add', ['question_id' => $question->id, 'type' => 'question'])}}}">add
                            a
                            comment</a>
                    </div>
                </div>
            </div>
            <!-- Question details section end-->
        </div>
        <!-- Answer section start -->
    @include('answer.answer')
    <!-- Answer section end -->
    </div>
@endsection
