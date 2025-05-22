@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class="d-inline-block">
                            {{ $title ?? 'Judul' }}
                        </span>
                        <div class="float-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
                                <i class="fa fa-plus mr-2"></i>Tambah
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th> Nama Restoran</th>
                                <th> Kategori </th>
                                <th> Kontak </th>
                                <th> Latitude </th>
                                <th> Longitude </th>
                                <th> Jam Buka </th>
                                <th> Jam Tutup </th>
                                <th> Alamat </th>
                                <th> Deskripsi </th>
                                <th> Gambar </th>
                                <th width="100"> Aksi </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th> Nama Restoran</th>
                                <th> Kategori </th>
                                <th> Kontak </th>
                                <th> Latitude </th>
                                <th> Longitude </th>
                                <th> Jam Buka </th>
                                <th> Jam Tutup </th>
                                <th> Alamat </th>
                                <th> Deskripsi </th>
                                <th> Gambar </th>
                                <th width="100"> Aksi </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    <div class="modal fade" id="modalCreate" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="formCreate" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-plus mr-2"></i> Tambah
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        {!! App\MyClass\Template::requiredBanner() !!}

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nama Restoran {!! App\MyClass\Template::required() !!}</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nama Restorran">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Kategori {!! App\MyClass\Template::required() !!}</label>
                                    <input type="text" name="category" class="form-control" placeholder="Kategori">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Kontak {!! App\MyClass\Template::required() !!}</label>
                                    <input type="text" name="contact" class="form-control" placeholder="Masukan kontak">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" name="latitude" class="form-control" placeholder="-6.20000000">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" name="longitude" class="form-control" placeholder="106.81666667">
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Jam Buka</label>
                                    <input type="time" name="start_time" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Jam Tutup</label>
                                    <input type="time" name="end_time" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Gambar restoran</label>
                                    <input type="file" name="image" class="form-control-file form-control">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Alamat {!! App\MyClass\Template::required() !!}</label>
                                    <textarea name="address" class="form-control" placeholder="Masukan alamat" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Deskripsi {!! App\MyClass\Template::required() !!}</label>
                                    <textarea name="description" class="form-control" placeholder="Deskripsi Wisata" rows="4"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Tutup
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const $modalCreate = $('#modalCreate');
            const $formCreate = $('#formCreate');
            const $formCreateSubmitBtn = $formCreate.find(`[type="submit"]`).ladda();


            $('#dataTable').DataTable({
                processing: true,
                serveSide: true,
                autoWidth: false,
                ajax: {
                    url: `{{ route('restaurant') }}`,
                },
                columns: [{
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'category',
                    name: 'category',
                }, {
                    data: 'contact',
                    name: 'contact',
                }, {
                    data: 'latitude',
                    name: 'latitude',
                }, {
                    data: 'longitude',
                    name: 'longitude',
                }, {
                    data: 'start_time',
                    name: 'start_time'
                }, {
                    data: 'end_time',
                    name: 'end_time',
                }, {
                    data: 'address',
                    name: 'address',
                }, {
                    data: 'description',
                    name: 'description'
                }, {
                    data: 'image',
                    name: 'image'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }]
            });
        });
    </script>
@endsection
