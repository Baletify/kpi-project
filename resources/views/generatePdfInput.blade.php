<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
        }
        .text-center {
            text-align: center;
            align-items: center;

        }
    </style>
</head>
<body>
    <table class="table-auto w-96">
        <tr>
            <td class="text-center">
               <span class=""><b>{{ $title }}</b></span>
               <br>
               <span class=""><b>{{ $sub_1 }}</b></span>
               <br>
               <span class=""><b>{{ $sub_2 }}</b></span>
            </td>
        </tr>
        <tr>
            <td class="">
               <span class="font-medium">No. TTE:        {{ $no_tte }}</span>
               <br>
               <span class="font-medium">Tgl Pelaporan:  {{ $last_input }}</span>
               <br>
               <span class="font-medium">Tgl Cetak:      {{ $created_at }}</span>
            </td>
        </tr>
        <tr>
            <td class="">
               <span class="font-medium">Dept:  {{ $department }}</span>
               <br>
               <span class="font-medium">NIK:   {{ $nik }}</span>
               <br>
               <span class="font-medium">Nama:  {{ $name }}</span>
            </td>
        </tr>
        <tr>
            <td class="">
               <span class="font-medium">{{ $desc_1 }}</span>
               <br>
               <span class="font-medium">{{ $desc_2 }}</span>
               <br>
               <br>
               <br>
               <span class="font-medium">Tertanda</span>
               <br>
               <br>
               <span class="font-medium">{{ $signature }}</span>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <span style="color: red">*</span>
    <span style="font-style: italic">Note: TTE Ini digunakan sebagai bukti penyelesaian pengisian KPI</span>
</body>
</html>