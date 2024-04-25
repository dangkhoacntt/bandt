<?php

namespace App\Http\Controllers;
use App\Models\OrderDetail;
use App\Models\Order;
use Cart;
use App\Models\Baner;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function confirmOrder(Request $request)
    {
        // Lưu thông tin đơn hàng vào bảng orders
        $order = new Order();
        $order->email = $request->input('email');
        $order->name = $request->input('name');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->save();

        // Lấy thông tin sản phẩm trong giỏ hàng
        $items = Cart::content();

        // Lưu thông tin chi tiết đơn hàng vào bảng order_details
        foreach ($items as $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_name = $item->name;
            $orderDetail->quantity = $item->qty;
            $orderDetail->price = $item->price;
            $orderDetail->save();
        }

        // Xóa giỏ hàng sau khi đặt hàng thành công
        Cart::destroy();

        // Redirect đến trang thông báo đặt hàng thành công
        return redirect()->route('order.success');
    }

    public function showSuccess()
    {
        $data['banners'] = Baner::all();
        // Hiển thị trang thông báo đặt hàng thành công
        return view('frontend.complete',$data);
    }
}
