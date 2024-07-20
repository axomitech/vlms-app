@extends('layouts.app')

    @section('content')
        <div class="row ">
            <div class="col-md-12">
                <div class="box shadow-lg p-3 mb-5 bg-white rounded min-vh-100">
                    <div class="box-header">
                        <div class="box-tools">
                        <p style="font-size:18px;font-weight:bold;margin-bottom: 9px; color:#173F5F;">Home</p>
                        </div>
                    </div>
                    <div class="box-body">
                        <section class="content">
                            <div class="container-fluid">
                                <!-- Main row -->
                                <div class="row">
                                    <div class="col-lg-3 col-3">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #58a6ff;">
                                        <div class="inner">
                                            <h3 style="color:white;">{{ 3}} </h3>
                                            <p style="font-size: 22px;color:white;">Diarized</p>
                                            <b style="font-size: 22px;color:white;"></b>
                                        </div>
                                        <div class="icon">
                                            <!-- <i class="fas fa-folder-open" style="font-size: 50px !important;color: white;"></i> -->
                                            <i class="fa-solid fa-arrow-down-to-square"></i>
                                        </div>
                                        <a href="{{route('letters')}}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    
                                    <div class="col-lg-3 col-3">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #8355fe;">
                                        <div class="inner">
                                            <h3 style="color:white;">{{ '1';}}</h3>
                                            <p style="font-size: 22px;color:white;">Inbox</p>
                                            <b style="font-size: 22px;color:white;"></b>
                                        </div>
                                        <div class="icon">
                                            <!-- <i class="fas fa-tasks" style="font-size: 50px;color: white;"></i> -->
                                            <i class="fa-solid fa-arrow-up-from-square"></i>
                                        </div>
                                        <a href="{{"hi"}}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    

                                    
                                    <div class="col-lg-3 col-3">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #3CAEA3;">
                                        <div class="inner">
                                            <h3 style="color:white;">{{ 2; }}</h3>
                                            <p style="font-size: 22px;color:white;">Sent</p>
                                            <b style="font-size: 22px;color:white;"></b>
                                        </div>
                                        <div class="icon">
                                            <!-- <i class="fas fa-tasks" style="font-size: 50px;color: white;"></i> -->
                                            <i class="fa-solid fa-arrow-up-from-square"></i>
                                        </div>
                                            <a href="{{"hi"}}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-3">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #ff9e69;">
                                        <div class="inner">
                                            <h3 style="color:white;">{{ 2; }}</h3>
                                            <p style="font-size: 22px;color:white;">Archived</p>
                                            <b style="font-size: 22px;color:white;"></b>
                                        </div>
                                        <div class="icon">
                                            <!-- <i class="fas fa-tasks" style="font-size: 50px;color: white;"></i> -->
                                            <i class="fa-solid fa-arrow-up-from-square"></i>
                                        </div>
                                            <a href="{{"hi"}}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Main row -->
                            </div><!-- /.container-fluid -->
                        </section>                 
                    </div>
                </div>
            </div>
        </div>
    @endsection