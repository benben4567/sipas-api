<?php

namespace App\Http\Controllers;

use App\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JenisController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function read($id = null)
    {
        if ($id != null) {
            
            $data = DB::table('jenis')->find($id);
            if ($data === null) {
                return response()->json([
                    'error' => true,
                    'message' => 'Data tidak tidak ditemukan',
                    'data' => ''
                ], 404);
            } else {
                return response()->json([
                    'error' => false,
                    'message' => "Data ditemukan",
                    'data' => $data
                ], 200);
            }            
        } else {
            $data = DB::table('jenis')->get();
            return response()->json([
                'error' => false,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        }
        
    }

    public function create(Request $request)
    {
        $jenis = $request->input('jenis');
        
        if (empty($jenis)) {
            return response()->json([
                'error' => true,
                'message' => 'Parameter required',
                'data' => ''
            ], 404);
        } else {

            $data = DB::table('jenis')
                            ->insertGetId(['jenis' => $jenis,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
            ]);

            if ($data > 0) {
                $jenis = DB::table('jenis')->find($data);
                return response()->json([
                    'error' => false,
                    'message' => 'Data berhasil ditambahkan',
                    'data' => $jenis
                ], 200);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Data gagal ditambahkan',
                    'data' => ''
                ], 404);
            }
            
        }
        
    }

    public function update($id, Request $request)
    {
        $jenis = $request->input('jenis');
        $data = DB::table('jenis')->find($id);
        if (!empty($data)) {
            //ada data
            $data = DB::table('jenis')->where('id', '=', $id)->update(['jenis' => $jenis, 'updated_at' => Carbon::now()]);
            $jenis = DB::table('jenis')->find($id);
            return response()->json([
                'error' => false,
                'message' => 'Data berhasil diupdate',
                'data' => $jenis
            ], 201);
        } else {
            //data tidak ada
            return response()->json([
                'error' => true,
                'message' => 'Data tidak ditemukan',
                'data' => ''
            ], 404);
        }
        
    }
    
    public function delete($id)
    {
        $jenis = DB::table('jenis')->where('jenis.id', '=', $id)->delete();
        $data = DB::table('jenis')->find($id);
        if (empty($data)) {
            return response()->json([
                'error' => false,
                'message' => 'Data berhasil dihapus',
                'data' => ''
            ], 200);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Data gagal dihapus',
                'data' => ''
            ], 200);
        }
        
    }
}
