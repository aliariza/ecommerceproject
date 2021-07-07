@extends('admin.admin_master')
@section('admin')


<div class="container-full">

<!-- Main content -->
<section class="content">
  <div class="row">
	
	<div class="col-8">

	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Slider Listesi</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
			  <table id="example1" class="table table-bordered table-striped text-center">
				<thead>
					<tr>
						<th>Slider Resmi</th>
						<th>Slider Baslik</th>
						<th>Slider Aciklama</th>
						<th>Durum</th>
						<th>Islemler</th>
					</tr>
				</thead>
				<tbody>

					@foreach ($slider as $item)
					<tr>
						<td><img src="{{ asset($item->slider_image) }}" alt="" style="width:70px; height: 40px;">
						</td>
						<td>							
							@if($item->title == NULL)
							<span class="text-danger">Baslik Yok</span>
							@else
							<span class="text-success">{{$item->title}}</span>
							@endif
						</td>

						<td>
							@if($item->description == NULL)
							<span class="text-danger">Aciklama Yok</span>
							@else
							<span class="text-success">{{ $item->description }}</span>
							@endif

							
						</td>
						
						<td>
							@if($item->status == 1)
							<span class="badge badge-pill badge-success">Aktif</span>
							@else
							<span class="badge badge-pill badge-danger">Aktif Degil</span>
							@endif
						</td>
						
						<td class="d-flex justify-content-around">
							
							<a class="text-info" href="{{ route('slider.edit', $item->id) }}" title="Düzenle"><i class="fa fa-edit fa-lg"></i></a>

							<a class="text-danger" onclick="return confirm('Emin misiniz?')" href="{{route('slider.delete', $item->id)}}" title="Sil"><i class="fa fa-trash fa-lg"></i></a>

							@if($item->status == 1)
							<a class="text-danger" href="{{ route('slider.inactive', $item->id) }}" title="Aktif Degil"><i class="fa fa-arrow-down fa-lg"></i></a>
							@else
							<a class="text-info" href="{{ route('slider.active', $item->id) }}" title="Aktif"><i class="fa fa-arrow-up fa-lg"></i></a>
							@endif


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

<!-- ------------- ADD SLIDER PAGE ------------- -->
	<div class="col-4">

	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Slider Ekle</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			
			<form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
				@csrf
        		<div class="row">
          			<div class="col-12"> 

                 			<div class="form-group">
												<h5>Slider Resmi<span class="text-danger">*</span></h5>
											    <div class="controls">
											      <input type="file" name="slider_image" class="form-control">
											      @error('slider_image')
													<span class="text-danger">{{ $message }}</span>
											      @enderror
												</div>
											</div>

                  		<div class="form-group">
		                  	<h5>Slider Baslik<span class="text-danger">*</span></h5>
		                    <div class="controls">
		                      <input type="text"  name="title" class="form-control"> 
		                    </div>
                  		</div>
											<div class="form-group">
												<h5>Slider Aciklama<span class="text-danger">*</span></h5>
												<div class="controls">
												  <input type="text"  name="description" class="form-control"> 
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