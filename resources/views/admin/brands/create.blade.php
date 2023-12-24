@extends('admin.layouts.app')

@section('content')
    
<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Brand</h1>
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
                        <form id="brand" name="brand">
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
											<label for="email">Slug</label>
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

$(document).ready(function () {
    $("#brand").submit(function(e) {
            e.preventDefault();

            $("button[type=submit]").prop("disabled", true);


        $.ajax({
            url:"{{ route('brand.store') }}",
            type:"post",
            dataType:'json',
            data:$("#brand").serializeArray(),
            success:function(response)
            {
                if(response.status==true)
                {

                    window.location.href='{{ route("brand.index") }}';
                    
                }else
                {
                  var errors=response.errors;

                  if(errors['name'])
                  {
                    $("#name").siblings('p').addClass("text-danger").text(errors.name);
                }else
                {
                    $("#name").siblings('p').removeClass("text-danger").text("");

                }
                
                if(errors['slug'])
                {
                      $("#slug").siblings('p').addClass("text-danger").text(errors.slug);
                      
                    }else
                    {
                      $("#slug").siblings('p').removeClass("text-danger").text("");

                  }

                }
            },  
            complete:function(){
            $("button[type=submit]").prop("disabled", false);

            }
        })
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

});
    </script>
@endsection