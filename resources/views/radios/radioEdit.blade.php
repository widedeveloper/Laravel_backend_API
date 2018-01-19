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
            console.log(tr);
            var clone = tr.cloneNode(true);
            // stream_table
            var stream_table = $(".stream_table");
            $(clone).appendTo(stream_table);
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#logo_file')
                    .attr('src', e.target.result)
                    .width(145);
                    // .height(145);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

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
                            <input class="form-control" name="name" value="{{$radio->name}}" type="text">
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
                            <label for="exampleInputEmail1">Original ID</label>
                            <input class="form-control" name="original_id" value="{{$radio->id}}" type="Number">
                        </div>
                         <div class="form-group">
                            <label>Country*</label>
                            <select class="form-control" name="country_id">
                            @foreach ($countries as $row)
                                <option value="{{$row->id}}" {{($row->id==$radio->country_id)?"selected":""}}>{{$row->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Region</label>
                            <select class="form-control" name="region_id">
                            @foreach ($regions as $row)
                                <option value="{{$row->id}}" {{($row->id==$radio->region_id)?"selected":""}}>{{$row->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Source</label>
                            <input class="form-control" name="source" value="{{$radio->source}}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slogan</label>
                            <input class="form-control" name="slogan" value="{{$radio->slogan}}" type="text">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" name="description">{{$radio->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input class="form-control" name="address" value="{{$radio->address}}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input class="form-control" name="email" value="{{$radio->email}}" type="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telephone</label>
                            <input class="form-control" name="telephone" value="{{$radio->telephone}}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Language</label>
                            <input class="form-control" name="language" value="{{$radio->language}}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tunein ID</label>
                            <input class="form-control" name="tuneid" value="{{$radio->tuneid}}" type="number">
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
                                    <tr>
                                        <td style="display:none"><input name="stream_id[]" id="stream_id" value={{$row->id}}></td>
                                        <td><input class="form-control" type="text" name="url[]" value="{{$row->url}}" /></td>
                                        <td>
                                            <select  class="form-control" name="type[]">
                                            @foreach ($stream_types as $type)
                                                <option value="{{$type->stream_type}}" {{($type->stream_type==$row->type)?"selected":""}}>{{$type->stream_type}}</option>
                                            @endforeach
                                            </select>
                                        </td>
                                        <td><input type="checkbox" name="status[]" {{($row->status==1)?"checked":""}}/></td>
                                        <td><span class="label label-danger">Delete</span></td>
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
            <tr >
                <td style="display:none"><input name="stream_id[]" id="stream_id" value="new_row"></td>
                <td><input class="form-control" type="text" name="url[]" value="" /></td>
                <td>
                    <select  class="form-control" name="type[]">
                    @foreach ($stream_types as $type)
                        <option value="{{$type->stream_type}}" >{{$type->stream_type}}</option>
                    @endforeach
                    </select>
                </td>
                <td><input type="checkbox" name="status[]" /></td>
                <td><span class="label label-danger">Delete</span></td>
            </tr>
        </table>
    </div>
</div>

@endsection