@extends('layout.welcomelayout')
@section('title', 'Edit Branch')
@section('content')
<style>
    .container {
        padding-top: 10px;
    }
    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .btn-primary {
        font-size: 17px;
        background-color: #007bff;
        color: #fff;
        border: 1px solid #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        color: #fff;
    }

    /* New style for the container box */
    .edit-container {
        border: 2px solid #000000;
        padding: 20px;
        border-radius: 5px;
    }

    .form-control {
        border: 1px solid #000000; /* Black border */
    }


    .password-toggle {
        position: absolute;
        top: 50px;
        transform: translateY(-50%);
        right: 10px; /* Adjust the distance from the right edge */
        cursor: pointer;
    }

    /* Style for the eye icon */
    .password-toggle i {
        color: #aaa; /* Eye icon color */
    }

    .alert {
        font-size: 12px;
        color:red; /* Customize the color as needed */
        margin-bottom: 10px; /* Adjust the margin-top as needed */
        margin-top: 10px; /* Remove padding */
    }
</style>



<div class="container">
    <h1>Edit Branch</h1>
    <!-- Enclosing div with class edit-container -->
    <div class="edit-container">
        <form action="{{ route('updatebranch', ['id' => $branch->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label"><i class="fas fa-medkit"></i> Branch name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $branch->name }}" required autocomplete="off">
            </div>

            <div class="form-group">
                <label for="location" class="form-label"><i class="fas fa-map-marker-alt"></i> Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') ?? $branch->location }}" required autocomplete="off">
            </div>


            <div class="form-group">
                <label for="mobilenumber" class="form-label"><i class="fas fa-phone"></i> Contact number</label>
                <input type="text" class="form-control" id="mobilenumber" name="mobilenumber"  value="{{ old('mobilenumber') ?? $branch->mobilenumber }}"  required autocomplete="off">
                @if ($errors->has('mobilenumber'))
                <div class="alert alert-danger alert-small">{{ $errors->first('mobilenumber') }}</div>
            @endif
            </div>



            <div class="form-group">
                <label for="apikey" class="form-label"><i class="fas fa-key"></i> API key</label>
                <input type="text" class="form-control" id="apikey" name="apikey" value="{{ old('apikey') ?? $branch->apikey }}" required autocomplete="off">
            </div>



            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<br><br><br><br>
@endsection



