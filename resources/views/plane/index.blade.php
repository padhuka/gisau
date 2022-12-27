@extends('layout.app')

@push('styles')
    {{-- load jquery datatable untuk menggunakannya --}}
    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">-->
      <!-- Data Table Css -->
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\libraries\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\libraries\assets\pages\data-table\css\buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\libraries\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')}}">
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
                                                        <h4>Data Pesawat</h4>
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
                                            <div class="col-lg-12">
                                                <!-- Default card start -->
                                                  <!-- Zero config.table start -->
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5><a href="{{ route('plane.create') }}" class="btn btn-info btn-sm float-end mb-2">Tambah Pesawat</a></h5>
                                                    <!--<span>DataTables has most features enabled by default, so all you need to do to use it with your own ables is to call the construction function: $().DataTable();.</span>-->
                                                </div>
                                                <div class="card-block">
                                                    <div class="dt-responsive table-responsive">
                                                        @if (session('success'))
                                                            <div class="alert alert-success">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                        <i class="icofont icofont-close-line-circled"></i>
                                                                    </button>
                                                                    <strong>{{ session('success') }}</strong>
                                                        @endif
                                                    </div>

                                                        <table id="dataPlanes" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Kode Pesawat</th>
                                                                <th>Nama Pesawat</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                        <form action="" method="POST" id="deleteForm">
                                                            @csrf
                                                            @method("DELETE")
                                                            <input type="submit" value="Hapus" style="display: none">
                                                        </form>
                                                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Zero config.table end -->
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
    {{-- load jquery dan jquery datatable --}}
    <!--<script src="https://code.jquery.com/jquery-3.6.0.js')}}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js')}}"></script>-->
    <!-- data-table js -->
    <!-- data-table js -->
    <script src="{{ asset('adminty\libraries\bower_components\datatables.net\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\assets\pages\data-table\js\jszip.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\assets\pages\data-table\js\pdfmake.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\assets\pages\data-table\js\vfs_fonts.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\datatables.net-buttons\js\buttons.print.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\datatables.net-buttons\js\buttons.html5.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js')}}"></script>
    <!-- Custom js -->
    <script src="{{ asset('adminty\libraries\assets\pages\data-table\js\data-table-custom.js')}}"></script>

     <script>
        $(function() {
            $('#dataPlanes').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: false,
                autoWidth: false,

                // Route untuk menampilkan data space
                ajax: '{{ route('data-plane') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'code_plane'
                    },
                    {
                        data: 'name_plane'
                    },
                    {
                        data: 'action'
                    }
                ]
            })
        })
    </script>
@endpush
