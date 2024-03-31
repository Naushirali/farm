@extends('layout.welcomelayout')
@section('title', 'branches')
@section('content')
<style>


    .container {
        max-width: 1350px;
        margin: 0 auto;
        padding-top: 10px;
    }




    .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
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






        .receipt-list {
        list-style-type: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    /* Receipt list item styles */
    .receipt-list-item {
        width: calc(50% - 10px); /* Two items per row with some spacing */
        margin-bottom: 15px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(130, 150, 249, 0.4);
    }

    .receipt-list-item-wrapper {
    display: flex; /* Add flex display */
    align-items: flex-start; /* Align items vertically at the start */
    justify-content: space-between; /* Align items with space between */
    padding: 20px;
}

.column-list-item-wrapper {
    display: flex; /* Add flex display */
    align-items: flex-start; /* Align items vertically at the start */
   flex-direction: column;
}


.name {
       margin-bottom: -5px;
        color: #333;
    }

    /* Phone container and rate container styles */
    .phone-container
    {
        margin: 0;
    }
    .rate-container {
        margin: 0;
    }

    /* View link styles */
    .view-link {
        padding: 5px 13.5px;
        background-color: #3498db;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .edit-link {
    margin-top: 5px;
    padding: 5px 10px;
    background-color: #27ae60; /* Change background color to green */
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}
    .view-link:hover {
        background-color: #2980b9;
    }

    .edit-link:hover {
    background-color: #219d52; /* Change hover background color to a darker shade of green */
}


    /* Responsive design */
    @media only screen and (max-width: 700px) {
        .receipt-list-item {
        width: 100%; /* Display one item per row on smaller screens */
    }



    }













</style>

<div class="container">



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
        <a href="{{ route('createbranch') }}" class="btn btn-primary">Add branch</a>
    </div>





    <ul class="receipt-list">
        @foreach ($branchdata as $receipt)
        <li class="receipt-list-item">
            <div class="receipt-list-item-wrapper">
                <div class="column-list-item-wrapper">

                <div class="name">
                  <h5> {{ $receipt->name}}</h5>
                </div>

                <div class="phone-container">
                     {{ $receipt->location }}
                  </div>

                  <div class="rate-container">
                  {{ $receipt->mobilenumber }}
                  </div>

                </div>


                <div class="column-list-item-wrapper">
                  <a href="{{ route('editbranch', ['id' => $receipt->id]) }}" class="view-link">Edit</a>
                  <a href="{{ route('viewbranch', ['id' => $receipt->id]) }}" class="edit-link">View</a>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    {{-- {{ $data->links() }} --}}
</div>
<br><br>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const receiptItems = document.querySelectorAll(".receipt-list-item");

        searchInput.addEventListener("input", function() {
            const searchTerm = this.value.trim().toLowerCase();

            receiptItems.forEach(function(item) {
                const name = item.querySelector(".name").textContent.toLowerCase();
                const phone = item.querySelector(".phone-container").textContent.toLowerCase();
                const location = item.querySelector(".rate-container").textContent.toLowerCase();

                if (name.includes(searchTerm) || phone.includes(searchTerm) || location.includes(searchTerm)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        });
    });
</script>



@endsection
