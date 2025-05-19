@extends('layouts.template')

@section('content')
    <div class="row ">
        <div class="col-lg-6 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="d-inline-block">
                            {{ $title ?? 'judul' }}
                        </span>
                    </h4>
                </div>

                <div class="card-body">
                    <form id="form">
                        @csrf
                        {!! App\MyClass\Template::requiredBanner() !!}

                        <div class="form-group">
                            <label for="username">Username {!! App\MyClass\Template::required() !!}</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukan Username">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Email {!! App\MyClass\Template::required() !!}</label>
                            <input type="text" name="email" class="form-control" placeholder="Masukan Gmail">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password {!! App\MyClass\Template::required() !!}</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukan password">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="role">Role {!! App\MyClass\Template::required() !!}</label>
                            <select name="role" class="form-control" id="role">
                                <option value="" selected disabled> -- Pilih Role -- </option>
                                <option value="Admin"> Admin </option>
                                <option value="User"> User </option>
                            </select>
                        </div>

                        <hr>

                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-check mr-2"></i>Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const $form = $('#form');
            const $submitBtn = $form.find(`[type="submit"]`).ladda();
            $form.on('submit', function(e) {
                e.preventDefault();
                clearInvalid();

                let formData = $(this).serialize();
                $submitBtn.ladda('start');

                ajaxSetup();
                $.ajax({
                        url: "{{ route('user.store') }}",
                        method: 'post',
                        data: formData,
                        dataType: 'json'
                    }).done(response => {
                        $submitBtn.ladda('stop');
                        ajaxSuccessHandling(response);
                        resetForm();
                        windowReload(500);
                        window.location.href = "{{ route('user') }}"
                    })
                    .fail(error => {
                        $submitBtn.ladda('stop')
                        ajaxErrorHandling(error)
                    })
            })
            const resetForm = () => {
                $form[0].reset();
            }
            resetForm();
        });
    </script>
@endsection
