@extends('layouts.app')

@section('content')
<div class="container">

    <section>
    @if(session()->has('sucess'))
            <alert class="alert alert-success">
                {{session()->get('sucess')}}
            </alert>
            @endif
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-2">
                    <img src="{{$product->image}}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->title}}</h5>
                        <p class="card-text">title and make up the bulk of the card's content.</p>
                        <h5 class="card-title">${{$product->price}}</h5>
                        <a href="{{route('cart.add',$product->id)}}" class="btn btn-primary">Buy</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>

@endsection