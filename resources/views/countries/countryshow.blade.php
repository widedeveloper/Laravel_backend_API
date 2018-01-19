@extends('layouts.layout')
@section('content')

<script>
    $(function(){
        $(".back_button").click(function(){
              location.href = "{{URL::to('countries')}}"
            //   location.href = "{{ URL::previous() }}"
        });
    });
</script>

<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Countries
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->

                <div class="box box-info">
                    <!-- form start -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">View</h3>                           
                        </div>
                        <div class="box-body">
                            <div class="col-xs-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Country Name:</th>
                                                <td>{{$country->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Country Code</th>
                                                <td>{{$country->code}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                       <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Regions</a></li>
                                <!-- <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">Radios</a></li> -->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="box account_list">
                                        <div class="box-body">
                                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th style="width:50%;">Name</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($regions as $tr)
                                                                    <tr class="gradeA odd" item_id="{{$tr->id}}">
                                                                        <td class=" ">{{$tr->name }}</td>
                                                                        <td class="center ">
                                                                            <a onclick="show($(this))" data-href="{{URL::to('countries/'.$tr->id)}}" class="btn btn-primary btn-xs view"><i class="fa fa-edit "></i> view</a>
                                                                            <a onclick="edit($(this))" class="btn btn-danger btn-xs edit"><i class="fa fa-pencil "></i> Edit</a>                                                       
                                                                            <a href="{{ url('countries/delete/'.$tr->id)}}" data-method="delete" class="btn btn-danger btn-xs delete"><i class="fa fa-pencil "></i> Delete</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="dataTables_info" id="dataTables-example_info" role="alert" aria-live="polite" aria-relevant="all">Tatal <?php echo $regions->total() ?> counts</div>

                                                            </div>
                                                            <div class="col-sm-9 ">
                                                                <div  id="dataTables-example_paginate" style="float:right">
                                                                    <?php echo $regions->render(); ?>

                                                                </div>
                                                            </div> 
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <!-- /.box -->
                                    </div>
                                </div>
                               
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                             <button type="button" class="btn btn-info back_button">Back</button>
                        </div>
                        <!-- /.box-footer-->
                    </div>

                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection