<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property boolean $active
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class ApiUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'api_user';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['id', 'first_name', 'last_name', 'phone', 'active', 'email', 'password', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
