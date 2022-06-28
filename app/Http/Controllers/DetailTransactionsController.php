<?php

namespace App\Http\Controllers;

use App\Detailtransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailtransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailtransactions = Detailtransactions::latest()->get();
        return response([
            'success' => true,
            'message' => "Semua data detailtransactions",
            'data' => $detailtransactions
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required',
            'id_sparepart' => 'required',
            'jumlah' => 'required',
        ],
            [
                'id_transaksi.required' => 'Masukan nama sparepart',
                'id_sparepart.required' => 'Masukan nama minimal jumlah',
                'jumlah.required' => 'Masukan nama jumlah',
            ]
    );

    if($validator->fails()){
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan',
            'data' => $validator->errors()
        ], 400);
    } else {
        $detailtransactions = Detailtransactions::create([
            'id_transaksi' => $request->input('id_transaksi'),
            'id_sparepart' => $request->input('id_sparepart'),
            'jumlah' => $request->input('jumlah'),
        ]);

        if ($detailtransactions) {
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
        $detailtransactions = Detailtransactions::whereId($id)->first();

        if($detailtransactions) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil ditampilkan',
                'data' => $detailtransactions
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
            'id_transaksi' => 'required',
            'id_sparepart' => 'required',
            'jumlah' => 'required',
        ],
        [
            'id_transaksi' => 'Masukan nama sparepart',
            'id_sparepart' => 'Masukan id_sparepart',
            'jumlah' => 'Masukan jumlah',
        ]
    );

    if($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'silahkan isi terlebih dahulu',
            'data' => $validator->errors()
        ], 400);
    } else {
        $detailtransactions = Detailtransactions::whereId($request->input('id'))->update([
            'id_transaksi' => $request->input('id_transaksi'),
            'id_sparepart' => $request->input('id_sparepart'),
            'jumlah' => $request->input('jumlah'),
        ]);

        if($detailtransactions) {
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
        $detailtransactions = Detailtransactions::findOrFail($id);
        $detailtransactions->delete();

        if($detailtransactions) {
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
