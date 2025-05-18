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
                                    {{-- <h4 class="card-title"> {{ \App\Models\Transaction::totalIncomeFormatted() }} </h4> --}}
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
                                    <p class="card-category"> Total Wisata  </p>
                                    {{-- <h4 class="card-title"> {{ \App\Models\Transaction::totalExpenseFormatted() }} </h4> --}}
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
                                    {{-- <h4 class="card-title"> {!! \App\Models\Transaction::totalBalanceFormattedHtml() !!} </h4> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <span class="d-inline-block">
                                Rekap Pemasukan dan Pengeluaran Per Grup Transaksi
                            </span>
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover dt">
                                <thead>
                                    <tr>
                                        <th> Grup Transaksi </th>
                                        <th> Pemasukan </th>
                                        <th> Pengeluaran </th>
                                        <th> Saldo </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(auth()->user()->getTransactionGroups() as $group)
                                        <tr>
                                            <td>
                                                <b> {{ $group->transaction_group_name }} </b>
                                            </td>
                                            <td class="text-success"> {{ $group->totalIncomeFormatted() }} </td>
                                            <td class="text-danger"> {{ $group->totalExpenseFormatted() }} </td>
                                            <td> {!! $group->totalBalanceFormattedHtml() !!} </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" align="center"> Kosong </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}


    </div>
@endsection


@section('scripts')
    <script>
        $(function() {
            $('#dataTable').DataTable();
        })
    </script>
@endsection
