<?php

namespace App\Http\Livewire\Kendaraan;

use Livewire\Component;
use App\Models\Kendaraan as ModelKendaraan;
use App\Models\LogData as ModelLogData;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;

class Kendaraan extends Component
{
    use LivewireAlert;
    public $isModalOpen = 0;
    public $kendaraans, $setKendaraan, $nopol, $nama, $jenis_kendaraan, $jenis_owner, $jenis_bbm;
    public function render(){
        $this->kendaraans = ModelKendaraan::all();
        return view('livewire.kendaraan.index');
    }
    public function create(){
        $this->resetCreateForm();
        $this->openModalPopover();
    }
    public function openModalPopover(){
        $this->isModalOpen = true;
    }
    public function closeModalPopover(){
        $this->isModalOpen = false;
    }
    private function resetCreateForm(){
        $this->setKendaraan = '';
        $this->nopol = '';
        $this->nama = '';
        $this->jenis_kendaraan = '';
        $this->jenis_owner = '';
        $this->jenis_bbm = '';
    }
    public function store(){
    	if ($this->setKendaraan != null) {
    		#validate request update
	        $this->validate([
	            'nopol' => 'required',
	            'nama' => 'required',
	            'jenis_kendaraan' => 'required',
	            'jenis_owner' => 'required',
	            'jenis_bbm' => 'required',
	        ]);
            #Update
	        ModelKendaraan::updateOrCreate(['id' => $this->setKendaraan->id], [
	            'nama' => $this->nama,
	            'jenis_kendaraan' => $this->jenis_kendaraan,
	            'jenis_owner' => $this->jenis_owner,
	            'jenis_bbm' => $this->jenis_bbm,
	        ]);
            #create log
            ModelLogData::create([
                'keterangan' => auth()->user()->name." berhasil mengubah data kendaraan dengan nopol ".$this->setKendaraan->nopol." pada ".Carbon::now()->format('d-M-Y H:i:s'),
            ]);
            #sent notification alert
            $this->alert('success', 'Kendaraan '.$this->setKendaraan->nama.' berhasil diubah.', [
                'position' =>  'center', 
                'timer' =>  3000,
                'toast' =>  false, 
                'text' =>  '', 
            ]);
    	}
    	else{
    		#validate Request store
	        $this->validate([
	            'nopol' => 'required|unique:kendaraans',
	            'nama' => 'required',
	            'jenis_kendaraan' => 'required',
	            'jenis_owner' => 'required',
	            'jenis_bbm' => 'required',
	        ]);
            # Store
	        $kendaraan = ModelKendaraan::Create([
	            'nopol' => $this->nopol,
	            'nama' => $this->nama,
	            'jenis_kendaraan' => $this->jenis_kendaraan,
	            'jenis_owner' => $this->jenis_owner,
	            'jenis_bbm' => $this->jenis_bbm,
	        ]);
            #create log
            ModelLogData::create([
                'keterangan' => auth()->user()->name." berhasil menambah data kendaraan dengan nopol ".$kendaraan->nopol." pada ".Carbon::now()->format('d-M-Y H:i:s'),
            ]);
            #sent notification alert
            $this->alert('success', 'Kendaraan baru ditambahkan.', [
                'position' =>  'center', 
                'timer' =>  3000,
                'toast' =>  false, 
                'text' =>  '', 
            ]);
    	}
        $this->closeModalPopover();
        $this->resetCreateForm();
    }
    public function edit($id){
        $this->setKendaraan = $kendaraan = ModelKendaraan::findOrFail($id);
        $this->nopol = $kendaraan->nopol;
        $this->nama = $kendaraan->nama;
        $this->jenis_kendaraan = $kendaraan->jenis_kendaraan;
        $this->jenis_owner = $kendaraan->jenis_owner;
        $this->jenis_bbm = $kendaraan->jenis_bbm;
    
        $this->openModalPopover();
    }
    public function delete($id){
        #get Kendaraan
        $kendaraan = ModelKendaraan::find($id);
        $message = "Kendaraan ".$kendaraan->nama. " berhasil dihapus.";
        $logMessage = auth()->user()->name." berhasil menghapus data kendaraan dengan nopol ".$kendaraan->nopol." pada ".Carbon::now()->format('d-M-Y H:i:s');
        #destroy
        $kendaraan->delete();
        #create log
        ModelLogData::create([
            'keterangan' => $logMessage,
        ]);
        #sent notification alert
        $this->alert('success', $message, [
            'position' =>  'center', 
            'timer' =>  3000,
            'toast' =>  false, 
            'text' =>  '', 
        ]);
    }
}
