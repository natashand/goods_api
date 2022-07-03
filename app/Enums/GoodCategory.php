<?php


namespace App\Enums;


use Illuminate\Validation\Rules\Enum;

final class GoodCategory extends Enum {

    const HOUSEHOLD = 'household';
    const AUTO = 'auto';
    const COSMETIC = 'cosmetic';
    const FOOD = 'food';
    const ELEECTRONICS = 'electronics';

}
