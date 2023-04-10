<?php

namespace App\Http\Controllers;

use App\Models\darah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use App\Exports\DarahExport;
use App\Models\Response;


class DarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function exportPDF()
    {
        //ambil data yang akan di tampilkan pada pdf, bisa juga dengan where atau eloquent lainnya dan jangan gunakan pagination
        //jangan lupa kovert data jadi array dengan toArray()
        $data = Darah::with('response')->get()->toArray();
        //kiirm data yang di ambil kepada view yang akan di tampilkan,kirim dengan inisial
        view()->share('darahs',$data);
        //panggil view blade yang akan di cetak pdf serta data yang akan digunakan 
        $pdf = PDF::loadView('print',$data)->setPaper('a4', 'landscape');
        //download PDF file dengan nama tertentu
        return $pdf->download('data_pengaduan_keseluruhan.pdf');
    }

    public function createdPDF($id)
    {
       //ambil data yang akan di tampilkan pada pdf, bisa juga dengan where atau eloquent lainnya dan jangan gunakan pagination
       //jangan lupa kovert data jadi array dengan toArray()
       $data = Darah::with('response')->where('id', $id)->get()->toArray();
       view()->share('darahs',$data);
        
       $pdf = PDF::loadView('print',$data);
       
       return $pdf->download('data_pengaduan.pdf');
    } 

    public function exportExcel()
    {
       //nama file yang akan terdownload
       //selain .xlsx juga bisa .csv
       $file_name = 'data_keseluruhan_pengaduan.xlsx';
       //memanggil file ReportExport dan mendownloadnya dengan nama seperti $file_name
       return Excel::download(new DarahExport, $file_name);
    }
     
    public function index()
    {
        $darahs = Darah::orderBy('created_at', 'DESC')->simplePaginate(2);  
        return view('index', compact('darahs'));
    }

    public function data(Request $request)
    {
        $search = $request->search;

        $darahs = Darah::with('response')->where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get(); 
        return view('data', compact('darahs'));
    }

    public function dataPetugas(Request $request)
    {
        $search =$request->search;

        //with : ambil relasi (nama fungsi hasOne/hasMany/ belongsTo di modelnya), ambil data dari relasi itu
        $darahs = Darah::with('response')->where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get(); 
        return view('data_petugas', compact('darahs'));
    }

    public function auth(Request $request)
    {
        //validasi
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // ambil data dan simpan di variable
        $user = $request->only('email', 'password');

        if (Auth::attempt($user)) {
            
            if (Auth::user()->role == 'admin') {
            return redirect()->route('data');
        }elseif (Auth::user()->role == 'petugas') {
            return redirect()->route('data.petugas');
        }
        }else {
            return redirect()->back()->with('gagal', 'Gagal login, coba ulang lagi !');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'umur' => 'required',
            'bb' => 'required',
            'no_telp' => 'required|max:13',
            'donor' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png,svg',
        ]);
        
        // pindah foto ke folder public
        $path = public_path('assets/image/');
        $image = $request->file('foto');
        $imgName = rand() . '.' .$image->extension(); // foto.jpg : 1234.jpg
        $image->move($path, $imgName);

        // tambah data ke db
        Darah::create([
            'name' => $request->name,
            'email' => $request->email,
            'umur' => $request->umur,
            'bb' => $request->bb,
            'no_telp' => $request->no_telp,
            'donor' => $request->donor,
            'foto' => $imgName,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data !');
    }

    /**
     * Display the specified resource.
     */
    public function show(darah $darah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(darah $darah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, darah $darah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Darah::where('id', $id)->firstOrFail();
        //$data isinya -> nik sampe foto dr pengaduan 
        //hapus foto data dr folder public : path . nama fotonya
        //nama foto nya diambil dari $data yang diatas trs ngambil dari column 'foto'
        $image = public_path('assets/img/'.$data['foto']);
        unlink($image);

        $data->delete();
        Response::where('darah_id', $id)->delete();
        return redirect()->back();
    }
}
