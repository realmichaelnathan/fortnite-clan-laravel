@extends('layout')

@section('title', 'Editing: '.$clan->name)

@section('headers')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">

@endsection

@section('footers')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            tabsize: 2,
            height: 180,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']]
            ],
            disableDragAndDrop: true
        });
    });

</script>

@endsection

@section('content')
    <div class="row justify-content-center mt-2">
        <div class="col-12 col-lg-10 mb-2">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <form action="/editclan" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="Text" class="form-control" name="name" value="{{ $clan->name }}" />
                    <small class="form-test text-muted">The name of the Clan goes here.</small>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea id="summernote" class="form-control" rows="3"
                        name="description">{!!$clan->description!!}</textarea>
                    <small class="form-test text-muted">The description of the Clan goes here.</small>
                </div>
                <div class="form-group">
                    <label for="image-upload">Clan Image</label>
                    <img class="mb-3" src="../images/{{ $clan->picture }}"
                        style="height: 100px; width: auto; display: block;" />
                    <input type="file" class="form-control-file" id="image" name="image">
                    <small class="form-test text-muted">Please choose an image that is 16:9 in ratio. Larger is better.
                        Max File Size: 1MB.</small>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="d-block">Regions</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @foreach($regions as $region)
                                <label class="btn btn-outline-primary region @if($clan->region->contains($region->id)) active @endif">
                                    <input type="checkbox" name="regions[]" value="{{$region->id}}" @if($clan->region->contains($region->id)) checked @endif>{{$region->name}}
                                </label>
                                @endforeach
                            </div>
                            <small class="form-test mt-1 text-muted d-block">Select the regions your clan plays on.</small>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="d-block">Platforms</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @foreach($platforms as $platform)
                                <label class="btn btn-outline-secondary @if($clan->platform->contains($platform->id)) active @endif">
                                    <input type="checkbox" name="platforms[]" value="{{$platform->id}}" @if($clan->platform->contains($platform->id)) checked @endif>
                                    <i class="{{$platform->icon}}"></i>
                                </label>
                                @endforeach
                            </div>
                            <small class="form-test mt-1 text-muted d-block">Select the platforms your clan plays on.</small>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Discord</label>
                    <input type="Text" class="form-control" name="discord" value="{{ $clan->discord }}" />
                    <small class="form-test text-muted">A link to the Clan's Discord Server.</small>
                </div>
                <div class="form-group">
                    <label>Instagram</label>
                    <input type="Text" class="form-control" name="instagram" value="{{ $clan->instagram }}" />
                    <small class="form-test text-muted">A link to the Clan's Instagram.</small>
                </div>
                <div class="form-group">
                    <label>Twitter</label>
                    <input type="Text" class="form-control" name="twitter" value="{{ $clan->twitter }}" />
                    <small class="form-test text-muted">A link to the Clan's Twitter.</small>
                </div>
                <div class="form-group">
                    <label>YouTube</label>
                    <input type="Text" class="form-control" name="youtube" value="{{ $clan->youtube }}" />
                    <small class="form-test text-muted">A link to the Clan's YouTube.</small>
                </div>
                <button class="btn btn-success btn-lg mb-2">Update Clan</button>
            </form>
            <button class="btn btn-danger btn-lg my-2" data-toggle="modal" data-target="#clanDeleteModal">Delete This
                Clan</button>
        </div>
    </div>


<div class="modal fade" id="clanDeleteModal" tabindex="-1" role="dialog" aria-labelledby="clanDeleteModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clanDeleteModal">Delete Clan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete {{ $clan->name }}?
            </div>
            <div class="modal-footer">
                <form action="/deleteclan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
                    <button type="submit" class="btn btn-danger">Delete Clan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
