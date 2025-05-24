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
                            <a class="btn btn-primary mr-2" href="{{ route('job-vacancy.create') }}"><i
                                    class="fa fa-plus mr-2"></i>Tambah</a>
                        </div>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Nama Pekerjaan</th>
                                    <th>Perusahaan</th>
                                    <th>Lokasi</th>
                                    <th>Jenis Pekerjaan</th>
                                    <th>Deskripsi</th>
                                    <th>Kualifikasi</th>
                                    <th>Gaji Minimum</th>
                                    <th>Gaji Maksimum</th>
                                    <th>Batas Lamaran</th>
                                    <th>Kontak</th>
                                    <th>URL Lamaran</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nama Pekerjaan</th>
                                    <th>Perusahaan</th>
                                    <th>Lokasi</th>
                                    <th>Jenis Pekerjaan</th>
                                    <th>Deskripsi</th>
                                    <th>Kualifikasi</th>
                                    <th>Gaji Minimum</th>
                                    <th>Gaji Maksimum</th>
                                    <th>Batas Lamaran</th>
                                    <th>Kontak</th>
                                    <th>URL Lamaran</th>
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
                    url: `{{ route('job-vacancy') }}`
                },
                columns: [{
                    data: 'position',
                    name: 'position'
                }, {
                    data: 'company',
                    name: 'company'
                }, {
                    data: 'location',
                    name: 'location'
                }, {
                    data: 'job_type',
                    name: 'job_type'
                }, {
                    data: 'description',
                    name: 'description'
                }, {
                    data: 'qualifications',
                    name: 'qualifications'
                }, {
                    data: 'salary_min',
                    name: 'salary_min'
                }, {
                    data: 'salary_max',
                    name: 'salary_max'
                }, {
                    data: 'application_deadline',
                    name: 'application_deadline'
                }, {
                    data: 'contact',
                    name: 'contact'
                }, {
                    data: 'application_url',
                    name: 'application_url'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }],
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
            }
        })
    </script>
@endsection
