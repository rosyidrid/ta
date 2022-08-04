<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\data_nambo;
use App\Models\data_master;
use Illuminate\Support\Facades\DB;

class AddNambo extends Component
{
    public $nama_stasiun = '';
    public $input = '';
    public $output = '';
    public $orders = '';
    protected $rules = [
        'nama_stasiun' => 'required',
        'orders' => 'required',
        'input' => 'required|int',
        'output' => 'required|int'
    ];
    public function render()
    {
        return view('livewire.add-nambo');
    }

    public function resetvalues()
    {
        $this->nama_stasiun = '';
        $this->input = '';
        $this->output = '';
        $this->orders = '';
    }

    public function addnambo()
    {
        $this->validate();
        $this->stok_awal = data_master::sum('stok_nambo');
        $this->orders;
        $this->output;
        $this->input;
        $this->stok_nambo = $this->stok_awal + ((int)$this->input - (int)$this->output);
        $this->input_stok_nambo = (int)$this->input - (int)$this->output;
        $this->data_master = data_master::find(1);
        $this->total_order = $this->data_master->total_order + (int)$this->output;
        $this->total_stok = $this->data_master->stok + (int)$this->input_stok_nambo;

        data_nambo::create([
            'nama_stasiun' => strtolower($this->nama_stasiun),
            'stok_awal' => $this->stok_awal,
            'orders' => $this->orders,
            'output' => (int)$this->output,
            'input' => (int)$this->input,
            'tanggal' => now(),
        ]);

        DB::update('update data_masters set stok_nambo = ?, total_order = ?, stok = ?', [$this->stok_nambo, $this->total_order, $this->total_stok]);
        session()->flash('add-nambo', 'Data Added');
        $this->resetvalues();
    }
}
