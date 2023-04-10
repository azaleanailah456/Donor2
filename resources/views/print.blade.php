<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Pengaduan</title>
</head>
<body>
    <table>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Umur</th>
            <th>Berat Badan</th>
            <th>Telp</th>
            <th>Gambar</th>
            <th>Date</th>
            <th>Status Response</th>
            <th>Pesan Response</th>
        </tr>
        @php $no =1; @endphp
        @foreach ($darahs as $darah)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$darah['name']}}</td>
            <td>{{$darah['umur']}}</td>
            <td>{{$darah['bb']}}</td>
            <td>{{$darah['no_telp']}}</td>
            <td><img src="assets/image/{{$darah['foto']}}" width="80"></td>
            <td>{{\Carbon\Carbon::parse($darah['created_at'])->format('j, F, Y')}}</td>
            <td>
                @if ($darah['response'])
                    {{ $darah['response']['status']}}
                @else
                -
                @endif
            </td>
            <td>
                @if ($darah['response'])
                    {{$darah['response']['pesan']}}
                @else
                -
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    
</body>
</html>