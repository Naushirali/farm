
@extends('layout.welcomelayout')
@section('title', 'EasyLab')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyLab</title>

    <style>

.btn-primary
        {
            background-color: #316FF6;
            color: #ffffff;
            padding: 5px;
            margin-left: 10px;
            margin-top: 10px;
            border-radius: 20px;
            padding-left: 15px;
            padding-right: 15px;
        }

    </style>

</head>
<body>
    <a href="{{ route('logout') }}"  class="btn btn-primary">logout</a>



</body>
</html>

@endsection



























{{-- @extends('layout.welcomelayout')
@section('title', 'EasyLab')
@section('content')

<style>
    .body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #ffffff; /* Light gray background */
        margin: 0;
        padding-top: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%; /* Full viewport height */
    }

    .login-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 30px;
    }

    input,
    select,
    button {
        width: calc(100% - 22px);
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 16px;
    }

    button {
        background-color: #316FF6;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #2558b8;
    }

    .add-owner-btn {
        background-color: #4CAF50;
    }

    .add-owner-btn:hover {
        background-color: #45a049;
    }

    .alert {
        font-size: 14px;
        color: red;
        margin-bottom: 10px;
        margin-top: -10px;
    }

    @media (max-width: 600px) {
        .login-container {
            margin: 20px;
        }
    }

    #owners-list {
    width: calc(100% - 22px);
    margin-left: 10px;
    border-radius: 6px;
    max-height: 150px; /* Limit height to show only 3 suggestions at a time */
    overflow-y: auto; /* Enable scrolling if more suggestions */
    display: none; /* Hide by default */
    background-color: #e8e8e8;
    margin-top: -20px;
    z-index: 999; /* Ensure it's on top of other elements */
    margin-bottom: 10px;
}

.owner-item {
    padding: 5px 10px;
    cursor: pointer;
    display: flex;
    justify-content: flex-start; /* Align items to the start of the flex container */
    padding-left: 5px;
}

.owner-item:hover {
    background-color: #f8f8f8;
}

#owner-input::placeholder {
    color: #000000; /* Set placeholder text color to black */
}


.input-icon {
  position: relative;
}

.input-icon input[type="text"] {
  padding-right: 25px; /* Adjust as needed */
}

.input-icon i {
  position: absolute;
  right: 16px;
  top: 38%;
  transform: translateY(-50%);
}



</style>




    <!-- Add this in your view to display error or success messages -->
<!-- Add this within your form to display the mobile number error -->







<div class="body">

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

        <div class="input-icon">
            <input type="text" id="owner-input" placeholder="Select owner name" required autocomplete="off">
            <i class="fas fa-chevron-down fa-xs"></i>
        </div>

            <div id="owners-list"></div>




            <script>
                var ownersData = [
                    @foreach($userdata as $user)
                        { id: '{{ $user->id }}', name: '{{ $user->name }}', mobile: '{{ $user->mobilenumber }}' },
                    @endforeach
                ];

                var input = document.getElementById('owner-input');
                var ownersList = document.getElementById('owners-list');

                input.addEventListener('focus', function() {
                    showOwnersList();
                });

                input.addEventListener('input', function() {
                    showOwnersList();
                });

                function showOwnersList() {
    var inputValue = input.value.toLowerCase();
    ownersList.innerHTML = '';
    var visibleSuggestions = 0; // Counter for visible suggestions
    ownersData.forEach(function(owner) {
        if (owner.name.toLowerCase().includes(inputValue) || owner.mobile.includes(inputValue)) {
            if (visibleSuggestions < 3) { // Display only 3 suggestions
                var ownerItem = document.createElement('div');
                ownerItem.textContent = owner.name + ' - ' + owner.mobile;
                ownerItem.classList.add('owner-item');
                ownerItem.setAttribute('data-owner-id', owner.id);
                ownerItem.addEventListener('click', function() {
                    input.value = owner.name + ' - ' + owner.mobile;
                    input.setAttribute('data-owner-id', owner.id);
                    ownersList.innerHTML = '';
                });
                ownersList.appendChild(ownerItem);
                visibleSuggestions++; // Increment visible suggestions counter
            }
        }
    });
    if (visibleSuggestions > 0) {
        ownersList.style.display = 'block';
    } else {
        ownersList.style.display = 'none';
    }
}


                document.addEventListener('click', function(event) {
                    if (!input.contains(event.target) && !ownersList.contains(event.target)) {
                        ownersList.innerHTML = '';
                    }
                });
            </script>




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
            option.appendChild(document.createTextNode('{{ $user->name }} - {{ $user->mobilenumber }}'));
            select.appendChild(option);
        @endforeach
        container.appendChild(select);
    });
</script>
















</div>

<br><br><br>

@endsection --}}
