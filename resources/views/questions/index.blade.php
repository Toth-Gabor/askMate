@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title">
            <h1>Lista oldal</h1>
        </div>
        <div>
            <table class="table table-bordered table-hover table-active">
                <th>
                    Id
                </th>
                <th>
                    Submission Time
                </th>
                <th>
                    View
                </th>
                <th>
                    Vote
                </th>
                <th>
                    Title
                </th>
                @foreach($questionList as $question)
                    <tr>
                        <td>
                            {{{ $question->question_id }}}
                        </td>
                        <td>
                            {{{ $question->submission_time }}}
                        </td>
                        <td>
                            {{{ $question->view_number }}}
                        </td>
                        <td>
                            {{{ $question->vote_number }}}
                        </td>
                        <td>
                            {{{ $question->title }}}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
