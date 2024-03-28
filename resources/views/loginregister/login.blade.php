
@extends('layout.loginlayout')
@section('title', 'EasyLab')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Login Page</title>
    <style>
        body-1 {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 92vh;
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
            padding: 10px 50px;
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

    .error-message {
        color: red;
        margin-bottom: 10px;
        font-size: 14px;
    }




        @media (max-width: 600px) {
            .login-container {
                margin: 20px;
            }



        .error-message {
            font-size: 12px;
        }


        }




        #installButton {
        position: fixed;
        top: 55px;
        right: 10px;
        display: none;
        background-color: green; /* Change button color to green */
        color: white; /* Change text color to white */
        border: none; /* Remove border */
        padding: 5px 15px; /* Adjust padding */
        border-radius: 5px; /* Add border radius for rounded corners */
        cursor: pointer; /* Change cursor to pointer on hover */
    }


    </style>
</head>

<!-- PWA  -->
<meta name="theme-color" content="#6777ef"/>
<link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">
<body-1>

    <button id="installButton" display="none">Install App</button>

<script>
    window.addEventListener('load', () => {
        let deferredPrompt;

        // Check if the PWA can be installed
        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevent the default browser prompt
            e.preventDefault();
            // Store the event to use it later
            deferredPrompt = e;
            // Show the install button
            document.getElementById('installButton').style.display = 'block';
        });

        // Handle the click event of the install button
        document.getElementById('installButton').addEventListener('click', () => {
            // Prompt the user to install the PWA
            deferredPrompt.prompt();
            // Wait for the user to respond to the prompt
            deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the install prompt');
                } else {
                    console.log('User dismissed the install prompt');
                }
                // Reset the deferredPrompt variable
                deferredPrompt = null;
                // Hide the install button
                document.getElementById('installButton').style.display = 'none';
            });
        });
    });
</script>



    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="text" id="mobilenumber" name="mobilenumber"  placeholder="Mobile number" required autocomplete="off" value="{{ old('mobilenumber') }}">
            <div class="password-container">
                <input type="password" id="password" placeholder="Password" name="password" required autocomplete="off">
                <span class="password-toggle" onclick="togglePasswordVisibility('password')">
                    <i class="fa fa-eye" id="password-toggle-icon"></i>
                </span>
            </div>

            <!-- Error Message for Password -->
            @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif
            <button type="submit">Login</button>
        </form>
        {{-- <div class="signup-link">
            <p>Not a member? <a href="{{ route('registration') }}">Create new account</a></p>
        </div> --}}
    </div>
</body-1>


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

<script src="{{ asset('/sw.js') }}"></script>
<script>
   if ("serviceWorker" in navigator) {
      // Register a service worker hosted at the root of the
      // site using the default scope.
      navigator.serviceWorker.register("/sw.js").then(
      (registration) => {
         console.log("Service worker registration succeeded:", registration);
      },
      (error) => {
         console.error(`Service worker registration failed: ${error}`);
      },
    );
  } else {
     console.error("Service workers are not supported.");
  }
</script>


</html>

@endsection


