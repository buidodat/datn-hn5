@extends('client.layouts.master')

@section('title')
    Giá vé Poly {{ $cinema->name }}
@endsection

@section('content')
<h1 class="ticket-price">BẢNG GIÁ VÉ - {{ $cinema->branch->name }} - {{ $cinema->name }}</h1>
<div class="container-ticket-price">
    <table class="table table-bordered rounded align-middle">
        <thead>
            <tr class="table-light">
                <th colspan='2' class="text-center">PHỤ THU</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Poly {{ $cinema->name }}</td>
                <td>{{ number_format($cinema->surcharge) }}đ</td>
            </tr>
            @foreach ($typeRooms as $typeRoom)
            <tr>
                <td>{{ $typeRoom->name }}</td>
                <td>{{ number_format($typeRoom->surcharge) }}đ</td>
            </tr>
            @endforeach
        </tbody>
        <thead>
            <tr class="table-light">
                <th colspan='2' class="text-center">GIÁ THEO GHẾ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($typeSeats as $typeSeat)
            <tr>
                <td>{{ $typeSeat->name }}</td>
                <td>{{ number_format($typeSeat->price) }}đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('styles')
<style>
    h1.ticket-price {
    font-size: 28px;
    text-align: center;
    margin-bottom: 20px;
    margin-top: 30px;
}

.container-ticket-price{
    text-align: center; 
    width: 30%; 
    margin: 0 auto; 
}
</style>
@endsection