<?php

namespace App\Repositories\Front;

use App\{
    Models\Post,
    Models\Page,
    Models\Order,
    Models\Review,
    Models\OrderBooking,
    Models\ClientBooking,
    Models\BookingProduct
};
use App\Helpers\PriceHelper;
use App\Models\Bcategory;
use App\Models\Category;
use Auth;

class FrontRepository
{

    public function displayPosts($request){
        if($request->has('category')){
            return Post::with('category')->whereCategoryId(Bcategory::where('slug',$request->category)->first()->id)->latest('id')->paginate(6);
        }
        else if($request->has('search')){
            return Post::with('category')->where('title', 'like', '%' . $request->search . '%')->orWhere('details', 'like', '%' . $request->search  . '%')->latest('id')->paginate(6);
        }

        else if($request->has('tag')){
            return Post::with('category')->where('tags', 'like', '%' . $request->tag . '%')->latest('id')->paginate(6);
        }
        else{
            return Post::with('category')->latest('id')->paginate(6);
        }
    }

    public function displayPost($slug){
        $tagz = '';
        $tags = null;
        $name = Post::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));
        return [
            'posts'       => Post::orderby('id','desc')->take(4)->get(),
            'post'       => Post::whereSlug($slug)->first(),
            'categories' => Bcategory::withCount('posts')->whereStatus(1)->get(),
            'tags'       => array_filter($tags)
        ];
    }

    public function displayPage($slug){
        return Page::whereSlug($slug)->firstOrFail();
    }

    public function reviewSubmit($request)
    {
        
        $user = Auth::user();
        if(count($user->reviews->where('item_id',$request->item_id)) > 0){
            $data['item_id'] = $request->item_id;
            $data['subject'] = $request->subject;
            $data['rating'] = $request->rating;
            $data['review'] = $request->review;
            $user->reviews()->update($data);
            return __('Your Review Updated Successfully.');
        }

        $orders = Order::where('user_id',$user->id)->get();
        $ck = 0;
        foreach($orders as $order)
        {
        $cart = json_decode($order->cart,true);
        
            foreach($cart as $key => $product)
            {
                if($request->item_id == PriceHelper::GetItemId($key))
                {
                    $ck = 1;
                    break;
                }
            }
        }
        
        if($ck == 0){
            return [
                'errors' => [
                    0 =>  __("Buy This Product First")
                ]
            ];
        }

        $user->reviews()->create($request->all());
        return __('Your Review Submitted Successfully.');

    }

    // order booking model

    public function getAllServices(){
        return OrderBooking::all();
    }

    public function insertClient(){
        try{
            $userData=Auth::user();
            $user_name=$userData->first_name."".$userData->last_name;
            $is_exist=ClientBooking::where('email','=',$userData->email)->orWhere('fullName','=',$user_name)->first();
            if(!$is_exist){
                $user=new ClientBooking();
                $user->fullName=$user_name;
                $user->email=$userData->email;
                $user->password=$userData->password;
                $user->verifiedEmail=0;
                $user->image='';
                $user->photoURL='';
                $user->role=0;
                $user->gender='';
                $user->bookingId=0;
                $user->activated='0';
                $user->activationCode='';
                $user->google=0;
                $user->facebook=0;
                $user->privacy=0;
                $user->phone=$userData->phone ?? "";
                $user->save();

                return [
                    'status' => true,
                    'email'=>$userData->email,
                    'name'=>$user_name,
                    'message' => 'Insert Client.'
                ];
            }
            else{
                return [
                    'status' => true,
                    'email'=>$userData->email,
                    'name'=>$user_name,
                    'message' => 'User already exist'
                ];
            }
        }catch(Exception $e){
            return [
                'status' => false,
                'message' => 'Internal server error'
            ];
        }
    }

    public function productBooking($data,$email,$name){
        try{
            $user=ClientBooking::where('email','=',$email)->orWhere('fullName','=',$name)->first();
            $product=new BookingProduct();
            $product->serviceId=$data['booking_type'];
            $product->agentId=0;
            $product->date=$data['booking_date'];
            $product->timing=$data['booking_time'];
            $product->serviceBill=0;
            $product->paymentStatus=0;
            $product->payBy="cash";
            $product->orderId="";
            $product->serviceStatus="";
            $product->userId=$user->id ?? 0;
            $product->save();
            $service_name=OrderBooking::where('id','=',$data['booking_type'])->first();
            return [
                'status' => true,
                'name'=>$name,
                'email'=>$email,
                'service_tyre'=>$service_name['title'],
                'date'=>$data['booking_date'],
                'time'=>$data['booking_time'],
                'message' => 'Successfully added'
            ];

        }catch(Exception $e){
            return [
                'status' => false,
                'message' => 'Internal server error'
            ];
        }

    }
}
