<?php

namespace App\Http\Livewire\Log;

use Livewire\Component;
use App\Models\LogData as ModelLogData;

class LogData extends Component
{
	public $logs;
    public function render()
    {
    	$this->logs = ModelLogData::orderBy('id','desc')->get();
        return view('livewire.log.logdata');
    }
}
