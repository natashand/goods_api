<?php

namespace App\Models;

use App\Enums\GoodCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rules\Enum;

class Good extends Model {
    use HasFactory, SoftDeletes;

    const CATEGORY = [
        GoodCategory::HOUSEHOLD => GoodCategory::HOUSEHOLD,
        GoodCategory::COSMETIC => GoodCategory::COSMETIC,
        GoodCategory::AUTO => GoodCategory::AUTO,
        GoodCategory::FOOD => GoodCategory::FOOD,
        GoodCategory::ELEECTRONICS => GoodCategory::ELEECTRONICS,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'serial_numbeer'
    ];

    protected $casts = [
        'category' => GoodCategory::class
    ];

    /**
     * Get the Category value
     */
    public function getCategoryAttribute() {
        return self::CATEGORY[$this->attributes['category']];
    }

    /**
     * Set the Category value
     */
    public function setCategoryAttribute($value) {
        $this->attributes['category'] = $value;
    }

}
