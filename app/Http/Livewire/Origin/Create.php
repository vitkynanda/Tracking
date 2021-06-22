<?php

namespace App\Http\Livewire\Origin;

use App\Models\Admin\Origin;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $origin_name, $origin_address;

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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveOrigin()
    {
        $validatedData = $this->validate();

        $item = new Origin();
        $item->fill($validatedData);
        $item->rec_usercreated = Auth::user()->name;
        $item->rec_userupdated = Auth::user()->name;
        $item->rec_status = 1;
        $item->save();

        session()->flash('message', 'Asal berhasil dibuat');
        return redirect()->route('origin.index');
    }

    public function render()
    {
        return view('livewire.origin.create')
            ->extends('layouts.app', ['active' => 'origin'])
            ->section('content');
    }
}
