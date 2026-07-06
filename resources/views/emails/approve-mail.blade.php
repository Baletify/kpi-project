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
</br>
    <p>{{ $details['msg'] }}</p>
    <table>
        <tr>
            <td>Silakan mengakses Aplikasi KPI melalui link berikut</td>
            <td>:</td>
            <td>
                <a href="http://192.168.99.202/bskp-gate/public/">
                    http://192.168.99.202/bskp-gate/public/
                </a>
            </td>
        </tr>
        <tr>
            <td>Approved by</td>
            <td>:</td>
            <td>{{ $details['approved_by'] }}</td>
        </tr>
    </table>
</body>
</html>