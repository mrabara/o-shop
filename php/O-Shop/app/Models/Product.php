<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Image;
use App\Scopes\AvailableProduct;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'products';

    protected $with = [
        'images',
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable =[
        'name',
        'description',
        'price',
        'stock',
        'status',
    ];


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(){
        static::addGlobalScope(new AvailableProduct);

        static::updated(function ($product){
            if($product->stock == 0 && $product->status == 'available'){
                $product->status = 'unavailable';
                $product->save();
            }
        });
    }


    public function carts(){

        return $this->morphedByMany(Cart::class, 'producttable')->withPivot('quantity');
    }

    public function orders(){

        return $this->morphedByMany(Order::class, 'producttable')->withPivot('quantity');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopeAvailable($filter){

        return $filter->where('status', 'available');
    }


    public function getTotalAttribute(){

        return $this->price * $this->pivot->quantity;

    }
}
