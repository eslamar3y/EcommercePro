<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <style>
        .hero_area
        {
            min-height:70vh;
        }
        .prod{
            display: flex;
            margin:100px 200px 100px 100px;
            position: relative;
            max-height: 500px;
            /* align-items: center; */
        }
        .img-responsive{
            width:400px;
            max-height: 500px;
            margin-right: 100px;
        }
        .sdate{
            text-decoration: line-through;
            color: #ccc;
            font-size:18px
        }
        .addto{
            position:absolute;
            bottom:10%;
            right: 30%;
        }
        h1{
            font-size:2.5rem !important;
        }
        .center
        {
            margin: auto;
            width: 50%;
            margin-top: 100px;
            margin-bottom:100px;
            text-align:center;
            padding:30px;
        }
        table,th,td
        {
            border: 1px solid gray;
            line-height: 100px;
        }
        .table
        {
            margin-left: -50%;
            width: 200%;
        }
        .th_deg
        {
            font-size:30px;
            padding:5px;
            background: skyblue;
        }
        .img_deg
        {
            height: 100px;
            margin: auto;
        }
        .deleteBtn{
            padding:30px 40px 30px 40px;
            border-radius:50%;
            transition: all .4s ease;
            -webkit-transition: all .7s ease;
        }
        .deleteBtn:hover
        {
            background-color:rgb(255, 250, 250);
        }
        .total_deg
        {
            font-size:20px;
            padding:40px;
        }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->

      {{-- <div class="prod">
        <img class="img-responsive" src="product/{{$product->image}}" alt="">
        <div class="txt">
            @if ($product->discount_price)
            <h1> {{$product->title}} <span class="sdate">${{$product->price}}</span></h1>
            <p>Category: <span class="">{{$product->category}}</span></p>
            <p>Price: <span class="aName">${{$product->discount_price}}</span></p>
            @else
            <h1> {{$product->title}}</h1>
            <p>Category: <span class="">{{$product->category}}</span></p>
            <p>Price: <span class="aName">${{$product->price}}</span></p>
            @endif

        <p class="inf"> {{$product->description}}</p>

        </div>
    </div> --}}
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
      <div class="center">

        <table class="table">
            <tr>
                <th class="th_deg">Product title</th>
                <th class="th_deg">Product quantity</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Action</th>
            </tr>
            <?php $totalPrice = 0; ?>
            @foreach($cart as $cart)
            <tr>
                <td>{{$cart->product_title}}</td>
                <td>{{$cart->quantity}}</td>
                <td>${{$cart->price}}</td>
                <td><img class="img_deg" src="/product/{{$cart->image}}" alt=""></td>
                <td><a class="deleteBtn" onclick="return confirm('Are you sure you want to remove this product?')" href="{{url('remove_cart', $cart->id)}}">X</a></td>
            </tr>
            <?php $totalPrice = $totalPrice + $cart->price; ?>
            @endforeach
        </table>
        <div>
            <h1 class="total_deg">Total Price: ${{$totalPrice}}</h1>

        </div>

        <div>
            <h1 style="font-size: 24px !important;padding-bottom: 15px;font-weight: bold;">Proceed To Order</h1>
            <a href="{{url('cash_order')}}" class="btn btn-danger">Cash On delivery</a>
            <a href="{{url('stripe', $totalPrice)}}" class="btn btn-danger">Pay With Card</a>
        </div>
      </div>
      <div class="cpy_">
         <p class="mx-auto">© 2022 All Rights Reserved By Islam Development<br>

            Made with <i class="fa fa-heart" style="color: #f7444e;" aria-hidden="true"></i> By Islam Mar3y

         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
