@extends('layouts.template')

@section('content')
    <div class="row m-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title ">Menu Profile</h4>
                </div>

                <div class="card-body">
                    <form action="">

                        {!! App\MyClass\Template::requiredBanner() !!}

                        <div class="text-center my-2">
                            <img src="{{ url('img/head-meja.png') }}" width="100" id="change-avatar">
                        </div>

                        <input type="file" name="upload_avatar" style="display: none;" accept="image/*">

                        <div class="form-group">
                            <label for="" class="">Nama {!! App\MyClass\Template::required() !!}
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama" value="{{ $user->name }}">
                            <span class="invlaid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="" class="">Email {!! App\MyClass\Template::required() !!}
                            </label>
                            <input type="text" name="email" class="form-control" placeholder="Masukan email anda" value="{{ $user->email}}">
                            <span class="invlaid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="" class="">Nomor Telepon {!! App\MyClass\Template::required() !!}
                            </label>
                            <input type="number" name="phone_number" class="form-control" placeholder="Masukan nomor telepon anda" value="{{ $user->phone_number}}">
                            <span class="invlaid-feedback"></span>
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
@endsection
