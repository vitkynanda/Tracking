<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use App\Models\Admin\Client;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $client_name, $client_phone, $client_email, $client_address;

    protected $rules = [
        'client_name' => 'required|min:5',
        'client_phone' => 'required',
        'client_email' => 'required|email',
        'client_address' => 'required|min:5'
    ];

    protected $messages = [
        'client_name.required' => 'Nama Client harus diisi',
        'client_name.min' => 'Nama Client minimal 5 karakter',
        'client_phone.required' => 'Telepon Client harus diisi',
        'client_email.required' => 'Email Client harus diisi',
        'client_email.email' => 'Email Client harus valid',
        'client_address.required' => 'Alamat Client harus diisi',
        'client_address.min' => 'Alamat Client minimal 5 karakter'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveClient()
    {
        $validatedData = $this->validate();

        $item = new Client();
        $item->fill($validatedData);
        $item->rec_usercreated = Auth::user()->name;
        $item->rec_userupdated = Auth::user()->name;
        $item->rec_status = 1;
        $item->save();

        session()->flash('message', 'Client berhasil dibuat');
        return redirect()->route('client.index');
    }

    public function render()
    {
        return view('livewire.client.create')
            ->extends('layouts.app', ['active' => 'client'])
            ->section('content');
    }
}
