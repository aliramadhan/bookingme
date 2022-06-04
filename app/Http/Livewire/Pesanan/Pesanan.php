<?php

namespace App\Http\Livewire\Pesanan;

use Livewire\Component;
use App\Models\Pesanan as ModelPesanan;
use App\Models\Kendaraan as ModelKendaraan;
use App\Models\LogData as ModelLogData;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;

class Pesanan extends Component
{
    use LivewireAlert;
    public $isModalOpen = 0;
    public $pesanans, $kendaraans, $setPesanan, $nopol, $nama_pemesan, $keterangan, $tanggal_mulai, $tanggal_stop, $nama_driver;
    public function render(){
        $this->pesanans = ModelPesanan::all();
        $this->kendaraans = ModelKendaraan::all();
        return view('livewire.pesanan.pesanan');
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
        $this->setPesanan = '';
        $this->nopol = '';
        $this->nama_kendaraan = '';
        $this->nama_pemesan = '';
        $this->keterangan = '';
        $this->tanggal_mulai = '';
        $this->tanggal_stop = '';
        $this->nama_driver = '';
    }
    public function store(){
		#validate Request store
        $this->validate([
            'nopol' => 'required',
            'nama_pemesan' => 'required',
            'keterangan' => 'required',
            'tanggal_mulai' => 'required|date|before:tanggal_stop',
            'tanggal_stop' => 'required|date|after:tanggal_mulai',
            'nama_driver' => 'required',
        ]);
        $kendaraan = ModelKendaraan::where('nopol',$this->nopol)->first();
        if ($this->setPesanan != null) {
        	#Update
	        ModelPesanan::updateOrCreate(['id' => $this->setPesanan->id], [
	            'nopol' => $this->nopol,
	            'nama_kendaraan' => $kendaraan->nama,
	            'nama_pemesan' => $this->nama_pemesan,
	            'keterangan' => $this->keterangan,
	            'tanggal_mulai' => $this->tanggal_mulai,
	            'tanggal_stop' => $this->tanggal_stop,
	            'nama_driver' => $this->nama_driver,
	        ]);
            #create log
            ModelLogData::create([
                'keterangan' => auth()->user()->name." berhasil mengubah data pesanan ".$this->setPesanan->nama_kendaraan." dengan nama pemesan ".$this->setPesanan->nama_pemesan." pada ".Carbon::now()->format('d-M-Y H:i:s'),
            ]);
            #sent notification alert
            $this->alert('success', 'Pesanan '.$this->setPesanan->nama_pemesan.' berhasil diubah.', [
                'position' =>  'center', 
                'timer' =>  3000,
                'toast' =>  false, 
                'text' =>  '', 
            ]);
        }
        else{
			#validate request store
	        $pesanan = ModelPesanan::Create([
	            'nopol' => $this->nopol,
	            'nama_kendaraan' => $kendaraan->nama,
	            'nama_pemesan' => $this->nama_pemesan,
	            'keterangan' => $this->keterangan,
	            'tanggal_mulai' => $this->tanggal_mulai,
	            'tanggal_stop' => $this->tanggal_stop,
	            'nama_driver' => $this->nama_driver,
	            'status' => 'Proses',
	        ]);
            #create log
            ModelLogData::create([
                'keterangan' => auth()->user()->name." berhasil menambah data pesanan ".$pesanan->nama_kendaraan." dengan nama pemesan ".$pesanan->nama_pemesan." pada ".Carbon::now()->format('d-M-Y H:i:s'),
            ]);
            #sent notification alert
	        $this->alert('success', 'Pesanan baru ditambahkan.', [
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
        $this->setPesanan = $pesanan = ModelPesanan::findOrFail($id);
        $this->nopol = $pesanan->nopol;
        $this->nama_kendaraan = $pesanan->nama_kendaraan;
        $this->nama_pemesan = $pesanan->nama_pemesan;
        $this->keterangan = $pesanan->keterangan;
        $this->tanggal_mulai = $pesanan->tanggal_mulai->format('Y-m-d');
        $this->tanggal_stop = $pesanan->tanggal_stop->format('Y-m-d');
        $this->nama_driver = $pesanan->nama_driver;
    
        $this->openModalPopover();
    }
    public function delete($id){
        $pesanan = ModelPesanan::find($id);
        $message = "Pesanan ". $pesanan->nama_kendaraan ." tanggal ".$pesanan->tanggal_mulai->format('d M Y')." - ".$pesanan->tanggal_stop->format('d M Y')." dari ".$pesanan->nama_pemesan. " berhasil dihapus.";
        $logMessage = auth()->user()->name." berhasil menghapus data pesanan ".$pesanan->nama_kendaraan." dengan nama pemesan ".$pesanan->nama_pemesan." pada ".Carbon::now()->format('d-M-Y H:i:s');
        #destroy
        $pesanan->delete();
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
    public function accept($id)
    {
        $pesanan = ModelPesanan::find($id);
        $kendaraan = ModelKendaraan::where('nopol',$pesanan->nopol)->first();
        #update status ke diterima
    	$pesanan->update([
    		'status' => 'Diterima'
    	]);
        #create log
        ModelLogData::create([
            'keterangan' => auth()->user()->name." berhasil menerima data pesanan ".$pesanan->nama_kendaraan." dengan nama pemesan ".$pesanan->nama_pemesan." pada ".Carbon::now()->format('d-M-Y H:i:s'),
        ]);
        #sent notification alert
    	$this->alert('success', "Pesanan ". $pesanan->nama_kendaraan ." tanggal ".$pesanan->tanggal_mulai->format('d M Y')." - ".$pesanan->tanggal_stop->format('d M Y')." dari ".$pesanan->nama_pemesan. " berhasil diterima.", [
            'position' =>  'center', 
            'timer' =>  3000,
            'toast' =>  false, 
            'text' =>  '', 
        ]);
    }
    public function decline($id)
    {
        $pesanan = ModelPesanan::find($id);
        $kendaraan = ModelKendaraan::where('nopol',$pesanan->nopol)->first();
        #update status ke ditolak
    	$pesanan->update([
    		'status' => 'Ditolak'
    	]);
        #create log
        ModelLogData::create([
            'keterangan' => auth()->user()->name." berhasil menolak data pesanan ".$pesanan->nama_kendaraan." dengan nama pemesan ".$pesanan->nama_pemesan." pada ".Carbon::now()->format('d-M-Y H:i:s'),
        ]);
        #sent notification alert
    	$this->alert('success', "Pesanan ". $pesanan->nama_kendaraan ." tanggal ".$pesanan->tanggal_mulai->format('d M Y')." - ".$pesanan->tanggal_stop->format('d M Y')." dari ".$pesanan->nama_pemesan. " berhasil ditolak.", [
            'position' =>  'center', 
            'timer' =>  3000,
            'toast' =>  false, 
            'text' =>  '', 
        ]);
    }
}
