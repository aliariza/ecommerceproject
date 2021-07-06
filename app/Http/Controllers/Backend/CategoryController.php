<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function CategoryView(){

        $categories = Category::latest()->get();

        return view('backend.category.category_view', compact('categories'));


    }

    public function CategoryStore(Request $request){

        $request->validate([
            'category_name_en' => 'required',
            'category_name_tr' => 'required',
            'category_icon' => 'required',
        ],
        [
            'category_name_en.required' => 'Input Category English Name',
            'category_name_tr.required' => 'Türkce Kategori adi giriniz.',

        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_tr' => $request->category_name_tr,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_tr' => strtolower(str_replace(' ', '-', $request->category_name_tr)),
            'category_icon' => $request->category_icon,
        ]);

        
        toast('<span style="color:black;">Kategori Basariyla eklendi.</span>','success')->hideCloseButton();

        return redirect()->back();

    } // end method

        public function CategoryEdit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function CategoryUpdate(Request $request){

        $cat_id = $request->id;

        Category::findOrFail($cat_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_tr' => $request->category_name_tr,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_tr' => strtolower(str_replace(' ', '-', $request->category_name_tr)),
            'category_icon' => $request->category_icon,
        ]);

        
        toast('<span style="color:black;">Kategori Basariyla Düzenlendi.</span>','success')->hideCloseButton();

        return redirect()->route('all.category');

    }//end method


     public function CategoryDelete($id){

        Category::findOrFail($id)->delete();

        toast('<span style="color:black;">Kategori Basariyla Silindi!</span>','info')->hideCloseButton();

        return redirect()->back();

    }// end method

}
