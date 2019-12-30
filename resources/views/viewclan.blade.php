@extends('layout') 
@section('title', $clan->name)
@section('headers')
<style>
    #votebox {
        margin-bottom: 0.5rem;
    }
    #descriptionbox {
        height:100%;
    }
    #socialsbox, #votebox {
        max-width:194px;
    }
    @media (max-width:500px) {
        #boxcontainer {
            flex-direction:column-reverse;
        }
        #votebox {
            margin-right: 0.5rem;
            margin-bottom:0;
        }
        #socialsbox {
            height:100%;
        }
        #socialsbox div.card-body {
            display:flex;
            justify-content:center;
            align-items:center;
        }
    }
</style>
@endsection
@section('scripts')
<script type="text/javascript">
function vote(clanid) {
    $.ajax({
    type: "POST",
    url: "/vote",
    data: {
        "clanid" : clanid,
        "_token" : "{{ csrf_token() }}"
    },
    success: function(response) {
        if (response.status == "success") {
            $('#votebutton').addClass('disabled');
            $('#votebutton').text('Voted');
            $('#votecount').text(response.votes);
        }   
    }
    });
}

function removevote(clanid) {
    $.ajax({
    type: "POST",
    url: "/removevote",
    data: {
        "clanid" : clanid,
        "_token" : "{{ csrf_token() }}"
    },
    success: function(response) {
        console.log(response);
        if (response.status == "deleted") {
            $('#votebutton').addClass('disabled');
            $('#votebutton').text('Vote Removed');
            $('#votecount').text(response.votes);
        }   
    }
    });
}
</script>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row bg-dark clan-image-container">
        <div class="bg-image-blurred" style="background-image: url({{asset("images/$clan->picture")}});"></div>
        <img src="{{asset("images/$clan->picture")}}" class="clan-image" alt="{{$clan->name}} Fortnite Clan" />
    </div>
    <div class="row clan-name">
        <h1 class="text-center mt-2">{{$clan->name}}</h1>
    </div>
    <div id="boxcontainer" class="row mb-2 justify-content-center">
        <div class=" col-12 col-sm-6 px-1 d-flex flex-column mt-2">
            <div id="descriptionbox" class="card p-1">
                <div class="card-body">
                    <p class="float-left clan-text pt-2">
                        {!!$clan->description!!}
                    </p>
                </div>
            </div>
        </div>


        <div id="rightcolumn" class=" col-12 col-sm-2 col-lg-2 px-1 d-flex flex-column mt-2">
            <div class="row m-0">
                <div class="col-6 col-sm-12 p-0">
                    <div id="votebox" class="card p-1">
                        <div class="card-body p-3 justify-content-center">
                            <h5 id="votecount" class="display-2 m-0 text-center">{{$votes}}</h5>
                        <small class="d-block text-center"><strong>Votes</strong></small>
                        </div>
                        @if(!Auth::user())
                            <button id="votebutton" class="btn btn-success disabled">Login To Vote</button>
                        @elseif(!Auth::user()->hasVerifiedEmail())
                            <button id="votebutton" class="btn btn-success disabled">Verify Email To Vote</button>
                        @elseif($votedforthisclan)
                            <button id="votebutton" class="btn btn-danger" onclick="removevote({{$clan->id}})">Remove Vote</button>
                        @elseif($voted)
                            <button id="votebutton" class="btn btn-success disabled">Voted</button>
                        @else
                            <button id="votebutton" class="btn btn-success" onclick="vote({{$clan->id}})">Vote</button>
                        @endif
                    </div>
                </div>
                <div class="col-6 col-sm-12 p-0">
                    <div id="socialsbox" class="card p-1">
                        <div class="card-body p-3">
                            <div class="row justify-content-center">
                                @if($clan->discord)
                                <a class="btn discord bigsocial" href="{{$clan->discord}}" target="_blank">
                                    <i class="fab fa-discord"></i>
                                </a>
                                @endif
                                @if($clan->twitter)
                                <a class="btn twitter bigsocial" href="{{$clan->twitter}}" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                @endif
                                @if($clan->instagram)
                                <a class="btn instagram bigsocial" href="{{$clan->instagram}}" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                @endif
                                @if($clan->facebook)
                                <a class="btn facebook bigsocial" href="{{$clan->facebook}}" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                @endif
                                @if($clan->youtube)
                                <a class="btn youtube bigsocial" href="{{$clan->youtube}}" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection