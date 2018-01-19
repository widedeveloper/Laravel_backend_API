@extends('layouts.layout')
@section('content')

<script>
    $(function(){
        $(".back_button").click(function(){
            location.href = "{{URL::to('users')}}"
        });

    });
</script>

<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Users
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->

                <div class="box box-info">
                    <!-- form start -->

                    <form class="form-horizontal" id="role_form" name="role_form" action="{{url('/users')}}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Name<span class="required">*</span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="name" type="text" value="" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Email<span class="required"></span></label>
                                 <div class="col-xs-4">
                                    <input class="form-control" name="email" type="text" value="" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Role<span class="required"></span></label>
                                 <div class="col-xs-4">
                                    <!-- <input class="form-control" name="email" type="text" value="" placeholder="Email" required> -->

                                    <select class = "form-control" name = "role" requried>
                                        @foreach ($roles as $role)
                                            <option value= {{$role->id}}>{{$role->title}}</option>
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