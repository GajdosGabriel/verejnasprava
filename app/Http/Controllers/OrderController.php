<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\SaveOrderRequest;
use App\Notifications\OrderCreate;
use Barryvdh\DomPDF\PDF as PDF;
use App\Order;
use App\OrderItem;
use App\User;
use App\Worker;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class OrderController extends Controller
{
    use Notifiable;

    public function index(User $user) {
        $orders = $user->orders()->get();
        return view('order.index', compact('orders'));
    }

    public function show(User $user, Order $order) {
        return view('order.show', compact('order'));
    }


    public function create(User $user) {
        return view('order.create')->with('user', $user);
    }


    public function showPdf(User $user, Order $order) {
        $pdf = \PDF::loadView('order.orderShowPdf', [ 'order' => $order]);
        return $pdf->stream();

    }





    public function editOrder(User $user, Order $order) {
        $this->authorize('delete-post', $order);
        return view('order.edit')
            ->with('order', $order)
            ->with('user', $user);
    }

    public function storeOrder(User $user, SaveOrderRequest $request) {

       $order = $user->orders()->create([
            'customer_id' => $request->input('customer_id'),
            'worker_id' => $request->input('worker_id'),
            'orderPublished' => $request->input('orderPublished'),
            'payment' => $request->input('payment'),
            'order_send' => $request->input('order_send'),
            'grandTotal' => $request->input('totalPrice'),
            'order_number' => \Auth::user()->orders->count() + 1,
//            'notice' => $request->input('notice')
        ]);


        foreach($request->name as $key => $value) {

            $order->saveOrderItems([
                'name' => $request->name[$key],
                'quantity' => $request->quantity[$key],
                'price' => $request->price[$key],
            ]);

        }

        // Send email notify to customer
        if($request->input('order_send') == 1) {
       $order->company->notify( new OrderCreate($order));
        }

//        flash()->success('Úspešné uložené');
        return redirect(auth()->user()->slug.'/orderindex');
    }



    public function updateOrder(SaveOrderRequest $request, Order $order) {
//        dd($order);

        $this->authorize('delete-post', $order);

        foreach($request->name as $key => $value) {

            $order->saveOrderItems([
                'name' => $request->name[$key],
                'quantity' => $request->quantity[$key],
                'price' => $request->price[$key],
            ]);

        }




        if($order->id !=0) {

            foreach($request->nameame as $key => $value) {
                 if( isset( $request->orderItemId[$key] )) {

                     $order->orderItems()->update([
                        'name' => $request->name[$key],
                        'quantity' => $request->quantity[$key],
                        'price' => $request->price[$key],
                    ]);

                } else {
                     $order->orderItems()->insert([
                        'name' => $request->name[$key],
                        'quantity' => $request->quantity[$key],
                        'price' => $request->price[$key],
                    ]);
                 }
            } // end of loop
        } // end of condition

        // Send email notify for company
        if($request->input('order_send') == 1) {
            $order->company->notify( new OrderCreate($order));
        }

//        flash()->success('Úspešné uložené');
        return back();
    }

    public function copyOrder(User $user, Order $order) {
        $this->authorize('delete-post', $order);
        return view('order.copy')
            ->with('user', $user)
            ->with('order', $order);
    }


    public function deleteOrder(Order $order) {
        $this->authorize('delete-post', $order);
        $order->delete();
        if ( request()->expectsJson() ) {
            return response(['status' => 'Order Deleted']);
        }
        return back();
    }

    public function orderSendStatus(Order $order) {
        $order->update([ 'order_send' => 1 ]);
        $order->company->notify( new OrderCreate($order));
        if (request()->expectsJson()) {
            return response(['status' => 'Order was send']);
        }
    }
}
