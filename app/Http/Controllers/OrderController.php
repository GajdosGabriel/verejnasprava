<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveOrderRequest;
use App\Notifications\OrderCreate;
use App\Models\Organization;
use Barryvdh\DomPDF\PDF as PDF;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
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
        return view('order.create', compact('organization'));
    }

    // nedokončená
    public function edit(Order $order) {
//        $this->authorize('delete-post', $order);
        $organization = Organization::whereId(auth()->user()->active_organization)->first();
        return view('order.edit', compact('order', 'organization'));
    }

    public function printPdf(Order $order, $slug) {
        $pdf = \PDF::loadView('order.print', compact('order'));
        return $pdf->stream();
    }


    public function store(Organization $organization, SaveOrderRequest $request) {

       $order = $organization->orders()->create([
            'contact_id' => $request->input('contact_id'),
            'user_id' => auth()->user()->id,
            'payment' => $request->input('payment'),
            'order_number' => $organization->orders->count() + 1,
            'notes' => $request->input('notes'),
            'amount' => $request->input('amount'),
        ]);

//        dd($request->all());

        foreach($request->name as $key => $value) {
            $order->saveOrderItems([
                'name' => $request->name[$key],
                'quantity' => $request->quantity[$key],
                'price_with_vat' => $request->price_with_vat[$key],
                'vat' => $request->vat[$key],
            ]);
        }

//        // Send email notify to customer
        if($request->input('order_send') == 1) {
            $order->update(['order_send' => Carbon::now()]);
            $order->contact->notify( new OrderCreate($order));
        }

//        flash()->success('Úspešné uložené');
        return redirect()->route('order.index', [$organization->id, $organization->slug]);
    }



    public function update(SaveOrderRequest $request, Order $order) {
        $order->update([
            'contact_id' => $request->input('contact_id'),
            'amount' => $request->input('amount')
        ]);
//        dd($request->all());

//        $this->authorize('delete-post', $order);

        foreach($request->name as $key => $value) {
            $order->saveOrderItems([
                'name' => $request->name[$key],
                'quantity' => $request->quantity[$key],
                'price_with_vat' => $request->price_with_vat[$key],
                'vat' => $request->vat[$key],
            ]);
        }

        // Send email notify for company
        if($request->input('order_send') == 1) {
            $order->contact->notify( new OrderCreate($order));
        }

//        flash()->success('Úspešné uložené');
        return redirect()->route('order.index', [auth()->user()->active_organization, auth()->user()->active_organization]);
    }

    public function copyOrder(User $user, Order $order) {
        $this->authorize('delete-post', $order);
        return view('order.copy')
            ->with('user', $user)
            ->with('order', $order);
    }

    public function send(Order $order){
        $order->contact->notify( new OrderCreate($order));
        $order->update(['order_send' => Carbon::now()]);
        return back();
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
