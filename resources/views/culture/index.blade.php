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
                                    class=" fa fa-plus"></i>Tambah</button>
                        </div>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Nama Budaya </th>
                                    <th> Deskripsi </th>
                                    <th> Gambar </th>
                                    <th width="100"> Aksi </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nama Budaya </th>
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
                            <label>Nama Budaya {!! App\MyClass\Template::required() !!}</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Wisata">
                        </div>

                        <div class="form-group">
                            <label>Gambar Wisata</label>
                            <input type="file" name="image" class="form-control-file form-control">
                        </div>

                        <div class="form-group">
                            <label>Deskripsi {!! App\MyClass\Template::required() !!}</label>
                            <textarea name="description" class="form-control" placeholder="Deskripsi Wisata" rows="4"></textarea>
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
        <div class="modal-dialog " role="document">
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

                        <div class="form-group">
                            <label>Nama Budaya {!! App\MyClass\Template::required() !!}</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Wisata">
                        </div>

                        <div class="form-group">
                            <label>Gambar Wisata</label>
                            <input type="file" name="image" class="form-control-file form-control">
                        </div>

                        <div class="form-group">
                            <label>Deskripsi {!! App\MyClass\Template::required() !!}</label>
                            <textarea name="description" class="form-control" placeholder="Deskripsi Wisata" rows="4"></textarea>
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
            const $modalUpdate = $('#modalUpdate');
            const $formCreate = $('#formCreate');
            const $formUpdate = $('#formUpdate');
            const $formCreateSubmitBtn = $formCreate.find(`[type="submit"]`).ladda();
            const $formUpdateSubmitBtn = $formUpdate.find(`[type="submit"]`).ladda();

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: `{{ route('culture') }}`
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
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
                $.each($('.edit'), (i, editBtn) => {
                    $(editBtn).off('click');
                    $(editBtn).on('click', function() {
                        let {
                            editHref,
                            getHref
                        } = $(this).data();
                        $.get({
                            url: getHref,
                            dataType: `json`
                        }).done(response => {
                            let {
                                culture
                            } = response;
                            clearInvalid();
                            $modalUpdate.modal('show');
                            $formUpdate.attr('action', editHref);
                            $formUpdate.find(`[name="name"]`).val(culture.name);
                            $formUpdate.find(`[name="description"]`).val(culture
                                .description)
                            formSubmit(
                                $modalUpdate,
                                $formUpdate,
                                $formUpdateSubmitBtn,
                                editHref,
                                'POST',
                            );
                        }).fail(error => {
                            ajaxErrorHandling(error);
                        })
                    })
                })

                $.each($('.delete'), (i, deleteBtn) => {
                    $(deleteBtn).off('click');
                    $(deleteBtn).on('click', function(e) {
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

                            })
                        })
                    })
                })
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
                        dataType: `json`,
                        contentType: false,
                        processData: false
                    }).done(response => {
                        let = {
                            message
                        } = response;
                        successNotification('Berhasil', message)
                        $submit.ladda('stop');
                        $modal.modal('hide');
                        reloadDT();
                        $formCreate[0].reset();
                        if (addedAction) {
                            addedAction();
                        }
                    }).fail(response => {
                        $submit.ladda('stop');
                        ajaxErrorHandling(response, $form)
                    });
                })
            }

            formSubmit(
                $modalCreate,
                $formCreate,
                $formCreateSubmitBtn,
                `{{ route('culture.store') }}`,
                'post',
                () => {
                    clearFormCreate();
                }
            )
        })
    </script>
@endsection
