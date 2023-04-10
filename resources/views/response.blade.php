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
    <form action="{{route('response.update', $darahId)}}" method="POST" style="width: 500px; margin: 50px auto; display:block;">
        @csrf
        @method('PATCH')
        <div class="input-card">
            <label for="status">Status :</label>
            {{--cek apakah data $report yg dr compact itu ada adaan, maksudnya adaan tuh where di db responses nya ada data yang punya 
                report_id sama kata yang dikirim ke path (report_id)--}}
            @if ($darah)
            <select name="status" id="status">
                {{-- kalau ada--}}
                <option value="ditolak" {{ $darah['status'] == 'ditolak' ? 'selected' : '' }}>ditolak</option>
                <option value="proses" {{ $darah['status'] == 'proses' ? 'selected' : '' }}>proses</option>
                <option value="diterima" {{ $darah['status'] == 'diterima' ? 'selected' : '' }}>diterima</option>
            </select>
            @else
            <select name="status" id="status">
                <option selected hidden disabled>Pilih Status</option>
                <option value="ditolak">ditolak</option>
                <option value="proses">proses</option>
                <option value="diterima">diterima</option>
            </select>
            @endif
        </div>
        <div class="input-card">
            <label for="pesan">Pesan :</label>
            <textarea name="pesan" id="pesan"  rows="3">{{ $darah ? $darah['pesan'] : '' }}</textarea>
        </div>
        <button type="submit" style="color:  #fff">Kirim Response</button>
    </form>
</body>
</html>