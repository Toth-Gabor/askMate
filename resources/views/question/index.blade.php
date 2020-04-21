@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="title text-center">
            <h1 class="text-black-50">All Questions</h1>
        </div>
        <div class="shadow">
            <table class="table table-bordered bg-primary">
                <th>View</th>
                <th>Title</th>
                <th>Owner</th>
                <th>Submission time</th>
                <th>Read</th>
                <th>Edit</th>
                <th>Delete</th>
                @foreach($questionList as $question)
                    <tr class="bg-info text">
                        <td>{{{ $question->view_number }}}</td>
                        <td>{{{ $question->title }}}</td>
                        <td>{{{ $user->name }}}</td>
                        <td>{{{ $question->created_at }}}</td>
                        <td>
                            <a href="{{{ route('question.show', ['id'=> $question->question_id ])}}}"
                               class="btn btn-primary">
                                Read
                            </a>
                        </td>
                        <td>
                            <a href="{{{ route('question.edit', ['id'=> $question->question_id ])}}}"
                               class="btn btn-success">
                                Edit
                            </a>
                        </td>
                        <td>
                            <a href="{{{ route('question.delete', ['id'=> $question->question_id ])}}}"
                               class="btn btn-danger">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
