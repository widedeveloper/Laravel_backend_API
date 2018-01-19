@extends('layouts.layout')
@section('content')

<script>
    $(function(){
        $(".back_button").click(function(){
             location.href = "{{URL::to('regions')}}";
        });
    });

    function setactive(obj) {
        if (obj.checked) {
           var status = 1;
        } else { 
           var status = 0;
        }
        var radio_id = $(obj).parent().parent().attr("item_id");
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            type: "POST",
            dataType:'json',
            url: "{{ url('radios') }}"+"/setstatus",
            data: {
                status : status, id : radio_id
            },
            success: function (data) {
                alert(data);
            }
        });
       
    }

    function radio_delete(obj) {
        if(confirm("are you sure?")==true){
            var url = obj.data('href');
            location.href = url;
        }
    }

    function show (obj) {
         location.href = obj.data('href');
    }

    function edit (obj) {
         location.href = obj.data('href');
    }
</script>

<div class="content-wrapper" style="min-height: 916px;">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Regions
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
                                                <th style="width:50%">Region Name:</th>
                                                <td>{{$region->name}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                       <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Radios</a></li>
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
                                                                    <th style="width:16%;">Name</th>
                                                                    <th style="width:15%;">Logo</th>
                                                                    <th style="width:5%;">Status</th>
                                                                    <th style="width:17%;">Country/Region</th>
                                                                    <th style="width:30%;">streamings</th>
                                                                    <th style="width:17%;"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($result as $tr)
                                                                    <tr class="gradeA odd" item_id="{{$tr->id}}">
                                                                        <td class=" ">{{$tr->name }}<br>{{$tr->dial}}<br>{{$tr->type}}</td>
                                                                        <td class=" "><img src = "{{$tr->logo }}" /></td>
                                                                        <td class=" "><input onclick = "setactive(this)" type="checkbox" {{($tr->status==1)?"checked":"" }}/></td>
                                                                        <td class=" ">{{$tr->country_name }}<br>{{$tr->region_name}}</td>
                                                                        <td class=" ">
                                                                            @foreach ($tr->streams as $stream)
                                                                                {{$stream->url}}<br>
                                                                            @endforeach
                                                                        </td>
                                                                        <td class="center ">
                                                                            <a onclick="show($(this))" data-href="{{ url('radios/show/'.$tr->id)}}" class="btn btn-primary btn-xs view"><i class="fa fa-edit "></i> view</a>
                                                                            <a onclick="edit($(this))" data-href="{{ url('radios/edit/'.$tr->id)}}" class="btn btn-danger btn-xs edit"><i class="fa fa-pencil "></i> Edit</a>                                                       
                                                                            <a onclick="radio_delete($(this))" data-href="{{ url('radios/delete/'.$tr->id)}}" data-method="delete" class="btn btn-danger btn-xs delete"><i class="fa fa-pencil "></i> Delete</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="dataTables_info" id="dataTables-example_info" role="alert" aria-live="polite" aria-relevant="all">Tatal <?php echo $radios->total() ?> counts</div>

                                                            </div>
                                                            <div class="col-sm-9 ">
                                                                <div  id="dataTables-example_paginate" style="float:right">
                                                                    <?php echo $radios->render(); ?>

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