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
            width: 350px !important;
            height: 100px !important;
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
        td
        {
            white-space:break-spaces !important;
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
                @if (session()->has('messageDP'))
                    <div class="alert alert-danger" id="mydiv">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{session()->get('messageDP')}}
                    </div>
                @endif
                <table class="table table-dark table-striped-columns">
                    <thead>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Discount price</th>
                      <th>Category</th>
                      <th>Image</th>
                      {{-- <th> Actions</th> --}}
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->discount_price}}</td>
                            <td>{{$item->category}}</td>
                            <td><img class="img-responsive" src="Product/{{$item->image}}" alt=""></td>
                            <td><a onclick="return confirm('Are you sure you want to delete {{$item->title}}')" href="{{url('delete_product', $item->id)}}" class="btn btn-danger">Delete</a></td>
                            <td><a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" href="{{url('update_product', $item->id)}}">Update</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Recipient:</label>
                      <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Message:</label>
                      <textarea class="form-control" id="message-text"></textarea>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Send message</button>
                </div>
              </div>
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
