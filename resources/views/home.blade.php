@extends('layouts.master')
@section('title','Dahsboard')
@section('content')
@if(Auth::user()->level=='admin')
<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body ">
                <div class="row">
                    <div class="col-4">
                        <div class="icon-big text-center">
                            <i class="flaticon-user-1 text-warning"></i>
                        </div>
                    </div>
                    <div class="col-8 col-stats">
                        <div class="numbers">
                            <p class="card-category">Karyawan</p>
                            <h4 class="card-title">{{$user}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body ">
                <div class="row">
                    <div class="col-4">
                        <div class="icon-big text-center">
                            <i class="flaticon-cart text-primary"></i>
                        </div>
                    </div>
                    <div class="col-8 col-stats">
                        <div class="numbers">
                            <p class="card-category">Transaksi</p>
                            <h4 class="card-title">{{$order}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="icon-big text-center">
                            <i class="flaticon-users text-danger"></i>
                        </div>
                    </div>
                    <div class="col-8 col-stats">
                        <div class="numbers">
                            <p class="card-category">Customer</p>
                            <h4 class="card-title">{{$customer}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="icon-big text-center">
                            <i class="flaticon-coins text-success"></i>
                        </div>
                    </div>
                    <div class="col-8 col-stats">
                        <div class="numbers">
                            <p class="card-category">Pendapatan</p>
                            <h4 class="card-title">
                                {{Rupiah::getRupiah($total->sum('harga_akhir') + $eks_adm->sum('spotting') + $eks_adm->sum('ongkir'))}}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(Auth::user()->level=='karyawan')
<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="flaticon-cart text-primary"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Transaksi</p>
                            <h4 class="card-title">{{$kry_order}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="flaticon-clock text-danger"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Diproses</p>
                            <h4 class="card-title">{{$proses}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="flaticon-success text-success"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Selesai</p>
                            <h4 class="card-title">{{$selesai}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="icon-big text-center">
                            <i class="flaticon-coins text-dark"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Pendapatan</p>
                            <h4 class="card-title">
                                {{Rupiah::getRupiah($kry_total->sum('harga_akhir') + $eks->sum('spotting') + $eks->sum('ongkir'))}}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="row mt--2">
    <div class="col-md-6">
        <div class="card full-height">
            <div class="card-body">
                @if (Auth::user()->level=='admin')
                <div class="card-title">Perbandingan Pendapatan</div>
                <div id="chart-container">
                    <canvas id="pieChart"></canvas>
                </div>
                @else
                <div class="card-title">Transaksi</div>
                <div id="chart-container">
                    <canvas id="multipleLineChart"></canvas>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card full-height">
            <div class="card-body">
                <div class="card-title">Pendapatan per-bulan
                    <span style="float: right;">Tahun : {{date('Y')}}</span>
                </div>

                <div id="chart-container">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var cek = '{{Auth::user()->level}}';
if (cek == 'admin') {
    var pieChart = document.getElementById('pieChart').getContext('2d');
    let cabang = @json($pie);
    var myPieChart = new Chart(pieChart, {
        type: 'pie',
        data: {
            datasets: [{
                // data: [350, 500, 100],
                data: Object.values(cabang),
                backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b", "#FFF000", "#f2028e"],
                borderWidth: 0
            }],
            labels: Object.keys(cabang)
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels: {
                    fontColor: 'rgb(154, 154, 154)',
                    fontSize: 11,
                    usePointStyle: true,
                    padding: 20
                }
            },
            pieceLabel: {
                render: 'percentage',
                fontColor: 'white',
                fontSize: 14,
            },
            tooltips: false,
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20
                }
            }
        }
    });
}
</script>
<script script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
<script>
var barChart = document.getElementById('barChart').getContext('2d');
let bulan = @json($bar);
var total = Object.values(bulan);
// const formatted = total.map(item => money.format(item));
// console.log(formatted);
var myBarChart = new Chart(barChart, {
    type: 'bar',
    data: {
        labels: Object.keys(bulan),
        datasets: [{
            label: "Pendapatan",
            backgroundColor: 'rgb(23, 125, 255)',
            borderColor: 'rgb(23, 125, 255)',
            data: total
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                }
            }]
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || "";
                        if (label) {
                            label += ": ";
                        }
                        if (context.parsed.y !== null) {
                            label += new Intl.NumberFormat("id-ID", {
                                style: "currency",
                                currency: "IDR",
                            }).format(context.parsed.y);
                        }
                        return label;
                        console.log(label);
                    }
                }
            }
        }
    }
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
var multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');
// var gradientStroke = multipleLineChart.createLinearGradient(500, 0, 100, 0);
// gradientStroke.addColorStop(0, '#80b6f4');
// gradientStroke.addColorStop(1, '#f49080');

// var gradientFill = multipleLineChart.createLinearGradient(500, 0, 100, 0);
// gradientFill.addColorStop(0, "rgba(128, 182, 244, 0.6)");
// gradientFill.addColorStop(1, "rgba(244, 144, 128, 0.6)");
var data = @json($line);
var myMultipleLineChart = new Chart(multipleLineChart, {
    type: 'line',
    data: {
        labels: Object.keys(data),
        datasets: [{
            label: 'Transaksi',
            // borderColor: gradientStroke,
            // pointBorderColor: gradientStroke,
            // pointBackgroundColor: gradientStroke,
            // pointHoverBackgroundColor: gradientStroke,
            // pointHoverBorderColor: gradientStroke,
            borderColor: "#1d7af3",
            pointBorderColor: "#FFF",
            pointBackgroundColor: "#1d7af3",
            pointBorderWidth: 2,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 1,
            pointRadius: 4,
            backgroundColor: 'rgba(63, 176, 236, 0.8)',
            fill: true,
            borderWidth: 2,
            data: Object.values(data)
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'top',
        },
        tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10
        },
        layout: {
            padding: {
                left: 15,
                right: 15,
                top: 15,
                bottom: 15
            }
        }
    }
});
</script>
@endsection