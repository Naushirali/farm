@extends('layout.welcomelayout')
@section('title', 'EasyLab')
@section('content')
    <style>
        .body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding-top: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .login-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
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



/* CSS */
.input-with-button {
  display: flex;
  align-items: center;
}

#apikey {
  flex: 1;
  padding: 10px;
  border-radius: 3px 0 0 3px;
}

#generateKeyButton {
  background-color: #3498db;
  color: #fff;
  border: none;
  border-radius: 0 3px 3px 0;
  padding: 11px;
  cursor: pointer;
  margin-bottom: 15px;
}

#generateKeyButton:hover {
  background-color: #2980b9;
}


    </style>


    <!-- Add this in your view to display error or success messages -->
<!-- Add this within your form to display the mobile number error -->

<div class="body">


    <div class="login-container">
        <h2>Create Branch</h2>
        <form action="{{route('createbranch.post')}}" method="POST">
            @csrf

            <input type="text" id="name" placeholder="Lab name" name="name" required autocomplete="off" value="{{ old('name') }}">

            <input type="text" id="location" placeholder="Branch Location" name="location" required autocomplete="off" value="{{ old('location') }}">

            <div class="input-group">
                <input type="text" id="mobilenumber" name="mobilenumber" placeholder="Mobile number" required autocomplete="off" value="{{ old('mobilenumber') }}">
                @if ($errors->has('mobilenumber'))
                <div class="alert alert-danger alert-small">{{ $errors->first('mobilenumber') }}</div>
            @endif
            </div>



            <div class="input-group">
                <input type="text" id="pass" name="pass" placeholder="Password" required autocomplete="off" value="{{ old('pass') }}">
                @if ($errors->has('pass'))
                <div class="alert alert-danger alert-small">{{ $errors->first('pass') }}</div>
            @endif
            </div>



            <div class="input-with-button">
                <input type="text" id="apikey" placeholder="API key" name="apikey" required autocomplete="off" value="{{ old('apikey') }}">
                <button type="button" id="generateKeyButton" onclick="generateApiKey()">
                  <i class="fas fa-key"></i> <!-- Assuming you're using Font Awesome for the key icon -->
                </button>
            </div>
            <div class="input-group">
            @if ($errors->has('apikey'))
            <div class="alert alert-danger alert-small">{{ $errors->first('apikey') }}</div>
            @endif
            </div>



<script>

    // JavaScript
function generateApiKey() {
  var apiKey = '';
  var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

  for (var i = 0; i < 10; i++) {
    apiKey += characters.charAt(Math.floor(Math.random() * characters.length));
  }

  document.getElementById('apikey').value = apiKey;
}

    </script>





            <button type="submit">Create</button>
        </form>

    </div>
</div>





<br><br>

@endsection
