@extends('layout') 
@section('title', 'Fortnite Clans') 
@section('content')
{{-- <div class="row justify-content-center mt-3">
     <div id="carouselCaptions" class="carousel slide w-100 px-1" data-ride="carousel">
         <ol class="carousel-indicators">
             <li data-target="#carouselCaptions" data-slide-to="0" class="active"></li>
             <li data-target="#carouselCaptions" data-slide-to="1"></li>
             <li data-target="#carouselCaptions" data-slide-to="2"></li>
         </ol>
         <div class="carousel-inner w-100">
             @foreach($news->data->motds as $index => $newsItem)
                 <div class="carousel-item @if($index == 0) active @endif" style="width: 100%; max-height: 300px; backgroud-color:black;">
                     <img src="{{ $newsItem->tileImage }}" class="w-100" alt="..." style="opacity: 60%;">
                     <div class="carousel-caption d-none d-md-block">
                         <h5 class="display-4 font-weight-bold">
                             {{ strlen($newsItem->id) > 25 ? $newsItem->title : $newsItem->id }}
                         </h5>
                         <p class="font-weight-bold">{{ $newsItem->body }}</p>
                     </div>
                     <div class="carousel-caption d-block d-md-none">
                         <h5 class="font-weight-bold">{{ strlen($newsItem->id) > 25 ? $newsItem->title : $newsItem->id }}</h5>
                         <small class="font-weight-bold">{{ $newsItem->body }}</small>
                     </div>
                 </div>
             @endforeach
         </div>
         <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
             <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
             <span class="carousel-control-next-icon" aria-hidden="true"></span>
             <span class="sr-only">Next</span>
         </a>
     </div>
 </div> --}}

<div class="row mt-3 px-1">
     <div class="col-12 col-md-6 col-lg-4 mb-sm-0 px-0 pr-md-1">
         <h4>Top Voted Clans</h4>
         <ul class="list-group">
              @foreach($top_voted_clans as $top_voted_clan)
             <li class="list-group-item d-flex justify-content-between align-items-center">
                 <div class="d-flex align-items-center">
                    <a href="/clan/{{$top_voted_clan->slug}}" class="mr-2 stretched-link">
                         <div style="width:30px; height:30px; border:2px solid rgba(255,255,255,0.4); border-radius: 50%; background: url('../images/{{$top_voted_clan->picture}}'); background-size: auto 30px; background-position: center;"></div>
                     </a>
                    {{$top_voted_clan->name}}
                 </div>
                 <span class="badge badge-success badge-pill">{{$top_voted_clan->votes}}</span>
             </li>
             @endforeach
         </ul>
         <a href="/leaderboard" class="btn btn-block btn-success mt-2">View Leaderboard</a>
     </div>
     <div class="col-12 col-md-6 col-lg-4 mb-2 mb-lg-0 px-0 pl-md-1 px-lg-1 mt-3 mt-md-0">
         <h4>Newest Clans</h4>
         <ul class="list-group">
              @foreach($newest_clans as $newest_clan)
             <li class="list-group-item d-flex justify-content-between align-items-center">
                 <div class="d-flex align-items-center">
                    <a href="/clan/{{$newest_clan->slug}}" class="mr-2 stretched-link">
                         <div style="width:30px; height:30px; border:2px solid rgba(255,255,255,0.4); border-radius: 50%; background: url('../images/{{$newest_clan->picture}}'); background-size: auto 30px; background-position: center;"></div>
                     </a>
                     {{$newest_clan->name}}
                 </div>
                 <span class="badge badge-warning">New</span>
             </li>
             @endforeach
         </ul>
         <button class="btn btn-block btn-warning mt-2">View Newest Clans</button>
     </div>
     <div class="col-12 col-lg-4 px-0 pl-lg-1">
         <div class="bg-secondary w-100 h-100 d-flex justify-content-center align-items-center">
               <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
               <!-- fnclan 300x250 block -->
               <ins class="adsbygoogle"
                    style="display:inline-block;width:300px;height:250px"
                    data-ad-client="ca-pub-9720848360917466"
                    data-ad-slot="9242259185"></ins>
               <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
               </script>
         </div>
     </div>
</div>
<div class="row px-1">
     <h4 class="mt-3">Active Fortnite Clans</h4>
</div>
<div class="row flex-wrap">
     @foreach($clans as $clan)
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-1">
               <article class="card w-100 p-1" @if($clan->bumps > 4) style="background: white;" @endif>
                    <a href="/clan/{{$clan->slug}}" class="text-white">
                         <div class="clan-image-hover-container embed-responsive embed-responsive-16by9">
                              @if($clan->bumps > 9)
                                   <div class="active-clan">RECOMMENDED CLAN</div>
                              @endif
                              <img class="card-img-top clan-thumbnail-image embed-responsive-item" src="images/{{$clan->picture}}" alt="{{$clan->name}} Fortnite Clan" loading="lazy">
                         </div>
                         <div class="card-header" @if($clan->bumps > 19) style="background: linear-gradient(45deg, #93900d, #ddbb6c);" @endif>
                              <h5 class="card-title text-center m-0">{{$clan->name}}</h5>
                         </div>
                    </a>
               </article>
          </div>
     @endforeach
</div>
<div class="row justify-content-center mt-3">
     {{ $clans->onEachSide(1)->links() }}
</div>
<div class="row my-3 justify-content-center">
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