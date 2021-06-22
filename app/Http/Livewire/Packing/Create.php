<?php

namespace App\Http\Livewire\Packing;

use App\Models\Admin\Packing;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $packing_list_number, $document_upload;

    protected $rules = [
        'packing_list_number' => 'required|min:5',
        'document_upload' => 'required'
    ];

    protected $messages = [
        'packing_list_number.required' => 'Packing list number harus diisi',
        'packing_list_number.min' => 'Packing list number minimal 5 karakter',
        'document_upload.required' => 'Document harus diupload',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveOrigin()
    {
        $validatedData = $this->validate();
        $filename = "packing_list_".date('YmdHis')."_".uniqid().".".$this->document_upload->getClientOriginalExtension();

        $item = new Packing();
        $item->packing_list_number = $this->packing_list_number;
        $item->document_upload = $filename;
        $item->rec_usercreated = Auth::user()->name;
        $item->rec_userupdated = Auth::user()->name;
        $item->rec_status = 1;
        $item->save();

        $this->document_upload->storeAs('packing_list', $filename);

        session()->flash('message', 'Packing berhasil dibuat');
        return redirect()->route('packing.index');
    }

    public function render()
    {
        return view('livewire.packing.create')
            ->extends('layouts.app', ['active' => 'packing'])
            ->section('content');
    }
}

