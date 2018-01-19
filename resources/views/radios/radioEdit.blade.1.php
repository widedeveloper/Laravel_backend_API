@extends('layouts.layout')
@section('content')

<script>
    $(function(){
        $(".back_button").click(function(){
            // location.href = "{{URL::to('regions')}}"
            location.href = "{{ URL::previous() }}"
        });

    });
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
                <form role="form">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                   
                    <div class="box-body">
                        <div class="form-group">
                            <label for="Name">Name*</label>
                            <input class="form-control" name="name" placeholder="Radio Name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="Dial">Dial</label>
                            <input class="form-control" name="dial" placeholder="Dial" type="text">
                        </div>
                        <div class="form-group">
                            <label for="Url">Url</label>
                            <input class="form-control" name="radio_url" placeholder="Url" type="text">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Logo</label>
                            <input id="exampleInputFile" name="logo" type="file">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="radio_status"> Status
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Type*</label>
                            <select class="form-control" name="radio_type">
                                <option value="FM">FM</option>
                                <option value="AM">AM</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Original ID</label>
                            <input class="form-control" name="original_id" placeholder="original ID" type="Number">
                        </div>
                         <div class="form-group">
                            <label>Country*</label>
                            <select class="form-control" name="country_id">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Region</label>
                            <select class="form-control" name="region_id">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Source</label>
                            <input class="form-control" name="source" placeholder="Source" type="text">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slogan</label>
                            <input class="form-control" name="slogan" placeholder="Slogan" type="text">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input class="form-control" name="address" placeholder="Address" type="text">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input class="form-control" name="email" placeholder="Email" type="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telephone</label>
                            <input class="form-control" name="telephone" placeholder="Telephone" type="text">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Language</label>
                            <input class="form-control" name="language" placeholder="Language" type="text">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tunein ID</label>
                            <input class="form-control" name="tuneid" placeholder="Tunein ID" type="number">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Categories</label>
                            <input class="form-control" name="categories" placeholder="Categories" type="text">
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
                                <tbody>
                                    <tr>
                                        <th style="width:40%;">Url</th>
                                        <th style="width:30%;">Type</th>
                                        <th style="width:20%;">Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                    <tr>
                                        <td><input class="form-control" type="text" name="url" /></td>
                                        <td>
                                            <select  class="form-control" name="type">
                                                <option value="" >AAC</option>
                                                <option value="" >Flash</option>
                                                <option value="" >HLS</option>
                                                <option value="" >MP3</option>
                                                <option value="" >OOG</option>
                                                <option value="" >QuickTime</option>
                                                <option value="" >Real</option>
                                                <option value="" >Windows</option>
                                                <option value="" >WMPro</option>
                                                <option value="" >WMVidoe</option>
                                                <option value="" >WMVoice</option>
                                            </select>
                                        </td>
                                        <td><input type="checkbox" name="status" /></td>
                                        <td><span class="label label-danger">Delete</span></td>
                                    </tr>
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
</div>

@endsection