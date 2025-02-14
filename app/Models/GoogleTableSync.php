<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleTableSync extends Model
{
    use HasFactory;

    const ALLOWED_STATUS = 'Allowed';

    const PROHIBITED_STATUS = 'Prohibited';

    public $timestamps = true;

    protected $table = 'sandbox_google_table_sync';

    protected $fillable = [
        'title',
        'value',
        'comment',
        'status',
    ];
}
