<?php

namespace Edsp\Mvc\Helpers;

class Icon
{
    private static function fa(string $name, array $cssClasses = [], string $format = 'fas'): string
    {
        $classes = implode(' ', $cssClasses);
        return "<i class='$format fa-$name $classes'></i>";
    }

    private static function ma(string $name, array $cssClasses = [])
    {
        $classes = implode(' ', $cssClasses);
        return "<span class='material-icons $classes'>$name</span>";
    }

    //Icons:
    public static function menu(): string
    {
        return self::fa('bars');
    }

    public static function person(): string
    {
        return self::ma('person');
    }

    public static function close(): string
    {
        return self::ma('close');
    }

    public static function house(): string
    {
        return self::fa('house');
    }
}