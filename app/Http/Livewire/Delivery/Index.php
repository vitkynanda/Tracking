<?php

namespace App\Http\Livewire\Delivery;

use App\Models\Admin\Delivery;
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
        $item = Delivery::findOrFail($id);
        $item->rec_status = 0;
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Pengiriman berhasil dihapus');
        return redirect()->route('delivery.index');
    }

    public function render()
    {
        return view('livewire.delivery.index', [
                'items' => Delivery::where('rec_status', 1)->where('resi_by_system', 'like', '%'.$this->search.'%')->paginate(5)
            ])
            ->extends('layouts.app', ['active' => 'delivery'])
            ->section('content');
    }
}
