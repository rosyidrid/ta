<?php

namespace App\Http\Controllers;

use App\Models\data_master;
use App\Models\data_nambo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManageNambo extends Controller
{
    public function index(){
        if(isset(Auth::user()->role) && Auth::user()->role == 1){
            return view('nambo');
        }else{
            return abort(404);
        }
    }

    //function add-data 
    public function add()
    {
        if (isset(Auth::user()->role) && Auth::user()->role == 1) {
            return view('add-nambo');
        } else {
            return abort(404);
        }
    }

    //function edit dengan mengambil $id 
    public function edit($id)
    {
        $this->data = DB::table('data_nambos')->where('id', $id)->first();
        return view('edit-nambo')->with('data', $this->data);
    }

    public function addstok(request $request){
        $request->stok_nambo;
        $data_master = data_master::find(1);
        $new_stok_nambo = $data_master->stok_nambo + $request->stok_nambo;
        $new_stok = $data_master->stok + $request->stok_nambo;
        $request->stok_nambo = '';
        DB::update('update data_masters set stok_nambo = ?, stok = ?',[$new_stok_nambo, $new_stok]);
        return view('nambo');
    }

    public function addnambo(request $request){
        $request->validate([
            'nama_stasiun' => 'required',
            'orders' => 'required',
            'input' => 'required',
            'output' => 'required'
        ]);
        $this->stok_awal = data_master::sum('stok_nambo');
        $request->output;
        $request->input;
        $this->stok_nambo = $this->stok_awal + ($request->input - $request->output);
        $this->input_stok_nambo = $request->input - $request->output;
        $this->data_master = data_master::find(1);
        $this->total_order = $this->data_master->total_order + $request->output;
        $this->total_stok = $this->data_master->stok + $this->input_stok_nambo;

        data_nambo::create([
            'nama_stasiun' => $request->nama_stasiun,
            'orders' => $request->orders,
            'stok_awal' => $this->stok_awal,
            'output' => $request->output,
            'input' => $request->input,
            'tanggal' => now()
        ]);
        DB::update('update data_masters set stok_nambo = ?, total_order = ?, stok = ?', [$this->stok_nambo, $this->total_order, $this->total_stok]);
        return view('add-nambo')->with(session()->flash('message-nambo', 'Data Added'));
    }

    public function editnambo(request $request)
    {
        $request->validate([
            'nama_stasiun' => 'required',
            'orders' => 'required',
            'input' => 'required',
            'output' => 'required'
        ]);
        $this->stok_awal = data_master::sum('stok_nambo');
        $request->id;
        $request->nama_stasiun;
        $request->orders;
        $request->input;
        $request->output;
        $data = DB::table('data_nambos')->where('id', $request->id)->first();
        $old_input = $data->input;
        $old_output = $data->output;
        $data_master = data_master::find(1);
        $range_input = $request->input - $old_input;
        $range_output = $request->output - $old_output;
        $range_orders = $request->output - $data->output;
        $this->stok_nambo = $this->stok_awal + ($range_input) - ($range_output);
        $this->total_order = $data_master->total_order + $range_orders;
        $this->total_stok = $data_master->stok + ($range_input) - ($range_output);

        DB::update('update data_nambos set nama_stasiun = ?, orders = ?, output = ?, input = ? where id = ?', [strtolower($request->nama_stasiun), $request->orders, $request-> output,$request->input, $request->id]);
        DB::update('update data_masters set stok_nambo = ?, total_order = ?, stok = ?', [$this->stok_nambo, $this->total_order, $this->total_stok]);
        $data = DB::table('data_nambos')->where('id', $request->id)->first();
        return view('edit-nambo')->with('data', $data)->with(session()->flash('edit-nambo', 'Data Edited'));
    }
}
