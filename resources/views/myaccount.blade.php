@extends('layout')

@section('title', 'My Account')

@section('content')

<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-7">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <form action="/myaccount" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label>Username</label>
                    <input type="Text" class="form-control" name="name" value="{{$user->name}}" />
                    <small class="form-test text-muted">Put your Fortnite Username here.</small>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="Text" class="form-control" name="email" value="{{$user->email}}" />
                    <small class="form-test text-muted">Your Email Address</small>
                </div>
                <div class="form-group">
                    <label>About Me</label>
                    <textarea class="form-control" rows="3" name="aboutme">{{$user->aboutme}}</textarea>
                    <small class="form-test text-muted">Tell us a little bit about yourself.</small>
                </div>
                <div class="form-group">
                    <label for="image-upload">Profile Picture</label>
                    <img class="mb-3" src="../images/users/{{$user->profilepic}}" style="height: 100px; width: auto; display: block;" />
                    <input type="file" class="form-control-file" id="image" name="image">
                    <small class="form-test text-muted">Please choose an awesome avatar.</small>
                </div>
                <div class="form-group">
                    <label>Discord</label>
                    <input type="Text" class="form-control" name="discord" value="{{$user->discord}}" />
                    <small class="form-test text-muted">Your Discord username</small>
                </div>
                <div class="form-group">
                    <label>Instagram</label>
                    <input type="Text" class="form-control" name="instagram" value="{{$user->instagram}}" />
                    <small class="form-test text-muted">Your Instagram Username.</small>
                </div>
                <div class="form-group">
                    <label>Twitter</label>
                    <input type="Text" class="form-control" name="twitter" value="{{$user->twitter}}" />
                    <small class="form-test text-muted">Your Twitter username.</small>
                </div>
                <div class="form-group">
                    <label>YouTube</label>
                    <input type="Text" class="form-control" name="youtube" value="{{$user->youtube}}" />
                    <small class="form-test text-muted">Your YouTube channel.</small>
                </div>	
                <button class="btn btn-success btn-lg mb-2">Save</button>
            </form>
            <button class="btn btn-danger btn-lg my-2" data-toggle="modal" data-target="#userDeleteModal">Delete Account</button>
        </div>
    </div>
</div>

<div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="userDeleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userDeleteModal">Delete Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete your account?
        </div>
        <div class="modal-footer">
            <form action="/myaccount" method="POST" enctype="multipart/form-data">
                @csrf
                @method('delete')
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
                <button type="submit" class="btn btn-danger">Delete My Account</button>
            </form>
        </div>
      </div>
    </div>
  </div>

@endsection
