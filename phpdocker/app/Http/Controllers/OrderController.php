<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Orders\Create;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function showForm(): View
    {
        return view('orders.order_form');
    }

    public function processForm(Create $request): mixed
    {
        $order = new Order($request->validated());

        if($order->save()) {
            Storage::append('orders.txt', json_encode($request->validated()));
            return view('orders.order-confirmation')->with('success', __('The record was saved successfully'));
        }

        return back()->with('error', __('We can not save item, pleas try again'));
    }
}
