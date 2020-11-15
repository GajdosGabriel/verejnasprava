<?php

namespace App\Models;

use App\Models\OrderItem;
use App\Models\Organization;
use App\Models\RecordsActivity;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use RecordsActivity,  RecordsActivity, SoftDeletes;

    protected $guarded = ['id'];
    protected $with = ['contact', 'orderItems', 'organization', 'user'];


    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function saveOrderItems($data) {

        $this->orderItems()->create($data);
    }





}
