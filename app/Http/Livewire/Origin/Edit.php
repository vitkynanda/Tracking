<?php

namespace App\Http\Livewire\Origin;

use Livewire\Component;
use App\Models\Admin\Origin;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $origin_name, $origin_address, $origin_id;

    protected $rules = [
        'origin_name' => 'required|min:5',
        'origin_address' => 'required|min:5'
    ];

    protected $messages = [
        'origin_name.required' => 'Nama Asal harus diisi',
        'origin_name.min' => 'Nama Asal minimal 5 karakter',
        'origin_address.required' => 'Alamat Asal harus diisi',
        'origin_address.min' => 'Alamat Asal minimal 5 karakter'
    ];

    public function mount($id)
    {
        $item = Origin::findOrFail($id);
        if($item){
            $this->origin_id = $item->id;
            $this->origin_name = $item->origin_name;
            $this->origin_address = $item->origin_address;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveOrigin()
    {
        $validatedData = $this->validate();

        $item = Origin::findOrFail($this->origin_id);
        $item->fill($validatedData);
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Asal berhasil diubah');
        return redirect()->route('origin.index');
    }

    public function render()
    {
        return view('livewire.origin.edit')
            ->extends('layouts.app', ['active' => 'origin'])
            ->section('content');
    }
}
