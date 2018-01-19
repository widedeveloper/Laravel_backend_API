@extends('layouts.layout')
@section('content')

<script>
    $(function(){
        $(".back_button").click(function(){
            location.href = "{{URL::to('regions')}}"
        });

    });
</script>

<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Edit Regions
        </h1>
       
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->
                <div class="box box-info">
                    <!-- form start -->

                    <form class="form-horizontal" id="user_form" name="user_form" action="/regions/{{ $region->id }}" method = "post">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="box-body">
                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Region Name<span class="required">*</span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="name" type="text" value="{{ $region->name }}" placeholder="Name" required>
                                </div>
                            </div>
                            
                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Country<span class="required"></span></label>
                                 <div class="col-xs-4">

                                    <select class = "form-control" name = "country" requried>
                                        @foreach ($countries as $country)
                                            <option {{($region->country_id == $region->id)?"selected":""}} value= "{{$country->id}}">{{$country->name}}</option>
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