<?php
namespace Rorecek\Ulid;

class Ulid implements Contracts\Factory
{
    // lowercased Crockford's Base32
    private const BASE32_SYMBOL_SET = '0123456789abcdefghjkmnpqrstvwxyz';
    
    private $lastTime = null;

    public function __construct() {}

    public function generate(): string
    {
        // Current microtime timestamp
        $now = intval(microtime(true) * 1000);

        // Inicialize $lastTime property when executed for the first time
        if (is_null($this->lastTime)) {
            $this->lastTime = $now - 1;
        }

        // If current timestamp is lower then lastTime, set it to lastTime + 1
        // to keep ULIDs sortable even when generated at the same microtime timestamp
        if ($now > $this->lastTime) {
            $this->lastTime = $now;
        } else {
            $this->lastTime++;
            $now = $this->lastTime;
        }

        $timeChars = '';
        $randChars = '';

        // Convert timestamp to Crockford's Base32
        for ($i = 1; $i <= 10; $i++) {
            $timeChars = self::BASE32_SYMBOL_SET[$now % 32] . $timeChars;
            $now = (int) floor($now  / 32);
        }

        // Generate random string
        for ($i = 1; $i <= 16; $i++) {
            $randChars .= self::BASE32_SYMBOL_SET[random_int(0, 31)];
        }

        return $timeChars . $randChars;
    }

}