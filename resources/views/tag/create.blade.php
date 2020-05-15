@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add tag</div>
                    <div class="card-body">
                        @include('alert')
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
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
                                    <div>
                                        <h7>tags:</h7>
                                        @foreach($tagList as $tag)
                                            <a class="btn btn-sm btn-light" href="#">{{{ $tag->name }}}</a>
                                        @endforeach
                                    </div>
                                    <!--Add tag section-->
                                    <form
                                        action="{{ route('tag.create', ['question_id' => $question_id]) }}"
                                        method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-right">Name</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0 mt-5">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">Add tag</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--Add tag section end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

