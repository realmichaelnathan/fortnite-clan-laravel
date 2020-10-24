@extends('layout') 
@section('title', 'Fortnite Clans Leaderboard')
@section('content')

<style>
    .shoutBoxContainer {
        height: 400px !important;
    }
    .shoutServerText {
        display:none !important;
    }
    .shoutInput input {
        padding: 10px !important;
    }
    .shoutChat {
        margin: 10px 5px !important;
    }
    div.shoutText {
        padding: 3px !important;
        margin: 2px 1px !important;
        font-size: 1.5em !important;
        border: none !important;

    }
    div.shoutText:hover {
        background: none !important;
    }
    .shoutUserText {
        font-size:unset !important;
    }
    .shoutBoxHeader {
        box-shadow: unset !important;
        border: unset !important;
        padding: 5px !important;
        color: #000 !important;
    }
    .adminCog {
        color: #000 !important;
        top: 12px !important;
    }
    .configPanel {
        color: #000 !important;
    }
    .shoutBoxAvatar {
        height: 35px !important;
        width: 35px !important;
    }
</style>
<div id="paralax"
        class="jumbotron jumbotron-fluid align-items-center d-flex flex-column justify-content-center align-content-center leaderboard" style="height: 200px;">
    <h1 class="display-2 text-center text-uppercase">
        Fortnite Clan Chat
    </h1>
</div>
<div class="container-fluid">
     <div class="row justify-content-center mt-2">
        <div class="col-12 col-lg-10 col-xl-8 px-1">
            <script src="https://www.shoutbox.com/chat/chat.js.php"></script>
            <script>
            
            @if(Auth::check()) 
            var user = '{{Auth::User()->name}}';
            var avatar = 'https://fortniteclan.com/images/users/'+'{{Auth::User()->profilepic}}';
            @else
            var user = '';
            var avatar = '';
            @endif
            var chat = new Chat(14494, user, avatar);
            @if(!Auth::check())
                document.getElementById('shoutBoxInput').style.backgroundColor = 'gray';
                document.getElementById('shoutBoxInput').style.color = 'white';
                document.getElementById('shoutBoxInput').disabled = 'disabled';
                document.getElementById('shoutBoxInput').value = 'PLEASE LOGIN TO CHAT';
            @endif
            
            </script>
            
        </div>
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
</div>

@endsection