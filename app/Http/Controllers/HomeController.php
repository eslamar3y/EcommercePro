<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Reply;
use Stripe;
use Illuminate\Support\Facades\Session;



class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user())
        {
            $userId = Auth::user()->id;
            $numberOfOrders = Order::where('user_id', '=', $userId)->count();
            $numberOfcarts = Cart::where('user_id', '=', $userId)->count();
            $products = Product::paginate(6);
            return view('home.userpage', compact('products', 'numberOfOrders', 'numberOfcarts'));
        }
        else
        {
            $products = Product::paginate(6);
            $numberOfOrders = '0';
            $numberOfcarts = '0';
            return view('home.userpage', compact('products', 'numberOfOrders', 'numberOfcarts'));
        }

    }
    public function redirect()
    {
        $usertype=Auth::user()->usertype;
        if ($usertype =='1')
        {
            $username=Auth::user()->name;
            $total_products = Product::all()->count();
            $total_customers = User::all()->count();
            $total_orders = Order::all()->count();
            $orders = Order::all();
            $total_revnue=0;
            foreach($orders as $order)
            {
                $total_revnue = $total_revnue + $order->price;
            }

            $total_delivered = Order::where('delivery_status', '=', 'delivered')->get()->count();
            $total_processing = Order::where('delivery_status', '=', 'processing')->get()->count();

            return view('admin.home', compact('total_products', 'total_customers', 'total_orders','total_revnue','total_delivered','total_processing','username'));
        }
        else
        {
            if(Auth::user())
            {
                $userId = Auth::user()->id;
                $numberOfOrders = Order::where('user_id', '=', $userId)->count();
                $numberOfcarts = Cart::where('user_id', '=', $userId)->count();
                $products = Product::paginate(6);
                return view('home.userpage', compact('products','numberOfcarts','numberOfOrders'));
            }
            else
            {
                $numberOfOrders = 0;
                $numberOfcarts = 0;
                $products = Product::paginate(6);
                return view('home.userpage', compact('products','numberOfcarts','numberOfOrders'));
            }
        }
    }

    public function product_details($id)
    {
        if(Auth::user())
        {
            $userId = Auth::user()->id;
            $numberOfOrders = Order::where('user_id', '=', $userId)->count();
            $numberOfcarts = Cart::where('user_id', '=', $userId)->count();
            $product = Product::find($id);
            $comments = Comment::where('product_id', '=', $id)->orderby('id', 'desc')->get();
            $replies = Reply::where('product_id', '=', $id)->get();
            return view('home.product_details', compact('product','comments','replies','numberOfcarts','numberOfOrders'));
        }
        else
        {
            $numberOfOrders = '0';
            $numberOfcarts = '0';
            $product = Product::find($id);
            $comments = Comment::where('product_id', '=', $id)->orderby('id', 'desc')->get();
            $replies = Reply::where('product_id', '=', $id)->get();
            return view('home.product_details', compact('product','comments','replies','numberOfcarts','numberOfOrders'));
        }
    }
    public function add_cart(Request $request, $id)
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $product = Product::find($id);
            $product_exist_id = Cart::where('product_id', '=', $id)->where('user_id', '=', $userid)->get('id')->first();
            if($product_exist_id)
            {
                $cart = Cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                if($product->discount_price != null)
                {
                    $cart->price = $product->discount_price *$cart->quantity;
                }
                else
                {
                    $cart->price = $product->price * $cart->quantity;
                }
                $cart->save();
                return redirect()->back()->with('message','Product added to cart successfully');
            }
            else
            {
                $cart = new Cart();
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;

                $cart->product_title = $product->title;
                if($product->discount_price != null)
                {
                    $cart->price = $product->discount_price * $request->quantity;
                }
                else
                {
                    $cart->price = $product->price * $request->quantity;
                }
                $cart->image = $product->image;
                $cart->Product_id = $product->id;
                $cart->quantity = $request->quantity;

                $cart->save();
                return redirect()->back();
            }




        }
        else
        {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if(Auth::id())
        {
            $userId = Auth::user()->id;
            $numberOfOrders = Order::where('user_id', '=', $userId)->count();
            $numberOfcarts = Cart::where('user_id', '=', $userId)->count();
            $id = Auth::user()->id;
            $cart = cart::where('user_id', '=', $id)->get();
            return view('home.showcart', compact('cart','numberOfcarts','numberOfOrders'));
        }
        else
        {
            return redirect('login');
        }

    }
    public function remove_cart($id)
    {
        $cart = cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function show_order()
    {
        if(Auth::id())
        {
            $userId = Auth::user()->id;
            $numberOfOrders = Order::where('user_id', '=', $userId)->count();
            $numberOfcarts = Cart::where('user_id', '=', $userId)->count();
            $user = Auth::user();
            $userid = $user->id;
            $order = Order::where('user_id','=',$userid)->get();
            return view('home.order',compact('order','numberOfcarts','numberOfOrders'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function remove_order($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back()->with('messageDP','Order Deleted Successfully');;
    }
    public function cash_order()
    {
        $user = Auth::user();
        $userId = $user->id;

        $data = Cart::where('user_id', '=', $userId)->get();
        // dd($data);
        foreach($data as $row)
        {
            $order = new Order;

            $order->name = $row->name;

            $order->email = $row->email;

            $order->phone = $row->phone;

            $order->address = $row->address;

            $order->user_id = $row->user_id;

            $order->product_title = $row->product_title;

            $order->price = $row->price;

            $order->quantity = $row->quantity;

            $order->image = $row->image;

            $order->Product_id = $row->Product_id;

            $order->payment_status='Cash on Delivery';

            $order->delivery_status = 'Processing';

            $order->save();

            $cart_id = $row->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'We have received your order, We will connect with you  soon...');
    }
    public function stripe($totalPrice)
    {
        $userId = Auth::user()->id;
        $numberOfOrders = Order::where('user_id', '=', $userId)->count();
        $numberOfcarts = Cart::where('user_id', '=', $userId)->count();
        return view('home.stripe',compact('totalPrice','numberOfcarts','numberOfOrders'));
    }
    public function stripePost(Request $request, $totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks For Payment"
        ]);

        $user = Auth::user();
        $userId = $user->id;

        $data = Cart::where('user_id', '=', $userId)->get();
        // dd($data);
        foreach($data as $row)
        {
            $order = new Order;

            $order->name = $row->name;

            $order->email = $row->email;

            $order->phone = $row->phone;

            $order->address = $row->address;

            $order->user_id = $row->user_id;

            $order->product_title = $row->product_title;

            $order->price = $row->price;

            $order->quantity = $row->quantity;

            $order->image = $row->image;

            $order->Product_id = $row->Product_id;

            $order->payment_status='Paid';

            $order->delivery_status = 'Processing';

            $order->save();

            $cart_id = $row->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }
    public function add_comment(Request $request,$id)
    {
        if (Auth::id())
        {
            $comment = new Comment;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->gender = Auth::user()->Gender;
            $comment->product_id = $id;
            $comment->comment = $request->comment;
            $comment->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }
    public function add_reply(Request $request,$id)
    {
        if (Auth::id())
        {
            $reply = new Reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->gender = Auth::user()->Gender;
            $reply->product_id = $id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }
    // public function product_search(Request $request)
    // {
    //     $searchTXT = $request->search;
    //     $products = Product::where('title','LIKE',"%$searchTXT%")->orWhere('category','LIKE',"%$searchTXT%")->Paginate(9);
    //     return view('home.userpage',compact('products'));
    // }
    public function search_product(Request $request)
    {
        if(Auth::user())
        {
            $userId = Auth::user()->id;
            $numberOfOrders = Order::where('user_id', '=', $userId)->count();
            $numberOfcarts = Cart::where('user_id', '=', $userId)->count();
            $searchTXT = $request->search;
            $products = Product::where('title','LIKE',"%$searchTXT%")->orWhere('category','LIKE',"%$searchTXT%")->Paginate(9);
            return view('home.all_products',compact('products','numberOfcarts','numberOfOrders'));
        }
        else
        {
            $numberOfOrders = '0';
            $numberOfcarts = '0';
            $searchTXT = $request->search;
            $products = Product::where('title','LIKE',"%$searchTXT%")->orWhere('category','LIKE',"%$searchTXT%")->Paginate(9);
            return view('home.all_products',compact('products','numberOfcarts','numberOfOrders'));
        }
    }

    public function all_products()
    {
        if(Auth::user())
        {
            $userId = Auth::user()->id;
            $numberOfOrders = Order::where('user_id', '=', $userId)->count();
            $numberOfcarts = Cart::where('user_id', '=', $userId)->count();
            $products = Product::Paginate(9);
            return view('home.all_products', compact('products','numberOfcarts','numberOfOrders'));
        }
        else
        {
            $numberOfOrders = '0';
            $numberOfcarts = '0';
            $products = Product::Paginate(9);
            return view('home.all_products', compact('products','numberOfcarts','numberOfOrders'));
        }
    }

}
