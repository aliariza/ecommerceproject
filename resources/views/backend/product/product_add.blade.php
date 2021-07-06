@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">
  
<div class="container-full">
	<!-- Content Header (Page header) -->
		  

	<!-- Main content -->
	<section class="content">

	 <!-- Basic Forms -->
	  <div class="box">
		<div class="box-header with-border">
		  <h4 class="box-title">Ürün Ekle</h4>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
		  <div class="row">
			<div class="col">



				<form method="POST" action="{{ route('product-store') }}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-12">
							<div class="row"> <!-- start 1st row -->
								<div class="col-md-4">
									<div class="form-group">
										<h5>Marka Seçimi <span class="text-danger">*</span></h5>
										<div class="controls">
											<select name="brand_id" class="form-control">
												<option value="" selected="" disabled="" >Marka Seçiniz</option>

												@foreach ($brands as $brand)
												<option value="{{$brand->id}}">{{ $brand->brand_name_tr }}</option>
												@endforeach
											</select>
											@error('brand_id')
												<span class="text-danger">{{ $message }}</span>
											 @enderror
										</div>
									</div>
								</div> <!-- end col-md-4 -->
								
								<div class="col-md-4">
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
								</div> <!-- end col-md-4 -->
								
								<div class="col-md-4">
									<div class="form-group">
										<h5>Alt Kategori Seçimi<span class="text-danger">*</span></h5>
										<div class="controls">
											<select name="subcategory_id" class="form-control">
												<option value="" selected="" disabled="" >Alt Kategori Seçiniz</option>

											</select>
											@error('subcategory_id')
											<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
									</div>
								</div> <!-- end col-md-4 -->
							</div>	<!-- end 1st row -->

							<div class="row"> <!-- start 2nd row -->
								<div class="col-md-4">
									<div class="form-group">
										<h5>Alt-Alt Kategori Seçimi <span class="text-danger">*</span></h5>
										<div class="controls">
											<select name="subsubcategory_id" class="form-control">
												<option value="" selected="" disabled="" >Alt-Alt Kategori Seçiniz</option>

											</select>
											@error('subsubcategory_id')
											<span class="text-danger">{{ $message }}</span>
										 	@enderror
										</div>
									</div>
								</div> <!-- end col-md-4 -->
								
								<div class="col-md-4">
									<div class="form-group">
										<h5>Product Name (En) <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="product_name_en" class="form-control"> 
												@error('product_name_en')
												<span class="text-danger">{{ $message }}</span>
											  @enderror
										</div>
									</div>
								</div> <!-- end col-md-4 -->
								
								<div class="col-md-4">
									
									<div class="form-group">
										<h5>Ürün Adi (Tr) <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="product_name_tr" class="form-control" required=""> 
												@error('product_name_tr')
												<span class="text-danger">{{ $message }}</span>
											  @enderror
										</div>
									</div>
								</div> <!-- end col-md-4 -->
							</div>	<!-- end 2nd row -->					
							
							<div class="row"> <!-- start 3rd row -->
								<div class="col-md-4">
									<div class="form-group">
										<h5>Ürün Kodu<span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="product_code" class="form-control"> 
												@error('product_code')
												<span class="text-danger">{{ $message }}</span>
											  	@enderror
										</div>
									</div>
								</div> <!-- end col-md-4 -->
								
								<div class="col-md-4">
									<div class="form-group">
										<h5>Ürün Adeti <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="product_qty" class="form-control"> 
												@error('product_qty')
												<span class="text-danger">{{ $message }}</span>
											  @enderror
										</div>
									</div>
								</div> <!-- end col-md-4 -->
								
								<div class="col-md-4">
									
									<div class="form-group">
										<h5>Tagler <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="product_tags_tr" class="form-control" value="Lorem,Ipsum,Amet" data-role="tagsinput"> 
												@error('product_tags_tr')
												<span class="text-danger">{{ $message }}</span>
											  @enderror
										</div>
									</div>
								</div> <!-- end col-md-4 -->
							</div>	<!-- end 3rd row -->					

							<div class="row"> <!-- start 4th row -->
								<div class="col-md-4">
									<div class="form-group">
										<h5>Tags (En) <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="product_tags_en" class="form-control" value="Lorem,Ipsum,Kart" data-role="tagsinput"> 
												@error('product_tags_en')
												<span class="text-danger">{{ $message }}</span>
											  	@enderror
										</div>
									</div>
								</div> <!-- end col-md-4 -->
								
								<div class="col-md-4">
									<div class="form-group">
										<h5>Ürün Boyutu <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="product_size_tr" class="form-control" value="XXS,XS,S,M,L,XL,XXL" data-role="tagsinput"> 
												@error('product_size_tr')
												<span class="text-danger">{{ $message }}</span>
											  	@enderror
										</div>
									</div>								
								</div> <!-- end col-md-4 -->
								
								<div class="col-md-4">
									<div class="form-group">
										<h5>Product Size <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="product_size_en" class="form-control" value="XXS,XS,S,M,L,XL,XXL" data-role="tagsinput"> 
												@error('product_size_en')
												<span class="text-danger">{{ $message }}</span>
											  	@enderror
										</div>
									</div>								
								</div> <!-- end col-md-4 -->
							</div>	<!-- end 4th row -->

							<div class="row"> <!-- start 5th row -->
								<div class="col-md-4">
									<div class="form-group">
										<h5>Ürün Rengi (Tr) <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="product_color_tr" class="form-control" value="Kirmizi, Siyah, Mavi, Beyaz" data-role="tagsinput"> 
												@error('product_color_tr')
												<span class="text-danger">{{ $message }}</span>
											  	@enderror
										</div>
									</div>
								</div> <!-- end col-md-4 -->
								
								<div class="col-md-4">
									<div class="form-group">
										<h5>Product Color (En) <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="product_color_en" class="form-control" value="Red, Black, Blue, White" data-role="tagsinput"> 
												@error('product_color_en')
												<span class="text-danger">{{ $message }}</span>
											  	@enderror
										</div>
									</div>								
								</div> <!-- end col-md-4 -->
								
								<div class="col-md-4">
									<div class="form-group">
										<h5>Ürün Satis Fiyati<span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="selling_price" class="form-control"> 
												@error('selling_price')
												<span class="text-danger">{{ $message }}</span>
											  	@enderror
										</div>
									</div>
								</div> <!-- end col-md-4 -->
							</div>	<!-- end 5th row -->

							<div class="row"> <!-- start 6th row -->
								<div class="col-md-4">
									

									<div class="form-group">
										<h5>Ürün Indirimli Fiyati <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="discount_price" class="form-control"> 
												@error('discount_price')
												<span class="text-danger">{{ $message }}</span>
											  	@enderror
										</div>
									</div>								

								</div> <!-- end col-md-4 -->
								
								<div class="col-md-4">
									<div class="form-group">
										<h5>Ana Thumbnail Resmi<span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="file" name="product_thumbnail" class="form-control" onChange="mainThumbUrl(this)"> 
												@error('product_thumbnail')
												<span class="text-danger">{{ $message }}</span>
											  	@enderror
											  	<img src="" id="mainThumb" alt="">
										</div>
									</div>								


								</div> <!-- end col-md-4 -->
								
								<div class="col-md-4">
									<div class="form-group">
										<h5>Çoklu Görüntü<span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg"> 
												@error('multi_img')
												<span class="text-danger">{{ $message }}</span>
											  	@enderror


											  	<div class="row" id="preview_img"></div>
										</div>
									</div>								


								</div> <!-- end col-md-4 -->
							</div>	<!-- end 6th row -->

							<div class="row"> <!-- start 7th row -->
								<div class="col-md-6">
									

									<div class="form-group">
										<h5>Kisa Aciklama (Tr) <span class="text-danger">*</span></h5>
										<div class="controls">
											<textarea name="short_descp_tr" id="textarea" class="form-control" required placeholder="Textarea text"></textarea>	
										</div>
									</div>								

								</div> <!-- end col-md-6 -->
								
								<div class="col-md-6">
									<div class="form-group">
										<h5>Short Description (En)<span class="text-danger">*</span></h5>
										<div class="controls">
											<textarea name="short_descp_en" id="textarea" class="form-control" required placeholder="Textarea text"></textarea>	
										</div>
									</div>								


								</div> <!-- end col-md-6 -->
								
								
							</div>	<!-- end 7th row -->

							<div class="row"> <!-- start 8th row -->
								<div class="col-md-6">
									<div class="form-group">
										<h5>Uzun Aciklama (Tr) <span class="text-danger">*</span></h5>
										<div class="controls">
											<textarea id="editor1" name="long_descp_tr" rows="10" cols="80">Uzun Aciklama (Tr)</textarea>
										</div>
									</div>								

								</div> <!-- end col-md-6 -->
								
								<div class="col-md-6">
									<div class="form-group">
										<h5>Long Description (En)<span class="text-danger">*</span></h5>
										<div class="controls">
											<textarea name="long_descp_en" id="editor2" rows="10" cols="80">Long Description (En)</textarea>	
										</div>
									</div>	
								</div> <!-- end col-md-6 -->
							</div>	<!-- end 8th row -->


						</div>
					</div>
