<div class="col-lg-2">
                                                <!-- Default card start -->
                                                  <!-- Zero config.table start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="sub-title">Pangkalan Militer</h4>
                                                    </div>
                                                    <div class="card-block" style="margin-top: -30px;">
                                                        <ul>
                                                            @foreach ($airbases as $airbase )
                                                                <li style="padding-top: 5px;">
                                                                    <span class="pcoded-micon" id="span_pilih" onclick="spanpilih('{{$airbase->location}}')"> <i class="feather icon-home"></i> {{$airbase->code_airbase}}</span>

                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                    </div>
                                                </div>
                                            <!-- Zero config.table end -->
                                            <!-- Default ordering table start -->
                                                <!-- Default card end -->
                                            </div>
