@extends('layout') 
@section('title', $user->name)
@section('ogtitle', $user->name)
@section('ogimage', asset("images/users/$user->profilepic"))
@section('ogdesc', str_limit(strip_tags($user->aboutme), 155))

@section('content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 px-1 flex-fill">
            <div class="row">
                <div class="col-12 col-sm-6 flex-fill">

                        <div class="d-flex flex-column align-items-center">
                            <h1 class="text-center d-block d-sm-none">{{$user->name}}</h1>
                            <div class="rounded-pill" style="border:5px solid rgba(255,255,255,0.4); width:200px; height:200px; background: #3f3f3f7a url('https://fortniteclan.com/images/users/{{$user->profilepic}}'); background-size: auto 200px; background-position: center;"></div>
                           
                                @if(($user->clan) && ($user->votes)  && ($user->clan->id == $user->votes->clan->id))
                                <span class="badge badge-primary p-2 mt-2" style="">OWNER</span>
                                <div class="card d-flex justify-content-center mt-2" style=" flex-direction:row; margin: 2px; padding:0 0 0; font-size:12px; align-items:center; min-width:200px; max-width:250px;">
                                    <div style="width:50px; height:50px; background: #3f3f3f7a url('https://fortniteclan.com/images/{{$user->clan->picture}}'); background-size: auto 50px; background-position: center;"></div>
                                    <div class="d-flex justify-content-center flex-fill" style="padding: 0 10px;">{{$user->clan->name}}</div>
                                    <a href="/clan/{{$user->clan->slug}}" class="stretched-link"> </a>  
                                </div>
                                @elseif($user->votes)
                                <span class="badge badge-secondary p-2 mt-2" style="background: indigo;">SUPPORTER</span>
                                <div class="card d-flex justify-content-center mt-2" style=" flex-direction:row; margin: 2px; padding:0 0 0; font-size:12px; align-items:center; min-width:200px; max-width:250px;">
                                    <div style="width:50px; height:50px; background: #3f3f3f7a url('https://fortniteclan.com/images/{{$user->votes->clan->picture}}'); background-size: auto 50px; background-position: center;"></div>
                                    <div class="d-flex justify-content-center flex-fill" style="padding: 0 10px;">{{$user->votes->clan->name}}</div> 
                                    <a href="/clan/{{$user->votes->clan->slug}}" class="stretched-link"> </a>
                                </div>
                                @endif
                                <div class="d-flex flex-column align-items-center mt-3">
                                    <span class="font-weight-bold text-small px-4 text-center w-100">About Me</span>
                                    <p class="px-4" style="font-size:14px;">{{$user->aboutme}}</p>
                                </div>
                        </div>
                   
                </div>
                <div class="col-12 col-sm-6 flex-fill">
                    <div class="d-flex flex-column align-items-center">
                        <h1 class="text-center d-none d-sm-block">{{$user->name}}</h1>
                        <div>
                            <strong>Member since: </strong>
                            <span class="badge badge-pill badge-success p-2" style="font-size:13px;">{{\Carbon\Carbon::parse($user->created_at)->format('d M Y')}}</span>
                        </div>
                        <div class="d-flex flex-column mt-2">
                            @if($user->discord)
                            <div class="card d-flex justify-content-center" style=" flex-direction:row; margin: 2px; padding:0 0 0; font-size:12px; align-items:center; min-width:200px; max-width:250px;">
                                <button class="btn discord social" style="height:38px; width: 38px; font-size:18px;margin:0;">
                                    <i class="fab fa-discord"></i>
                                </button>
                                <div class="d-flex justify-content-center flex-fill" style="padding: 0 10px;">{{$user->discord}}</div>  
                            </div>
                            
                            @endif
                            @if($user->twitter)
                            <div class="card d-flex justify-content-center" style=" flex-direction:row; margin: 2px; padding:0 0 0; font-size:12px; align-items:center; min-width:200px; max-width:250px;">
                                <a 
                                    class="btn twitter social stretched-link" 
                                    style="height:38px; width: 38px; font-size:18px;margin:0;" 
                                    href="@if(strlen($user->twitter) < 20)https://twitter.com/{{$user->twitter}}@else{{$user->twitter}}@endif" 
                                    target="_blank"
                                >
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <div class="d-flex justify-content-center flex-fill" style="padding: 0 10px;">@if(strlen($user->twitter) > 20){{$user->name}}@else{{$user->twitter}}@endif</div>  
                            </div>
                            @endif
                            @if($user->instagram)
                            <div class="card d-flex justify-content-center" style=" flex-direction:row; margin: 2px; padding:0 0 0; font-size:12px; align-items:center; min-width:200px; max-width:250px;">
                                <a 
                                    class="btn instagram social stretched-link" 
                                    style="height:38px; width: 38px; font-size:18px; margin:0;" 
                                    href="@if(strlen($user->instagram) < 20)https://instagram.com/{{$user->instagram}}@else{{$user->instagram}}@endif " 
                                    target="_blank"
                                >
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <div class="d-flex justify-content-center flex-fill" style="padding: 0 10px;">@if(strlen($user->instagram) > 20){{$user->name}}@else{{$user->instagram}}@endif</div>  
                            </div>
                            @endif
                            @if($user->youtube)
                            <div class="card d-flex justify-content-center" style=" flex-direction:row; margin: 2px; padding:0 0 0; font-size:12px; align-items:center; min-width:200px; max-width:250px;">
                                <a class="btn youtube social stretched-link" style="height:38px; width: 38px; font-size:18px; margin:0;" href="{{$user->youtube}}" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                <div class="d-flex justify-content-center flex-fill" style="padding: 0 10px;">{{$user->name}}</div>  
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection