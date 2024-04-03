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
                    var ownerItem = $('<div class="owner-item"></div>').text(owner.name + ' - ' + owner.mobile);
                    ownerItem.attr('data-owner-id', owner.id);
                    ownerItem.on('click', function() {
                        inputField.val(owner.name + ' - ' + owner.mobile);
                        // Set the owner ID in the hidden input if needed
                        var ownerIdInput = $('<input type="hidden" name="owner_ids[]" />').val(owner.id);
                        inputField.after(ownerIdInput);
                        ownersList.hide();
                    });
                    ownersList.append(ownerItem);
                    visibleSuggestions++;
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
























































