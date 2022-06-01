<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Movie
 *
 * @property int $id
 * @property int $Movie_category_id
 * @property string $name
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @package App\Models
 */
class Movie extends Model
{
    use HasFactory;

    /** @var bool */
    public $timestamps = true;

    /** @var array */
    protected $guarded = [];

    /** @var string */
    protected $table = 'movies';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var string[] */
    protected $fillable = [
        'title',
        'realease_year',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class);
    }
}
