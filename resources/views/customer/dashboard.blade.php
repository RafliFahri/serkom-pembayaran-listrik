@extends('customer.index')
@section('custcontent')
    <h1 class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Halo, {{\Illuminate\Support\Facades\Auth::guard('customer')->user()->nama_pelanggan}}</h1>
@endsection
