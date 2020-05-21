@extends('layouts.app')

@section('content')
    <div class="container">
        @include('alert')
        <div class="card shadow w-60">
            <div class="card-body justify-content-center">
                <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center">
                        @if (auth()->user()->image)
                            <img src="{{ asset(auth()->user()->image) }}"
                                 style="width: 120px; height: 120px; border-radius: 50%;" alt="">
                        @endif
                    </div>
                    <div class="col-md-9 col-lg-9 ">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <td>Name:</td>
                                <td>{{{ auth()->user()->name }}}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>{{{ auth()->user()->email }}}</td>
                            </tr>
                            <tr>
                                <td>Registered:</td>
                                <td>{{{ auth()->user()->created_at->diffForHumans() }}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="{{{ route('profile.edit') }}}" class="btn btn-primary">To update my profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
