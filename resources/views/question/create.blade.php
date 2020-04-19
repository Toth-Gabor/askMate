@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create question') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('question.create') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-8">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="title"
                                           required autocomplete="title" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="question"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Question') }}</label>

                                <div class="col-md-8">
                                    <input id="question" type="text"
                                           class="form-control @error('question') is-invalid @enderror" required
                                           autocomplete="question">

                                    @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

