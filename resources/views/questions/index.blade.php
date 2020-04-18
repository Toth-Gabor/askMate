@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title text-center">
            <h1 class="text-black-50">All Questions</h1>
        </div>
        <div class="shadow">
            <table id="question-table" class="table table-bordered bg-primary">
                <th>Title</th>
                <th>Owner</th>
                <th>View</th>
                <th>Vote</th>
                <th>Submission Time</th>
                <th>Select</th>
                @foreach($questionList as $question)
                    <tr class="bg-info">
                        <td>{{{ $question->title }}}</td>
                        <td>{{{ $user->name }}}</td>
                        <td>{{{ $question->view_number }}}</td>
                        <td>{{{ $question->vote_number }}}</td>
                        <td>{{{ $question->submission_time }}}</td>
                        <td>
                            <a href="question?id={{{ $question->question_id }}}" class="btn btn-primary">
                                Select
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
