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

class Create extends Component
{
    public $container_name, $client_name, $origin_name, $destination_name, $delivery_type, $delivery_status, $packing_list=[];

    protected $rules = [
        'packing_list' => 'required',
        'container_name' => 'required',
        'client_name' => 'required',
        'origin_name' => 'required',
        'destination_name' => 'required',
        'delivery_type' => 'required|numeric',
    ];

    protected $messages = [
        'packing_list.required' => 'required|numeric',
        'container_name.required' => 'required|numeric',
        'client_name.required' => 'required',
        'origin_name.required' => 'required',
        'destination_name.required' => 'required',
        'delivery_type.required' => 'required|numeric',
        'delivery_type.numeric' => 'required|numeric',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveOrigin()
    {
        $validatedData = $this->validate();

        $count = Delivery::count()+1;

        $item = new Delivery();
        $item->fill($validatedData);
        $item->delivery_status = 1;
        $item->resi_by_system = $this->generateResi($validatedData['delivery_type'], $count);
        $item->rec_usercreated = Auth::user()->name;
        $item->rec_userupdated = Auth::user()->name;
        $item->rec_status = 1;
        $item->save();

        foreach ($validatedData['packing_list'] as $packing_list_number) {
            $pl = Packing::where('packing_list_number', $packing_list_number)->first();
            $pl->container_id = $item->resi_by_system;
            $pl->save();
        }

        session()->flash('message', 'Pengiriman berhasil dibuat');
        return redirect()->route('delivery.index');
    }

    public function generateResi($type, $order)
    {
        if($order < 10) $order = '000'.$order;
        else if($order < 100) $order = '00'.$order;
        else if($order < 1000) $order = '0'.$order;
        else if($order < 10000) $order = $order;
        
        return $type.'00'.$order;
    }

    public function render()
    {
        return view('livewire.delivery.create', [
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
