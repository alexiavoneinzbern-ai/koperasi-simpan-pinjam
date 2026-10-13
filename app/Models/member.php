<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: Satu anggota bisa memiliki banyak simpanan
    public function savings()
    {
        return $this->hasMany(Saving::class);
    }

    // Relasi: Satu anggota bisa memiliki banyak pinjaman
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}