@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create comment</div>
                    <div class="card-body">
                        @include('alert')
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    @include('error')
                                    <!--Create comment section-->
                                    <form
                                        action="{{ route('comment.create', ['question_id' => $question_id, 'answer_id' => $answer_id, 'type' => $type]) }}"
                                        method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="message"
                                                   class="col-md-4 col-form-label text-md-right">Message</label>
                                            <div class="col-md-6">
                                                <input id="message" type="text" class="form-control" name="message">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0 mt-5">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">Create comment</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--Create comment section end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

