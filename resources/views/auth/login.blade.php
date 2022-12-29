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


<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    @section('content')
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    
                        <form class="md-float-material form-material" action="{{ route('login') }}" method="post">
                            @csrf
                            {{-- <div class="text-center">
                                <img src="libraries\assets\images\logo.png" alt="logo.png">
                            </div> --}}
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Log In</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="email" class="form-control" required="" placeholder="Your Email Address">
                                        <span class="form-bar"></span>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="password" name="password" class="form-control" required="" placeholder="Password">
                                        <span class="form-bar"></span>
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary d-">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Remember me</span>
                                                </label>
                                            </div>
                                          
                                            {{-- <div class="forgot-phone text-right f-right">
                                                <a href="auth-reset-password.htm" class="text-right f-w-600"> Forgot Password?</a>
                                            </div> --}}
                                        
                                      
                                    </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Log in</button>
                                        </div>
                                    </div>
                                  
                                        <div class="col-12">
                                            <a href="{{ route('register') }}">
                                            Register                                         
                                        </a>
                                        </div>  
                                    
                                    <hr>
                                   </div>
                            </div>
                        </form>
                        <!-- end of form -->
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
    {{-- @push('scripts')
    <script src="{{ asset('adminty\libraries\bower_components\jquery\js\jquery.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\jquery-ui\js\jquery-ui.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\popper.js\js\popper.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\bootstrap\js\bootstrap.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script src="{{ asset('adminty\libraries\bower_components\jquery-slimscroll\js\jquery.slimscroll.js')}}"></script>
   <!-- modernizr js -->
    <script src="{{ asset('adminty\libraries\bower_components\modernizr\js\modernizr.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\modernizr\js\css-scrollbars.js')}}"></script>
    <!-- i18next.min.js -->
    <script src="{{ asset('adminty\libraries\bower_components\i18next\js\i18next.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\bower_components\jquery-i18next\js\jquery-i18next.min.js')}}"></script>
    <script src="{{ asset('adminty\libraries\assets\js\common-pages.js')}}"></script>  --}}
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
</body>


