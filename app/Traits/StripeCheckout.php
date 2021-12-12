<?php

namespace App\Traits;

use App\{
    Models\Setting,
    Models\PromoCode,
    Models\TrackOrder,
    Helpers\EmailHelper,
    Helpers\PriceHelper,
    Models\Notification,
    Models\PaymentSetting,
};
use App\Models\Item;
use App\Models\ShippingService;
use App\Models\User;
use Illuminate\Support\Str;

use Cartalyst\Stripe\{
    Laravel\Facades\Stripe,
    Exception\CardErrorException,
    Exception\MissingParameterException
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

use function GuzzleHttp\json_decode;

trait StripeCheckout
{

    public function __construct()
    {
        $data = PaymentSetting::whereUniqueKeyword('stripe')->first();
        $paydata = $data->convertJsonData();
        Config::set('services.stripe.key', $paydata['key']);
        Config::set('services.stripe.secret', $paydata['secret']);
    }

    public function stripeSubmit($data){
        $user = Auth::user();
        $setting = Setting::first();
        $cart = Session::get('cart');

        $total_tax = 0;
        $cart_total = 0;
        $total = 0;
        $option_price = 0;
        foreach($cart as $key => $item){

            $total += $item['main_price'] * $item['qty'];
            $option_price += $item['attribute_price'];
            $cart_total = $total + $option_price;
            $item = Item::findOrFail($key);
            if($item->tax){
                $total_tax += $item::taxCalculate($item);
            }
        }
        $shipping = [];
        if(ShippingService::whereStatus(1)->exists()){
            $shipping = ShippingService::whereStatus(1)->first();
        }
        $discount = [];
        if(Session::has('coupon')){
            $discount = Session::get('coupon');
        }

        $aditional_cost=0;
        if(Session::has('aditional_cost')){
            $aditional_data = Session::get('aditional_cost');
            foreach($aditional_data as $key => $value){
                if($value=='28'){
                    $aditional_cost =(int)$value;
                    break;
                }else{
                    $aditional_cost +=(int)$value;
                }
            }
        }
        
        $grand_total = ($cart_total + ($shipping?$shipping->price:0)) + $total_tax;
        $grand_total = $aditional_cost + $grand_total - ($discount ? $discount['discount'] : 0);
        $total_amount = PriceHelper::setConvertPrice($grand_total);
        $orderData['cart'] = json_encode($cart,true);
        $orderData['discount'] = json_encode($discount,true);
        $orderData['shipping'] = json_encode($shipping,true);
        $orderData['tax'] = $total_tax;
        $orderData['shipping_info'] = json_encode(Session::get('shipping_address'),true);
        $orderData['billing_info'] = json_encode(Session::get('billing_address'),true);
        $orderData['payment_method'] = 'Stripe';
        $orderData['user_id'] = $user->id;
        $orderData['transaction_number'] = Str::random(10);
        $orderData['currency_sign'] = PriceHelper::setCurrencySign();
        $orderData['currency_value'] = PriceHelper::setCurrencyValue();
        $orderData['order_status'] = 'Pending';
        $orderData['additional_cost'] = Session::has('aditional_cost') ?json_encode(Session::get('aditional_cost'),true):null;
     
        $stripe = Stripe::make(Config::get('services.stripe.secret'));
        try{

            $token = $stripe->tokens()->create([
            'card' =>[
                'number' => $data['card'],
                'exp_month' => $data['month'],
                'exp_year' => $data['year'],
                'cvc' => $data['cvc'],
                ],
            ]);
            if (!isset($token['id'])) {
                return [
                    'status' => false,
                    'message' => __('Token Problem With Your Token.')
                ];
            }
            
          
            $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' => PriceHelper::setCurrencyName(),
                'amount' => $total_amount,
                'description' => __('Payment via stripe from').' '.$setting->title,
                ]);
                
            if ($charge['status'] == 'succeeded') {
                
                $orderData['txnid'] =  $charge['balance_transaction'];
                $orderData['charge_id'] = $charge['id'];
                $orderData['payment_status'] = 'Paid';
                
                $order = $user->orders()->create($orderData);
                PriceHelper::Transaction($order->id,$order->transaction_number,$user->email,PriceHelper::OrderTotal($order));
                PriceHelper::LicenseQtyDecrese($cart);
                
                if(Session::has('copon')){
                    $code = PromoCode::find(Session::get('copon')['code']['id']);
                    $code->no_of_times--;
                    $code->update();
                }
                TrackOrder::create([
                    'title' => 'Pending',
                    'order_id' => $order->id,
                ]);
    
                
                Notification::create([
                    'order_id' => $order->id
                ]);


                $emailData = [
                    'to' => $user->email,
                    'type' => "Order",
                    'user_name' => $user->displayName(),
                    'order_cost' => $total_amount,
                    'transaction_number' => $order->transaction_number,
                    'site_title' => Setting::first()->title,
                ];

                $email = new EmailHelper();
                $email->sendTemplateMail($emailData);

                foreach(json_decode($order->cart,true) as $id => $product){
                    $vendor_id[] = $user = Item::findOrFail($id)->user->id;
                }

                if($discount){
                    $coupon_id = $discount['code']['id'];
                    $get_coupon = PromoCode::findOrFail($coupon_id);
                    $get_coupon->no_of_times -= 1;
                    $get_coupon->update();
                }
        
                Session::put('order_id',$order->id);
                Session::forget('cart');
                Session::forget('aditional_cost');
                Session::forget('discount');
                return [
                    'status' => true
                ];
            }

        }catch (Exception $e){

            return [
                'status' => false,
                'message' => $e->getMessage()
            ];

        }catch (CardErrorException $e){

            return [
                'status' => false,
                'message' => $e->getMessage()
            ];

        }catch (MissingParameterException $e){

            return [
                'status' => false,
                'message' => $e->getMessage()
            ];

        }
    }

}
