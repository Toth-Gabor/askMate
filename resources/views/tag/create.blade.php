@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add or delete tag</h6>
                    <button type="button" class="close float-right" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label for="tagId"></label><input type="text" name="tagId" id="tagId" value=""/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Add</button>
                    <a class="btn btn-danger" href="{{{ route('tag.delete', ['id' => 0, 'question_id' => $question_id] ) }}}">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end-->
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
                                    @include('error')
                                    <div>
                                        <h7>tags:</h7>
                                        @foreach($tagList as $tag)
                                            <a href="{{{ route( 'tag.store',['id' => $question_id, 'tag_id' => $tag->id])}}}" class="btn btn-sm btn-light" >{{{ $tag->name }}}</a>
                                        @endforeach
                                    </div>
                                    <!-- Add tag section -->
                                    <form
                                        action="{{ route('tag.create', ['id' => $question_id]) }}"
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
                                                <button type="submit" class="btn btn-primary">Create and add tag</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Add tag section end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

