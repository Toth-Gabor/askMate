@extends('layouts.app')

@section('content')
    <div class="container">
        @include('alert')
        <div class="title text-center">
            <h1 class="text-black-50">Search Results</h1>
        </div>
        <div class="shadow">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th class="text-top">
                        <div class="float-left">View</div>
                    </th>
                    <th class="text-top">
                        <div class="float-left">Vote</div>
                    </th>
                    <th class="text-top">
                        <div class="float-left">Title</div>
                    </th>
                    <th>Owner</th>
                    <th class="text-top">
                        <div class="float-left">Submission time</div>
                    </th>
                    <th>Read</th>
                </tr>
                </thead>
                @foreach($questionList as $question)
                    <tr class="text">
                        <td>{{{ $question->view_number }}}</td>
                        <td>{{{ $question->vote_number }}}</td>
                        <td>{{{ $question->title }}}</td>
                        <td>{{{ App\User::find($question->user_id)->name }}}</td>
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
