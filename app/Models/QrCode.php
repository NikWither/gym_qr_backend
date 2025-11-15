<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrCode extends Model
{
    protected $table = 'qr_codes';

    protected $guarded = [];

    public function simulator(): BelongsTo
    {
        return $this->belongsTo(Simulator::class, 'simulator_id', 'id');
    }
}
