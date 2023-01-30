<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
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
        /* #Cate1{
            color: #fff;
            margin: 20px auto 20px auto;
            width:300px;
            border-radius:10px;
        }
        #Cate2{
            border: 1px solid rgb(155, 235, 155);
            border-radius:6px;
        } */
        .form-control:focus{
            color: #fff !important;
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
        table{
            margin-top: 20px;
        }
        table th{
            color: rgb(240, 239, 239) !important;
        }
        table tbody{
            color: rgb(174, 172, 172) !important;
        }
        #exampleproductcategory{
            width: 100%;
            background-color: #2a3035;
            cursor: pointer;
        }
        #exampleproductimage{
            height: fit-content;
            cursor: pointer;
        }
        input,select{
            border-radius: 10px !important;
        }
        .btntn{
            height: 40px;
            width: 120px;
        margin-left: auto;
        margin-right: 30px;
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
                @endif

                <form action="{{url('/send_user_email', $order->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="div_center">
                    <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
                            <h1 class="card-title">Send Email to {{$order->name}}</h1>
                              <div class="form-group row">
                                <label for="exampletitle" class="col-sm-3 col-form-label">Email Greeting</label>
                                <div class="col-sm-9">
                                  <input name="greeting" type="text" class="form-control" id="exampletitle" placeholder="" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="exampledescription" class="col-sm-3 col-form-label">Email First Line</label>
                                <div class="col-sm-9">
                                  <input name="firstline" type="text" class="form-control" id="exampledescription" placeholder="" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="exampleprice" class="col-sm-3 col-form-label">Email Body</label>
                                <div class="col-sm-9">
                                    <input name="body" type="text" class="form-control" id="exampletitle" placeholder="" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="examplequantity" class="col-sm-3 col-form-label">Email Button Name</label>
                                <div class="col-sm-9">
                                    <input name="button" type="text" class="form-control" id="exampletitle" placeholder="" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="examplediscountprice" class="col-sm-3 col-form-label">Email URL</label>
                                <div class="col-sm-9">
                                  <input name="url" type="text" class="form-control" id="exampletitle" placeholder="" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="examplediscountprice" class="col-sm-3 col-form-label">Email Last Line</label>
                                <div class="col-sm-9">
                                  <input name="lastline" type="text" class="form-control" id="exampletitle" placeholder="" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="examplediscountprice" class="col-sm-3 col-form-label">Send To</label>
                                <div class="col-sm-9">
                                  <input name="to" type="text" class="form-control"  id="exampletitle" readonly value="{{$order->email}}" required>
                                </div>
                              </div>
                            </div>
                            {{-- <div class="form-group row">
                              <label for="exampleproductimage" class="col-sm-3 col-form-label">Product Image</label>
                              <div class="col-sm-9">
                                <input type="file" name="image" class="form-control" id="exampleproductimage" placeholder="" required>
                              </div>
                            </div> --}}
                              <button type="submit" class=" btntn btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
    <!-- container-scroller -->

    <script>
        // setTimeout(function() {
        // $("#mydiv").fadeOut().empty();
        // }, 3000);
    </script>
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
