<!DOCTYPE html>
<html lang="en">
<head>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table class="table-auto w-96">
        <tr>
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0">
               <span class="font-bold">{{ $title }}</span>
               <br>
               <span class="font-bold">{{ $sub_1 }}</span>
               <br>
               <span class="font-bold">{{ $sub_2 }}</span>
            </td>
        </tr>
        <tr>
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0">
               <span class="font-medium">No. TTE:        {{ $no_tte }}</span>
               <br>
               <span class="font-medium">Tgl Pelaporan:  {{ $last_input }}</span>
               <br>
               <span class="font-medium">Tgl Cetak:      {{ $created_at }}</span>
            </td>
        </tr>
        <tr>
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0">
               <span class="font-medium">Dept:  {{ $department }}</span>
               <br>
               <span class="font-medium">NIK:   {{ $nik }}</span>
               <br>
               <span class="font-medium">Nama:  {{ $name }}</span>
            </td>
        </tr>
        <tr>
            <td class="border-2 border-gray-400 tracking-wide px-2 py-0">
               <span class="font-medium">{{ $desc_1 }}</span>
               <br>
               <span class="font-medium">{{ $desc_2 }}</span>
               <br>
               <span class="font-medium">Tertanda</span>
               <br>
               <span class="font-medium">{{ $signature }}</span>
            </td>
        </tr>
    </table>
</body>
</html>