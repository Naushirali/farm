@extends('layout.welcomelayout')
@section('title', 'branches')
@section('content')

<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Welcome Page</title>
    <style>
        body {
            padding-top: 10px;
        }

        .header {
            margin-left: 2.5cm;
            margin-right: 1.5cm;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-container {
            position: relative;
        }

        .round-search {
            display: flex;
            align-items: center;
            border: 2px solid #ccc;
            border-radius: 20px; /* Adjust border-radius for curved corners */
            overflow: hidden;
        }

        .search-bar {
            border: none;
            padding: 10px;
            width: 200px; /* Adjust width as needed */
            outline: none; /* Remove default outline */
        }

        .search-button {
            background-color: #ffffff;
            color: rgb(141, 141, 141);
            border: none;
            padding: 10px;
            margin-left: -1.1cm;
            border-radius: 0 10px 10px 0; /* Adjust border-radius for curved corners */
            cursor: pointer;
        }

        .round-search:focus-within {
            border-color: #ccc; /* Change border color on focus */
        }

        .btn-primary
        {
            background-color: #316FF6;
            color: #ffffff;
            padding: 8px;
            border-radius: 20px;
            padding-left: 20px;
            padding-right: 20px;
        }






    </style>
</head>
<body>


<div class="header">
    <div class="search-container">
        <div class="round-search">
            <!-- You can customize the placeholder text and input attributes as needed -->
            <input type="text" id="searchInput" class="search-bar" placeholder="Search branch">
            <button type="button" class="search-button">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
    <a href="{{ route('createbranchowners') }}" class="btn btn-primary">create owners</a>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const cowContainers = document.querySelectorAll('.cow-container');

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();

            cowContainers.forEach(function(cowContainer) {
                const cowName = cowContainer.querySelector('.cow-details p').textContent.toLowerCase();
                if (cowName.includes(searchTerm)) {
                    cowContainer.style.display = 'block';
                } else {
                    cowContainer.style.display = 'none';
                }
            });
        });
    });
</script>






<!-- ... your existing code ... -->

<style>
    /* ... your existing styles ... */

    .customer-container {
        position: relative; /* Add relative positioning for absolute button placement */
        text-align: center; /* Center the content */
        margin: 10px; /* Add some spacing between cow items */
        border: 0px solid #316FF6;
        border-radius: 10px;
        margin-left: 12px;
        overflow: hidden; /* Ensure container wraps around floated image and details */
        padding-top: 2px;
        padding-bottom: 2px;
        cursor: pointer;
        margin-left: 2.5cm;
        margin-right: 1.5cm;
    }







    /* Target every odd .cow-container and even .alert-container */
    .customer-container:nth-child(odd)
{
    background-color:#B4E4FF;
}

/* Target every even .cow-container and odd .alert-container */
.customer-container:nth-child(even)
{
    background-color:#FFDEB4;
}








@media screen and (max-width: 1300px)
{

    .customer-container {
    margin-left: 1.5cm;
    margin-right: 1.5cm;
    }

    .header{
        margin-left: 1.5cm;
        margin-right: 1.5cm;
    }

}




@media screen and (max-width: 900px)
{

    .customer-container {
    margin-left: 1cm;
    margin-right: 1cm;
    }

    .header{
        margin-left: 1cm;
        margin-right: 1cm;
    }

}


@media screen and (max-width: 600px)
{

    .customer-container {
    margin-left: 3%;
    margin-right: 3%;
    }

    .header{
        margin-left: 3%;
        margin-right: 3%;
    }

}

</style>






@foreach ($branchownerdata as $branch)
    <div class="customer-container">
        <div>
            <p>Name: {{ $branch['branch'] }}</p>
        </div>
        <div>
            <p>Owners:
                <?php $owners = is_array($branch['owners']) ? $branch['owners'] : explode(',', $branch['owners']); ?>
                @foreach ($owners as $ownerId)
                    <?php
                    $owner = App\Models\User::find($ownerId);
                    ?>
                    @if ($owner)
                        {{ $owner->name }}
                    @endif
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </p>
        </div>
    </div>
@endforeach








</body>
</html>


<br>
<br>
<br>
@endsection
