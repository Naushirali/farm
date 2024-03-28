
@extends('layout.welcomelayout')
@section('title', 'EasyLab')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyLab</title>

    <style>

.btn-primary
        {
            background-color: #316FF6;
            color: #ffffff;
            padding: 5px;
            margin-left: 10px;
            margin-top: 10px;
            border-radius: 20px;
            padding-left: 15px;
            padding-right: 15px;
        }

    </style>

</head>
<body>
    <a href="{{ route('logout') }}"  class="btn btn-primary">logout</a>



</body>
</html>

@endsection
