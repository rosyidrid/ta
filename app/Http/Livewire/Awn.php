<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\data_awn;
use App\Models\data_master;
use Illuminate\Support\Facades\DB;

class Awn extends Component
{
    public function render()
    {
        $this->total_stok = data_master::sum('stok_awn');
        $this->total_output = data_awn::sum('output');
        $this->total_input = data_awn::sum('input');
        if (data_awn::first() == NULL) {
            return view('livewire.awn', ['data_awn' => data_awn::first()]);
        } else {
            return view('livewire.awn', ['data_awn' => DB::table('data_awns')->get()])
                ->with('total_stok', $this->total_stok)
                ->with('total_output', $this->total_output)
                ->with('total_input', $this->total_input);
        }
    }

    public $stok_awn = '';
    public function addstok()
    {
        $this->stok_awn;
        $data_master = data_master::find(1);
        $new_stok_awn = $data_master->stok_awn + (int)$this->stok_awn;
        $new_stok = $data_master->stok + (int)$this->stok_awn;
        DB::update('update data_masters set stok_awn = ?, stok = ?', [$new_stok_awn, $new_stok]);
    }

    public function destroy()
    {
        $this->total_stok = data_master::sum('stok_awn');
        $this->total_order = data_master::sum('total_order');
        $data_master = DB::table('data_masters')->first();
        if (DB::table('data_awns')->first() == NULL) {
            session()->flash('message', 'Data Empty');
        } else {
            DB::table('data_awns')->delete();
            $new_stok = $data_master->stok - $this->total_stok;
            $new_order = $data_master->total_order - $this->total_order;
            DB::update('update data_masters set stok_awn = ?, stok = ?, total_order = ?', [0, $new_stok, $new_order]);
            session()->flash('message', 'Data Destroyed');
        }
    }

    public function delete($id)
    {
        $data_awn = DB::table('data_awns')->where('id', $id)->first();
        $data_master = DB::table('data_masters')->first();
        $this->old_stok_awn = $data_master->stok_awn;
        $this->old_order = $data_master->total_order;
        $new_stok_awn = $this->old_stok_awn - $data_awn->input + $data_awn->output;
        $new_stok = $data_master->stok - $data_awn->input + $data_awn->output;
        $new_order = $this->old_order - $data_awn->output;
        DB::update('update data_masters set stok_awn = ?, stok = ?, total_order = ?', [$new_stok_awn, $new_stok, $new_order]);
        DB::table('data_awns')->where('id', $id)->delete();
        session()->flash('message', 'Data Deleted');
    }
}
