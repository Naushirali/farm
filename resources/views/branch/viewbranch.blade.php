@extends('layout.welcomelayout')
@section('title', 'branch')
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
    <h1>Branch</h1>

    <div class="card" style="border-color: #000000;">
        <div class="card-header bg-primary text-white">
           <h4> {{$branch->name}} </h4>
        </div>
        <div class="card-body">
            <p><strong>Branch name:</strong> {{ $branch->name}}</p>
            <p><strong>Location:</strong> {{ $branch->location}}</p>
            <p><strong>Mobile number:</strong> {{ $branch->mobilenumber}}</p>
            <p><strong>API Key:</strong> {{ $branch->apikey}}</p>


            <div class="d-flex mt-3 justify-content-end">
                <a href="{{ url('editbranch/'.$branch->id) }}" class="btn btn-success mr-2">Edit</a>
                <a href="{{ url('deletebranch/'.$branch->id) }}" class="btn btn-danger mr-2" onclick="return confirm('Are you sure you want to delete this Branch?')">Delete</a>
            </div>




        </div>
    </div>
</div>
<br><br><br><br>
@endsection
