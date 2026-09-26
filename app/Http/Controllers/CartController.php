<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function viewCart()  {
        $cart_items = Session::get('cart_items');
        return view('cart/index',compact('cart_items'));
    }
    public function addToCart($id)  {
        $product = Product::find($id);

        $cart_items = Session::get('cart_items');
        if (is_null($cart_items)) {
            $cart_items = array();
        }

        $qty = 0;
        if (array_key_exists($product->id,$cart_items)) {
            $qty = $cart_items[$product->id]['qty'];
        }

        $cart_items[$product['id']] = array('id'=>$product->id,
        'code'=> $product->code,
        'name'=> $product->name,
        'price'=> $product->price,
        'image_url'=> $product->image_url,
        'qty'=> $qty+1,
        );
        Session::put('cart_items',$cart_items);
        return redirect('cart/view');
    }
    public function deleteCart($id) {
        $cart_items = Session::get('cart_items');
        unset($cart_items[$id]);
        Session::put('cart_items',$cart_items);
        return redirect('cart/view');
    }
    public function updateCart($id,$qty) {
        $cart_items = Session::get('cart_items');
        $cart_items[$id]['qty'] = $qty;
        Session::put('cart_items',$cart_items);
        return redirect('cart/view');
    }
    public function checkout() {
        $cart_items = Session::get('cart_items');
        return view('cart/checkout',compact('cart_items'));
    }
   public function complete(Request $request) {
    $cart_items = Session::get('cart_items');
    $cust_name  = $request->input('cust_name');
    $cust_email = $request->input('cust_email');

    $total_amount = 0;
    foreach($cart_items as $c) {
        $total_amount += $c['price'] * $c['qty'];
    }

    $order = DB::transaction(function () use ($cart_items, $cust_name, $cust_email, $total_amount) {
        $today = date('Ymd');

        $todayCount = DB::table('orders')
            ->whereDate('created_at', date('Y-m-d'))
            ->lockForUpdate()
            ->count();

        if ($todayCount == 0) {
            $nextNumber = 1;
        } else {
            $nextNumber = $todayCount + 1;
        }

        $po_no = 'PO' . $today . $nextNumber;

        $order = Order::create([
            'po_no'          => $po_no,
            'cust_name'      => $cust_name,
            'cust_email'     => $cust_email,
            'po_date'        => now(),
            'total_amount'   => $total_amount,
            'payment_status' => false,
        ]);

        foreach ($cart_items as $c) {
            OrderDetail::create([
                'order_id'   => $order->id,
                'product_id' => $c['id'],
                'buy_qty'    => $c['qty'],
            ]);
        }

        return $order;
    });

        $po_no   = $order->po_no;
        $po_date = $order->po_date;

        $html_output = view('cart/complete', compact('cart_items', 'cust_name', 'cust_email',
        'po_no', 'po_date', 'total_amount'))->render();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->debug = true;
        $mpdf->WriteHTML($html_output);
        $mpdf->Output($po_no . '.pdf', 'I');
        
        // return view('cart/complete', compact('cart_items', 'cust_name', 'cust_email', 'po_no',
        // 'po_date', 'total_amount'));
    }

    public function finish_order(){
        $cart_items = Session::get('cart_items');Session::remove('cart_items');
        return redirect('/');
    }

}