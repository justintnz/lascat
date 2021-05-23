<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Student extends Model
{
    use HasFactory;
    /**
     * school
     *
     * @return BelongsTo
     */
    protected $fillable = ['name', 'email', 'school_id'];
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * classes
     *
     * @return belongsToMany
     */
    public function classes(): belongsToMany
    {
        return $this->belongsToMany(Mclass::class);
    }
}
