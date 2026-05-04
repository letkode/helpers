<?php

declare(strict_types=1);

namespace Letkode\Helpers\Conversion;

use Letkode\Helpers\Contract\ConverterHelperInterface;

/**
 * Converts a number of seconds into a human-readable duration (e.g. 3661 → "1 hour, 1 minute, 1 second").
 */
final readonly class SecondsToHumanHelper implements ConverterHelperInterface
{
    public function __construct(
        private bool $short = false,
    ) {
    }

    public function handle(mixed $value, array $parameters = []): string
    {
        $total = is_numeric($value) ? abs((int) $value) : 0;
        $hours = intdiv($total, 3600);
        $minutes = intdiv($total % 3600, 60);
        $seconds = $total % 60;

        $parts = [];

        if ($hours > 0) {
            $parts[] = $this->short ? "{$hours}h" : "{$hours} " . (1 === $hours ? 'hour' : 'hours');
        }

        if ($minutes > 0) {
            $parts[] = $this->short ? "{$minutes}m" : "{$minutes} " . (1 === $minutes ? 'minute' : 'minutes');
        }

        if ($seconds > 0 || [] === $parts) {
            $parts[] = $this->short ? "{$seconds}s" : "{$seconds} " . (1 === $seconds ? 'second' : 'seconds');
        }

        return implode($this->short ? ' ' : ', ', $parts);
    }
}
