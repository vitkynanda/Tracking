<?php

namespace App\Http\Livewire\Destination;

use App\Models\Admin\Destination;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

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
        $item = Destination::findOrFail($id);
        $item->rec_status = 0;
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Tujuan berhasil dihapus');
        return redirect()->route('destination.index');
    }

    public function render()
    {
        return view('livewire.destination.index', [
                'items' => Destination::where('rec_status', 1)->where('destination_name', 'like', '%'.$this->search.'%')->paginate(5)
            ])
            ->extends('layouts.app', ['active' => 'destination'])
            ->section('content');
    }
}
