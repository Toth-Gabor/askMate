@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title">
            <h1>All Questions</h1>
        </div>
        <div>
            <table class="table table-bordered table-hover table-striped">
                <th>Title</th>
                <th>Owner</th>
                <th>View</th>
                <th>Vote</th>
                <th>Submission Time</th>
                @foreach($questionList as $question)
                    <tr data="{{{ $question->question_id }}}">
                        <td>{{{ $question->title }}}</td>
                        <td>{{{ $question->name }}}</td>
                        <td>{{{ $question->view_number }}}</td>
                        <td>{{{ $question->vote_number }}}</td>
                        <td>{{{ $question->submission_time }}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
