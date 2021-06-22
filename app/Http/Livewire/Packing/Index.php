<?php

namespace App\Http\Livewire\Packing;

use App\Models\Admin\Packing;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteOrigin($id)
    {
        $item = Packing::findOrFail($id);
        $item->rec_status = 0;
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Packing berhasil dihapus');
        return redirect()->route('packing.index');
    }

    public function downloadFile($file)
    {
        return Storage::disk('local')->download('packing_list/'.$file);
    }

    public function render()
    {
        return view('livewire.packing.index', [
                'items' => Packing::where('rec_status', 1)->where('packing_list_number', 'like', '%'.$this->search.'%')->paginate(5)
            ])
            ->extends('layouts.app', ['active' => 'packing'])
            ->section('content');
    }
}
