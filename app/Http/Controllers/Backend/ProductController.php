<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MultiImg;
use Carbon\Carbon;
use Image;




class ProductController extends Controller
{
    public function AddProduct(){

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('backend.product.product_add', compact('categories', 'brands'));

    }

    public function StoreProduct(Request $request){

        $image =$request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;


       $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_tr' => $request->product_name_tr,
            'product_slug_en' =>strtolower(str_replace(' ','-',$request->product_name_en)),
            'product_slug_tr' =>strtolower(str_replace(' ','-',$request->product_name_tr)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_tr' => $request->product_tags_tr,
            'product_size_en' => $request->product_size_en,
            'product_size_tr' => $request->product_size_tr,
            'product_color_en' => $request->product_color_en,
            'product_color_tr' => $request->product_color_tr,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_tr' => $request->short_descp_tr,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_tr' => $request->long_descp_tr,
            'product_thumbnail' => $save_url,

            'hot_deal' => $request->hot_deal,

            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'created_at' => Carbon::now(),


        ]);

/////////////// MULTIPLE IMAGE UPLOAD START ///////////
        $images = $request->file('multi_img');

        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;

            MultiImg::insert([

                'product_id' => $product_id, 
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);

        }
        toast('<span style="color:black;">Urun Basariyla eklendi.</span>','success')->hideCloseButton();
        return redirect()->route('manage-product');

/////////////// END MULTIPLE IMAGE UPLOAD START ///////////
    }// end method



    public function ManageProduct(){

        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }


    public function EditProduct($id){
        
        $multiImgs = MultiImg::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $subsubcategory = SubSubCategory::latest()->get();

        $product = Product::findOrFail($id);

        return view('backend.product.product_edit',compact('categories','brands','subcategory','subsubcategory','product', 'multiImgs'));


    }
    public function ProductDataUpdate(Request $request) {
        $product_id = $request->id;
        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_tr' => $request->product_name_tr,
            'product_slug_en' =>strtolower(str_replace(' ','-',$request->product_name_en)),
            'product_slug_tr' =>strtolower(str_replace(' ','-',$request->product_name_tr)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_tr' => $request->product_tags_tr,
            'product_size_en' => $request->product_size_en,
            'product_size_tr' => $request->product_size_tr,
            'product_color_en' => $request->product_color_en,
            'product_color_tr' => $request->product_color_tr,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_tr' => $request->short_descp_tr,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_tr' => $request->long_descp_tr,

            'hot_deal' => $request->hot_deal,

            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'created_at' => Carbon::now(),


        ]);
        toast('<span style="color:black;">Urun Resimsiz olarak Basariyla duzenlendi.</span>','success')->hideCloseButton();
        return redirect()->route('manage-product');

    }

////// Multiple Image Update
    public function MultiImageUpdate(Request $request){

        $imgs = $request->multi_img;

        foreach($imgs as $id => $img){
        $imgDel = MultiImg::findOrFail($id);
        unlink($imgDel->photo_name);

        $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
        $uploadPath = 'upload/products/multi-image/'.$make_name;

        MultiImg::where('id', $id)->update([

            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),
        ]);

    }// end foreach
        toast('<span style="color:black;">Urunun yeni resimleri eklendi.</span>','success')->hideCloseButton();
        return redirect()->back();



    } //end method

////// PRODUCT MAIN THUMBNAIL UPDATE //////////
    public function ThumbnailImageUpdate(Request $request){


        $pro_id = $request->id;

        $oldImage = $request->old_img;

        
        unlink($oldImage);

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

        Product::findOrFail($pro_id)->update([

            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        toast('<span style="color:black;">Urun thumbnail basariyla yenilendi.</span>','success')->hideCloseButton();
        return redirect()->back();

    }// end methods


    /////// Multi Image Delete

    public function MultiImageDelete($id){
        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);
        MultiImg::findOrFail($id)->delete();
        
        toast('<span style="color:black;">Urun resmi silindi.</span>','danger')->hideCloseButton();

        return redirect()->back();

    }// end method

    public function ProductInactive($id){

        Product::findOrFail($id)->update(['status' => 0]);
        toast('<span style="color:black;">Urun stokta yok.</span>','success')->hideCloseButton();
        return redirect()->back();  
    }

    public function ProductActive($id){
        Product::findOrFail($id)->update(['status' => 1]);
        toast('<span style="color:black;">Urun stokta var.</span>','success')->hideCloseButton();
        return redirect()->back(); 
    }


    public function ProductDelete($id){

        $product = Product::findOrFail($id);

        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images= MultiImg::where('product_id', $id)->get();

        foreach($images as $img){

            unlink($img->photo_name);
            MultiImg::where('product_id',$id)->delete();

        }
        toast('<span style="color:black;">Urun basariyla silindi.</span>','success')->hideCloseButton();
        return redirect()->back(); 


    }// end method

    


}
