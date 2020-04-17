@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title text-center">
            <h1>Question</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{{ $question->title }}}</div>
                    <div class="card-body">{{{ $question->message }}}</div>
                    <div class="card-body">{{{ $user->name }}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
