<!DOCTYPE html>
<html lang="en">
  <head>
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
        #Cate1{
            color: #fff;
            margin: 20px auto 20px auto;
            width:300px;
            border-radius:10px;
        }
        #Cate2{
            border: 1px solid rgb(155, 235, 155);
            border-radius:6px;
        }
        .alert{
            position: absolute !important;
            right: 15px !important;
            display: flex ;
            justify-content: space-between !important;
            flex-wrap: nowrap !important;
            flex-direction: row-reverse !important;
            width: 300px !important;
        }
        table{
            margin-top: 20px;
        }
        table th{
            color: rgb(240, 239, 239) !important;
        }
        table tbody{
            color: rgb(174, 172, 172) !important;
        }
    </style>
    <!-- Required meta tags -->
    @include('admin.css')
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

                @if (session()->has('message'))
                    <div class="alert alert-success" id="mydiv">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{session()->get('message')}}
                    </div>
                @elseif (session()->has('messageD'))
                    <div class="alert alert-danger" id="mydiv">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{session()->get('messageD')}}
                    </div>
                @endif

                <div class="div_center">
                    <h1>Add Category</h1>
                    <form action="{{url('/add_category')}}" method="POST">
                        @csrf
                        <input type="text" name="category" class="form-control" id="Cate1" placeholder="Enter Category name ">
                        <input type="submit" value="Add Category" id="Cate2"  name="submit" class="btn btn-primary"/>
                    </form>
                </div>
                <table class="table table-dark table-striped-columns">
                    <thead>
                      <th>ID</th>
                      <th>Category Name</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->category_name}}</td>
                            <td><a onclick="return confirm('Are you sure you want to delete {{$item->category_name}}')" href="{{url('delete_category', $item->id)}}" class="btn btn-danger">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    <!-- container-scroller -->
    @include('admin.script')
    <script>
        setTimeout(function() {
        $("#mydiv").fadeOut().empty();
        }, 3000);
    </script>
    <!-- End custom js for this page -->
  </body>
</html>
