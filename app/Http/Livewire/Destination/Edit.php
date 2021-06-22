<?php

namespace App\Http\Livewire\Destination;

use Livewire\Component;
use App\Models\Admin\Destination;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $destination_name, $destination_address, $destination_id;

    protected $rules = [
        'destination_name' => 'required|min:5',
        'destination_address' => 'required|min:5'
    ];

    protected $messages = [
        'destination_name.required' => 'Nama Client harus diisi',
        'destination_name.min' => 'Nama Container minimal 5 karakter',
        'destination_address.required' => 'Alamat Client harus diisi',
        'destination_address.min' => 'Alamat Client minimal 5 karakter'
    ];

    public function mount($id)
    {
        $item = Destination::findOrFail($id);
        if($item){
            $this->destination_id = $item->id;
            $this->destination_name = $item->destination_name;
            $this->destination_address = $item->destination_address;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveDestination()
    {
        $validatedData = $this->validate();

        $item = Destination::findOrFail($this->destination_id);
        $item->fill($validatedData);
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Tujuan berhasil diubah');
        return redirect()->route('destination.index');
    }

    public function render()
    {
        return view('livewire.destination.edit')
            ->extends('layouts.app', ['active' => 'destination'])
            ->section('content');
    }

}
