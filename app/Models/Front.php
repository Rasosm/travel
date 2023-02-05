<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Front extends Model
{
    use HasFactory;
    const SORT = [
        'asc_title' => 'Title A-Z',
        'desc_title' => 'Title Z-A',
    ];
}
