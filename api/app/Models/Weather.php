<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'data'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * @param $related
     * @param $foreignKey
     * @param $ownerKey
     * @param $relation
     * @return mixed
     */
    public function belongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null)
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
