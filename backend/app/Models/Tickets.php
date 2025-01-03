<?php

namespace App\Models;

use App\Traits\DateFormatTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tickets extends Model
{
    use SoftDeletes;
    use HasFactory;
    use DateFormatTrait;
    protected $table = "tickets";
    protected $primaryKey = "id";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'title',
        'description',
        'contact_email',
        'priority',
        'organization',
        'vessel',
        'service_line',
        'assign_to',
        'status',
        'category',
        // 'user_id', // Uncomment if the column is added later
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // generate ticket ID function
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            $ticket->id = self::generateTicketId();
        });
    }

    public static function generateTicketId()
    {
        do {
            $id = 'S' . random_int(100000, 999999);
        } while (self::where('id', $id)->exists());

        return $id;
    }
}
