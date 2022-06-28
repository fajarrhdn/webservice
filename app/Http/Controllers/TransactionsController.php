<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transactions::latest()->get();
        return response([
            'success' => true,
            'message' => "Semua data transactions",
            'data' => $transactions
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_transaksi' => 'required',
            'nama_pemohon' => 'required',
            'id_user' => 'required',
        ],
            [
                'no_transaksi.required' => 'Masukan nama sparepart',
                'nama_pemohon.required' => 'Masukan nama minimal id_user',
                'id_user.required' => 'Masukan nama id_user',
            ]
    );

    if($validator->fails()){
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan',
            'data' => $validator->errors()
        ], 400);
    } else {
        $transactions = Transactions::create([
            'no_transaksi' => $request->input('no_transaksi'),
            'nama_pemohon' => $request->input('nama_pemohon'),
            'id_user' => $request->input('id_user'),
        ]);

        if ($transactions) {
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
        $transactions = Transactions::whereId($id)->first();

        if($transactions) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil ditampilkan',
                'data' => $transactions
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
            'no_transaksi' => 'required',
            'nama_pemohon' => 'required',
            'id_user' => 'required',
        ],
        [
            'no_transaksi' => 'Masukan nama sparepart',
            'nama_pemohon' => 'Masukan nama_pemohon',
            'id_user' => 'Masukan id_user',
        ]
    );

    if($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'silahkan isi terlebih dahulu',
            'data' => $validator->errors()
        ], 400);
    } else {
        $transactions = Transactions::whereId($request->input('id'))->update([
            'no_transaksi' => $request->input('no_transaksi'),
            'nama_pemohon' => $request->input('nama_pemohon'),
            'id_user' => $request->input('id_user'),
        ]);

        if($transactions) {
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
        $transactions = Transactions::findOrFail($id);
        $transactions->delete();

        if($transactions) {
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
