@extends('layout') 
@section('title', 'Find your next clan here!') 
@section('content')
<div id="paralax"
        class="jumbotron jumbotron-fluid align-items-center d-flex flex-column justify-content-center align-content-center">
     <div class="container-fluid jumbotron-content px-3">
          @if(!Auth::user())
          <h1 class="display-5 text-center text-uppercase">
               Looking For a Fortnite Clan?
          </h1>
          <p>
               Welcome to the best place to find Fortnite Clans and Communities to join to take your Fortnite game playing experience to the next level. 
               If you are a Forntnite Clan Owner you can promote your Clan on this website! 
               Tell the Fortnite community that you exist!

          </p>
          <p> 
               If you are a Fortnite Player looking for a Fortnite Clan then have a look at all the clans on 
               this website and choose the best one! 
               Don't get caught out in Sweaty Sands without your Clan mates!
          </p>

          <a href="/register">
               <button class="btn btn-primary btn-lg">Sign Up</button>
          </a>
          @else
          <h1 class="display-5 text-center text-uppercase">
               Join Us On Discord!
          </h1>
          <p>
               Do you want to connect with other Fortnite Players and Clan Owners? Join us on our Discord Server to connect with like minded people 
               in a life chat environment. Promote your Clan or Find a Clan by talking to people in our Discord Server! Click the button below to join!
          </p>
          <a href="https://discord.gg/dY2vHM6">
               <button class="btn discord btn-lg">Join Discord</button>
          </a>
          @endif
     </div>
</div>
<div class="container-fluid">
     <div class="row justify-content-center mt-2">
          @foreach($clans as $clan)
          <?php 
            $description = str_limit(strip_tags($clan->description), 210);
            $description = html_entity_decode($description);
            ?>
          <div class="card m-2 card-size p-1" @if($clan->bumps > 4) style="background: white;" @endif>
               <a href="/clan/{{str_replace(' ', '-', $clan->name)}}" class="text-white">
                    <div class="clan-image-hover-container">
                         @if($clan->bumps > 9)
                         <div class="active-clan">RECOMMENDED CLAN</div>
                         @endif
                         <img class="card-img-top clan-thumbnail-image" src="images/{{$clan->picture}}" alt="{{$clan->name}} Fortnite Clan">
                         <div class="clan-image-hover-div">
                              <p class="card-text p-3 m-0">{{$description}} </p>
                         </div>
                    </div>
                    <div class="card-header clan-title-card-header">
                         <h5 class="card-title text-center m-0">{{$clan->name}}</h5>
                    </div>
               </a>
          </div>
          @endforeach
     </div>
     <div class="row justify-content-center">
          {{ $clans->links() }}
     </div>
</div>
@endsection