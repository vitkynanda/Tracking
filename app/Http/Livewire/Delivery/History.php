<?php

namespace App\Http\Livewire\Delivery;

use App\Models\Admin\Delivery;
use App\Models\Admin\Packing;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class History extends Component
{
    public $delivery_id, $resi_by_system, $container_name, $client_name, $origin_name, $destination_name, $delivery_type, $delivery_status;

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
            $this->delivery_status = $item->delivery_status;

            // $packings = Packing::where('container_id', $this->resi_by_system)->get();
            // foreach ($packings as $p) {
            //     array_push($this->packing_list, $p->packing_list_number);
            // }
        }
    }

    public function render()
    {
        return view('livewire.delivery.history', [
                'item' => Delivery::where('rec_status', 1)->where('id', $this->delivery_id)->first()
            ])
            ->extends('layouts.app', ['active' => 'delivery'])
            ->section('content');
    }
}
