<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        .div_center{
            text-align: center;
            padding-top:40px;
        }
        .div_center h1{
            font-size:20px;
            font-weight:bold;
        }
        .form-control{
            background-color: #2A3035 !important;
        }
        table{
            margin-top: 20px;
            text-align: center;
        }
        table th{
            color: rgb(240, 239, 239) !important;
        }
        table tbody{
            color: rgb(174, 172, 172) !important;
        }
        .img-responsive{
            width: 50px !important;
            height: 50px !important;
        }
        .alert{
            position: absolute !important;
            right: 15px !important;
            display: flex ;
            justify-content: space-between !important;
            flex-wrap: nowrap !important;
            flex-direction: row-reverse !important;
            width: 300px !important;
            z-index: 2;
        }
        #title_deg{
            text-align: center;
            font-size:30px;
            font-weight: bold;
        }
        th{

        }
        .table td
        {
            white-space:normal;
        }
        .searchinput{
            width: 400px;
            display: inline;
            border-radius: 3px !important;
        }
        .searchinput:focus{
            color: white;
        }
        .searchbutton
        {
            height: 38px;
            width: 80px;
            margin-bottom: 2px;
        }
        .searchdiv
        {
            display: flex;
            justify-content: center;
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 id="title_deg">All Users</h1>


                <div class="searchdiv">
                    <form action="{{url('user_search')}}" method="get">
                        @csrf
                        <input name="search" type="text" class="form-control searchinput" placeholder="Search for Someone" >
                        <input name="searchb" type="submit" class="btn btn-primary searchbutton" value="Search">
                    </form>
                </div>



                @if (session()->has('messageDP'))
                    <div class="alert alert-success" id="mydiv">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{session()->get('messageDP')}}
                    </div>
                @endif
                @if (session()->has('messageD'))
                    <div class="alert alert-warning" id="mydiv">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{session()->get('messageD')}}
                    </div>
                @endif
                <table class="table table-dark table-striped-columns">
                    <thead>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Email Verified</th>
                      <th>Admin</th>
                      <th>Make</th>
                      <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{($user->email_verified_at)? 'True': 'False'}}</td>
                            <td>{{($user->usertype)? 'True': 'False'}}</td>
                            @if ($user->usertype == 1)
                                @if ($CuserId == $user->id)
                                <td><a style="width:70.05px"  href="{{url('MakeUser', $user->id)}}" class="btn btn-dark disabled">User</a></td>
                                @else
                                <td><a style="width:70.05px"  href="{{url('MakeUser', $user->id)}}" class="btn btn-success">User</a></td>
                                @endif
                            @elseif ($user->usertype == 0)
                            <td><a  href="{{url('MakeAdmin', $user->id)}}" class="btn btn-light">Admin</a></td>
                            @endif
                            <td><a href="{{url('DeleteUser', $user->id)}}" class="btn btn-danger">Delete</a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="16">
                                <h2>No Data Found</h2>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                  </table>
            </div>
        </div>
    <!-- container-scroller -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
