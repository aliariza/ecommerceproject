@extends('admin.admin_master')
@section('admin')


<div class="container-full">

<!-- Main content -->
<section class="content">
  <div class="row">
	
	<div class="col-8">

	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Alt Kategori  Listesi</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
			  <table id="example1" class="table table-bordered table-striped text-center">
				<thead>
					<tr>
						<th>Kategori</th>
						<th>Alt Kategori (In)</th>
						<th>Alt Kategori (Tr)</th>
						<th>Islemler</th>
					</tr>
				</thead>
				<tbody>

					@foreach ($subcategories as $subcategory)
					<tr>
						<td>{{ $subcategory['category']['category_name_tr'] }}</td>
						<td>{{ $subcategory->subcategory_name_en }}</td>
						<td>{{ $subcategory->subcategory_name_tr }}</td>

						<td class="d-flex justify-content-around">
							
							<a class="text-info" href="{{ route('subcategory.edit', $subcategory->id) }}" title="Düzenle"><i class="fa fa-edit fa-lg"></i></a>

							<a class="text-danger" onclick="return confirm('Emin misiniz?')" href="{{route('subcategory.delete', $subcategory->id)}}" title="Sil"><i class="fa fa-trash fa-lg"></i></a>

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

<!-- ------------- ADD Category PAGE ------------- -->
	<div class="col-4">

	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Alt Kategori Ekle</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			
			<form method="POST" action="{{ route('subcategory.store') }}" enctype="multipart/form-data">
				@csrf
        		<div class="row">
          			<div class="col-12"> 
							<div class="form-group">
								<h5>Ana Kategori <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" class="form-control">
										<option value="" selected="" disabled="" >Ana Kategori Seciniz</option>

										@foreach ($categories as $category)
										<option value="{{$category->id}}">{{ $category->category_name_tr }}</option>
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
							  <input type="text"  name="subcategory_name_en" class="form-control"> 
							  @error('subcategory_name_en')
								<span class="text-danger">{{ $message }}</span>
							  @enderror
							</div>
						</div>

						<div class="form-group">
							<h5>Alt Kategori (Tr)<span class="text-danger">*</span></h5>
						    <div class="controls">
						      <input type="text" name="subcategory_name_tr" class="form-control">
						      @error('subcategory_name_tr')
								<span class="text-danger">{{ $message }}</span>
						      @enderror
							</div>
						</div>

                	</div>
				</div>

		        <div class="text-xs-right">
		          <input type="submit" class="btn btn-primary mb-5 btn-block" value="Ekle">
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