<?php

namespace App\Http\Livewire\Packing;

use Livewire\Component;
use App\Models\Admin\Packing;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $packing_list_number, $document_upload, $document_upload_new, $packing_id;

    protected $rules = [
        'packing_list_number' => 'required|min:5'
    ];

    protected $messages = [
        'packing_list_number.required' => 'Packing list number harus diisi',
        'packing_list_number.min' => 'Packing list number minimal 5 karakter',
    ];

    public function mount($id)
    {
        $item = Packing::findOrFail($id);
        if($item){
            $this->packing_id = $item->id;
            $this->packing_list_number = $item->packing_list_number;
            $this->document_upload = $item->document_upload;
        }
    }

    public function downloadFile($file)
    {
        return Storage::disk('local')->download('packing_list/'.$file);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveOrigin()
    {
        $validatedData = $this->validate();

        $item = Packing::findOrFail($this->packing_id);
        $item->packing_list_number = $this->packing_list_number;
        if($this->document_upload_new){
            $filename = "packing_list_".date('YmdHis')."_".uniqid().".".$this->document_upload_new->getClientOriginalExtension();
            $item->document_upload = $filename;
            $this->document_upload_new->storeAs('packing_list', $filename);
        }
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        session()->flash('message', 'Packing berhasil diubah');
        return redirect()->route('packing.index');
    }

    public function render()
    {
        return view('livewire.packing.edit')
            ->extends('layouts.app', ['active' => 'packing'])
            ->section('content');
    }
}
