@extends('layouts.template')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-lg-4 col-md-12">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-user text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category"> Total User </p>
                                    <h4 class="card-title"> {{ $totalUser }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-user text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category"> Total Wisata </p>
                                    <h4 class="card-title"> {{ $totalWisata }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-user text-primary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category"> Lowongan pekerjaan </p>
                                    <h4 class="card-title"> {{ $totalLoker }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <canvas id="userLineChart" width="400" height="150"></canvas>
        <canvas id="lokerBarChart" width="400" height="150"></canvas>


    </div>
@endsection


@section('scripts')
    <script>
        $(function() {
            $('#dataTable').DataTable();
        })

        // Line Chart - User per bulan
        const userLineCtx = document.getElementById('userLineChart');
        new Chart(userLineCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(
                    array_values($userPerMonth->keys()->map(fn($b) => \Carbon\Carbon::create()->month($b)->format('F'))->toArray()),
                ) !!},
                datasets: [{
                    label: 'User Mendaftar per Bulan',
                    data: {!! json_encode(array_values($userPerMonth->toArray())) !!},
                    borderColor: 'blue',
                    tension: 0.3,
                    fill: false
                }]
            }
        });

        // Bar Chart - Jenis Loker
        const lokerBarCtx = document.getElementById('lokerBarChart');
        new Chart(lokerBarCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($jenisLoker->keys()) !!},
                datasets: [{
                    label: 'Jumlah Lowongan',
                    data: {!! json_encode($jenisLoker->values()) !!},
                    backgroundColor: '#3a37ed'
                }]
            },
            options: {
                indexAxis: 'y'
            }
        });
    </script>
@endsection
