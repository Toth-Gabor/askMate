@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title text-center">
            <h1>Question</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-xs-6 float-left" style="width: 50px">
                <div class="vote-section">
                    <h5>Vote</h5>
                    <a href="{{{ route('question.vote_up', ['id'=> $question->question_id ])}}}">
                        <svg class="bi bi-caret-up-fill" width="2em" height="2em" viewBox="0 0 16 16"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 00.753-1.659l-4.796-5.48a1 1 0 00-1.506 0z"/>
                        </svg>
                    </a>
                </div>
                <div class="vote-section">{{{ $question->vote_number }}}</div>
                <div class="vote-section">
                    <a href="{{{ route('question.vote_down', ['id'=> $question->question_id ])}}}">
                        <svg class="bi bi-caret-down-fill" width="2em" height="2em" viewBox="0 0 16 16"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 01.753 1.659l-4.796 5.48a1 1 0 01-1.506 0z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-md-10 float-right">
                <div class="card shadow">
                    <div class="card-header bg-primary">{{{ $question->title }}}</div>
                    <div
                        class="card-body bg-info">{{{  "Owner: " . $user->name . " created at: " . $question->created_at }}}</div>
                    <div class="card-body bg-info">{{{ $question->message }}}</div>
                    <div class="card-img"><img src='{{{ 'storage/app/' . $question->image }}}' alt="No"></div>
                </div>
            </div>
        </div>
        <div class="title text-center">
            <h1>Answers</h1>
        </div>
    </div>
@endsection
