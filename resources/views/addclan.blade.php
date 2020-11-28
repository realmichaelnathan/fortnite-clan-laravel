@extends('layout') 
@section('title', 'Add your clan!') 
@section('content')

    <div class="row mt-2 justify-content-center mb-2">
        <div class="col-12 col-lg-10">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <form action="/addclan" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="Text" class="form-control" name="name" />
                    <small class="form-test text-muted">The name of the Clan goes here.</small>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea id="summernote" class="form-control" rows="3" name="description"></textarea>
                    <small class="form-test text-muted">The description of the Clan goes here.</small>
                </div>
                <div class="form-group">
                    <label for="image-upload">Clan Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <small class="form-test text-muted">Please choose an image that is 16:9 in ratio.</small>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="d-block">Regions</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @foreach($regions as $region)
                                <label class="btn btn-outline-primary region">
                                    <input type="checkbox" name="regions[]" value="{{$region->id}}">{{$region->name}}
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
                                <label class="btn btn-outline-secondary">
                                    <input type="checkbox" name="platforms[]" value="{{$platform->id}}">
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
                    <input type="Text" class="form-control" name="discord" />
                    <small class="form-test text-muted">A link to the Clan's Discord Server.</small>
                </div>
                <div class="form-group">
                    <label>Instagram</label>
                    <input type="Text" class="form-control" name="instagram" />
                    <small class="form-test text-muted">A link to the Clan's Instagram.</small>
                </div>
                <div class="form-group">
                    <label>Twitter</label>
                    <input type="Text" class="form-control" name="twitter" />
                    <small class="form-test text-muted">A link to the Clan's Twitter.</small>
                </div>
                <div class="form-group">
                    <label>YouTube</label>
                    <input type="Text" class="form-control" name="youtube" />
                    <small class="form-test text-muted">A link to the Clan's YouTube.</small>
                </div>	
                <button class="btn btn-primary btn-lg">Add Clan</button>
            </form>
        </div>
    </div>

@endsection
 
@section('headers')
<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
<!-- end summernote --->
@endsection
 
@section('footers')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
<script>
    $(document).ready(function() {
            $('#summernote').summernote({
                 tabsize: 2,
                 height: 180,
                 toolbar: [
                   // [groupName, [list of button]]
                   ['style', ['bold', 'italic', 'underline', 'clear']],
                   ['fontsize', ['fontsize']],
                   ['para', ['ul', 'ol', 'paragraph']]
              ],
              disableDragAndDrop: true
            });
        });
</script>
@endsection