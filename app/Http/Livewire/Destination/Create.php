<?php

namespace App\Http\Livewire\Destination;

use App\Models\Admin\Destination;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $destination_name, $destination_address;

    protected $rules = [
        'destination_name' => 'required|min:5',
        'destination_address' => 'required|min:5'
    ];

    protected $messages = [
        'destination_name.required' => 'Nama Tujuan harus diisi',
        'destination_name.min' => 'Nama Tujuan minimal 5 karakter',
        'destination_address.required' => 'Alamat Tujuan harus diisi',
        'destination_address.min' => 'Alamat Tujuan minimal 5 karakter'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveOrigin()
    {
        $validatedData = $this->validate();

        $item = new Destination();
        $item->fill($validatedData);
        $item->rec_usercreated = Auth::user()->name;
        $item->rec_userupdated = Auth::user()->name;
        $item->rec_status = 1;
        $item->save();

        session()->flash('message', 'Asal berhasil dibuat');
        return redirect()->route('destination.index');
    }

    public function render()
    {
        return view('livewire.destination.create')
            ->extends('layouts.app', ['active' => 'destination'])
            ->section('content');
    }

}
