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

    .select-wrapper {
    position: relative;
}

.select-wrapper select {
    padding-right: 30px; /* Adjust this value to make space for the icon */
}

.select-wrapper i {
    position: absolute;
    top: 50%;
    right: 10px; /* Adjust this value to position the icon */
    transform: translateY(-50%);
    pointer-events: none; /* Ensure the icon doesn't interfere with select functionality */
}

.owner-container {
    margin-bottom: 20px; /* Adjust the value as needed */
}


.delete-button {
    border: 1px solid rgb(0, 0, 0);
    border-radius: 0;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}


.owner-container {
    position: relative;
}

.owner-input {
    position: relative;
}

.delete-owner {
    position: absolute;
    top: 51px;
    right: 0px;
    transform: translateY(-50%);
}



.owners-list {
    width: calc(100% - 2px);
    margin-left: 0px;
    border-radius: 6px;
    max-height: 150px; /* Limit height to show only 3 suggestions at a time */
    overflow-y: auto; /* Enable scrolling if more suggestions */
    display: none; /* Hide by default */
    background-color: #e8e8e8;
    margin-top: 10px;
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





</style>



<div class="container">
    <h1>Edit Branch</h1>
    <!-- Enclosing div with class edit-container -->
    <div class="edit-container">
        <form action="{{ route('updatebranchowners', ['id' => $branch->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="branch" class="form-label"><i class="fas fa-medkit"></i> Branch name</label>
                <div class="select-wrapper"> <!-- Wrap select element to style dropdown icon -->
                    <select id="branch" name="branch_name" class="form-control" required>
                        <option value="">Select branch name</option>
                        @if($branch->branch && !$branchdata->contains('id', $branch->branch))
                            @php
                                $unknownBranch = \App\Models\Branch::find($branch->branch);
                            @endphp
                            @if($unknownBranch)
                                <option value="{{ $unknownBranch->id }}" selected>
                                    {{ $unknownBranch->name }} - {{ $unknownBranch->location }}
                                </option>
                            @else
                                <option value="{{ $branch->branch }}" selected>
                                    Unknown Branch (ID: {{ $branch->branch }})
                                </option>
                            @endif
                        @endif
                        @foreach($branchdata as $branchItem)
                            <option value="{{ $branchItem->id }}" {{ $branch->branch == $branchItem->id ? 'selected' : '' }}>
                                {{ $branchItem->name }} - {{ $branchItem->location }}
                            </option>
                        @endforeach
                    </select>
                    <i class="fas fa-caret-down"></i> <!-- Dropdown icon -->
                </div>
            </div>




            <div class="form-group">
                @php
                    $owners = is_array($branch->owners) ? $branch->owners : explode(',', $branch->owners);
                @endphp

                <div class="multiple-owner-container">
                    @foreach($owners as $key => $owner)
                        @php
                            $user = \App\Models\User::find($owner);
                        @endphp
                        @if($user)
                            <div class="owner-container">
                                <label for="owner{{ $key + 1 }}" class="form-label"><i class="fas fa-user"></i> Owner {{ $key + 1 }}</label>
                                <div class="input-icon owner-input">
                                    <input type="text" class="owner-input-field form-control" id="owner{{ $key + 1 }}" placeholder="Select owner name" value="{{ $user->name }} - {{ $user->mobilenumber }}" required autocomplete="off">
                                    <div class="owners-list"></div>
                                    <!-- Add hidden input for owner IDs -->
                                    <input type="hidden" name="owner_ids[]" value="{{ $owner }}">
                                </div>
                                @if($key > 0)
                                    <button class="btn btn-outline-danger delete-owner delete-button" type="button" data-target="{{ $key + 1 }}"><i class="fas fa-trash"></i></button>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
                <button type="button" id="add-owner" class="btn btn-primary">Add More Owner</button>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                var ownersData = [
                    @foreach($userdata as $user)
                        { id: '{{ $user->id }}', name: '{{ $user->name }}', mobile: '{{ $user->mobilenumber }}' },
                    @endforeach
                ];

                $(document).ready(function() {
                    // Add owner input click event
                    $('#add-owner').click(function() {
                        addOwnerInput();
                    });

                    // Function to add owner input
                    function addOwnerInput() {
                        var lastOwnerIndex = $('.multiple-owner-container .owner-container').length;
                        var newOwnerInput = `
                            <div class="owner-container">
                                <label for="owner${lastOwnerIndex + 1}" class="form-label"><i class="fas fa-user"></i> Owner ${lastOwnerIndex + 1}</label>
                                <div class="input-icon owner-input">
                                    <input type="text" class="owner-input-field form-control" id="owner${lastOwnerIndex + 1}" placeholder="Select owner name" required autocomplete="off">
                                    <div class="owners-list"></div>
                                    <!-- Add hidden input for owner IDs -->
                                    <input type="hidden" name="owner_ids[]">
                                </div>
                                <button class="btn btn-outline-danger delete-owner delete-button" type="button" data-target="${lastOwnerIndex + 1}"><i class="fas fa-trash"></i></button>
                            </div>`;
                        $('.multiple-owner-container').append(newOwnerInput);
                    }

                    // Show owners list on input focus or input
                    $(document).on('focus input', '.owner-input-field', function() {
                        var inputField = $(this);
                        var ownersList = inputField.next('.owners-list');
                        showOwnersList(inputField, ownersList);
                    });

                    // Handle click outside to close suggestions
                    $(document).on('click', function(event) {
                        if (!$(event.target).closest('.owner-input').length) {
                            $('.owners-list').hide();
                        }
                    });

                   // Function to show owners list
function showOwnersList(inputField, ownersList) {
    var inputValue = inputField.val().toLowerCase();
    ownersList.empty();
    var visibleSuggestions = 0; // Counter for visible suggestions
    ownersData.forEach(function(owner) {
        if ((owner.name.toLowerCase().includes(inputValue) || owner.mobile.includes(inputValue)) && visibleSuggestions < 3) {
            // Check if the owner is already used
            var isUsed = false;
            $('.owner-input-field').each(function() {
                if ($(this).val().toLowerCase() === owner.name.toLowerCase() + ' - ' + owner.mobile && $(this).attr('id') !== inputField.attr('id')) {
                    isUsed = true;
                    return false; // Exit the loop
                }
            });
            if (!isUsed) {
                var ownerItem = $('<div class="owner-item"></div>').text(owner.name + ' - ' + owner.mobile);
                ownerItem.attr('data-owner-id', owner.id);
                ownerItem.on('click', function() {
                    inputField.val(owner.name + ' - ' + owner.mobile);
                    // Set the owner ID in the hidden input
                    inputField.siblings('input[name="owner_ids[]"]').val(owner.id);
                    ownersList.hide();
                });
                ownersList.append(ownerItem);
                visibleSuggestions++;
            }
        }
    });
    if (visibleSuggestions > 0) {
        ownersList.show();
    } else {
        ownersList.hide();
    }
}

                    // Delete owner input
                    $('.multiple-owner-container').on('click', '.delete-owner', function() {
                        var targetId = $(this).data('target');
                        $('#owner' + targetId).closest('.owner-container').remove();
                    });
                });
            </script>









            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<br><br><br><br>
@endsection



















