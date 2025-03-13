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
                            <button class="btn btn-success mr-2" data-toggle="modal" data-target="#modalImport">
                                <i class="fa fa-upload"></i> Import
                            </button>
                            <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#modalCreate">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
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


@section('modal')
    <div class="modal fade" id="modalCreate" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formCreate">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-plus"></i> Tambah
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        {!! \App\MyClass\Template::requiredBanner() !!}

                        <div class="form-group">
                            <label> Nama Merek {!! \App\MyClass\Template::requiredBanner() !!} </label>
                            <input type="text" name="brand_name" class="form-control" placeholder="Nama Merek">
                            <span class="invalid-feedback"></span>
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

    <div class="modal fade" id="modalUpdate" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formUpdate">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-pencil-alt"></i> Edit
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        {!! \App\MyClass\Template::requiredBanner() !!}

                        <div class="form-group">
                            <label> Nama Merek {!! \App\MyClass\Template::requiredBanner() !!} </label>
                            <input type="text" name="brand_name" class="form-control" placeholder="Nama Merek Barang">
                            <span class="invalid-feedback"></span>
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

    {{-- <div class="modal fade" id="modalImport" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formImport">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-upload"></i> Import
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="p-1">
                            <p class="mb-2"> Catatan : </p>
                            <ul class="pl-4">
                                <li> Import wajib menggunakan template yg kita sediakan. </li>
                                <li> Download template dengan <a
                                        href="{{ route('import_templates', 'Template_Merek.xlsx') }}" download> Klik
                                        Disini </a>. </li>
                                <li> Kolom dengan background merah wajib diisi. </li>
                            </ul>
                        </div>


                        {!! Template::requiredBanner() !!}

                        <div class="form-group">
                            <label> File {!! Template::required() !!} </label>
                            <input type="file" name="file_excel" class="form-control">
                            <span class="invalid-feedback"></span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Tutup
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-upload mr-1"></i> Import
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div> --}}
@endsection


@section('scripts')
@endsection
