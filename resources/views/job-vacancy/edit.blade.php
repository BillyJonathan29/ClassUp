@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="d-inline-block">
                            <i class="fa fa-plus mr-2"></i>{{ $title ?? 'Judul' }}
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    <form id="formUpdate">
                        @csrf

                        {!! App\MyClass\Template::requiredBanner() !!}

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nama Pekerjaan {!! App\MyClass\Template::required() !!}</label>
                                    <input type="text" name="position" class="form-control"
                                        placeholder="Contoh: Web Developer" ">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Perusahaan {!! App\MyClass\Template::required() !!}</label>
                                                <input type="text" name="company" class="form-control"
                                                    placeholder="Contoh: PT Teknologi Hebat">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Lokasi {!! App\MyClass\Template::required() !!}</label>
                                                <input type="text" name="location" class="form-control"
                                                    placeholder="Contoh: Jakarta, Indonesia">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Jenis Pekerjaan {!! App\MyClass\Template::required() !!}</label>
                                                <select name="job_type" class="form-control" required>
                                                    <option value="">-- Pilih Jenis Pekerjaan --</option>
                                                    <option value="Full-Time">Full-Time</option>
                                                    <option value="Part-Time">Part-Time</option>
                                                    <option value="Freelance">Freelance</option>
                                                    <option value="Internship">Internship</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Gaji Minimum (Rp)</label>
                                                <input type="number" name="salary_min" class="form-control"
                                                    placeholder="Contoh: 5000000">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Gaji Maksimum (Rp)</label>
                                                <input type="number" name="salary_max" class="form-control"
                                                    placeholder="Contoh: 10000000">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Batas Lamaran {!! App\MyClass\Template::required() !!}</label>
                                                <input type="date" name="application_deadline" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Kontak {!! App\MyClass\Template::required() !!}</label>
                                                <input type="text" name="contact" class="form-control"
                                                    placeholder="Contoh: email@perusahaan.com">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>URL Lamaran</label>
                                                <input type="url" name="application_url" class="form-control"
                                                    placeholder="Contoh: https://perusahaan.com/lamar">
                                            </div>
                                        </div>


                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Deskripsi {!! App\MyClass\Template::required() !!}</label>
                                                <textarea name="description" rows="4" class="form-control"
                                                    placeholder="Deskripsikan posisi pekerjaan secara detail..."></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Kualifikasi {!! App\MyClass\Template::required() !!}</label>
                                                <textarea name="qualifications" rows="4" class="form-control"
                                                    placeholder="Tuliskan syarat/kualifikasi untuk pelamar..."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        {{-- <a href="{{ route('job-vacancies.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a> --}}
                                        <button type="submit" class="btn btn-primary float-right">
                                            <i class="fas fa-save mr-1"></i> Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            const $formUpdate = $('#formUpdate');
            const $formUpdateSubmitBtn = $formUpdate.find(`[type="submit"]`).ladda();


            const jobVacancy = @json($jobVacancy);
            $('[name="position"]').val(jobVacancy.position);
            $('[name="company"]').val(jobVacancy.company);
            $('[name="location"]').val(jobVacancy.location);
            $('[name="job_type"]').val(jobVacancy.job_type);
            $('[name="salary_min"]').val(jobVacancy.salary_min);
            $('[name="salary_max"]').val(jobVacancy.salary_max);
            $('[name="application_deadline"]').val(jobVacancy.application_deadline);
            $('[name="contact"]').val(jobVacancy.contact);
            $('[name="application_url"]').val(jobVacancy.application_url);
            $('[name="description"]').val(jobVacancy.description);
            $('[name="qualifications"]').val(jobVacancy.qualifications);

            const clearFormUpdate = () => {
                $formCreate[0].reset();
            }

            $formUpdate.off('submit');
            $formUpdate.on('submit', function(e) {
                e.preventDefault();
                clearInvalid();

                let formData = $(this).serialize();
                $formUpdateSubmitBtn.ladda('start');
                ajaxSetup();
                $.ajax({
                    url: `{{ route('job-vacancy.update', $jobVacancy->id) }}`,
                    method: `PUT`,
                    data: formData,
                    dataType: `json`
                }).done(response => {
                    $formUpdateSubmitBtn.ladda('stop');
                    ajaxSuccessHandling(response);
                    window.location.href = `{{ route('job-vacancy') }}`
                }).fail(error => {
                    ajaxErrorHandling(error, $formUpdate);
                });
            });
        });
    </script>
@endsection
