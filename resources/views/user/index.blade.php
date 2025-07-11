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
                                    <th>NO</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>NO</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th width="100">Aksi</th>
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
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('user') }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'username',
                        name: 'username'
                    }, {
                        data: 'email',
                        name: 'email'
                    }, {
                        data: 'role',
                        name: 'role'
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                drawCallback: settings => {
                    deleteData();
                }
            });
            const reloadDT = () => {
                $('#dataTable').DataTable().ajax.reload();
            }

            const deleteData = () => {
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
                                method: 'delete',
                                dataType: 'json'
                            }).done(response => {
                                let {
                                    message
                                } = response;
                                successNotification('Berhasil', message)
                                reloadDT();
                            }).fail(error => {
                                ajaxErrorHandling(error);
                            })
                        })
                    })
                })
            }
        });
    </script>
@endsection
