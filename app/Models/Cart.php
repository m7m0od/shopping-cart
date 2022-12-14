<?php

namespace App\Models;

class Cart 
{
    public $items =[];
    public $totalQty;
    public $totalPrice;

    public function __construct($cart = null)
    {
        if($cart)
        {
            $this->items =$cart->items;
            $this->totalQty = $cart->totalQty;
            $this->totalPrice = $cart->totalPrice;
        }else{
            $this->items =[];
            $this->totalQty = 0;
            $this->totalPrice = 0;
        }
    }

    public function add($product)
    {
        $items =[
            'id' => $product->id,
            'title' => $product->title,
            'price' => $product->price,
            'Qty' => 0,
            'image' => $product->image,
        ];

        if(!array_key_exists($product->id,$this->items))
        {
            $this->items[$product->id] = $items;
            $this->totalQty +=1;
            $this->totalPrice += $product->price;
        }else{
            $this->totalQty +=1;
            $this->totalPrice += $product->price;
        }

        $this->items[$product->id]['Qty'] +=1;
    }

    public function remove($id)
    {
        if(!array_key_exists($id,$this->items))
        {
            $this->totalQty -= $this->items[$id]['Qty'];
            $this->totalPrice -= $this->items[$id]['Qty'] * $this->items[$id]['price'];
            unset($this->items[$id]);
        }
    }

    public function updateQty($id,$qty)
    {
        $this->totalQty -= $this->items[$id]['Qty'];
        $this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['Qty'];

        $this->items[$id]['Qty'] = $qty ;

        $this->totalQty += $qty;
        $this->totalPrice += $this->items[$id]['price'] * $qty;
    }
}
