<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;
use App\Cart;

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //
    }

    public function allBooks()
    {
        return json_encode(Books::$books);
    }

    public function headers()
    {
        header('Access-Control-Allow-Methods: POST, GET');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Content-type: application/json; charset=utf-8');
    }

    public function addToCart(Request $request)
    {
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Content-type: application/json; charset=utf-8');

        $cartItem = $request->all();

        if (isset($cartItem["product_id"]) && is_numeric($cartItem["product_id"])
            && isset($cartItem["quantity"]) && is_numeric($cartItem["quantity"])
            && !empty($cartItem["ip"])
        ) {
            Cart::findOrCreate($cartItem);
        } else {
            return self::error();
        }

        return json_encode(Cart::getCart($request->input("ip")));
    }

    public static function getCart(Request $request)
    {
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Content-type: application/json; charset=utf-8');

        if (!empty($request->input("ip"))) {
            $cart = Cart::getCart($request->input("ip"));
            return json_encode($cart);
        }

        return self::error();
    }

    public static function resetCart(Request $request)
    {
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Content-type: application/json; charset=utf-8');

        if (!empty($request->input("ip"))) {
            Cart::where('ip', $request->input("ip"))->delete();
            return json_encode(["empty" => "true"]);
        }

        return self::error();
    }

    public static function removeProduct(Request $request)
    {
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Content-type: application/json; charset=utf-8');

        $cartItem = $request->all();

        if (!empty($cartItem["ip"]) && isset($cartItem["product_id"]) && is_numeric($cartItem["product_id"])) {
            Cart::ip($cartItem["ip"])->where("product_id", $cartItem["product_id"])->delete();

            return json_encode(Cart::getCart($cartItem["ip"]));
        }

        return self::error();
    }

    public static function error()
    {
        return json_encode(["message" => "wrong parameters"]);
    }
}
