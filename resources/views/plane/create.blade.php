
@extends('layout.app')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush

@section('content')
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-header start -->
                                    <div class="page-header m-t-30">
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="page-header-title">
                                                    <div class="d-inline">
                                                        <!--<h4>Peta</h4>-->
                                                        <h4>Tambah Pesawat</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                            <a href="index-1.htm')}}">
                                                                <i class="icofont icofont-home"></i>
                                                            </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#!">Pesawat</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-header end -->
                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Default card start -->
                                            <!-- Basic Form Inputs card start -->
                                            <div class="card">
                                                <div class="card-block">
                                                    <h4 class="sub-title">Pesawat</h4>
                                                    <form action="{{ route('plane.store') }}" method="post" enctype="multipart/form-data">

                                                        @csrf

                                                        <div class="form-group row">
                                                            <div class="col"></div>
                                                            <div class="col-sm-10"></div>
                                                            <div class="col">
                                                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Kode Pesawat</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="code" @error('code') is-invalid @enderror>
                                                                @error('code')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Nama Pesawat</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="name" @error('name') is-invalid @enderror>
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Foto Image</label>

                                                            <div class="col-sm-10">
                                                                <img id="previewImage" class="mb-2" src="#" width="200px" height="200px" alt="">
                                                                <input type="file" name="image" class="form-control upload__inputfile @error('image') is-invalid @enderror"
                                                                    id="image" multiple="">
                                                                @error('image')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="upload__img-wrap"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Deskripsi</label>
                                                            <div class="col-sm-10">
                                                               <textarea name="description" class="form-control @error('description')
                                                                        is-invalid
                                                                    @enderror" id="" cols="30" rows="10" placeholder="Deskripsi"></textarea>
                                                                    @error('description')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Basic Form Inputs card end -->
                                            <!-- Default ordering table start -->
                                                <!-- Default card end -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page body end -->
                                </div>
                            </div>

@endsection

@push('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Ketika tag input file denghan class image di klik akan menjalankan fungsi di atas
        $("#image").change(function() {
            readURL(this);
        });
    </script>
@endpush
