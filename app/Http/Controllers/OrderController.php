<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\SaveOrderRequest;
use App\Notifications\OrderCreate;
use App\Organization;
use Barryvdh\DomPDF\PDF as PDF;
use App\Order;
use App\OrderItem;
use App\User;
use App\Worker;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    use Notifiable;

    public function index(Organization $organization, $slug) {
        $orders = $organization->orders;
        return view('order.index', compact('organization'))->with('orders', $orders);
    }

    public function show(Order $order, $slug) {
        return view('order.show', compact('order'));
    }


    public function create(Organization $organization) {
        $contacts = $organization->contacts;
        return view('order.create', compact('organization'))->with('contacts', $contacts);
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

    public function store(Organization $organization, SaveOrderRequest $request) {

       $order = $organization->orders()->create([
            'contact_id' => $request->input('contact_id'),
            'user_id' => auth()->user()->id,
            'payment' => $request->input('payment'),
            'order_number' => $organization->orders->count() + 1,
            'notes' => $request->input('notes')
        ]);

//        dd($request->all());


        foreach($request->name as $key => $value) {

            $order->saveOrderItems([
                'name' => $request->name[$key],
                'quantity' => $request->quantity[$key],
                'price' => $request->price[$key],
            ]);

        }

//        // Send email notify to customer
//        if($request->input('order_send') == 1) {
//       $order->company->notify( new OrderCreate($order));
//        }

//        flash()->success('Úspešné uložené');
        return redirect()->route('org.order.index', [$organization->id, $organization->slug]);
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


    public function delete(Order $order) {
//        $this->authorize('delete-post', $order);
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
