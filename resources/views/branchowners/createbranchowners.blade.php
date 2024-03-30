@extends('layout.welcomelayout')
@section('title', 'EasyLab')
@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Create Branch</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding-top: 90px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .login-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            user-select: none;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .login-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .login-container button {
            background-color: #316FF6;
            color: #fff;
            padding: 10px 40px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .signup-link {
            margin-top: 15px;
            color: #333;
        }

        .signup-link a {
            color: #316FF6;
            text-decoration: none;
            font-weight: bold;
        }

        p{
            font-size: 13px;
        }






    .alert {
        font-size: 12px;
        color:red; /* Customize the color as needed */
        margin-bottom: 10px; /* Adjust the margin-top as needed */
        margin-top: -10px; /* Remove padding */
    }




        @media (max-width: 600px) {
            .login-container {
                margin: 20px;
            }


        }
    </style>
</head>
<body>

    <!-- Add this in your view to display error or success messages -->
<!-- Add this within your form to display the mobile number error -->









<div class="login-container">
    <h2>Create Branch-owners</h2>
    <form action="{{ route('createbranchowners.post') }}" method="POST">
        @csrf

        <select id="branch" name="branch_name" required>
            <option value="">Select branch name</option>
            @foreach($branchdata as $branch)
                <option value="{{ $branch->id }}">{{ $branch->name }} - {{ $branch->location }}</option>
            @endforeach
        </select>

        <div id="owners-container">
            <select class="owner-select" name="owner_id[]" required>
                <option value="">Select owner name</option>
                @foreach($userdata as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->mobilenumber }}</option>
                @endforeach
            </select>
        </div>

        <button type="button" id="add-owner">Add More Owner</button>

        <button type="submit">Create</button>
    </form>
</div>

<script>
    document.getElementById('add-owner').addEventListener('click', function() {
        var container = document.getElementById('owners-container');
        var select = document.createElement('select');
        select.setAttribute('class', 'owner-select');
        select.setAttribute('name', 'owner_id[]');
        select.required = true;
        var option = document.createElement('option');
        option.setAttribute('value', '');
        option.appendChild(document.createTextNode('Select owner name'));
        select.appendChild(option);
        @foreach($userdata as $user)
            var option = document.createElement('option');
            option.setAttribute('value', '{{ $user->id }}');
            option.appendChild(document.createTextNode('{{ $user->name }}'));
            select.appendChild(option);
        @endforeach
        container.appendChild(select);
    });
</script>













</body>




</html>

@endsection
