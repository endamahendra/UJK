<?php

namespace App\Http\Controllers;
use App\Models\Biodata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function input(){
        return view('input');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NIK' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $biodata = new Biodata();
        $biodata->NIK = $request->NIK;
        $biodata->nama = $request->nama;
        $biodata->tempat_lahir = $request->tempat_lahir;
        $biodata->tanggal_lahir = $request->tanggal_lahir;
        $biodata->jenis_kelamin = $request->jenis_kelamin;
        $biodata->alamat = $request->alamat;
        $biodata->agama = $request->agama;
        $biodata->save();
        return redirect()->route('list')->with('success', 'Data berhasil disimpan.');
    }

    public function list()
    {
        $biodatas = Biodata::all();
        return view('list', compact('biodatas'));
    }
}
