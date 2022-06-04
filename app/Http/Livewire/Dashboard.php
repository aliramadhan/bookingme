<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kendaraan as ModelKendaraan;
use App\Models\Pesanan as ModelPesanan;
use DB;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;
class Dashboard extends Component
{
	public $kendaraans, $pesanans, $labelDays, $dataDays, $month;
    public function render()
    {
        $this->pesanans = ModelPesanan::all();
        $this->kendaraans = ModelKendaraan::all();
        #get data for graph
        $pesanans = ModelPesanan::where('status','Diterima')->orderBy('updated_at')->get()->groupBy(function ($val) {
        	return Carbon::parse($val->updated_at)->format('d');
    	});
    	$this->labelDays = [];
    	$this->dataDays = [];
    	foreach ($pesanans as $pesanan => $value) {
        	$this->labelDays [] = $pesanan;
        	$this->dataDays [] = $value->count();
    	}
        return view('livewire.dashboard');
    }
    public function export(){
    	if ($this->month != null) {
    		# code...
	    	$month = Carbon::parse($this->month);
	    	$data = ModelPesanan::where('status','Diterima')->whereMonth('updated_at',$month)->get();
	    	return (new FastExcel($data))->download('file.xlsx');
    	}
    }
}
