<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Cinema
 *
 * @property int $id
 * @property int $Cinema_category_id
 * @property string $name
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @package App\Models
 */
class Cinema extends Model
{
    use HasFactory;

    /** @var bool */
    public $timestamps = true;

    /** @var array */
    protected $guarded = [];

    /** @var string */
    protected $table = 'cinemas';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var string[] */
    protected $fillable = [
        'name',
        'country_id',
    ];
}
