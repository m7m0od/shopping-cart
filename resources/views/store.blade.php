@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section">
        <div class="jumbotron">
            <h1 class="display-4">Hello , World!</h1>
            <p class="lead">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus est dolor consequuntur, dolorum assumenda doloribus, enim eum, quis facere quo eveniet! Cupiditate quia et expedita veritatis minus quam dolorem officiis?</p>
            <hr class="my-4">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo corporis delectus doloremque.</p>
            <a class="btn btn-primary btn-lg" href="{{route('product.index')}}" role="button">leran more</a>
        </div>
    </div>

    <section>
        <div class="row">
            @foreach($latestProducts as $product)
            <div class="col-md-4">
                <div class="card">
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