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
        <p>{{ $details['greetings'] }}</p>
    </br>
        <p>{{ $details['msg'] }}</p>
    </div>
    <table>
        <tr>
            <td>Kode KPI</td>
            <td>:</td>
            <td>{{ $details['kpi_code'] }}</td>
        </tr>
        <tr>
            <td>Item KPI</td>
            <td>:</td>
            <td>{{ $details['kpi_item'] }}</td>
        </tr>
        <tr>
            <td>Komentar</td>
            <td>:</td>
            <td>{{ $details['comment'] }}</td>
        </tr>
        <tr>
            <td>Revised by</td>
            <td>:</td>
            <td>{{ $details['revised_by'] }}</td>
        </tr>
    </table>
</body>
</html>