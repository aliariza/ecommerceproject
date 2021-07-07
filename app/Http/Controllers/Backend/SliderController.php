<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use Carbon\Carbon;
use Image;

class SliderController extends Controller
{
    
public function SliderView(){

    $slider = Slider::latest()->get();
    return view('backend.slider.slider_view',compact('slider'));

}//end method

public function SliderStore(Request $request){

    $request->validate([
        'slider_image' => 'required',
    ],
    [
        'slider_image.required' => 'Lutfen bir resim seciniz...',

    ]);

    $image =$request->file('slider_image');
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gen);
    $save_url = 'upload/slider/'.$name_gen;

    Slider::insert([
        'title' => $request->title,
        'description' => $request->description,
        'slider_image' => $save_url,
    ]);

    
    toast('<span style="color:black;">Slider Basariyla eklendi.</span>','success')->hideCloseButton();

    return redirect()->back();

    } // end method

public function SliderEdit($id){
    $slider = Slider::findOrFail($id);
    return view('backend.slider.slider_edit', compact('slider'));


}//end method


public function SliderUpdate(Request $request){

    $slider_id = $request->id;
    $old_img = $request->old_image;

    if ($request->file('slider_image')) {
        unlink($old_img);
        $image =$request->file('slider_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gen);
        $save_url = 'upload/slider/'.$name_gen;

        Slider::findOrFail($slider_id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'slider_image' => $save_url,
    ]);


        toast('<span style="color:black;">Slider Basariyla Guncellendi</span>','info')->hideCloseButton();

        return redirect()->route('manage-slider');

    }else{
        Slider::findOrFail($slider_id)->update([
            'title' => $request->title,
            'description' => $request->description,
            
        ]);

        
        toast('<span style="color:black;">Slider Resimsiz Guncellendi</span>','info')->hideCloseButton();

        return redirect()->route('manage-slider');

    }// end else

}//end method


public function SliderInactive($id){

    Slider::findOrFail($id)->update(['status' => 0]);
    toast('<span style="color:black;">Aktif Degil.</span>','success')->hideCloseButton();
    return redirect()->back();  
}//end method

public function SliderActive($id){
    Slider::findOrFail($id)->update(['status' => 1]);
    toast('<span style="color:black;">Aktif</span>','success')->hideCloseButton();
    return redirect()->back(); 
}//end method

public function SliderDelete($id){

    $slider = Slider::findOrFail($id);
    $img = $slider->slider_image;
    unlink($img);

    Slider::findOrFail($id)->delete();

    toast('<span style="color:black;">Slider Basariyla Silindi!</span>','danger')->hideCloseButton();

    return redirect()->back();

}
}
