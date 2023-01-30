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
      <title>Famms</title>
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
            border-radius: 30px;
        }
        .inputfield
        {
            border-radius: 10px !important;
            height: 51px;
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

        .lineD
        {
            margin-left: 7%;
            width:86%;
            position: relative;
        }
        .lineD::after
        {
            content: "Description";
            position:absolute;
            left: 10%;
            width: 100px;
            bottom: -10px;
            color: #000;
            background-color: #fff;;
            text-align: center;
            font-weight: bold;
        }
        .lineC
        {
            margin-left: 7%;
            width:86%;
            position: relative;
        }
        .lineC::after
        {
            content: "Comments";
            position:absolute;
            left: 10%;
            width: 100px;
            bottom: -10px;
            color: #000;
            background-color: #fff;;
            text-align: center;
            font-weight: bold;
        }
        #discription
        {
            width:80%;
            margin: auto;
            padding-top: 20px;
            padding-bottom: 30px;
        }
        /* Commet section */
        .AdCommentPart
        {
            text-align: center;
            padding:30px 0;
        }
        #textar
        {
            width:600px;
            height: 150px;
            margin: auto;
            resize: none;
        }
        .userpic
        {
            width:40px;
            display: inline;
        }
        .padding-Left
        {
            padding-left: 45px;
        }
        .margin-Left
        {
            margin-left: 45px;
        }
        .CommentsPart
        {
            padding-left: 20%;
            padding-right:20% ;
        }
        .CommentsParth1
        {
            font-size:17px;
            padding-bottom: 20px;
            text-align: center;
        }
        .commentStyle
        {
            background-color: rgb(248, 248, 248);
            margin-bottom:5px;
            padding: 10px 30px 10px 10px;
            border-radius: 10px;
            /* width: fit-content; */
        }
        .replyStyle
        {
            padding:10px 0 10px 10px;
            position: relative;
            margin-left: 20px;
            margin-bottom:5px;
            border-radius: 10px;
            background-color: #ccc;
            min-width: 300px;
            width: fit-content;
            padding-bottom: 40px;
            padding-right: 30px;
        }
        .replyStyle .btn-warning
        {
            position: absolute;
            right: 0;
            bottom: 0;
        }
        .replyStyle .can
        {
            position: absolute;
            left: 0;
            bottom: 0;
        }
        .replyDiv textarea
        {
            resize: none;
            height: 100px;
            width: 400px;
            border-radius: 10px;
        }
        @media (max-width: 767px) {
            .prod
            {
                display: inline;
            }
        }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
        <div class="prod" >
            <img class="img-responsive" src="/product/{{$product->image}}" alt="">
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
            {{-- <a href="" class="addto btn btn-primary">Add to cart</a> --}}
            <form action="{{url('add_cart', $product->id)}}" method="POST">
                @csrf
                <div class="row" style="margin-top:30px;">
                    <div class="col-md-4">
                        <input type="number" class="form-control inputfield" name="quantity" value=1 min=1>
                    </div>
                    <div class="col-md-4">
                        <input type="submit" style="border-radius: 20px" class="option1" value="Add To Cart">
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
    <hr class="lineD" >
    <div id="discription">
        <p class="inf"> {{$product->description}}</p>
    </div>
    <hr class="lineC" >
    {{-- start Comment and reply system --}}





    <div class="AdCommentPart">
        <form action="{{url('add_comment',$product->id)}}" method="POST">
            @csrf
            <textarea class="form-control" placeholder="Write your Comment"  name="comment" id="textar"></textarea>
            <br>
            <input type="submit" value="Comment"  class="btn btn-primary">
        </form>
    </div>
    <div class="CommentsPart">
        <h1 class="CommentsParth1">All Comments</h1>
        @foreach ($comments as $comment)
            <div class="commentStyle">
                @if($comment->gender == 'Male')
                    <img src="/Users/male.png" class="userpic" alt="">
                @else
                    <img src="/Users/female.png" class="userpic" alt="">
                @endif
                <b>{{$comment->name}}</b>
                <p class="padding-Left">{{$comment->comment}}</p>
                <a class="padding-Left" href="javascript::void(0)" style="color: blue" data-commentId="{{$comment->id}}" onclick="reply(this)"> reply</a>
                @foreach ($replies as $reply)
                    @if($reply->comment_id == $comment->id)
                        <div class="replyStyle">
                            @if($reply->gender == 'Male')
                                    <img src="/Users/male.png" class="userpic" alt="">
                            @else
                                    <img src="/Users/female.png" class="userpic" alt="">
                            @endif
                            <b>{{$reply->name}}</b>
                            <p class="padding-Left">{{$reply->reply}}</p>
                            <a class="btn btn-warning" href="javascript::void(0)" data-commentId="{{$comment->id}}" onclick="reply(this)"> reply</a>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach

        {{-- Div for Reply --}}
    <div class="replyDiv" style="display: none">
        <form action="{{url('add_reply',$product->id)}}" method="POST">
            @csrf
        <input type="text" id="commentId" name="commentId" hidden>
        <textarea class="margin-Left" name="reply" placeholder="Write your reply"></textarea>
        <br>
        <button type="submit" class="margin-Left btn btn-warning">reply</button>
        <a href="javascript::void(0)" class="btn can" style="color:red;" onclick="reply_close(this)">Cancel</a>
        </form>
    </div>
    </div>
    {{-- End Comment and reply system --}}
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
        <p class="mx-auto">© 2022 All Rights Reserved By Islam Development<br>
           Made with <i class="fa fa-heart" style="color: #f7444e;" aria-hidden="true"></i> By Islam Mar3y
        </p>
      </div>
      <script type="text/javascript">
            function reply(caller)
            {
                document.getElementById("commentId").value = $(caller).attr('data-commentId');
                $('.replyDiv').insertAfter($(caller));
                $('.replyDiv').show();
            }
            function reply_close(caller)
            {
                $('.replyDiv').hide();
            }

            document.addEventListener("DOMContentLoaded", function(event)
            {
                var scrollpos = localStorage.getItem('scrollpos');
                if (scrollpos) window.scrollTo(0, scrollpos);
            });
            window.onbeforeunload = function(e)
            {
                localStorage.setItem('scrollpos',window.scrollY);
            };
      </script>
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
