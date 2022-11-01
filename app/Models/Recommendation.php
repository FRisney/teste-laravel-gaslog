<?php
namespace App\Models;

abstract class Recommendation{
    const RECOMMENDS = 'y';
    const NOT_RECOMMENDS = 'n';

    public static function resolve($recommendation)
    {
        return match ($recommendation) {
            self::RECOMMENDS => self::RECOMMENDS,
            default => self::NOT_RECOMMENDS,
        };
    }
}
