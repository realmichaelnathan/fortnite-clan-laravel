
@extends('layout') 
@section('title', 'Find your next Fortnite clan here!') 
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script type="text/javascript">

var days = {{ $userstats->map(function ($stat) { return $stat->day;})->toJson() }};
var newUsers = {{ $userstats->map(function ($stat) { return $stat->count;})->toJson() }};
var newClans = {{ $userstats->map(function ($stat) { return $stat->clancount;})->toJson() }};

var clans = {!! $clanViews->map(function ($clan) { return $clan->name;})->toJson() !!};
var views = {{ $clanViews->map(function ($clan) { return $clan->views;})->toJson() }};

var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: days,
        datasets: [{
            label: 'New Users',
            backgroundColor: 'rgb(0, 102, 204)',
            borderColor: 'rgb(255, 255, 255)',
            data: newUsers,
        },{
            label: 'New Clans',
            backgroundColor: 'rgb(102, 0, 204)',
            borderColor: 'rgb(255, 255, 255)',
            data: newClans
        }
        
        ]
    },

    // Configuration options go here
    options: {
        responsive: true,
				title: {
					display: true,
					text: 'November'
				},
				scales: {
					xAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Day'
						}
					}],
					yAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Registrations'
						},
                        ticks: {
                            beginAtZero: true
                        }
					}]
				}
    }
});

Chart.defaults.global.defaultFontColor = '#bdc3c7';
var cvcanvas = document.getElementById('clan-views').getContext('2d');
var clanViewsChat = new Chart(cvcanvas, {
    // The type of chart we want to create
    type: 'horizontalBar',

    // The data for our dataset
    data: {
        labels: clans,
        datasets: [{
            label: 'Clan Views',
            backgroundColor: 
            ['rgb(0, 152, 204, 0.7)','rgb(0, 102, 254, 0.7)','rgb(50, 102, 204, 0.7)','rgb(50, 152, 204, 0.7)','rgb(50, 102, 254, 0.7)','rgb(0, 152, 254, 0.7)',
            'rgb(50, 152, 254, 0.7)',],
            borderColor: 'rgb(255, 255, 255)',
            data: views,
        }]
    },

    // Configuration options go here
    options: {
        responsive: true,
				title: {
					display: true,
					text: 'Most Viewed Clans'
				},
				scales: {
					xAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Views'
						},
                        ticks: {
                            beginAtZero: true
                        }
					}],
					yAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Clans'
						}
					}]
				}
    }
});

</script>
@endsection

@section('content')
<style>
        .discord, .twitter, .instagram {
            overflow:hidden;
            border: none;
        }
        .discord span, .instagram span, .twitter span, div.card small {
            z-index:20;
            text-align:right;
            color: #fff;
            font-weight:bold;
        }
        div.discord i, div.instagram i, div.twitter i {
            z-index: 10;
            font-size: 175px;
            color: rgba(255, 255, 255, 0.206);
            position: absolute;
            top:10px;
            margin:auto;
        }
        @media (max-width: 800px) {
            span.display-2 {
                font-size: 35px;
            }
            div.discord i, div.instagram i, div.twitter i {
                z-index: 10;
                font-size: 125px;
                color: rgba(255, 255, 255, 0.206);
                position: absolute;
                top:10px;
                margin:auto;
            }   
        }

    </style>
<div class="container my-2 col-12 col-sm-10 col-md-8 col-lg-6">
    <div class="row">
        <div class="col-4 p-1">
            <div class="card discord p-3">
                <span class="display-2">
                    {{$socials["discord"]}}
                </span>
                <small>Members</small>
                <i class="fab fa-discord"></i>
            </div>
        </div>
        <div class="col-4 p-1">
            <div class="card instagram p-3">
                <span class="display-2">
                    {{$socials["instagram"]}}
                </span>
                <small>Followers</small>
                <i class="fab fa-instagram"></i>
            </div>
        </div>
        <div class="col-4 p-1">
            <div class="card twitter p-3">
                <span class="display-2">
                    {{$socials["twitter"]}}
                </span>
                <small>Followers</small>
                <i class="fab fa-twitter"></i>
            </div>
        </div>
    </div>
</div>
<div class="container col-12 col-sm-10 col-md-8 col-lg-6">
    <div class="row">
        <canvas id="myChart"></canvas>
    </div>
    <div class="row">
        <canvas id="clan-views"></canvas>
    </div>
</div>
@endsection