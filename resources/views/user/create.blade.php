@extends('layouts.template')

@section('content')
    <div class="row m-4">
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
                    <form action="{{ route('user.store') }}" id="form" method="POST">
                        @csrf
                        {!! App\MyClass\Template::requiredBanner() !!}

                        <div class="form-group">
                            <label for="">Nama {!! App\MyClass\Template::required() !!}</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Email {!! App\MyClass\Template::required() !!}</label>
                            <input type="text" name="email" class="form-control" placeholder="Masukan Gmail">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Password {!! App\MyClass\Template::required() !!}</label>
                            <input type="text" name="password" class="form-control" placeholder="Masukan Nama">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Role {!! App\MyClass\Template::required() !!}</label>
                            <select name="role" class="form-control" id="">
                                <option value="" selected disabled> -- Pilih Role -- </option>
                                <option value="Admin" > Admin </option>
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
@endsection
