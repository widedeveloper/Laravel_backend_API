@extends('layouts.layout')
@section('content')

<script>
   
    function radio_delete(obj) {
        if(confirm("are you sure?")==true){
            var url = obj.data('href');
            location.href = url;
        }
    }

    function show (obj) {
         location.href = obj.data('href');
    }

    function edit(obj) {
        var id = obj.parent().parent().attr("item_id");
        var url = "{{ url('podcasts') }}";
        location.href=url + "/" + id + "/edit";
    }
</script>

<div class="content-wrapper" style="min-height: 916px;">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Podcasts
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
                        

                       <div class="nav-tabs-custom">
                            
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="box account_list">
                                    <div class="box-header with-border">
                                        <a href="{{url('/podcasts/create')}}" class="btn btn-info ">Add New</a>
                                    </div>
                                        <div class="box-body">
                                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th style="width:20%;">Title</th>
                                                                    <th style="width:20%;">Url</th>
                                                                    <th style="width:20%;">Image</th>
                                                                    <th style="width:15%;">Country</th>
                                                                    
                                                                    <!-- <th style="width:30%;">streamings</th> -->
                                                                    <th style="width:25%;"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($podcasts as $tr)
                                                                    <tr class="gradeA odd" item_id="{{$tr->id}}">
                                                                        <td class=" ">{{$tr->title }}</td>
                                                                        <td class=" ">{{$tr->url }}</td>
                                                                        <td class=" "><img src = "{{$tr->image }}" width="145px" /></td>
                                                                        <td class=" "> {{$tr->country_name }} </td>
                                                                       
                                                                        <td class="center ">
                                                                            <!-- <a onclick="show($(this))" data-href="{{ url('radios/show/'.$tr->id)}}" class="btn btn-primary btn-xs view"><i class="fa fa-edit "></i> view</a> -->
                                                                            <a onclick="edit($(this))" class="btn btn-success btn-xs edit"><i class="fa fa-pencil "></i> Edit</a>                                                       
                                                                            <a onclick="radio_delete($(this))" data-href="{{ url('podcasts/delete/'.$tr->id)}}" data-method="delete" class="btn btn-danger btn-xs delete"><i class="fa fa-pencil "></i> Delete</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="dataTables_info" id="dataTables-example_info" role="alert" aria-live="polite" aria-relevant="all">Tatal <?php echo $podcasts->total() ?> counts</div>

                                                            </div>
                                                            <div class="col-sm-9 ">
                                                                <div  id="dataTables-example_paginate" style="float:right">
                                                                    <?php echo $podcasts->render(); ?>

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