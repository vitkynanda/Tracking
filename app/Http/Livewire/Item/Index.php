<?php

namespace App\Http\Livewire\Item;

use Livewire\Component;
use App\Models\Admin\Item;
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

    public function deleteItem($id)
    {
        $item = Item::findOrFail($id);
        $item->rec_status = 0;
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Item berhasil dihapus');
        return redirect()->route('item.index');
    }

    public function render()
    {
        return view('livewire.item.index', [
            'items' => Item::where('rec_status', 1)->where('item_name', 'like', '%'.$this->search.'%')->paginate(5)
        ])
        ->extends('layouts.app', ['active' => 'item'])
        ->section('content');
    }
}
