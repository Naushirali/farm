@extends('layout.welcomelayout')
@section('title', 'EasyLab')
@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Create Customer</title>
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

    .password-container {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        top: 35%;
        transform: translateY(-50%);
        right: 10px; /* Adjust the distance from the right edge */
        cursor: pointer;
    }

    /* Style for the eye icon */
    .password-toggle i {
        color: #aaa; /* Eye icon color */
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
        <h2>Create Customer</h2>
        <form action="{{route('createcustomer.post')}}" method="POST">
            @csrf

            <input type="text" id="name" placeholder="Name" name="name" required autocomplete="off" value="{{ old('name') }}">

            <div class="input-group">
                <input type="text" id="mobilenumber" name="mobilenumber" placeholder="Mobile number" required autocomplete="off" value="{{ old('mobilenumber') }}">
                @if ($errors->has('mobilenumber'))
                <div class="alert alert-danger alert-small">{{ $errors->first('mobilenumber') }}</div>
            @endif
            </div>


            <input type="text" id="location" placeholder="Location" name="location" required autocomplete="off" value="{{ old('location') }}">

            <div class="password-container">
                <input type="password" id="password" placeholder="Password" name="password" required autocomplete="off">
                <span class="password-toggle" onclick="togglePasswordVisibility('password')">
                    <i class="fa fa-eye" id="password-toggle-icon"></i>
                </span>
            </div>

            <div class="password-container">
                <input type="password" id="confirmpassword" placeholder="Confirm password" name="confirmpassword" required autocomplete="off">
                <span class="password-toggle" onclick="togglePasswordVisibility('confirmpassword')">
                    <i class="fa fa-eye" id="confirmpassword-toggle-icon"></i>
                </span>
            </div>


           @if ($errors->has('password'))
           <div class="alert alert-danger alert-small">{{ $errors->first('password') }}</div>
           @endif







            <button type="submit">Create</button>
        </form>

    </div>
</body>


<script>
    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        var toggleIcon = document.getElementById(inputId + '-toggle-icon');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>

</html>

@endsection
