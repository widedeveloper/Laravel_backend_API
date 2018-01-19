@extends('layouts.layout')
@section('content')

<script>
    $(function(){
        $(".back_button").click(function(){
            location.href = "{{URL::to('countries')}}"
        });

    });
</script>

<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Edit Country
        </h1>
       
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->
                <div class="box box-info">
                    <!-- form start -->

                    <form class="form-horizontal" id="country_form" name="country_form" action="/countries/{{ $country->id }}" method = "post">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="box-body">
                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Title<span class="required">*</span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="name" type="text" value="{{ $country->name }}" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Code<span class="required"></span></label>
                                 <div class="col-xs-4">
                                    <input class="form-control" name="code" type="text" value="{{ $country->code }}" placeholder="Code" required>
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