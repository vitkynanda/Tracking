<?php

namespace App\Http\Livewire\Item;   

use Livewire\Component;
use App\Models\Admin\Item;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $item_name, $type_of_item, $item_qty, $price, $item_id;

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
    
    public function mount($id)
    {
        $item = Item::findOrFail($id);
        if($item){
            $this->item_name = $item->item_name;
            $this->type_of_item = $item->type_of_item;
            $this->item_qty = $item->item_qty;
            $this->price = $item->price;
            $this->item_id = $item->id;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveClient()
    {
        $validatedData = $this->validate();

        $item = Item::findOrFail($this->item_id);
        $item->fill($validatedData);
        $item->rec_userupdated = Auth::user()->name;
        $item->rec_status = 1;
        $item->save();

        session()->flash('message', 'Item berhasil diubah');
        return redirect()->route('item.index');
    }

    public function render()
    {
        return view('livewire.item.edit')
            ->extends('layouts.app', ['active' => 'item'])
            ->section('content');
    }
}