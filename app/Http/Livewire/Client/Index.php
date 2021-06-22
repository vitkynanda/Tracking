<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use App\Models\Admin\Client;
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

    public function deleteClient($id)
    {
        $item = Client::findOrFail($id);
        $item->rec_status = 0;
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Client berhasil dihapus');
        return redirect()->route('client.index');
    }

    public function render()
    {
        return view('livewire.client.index', [
            'items' => Client::where('rec_status', 1)->where('client_name', 'like', '%'.$this->search.'%')->paginate(5)
        ])
        ->extends('layouts.app', ['active' => 'client'])
        ->section('content');
    }
}
