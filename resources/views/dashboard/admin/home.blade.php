<!DOCTYPE html>
<html lang="en">
    @include('dashboard/head')
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <h4>Admin Dashboard</h4>
                <table class="table table-striped table-inverse table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{Auth::guard('admin')->user()->name}}</td>
                            <td>{{Auth::guard('admin')->user()->email}}</td>
                            <td>{{Auth::guard('admin')->user()->phone}}</td>

                            <td>
                                <a href="{{route('admin.logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                <form action="{{route('admin.logout')}}" method="POST" class='d-none' id="logout-form">@csrf</form>
                            </td>
                        </tr>
                    </tbody>
            </div>
        </div>
    </div>
</body>
</html>