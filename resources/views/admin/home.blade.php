@extends('layouts.app')

@section('content')
<div class="container overflow-hidden">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}

    {{-- MESSAGES/REVIEWS PER MONTHS --}}
    <div class="row py-3 text-center">
        <div class="col-12 col-md-6 p-3 text-center chart-container">
            <h4 class="py-2">Messaggi ricevuti per mese</h4>
            <canvas id="MessageChart" class="rounded shadow my_canvas"></canvas>
        </div>
        <div class="col-12 col-md-6 p-3 text-center chart-container">
            <h4 class="py-2">Recensioni ricevute per mese</h4>
            <canvas id="ReviewChart" class="rounded shadow my_canvas"></canvas>
        </div>
            
    </div>

    {{-- MESSAGES/REVIEWS PER YEARS --}}
    <div class="row py-3">
        <div class="col-12 col-md-6 p-3 text-center chart-container">
            <h4 class="py-2">Messaggi ricevuti per anno</h4>
            <canvas id="MessageChartYear" class="rounded shadow my_canvas"></canvas>
        </div>

        <div class="col-12 col-md-6 p-3 text-center chart-container">
            <h4 class="py-2">Recensioni ricevute per anno</h4>
            <canvas id="ReviewChartYear" class="rounded shadow my_canvas"></canvas>
        </div>
    </div>
    
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // REVIEWS
    var ctx = document.getElementById('ReviewChart').getContext('2d');
    var ctx_year = document.getElementById('ReviewChartYear').getContext('2d');

    // MESSAGES
    var ctx1 = document.getElementById('MessageChart').getContext('2d');
    var ctx1_year = document.getElementById('MessageChartYear').getContext('2d');

    // Reviews per month
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',
        // The data for our dataset
        data: {
            labels:  {!! json_encode($monthsR)!!} ,
            datasets: [
                {
                    label: 'Reviews per month', 
                    data:  {!! json_encode($monthCountReview)!!},
                    backgroundColor: ["rgba(44, 64, 101,0.4)","rgba(44, 64, 101,0.6)","rgba(44, 64, 101,0.7)"],
                    fill:true
                },
            ]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });

    // Reviews per year
    var chart = new Chart(ctx_year, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels:  {!! json_encode($yearsR)!!} ,
            datasets: [
                {
                    label: 'Recensioni ricevute per anno', 
                    data:  {!! json_encode($yearCountReview)!!},
                    backgroundColor: ["rgb(44, 64, 101)"],
                },
            ]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });

    // Messages per month
    var chart = new Chart(ctx1, {
        // The type of chart we want to create
        type: 'doughnut',
        // The data for our dataset
        data: {
            labels:  {!! json_encode($monthsM)!!} ,
            datasets: [
                {
                    label: 'Message per month', 
                    data:  {!! json_encode($monthCountMessage)!!},
                    backgroundColor: ["rgba(131, 53, 76,0.4)","rgba(131, 53, 76,0.6)","rgba(131, 53, 76,0.7)"],
                    fill:true
                },
            ]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });

    // Messages per year
    var chart = new Chart(ctx1_year, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels:  {!! json_encode($yearsM)!!} ,
            datasets: [
                {
                    label: 'Messaggi ricevuti per anno', 
                    data:  {!! json_encode($yearCountMessage)!!},
                    backgroundColor: ["rgb(131, 53, 76)"],
                },
            ]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });


</script>


@endsection
