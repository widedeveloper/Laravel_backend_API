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
           Add Podcast
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->
                <form role="form" id="user_form" name="user_form" action="{{url('/podcasts')}}" method = "post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box box-primary">
                   
                    <!-- form start -->
                   
                    <div class="box-body">
                        <div class="form-group">
                            <label for="Name">Title*</label>
                            <input class="form-control" name="title" value="" type="text" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="Url">Url*</label>
                            <input class="form-control" name="url" value="" type="text" required>
                        </div>
                        <div class="form-group">
                            
                            <label for="exampleInputFile">Image</label><br>
                            <img src="" id="image_file" />
                            <input id="file" name="image" onchange="readURL(this)" type="file">
                        </div>
                       
                         <div class="form-group">
                            <label>Country*</label>
                            <select class="form-control" name="country_id">
                            @foreach ($countries as $row)
                                <option value="{{$row->id}}" >{{$row->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        
                    </div>
                    
                    <!-- /.box-body -->

                </div>
                

                 <div class="box-footer">
                    <button type="submit" class="btn btn-primary ">Add</button>
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