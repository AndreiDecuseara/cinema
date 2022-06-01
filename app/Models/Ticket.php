<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Ticket
 *
 * @property int $id
 * @property int $Ticket_category_id
 * @property string $name
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @package App\Models
 */
class Ticket extends Model
{
    use HasFactory;

    /** @var bool */
    public $timestamps = true;

    /** @var array */
    protected $guarded = [];

    /** @var string */
    protected $table = 'tickets';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var string[] */
    protected $fillable = [
        'ticket_id',
        'ticket_number',
        'ticket_price',
        'ticket_date_time',
        'seat_id',
        'movie_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
