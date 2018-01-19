@extends('layouts.layout')
@section('content')

<script>
   function edit(obj) {
       var id = obj.parent().parent().attr("item_id");
       var url = "{{ url('countries') }}";
       location.href=url + "/" + id + "/edit";
   }

   function show(obj) {
       var url = obj.data('href');
       location.href = url;
   }

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
                <!--//Account list-->
                <div class="box account_list">
                  
                    <div class="box-header with-border">
                        <a href="{{url('/countries/create')}}" class="btn btn-info ">Add New</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th style="width: 10%;"><input type="checkbox" /></th>
                                                <th style="width: 20%;">Name</th>
                                                <th style="width: 20%;">Code</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($countries as $tr):
                                                ?>
                                                <tr class="gradeA odd" item_id="<?php echo $tr->id ?>">
                                                    <td class=""><input type="checkbox" /></td>
                                                    <td class=" "><?php echo $tr->name ?></td>
                                                    <td class=" "><?php echo $tr->code ?></td>

                                                    <td class="center ">
                                                        <a onclick="show($(this))" data-href="{{URL::to('countries/'.$tr->id)}}" class="btn btn-primary btn-xs view"><i class="fa fa-edit "></i> view</a>
                                                        <a onclick="edit($(this))" class="btn btn-danger btn-xs edit"><i class="fa fa-pencil "></i> Edit</a>                                                       
                                                        <a href="{{ url('countries/delete/'.$tr->id)}}" data-method="delete" class="btn btn-danger btn-xs delete"><i class="fa fa-pencil "></i> Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="dataTables_info" id="dataTables-example_info" role="alert" aria-live="polite" aria-relevant="all">Tatal <?php echo $countries->total() ?> counts</div>

                                        </div>
                                         <div class="col-sm-9 ">
                                            <div  id="dataTables-example_paginate" style="float:right">
                                                <?php echo $countries->render(); ?>

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