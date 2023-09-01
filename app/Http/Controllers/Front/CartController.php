<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function cart(Request $request)
    {
        $cart_content = Cart::content()->toArray();
        $cart_items = [];
        $total = 0;
        foreach ($cart_content as $item) {
            $total += $item['price'];
            $record = $item['options'];

            $record['rowId'] = $item['rowId'];
            $record['name'] = $item['name'];
            $batch = Batch::find($item['options']['batch_id']);
            $record['image'] = $batch->course->get_course_image();

            $cart_items [] = $record;
        }

        return view('front.cart', compact('cart_items', 'total'));
    }

    public function addToCart(Request $request)
    {
        try {
            $price = floatval($request->fees);

            Cart::add([
                'id' => 'item-batch-' . $request->batch_id . '-user-' . $request->user_id,
                'name' => $request->batch_name,
                'weight' => 0,
                'qty' => 1,
                'price' => $price,
                'options' => [
                    'user_id' => intval($request->user_id),
                    'batch_id' => intval($request->batch_id),
                    'class_type' => $request->class_type,
                    'physical_class_type' => $request->physical_class_type,
                    'fees' => $price
                ]
            ]);
            $cart = Cart::count();

            return response()->json([
                'count' => $cart,
            ]);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function removeFromCart(Request $request, $rowId)
    {
        Cart::remove($rowId);

        return redirect()->back()->with('success', 'Cart Remove Successfully.');
    }
}
