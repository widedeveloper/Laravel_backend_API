@extends('layouts.layout')
@section('content')

<script>
    $(function(){
        $(".back_button").click(function(){
            location.href = "{{URL::to('streams')}}"
        });

    });
</script>

<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Edit Stream
        </h1>
       
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->
                <div class="box box-info">
                    <div class="box-body">
                        <div class="col-xs-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th style="width:50%">Country Name:</th>
                                            <td>{{ $stream[0]->country_name }}</td>
                                        </tr>
                                        <tr>
                                            <th style="width:50%">Region Name:</th>
                                            <td>{{ $stream[0]->region_name }}</td>
                                        </tr>
                                        <tr>
                                            <th style="width:50%">Radio Name:</th>
                                            <td>{{ $stream[0]->radio_name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- form start -->

                    <form class="form-horizontal" id="user_form" name="user_form" action="/streams/{{ $stream[0]->id }}" method = "post">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="box-body">
                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">URL<span class="required">*</span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="url" type="text" value="{{ $stream[0]->url }}" placeholder="Name" required>
                                </div>
                            </div>
                            
                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Type<span class="required"></span></label>
                                 <div class="col-xs-4">

                                    <select class = "form-control" name = "type" requried>
                                        @foreach ($types as $type)
                                            <option {{($stream[0]->type == $type->stream_type)?"selected":""}} value= "{{$type->stream_type}}">{{$type->stream_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                        </div>
                        <div class="box-footer">
                            <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                            <button type="submit" class="btn btn-info save_button">Save</button>
                            <button type="button" class="btn btn-info back_button">Back</button>
                        </div>
                    </form>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection