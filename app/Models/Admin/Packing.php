<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packing extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'packing_list_number',
        'document_upload'
    ];
}
