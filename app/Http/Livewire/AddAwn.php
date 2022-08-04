<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\data_awn;
use App\Models\data_master;
use App\Models\data_stok;
use Illuminate\Support\Facades\DB;

class AddAwn extends Component
{
    public $nama_stasiun = '';
    public $input = '';
    public $output = '';
    protected $rules = [
        'nama_stasiun' => 'required',
        'input' => 'required|int',
        'output' => 'required|int'
    ];
    public function render()
    {
        return view('livewire.add-awn');
    }

    public function resetvalues()
    {
        $this->nama_stasiun = '';
        $this->input = '';
        $this->output = '';
    }

    public function addawn()
    {
        $this->validate();
        $this->stok_awal = data_master::sum('stok_awn');
        $this->output;
        $this->input;
        $this->stok_awn = $this->stok_awal + ((int)$this->input - (int)$this->output);
        $this->input_stok_awn = (int)$this->input - (int)$this->output;
        $this->data_master = data_master::find(1);
        $this->total_order = $this->data_master->total_order + (int)$this->output;
        $this->total_stok = $this->data_master->stok + (int)$this->input_stok_awn;
        data_awn::create([
            'nama_stasiun' => strtolower($this->nama_stasiun),
            'stok_awal' => $this->stok_awal,
            'output' => (int)$this->output,
            'input' => (int)$this->input,
            'tanggal' => now(),
        ]);
        
        DB::update('update data_masters set stok_awn = ?, total_order = ?, stok = ?', [$this->stok_awn, $this->total_order, $this->total_stok]);
        session()->flash('add-awn', 'Data Added');
        return redirect()->to('/kalog-awn/add');
    }
}
