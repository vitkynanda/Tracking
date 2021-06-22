<?php

namespace App\Http\Livewire\Container;

use Livewire\Component;
use App\Models\Admin\Container;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteContainer($id)
    {
        $item = Container::findOrFail($id);
        $item->rec_status = 0;
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Container berhasil dihapus');
        return redirect()->route('container.index');
    }

    public function render()
    {
        return view('livewire.container.index', [
                'items' => Container::where('rec_status', 1)->where('container_name', 'like', '%'.$this->search.'%')->paginate(5)
            ])
            ->extends('layouts.app', ['active' => 'container'])
            ->section('content');
    }
}
