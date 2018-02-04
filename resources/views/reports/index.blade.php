@extends('layouts.layout')
@section('content')

<script>
   function stream_edit(stream_id) {
        var url = "{{ url('streams') }}";
    //location.href=url + "/" + stream_id + "/edit";
    
         window.open(url + "/" + stream_id + "/edit","_blank")
    }
</script>

<div class="content-wrapper" style="min-height: 916px;">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reports
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
                                            <div class="text-left">
                                                <form action="{{url('/reports')}}" method="get" class="form-inline">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="s" placeholder="Keyword" value="{{($s)?$s:''}}" />
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-primary" type="submit">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        
                                        <div class="box-body">
                                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th style="width:50%;">Radio/Streaming</th>
                                                                    <th style="width:20%;">Created</th>
                                                                    <th style="width:20%;">Country</th>
                                                                    <th style="width:10%;">Reports</th>
                                                                    
                                                                    <!-- <th style="width:25%;"></th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($reports as $tr)
                                                                    <tr class="gradeA odd" item_id="{{$tr->radio_id}}">
                                                                        <td class=" ">
                                                                            <a href="{{ url('radios/edit/'.$tr->radio_id)}}" target="blank">{{$tr->radio_name }}</a>
                                                                            <br>
                                                                            <a onclick="stream_edit({{$tr->stream_id}})" href="#" >{{$tr->stream_url}}</a>
                                                                        </td>
                                                                        <td class=" ">{{$tr->ping_date }}</td>
                                                                        <td class=" ">{{$tr->country_name }}</td>
                                                                        <td class=" ">{{$tr->total}}</td>
                                                                        
                                                                        
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="dataTables_info" id="dataTables-example_info" role="alert" aria-live="polite" aria-relevant="all">Tatal <?php echo $reports->total() ?> counts</div>

                                                            </div>
                                                            <div class="col-sm-9 ">
                                                                <div  id="dataTables-example_paginate" style="float:right">
                                                                   
                                                                    {{$reports->appends(['s'=>$s])->links()}}

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