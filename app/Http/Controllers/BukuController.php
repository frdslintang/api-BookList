<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BukuController extends Controller
{
   
    public function index()
    {
        $client = new Client();
        $url = "http://laravelapi.test/api/buku";
        $response = $client-> request('GET', $url);
        
        $content= $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('buku.index', ['data'=>$data]);
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
        //INI PARAMETER
        $judul = $request->judul;
        $pengarang = $request->pengarang;
        $tanggal_publikasi = $request->tanggal_publikasi;

        
        //PARAMETER DILEWATKAN ATAU DITAMPUNG VARIABEL BARU 
        $parameter = [
            'judul'=>$judul,
            'pengarang'=>$pengarang,
            'tanggal_publikasi'=>$tanggal_publikasi,
        ];

        //INI ADALAH PROSES REQUEST API
        $client = new Client();
        $url = "http://laravelapi.test/api/buku";
        $response = $client-> request('POST', $url, [
            'headers' => ['Content-type'=>'application/json'],
            'body'=>json_encode($parameter)
        ]);
        
        $content= $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
      
        if($contentArray['status'] != true){
            $error = $contentArray['data'];
            return redirect()->to('buku')->withErrors($error)->withInput();
        } else {
            return redirect()->to('buku')->with('success', 'Berhasil Memasukkan Data');

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
