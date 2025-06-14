@extends('layouts.template')

@section('content')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="d-inline-block">
                            {{ $title ?? 'Judul' }}
                        </span>
                        <div class="float-right">
                            {{-- <button class="btn btn-success mr-2" data-toggle="modal" data-target="#modalImport">
                                <i class="fa fa-upload"></i> Import
                            </button> --}}
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
                                    <th> Nama Wisata </th>
                                    <th> Lokasi </th>
                                    <th> Latitude </th>
                                    <th> Longitude </th>
                                    <th> Kategori </th>
                                    <th> Harga </th>
                                    <th> Jam buka </th>
                                    <th> Jam tutup </th>
                                    <th> Gambar </th>
                                    <th> Deskripsi </th>
                                    <th width="100"> Aksi </th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th> Nama Wisata </th>
                                    <th> Lokasi </th>
                                    <th> Latitude </th>
                                    <th> Longitude </th>
                                    <th> Kategori </th>
                                    <th> Harga </th>
                                    <th> Jam buka </th>
                                    <th> Jam tutup </th>
                                    <th> Gambar </th>
                                    <th> Deskripsi </th>
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
        <div class="modal-dialog modal-lg" role="document">
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

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nama Wisata {!! App\MyClass\Template::required() !!}</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nama Wisata">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Lokasi {!! App\MyClass\Template::required() !!}</label>
                                    <input type="" name="location" class="form-control" placeholder="Lokasi Wisata">
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
                                    <label>Kategori {!! App\MyClass\Template::required() !!}</label>
                                    <input type="text" name="category" class="form-control"
                                        placeholder="Contoh: Alam, Budaya, dll">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Harga Tiket Masuk (Rp) {!! App\MyClass\Template::required() !!}</label>
                                    <input type="number" name="price" class="form-control" placeholder="Contoh: 25000">
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

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Gambar Wisata</label>
                                    <input type="file" name="image" class="form-control-file form-control">
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

    <div class="modal fade" id="modalUpdate" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="formUpdate" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nama Wisata {!! App\MyClass\Template::required() !!}</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nama Wisata">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Lokasi {!! App\MyClass\Template::required() !!}</label>
                                    <input type="" name="location" class="form-control"
                                        placeholder="Lokasi Wisata">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" name="latitude" class="form-control"
                                        placeholder="-6.20000000">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" name="longitude" class="form-control"
                                        placeholder="106.81666667">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Kategori {!! App\MyClass\Template::required() !!}</label>
                                    <input type="text" name="category" class="form-control"
                                        placeholder="Contoh: Alam, Budaya, dll">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Harga Tiket Masuk (Rp) {!! App\MyClass\Template::required() !!}</label>
                                    <input type="number" name="price" class="form-control"
                                        placeholder="Contoh: 25000">
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

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Gambar Wisata</label>
                                    <input type="file" name="image" class="form-control-file form-control">
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
            const $modalUpdate = $('#modalUpdate');
            const $formUpdate = $('#formUpdate');
            const $formCreateSubmitBtn = $formCreate.find(`[type="submit"]`).ladda();
            const $formUpdateSubmitBtn = $formUpdate.find(`[type="submit"]`).ladda();

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: `{{ route('tour') }}`,

                },
                columns: [{
                    data: 'name',
                    name: 'name',

                }, {
                    data: 'location',
                    name: 'location'
                }, {
                    data: 'latitude',
                    name: 'latitude',
                    visible: false
                }, {
                    data: 'longitude',
                    name: 'longitude',
                    visible: false
                }, {
                    data: 'category',
                    name: 'category'
                }, {
                    data: 'price',
                    name: 'price'
                }, {
                    data: 'start_time',
                    name: 'start_time'
                }, {
                    data: 'end_time',
                    name: 'end_time'
                }, {
                    data: 'image',
                    name: 'image'
                }, {
                    data: 'description',
                    name: 'description',
                    visible: false
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }],
                drawCallback: settings => {
                    crud();
                }
            });

            const clearFormCreate = () => {
                $formCreate[0].reset();
            }

            const reloadDT = () => {
                $('#dataTable').DataTable().ajax.reload();
            }


            const crud = () => {
                $.each($('.delete'), (i, deleteBtn) => {
                    $(deleteBtn).off('click');
                    $(deleteBtn).on('click', function() {
                        let {
                            deleteMessage,
                            deleteHref
                        } = $(this).data();
                        confirmation(deleteMessage, function() {
                            ajaxSetup();
                            $.ajax({
                                url: deleteHref,
                                method: `delete`,
                                dataType: `json`
                            }).done(response => {
                                let {
                                    message
                                } = response;
                                successNotification('Berhasil', message);
                                reloadDT();
                            }).fail(error => {
                                ajaxErrorHandling(error);
                            });
                        });
                    });
                });

                $.each($('.edit'), (i, editBtn) => {
                    $(editBtn).off('click');
                    $(editBtn).on('click', function() {
                        let {
                            editHref,
                            getHref
                        } = $(this).data();
                        $.get({
                            url: getHref,
                            dataType: 'json'
                        }).done(response => {
                            let {
                                tour
                            } = response;
                            clearInvalid();
                            $modalUpdate.modal('show');
                            $formUpdate.attr('action', editHref);
                            $formUpdate.find(`[name="name"]`).val(tour.name);
                            $formUpdate.find(`[name="location"]`).val(tour.location);
                            $formUpdate.find(`[name="latitude"]`).val(tour.latitude);
                            $formUpdate.find(`[name="longitude"]`).val(tour.longitude);
                            $formUpdate.find(`[name="category"]`).val(tour.category);
                            $formUpdate.find(`[name="price"]`).val(tour.price);
                            $formUpdate.find(`[name="start_time"]`).val(tour
                                .start_time.substring(0, 5));
                            $formUpdate.find(`[name="end_time"]`).val(tour.end_time
                                .substring(0, 5));
                            $formUpdate.find(`[name="description"]`).val(tour
                                .description);
                            // $formUpdate.find(`[name="image"]`).attr('data-default-file',
                            //     `/storage/tour_photo/${tour.image}`);

                            formSubmit(
                                $modalUpdate,
                                $formUpdate,
                                $formUpdateSubmitBtn,
                                editHref,
                                `POST`,
                            );
                        }).fail(error => {
                            ajaxErrorHandling(error)
                        })
                    })
                });
            }

            const formSubmit = ($modal, $form, $submit, $href, $method, addedAction = null) => {
                $form.off('submit')
                $form.on('submit', function(e) {
                    e.preventDefault();
                    clearInvalid();

                    let formData = new FormData(this);
                    $submit.ladda('start');
                    ajaxSetup();
                    $.ajax({
                        url: $href,
                        method: $method,
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                    }).done(response => {
                        let {
                            message
                        } = response;
                        successNotification('Berhasil', message);
                        $submit.ladda('stop');
                        $modal.modal('hide');
                        reloadDT();
                        $form[0].reset();
                        if (addedAction) {
                            addedAction();
                        }

                    }).fail(error => {
                        $submit.ladda('stop');
                        ajaxErrorHandling(error, $form);
                    });
                });
            }

            formSubmit(
                $modalCreate,
                $formCreate,
                $formCreateSubmitBtn,
                `{{ route('tour.store') }}`,
                `post`,
                () => {
                    clearFormCreate();
                }
            )
        });
    </script>
@endsection
