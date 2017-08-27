<?php
namespace Rorecek\Ulid;

class Ulid
{
    // lowercased Crockford's Base32
    const BASE32_SYMBOL_SET = '0123456789abcdefghjkmnpqrstvwxyz';

    private static $lastTime = null;

    private function __construct() {}

    public static function generate()
    {
        // Current microtime timestamp
        $now = intval(microtime(true) * 1000);

        // Inicialize $lastTime property when executed for the first time
        if (is_null(self::$lastTime)) {
            self::$lastTime = $now - 1;
        }

        // If current timestamp is lower then $lastTime, set it to $lastTime + 1
        // to keep ULIDs sortable even when generated at the same microtime timestamp
        if ($now > self::$lastTime) {
            self::$lastTime = $now;
        } else {
            self::$lastTime++;
            $now = self::$lastTime;
        }

        $timeChars = '';
        $randChars = '';

        // Convert timestamp to Crockford's Base32
        for ($i = 1; $i <= 10; $i++) {
            $timeChars = static::BASE32_SYMBOL_SET[$now % 32] . $timeChars;
            $now = (int) floor($now  / 32);
        }

        // Generate random string
        for ($i = 1; $i <= 16; $i++) {
            $randChars .= static::BASE32_SYMBOL_SET[random_int(0, 31)];
        }

        return $timeChars . $randChars;
    }

}