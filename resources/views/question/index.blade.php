@extends('layouts.app')

@section('content')
    <div class="container">
        @include('alert')
        <div class="title text-center">
            <h1 class="text-black-50">All Questions</h1>
        </div>
        <div class="shadow">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>View</th>
                    <th>Title</th>
                    <th>Owner</th>
                    <th>Submission time</th>
                    <th>Read</th>
                </tr>
                </thead>
                @foreach($questionList as $question)
                    <tr class="text">
                        <td>{{{ $question->view_number }}}</td>
                        <td>{{{ $question->title }}}</td>
                        <td>{{{ $user->name }}}</td>
                        <td>{{{ $question->created_at }}}</td>
                        <td>
                            <a href="{{{ route('question.show', ['id'=> $question->id ])}}}"
                               class="btn btn-primary">
                                Read
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
