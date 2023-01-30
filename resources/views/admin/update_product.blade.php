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
        .curr{
            width:100px;
            height:100px;
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

                <form action="{{url('/update_product_confirm', $product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="div_center">
                    <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
                            <h1 class="card-title">Add Product</h1>
                              <div class="form-group row">
                                <label for="exampletitle" class="col-sm-3 col-form-label">Title</label>
                                <div class="col-sm-9">
                                  <input name="title" type="text" class="form-control" value="{{$product->title}}" id="exampletitle" placeholder="" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="exampledescription" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                  <input name="description" type="text" value="{{$product->description}}" class="form-control" id="exampledescription" placeholder="" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="exampleprice" class="col-sm-3 col-form-label">Price</label>
                                <div class="col-sm-9">
                                  <input name="price" type="number" value="{{$product->price}}" class="form-control" id="exampleprice" placeholder="">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="examplequantity" class="col-sm-3 col-form-label">Quantity</label>
                                <div class="col-sm-9">
                                  <input name="quantity" type="number" value="{{$product->quantity}}" min="0" class="form-control" id="examplequantity" placeholder="" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="examplediscountprice" class="col-sm-3 col-form-label">Discount Price</label>
                                <div class="col-sm-9">
                                  <input name="disc_price" type="number" value="{{$product->discount_price}}" class="form-control" id="examplediscountprice" placeholder="">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="exampleproductcategory" class="col-sm-3 col-form-label">Product Category</label>
                                <div class="col-sm-9">
                                  <select name="category" id="exampleproductcategory" required>
                                    <option value="{{$product->category}}" selected>{{$product->category}}</option>

                                    @foreach ($category as $item)
                                    <option value="{{$item->category_name}}">{{$item->category_name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>


                            <div class="form-group row">
                                <label for="exampleproductimage" class="col-sm-3 col-form-label">Current Product Image</label>
                                <div class="col-sm-9">
                                  <img class="curr" src="/product/{{$product->image}}" alt="">
                                </div>
                              </div>








                            <div class="form-group row">
                              <label for="exampleproductimage" class="col-sm-3 col-form-label">Change Product Image</label>
                              <div class="col-sm-9">
                                <input type="file" name="image" class="form-control" id="exampleproductimage" placeholder="">
                              </div>
                            </div>
                              <button type="submit" class="btn btn-primary">Update Product</button>
                            </div>
                        </div>
                    </div>
                </form>
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
