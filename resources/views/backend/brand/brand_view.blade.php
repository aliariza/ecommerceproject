@extends('admin.admin_master')
@section('admin')


<div class="container-full">

<!-- Main content -->
<section class="content">
  <div class="row">
	
	<div class="col-8">

	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Brand List</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
			  <table id="example1" class="table table-bordered table-striped text-center">
				<thead>
					<tr>
						<th>Brand Name En</th>
						<th>Brand Tr</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					@foreach ($brands as $brand)
					<tr>
						<td>{{ $brand->brand_name_en }}</td>
						<td>{{ $brand->brand_name_tr }}</td>
						<td><img src="{{ asset($brand->brand_image) }}" alt="" style="width:70px; height: 40px;">
						</td>
						<td class="d-flex justify-content-around">
							
							<a class="text-info" href="{{ route('brand.edit', $brand->id) }}" title="Düzenle"><i class="fa fa-edit fa-lg"></i></a>

							<a class="text-danger" onclick="return confirm('Emin misiniz?')" href="{{route('brand.delete', $brand->id)}}" title="Sil"><i class="fa fa-trash fa-lg"></i></a>

						</td>
					</tr>
					 @endforeach 
				</tbody>
			  </table>
			</div>
		</div>
		<!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->

<!-- ------------- ADD BRAND PAGE ------------- -->
	<div class="col-4">

	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Add Brand</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			
			<form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
				@csrf
        		<div class="row">
          			<div class="col-12"> 
                  		<div class="form-group">
		                  	<h5>Brand Name English<span class="text-danger">*</span></h5>
		                    <div class="controls">
		                      <input type="text"  name="brand_name_en" class="form-control"> 
		                      @error('brand_name_en')
								<span class="text-danger">{{ $message }}</span>
		                      @enderror
		                    </div>
                  		</div>

						<div class="form-group">
							<h5>Brand Name Turkish<span class="text-danger">*</span></h5>
							<div class="controls">
							  <input type="text"  name="brand_name_tr" class="form-control"> 
							  @error('brand_name_tr')
								<span class="text-danger">{{ $message }}</span>
							  @enderror
							</div>
						</div>

						<div class="form-group">
							<h5>Brand Image<span class="text-danger">*</span></h5>
						    <div class="controls">
						      <input type="file" name="brand_image" class="form-control">
						      @error('brand_image')
								<span class="text-danger">{{ $message }}</span>
						      @enderror
							</div>
						</div>

                	</div>
				</div>

		        <div class="text-xs-right">
		          <input type="submit" class="btn btn-primary mb-5 btn-block" value="Add New">
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