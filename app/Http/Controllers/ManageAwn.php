<?php

namespace App\Http\Controllers;

use App\Models\data_awn;
use App\Models\data_master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManageAwn extends Controller
{
    public function index()
    {
        //cek autentifikasi user
        if (isset(Auth::user()->role) && Auth::user()->role == 1) {
            return view('awn');
        } else {
            return abort(404);
        }
    }

    //function add-data 
    public function add()
    {
        if (isset(Auth::user()->role) && Auth::user()->role == 1) {
            return view('add-awn');
        } else {
            return abort(404);
        }
    }

    //function edit dengan mengambil $id 
    public function edit($id)
    {
        $this->data = DB::table('data_awns')->where('id', $id)->first();
        return view('edit-awn')->with('data', $this->data);
    }
    
    public $stok_awn = '';
    public function addstok(request $request){
        $this->stok_awn = $request->stok_awn;
        $data_master = data_master::find(1);
        $new_stok_awn = $data_master->stok_awn + $this->stok_awn;
        $new_stok = $data_master->stok + $this->stok_awn;
        DB::update('update data_masters set stok_awn = ?, stok = ?',[$new_stok_awn, $new_stok]);
        $this->stok_awn = '';
        return view('awn');
    }

    public function editawn(request $request)
    {
        $request->validate([
            'nama_stasiun' => 'required',
            'input' => 'required|int',
            'output' => 'required|int'
        ]);
        $this->stok_awal = data_master::sum('stok_awn');
        $request->id;
        $request->nama_stasiun;
        $request->input;
        $request->output;
        $data = DB::table('data_awns')->where('id', $request->id)->first();
        $old_input = $data->input;
        $old_output = $data->output;
        $data_master = data_master::find(1);
        $range_input = $request->input - $old_input;
        $range_output = $request->output - $old_output;
        $range_order = $request->output - $data->output;
        $this->stok_awn = $this->stok_awal + ($range_input) - ($range_output);
        $this->total_order = $data_master->total_order + $range_order;
        $this->total_stok = $data_master->stok + ($range_input) - ($range_output);
        
        DB::update('update data_awns set nama_stasiun = ?, output = ?, input = ? where id = ?', [strtolower($request->nama_stasiun), $request->output, $request->input, $request->id]);
        DB::update('update data_masters set stok_awn = ?, total_order = ?, stok = ?', [$this->stok_awn, $this->total_order, $this->total_stok]);
        $data = DB::table('data_awns')->where('id', $request->id)->first();
        
        return view('edit-awn')->with('data', $data)->with(session()->flash('edit-awn', 'Data Edited'));
    }
}
