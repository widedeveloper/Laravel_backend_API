@extends('layouts.layout')
@section('content')

<script>
    $(function(){
        $(".back_button").click(function(){
            // location.href = "{{URL::to('regions')}}"
            location.href = "{{ URL::previous() }}"
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_file')
                    .attr('src', e.target.result)
                    .width(145);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

   
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper" style="min-height: 916px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Edit Episode
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->
                <form role="form" id="user_form" name="user_form" action="/episodes/{{ $episode->id }}" method = "post" enctype="multipart/form-data">
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
                            <label for="Name">Title*</label>
                            <input class="form-control" name="title" value="{{$episode->title}}" type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="Dial">Url</label>
                            <input class="form-control" name="url" value="{{$episode->url}}" type="text">
                        </div>
                       
                        <div class="form-group">
                            
                            <label for="exampleInputFile">Image</label><br>
                            <img src="{{$episode->image}}" id="image_file" />
                            <input id="file" name="image" onchange="readURL(this)" type="file">
                        </div>
                       
                         <div class="form-group">
                            <label>Country*</label>
                            <select class="form-control" name="podcast_id">
                            @foreach ($podcasts as $row)
                                <option value="{{$row->id}}" {{($row->id==$episode->podcast_id)?"selected":""}}>{{$row->title}}</option>
                            @endforeach
                            </select>
                        </div>
                        
                    </div>
                    
                    <!-- /.box-body -->

                </div>
                

                 <div class="">
                    <button type="submit" class="btn btn-primary radio_save">Update</button>
                    <button type="button" class="btn btn-info back_button">Back</button>
                </div>
                </form>
                <!-- /.col -->
            </div>
           
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

@endsection