<style>
.searchdiv
{
    display: flex;
    justify-content: center;
    margin-top: 15px;
    margin-bottom: 15px;
}
.searchinput
{
    width: 400px;
    display: inline;
    border-radius: 3px !important;
}
.searchbutton
{
    width: 100px !important;
    height: 40px !important;
    background-color: #e2e6ea !important;
}
/* .searchbutton:hover
{
    color: #fff !important;
} */
</style>
                @if (session()->has('message'))
                    <div class="alert alert-success added" style="width: 400px;margin-left:auto;margin-top:40px;margin-right:40px;" id="mydiv">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{session()->get('message')}}
                    </div>
                @endif
<section class="product_section layout_padding"id="products">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>


            <div class="searchdiv">
                <form action="{{url('search_product')}}" method="get">
                    @csrf
                    <input name="search" type="text" class="form-control searchinput" placeholder="Search for a product" >
                    {{-- <input name="searchb" type="submit" class="btn searchbutton" value="Search"> --}}
                    <button name="searchb" type="submit" class="btn btn-light searchbutton" >Search</button>
                </form>
            </div>

    </div>
       <div class="row">
          {{-- <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href="" class="option1">
                      Men's Shirt
                      </a>
                      <a href="" class="option2">
                      Buy Now
                      </a>
                   </div>
                </div>
                <div class="img-box">
                   <img src="images/p1.png" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                      Men's Shirt
                   </h5>
                   <h6>
                      $75
                   </h6>
                </div>
             </div>
          </div> --}}
          @foreach ($products as $product)
          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href="{{url('product_details', $product->id)}}" class="option1">
                      Details
                      </a>
                      <form action="{{url('add_cart', $product->id)}}" method="POST">
                        @csrf
                        <div class="row" style="margin: auto">
                            <div class="col-md-4">
                                <input type="number" style="border-radius: 20px; opacity: 0.7;border-color:#bbb" name="quantity" value=1 min=1>
                            </div>
                            <div class="col-md-4">
                                <input type="submit" style="border-radius: 20px" class="option1" value="Add To Cart">
                            </div>
                        </div>
                      </form>
                   </div>
                </div>
                <div class="img-box">
                   <img src="product/{{$product->image}}" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                      {{$product->title}}
                   </h5>

                   @if ($product->discount_price != null)
                   <h6 style="margin-left: auto">
                    ${{$product->discount_price}}
                   </h6>
                   <h6 style="text-decoration: line-through; color: #bbb; padding-left:2px">
                    ${{$product->price}}
                   </h6>
                   @else
                   <h6>
                    ${{$product->price}}
                   </h6>
                   @endif



                </div>
             </div>
          </div>
          @endforeach

          {{-- <div style="margin:10px auto 10px auto">
          {!!$products->appends(Request::all())->links()!!}
          </div> --}}
          <div style="margin:20px auto 20px auto">
          {!!$products->withQueryString()->links('pagination::bootstrap-5')!!}
        </div>



    </div>
 </section>
<script>
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
