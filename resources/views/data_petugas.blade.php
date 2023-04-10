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
    <h2 class="title-table">Laporan Donor</h2>
    <div style="display: flex; justify-content: center; margin-bottom: 30px">
        <a href="{{route('logout')}}" style="text-align: center">Logout</a>
        <div style="margin: 0 10px"> | </div>
        <a href="/" style="text-align: center">Home</a>
        <div style="margin: 0 10px"> | </div>
        <a href="{{route('data.petugas')}}" class="btn-login" style="margin-left: 10px; margin-top: -2px">Refresh</a>
    </div>

    <div style="display: flex; justify-content: flex-end; align-items: center;">
        <form action="" method="GET">
            @csrf
            {{--menggunakan method GET karna route unutk masuk ke halaman data ini menggunakan ::get--}}
            <input type="text" name="search" placeholder="Cari berdasarkan nama...">
            <button type="submit" class="btn-login" style="margin-top: -1px; margin-right: 30px; color: #fff">Cari</button>
        </form>
        {{-- refresh balik lagi ke route data karna nanti pas di kluk refresh mau bersihin riwayat pencarian 
             sebelumnya dan balikin lagi nya ke halaman data lagi--}}
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
                    {{--menambahkan angka 1 dari $no di php tiap baris nya--}}
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
                    <td>
                        <img src="{{asset('assets/image/'.$darah->foto)}}" width="120">
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
                    <td style="display: flex; justify-content: center;">
                        <a href="{{route('response.edit', $darah->id)}}" class="back-btn" style="color: white">Send Response</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>