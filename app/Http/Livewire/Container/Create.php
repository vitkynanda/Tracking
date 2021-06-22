<?php

namespace App\Http\Livewire\Container;

use Livewire\Component;
use App\Models\Admin\Container;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $container_name;

    protected $rules = [
        'container_name' => 'required|min:5'
    ];

    protected $messages = [
        'container_name.required' => 'Nama Container harus diisi',
        'container_name.min' => 'Nama Container minimal 5 karakter'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveContainer()
    {
        $validatedData = $this->validate();

        $item = new Container();
        $item->fill($validatedData);
        $item->rec_usercreated = Auth::user()->name;
        $item->rec_userupdated = Auth::user()->name;
        $item->rec_status = 1;
        $item->save();

        session()->flash('message', 'Container berhasil dibuat');
        return redirect()->route('container.index');
    }

    public function render()
    {
        return view('livewire.container.create')
            ->extends('layouts.app', ['active' => 'container'])
            ->section('content');
    }
}
