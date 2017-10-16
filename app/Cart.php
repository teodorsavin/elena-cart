<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = ['ip', 'product_id', 'quantity', 'price'];

    public function scopeIp($query, $string) {
        return $query->where('ip', $string);
    }

    public static function findOrCreate($cartItem)
    {
        $product = self::ip($cartItem['ip'])->where("product_id", $cartItem['product_id'])->first();

        if(!$product) {
            $cartItem["price"] = Books::$books[$cartItem['product_id']]["price"];
            $product = self::create($cartItem);
        } else {
            $product->quantity++;
            $product->save();
        }

        return $product;
    }

    public static function getCart($ip)
    {
        $cart = self::ip($ip)->get();
        return json_encode($cart);
    }
}