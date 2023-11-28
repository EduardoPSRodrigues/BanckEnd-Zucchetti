<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $hidden = ['updated_at', 'created_at']; //Significa que esse campo não virá na resposta, estou ocultando o updated_at
}
