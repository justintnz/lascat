<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mclass;
use Illuminate\Database\Eloquent\Relations\HasMany;


class School extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    /**
     * comments
     *
     * @return void
     */
    public function classes(): HasMany
    {
        return $this->hasMany(Mclass::class);
    }
}
