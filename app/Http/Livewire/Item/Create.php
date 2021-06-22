<?php

namespace App\Http\Livewire\Item;

use Livewire\Component;
use App\Models\Admin\Item;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $item_name, $type_of_item, $item_qty, $price;

    protected $rules = [
        'item_name' => 'required|min:5',
        'type_of_item' => 'required',
        'item_qty' => 'required|int',
        'price' => 'required|int'
    ];

    protected $messages = [
        'item_name.required' => 'Nama Item harus diisi',
        'item_name.min' => 'Nama Item minimal 5 karakter',
        'type_of_item.required' => 'Tipe Item harus diisi',
        'item_qty.required' => 'Item Qty harus diisi',
        'item_qty.int' => 'Item Qty harus angka',
        'price.required' => 'Harga harus diisi',
        'price.int' => 'Harga harus angka'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveClient()
    {
        $validatedData = $this->validate();

        $item = new Item();
        $item->fill($validatedData);
        $item->rec_usercreated = Auth::user()->name;
        $item->rec_userupdated = Auth::user()->name;
        $item->rec_status = 1;
        $item->save();

        session()->flash('message', 'Item berhasil dibuat');
        return redirect()->route('item.index');
    }

    public function render()
    {
        return view('livewire.item.create')
            ->extends('layouts.app', ['active' => 'item'])
            ->section('content');
    }
}
