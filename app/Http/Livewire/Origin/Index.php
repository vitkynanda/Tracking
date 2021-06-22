<?php

namespace App\Http\Livewire\Origin;

use App\Models\Admin\Origin;
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
        $item = Origin::findOrFail($id);
        $item->rec_status = 0;
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Asal berhasil dihapus');
        return redirect()->route('origin.index');
    }

    public function render()
    {
        return view('livewire.origin.index', [
                'items' => Origin::where('rec_status', 1)->where('origin_name', 'like', '%'.$this->search.'%')->paginate(5)
            ])
            ->extends('layouts.app', ['active' => 'origin'])
            ->section('content');
    }
}
