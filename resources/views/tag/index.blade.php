@extends('layouts.app')

@section('content')
    <div class="container">
    @include('alert')
    <!-- Tag section -->
        <div class="card shadow w-50">
            <div class="card-header">Tag list</div>
            <div class="card-body">
                @foreach($tagTDOList as $tagTDO)
                    <div>
                        <p class="btn btn-sm btn-light">{{{ $tagTDO['tag']->name}}}</p>
                        <p class="float-right">{{{ ' added to ' . $tagTDO['count'] .' question' }}}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Tag section end-->
    </div>
@endsection

