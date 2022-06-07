<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Reservation
 *
 * @property int $id
 * @property int $Reservation_category_id
 * @property string $name
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @package App\Models
 */
class Reservation extends Model
{
    use HasFactory;

    /** @var bool */
    public $timestamps = true;

    /** @var array */
    protected $guarded = [];

    /** @var string */
    protected $table = 'reservations';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var string[] */
    protected $fillable = [
        'customer_id',
        'ticket_id',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
