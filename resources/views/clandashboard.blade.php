@extends('layout')
@section('title', 'Clan Dashboard') 
@section('content')

<style>
    .facebook, .votes, .bumps {
        overflow:hidden;
    }
    .votes {
        background: rgb(39,174,96);
    }
    .bumps {
        background: #9f1e9f;
    }
    .facebook span, .bumps span, .votes span, div.card small {
        z-index:20;
        text-align:right;
        color: #fff;
        font-weight:bold;
    }
    div.facebook i, div.bumps i, div.votes i {
        z-index: 10;
        font-size: 155px;
        color: rgba(255, 255, 255, 0.206);
        position: absolute;
        top:10px;
        left: 25px;
        margin:auto;
    }
    @media (max-width:1100px) {
        span.display-2 {
            font-size: 60px;
        }
    }
    @media (max-width: 800px) {
        span.display-2 {
            font-size: 35px;
        }
        small {
            font-size: 10px;
        }
        div.facebook i, div.votes i, div.bumps i {
            z-index: 10;
            font-size: 125px;
            color: rgba(255, 255, 255, 0.206);
            position: absolute;
            top:10px;
            margin:auto;
        }   
    }

</style>
<div id="main" class="container my-2 col-12 col-lg-10 col-xl-8">
    <div class="row p-1">
        <div id="notification" class="alert alert-dismissible fade show" style="display:none; width:100%;" role="alert">
            <span id="notificationBody" class="text-bold"></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-secondary d-flex flex-column" role="alert">
            <h4 class="alert-heading text-bold mx-auto">Bump Your Clan!</h4>
            <p>Want your clan to appear on the top of the list? Once every 24 hours you can bump your clan right to the tippy top of the list! 
                hit the button below to bump your clan!
            </p>
            <button class="btn btn-lg btn-warning" onclick="bump({{$clan->id}})">Bump My Clan</button>
            <hr class="mx-0">
            <span class="ml-auto">Your clan was bumped <strong id="last_bumped">{{$clan->bumped_at}}<strong></span>
        </div>
    </div>
    <div class="row">
        <div class="col-4 p-1">
            <div class="card facebook p-3">
                <span class="display-2">
                    {{$clan->total_views()}}
                </span>
                <small>Total Views</small>
                <i class="fas fa-eye"></i>
            </div>
        </div>
        <div class="col-4 p-1">
            <div class="card votes p-3">
                <span class="display-2 ">
                    {{$clan->total_votes()}}
                </span>
                <small>Total Votes</small>
                <i class="fas fa-check"></i>
            </div>
        </div>
         <div class="col-4 p-1">
            <div class="card bumps p-3">
                <span id="bumps" class="display-2 ">
                    {{$clan->bumps}}
                </span>
                <small>Bump Streak</small>
                <i class="fas fa-arrow-circle-up"></i>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function bump(clanid) {
    $.ajax({
    type: "POST",
    url: "/bumpclan",
    data: {
        "clanid" : clanid,
        "_token" : "{{ csrf_token() }}"
    },
    success: function(response) {
        console.log(response);
        if (response.status == "success") {
            $('#notification').addClass('alert-success');
            $('#notificationBody').text('You bumped your clan!');
            $('#notification').show();
            $('#last_bumped').text(response.last_bumped);
            //Update the bump streak counter.
            var streak = parseInt($('#bumps').text());
            $('#bumps').text(streak + 1);
        } else {
            $('#notification').addClass('alert-danger');
            $('#notificationBody').text('You can only bump your clan once every 24 hours!');
            $('#notification').show();
        }
        
    }
    });
}

</script>
@endsection