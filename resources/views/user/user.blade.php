@extends('layouts.template')

@section('styles')
@endsection

@section('content')
    <div class="row">

        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="d-inline-block">
                            {{ $title ?? 'Judul' }}
                        </span>
                        <div class="float-right">
                            {{-- <a href="" class="btn btn-primary mr-2" ></a> --}}
                            <a href="{{ route('user.create') }}" class="btn btn-primary mr-2">
                                <i class="fa fa-plus"></i> Tambah
                            </a>
                        </div>
                    </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">

                            <thead>
                                <tr>
                                    <th> NO </th>
                                    <th> Nama </th>
                                    <th> Email </th>
                                    <th> Role </th>
                                    <th width="100"> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th> NO </th>
                                    <th> Nama </th>
                                    <th> Email </th>
                                    <th> Role </th>
                                    <th width="100"> Aksi </th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection



@section('scripts')
    <script>
        $(function() {
            $('#dataTable').DataTable();
        })
    </script>
@endsection
