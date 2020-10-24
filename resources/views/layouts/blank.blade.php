<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="title" content="Fortnite Clans">

	<meta name="description" content="Fortnite Clans! Find Clans, Teams, and Players for the popular game Fortnite. The best place for fortnite clans, teams, and players to connect.">

	<meta name="keywords" content="Fortnite, Fortnite Clan, Fortnite Team, Fortnite Teams, Fortnite Clans, Team, Teams, Esports, Clan, Clans, Fort Nite, Fort Night, Fortnight">

	<meta name="robots" content="index, follow">



	<meta property="og:type" content="business.business">

	<meta property="og:title" content="@yield('ogtitle','Fortnite Clan')">

	<meta property="og:url" content="@yield('ogurl','https://fortniteclan.com/')'">

	<meta property="og:image" content="@yield('ogimage','https://fortniteclan.com/images/fortniteclanog.png')">

	<meta property="og:description" content="@yield('ogdesc','Fortnite Clans! Find Clans and Players for the popular game Fortnite. The best place for fortnite clans and fortnite players to connect.')'">



	<title>@yield('title')</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	@yield('headers')

	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"

	 crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=Montserrat|Luckiest+Guy&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('css/app.css') }}" /> 

	<script type="application/ld+json">

		{

		  "@context": "http://schema.org",

		  "@type": "Organization",

		  "name": "Fortnite Clan",

		  "url": "https://fortniteclan.com/",

		  "address": "",

		  "sameAs": [

			"https://www.facebook.com/fortniteclancom",

			"https://twitter.com/fortniteclancom",

			"https://www.instagram.com/fortniteclancom/",

			"https://www.youtube.com/channel/UCVc-EF-05bkHMXbuA0O1L1g"

		  ]

		}

	  </script>

	

</head>



<body>

    <main>

        @yield('content')

    </main>

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