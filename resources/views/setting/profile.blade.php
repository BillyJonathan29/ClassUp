@extends('layouts.template')

@section('content')
    <div class="row ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title ">Menu Profile</h4>
                </div>

                <div class="card-body">
                    <form action="">

                        {!! App\MyClass\Template::requiredBanner() !!}

                        <div class="text-center my-4">
                            <img src="{{ url('img/head-meja.png') }}" width="100" id="change-avatar">
                        </div>

                        <input type="file" name="upload_avatar" style="display: none;" accept="image/*">

                        <div class="form-group">
                            <label for="username" class="">Username {!! App\MyClass\Template::required() !!}
                            </label>
                            <input type="text" name="username" class="form-control" placeholder="Masukan username"
                                value="{{ auth()->user()->username }}">
                            <span class="invlaid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="email" class="">Email {!! App\MyClass\Template::required() !!}
                            </label>
                            <input type="text" name="email" class="form-control" placeholder="Masukan email anda"
                                value="{{ auth()->user()->email }}">
                            <span class="invlaid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label for="role">Role {!! App\MyClass\Template::required() !!}</label>
                            <select name="role" class="form-control" id="role">
                                <option value="" selected disabled> -- Pilih Role -- </option>
                                <option value="Admin"> Admin </option>
                                <option value="User"> User </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save mr-1"></i>Simpan
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
        const $form = $('#form');
        const $submitBtn = $form.find(`[type="submit"]`);

        // $form.find(`[name="role"]`).val(`{{ auth()->user()->role }}`);
    </script>
@endsection


@section('styles')
    <style type="text/css">
        #change-avatar {
            width: 150px;
            height: 150px;
            object-fit: cover;
            object-position: center;
            border-radius: 100%;
            border: 1px solid #cdcdcd;
            cursor: pointer;
        }
    </style>
@endsection
