<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use Alert;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::where('status',1)->orderBy('id','DESC')->get();

        $categories = Category::orderBy('category_name_tr','ASC')->get();
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(5)->get();
        
        $featured = Product::where('featured',1)->orderBy('id','DESC')->get();
        $hotdeals = Product::where('hot_deal',1)->orderBy('id','DESC')->get();
        $specialoffer = Product::where('special_offer',1)->orderBy('id','DESC')->limit(5)->get();
        $specialdeals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(5)->get();

        return view('frontend.index',compact('categories','sliders','products', 'featured','hotdeals','specialoffer','specialdeals'));   
    }

    public function UserLogout()
    {
        Auth::logout();
        return Redirect()->route('login');
    }

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));

    }

    public function UserProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('profile_photo_path'))
        {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            $filename =date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }
        $data -> save();

        toast('<span style="color:black;">Profil verileriniz yenilendi!</span>','success')->hideCloseButton();

        return redirect()->route('dashboard');
 
    }// end method


    public function UserChangePassword(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password',compact('user'));
    }

    public function UserPasswordUpdate(Request $request)
    {

                    

        $validateData = $request->validate(
        [
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldpassword,$hashedPassword)) 
        {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::logout();

            return redirect()->route('user.logout');
        }else
        {

            return redirect()->back();
        }
    }

public function ProductDetails($id,$slug){

$product = Product::findOrFail($id);
$multiImg = MultiImg::where('product_id',$id)->get();
$hotdeals = Product::where('hot_deal',1)->orderBy('id','DESC')->get();


return view('frontend.product.product_details', compact('product','multiImg','hotdeals'));

}

}
