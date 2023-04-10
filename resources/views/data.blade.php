<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Donor Darah</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<body>
    <h2 class="title-table" style="color: #9e2531">Laporan Donor</h2>
    <div style="display: flex; justify-content: center; margin-bottom: 30px">
        <a href="{{route('logout')}}" style="text-align: center">Logout</a>
        <div style="margin: 0 10px"> | </div>
        <a href="/" style="text-align: center">Home</a>
        <div style="margin: 0 10px"> | </div>
        <a href="{{route('export.excel')}}" class="btn-login" style="text-align: center">Cetak Excel</a>
        <div style="margin: 0 10px"> | </div>
        <a href="{{route('export.pdf')}}" class="btn-login" style="text-align: center">Cetak PDF</a>
        <div style="margin: 0 10px"> | </div>
        <a href="{{route('data')}}" class="btn-login" style="text-align: center">Refresh</a>

    </div>
    <div style="display: flex; justify-content: flex-end; align-items: center;">
        <form action="" method="GET">
            @csrf
            <input type="text" name="search" style="margin-top: -1px; margin-right: 15px;" placeholder="Cari berdasarkan nama...">
            <button type="submit" class="btn-login" style="margin-top: -1px; margin-right: 30px; color: #fff">Cari</button>
        </form>
    </div>
    <div style="padding: 0 30px">
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Name</th>
                    <th>Umur</th>
                    <th>Berat Badan</th>
                    <th>Telp</th>
                    <th>Date</th>
                    <th>Gambar</th>
                    <th>Status Response</th>
                    <th>Pesan Response</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($darahs as $darah)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$darah ['name']}}</td>
                    <td>{{$darah ['umur']}}</td>
                    <td>{{$darah ['bb']}}</td>
                    @php
                        $telp = substr_replace($darah->no_telp, "62", 0, 1)
                    @endphp

                    @php
                    if ($darah->response) {
                        $pesanWA = 'Hallo' . $darah->nama . '! pengaduan anda di' . $darah->response['status'] . '.Berikut ini pesan untuk anda : ' . $darah->response['pesan'];
                    }else {
                        $pesanWA = 'Belum ada data response!';
                    }
                    @endphp

                    <td><a href="https://wa.me/{{$telp}}?text={{$pesanWA}}" target="_blank">{{$telp}}</a></td>
                    <td>{{\Carbon\Carbon::parse($darah['created_at'])->format('j, F, Y')}}</td>
                    <td>
                        {{--menampilkan gambar full layar di tab baru--}}
                        <a href="../assets/image/{{$darah->foto}}" target="_blank">
                            <img src="{{asset('assets/image/'.$darah->foto)}}" width="120">
                        </a>
                    </td>
                    
                    <td>
                        @if ($darah->response)
                            {{ $darah->response['status']}}
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        @if ($darah->response)
                            {{$darah->response['pesan']}}
                        @else
                        -
                        @endif
                    </td>
                    <td>

                        <form action="{{route('created.pdf', $darah->id) }}" method="GET" style="margin-top: 5px;"> 
                                <button type="submit" style="color: #fff">Print</button>
                        </form>   

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>