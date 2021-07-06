@extends('admin.admin_master')
@section('admin')


<div class="container-full">

<!-- Main content -->
<section class="content">
  <div class="row">
	
	

<!-- ------------- ADD BRAND PAGE ------------- -->
	<div class="col-12">

	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Kategori Ekle</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			
			<form method="POST" action="{{ route('category.update',$category->id) }}" enctype="multipart/form-data">
				@csrf

				<input type="hidden" name="id" value="{{ $category->id }}">
				
        		<div class="row">
          			<div class="col-12"> 
                  		<div class="form-group">
		                  	<h5>Category English<span class="text-danger">*</span></h5>
		                    <div class="controls">
		                      <input type="text"  name="category_name_en" class="form-control" value="{{ $category->category_name_en }}"> 
		                      @error('category_name_en')
														<span class="text-danger">{{ $message }}</span>
		                      @enderror
		                    </div>
                  		</div>

						<div class="form-group">
							<h5>Kategori Türkce<span class="text-danger">*</span></h5>
							<div class="controls">
							  <input type="text"  name="category_name_tr" class="form-control" value="{{ $category->category_name_tr }}"> 
							  @error('category_name_tr')
								<span class="text-danger">{{ $message }}</span>
							  @enderror
							</div>
						</div>

						<div class="form-group">
							<h5>Category Icon<span class="text-danger">*</span></h5>
						    <div class="controls">
						      <input type="text" name="category_icon" class="form-control" value="{{ $category->category_icon }}">
						      @error('category_icon')
								<span class="text-danger">{{ $message }}</span>
						      @enderror
							</div>
						</div>

                	</div>
				</div>

		        <div class="text-xs-right">
		          <input type="submit" class="btn btn-primary mb-5 btn-block" value="Kaydet">
		        </div>
			</form>
      	</div>
		<!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->

  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

</div>



@endsection