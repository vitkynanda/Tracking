<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use App\Models\Admin\Client;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $client_name, $client_phone, $client_email, $client_address, $client_id;

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

    public function mount($id)
    {
        $item = Client::findOrFail($id);
        if($item){
            $this->client_name = $item->client_name;
            $this->client_phone = $item->client_phone;
            $this->client_email = $item->client_email;
            $this->client_address = $item->client_address;
            $this->client_id = $item->id;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveClient()
    {
        $validatedData = $this->validate();

        $item = Client::findOrFail($this->client_id);
        $item->fill($validatedData);
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Client berhasil diubah');
        return redirect()->route('client.index');
    }

    public function render()
    {
        return view('livewire.client.edit')
            ->extends('layouts.app', ['active' => 'client'])
            ->section('content');
    }
}
