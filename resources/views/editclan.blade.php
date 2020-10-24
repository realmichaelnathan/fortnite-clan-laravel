@extends('layout')

@section('title', 'Editing: '.$clan->name)

@section('headers')
<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
<!-- end summernote --->
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
                ['color', ['color']],
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
                <div class="alert alert-secondary" role="alert">
                    <h4 class="alert-heading">Want More People To Notice Your Clan?</h4>
                    <p>A complete description with details about the clan such as the requirements to join and who to
                        contact if someone is interested
                        is a good start! Listing Clan Social Media accounts help you take your exposure to the next
                        level!</p>
                </div>
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
                <div class="alert alert-secondary" role="alert">
                    <h4 class="alert-heading">Discord Invite Links</h4>
                    <p class="mb-0">
                        When creating a invite link for your Discord server make sure that the link is not a temporary
                        invite link.
                        Links expire by default after 1 day! So make sure to go into the settings and set the link to
                        never expire!
                    </p>
                    <hr>
                    <p class="mb-0">If you do not have an account then leave the text field blank :)</p>
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
