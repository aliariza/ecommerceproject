@extends('admin.admin_master')
@section('admin')


<div class="container-full">

<!-- Main content -->
<section class="content">
  <div class="row">
	
	

<!-- ------------- ADD SUB Category PAGE ------------- -->
	<div class="col-12">

	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Alt Kategori Duzenle</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			
			<form method="POST" action="{{ route('subcategory.update') }}" enctype="multipart/form-data">
				@csrf

				<input type="hidden" name="id" value="{{ $subcategory->id }}">
        		<div class="row">
          			<div class="col-12"> 
							<div class="form-group">
								<h5>Ana Kategori <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" class="form-control">
										<option value="" selected="" disabled="" >Ana Kategori Seciniz</option>

										@foreach ($categories as $category)
										<option value="{{$category->id}}" {{ $category->id == $subcategory->category_id ? 'selected': '' }}>{{ $category->category_name_tr }}</option>
										@endforeach
									</select>
								@error('category_id')
								<span class="text-danger">{{ $message }}</span>
							  @enderror

								</div>
							</div>

						<div class="form-group">
							<h5>Sub Category (En)<span class="text-danger">*</span></h5>
							<div class="controls">
							  <input type="text"  name="subcategory_name_en" class="form-control" value="{{$subcategory->subcategory_name_en}}"> 
							  @error('subcategory_name_en')
								<span class="text-danger">{{ $message }}</span>
							  @enderror
							</div>
						</div>

						<div class="form-group">
							<h5>Alt Kategori (Tr)<span class="text-danger">*</span></h5>
						    <div class="controls">
						      <input type="text" name="subcategory_name_tr" class="form-control" value="{{$subcategory->subcategory_name_tr}}">
						      @error('subcategory_name_tr')
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