<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvToOfxConversion extends Model
{
    use HasFactory;

    protected $table      = "csv_to_ofx_conversions";

    protected $primaryKey = "id";

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
