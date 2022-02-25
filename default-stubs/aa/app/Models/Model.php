<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Auditable as AuditableModel;
use OwenIt\Auditing\Contracts\Auditable;
use Database\Factories\{Model}Factory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class {Model} extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableModel;

    protected $fillable = ['name', 'added_by_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected static function {Model}Factory(): {Model}Factory
    {
        return {Model}Factory::new();
    }

    public function addedBy(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'added_by_id');
    }
}
