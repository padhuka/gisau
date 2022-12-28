
@extends('layout.app')

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
                                                        <h4>Ubah Pangkalan Udara</h4>
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
                                                        <li class="breadcrumb-item"><a href="#!">Pangkalan Udara</a>
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
                                                    <h4 class="sub-title">Pangkalan Udara</h4>

                                                   <form action="{{ route('planeairbase.update',$planeairbase) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group row">
                                                            <div class="col"></div>
                                                            <div class="col-sm-10"></div>
                                                            <div class="col">
                                                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                            </div>
                                                        </div>
                                                       <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Skuadron</label>
                                                            <div class="col-sm-10">
                                                                <select class="form-control" name="airbase">
                                                                    <option value="">Pilih Skuadron</option>
                                                                    @foreach ($airbases as $airbase)
                                                                        <option value="{{$airbase->id}}" {{ $airbase->id == $planeairbase->airbase_id ? 'selected' : '' }}>{{$airbase->name_airbase}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Pesawat</label>
                                                            <div class="col-sm-10">
                                                                <select class="form-control" name="plane">
                                                                    <option value="">Pilih Pesawat</option>
                                                                    @foreach ($planes as $plane)
                                                                        <option value="{{$plane->id}}" {{ $plane->id == $planeairbase->plane_id ? 'selected' : '' }}>{{$plane->name_plane}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Deskripsi</label>
                                                            <div class="col-sm-10">
                                                               <textarea name="description" class="form-control @error('description')
                                                                        is-invalid
                                                                    @enderror" id="" cols="30" rows="10" placeholder="Deskripsi">{{ $planeairbase->description }}</textarea>
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
