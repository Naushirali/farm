@extends('layout.welcomelayout')
@section('title', 'customers')
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
        list-style: none;
        padding: 0;
    }

    .receipt-list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 10px 0;
        padding: 0;
    }

    .receipt-list-item-wrapper {
        background-color:#1778f2; /* Set the background color of the entire line to blue */
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-radius: 10px;
    }

    .receipt-list h5, .receipt-list a.view-link {
        font-size: 24px;
        margin: 0;
        color: white; /* Set the text color of the product name and "View" option to white */
        text-decoration: none; /* Remove underline or decoration */
    }

    .phone-container {
        flex: 1; /* Use flex to make this container expand to fill available space */
        padding-right: 5px;
    }

    .rate-container {
        min-width: 30%; /* Adjust the min width to control spacing */
        padding-right: 5px;
    }



    /* Margin for lab name with more distance */
    .name {
         width: 100px; /* Set a fixed width for the lab name container */
         white-space: normal; /* Allow text to wrap to the next line */
         overflow: hidden; /* Hide any overflow beyond the fixed width */
         text-overflow: ellipsis; /* Add an ellipsis (...) to indicate text overflow */
        margin-right: 80px; /* Increase the margin for more spacing */
        min-width: 30%; /* Adjust the min width to control spacing */
        padding-right: 5px;
    }



    @media screen and (max-width: 800px) {
        .rate-container {
        min-width: 25%; /* Adjust the min width to control spacing */
    }
    }



    @media screen and (max-width: 680px) {
        .receipt-list h5, .receipt-list a.view-link {
            font-size: 18px; /* Set a smaller font size for screens below 650px */
        }
    }

        @media screen and (max-width: 450px) {
        .receipt-list h5, .receipt-list a.view-link {
            font-size: 16px; /* Set a smaller font size for screens below 650px */
        }
    }


    @media screen and (max-width: 400px) {
        .rate-container {
        min-width: 25%; /* Adjust the min width to control spacing */
    }
    }



        @media screen and (max-width: 370px) {
        .receipt-list h5, .receipt-list a.view-link {
            font-size: 14px; /* Set a smaller font size for screens below 650px */
        }
    }





</style>

<div class="container">



    <div class="header">
        <div class="search-container">
            <div class="round-search">
                <!-- You can customize the placeholder text and input attributes as needed -->
                <input type="text" id="searchInput" class="search-bar" placeholder="Search customer">
                <button type="button" class="search-button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <a href="{{ route('createcustomer') }}" class="btn btn-primary">Add customer</a>
    </div>





    <ul class="receipt-list">
        @foreach ($customerdata as $receipt)
        @php
        $updatedDate = \Carbon\Carbon::parse($receipt->updated_at);
        $today = \Carbon\Carbon::today();
        $diffInMonths = $today->diffInMonths($updatedDate);
        $boxClass = '';
        if ($diffInMonths >= 3) {
            $boxClass = 'bg-brickred';
        } elseif ($diffInMonths >= 1) {
            $boxClass = 'bg-lightyellow';
        }
        @endphp
        <li class="receipt-list-item">
            <div class="receipt-list-item-wrapper {{ $boxClass }}">
                <h5 class = "name">{{ $receipt->name}}</h5>

                <div class="phone-container">
                    <h5>{{ $receipt->mobilenumber }}</h5>
                  </div>

                  <div class="rate-container">
                    <h5>{{ $receipt->location }}</h5>
                  </div>



                <a href="#" class="view-link">View</a>
            </div>
        </li>
        @endforeach
    </ul>
    {{-- {{ $data->links() }} --}}
</div>
<br><br>
@endsection










