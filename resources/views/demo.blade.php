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

        <input type="hidden" id="owner-id-input" name="owner_id" required> <!-- Hidden input to store owner ID -->

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
            var ownerIdInput = document.getElementById('owner-id-input'); // Get the hidden input

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
                                ownerIdInput.value = owner.id; // Set the owner ID in the hidden input
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

        <input type="hidden" id="owner-id-input" name="owner_id[]" required> <!-- Hidden input to store owner ID -->

        <div class="input-icon">
            <input type="text" class="owner-input" placeholder="Select owner name" required autocomplete="off">
            <i class="fas fa-chevron-down fa-xs"></i>
        </div>

        <div class="owners-list"></div>

        <button type="button" class="add-owner">Add More Owner</button>

        <button type="submit">Create</button>
    </form>
</div>

<script>
    var ownersData = [
        @foreach($userdata as $user)
            { id: '{{ $user->id }}', name: '{{ $user->name }}', mobile: '{{ $user->mobilenumber }}' },
        @endforeach
    ];

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('add-owner')) {
            var form = event.target.closest('form');
            var lastOwnerInput = form.querySelector('.owner-input:last-of-type');
            var clonedOwnerInput = lastOwnerInput.cloneNode(true);
            var clonedOwnerIdInput = form.querySelector('#owner-id-input').cloneNode(true);

            clonedOwnerInput.value = ''; // Clear the value of cloned input
            clonedOwnerIdInput.value = ''; // Clear the value of cloned hidden input

            form.insertBefore(clonedOwnerIdInput, event.target); // Insert cloned hidden input
            form.insertBefore(clonedOwnerInput, event.target); // Insert cloned input
        }
    });

    document.addEventListener('focusin', function(event) {
        if (event.target.classList.contains('owner-input')) {
            showOwnersList(event.target);
        }
    });

    document.addEventListener('input', function(event) {
        if (event.target.classList.contains('owner-input')) {
            showOwnersList(event.target);
        }
    });

    function showOwnersList(input) {
        var ownersList = input.nextElementSibling;
        var ownerIdInput = input.previousElementSibling;

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
                        ownerIdInput.value = owner.id; // Set the owner ID in the hidden input
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
        if (!event.target.classList.contains('owner-input') && !event.target.classList.contains('owners-list')) {
            var ownersLists = document.querySelectorAll('.owners-list');
            ownersLists.forEach(function(ownersList) {
                ownersList.innerHTML = '';
            });
        }
    });
</script>
