<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Hall
 *
 * @property int $id
 * @property int $Hall_category_id
 * @property string $name
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @package App\Models
 */
class Hall extends Model
{
    use HasFactory;

    /** @var bool */
    public $timestamps = true;

    /** @var array */
    protected $guarded = [];

    /** @var string */
    protected $table = 'halls';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var string[] */
    protected $fillable = [
        'name',
        'cinema_id',
    ];

    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class);
    }
}
