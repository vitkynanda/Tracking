<?php

namespace App\Http\Livewire\Good;

use App\Models\Admin\Good;
use App\Models\Admin\Item;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $packing_list_number, $items;

    protected $rules = [
        'packing_list_number' => 'required|min:5',
        'items' => 'required'
    ];

    protected $messages = [
        'packing_list_number.required' => 'Packing List Number harus diisi',
        'packing_list_number.min' => 'Packing List Number minimal 5 karakter',
        'items.required' => 'Items harus diisi',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveOrigin()
    {
        $validatedData = $this->validate();

        $item = new Good();
        $item->fill($validatedData);
        $item->rec_usercreated = Auth::user()->name;
        $item->rec_userupdated = Auth::user()->name;
        $item->rec_status = 1;
        $item->save();

        session()->flash('message', 'Good berhasil dibuat');
        return redirect()->route('good.index');
    }

    public function render()
    {
        return view('livewire.good.create', [
                'options' => Item::where('rec_status', 1)->get()
            ])
            ->extends('layouts.app', ['active' => 'good'])
            ->section('content');
    }
}
