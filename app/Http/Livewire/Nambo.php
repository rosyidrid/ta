<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\data_nambo;
use App\Models\data_master;
use Illuminate\Support\Facades\DB;

class Nambo extends Component
{
    public function render()
    {
        $this->total_stok = data_master::sum('stok_nambo');
        $this->total_output = data_nambo::sum('output');
        $this->total_input = data_nambo::sum('input');
        if(data_nambo::first() == NULL){
            return view('livewire.nambo', ['data_nambo' => data_nambo::first()]);
        }else{
            return view('livewire.nambo', ['data_nambo' => DB::table('data_nambos')->get()])
            ->with('total_stok', $this->total_stok)
            ->with('total_output', $this->total_output)
            ->with('total_input', $this->total_input);
        }
    }

    public $stok_nambo = '';
    public function addstok(){
        $this->stok_nambo;
        $data_master = data_master::find(1);
        $new_stok_nambo = $data_master->stok_nambo + $this->stok_nambo;
        $new_stok = $data_master->stok + $this->stok_nambo;
        DB::update('update data_masters set stok_nambo = ?, stok = ?',[$new_stok_nambo, $new_stok]);
        $this->stok_nambo = '';
    }

    public function destroy(){
        $this->total_stok = data_master::sum('stok_nambo');
        $this->total_order = data_master::sum('total_order');
        $data_master = DB::table('data_masters')->first();
        if (DB::table('data_nambos')->first() == NULL) {
            session()->flash('message', 'Data Empty');
        } else {
            DB::table('data_nambos')->delete();
            $new_stok = $data_master->stok - $this->total_stok;
            $new_order = $data_master->total_order - $this->total_order;
            DB::update('update data_masters set stok_nambo = ?, stok = ?, total_order = ?',[0, $new_stok, $new_order]);
            session()->flash('message', 'Data Destroyed');
        }
    }

    public function delete($id){
        $data_nambo = DB::table('data_nambos')->where('id', $id)->first();
        $data_master = DB::table('data_masters')->first();
        $this->old_stok_nambo = $data_master->stok_nambo;
        $this->old_order = $data_master->total_order;
        $new_stok_nambo = $this->old_stok_nambo - $data_nambo->input + $data_nambo->output;
        $new_stok = $data_master->stok - $data_nambo->input + $data_nambo->output;
        $new_order = $this->old_order - $data_nambo->output; 
        DB::update('update data_masters set stok_nambo = ?, stok = ?, total_order = ?', [$new_stok_nambo, $new_stok, $new_order]);
        DB::table('data_nambos')->where('id', $id)->delete();
        session()->flash('message', 'Data Deleted');
    }
}
