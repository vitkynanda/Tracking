<?php

namespace App\Http\Livewire\Delivery;

use App\Models\Admin\Delivery;
use App\Models\Admin\Container;
use App\Models\Admin\Client;
use App\Models\Admin\Origin;
use App\Models\Admin\Destination;
use App\Models\Admin\Packing;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $container_name, $client_name, $origin_name, $destination_name, $delivery_type, $delivery_status, $packing_list=[], $packing_list_new=[], $delivery_id, $resi_by_system;

    protected $rules = [
        'packing_list_new' => 'required',
        'container_name' => 'required',
        'client_name' => 'required',
        'origin_name' => 'required',
        'destination_name' => 'required',
        'delivery_type' => 'required|numeric',
    ];

    protected $messages = [
        'packing_list_new.required' => 'required|numeric',
        'container_name.required' => 'required|numeric',
        'client_name.required' => 'required',
        'origin_name.required' => 'required',
        'destination_name.required' => 'required',
        'delivery_type.required' => 'required|numeric',
        'delivery_type.numeric' => 'required|numeric',
    ];

    public function mount($id)
    {
        $item = Delivery::findOrFail($id);
        if($item){
            $this->delivery_id = $item->id;
            $this->resi_by_system = $item->resi_by_system;
            $this->container_name = $item->container_name;
            $this->origin_name = $item->origin_name;
            $this->destination_name = $item->destination_name;
            $this->client_name = $item->client_name;
            $this->delivery_type = $item->delivery_type;

            $packings = Packing::where('container_id', $this->resi_by_system)->get();
            foreach ($packings as $p) {
                array_push($this->packing_list, $p->packing_list_number);
                array_push($this->packing_list_new, $p->packing_list_number);
            }
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveOrigin()
    {
        $validatedData = $this->validate();

        $item = Delivery::findOrFail($this->delivery_id);
        $item->fill($validatedData);
        $item->rec_userupdated = Auth::user()->name;
        $item->save();

        foreach ($this->packing_list as $packing_list_number) {
            $pl = Packing::where('packing_list_number', $packing_list_number)->first();
            $pl->container_id = null;
            $pl->save();
        }

        foreach ($validatedData['packing_list_new'] as $packing_list_number) {
            $pl = Packing::where('packing_list_number', $packing_list_number)->first();
            $pl->container_id = $item->resi_by_system;
            $pl->save();
        }

        session()->flash('message', 'Pengiriman berhasil diubah');
        return redirect()->route('delivery.index');
    }

    public function generateResi($delivery_type, $order)
    {

    }

    public function render()
    {
        return view('livewire.delivery.edit', [
                'containers' => Container::where('rec_status', 1)->get(),
                'clients' => Client::where('rec_status', 1)->get(),
                'origins' => Origin::where('rec_status', 1)->get(),
                'destinations' => Destination::where('rec_status', 1)->get(),
                'packings' => Packing::where('rec_status', 1)->get() 
            ])
            ->extends('layouts.app', ['active' => 'delivery'])
            ->section('content');
    }
}
