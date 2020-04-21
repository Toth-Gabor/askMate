@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit question</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>
                                                        {{ $error }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{{ route('question.update', ['id'=> $question->question_id ])}}}"
                                          enctype="multipart/form-data" method="POST" role="form">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                                            <div class="col-md-6">
                                                <input id="title" type="text" class="form-control" name="title" value="{{{ $question->title }}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="message" class="col-md-4 col-form-label text-md-right">Message</label>
                                            <div class="col-md-6">
                                                <input id="message" type="text" class="form-control" name="message" value="{{{ $question->message }}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                                            <div class="col-md-6">
                                                <input id="image" type="file" class="form-control" name="image" value="{{{ $question->image }}}">
                                                @if ($question->image)
                                                    <code>{{ $question->image }}</code>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0 mt-5">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">Update question</button>
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

