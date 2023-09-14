<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property string $singing
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class DocumentManagement extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';
    protected $table='document_managements';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'content', 'singing', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
