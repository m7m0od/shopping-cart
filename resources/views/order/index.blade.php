@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9">
            @foreach($carts as $cart)
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-striped mt-2 mb-2">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">price</th>
                                <th scope="col">Quntatity</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart->items as $items)
                            <tr>
                                <td>{{$items['title']}}</td>
                                <td>{{$items['price']}}</td>
                                <td>{{$items['Qty']}}</td>
                                <td>paid</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <p class="bg-info lead w-25 rounded-circle mb-3 p-3">Total price : ${{$cart->totalPrice}}</p>
            @endforeach
        </div>
    </div>
</div>

@endsection