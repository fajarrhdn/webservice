<?php

namespace App\Http\Controllers;

use App\Spareparts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SparepartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spareparts = Spareparts::latest()->get();
        return response([
            'success' => true,
            'message' => "Semua data spareparts",
            'data' => $spareparts
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sparepart' => 'required',
            'minimal_stok' => 'required',
            'stok' => 'required',
        ],
            [
                'nama_sparepart.required' => 'Masukan nama sparepart',
                'minimal_stok.required' => 'Masukan nama minimal stok',
                'stok.required' => 'Masukan nama stok',
            ]
    );

    if($validator->fails()){
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan',
            'data' => $validator->errors()
        ], 400);
    } else {
        $spareparts = Spareparts::create([
            'nama_sparepart' => $request->input('nama_sparepart'),
            'minimal_stok' => $request->input('minimal_stok'),
            'stok' => $request->input('stok'),
        ]);

        if ($spareparts) {
            return response()->json([
                'success' => true,
                'message' => 'berhasil disimpan',
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Gagal disimpan',
            ], 400);
        }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $spareparts = Spareparts::whereId($id)->first();

        if($spareparts) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil ditampilkan',
                'data' => $spareparts
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal ditampilkan',
                'data' => ''
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validator = Validator::make($request->all(), [
            'nama_sparepart' => 'required',
            'minimal_stok' => 'required',
            'stok' => 'required',
        ],
        [
            'nama_sparepart' => 'Masukan nama sparepart',
            'minimal_stok' => 'Masukan minimal_stok',
            'stok' => 'Masukan stok',
        ]
    );

    if($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'silahkan isi terlebih dahulu',
            'data' => $validator->errors()
        ], 400);
    } else {
        $spareparts = Spareparts::whereId($request->input('id'))->update([
            'nama_sparepart' => $request->input('nama_sparepart'),
            'minimal_stok' => $request->input('minimal_stok'),
            'stok' => $request->input('stok'),
        ]);

        if($spareparts) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil diubah',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal diubah',
            ], 400);
        }
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spareparts = Spareparts::findOrFail($id);
        $spareparts->delete();

        if($spareparts) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Gagal dihapus',
            ], 400);
        }
    }
}