<hr>
					<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="controls">
										<fieldset>
											<input type="checkbox" name="hot_deal" id="checkbox_1" value="1">
											<label for="checkbox_1">Hot Deals</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" name="featured" id="checkbox_2" value="1">
											<label for="checkbox_2">Featured</label>
										</fieldset>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="controls">
										<fieldset>
											<input type="checkbox" name="special_offer" id="checkbox_3" value="1">
											<label for="checkbox_3">Special Offer</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" name="special_deals" id="checkbox_4" value="1">
											<label for="checkbox_4">Special Deals</label>
										</fieldset>
									</div>
								</div>
							</div>
					</div>
					
					<div class="text-xs-right">
	          			<input type="submit" class="btn btn-primary mb-5 btn-block" value="Ekle">
					</div>

				</form>

			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</div>
		<!-- /.box-body -->
	  </div>
	  <!-- /.box -->

	</section>
	<!-- /.content -->
</div>
 
<script type="text/javascript">
	$(document).ready(function(){
		$('select[name="category_id"]').on('change', function(){
			var category_id = $(this).val();
			if (category_id) {
					$.ajax({
						url:"{{ url('/category/subcategory/ajax') }}/"+category_id,
						type:"GET",
						dataType:"json",
						success:function(data) {
							$('select[name="subsubcategory_id"]').html('');
							var d = $('select[name="subcategory_id"]').empty();
								$.each(data,function(key, value){
									$('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_tr + '</option>');
								});
						},
					});
			} else {
				alert('danger');
			}
		});


		$('select[name="subcategory_id"]').on('change', function(){
			var subcategory_id = $(this).val();
			if (subcategory_id) {
					$.ajax({
						url:"{{ url('/category/sub-subcategory/ajax') }}/"+subcategory_id,
						type:"GET",
						dataType:"json",
						success:function(data) {
							var d = $('select[name="subsubcategory_id"]').empty();
								$.each(data,function(key, value){
									$('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_tr + '</option>');
								});
						},
					});
			} else {
				alert('danger');
			}
		});

	});
</script>


<script type="text/javascript">
	function mainThumbUrl(input){

		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThumb').attr('src', e.target.result).width(80).height(80);
			};
			reader.readAsDataURL(input.files[0]);

		}
	}
</script>

<script>
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>
@endsection