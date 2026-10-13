<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi balik: Simpanan ini milik siapa
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}


