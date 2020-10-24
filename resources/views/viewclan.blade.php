@extends('layout') 
@section('title', $clan->name)
@section('ogtitle', $clan->name)
@section('ogimage', asset("images/$clan->picture"))
@section('ogdesc', str_limit(strip_tags($clan->description), 155))

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
            $('#votecount').text(response.votes + '  Votes');
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
        if (response.status == "deleted") {
            $('#votebutton').addClass('disabled');
            $('#votebutton').text('Vote Removed');
            $('#votecount').text(response.votes + '  Votes');
        }   
    }
    });
}
</script>
@endsection
@section('content')
<div class="row mt-3">
    <div class="col-12 col-lg-4 d-flex d-lg-block justify-content-center justify-content-lg-start">
        <div style="width:320px; height:320px; border:10px solid rgba(255,255,255,0.4); border-radius: 50%; background: url('../images/{{$clan->picture}}'); background-size: auto 320px; background-position: center;"></div>
    </div>
    <div class="col-12 col-lg-8 mt-3 mt-lg-0">
        <h1 id="clan-title" class="text-lg-right text-center display-4">{{$clan->name}}</h1>
        <div class="d-flex justify-content-center justify-content-lg-end">
            @if($clan->discord)
            <a class="btn discord bigsocial rounded-circle" href="{{$clan->discord}}" target="_blank">
                <i class="fab fa-discord"></i>
            </a>
            @endif
            @if($clan->twitter)
            <a class="btn twitter bigsocial rounded-circle" href="{{$clan->twitter}}" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
            @endif
            @if($clan->instagram)
            <a class="btn instagram bigsocial rounded-circle" href="{{$clan->instagram}}" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
            @endif
            @if($clan->youtube)
            <a class="btn youtube bigsocial rounded-circle" href="{{$clan->youtube}}" target="_blank">
                <i class="fab fa-youtube"></i>
            </a>
            @endif
        </div>
        {{-- Vote Button Stuff --}}
        <div class="row mt-3">
            <div class="col d-flex justify-content-center justify-content-lg-end">
                <div class="d-flex">
                    <h3 id="votecount" class="card p-2 m-0">{{$votes}} Votes</h3>
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
        </div>
    </div>
</div>

<div class="row justify-content-center mt-3 px-1">
    <div class="col-12 @if($clan->votes->count() > 0) col-lg-8 @endif d-flex flex-column mt-1">
        <h3 class="">About {{$clan->name}}</h3>
        <p class="float-left clan-text">
            {!!$clan->description!!}
        </p>
    </div>
@if($clan->votes->count() > 0)
    <div class="col-12 col-lg-4">
        <h3>Clan Supporters</h3>
        <div class="row px-3">
            @foreach($clan->votes as $vote)
            <div class="card flex-row m-1 p-0" style="font-size:12px; align-items:center; border-radius: 10px; border:0;">
                <div style="width:30px; height:30px; background: #3f3f3f7a url('../images/users/{{$vote->user->profilepic}}'); background-size: auto 30px; background-position: center; border-radius: 10px 0 0 10px;"></div>
                <div class="d-flex justify-content-center flex-fill" style="padding: 0 10px; min-width:70px;">{{str_limit($vote->user->name, 20)}}</div> 
                <a href="/user/{{$vote->user->id}}/{{str_replace([' ', '/'], '-', $vote->user->name)}}" class="stretched-link"></a>  
            </div>
            @endforeach
        </div>
    </div>
@endif
</div>
<div class="row my-4 justify-content-center">
    <div class="col">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- fnclan-horizontal -->
        <ins class="adsbygoogle"
            style="display:flex; justify-content:center"
            data-ad-client="ca-pub-9720848360917466"
            data-ad-slot="1251108935"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>

            (adsbygoogle = window.adsbygoogle || []).push({});

        </script>
    </div>
</div>
@endsection