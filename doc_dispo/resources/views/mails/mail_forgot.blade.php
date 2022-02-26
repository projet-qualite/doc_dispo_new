<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background-color: #f6f8fa;  font-family: 'Roboto', sans-serif;display: flex; flex-direction: row;
    align-items: center;">

<div style="background-color: rgb(255,255,255);
            width:50%;
            height: 300px;
            margin: 10px auto;
            border-radius: 10px;">
    <div style="display: flex;
    background-color: rgb(43,150,154);
    padding: 15px;
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
    justify-content: space-between;
    align-items: center;">
        <div style="display: flex;align-items: center;">
            <p style="color: white;
            margin-right: 15px;">
                {{$informations[0]}}
            </p>
            <ion-icon style="font-size: 30px;color: white;" name="chevron-down-circle-outline"></ion-icon>
        </div>
    </div>
    <div style="padding: 20px;
            height: 50%;">
        <p style="margin-bottom: 30px; text-align: center">
            <ion-icon style="color: black; font-size: 16px" name="calendar-clear-outline"></ion-icon>
            Bonjour, <br>
            <p>{{$informations[1]}} </p><br>
            <a href="{{$informations[2]}}">{{$informations[2]}}</a><br>
        </p>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>


