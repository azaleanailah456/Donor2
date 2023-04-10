<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($darah_id)
    {
        $darah = Response::where('darah_id', $darah_id)->first();

        $darahId = $darah_id;
        return view('response', compact('darah', 'darahId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $darah_id)
    {
        $request->validate([
            'status' => 'required',
            'pesan' => 'required',
        ]);

        //updateOrCreate() fungsingnya untuk melakukan update data kaloo emang di db responenya uda ad data yang punya report_id sama dengan $report_id path dinamis, kalau gada data itu maka di create
        //array pertama, acuan cari datanya
        //array ke dua, data yang dikirim
        //kenapa pake updateOrCreate ? karena response ini kan kalo tadinya gada mau ditambahin tp kalo ad mau diupdate aja

        Response::updateOrCreate(
            [
                'darah_id' => $darah_id,
            ],
            [
                'status' => $request->status,
                'pesan' => $request->pesan,
            ]
            );

            //setelah berhasil arahkan ke route yang name nya data.petugas dengan pesan alert
            return redirect()->route('data.petugas')->with('responseSuccess', 'Berhasil mengubah response');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        //
    }
}
