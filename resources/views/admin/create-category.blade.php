@extends('admin.layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form id="categoryForm" name="categoryForm">
            @csrf
        <div class="card">
            <div class="card-body">	

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            <p></p>	
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">	
                            <p></p>
                        </div>
                    </div>	

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        </div>
                    </div>									
                </div>
            </div>							
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="#" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('js')

<script>


    $("#categoryForm").submit(function(event) {
        event.preventDefault();

        var formdata=$(this);

        $("button[type=submit]").prop("disabled",true);

        $.ajax({
            url:"{{ route('category.store') }}",
            type: "post",
            data:formdata.serializeArray(),
            dataType: "json",
            success: function(response){

                if(response["status"]==true){
                    window.location.href="{{ route('category.list') }}";
                    $("button[type=submit]").prop('disabled', false);
                }else
                {

                    var errors=response['errors'];
    
                    if(errors['name'])
                    {
                        $("#name").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['name']);
                    }else
                    {
                        $("#name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }
    
                    if(errors['slug'])
                    {
                        $("#slug").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['slug']);
                    }else
                    {
                        $("#slug").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }
                }

            },  
            complete: function(){
                $("button[type=submit]").prop('disabled', false);
     } 
    });

    });



    $("#name").change(function(){
        element=$(this);
        $.ajax({
                url:"{{ route('getSlug') }}",
                type: "get",
                data:{title: element.val()},
                dataType: "json",
                success: function(response){
                    if(response['status']==true)
                    {
                        $('#slug').val(response['slug']);
                    }
                }
            });
        });

    </script>
    
@endsection