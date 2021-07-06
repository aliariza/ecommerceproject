<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;

class SubCategoryController extends Controller
{
    public function SubCategoryView(){

    $categories = Category::orderBy('category_name_tr', 'ASC')->get();

    $subcategories = SubCategory::latest()->get();

    return view('backend.category.subcategory_view', compact('subcategories', 'categories'));

   }


    public function SubCategoryStore(Request $request){

        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_tr' => 'required',
        ],
        [
            'category_id.required' => 'Lutfen bir ana kategori seciniz.',
            'subcategory_name_en.required' => 'Please enter category name.',
            'subcategory_name_tr.required' => 'Lütfen türkce kategori adi giriniz.',

        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_tr' => $request->subcategory_name_tr,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_tr' => strtolower(str_replace(' ', '-', $request->subcategory_name_tr)),
        ]);

        
        toast('<span style="color:black;">Alt Kategori Basariyla eklendi.</span>','success')->hideCloseButton();

        return redirect()->back();

    } // end method

    public function SubCategoryEdit($id){

        $categories = Category::orderBy('category_name_tr', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);

        return view('backend.category.subcategory_edit', compact('categories', 'subcategory'));
    }// end method

     public function SubCategoryUpdate(Request $request)
    {
        
        $subcat_id= $request->id;

        SubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_tr' => $request->subcategory_name_tr,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_tr' => strtolower(str_replace(' ', '-', $request->subcategory_name_tr)),
        ]);

        
        toast('<span style="color:black;">Alt Kategori Basariyla Düzenlendi.</span>','success')->hideCloseButton();

        return redirect()->route('all.subcategory');


    }//end method


    public function SubCategoryDelete($id){

        SubCategory::findOrFail($id)->delete();

        toast('<span style="color:black;">Alt Kategori Basariyla Silindi.</span>','success')->hideCloseButton();

        return redirect()->back();


    }//end method


    ///////////////// THIS IS FOR SUB SUB CATEGORY ////////////
    

    public function SubSubCategoryView(){


    $categories = Category::orderBy('category_name_tr','ASC')->get();

    $subsubcategory = SubSubCategory::latest()->get();

    return view('backend.category.sub_subcategory_view', compact('subsubcategory', 'categories'));

    }
    public function GetSubCategory($category_id){

        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_tr', 'ASC')->get();
        return json_encode($subcat);
    }
    public function GetSubSubCategory($subcategory_id){

        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_tr', 'ASC')->get();
        return json_encode($subsubcat);
    }

    public function SubSubCategoryStore(Request $request){

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_tr' => 'required',
        ],
        [
            'category_id.required' => 'Lütfen bir ana kategori seçiniz.',
            'subcategory_id.required' => 'Lütfen bir alt kategori seçiniz.',

            'subsubcategory_name_en.required' => 'Please enter sub sub category name.',
            'subsubcategory_name_tr.required' => 'Lütfen türkçe alt alt kategori adi giriniz.',

        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_tr' => $request->subsubcategory_name_tr,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_tr' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_tr)),
        ]);

        
        toast('<span style="color:black;">Alt Alt Kategori Basariyla eklendi.</span>','success')->hideCloseButton();

        return redirect()->back();

    } // end method

    public function SubSubCategoryEdit($id){

        $categories = Category::orderBy('category_name_tr', 'ASC')->get();
        $subcategory = SubCategory::orderBy('subcategory_name_tr', 'ASC')->get();
        $subsubcategory = SubSubCategory::findOrFail($id);

        return view('backend.category.sub_subcategory_edit', compact('categories', 'subcategory', 'subsubcategory'));
    }// end method


     public function SubSubCategoryUpdate(Request $request)
    {
        
        $subsubcat_id= $request->id;

        SubSubCategory::findOrFail($subsubcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_tr' => $request->subsubcategory_name_tr,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_tr' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_tr)),
        ]);

        
        toast('<span style="color:black;">Alt Alt Kategori Basariyla Düzenlendi.</span>','info')->hideCloseButton();

        return redirect()->route('all.subsubcategory');


    }//end method
    public function SubSubCategoryDelete($id){

        SubSubCategory::findOrFail($id)->delete();

        toast('<span style="color:black;">Alt Alt Kategori Basariyla Silindi.</span>','success')->hideCloseButton();

        return redirect()->back();


    }//end method

}
