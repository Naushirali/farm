<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>


        .mobile-footer {
            display: flex;
            justify-content: space-between;
            background-color: #fff;
            color: #000;
            border-top: 1px solid #000000;
            padding: 1px;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding-top:5px;
            z-index: 1000;
        }

        .footer-item {
            flex: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative; /* Added for positioning the border */
        }

        .footer-item a {
            text-decoration: none;
            color: #000;
            font-size: 15px;
        }

        .footer-item i {
            font-size: 24px;
        }











 /* Added CSS for highlighting the selected item */
 .footer-item::before {
            content: '';
            position: absolute;
            top: -6px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: transparent; /* Initially transparent */
        }

        .footer-item.selected::before {
            background-color: #316FF6; /* Blue color for selected item */
        }



































    </style>

<script>
    let originalHeight = window.innerHeight;
    window.addEventListener("resize", function() {
        if (window.innerHeight < originalHeight) {
            document.getElementById("mobile-footer").style.display = "none";
        } else {
            document.getElementById("mobile-footer").style.display = "flex";
        }
    });
</script>


</head>
<body>
    <div class="mobile-footer" id="mobile-footer">


        <div class="footer-item">
            <a href="{{ route('welcome') }}"><i class="fas fa-home"></i></a>
            <a href="{{ route('welcome') }}">Home</a>
        </div>


        <div class="footer-item">
            <a href="{{ route('customer') }}"><i class="fas fa-users"></i></a>
            <a href="{{ route('customer') }}">Customers</a>
        </div>


        <div class="footer-item">
            <a href="{{ route('branch') }}"><i class="fas fa-code-branch"></i></a>
            <a href="{{ route('branch') }}">Branches</a>
        </div>

        <div class="footer-item">
            <a href="{{ route('branchowners') }}"><i class="fas fa-link"></i></a>
            <a href="{{ route('branchowners') }}">Owners</a>
        </div>








    </div>






    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            // Get the current URL
            var currentUrl = window.location.href;

            // Get all footer items
            var footerItems = document.querySelectorAll('.footer-item');

            // Loop through each footer item
            footerItems.forEach(function(item) {
                // Get the URL associated with this footer item
                var itemUrl = item.querySelector('a').getAttribute('href');

                // Check if the current URL matches this item's URL
                if (currentUrl === itemUrl) {
                    // If so, add the 'selected' class to highlight it
                    item.classList.add('selected');
                }
            });
        });
    </script>



</body>
</html>
