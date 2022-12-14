<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function index()
    {
        $p = \Carbon\Carbon::now()->format('Y-m-d');
        // $antrian = Antrian::where('tanggal', \Carbon\Carbon::now()->format('Y-m-d'))->orderBy('no', 'desc')->first();
        // $kondisi = Antrian::where('tanggal', \Carbon\Carbon::now()->format('Y-m-d'))->orderBy('no', 'asc')->first();
        // $antrian = Antrian::where('tanggal', \Carbon\Carbon::now()->format('Y-m-d'))->orderBy('no', 'desc')->first();

        $count = Antrian::where('tanggal', \Carbon\Carbon::now()->format('Y-m-d'))->orderBy('no', 'asc')->first();
        $get = Antrian::where('tanggal', \Carbon\Carbon::now()->format('Y-m-d'))->orderBy('no', 'asc')->get();
        // $count = Antrian::where('id', 100)->orderBy('no', 'asc')->first();
        return view('antrian', compact('count', 'get'));
    }


    public function postantri_cs(Request $request)
    {

        $hariini = \Carbon\Carbon::now()->format('Y-m-d');
        $antrian = Antrian::where('tanggal', \Carbon\Carbon::now()->format('Y-m-d'))->first();

        $create = [
            'tanggal' => $hariini,
            'no' => $request->no
        ];

        $antrian = Antrian::create($create);

        // $antri_cs = $antrian->no;
        // $tes = Antrian::FindOrFail($antri_cs);
        // return back();

        return back();
    }

    public function ambil()
    {
        $antrian = Antrian::where('tanggal', \Carbon\Carbon::now()->format('Y-m-d'))->orderBy('no', 'desc')->first();
        // $count = Antrian::where('tanggal', \Carbon\Carbon::now()->format('Y-m-d'))->orderBy('no', 'desc')->count();
        return view('ambil_antrian', compact('antrian'));
    }
    public function delete($id)
    {
        $antrian = Antrian::where('tanggal', \Carbon\Carbon::now()->format('Y-m-d'))->first();

        if ($antrian->count() > 1) {
            $antrian = Antrian::find($id)->delete();
            return back();
        }

        if ($antrian->count() == 1) {
            return 'gagal';
        }
    }
}
