<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Details</title>
    <style>
        th,td{
            width: 400px;
            height: 40px;
        }
    </style>
</head>
<body>

    <h1  style="text-align: center">Order Details</h1>
    <table class="table">
        <tbody>
          <tr>
            <th scope="row">Custmer ID:</th>
            <td>{{$order->user_id}}</td>
          </tr>
          <tr>
            <th scope="row">Custmer Name:</th>
            <td>{{$order->name}}</td>
          </tr>
          <tr>
            <th scope="row">Custmer Email:</th>
            <td>{{$order->email}}</td>
          </tr>
          <tr>
            <th scope="row">Custmer Phone:</th>
            <td>{{$order->phone}}</td>
          </tr>
          <tr>
            <th scope="row">Custmer Address:</th>
            <td>{{$order->address}}</td>
          </tr>
          <tr>
            <th scope="row">Product Name:</th>
            <td>{{$order->product_title}}</td>
          </tr>
          <tr>
            <th scope="row">Product Price:</th>
            <td>{{$order->price}}</td>
          </tr>
          <tr>
            <th scope="row">Product Quantity:</th>
            <td>{{$order->quantity}}</td>
          </tr>
          <tr>
            <th scope="row">Product Status:</th>
            <td>{{$order->payment_status}}</td>
          </tr>
          <tr>
            <th scope="row">Product ID:</th>
            <td>{{$order->product_id}}</td>
          </tr>
          <tr>
            <th scope="row">Product Image:</th>
            <td><img src="product/{{$order->image}}" height="200px" alt=""></td>
          </tr>
        </tbody>
      </table>
    {{-- Custmer Name: <h3>{{$order->name}}</h3>
    Custmer Email: <h3>{{$order->email}}</h3>
    Custmer Phone: <h3>{{$order->phone}}</h3>
    Custmer Address: <h3>{{$order->address}}</h3>
    Custmer ID: <h3>{{$order->user_id}}</h3>

    Product Name: <h3>{{$order->product_title}}</h3>
    Product Price: <h3>{{$order->price}}</h3>
    Product Quantity: <h3>{{$order->quantity}}</h3>
    Product Status: <h3>{{$order->payment_status}}</h3>
    Product ID: <h3>{{$order->product_id}}</h3>

    <img src="product/{{$order->image}}" height="200px" alt=""> --}}
</body>
</html>
