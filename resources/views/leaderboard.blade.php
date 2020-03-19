@extends('layout') 
@section('title', 'Fortnite Clans Leaderboard')
@section('content')
<div id="paralax"
        class="jumbotron jumbotron-fluid align-items-center d-flex flex-column justify-content-center align-content-center leaderboard">
    <h1 class="display-3 text-center text-uppercase">
        Fortnite Clan Leaderboard
    </h1>
    <h6 class="display-5">
        <strong>Most Voted Fortnite Clans</strong>
    </h6>
</div>
<div class="container-fluid">
     <div class="row justify-content-center mt-2">
        <div class="col-12 col-lg-10 col-xl-8 px-1">
            <div class="alert alert-success d-flex flex-column" role="alert">
                <h4 class="alert-heading text-bold text-center mx-auto">Monthly Reset!</h4>
                <p>
                    Every month the votes on each clan will be reset to zero. This gives every clan a chance to compete for the top spots. Don't worry! Your members and fans can vote for your clan again! 
                </p>
            </div>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                    <th class="text-center" scope="col">Rank</th>
                    <th class="text-center" scope="col">Logo</th>
                    <th class="text-center" scope="col">Clan</th>
                    <th class="text-center" scope="col">Votes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clans as $clan)
                    <tr>
                        <th class="text-center align-middle" scope="row">{{$clan->rank}}</th>
                        <td class="d-flex justify-content-center align-items-center">
                            <a href="/clan/{{str_replace(' ', '-', $clan->name)}}" />
                                <div style="width:50px; height:50px; border:2px solid rgba(255,255,255,0.4); border-radius: 50%; background: url('../images/{{$clan->picture}}'); background-size: auto 50px; background-position: center;"></div>
                            </a>
                        </td>
                        <td class="align-middle">
                            <a href="/viewclan/{{$clan->id}}/{{str_slug($clan->name)}}" class="text-decoration-none" />
                                <h6 class="text-center">{{$clan->name}}</h6>
                            </a>
                        </td>
                        <td class="text-center align-middle">{{$clan->total_votes()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

     </div>
     <div class="row justify-content-center">
          {{ $clans->links() }}
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