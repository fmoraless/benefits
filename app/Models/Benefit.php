<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = [
      'id_programa',
      'monto',
      'fecha_recepcion',
      'fecha'
    ];

    public function filter(): BelongsTo
    {
        return $this->belongsTo(Filter::class, 'id_programa', 'id_programa');
    }
}
