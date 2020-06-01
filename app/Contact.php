<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Contact extends Model
{
    protected $fillable = [
        'first_name',
        'email',
        'phone',
        'manager_id',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function scopeWithManager(Builder $query, User $user)
    {
        return $query->where('manager_id', $user->id);
    }
}
