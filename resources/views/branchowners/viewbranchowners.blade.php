@extends('layout.welcomelayout')
@section('title', 'owners')
@section('content')
<style>
    .container {
        padding-top: 10px;
    }

    .card {
        border: 1px solid #e0e0e0;
    }

    .card-header {
        background-color: #007bff;
    }

    .btn-success {
        margin-right: 10px;
    }

    .owner-names .owner-name {
    display: block;
    padding-bottom: 15px;
}

</style>

<div class="container mt-5">
    <h1>Branch-owners</h1>

    <div class="card" style="border-color: #000000;">
        <div class="card-header bg-primary text-white">
            <h4><?php
                // Retrieve the branch name based on the branch ID
                $branchModel = App\Models\Branch::find($branch->branch);
                // Check if branch is found
                if ($branchModel) {
                    echo $branchModel->name;
                } else {
                    echo "Branch not found"; // Display a message if branch is not found
                }
            ?></h4> <!-- Displaying the name attribute of the Branch model -->
        </div>
        <div class="card-body">
            <p><strong>Branch name:</strong>   <?php
                // Retrieve the branch name based on the branch ID
                $branchModel = App\Models\Branch::find($branch->branch);
                // Check if branch is found
                if ($branchModel) {
                    echo $branchModel->name;
                } else {
                    echo "Branch not found"; // Display a message if branch is not found
                }
            ?></p>
            <p><strong>Location:</strong>
                <?php
                    // Retrieve the branch name based on the branch ID
                    $branchModel = App\Models\Branch::find($branch->branch);
                    // Check if branch is found
                    if ($branchModel) {
                        echo $branchModel->location;
                    } else {
                        echo "Branch not found"; // Display a message if branch is not found
                    }
                ?>
            </p>
            <p class="owner-names">
                <?php
                // Retrieve owner names based on their IDs
                $owners = is_array($branch->owners) ? $branch->owners : explode(',', $branch->owners);
                $ownerCount = count($owners);
                if ($ownerCount === 1) {
                    echo "<strong>Owner:</strong> ";
                } else {
                    echo "";
                }
                for ($i = 0; $i < $ownerCount; $i++) {
                    // Assuming 'name' is the attribute in the User model that holds the owner's name
                    $owner = App\Models\User::find($owners[$i]);
                    if ($owner) {
                        if ($ownerCount > 1) {
                            echo "<strong>Owner " . ($i + 1) . ":</strong> ";
                        }
                        echo   $owner->name .'<span class="owner-name">'. '</span>';
                    }
                }
                ?>
            </p>






            <div class="d-flex mt-3 justify-content-end">
                <a href="{{ url('editbranchowners/'.$branch->id) }}" class="btn btn-success mr-2">Edit</a>
                <a href="{{ url('deletebranch/'.$branch->id) }}" class="btn btn-danger mr-2" onclick="return confirm('Are you sure you want to delete this Branch?')">Delete</a>
            </div>
        </div>
    </div>

</div>
<br><br><br><br>
@endsection

















