@extends('frontend.main_master')
@section('content')


<div class="body-content">
    <div class="container">
        <div class="row">

            <div class="col-md-2"><br>
                <img src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" alt="" class="card-img-top" style="border-radius:50%;" height="100%" width="100%"><br><br>
                <ul class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-block" style="border-radius:0;background-color:orangered; color:white;">Home</a>
                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm rounded-0 btn-block" >Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </ul>   



            </div> <!-- //end col md 2 -->
            
            <div class="col-md-2">
                

            </div> <!-- //end col md 2 -->
            
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi.... </span><strong>{{ Auth::user()->name }}, </strong> </h3>
                    <h3 class="text-center">Update your profile</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="email">Name</label>
                            <input type="text"  name="name" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="email">Email</label>
                            <input type="email"  name="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="phone">Phone</label>
                            <input type="text"  name="phone" class="form-control" value="{{ $user->phone }}">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="profile_photo_path">User Image</label>
                            <input type="file"  name="profile_photo_path" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-block" style="border-radius:0;">Update</button>
                        </div>
                    </form>
                </div>

            </div> <!-- //end col md 6 -->

        </div> <!-- //end row -->

    </div>

</div>


@endsection
