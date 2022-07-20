<!DOCTYPE html>
<html lang="en">
    @include('dashboard/head')
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 mt-4">
                <h1>Register Seller</h1><hr>
                <form method="post" action="{{route('seller.create')}}" autocomplete="off">
                    @csrf
                    @if (Session::get('success'))
                        <div class="alert alert-success" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                            {{ Session::get('success') }}
                        </div>
                    
                    @endif
                    @if (Session::get('fail'))
                        <div class="alert alert-success" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                            {{ Session::get('fail') }}
                        </div> 
                    
                    @endif
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Enter Full Name" name="name" value="{{old('name')}}">
                        <span class="text-danger"> @error('name'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="email" value="{{old('email')}}">
                        <span class="text-danger"> @error('email'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Phone Number</label>
                        <input type="number" class="form-control" placeholder="Enter Phone Number" name="phone" value="{{old('password')}}">
                        <span class="text-danger"> @error('password'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" value="{{old('password')}}">
                        <span class="text-danger"> @error('password'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="cpassword" value="{{old('cpassword')}}">
                        <span class="text-danger"> @error('cpassword'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <br>
                    <a href="{{ url('/seller/') }}" >already have an account</a>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>