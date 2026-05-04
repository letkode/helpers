<?php

declare(strict_types=1);

namespace Letkode\Helpers\Conversion;

use DateInterval;
use DateTime;
use DateTimeInterface;
use Letkode\Helpers\Contract\ConverterHelperInterface;

/**
 * Returns a human-readable "ago" string for a date.
 */
final readonly class AgoShortDateHelper implements ConverterHelperInterface
{
    public function __construct(
        private bool $includeTime = true,
    ) {
    }

    /**
     * @param string|DateTimeInterface $value      The date to compare
     * @param array<string, mixed>     $parameters unused
     */
    public function handle(mixed $value, array $parameters = []): string
    {
        $now = new DateTime('now');
        $datetime = $value instanceof DateTimeInterface ? $value : new DateTime((string) $value);
        $interval = $datetime->diff($now);

        $diffText = $this->humanize($interval, $this->includeTime);

        return implode('', $diffText);
    }

    /**
     * @return array<string, string>
     */
    private function humanize(DateInterval $interval, bool $time): array
    {
        $y = abs($interval->y);
        $m = abs($interval->m);
        $d = abs($interval->d);
        $h = abs($interval->h);
        $i = abs($interval->i);
        $s = abs($interval->s);

        $text = [];

        if ($y > 0) {
            $text['year'] = $y . ' año' . (1 === $y ? '' : 's');
            if ($m > 0) {
                $text['month'] = ' y ' . $m . ' mes' . (1 === $m ? '' : 'es');
            }
        } elseif ($m > 0) {
            $text['month'] = $m . ' mes' . (1 === $m ? '' : 'es');
            if ($d > 0) {
                $text['day'] = ' y ' . $d . ' día' . (1 === $d ? '' : 's');
            }
        } elseif ($d > 0) {
            $text['day'] = $d . ' día' . (1 === $d ? '' : 's');
            if ($h > 0 && $time) {
                $text['hour'] = ' y ' . $h . ' hora' . (1 === $h ? '' : 's');
            }
        } elseif ($h > 0 && $time) {
            $text['hour'] = $h . ' hora' . (1 === $h ? '' : 's');
            if ($i > 0) {
                $text['minute'] = ' y ' . $i . ' minuto' . (1 === $i ? '' : 's');
            }
        } elseif ($i > 0 && $time) {
            $text['minute'] = $i . ' minuto' . (1 === $i ? '' : 's');
            if ($s > 0) {
                $text['second'] = ' y ' . $s . ' segundo' . (1 === $s ? '' : 's');
            }
        } else {
            if ($time) {
                $text['second'] = $s . ' segundo' . (1 === $s ? '' : 's');
            }
        }

        return $text;
    }
}
