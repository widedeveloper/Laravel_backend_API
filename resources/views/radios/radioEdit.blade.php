@extends('layouts.layout')
@section('content')

<script>
    $(function(){
        $(".back_button").click(function(){
            // location.href = "{{URL::to('regions')}}"
            location.href = "{{ URL::previous() }}"
        });

        $(".stream_add").click(function(){
            var tr = $(".stream_tr_template .template_table tr").get(0);
            var clone = tr.cloneNode(true);
            // stream_table
            var stream_table = $(".stream_table");
            $(clone).appendTo(stream_table);
        });

        
    });

   function delete_stream(obj) {
        var tr_obj = obj.parent().parent();
        console.log(tr_obj);
        var item_id = tr_obj.attr("item_id");
        if(item_id != "new") {
            if(confirm("Are you sure?")==true) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType:'json',
                    url: "{{ url('streams') }}"+"/delete_stream",
                    data: {
                        id : item_id
                    },
                    success: function (data) {
                        alert(data);
                    }
                });
            }
        }
        tr_obj.remove();
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#logo_file')
                    .attr('src', e.target.result)
                    .width(145);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function checkclick(obj){
        if (obj.checked) {
           var status = 1;
        } else { 
           var status = 0;
        }
        $(obj).parent().find("#chkstream").val(status);
        alert(status)
    }
    function select_country(obj) {
        var country_id = obj.val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            dataType:'json',
            url: "{{ url('radios') }}"+"/select_country",
            data: {
                id : country_id
            },
            success: function (data) {

                if(data.status == "OK"){
                    $(".region_list option").remove();
                    var region_list = data.region;
                    var region_option = "";
                    for(var i =0; i<region_list.length; i++){
                        region_option += '<option  value="'+ region_list[i].id +'" >'+ region_list[i].name +'</option>';
                    }
                    $(".region_list").append($(region_option));
                }
            }
        });

    }
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper" style="min-height: 916px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Edit Radios
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->
                <form role="form" id="user_form" name="user_form" action="/radios/{{ $radio->id }}" method = "post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                   
                    <div class="box-body">
                        <div class="form-group">
                            <label for="Name">Name*</label>
                            <input class="form-control" name="name" value="{{$radio->name}}" type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="Dial">Dial</label>
                            <input class="form-control" name="dial" value="{{$radio->dial}}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="Url">Url</label>
                            <input class="form-control" name="radio_url" value="{{$radio->url}}" type="text">
                        </div>
                        <div class="form-group">
                            
                            <label for="exampleInputFile">Logo</label><br>
                            <img src="{{$radio->logo}}" id="logo_file" />
                            <input id="file" name="logo" onchange="readURL(this)" type="file">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="radio_status" {{($radio->status==1)?"checked":""}} > Status
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Type*</label>
                            <select class="form-control" name="radio_type">
                                <option value="FM" {{($radio->type=="FM")?"selected":""}}>FM</option>
                                <option value="AM" {{($radio->type=="AM")?"selected":""}}>AM</option>
                            </select>
                        </div>
                      
                        <div class="form-group">
                            <label>Country*</label>
                            <select class="form-control" name="country_id" onchange="select_country($(this))">
                            @foreach ($countries as $row)
                                <option value="{{$row->id}}" {{($row->id==$radio->country_id)?"selected":""}}>{{$row->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Region</label>
                            <select class="form-control region_list" name="region_id" >
                            @foreach ($regions as $row)
                                <option value="{{$row->id}}" {{($row->id==$radio->region_id)?"selected":""}}>{{$row->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Categories</label>
                            <input class="form-control" name="categories" value="{{$radio->categories}}" type="text">
                        </div>
                    </div>
                    
                    <!-- /.box-body -->

                </div>
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Streamings</h3>
                    </div>
                    <div class="box-body">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th style="display:none">Id</th>
                                        <th style="width:40%;">Url</th>
                                        <th style="width:30%;">Type</th>
                                        <th style="width:20%;">Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="stream_table">
                                    @foreach ($stream as $row)
                                    <tr item_id="{{$row->id}}">
                                        <td style="display:none"><input name="stream_id[]" id="stream_id" value="{{$row->id}}"></td>
                                        <td><input class="form-control" type="text" name="stream_url[]" value="{{$row->url}}" required/></td>
                                        <td>
                                            <select  class="form-control" name="stream_type[]">
                                            @foreach ($stream_types as $type)
                                                <option value="{{$type->stream_type}}" {{($type->stream_type==$row->type)?"selected":""}}>{{$type->stream_type}}</option>
                                            @endforeach
                                            </select>
                                            
                                        </td>
                                        <td>
                                            <input onclick = "checkclick(this)" type="checkbox" name="stream_status[]" value="{{($row->status==1)?1:0}}" {{($row->status==1)?"checked":""}}  />
                                            <input type="hidden" name="s_status[]" id="chkstream" value="{{($row->status==1)?'1':'0'}}" />
                                        </td>
                                        <td>
                                            <a onclick="delete_stream($(this))" class="label label-danger delete_stream_row" >Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-success pull-right stream_add">Add New</button>
                    </div>
                </div>

                 <div class="">
                    <button type="submit" class="btn btn-primary radio_save">Update</button>
                </div>
                </form>
                <!-- /.col -->
            </div>
           
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


    <div class="stream_tr_template" style="display:none">
        <table class="template_table">
            <tr item_id = "new">
                <td style="display:none"><input name="stream_id[]" id="stream_id" value="new_row" required></td>
                <td><input class="form-control" type="text" name="stream_url[]" value="" /></td>
                <td>
                    <select  class="form-control" name="stream_type[]">
                    @foreach ($stream_types as $type)
                        <option value="{{$type->stream_type}}" >{{$type->stream_type}}</option>
                    @endforeach
                    </select>
                   
                </td>
                <td>
                    <input onclick = "checkclick(this)" type="checkbox" name="stream_status[]" value="0"/>
                    <input type="hidden" name="s_status[]" id="chkstream" value="0" />
                                        
                </td>
                <td>
                    <a onclick="delete_stream($(this))" class="label label-danger delete_stream_row">Delete</a>
                </td>
            </tr>
        </table>
    </div>
</div>

@endsection