<?php

namespace App\Http\Livewire\Good;

use App\Models\Admin\Good;
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

    public function deleteGood($id)
    {
        $item = Good::findOrFail($id);
        $item->rec_status = 0;
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Good berhasil dihapus');
        return redirect()->route('good.index');
    }

    public function render()
    {
        return view('livewire.good.index', [
                'items' => Good::where('rec_status', 1)->where('packing_list_number', 'like', '%'.$this->search.'%')->paginate(5)
            ])
            ->extends('layouts.app', ['active' => 'good'])
            ->section('content');
    }
}

