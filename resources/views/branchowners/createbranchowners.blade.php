@extends('layout.welcomelayout')
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

    .owners-list {
    width: calc(100% - 22px);
    margin-left: 10px;
    border-radius: 6px;
    max-height: 150px; /* Limit height to show only 3 suggestions at a time */
    overflow-y: auto; /* Enable scrolling if more suggestions */
    display: none; /* Hide by default */
    background-color: #e8e8e8;
    margin-top: -10px;
    z-index: 999; /* Ensure it's on top of other elements */
    margin-bottom: 10px;
}

.owner-item {
    padding: 5px 10px;
    cursor: pointer;
    display: flex;
    justify-content: flex-start; /* Align items to the start of the flex container */
    padding-left: 10px;
}

.owner-item:hover {
    background-color: #f8f8f8;
}

.owner-input-field::placeholder {
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

.fa-chevron-down {
    position: absolute;
  right: 16px;
  top: 38%;
  transform: translateY(-50%);
    color: #000000; /* Icon color */
}



</style>




    <!-- Add this in your view to display error or success messages -->
<!-- Add this within your form to display the mobile number error -->







<div class="body">

    <div class="login-container">
        <h2>Create Branch Owners</h2>
        <form id="create-branch-owners-form" action="{{ route('createbranchowners.post') }}" method="POST">
            @csrf

            <select id="branch" name="branch_name" required>
                <option value="">Select branch name</option>
                @foreach($branchdata as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }} - {{ $branch->location }}</option>
                @endforeach
            </select>

            <div id="owner-inputs">
                <div class="input-icon owner-input">
                    <input type="text" class="owner-input-field" placeholder="Select owner name" required autocomplete="off">
                </div>
                <div class="owners-list"></div>
            </div>

            <button type="button" id="add-owner">Add More Owner</button>

            <button type="submit">Create</button>
        </form>
    </div>

    <script>
        var ownersData = [
            @foreach($userdata as $user)
                { id: '{{ $user->id }}', name: '{{ $user->name }}', mobile: '{{ $user->mobilenumber }}' },
            @endforeach
        ];

        var ownerInputs = document.getElementById('owner-inputs');
        var addOwnerButton = document.getElementById('add-owner');
        var form = document.getElementById('create-branch-owners-form');

        var initialInputField = document.querySelector('.owner-input-field');
        var initialOwnersList = document.querySelector('.owners-list');

        initialInputField.addEventListener('focus', function() {
            showOwnersList(initialInputField, initialOwnersList);
        });

        initialInputField.addEventListener('input', function() {
            showOwnersList(initialInputField, initialOwnersList);
        });

        addOwnerButton.addEventListener('click', function() {
            addOwnerInput();
        });

        function addOwnerInput() {
            var newOwnerInput = document.createElement('div');
            newOwnerInput.classList.add('input-icon', 'owner-input');

            var inputField = document.createElement('input');
            inputField.type = 'text';
            inputField.classList.add('owner-input-field');
            inputField.placeholder = 'Select owner name';
            inputField.required = true;
            inputField.autocomplete = 'off';

            newOwnerInput.appendChild(inputField);

            var ownersList = document.createElement('div');
            ownersList.classList.add('owners-list');

            newOwnerInput.appendChild(ownersList);

            ownerInputs.appendChild(newOwnerInput);

            inputField.addEventListener('focus', function() {
                showOwnersList(inputField, ownersList);
            });

            inputField.addEventListener('input', function() {
                showOwnersList(inputField, ownersList);
            });
        }

        function showOwnersList(input, ownersList) {
            var inputValue = input.value.toLowerCase();
            var selectedOwners = []; // Array to store already selected owner names
            // Collect already selected owner names
            document.querySelectorAll('.owner-input-field').forEach(function(inputField) {
                if (inputField !== input && inputField.value) {
                    var selectedOwnerName = inputField.value.split(' - ')[0].trim().toLowerCase();
                    selectedOwners.push(selectedOwnerName);
                }
            });
            ownersList.innerHTML = '';
            var visibleSuggestions = 0; // Counter for visible suggestions
            ownersData.forEach(function(owner) {
                if (!selectedOwners.includes(owner.name.toLowerCase()) && (owner.name.toLowerCase().includes(inputValue) || owner.mobile.includes(inputValue))) {
                    if (visibleSuggestions < 3) { // Display only 3 suggestions
                        var ownerItem = document.createElement('div');
                        ownerItem.textContent = owner.name + ' - ' + owner.mobile;
                        ownerItem.classList.add('owner-item');
                        ownerItem.setAttribute('data-owner-id', owner.id);
                        ownerItem.addEventListener('click', function() {
                            input.value = owner.name + ' - ' + owner.mobile;
                            // Set the owner ID in the hidden input if needed
                            var ownerIdInput = document.createElement('input');
                            ownerIdInput.type = 'hidden';
                            ownerIdInput.name = 'owner_ids[]'; // Assuming you want to pass multiple owner IDs
                            ownerIdInput.value = owner.id;
                            form.appendChild(ownerIdInput);

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
            var ownerInputs = document.querySelectorAll('.owner-input-field');
            ownerInputs.forEach(function(input) {
                var ownersList = input.nextElementSibling;
                if (!input.contains(event.target) && !ownersList.contains(event.target)) {
                    ownersList.innerHTML = '';
                }
            });
        });

    </script>
























</div>

<br><br><br>

@endsection












