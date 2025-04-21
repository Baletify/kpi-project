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
            padding-left: 4px;
            padding-top: 1px;
            padding-bottom: 1px;
            padding-right: 2px;
        }
        .text-center {
            text-align: center;
            align-items: center;

        }
        .border-none {
            border: none !important;
        }
        .border-bottom-solid {
            border-bottom: 1px solid black !important;
            border-left: none !important;
            border-right: none !important;
            border-top: none !important;
        }
        .border-top-solid {
            border-top: 1px solid black !important;
            border-left: none !important;
            border-right: none !important;
            border-bottom: none !important;
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
            <td class="text-center" colspan="3">
               <span class=""><b>{{ $title }}</b></span>
               <br>
               <span class=""><b>{{ $sub_1 }}</b></span>
               <br>
               <span class=""><b>{{ $sub_2 }}</b></span>
            </td>
        </tr>
        <tr>
            <td class="border-none" style="width: 23%">
               <span class="padding">No. TTE</span>
            </td>
            <td class="border-none" style="width: 2%">
                <span class="padding">:</span>
            </td>   
            <td class="border-none" style="width: 75%">
                <span class="padding">{{ $no_tte }}</span>       
            </td>
        </tr>
        <tr>
            <td class="border-none">
               <span class="padding">Tanggal Pelaporan</span>
            </td>
            <td class="border-none">
                <span class="padding">:</span>
            </td>   
            <td class="border-none">
                <span class="padding">{{ $last_input }}</span>       
            </td>
        </tr>
        <tr>
            <td class="border-bottom-solid">
               <span class="padding">Tanggal Cetak TTE</span>
            </td>
            <td class="border-bottom-solid">
                <span class="padding">:</span>
            </td>   
            <td class="border-bottom-solid">
                <span class="padding">{{ $created_at }}</span>       
            </td>
        </tr>
        <tr>
            <td class="border-none">
               <span class="padding">Dept</span>
            </td>
            <td class="border-none">
                <span class="padding">:</span>
            </td>   
            <td class="border-none">
                <span class="padding">{{ $department }}</span>       
            </td>
        </tr>
        <tr>
            <td class="border-none">
               <span class="padding">NIK</span>
            </td>
            <td class="border-none">
                <span class="padding">:</span>
            </td>   
            <td class="border-none">
                <span class="padding">{{ $nik }}</span>       
            </td>
        </tr>
        <tr>
            <td class="border-bottom-solid">
               <span class="padding">Nama</span>
            </td>
            <td class="border-bottom-solid">
                <span class="padding">:</span>
            </td>   
            <td class="border-bottom-solid">
                <span class="padding">{{ $name }}</span>
            </td>
        </tr>
        <tr>
            <td class="border-none">
               <span class="padding">Total Target</span>
            </td>
            <td class="border-none">
                <span class="padding">:</span>
            </td>   
            <td class="border-none">
                <span class="padding">{{ $totalThisMonthTarget }}</span>
            </td>
        </tr>
        <tr>
            <td class="border-none">
               <span class="padding">Data Terinput</span>
            </td>
            <td class="border-none">
                <span class="padding">:</span>
            </td>   
            <td class="border-none">
                <span class="padding">{{ $inputed }}</span>
            </td>
        </tr>
        <tr>
            <td class="border-bottom-solid">
               <span class="padding">Persentase</span>
            </td>
            <td class="border-bottom-solid">
                <span class="padding">:</span>
            </td>   
            <td class="border-bottom-solid">
                <span class="padding">{{ $ttePercentage }}%</span>
            </td>
        </tr>
        <tr>
            <td class="text-center" colspan="3">
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