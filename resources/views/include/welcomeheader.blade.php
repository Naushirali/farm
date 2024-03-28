<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Your Website Title</title>
    <style>
   body {
    margin: 0;
    padding: 0;
}

header {
    background-color: #316FF6;
    padding: 8px;
    text-align: center;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
    overflow: hidden;
    padding-top: 8px;
}


/*
header::after {
    content: '';
    display: block;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 58px;
    background: url('{{ asset('finalimage3.png') }}') repeat-x;
    z-index: 1;
}
*/





header img {
            width: 101.71px; /* Set the width to 99px */
            height: 36.57px; /* Set the height to 23.9px */
            float: right;
        }



body {
    margin-top: 50px; /* Adjust the margin-top to match the height of your fixed header and the spilled milk effect */
}




    </style>
</head>
<body>

    <header>



        <!--here in the above code show only else case by making $data to the breeding controller taken from
             cattles instaed of cattle breeding-->




        <img src="{{ asset('ellogo.jpg') }}" alt="Logo">
    </header>

    <!-- The rest of your website content goes here -->

</body>
</html>
