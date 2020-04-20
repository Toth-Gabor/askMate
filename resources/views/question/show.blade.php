@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title text-center">
            <h1>Question</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary">{{{ $question->title }}}</div>
                    <div class="card-body bg-info">{{{  "Owner: " . $user->name . " created at: " . $question->created_at }}}</div>
                    <div class="card-body bg-info">{{{ $question->message }}}</div>
                </div>
            </div>
        </div>
        <div class="title text-center">
            <h1>Answers</h1>
        </div>
    </div>
@endsection
