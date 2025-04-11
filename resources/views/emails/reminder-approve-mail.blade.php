<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<body>

    <p style="font-weight: bold">Email ini merupakan email otomatis yang berasal dari Aplikasi KPI</p>
    <div class="">
        <p>{{ $details['greetings'] }}{{ $details['name'] }} "{{ $details['email'] }}"</p>
    </br>
        <p>{{ $details['msg'] }}</p>
        <p>{{ $details['msg2'] }}</p>
    </div>
    <div class="">
        <p>{{ $details['closing'] }}</p>
    </div>
    <div class="">
        <p>Salam, </p>
    </br>
        <p>[HR/Admin KPI]</p>
    </div>

</body>
</html>