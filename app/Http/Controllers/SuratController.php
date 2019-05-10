<?php

namespace App\Http\Controllers;

use App\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
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

            // $data = Surat::with('id', $id)->first();
            $data = DB::table('surat')
                        ->join('jenis', 'surat.jenis_id', '=', 'jenis.id')
                        ->select('surat.id', 'surat.no_surat', 'surat.tanggal', 'jenis.jenis', 'surat.perihal')
                        ->where('surat.id', '=', $id)
                        ->get();
            if (empty($data)) {
                return response()->json([
                    'error' => true,
                    'message' => "Data tidak ada!",
                    'data' => ""
                ], 404);
            } else {
                return response()->json([
                    'error' => false,
                    'message' => "Berhasil",
                    'data' => $data
                ], 200);
            }
            
        } else {
            // $data = Surat::all();
            $data = DB::table('surat')
                        ->join('jenis', 'surat.jenis_id', '=', 'jenis.id')
                        ->select('surat.id', 'surat.no_surat', 'surat.tanggal', 'jenis.jenis', 'surat.perihal')
                        ->orderBy('surat.id', 'asc')
                        ->get();
            return response()->json([
                'error' => false,
                'message' => 'Berhasil',
                'data' => $data
            ], 200);
        }
    }

    public function create(Request $request)
    {
        $input['no_surat'] = $request->input('no_surat');
        $input['tanggal'] = $request->input('tanggal');
        $input['jenis_id'] = $request->input('jenis_id');
        $input['perihal'] = $request->input('perihal');

        $create = Surat::create($input);

        if ($create) {
            return response()->json([
                'error' => false,
                'message' => "Berhasil",
                'data' => $input
            ], 201);
        } else {
            return response()->json([
                'error' => true,
                'message' => "Gagal",
                'data' => ""
            ], 400);
        }

    }

    public function update($id = null, Request $request)
    {
        $no_surat = $request->input('no_surat');
        $tanggal = $request->input('tanggal');
        $jenis_id = $request->input('jenis_id');
        $perihal = $request->input('perihal');

        if (empty($no_surat) || empty($tanggal) || empty($jenis_id) || empty($perihal)) {
            return $no_surat . '-' . $tanggal . '-' . $jenis_id . '-' . $perihal;
            return response()->json([
                'error' => true,
                'message' => "Parameter required",
                'data' => ""
            ], 400);
        } else {
            if ($id == null) {
                return response()->json([
                    'error' => true,
                    'message' => "Parameter id required",
                    'data' => ""
                ], 404);
            } else {
                $surat = Surat::where('surat.id', '=',$id)->update([
                    'no_surat' => $no_surat,
                    'tanggal' => $tanggal,
                    'jenis_id' => $jenis_id,
                    'perihal' => $perihal
                ]);
                

                if ($surat > 0) {
                    $surat = Surat::find($id);
                    return response()->json([
                        'error' => false,
                        'message' => "Berhasil",
                        'data' => $surat
                    ], 201);
                } else {
                    return response()->json([
                        'error' => true,
                        'message' => "Gagal",
                        'data' => ""
                    ], 400);
                }
            }
        }
        
        
    }

    public function delete($id = null)
    {
        if ($id === null) {
            return response()->json([
                'error' => true,
                'message' => "Parameter id required",
                'data' => ""
            ], 404);
        } else {
            $surat = Surat::where('surat.id','=', $id)->delete();
            if ($surat > 0) {
                return response()->json([
                    'error' => false,
                    'message' => "Berhasil dihapus",
                    'data' => ''
                ], 201);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => "Gagal dihapus",
                    'data' => ""
                ], 400);
            }
            
        }
        
    }

    //
}
