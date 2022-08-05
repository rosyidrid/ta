<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\data_master;
use App\Models\data_awn;
use App\Models\data_nambo;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public function render()
    {
        $data_awn = data_awn::all()->toArray();
        $data_nambo = data_nambo::all()->toArray();
        $hasil = array();
        $tanggal_awn = array();
        $tanggal_nambo = array();
        foreach ($data_awn as $awn) {
            if (!in_array($awn['tanggal'], $tanggal_awn, true)) {
                array_push($tanggal_awn, $awn['tanggal']);
            }
        }
        foreach ($data_nambo as $nambo) {
            if (!in_array($nambo['tanggal'], $tanggal_nambo, true)) {
                array_push($tanggal_nambo, $nambo['tanggal']);
            }
        }

        $tanggal = $tanggal_awn;
        foreach ($tanggal_nambo as $tgl_nambo) {
            if (!in_array($tgl_nambo, $tanggal, true)) {
                array_push($tanggal, $tgl_nambo);
            }
        }
        sort($tanggal);
        foreach ($tanggal as $tgl) {
            $tmp = array();
            $tmp2 = array();
            foreach ($data_awn as $awn) {
                $nama_stasiun = 'awn';
                $new_input_awn = data_awn::where('tanggal', $tgl)->sum('input');
                $new_output_awn =  data_awn::where('tanggal', $tgl)->sum('output');
                if ($tgl == $awn['tanggal']) {
                    if ($awn['nama_stasiun'] == 'awn') {

                        $new_awn = [
                            'nama_stasiun' => $nama_stasiun,
                            'orders' => '-',
                            'input' => $new_input_awn,
                            'output' => $new_output_awn
                        ];
                        array_push($tmp, $new_awn);
                        foreach ($tmp as $i) {
                            if (!in_array($i, $tmp2, true)) {
                                array_push($tmp2, $i);
                            }
                        }
                    }
                }
            }

            foreach ($data_nambo as $nambo) {
                $nama_stasiun = 'nambo';
                $new_input_nambo = data_nambo::where('tanggal', $tgl)->sum('input');
                $new_output_nambo =  data_nambo::where('tanggal', $tgl)->sum('output');

                if ($tgl == $nambo['tanggal']) {
                    if ($nambo['nama_stasiun'] == 'nambo' && $nambo['orders'] == 'bn1') {
                        $new_input_nambo = data_nambo::where('tanggal', $tgl)->where('orders', 'bn1')->sum('input');
                        $new_output_nambo =  data_nambo::where('tanggal', $tgl)->where('orders', 'bn1')->sum('output');
                        $new_nambo = [
                            'nama_stasiun' => $nama_stasiun,
                            'orders' => 'bn1',
                            'input' => $new_input_nambo,
                            'output' => $new_output_nambo
                        ];
                        array_push($tmp, $new_nambo);
                        foreach ($tmp as $i) {
                            if (!in_array($i, $tmp2, true)) {
                                array_push($tmp2, $i);
                            }
                        }
                    } else {
                        $new_input_nambo = data_nambo::where('tanggal', $tgl)->where('orders', 'bn2')->sum('input');
                        $new_output_nambo =  data_nambo::where('tanggal', $tgl)->where('orders', 'bn2')->sum('output');
                        $new_nambo = [
                            'nama_stasiun' => $nama_stasiun,
                            'orders' => 'bn2',
                            'input' => $new_input_nambo,
                            'output' => $new_output_nambo
                        ];
                        array_push($tmp, $new_nambo);
                        foreach ($tmp as $i) {
                            if (!in_array($i, $tmp2, true)) {
                                array_push($tmp2, $i);
                            }
                        }
                    }
                }
            }
            array_push($hasil, array($tgl => $tmp2));
        }
        $this->data_master = data_master::first();
        if ($this->data_master == null) {
            data_master::create([
                'total_order' => 0,
                'stok_awn' => 0,
                'stok_nambo' => 0,
                'stok' => 0
            ]);
        }
        return view('livewire.dashboard', ['hasil' => $hasil])->with('data', $this->data_master);
    }
}
