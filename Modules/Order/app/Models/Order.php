<?php

namespace Modules\Order\Models;

use App\Models\Address;
use App\Models\order_product;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Carts\Models\Carts;
use Modules\ProductSuiteManager\Models\Product;

// use Modules\Order\Database\Factories\OrderFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'unique_code',  
        'address_id',  
        'gate',  
        'price_total',  
        'transaction_id',  
        'status', 
    ];
    public function carts(): BelongsTo
    {
        return $this->belongsTo(Carts::class);
    }
    public function address():BelongsTo 
    {  
        return $this->belongsTo(Address::class);  
    }
    public function products():BelongsToMany  
    {  
        return $this->belongsToMany(Product::class, 'order_products')  
                    ->withPivot('quantity')   
                    ->withTimestamps();  
    }

    // protected static function newFactory(): OrderFactory
    // {
    //     // return OrderFactory::new();
    // }
}
