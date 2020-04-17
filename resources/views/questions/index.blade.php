@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title">
            <h1 class="text-black-50">All Questions</h1>
        </div>
        <div>
            <table id="question-table" class="table table-bordered table-hover table-dark">
                <th>Title</th>
                <th>Owner</th>
                <th>View</th>
                <th>Vote</th>
                <th>Submission Time</th>
                @foreach($questionList as $question)
                    <tr onclick="window.open('question?id={{{ $question->question_id }}}', '_self')">
                        <td>{{{ $question->title }}}</td>
                        <td>{{{ $user->name }}}</td>
                        <td>{{{ $question->view_number }}}</td>
                        <td>{{{ $question->vote_number }}}</td>
                        <td>{{{ $question->submission_time }}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
