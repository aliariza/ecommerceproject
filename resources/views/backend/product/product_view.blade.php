@extends('admin.admin_master')
@section('admin')


<div class="container-full">

<!-- Main content -->
<section class="content">
  <div class="row">
	
	<div class="col-12">

	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Urun Listesi</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
			  <table id="example1" class="table table-bordered table-striped text-center">
				<thead>
					<tr>
						<th>Image</th>
						<th>Urun Adi</th>
						<th>Adet Fiyati</th>
						<th>Adet</th>
						<th>Indirimli Fiyati</th>
						<th>Durum</th>
						<th>Islemler</th>
					</tr>
				</thead>
				<tbody>

					@foreach ($products as $product)
					<tr>
						<td><img src="{{ asset($product->product_thumbnail) }}" style="width:60px;height:50px;" alt=""></td>
						<td>{{ $product->product_name_en }}</td>
						<td>{{ $product->selling_price }} ₺</td>
						<td>{{ $product->product_qty }} Adet</td>


						<td>

							@if($product->discount_price == NULL)
								<span class="badge badge-pill badge-danger">Indirim Yok</span>
							@else
							@php
							$amount = $product->selling_price - $product->discount_price;
							$discount = ($amount/$product->selling_price) * 100;
							@endphp

							<span class="badge badge-pill badge-danger">% {{ round($discount) }} </span>
							
							@endif

						</td>
						



						<td>
							@if($product->status == 1)
							<span class="badge badge-pill badge-success">Stokta</span>
							@else
							<span class="badge badge-pill badge-danger">Stokta Yok</span>
							@endif

						</td>

						<td class="d-flex justify-content-around">
							
							<a class="text-primary" href="{{ route('product.edit', $product->id) }}" title="Urun detaylari"><i class="fa fa-eye fa-lg"></i></a>

							<a class="text-info" href="{{ route('product.edit', $product->id) }}" title="Düzenle"><i class="fa fa-edit fa-lg"></i></a>

							<a class="text-danger" onclick="return confirm('Emin misiniz?')" href="{{route('product.delete', $product->id)}}" title="Sil"><i class="fa fa-trash fa-lg"></i></a>
							@if($product->status == 1)
							<a class="text-danger" href="{{ route('product.inactive', $product->id) }}" title="Stokta Yok"><i class="fa fa-arrow-down fa-lg"></i></a>
							@else
							<a class="text-info" href="{{ route('product.active', $product->id) }}" title="Stokta"><i class="fa fa-arrow-up fa-lg"></i></a>
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



  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

</div>



@endsection