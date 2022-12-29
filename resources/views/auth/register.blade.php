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
    <!-- Pre-loader end -->
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <form class="md-float-material form-material"action="{{ route('register') }}" method="post">
                        @csrf
                        {{-- <div class="text-center">
                            <img src="libraries\assets\images\logo.png" alt="logo.png">
                        </div> --}}
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Sign up</h3>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="username" id="username" class="form-control" required="" placeholder="Choose Username">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="name" id="name" class="form-control" required="" placeholder="Choose Name">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="email" id="email" class="form-control" required="" placeholder="Your Email Address">
                                    <span class="form-bar"></span>
                                </div>
                               
                                <div class="form-group form-primary">
                                    <input type="password" name="password" id="password" class="form-control" required="" placeholder="Password">
                                    <span class="form-bar"></span>
                                </div>
                               
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Register</button>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Thank you.</p>
                                        <p class="text-inverse text-left"><a href="#"><b class="f-w-600">Back to Login</b></a></p>
                                    </div>
                                    {{-- <div class="col-md-2">
                                        <img src="libraries\assets\images\auth\Logo-small-bottom.png" alt="small-logo.png">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    @endsection
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="../files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="../files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="../files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    @push('scripts')
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
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
@endpush