<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileIntegrityRecord extends Model
{
    protected $fillable = [
        'path',
        'sha256_hash',
        'last_scanned_at',
    ];
}
