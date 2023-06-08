<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Buku::orderBy('judul', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $databuku = new Buku;

        $rule = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggalpublis' => 'required|date',
        ];
        $validasi = Validator::make($request->all(), $rule);
        if($validasi->fails()){
            return response()->json([
                'status' => false,
                'message' => 'gagal memasukan data',
                'data' => $validasi->errors()
            ]);
        }

        $databuku->judul = $request->judul;
        $databuku->pengarang = $request->pengarang;
        $databuku->tanggalpublis = $request->tanggalpublis;

        $post = $databuku->save();

        return response()->json([
            'status' => true,
            'message' => 'data berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Buku::find($id);
        if($data){
        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $data
        ], 200);
    } else {
        return response()->json([
        'status' => false,
        'message' => 'data tidak ditemukan',
        ]);
    }
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $databuku = Buku::find($id);
        if(empty($databuku)){
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan',
            ], 404);
        }

        $rule = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggalpublis' => 'required|date',
        ];
        $validasi = Validator::make($request->all(), $rule);
        if($validasi->fails()){
            return response()->json([
                'status' => false,
                'message' => 'gagal mengupdate data',
                'data' => $validasi->errors()
            ]);
        }

        $databuku->judul = $request->judul;
        $databuku->pengarang = $request->pengarang;
        $databuku->tanggalpublis = $request->tanggalpublis;

        $post = $databuku->save();

        return response()->json([
            'status' => true,
            'message' => 'data berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $databuku = Buku::find($id);
        if(empty($databuku)){
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan',
            ], 404);
        }

        $post = $databuku->delete();

        return response()->json([
            'status' => true,
            'message' => 'data berhasil dihapus'
        ]);
    }
}
