<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Delivery;
use App\Models\Admin\Packing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'packing_list' => 'required',
            'container_name' => 'required',
            'client_name' => 'required',
            'origin_name' => 'required',
            'destination_name' => 'required',
            'delivery_type' => 'required|numeric',
        ]);

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

    public function update(Request $request, $id)
    {
        
    }

    public function generateResi($type, $order)
    {
        if($order < 10) $order = '000'.$order;
        else if($order < 100) $order = '00'.$order;
        else if($order < 1000) $order = '0'.$order;
        else if($order < 10000) $order = $order;
        
        return $type.'00'.$order;
    }
}
