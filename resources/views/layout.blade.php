<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="title" content="Fortnite Clans">
	<meta name="description" content="Fortnite Clans! Find Clans and Players for the popular game Fortnite. The best place for fortnite clans and fortnite players to connect.">
	<meta name="keywords" content="Fortnite, Fortnite Clan, Fortnite Clans, Clan, Clans, Fort Nite, Fort Night, Fortnight">
	<meta name="robots" content="index, follow">

	<meta property="og:type" content="business.business">
	<meta property="og:title" content="Fortnite Clan">
	<meta property="og:url" content="https://fortniteclan.com/">
	<meta property="og:image" content="https://fortniteclan.com/images/fortniteclanog.png">

	<title>Fortnite Clan | @yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
	 crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Luckiest+Guy&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}" /> 
	@yield('headers')
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark navbg p-2">
		<a class="navbar-brand" href="/"><img src="{{ asset('images/logo.png') }}" class="logo" alt="Fortnite Clans"/></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
			aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			{{-- <div class="row m-0">
				<a href="https://discord.gg/dY2vHM6" target="_blank">
					<button class="btn discord social"><i class="fab fa-discord"></i></button>
				</a>
				<a href="https://twitter.com/fortniteclancom" target="_blank">
					<button class="btn twitter social"><i class="fab fa-twitter"></i></button>
				</a>
				<a href="https://www.instagram.com/fortniteclancom/" target="_blank">
					<button class="btn instagram social"><i class="fab fa-instagram"></i></button>
				</a>
				<a href="https://fb.me/fortniteclancom" target="_blank">
					<button class="btn facebook social"><i class="fab fa-facebook-f"></i></button>
				</a>
			</div> --}}
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="/"><i class="fas fa-home"></i> Home</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="/leaderboard"><i class="fas fa-star"></i> Clan Leaderboard</a>
				</li>
				
				@if(!Auth::user())
				<li class="nav-item active">
					<a class="nav-link" href="/addclan"><i class="fas fa-plus"></i> Add Clan</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="/register"><i class="fas fa-user-plus"></i> Sign Up</a>
				</li>
				@elseif($userclan)
				<li class="nav-item active" >
					<a class="nav-link" href="/editclan"><i class="fas fa-pencil-alt"></i> Edit Clan</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="/clan/{{str_replace(' ', '-', $userclan->name)}}"><i class="fas fa-eye"></i> View Clan</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="/clan-dashboard"><i class="fas fa-chart-line"></i> Clan Dashboard</a>
				</li>
				@else
				<li class="nav-item active">
					<a class="nav-link" href="/addclan"><i class="fas fa-plus"></i> Add Clan</a>
				</li>
				@endif
				@auth
				<li class="nav-item active">
					<a class="nav-link" href="/myaccount"><i class="fas fa-user"></i> My Account</a>
				</li>
					@if(!Auth::user()->hasVerifiedEmail())
						<a href="/email/verify"> <button class="btn btn-info my-2 my-sm-0" type="submit">Verify Account</button></a>
					@endif
				@endauth
			</ul>
			@if(Auth::user())
			<a href="/logout"> <button class="btn btn-warning my-2 my-sm-0" type="submit">Logout <i class="fas fa-sign-out-alt"></i></button></a>
			@else
			<a href="/login"><button class="btn btn-primary my-2 my-sm-0" type="submit">Sign In</button></a>				
			@endif
		</div>
	</nav>
	<div class="wrapper">
		<main>
			@yield('content')
		</main>
		<footer class="container-fluid font-small pt-4 px-4 pb-1">
			<div class="container-fluid text-center text-md-left">
				<div class="row justify-content-center">
					<div class="col-md-6 mt-md-0 mt-3">
						<h5>Fortnite Clan</h5>
						<hr>
						<p>Welcome to Fortnite Clan, the best place to find Clans and Communities to join to take your Fortnite experience to
							the next level. If you are a Clan owner you can submit your clan to this website and tell the Fortnite community that
							you exist! Don't get caught out in Tilted Towers without your Clan mates!</p>
					</div>

					<div class="col-md-3 mb-md-0 mb-3">
						<h5>Links</h5>
						<hr>
						<ul id="links" class="list-unstyled d-flex flex-column">
							<li class="nav-item">
								<a class="nav-link" href="/">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/leaderboard">Leaderboard</a>
							</li>
							@guest
							<li class="nav-item">
								<a class="nav-link" href="/register">Sign Up</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/login">Sign In</a>
							</li>
							@endguest
						</ul>

					</div>
					<div class="col-md-3 mb-md-0 mb-3">
						<h5>Social</h5>
						<hr>
						<div class="row justify-content-center">
							<a href="https://discord.gg/dY2vHM6" target="_blank">
									<button class="btn discord social"><i class="fab fa-discord"></i></button>
							</a>
							<a href="https://twitter.com/fortniteclancom" target="_blank">
									<button class="btn twitter social"><i class="fab fa-twitter"></i></button>
							</a>
							<a href="https://www.instagram.com/fortniteclancom/" target="_blank">
									<button class="btn instagram social"><i class="fab fa-instagram"></i></button>
							</a>
							<a href="https://fb.me/fortniteclancom" target="_blank">
									<button class="btn facebook social"><i class="fab fa-facebook-f"></i></button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	@yield('scripts')
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-123158934-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-123158934-1');
	</script>
	<script src='https://www.google.com/recaptcha/api.js'></script> 
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
	 crossorigin="anonymous"></script>
	@yield('footers')
</body>

</html>