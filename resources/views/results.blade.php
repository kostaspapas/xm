@extends('layouts.app')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                "Open/Cloce prices" chart
            </div>
            <div class="card-body">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
        </div>

        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {{ $historical_dates }},
                    datasets: [{
                            label: 'open',
                            data: {{ json_encode($historical_open_prices) }},
                            borderColor: '#ffa500',
                            backgroundColor: '#ffc04d',
                            fill: false,
                        },{
                            label: 'close',
                            data: {{ json_encode($historical_close_prices) }},
                            borderColor: '#c45850',
                            backgroundColor: '#d78f89',
                            fill: false,
                        }
                    ]
                }
            });
        </script>

        <div class="card">
            @if (count($historical_quotes) > 1)
            <div class="card-header text-center font-weight-bold">
                Results
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Open</th>
                            <th scope="col">High</th>
                            <th scope="col">Low</th>
                            <th scope="col">Close</th>
                            <th scope="col">Volume</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historical_quotes as $quote)
                            <tr>
                                <td scope="row">{{ $quote['date'] }}</td>
                                <td scope="row">{{ $quote['open'] }}</td>
                                <td scope="row">{{ $quote['high'] }}</td>
                                <td scope="row">{{ $quote['low'] }}</td>
                                <td scope="row">{{ $quote['close'] }}</td>
                                <td scope="row">{{ $quote['volume'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="card-header text-center font-weight-bold">
                    No results to show
                </div>
            @endif
        </div>

    </div>
@endsection
