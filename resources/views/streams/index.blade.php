@extends('layouts.layout')
@section('content')

<script>
   function edit(obj) {
       var id = obj.parent().parent().attr("item_id");
       var url = "{{ url('streams') }}";
       location.href=url + "/" + id + "/edit";
   }
   function setactive(obj) {
        if (obj.checked) {
           var status = 1;
        } else { 
           var status = 0;
        }
        var stream_id = $(obj).parent().parent().attr("item_id");
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            type: "POST",
            dataType:'json',
            url: "{{ url('streams') }}"+"/setstatus",
            data: {
                status : status, id : stream_id
            },
            success: function (data) {
                alert(data);
            }
        });
       
    }

    function stream_delete(obj) {
        if(confirm("are you sure?")==true){
            var url = obj.data('href');
            location.href = url;
        }
    }
  
</script>
<div class="content-wrapper" style="min-height: 916px;">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Streammings
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">               
                <!--//Account list-->
                <div class="box account_list">
                  
                    <!-- <div class="box-header with-border">
                        <a href="{{url('/regions/create')}}" class="btn btn-info ">Add New</a>
                    </div> -->
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th style="width: 10%;"><input type="checkbox" /></th>
                                                <th style="width: 40%;">Url</th>
                                                <th style="width: 10%;">Status</th>
                                                <th style="width: 20%;">Type</th>
                                                <th style="width: 10%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach ($streams as $tr)
                                                <tr class="gradeA odd" item_id="{{ $tr->id }}">
                                                    <td class=""></td>
                                                    <td class=" ">{{ $tr->url }}</td>
                                                    <td class=" "><input onclick = "setactive(this)" type="checkbox" {{($tr->status==1)?"checked":"" }} /></td>
                                                    <td class=" ">{{ $tr->type }}</td>

                                                    <td class="center ">
                                                        <!-- <a onclick="show($(this))" data-href="{{URL::to('regions/'.$tr->id)}}" class="btn btn-primary btn-xs view"><i class="fa fa-edit "></i> view</a> -->
                                                        <a onclick="edit($(this))" class="btn btn-success btn-xs edit"><i class="fa fa-pencil "></i> Edit</a>                                                       
                                                        <a onclick="stream_delete($(this))" data-href="{{ url('streams/delete/'.$tr->id)}}"  data-method="delete" class="btn btn-danger btn-xs delete"><i class="fa fa-pencil "></i> Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="dataTables_info" id="dataTables-example_info" role="alert" aria-live="polite" aria-relevant="all">Tatal <?php echo $streams->total() ?> counts</div>

                                        </div>
                                         <div class="col-sm-9 ">
                                            <div  id="dataTables-example_paginate" style="float:right">
                                                <?php echo $streams->render(); ?>

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
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<style>
    .form-group.custom_input{
        margin-right: 20px
    }
</style>
@endsection