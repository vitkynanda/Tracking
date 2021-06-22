<?php

namespace App\Http\Livewire\Container;

use Livewire\Component;
use App\Models\Admin\Container;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $container_name, $container_id;

    protected $rules = [
        'container_name' => 'required|min:5'
    ];

    protected $messages = [
        'container_name.required' => 'Nama Container harus diisi',
        'container_name.min' => 'Nama Container minimal 5 karakter'
    ];

    public function mount($id)
    {
        $item = Container::findOrFail($id);
        if($item){
            $this->container_name = $item->container_name;
            $this->container_id = $item->id;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveContainer()
    {
        $validatedData = $this->validate();

        $item = Container::findOrFail($this->container_id);
        $item->fill($validatedData);
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Container berhasil diubah');
        return redirect()->route('container.index');
    }

    public function render()
    {
        return view('livewire.container.edit')
            ->extends('layouts.app', ['active' => 'container'])
            ->section('content');
    }
}
