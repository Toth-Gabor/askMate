@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit comment</div>
                    <div class="card-body">
                        @include('alert')
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    @include('error')
                                    <form action="{{ route('comment.update', ['id' => $comment->id, 'question_id' => $question_id]) }}" method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="message" class="col-md-4 col-form-label text-md-right">Message</label>
                                            <div class="col-md-6">
                                                <input id="message" type="text" class="form-control" name="message" value="{{{ $comment->message }}}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0 mt-5">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">Update comment</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

