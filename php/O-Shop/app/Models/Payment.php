<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;


class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable =[
        'amount',
        'paid_at',
        'order_id',
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $dates = [
        'payed_at',
     ];


     public function order(){
         return $this->belongsTo(Order::class);
     }

}
