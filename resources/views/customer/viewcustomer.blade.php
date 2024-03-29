@extends('layout.welcomelayout')
@section('title', 'customer')
@section('content')
<style>
    .container {
        padding-top: 10px;
    }

    .card {
        border: 1px solid #e0e0e0;
    }

    .card-header {
        background-color: #007bff;
    }

    .btn-success {
        margin-right: 10px;
    }
</style>

<div class="container mt-5">
    <h1>Customer</h1>

    <div class="card" style="border-color: #000000;">
        <div class="card-header bg-primary text-white">
           <h4> {{$customer->name}} </h4>
        </div>
        <div class="card-body">
            <p><strong>Customer name:</strong> {{ $customer->name}}</p>
            <p><strong>Mobile number:</strong> {{ $customer->mobilenumber}}</p>
            <p><strong>Location:</strong> {{ $customer->location}}</p>


            <div class="d-flex mt-3 justify-content-end">
                <a href="{{ url('editcustomer/'.$customer->id) }}" class="btn btn-success mr-2">Edit</a>
                <a href="{{ url('deletecustomer/'.$customer->id) }}" class="btn btn-danger mr-2" onclick="return confirm('Are you sure you want to delete this Customer?')">Delete</a>
            </div>


        </div>
    </div>
</div>
<br><br><br><br>
@endsection






