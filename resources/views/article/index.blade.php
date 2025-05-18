@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="d-inline-block">
                            {{ $title ?? 'Judul' }}
                        </span>
                        <div class="float-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreate"><i
                                    class="fa fa-plus"></i>Tambah</button>
                        </div>
                    </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th> Judul </th>
                                    <th> Isi </th>
                                    <th> Sumber </th>
                                    <th> Tanggal </th>
                                    <th> Gambar </th>
                                    <th width="100"> Aksi </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th> Judul </th>
                                    <th> Isi </th>
                                    <th> Sumber </th>
                                    <th> Tanggal </th>
                                    <th> Gambar </th>
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
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <form id="formCreate" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-plus"></i> Tambah
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        {!! App\MyClass\Template::requiredBanner() !!}

                        <div class="form-group">
                            <label> Judul Berita {!! App\MyClass\Template::required() !!}</label>
                            <input type="text" name="judul" class="form-control" placeholder="Judul berita">
                        </div>

                        <div class="form-group">
                            <label> Sumber Berita {!! App\MyClass\Template::required() !!}</label>
                            <input type="text" name="sumber" class="form-control" placeholder="Sumber berita">
                        </div>
                        <div class="form-group">
                            <label> Tanggal {!! App\MyClass\Template::required() !!}</label>
                            <input type="date" name="tanggal" class="form-control" placeholder="Judul berita">
                        </div>

                        <div class="form-group">
                            <label> Gambar Berita {!! App\MyClass\Template::required() !!} </label>
                            <input type="file" name="image" class="form-control-file form-control">
                        </div>

                        <div class="form-group">
                            <label> Isi {!! App\MyClass\Template::required() !!}</label>
                            <textarea name="isi" class="form-control" placeholder="Isi deskripsi berita" rows="4"></textarea>
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
    $(document).ready(function(){
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                `{{ route('article') }}`
            },
            columns: [{
                data: 'judul',
                name: 'judul'
            }]
        })
    })
</script>
@endsection
