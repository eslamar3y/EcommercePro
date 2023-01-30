<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use PDF;

class AdminController extends Controller
{
    public function view_category()
    {
        if(Auth::id())
        {
            $data = category::all();
            return view('admin.category', compact('data'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function add_category(Request $request)
    {
        $data = new category();
        $data->category_name = $request->category;
        $data->save();
        return redirect()->back()->with('message','Category Added Successfully');
    }

    public function delete_category($id)
    {
        $data = category::find($id);
        $data->delete();
        return redirect()->back()->with('messageD','Category Deleted Successfully');
    }

    public function view_product()
    {
        if(Auth::id())
        {
            $usertype=Auth::user()->usertype;
            if ($usertype =='0')
            {
                $products = Product::paginate(6);
                return view('home.userpage', compact('products'));
            }
            else
            {
                $category = category::all();
                return view('admin.product', compact('category'));
            }
        }
        else
        {
            return redirect('login');
        }

    }

    public function add_product(Request $request)
    {

        $product = new product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->disc_price;
        $product->category = $request->category;

        // Image

        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('Product', $imagename);
        $product->image = $imagename;


        $product ->save();
        return redirect()->back()->with('message','Product Added Successfully');
    }

    public function show_products()
    {

        $products = product::all();
        return view('admin.show_products', compact('products'));
    }

    public function delete_product($id)
    {
        $data = product::find($id);
        $data->delete();
        return redirect()->back()->with('messageDP','Product Deleted Successfully');
    }

    public function update_product($id)
    {
        $product = product::find($id);
        $category = category::all();
        return view('admin.update_product', compact('product','category'));
    }
    public function update_product_confirm(Request $request,$id)
    {
        $product = product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->disc_price;
        $product->category = $request->category;

        $image = $request->image;
        if($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('Product', $imagename);
            $product->image = $imagename;
        }

        $product -> save();
        $products = product::all();

        return redirect()->back()->with('message','Product Updated Successfully');

    }
    public function user()
    {
        $Cuser = Auth::user();
        $CuserId = $Cuser->id;
        $users = User::all();;
        return view('admin.users', compact('users', 'CuserId'));
    }

    public function MakeUser($id)
    {
        $user = User::find($id);
        $user->usertype=0;
        $user->save();
        return redirect()->back()->with('messageD',"$user->name become User");
    }
    public function MakeAdmin($id)
    {
        $user = User::find($id);
        $user->usertype=1;
        $user->save();
        return redirect()->back()->with('messageD',"$user->name become Admin");
    }
    public function DeleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('messageDP','User Deleted Successfully');
    }

    public function user_search(Request $request)
    {
        $Cuser = Auth::user();
        $CuserId = $Cuser->id;

        $searchTXT = $request->search;
        $users = User::where('name','LIKE',"%$searchTXT%")->orWhere('phone','LIKE',"%$searchTXT%")->orWhere('email','LIKE',"%$searchTXT%")->get();
        return view('admin.users',compact('users', 'CuserId'));
    }

    public function order()
    {
        $orders = Order::all();;
        return view('admin.order', compact('orders'));
    }
    public function delivered($id)
    {
        $order = Order::find($id);

        $order->delivery_status = "Delivered";
        $order->payment_status = "Paid";

        $order -> save();

        // return redirect()->back();
        return redirect()->back()->with('messageDP','Product Delivered Successfully');
    }

    public function print_pdf($id)
    {
        $order = Order::find($id);

        $pdf = PDF::loadView('admin.pdf', compact('order'));
        return $pdf->download("order $id details.pdf");
    }
    public function send_email($id)
    {
        $order = Order::find($id);
        return view('admin.email_info', compact('order'));
    }
    public function send_user_email(Request $request ,$id)
    {
        $order = Order::find($id);
        $details =[
            'greeting' =>$request->greeting,
            'firstline'=>$request->firstline,
            'body'     =>$request->body,
            'button'   =>$request->button,
            'url'      =>$request->url,
            'lastline' =>$request->lastline,
        ];
        // Notification::send($order,SendEmailNotification);
        Notification::send($order,new SendEmailNotification($details));
        return redirect()->back()->with('message','Mail Delivered Successfully');;
    }
    public function order_search(Request $request)
    {
        $searchTXT = $request->search;
        $orders = Order::where('name','LIKE',"%$searchTXT%")->orWhere('phone','LIKE',"%$searchTXT%")->orWhere('email','LIKE',"%$searchTXT%")->orWhere('product_title','LIKE',"%$searchTXT%")->get();
        return view('admin.order',compact('orders'));
    }
}
