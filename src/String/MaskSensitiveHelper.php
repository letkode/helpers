<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Masks sensitive information like emails, credit cards, or names.
 */
final readonly class MaskSensitiveHelper implements StringHelperInterface
{
    public function __construct(
        private string $type = 'text',
        private string $maskChar = '*',
        private int $visibleCount = 4,
    ) {
    }

    /**
     * @param string               $string     The string to mask
     * @param array<string, mixed> $parameters unused
     */
    public function handle(string $string, array $parameters = []): string
    {
        return match ($this->type) {
            'email' => $this->maskEmail($string),
            'card' => $this->maskCard($string),
            default => $this->maskText($string),
        };
    }

    private function maskEmail(string $email): string
    {
        if (!filter_var($email, \FILTER_VALIDATE_EMAIL)) {
            return $email;
        }

        [$user, $domain] = explode('@', $email);
        $len = \strlen($user);

        if ($len <= 2) {
            return $this->maskChar . $this->maskChar . '@' . $domain;
        }

        return substr($user, 0, 1) . str_repeat($this->maskChar, $len - 2) . substr($user, -1) . '@' . $domain;
    }

    private function maskCard(string $card): string
    {
        $card = (string) preg_replace('/\D/', '', $card);
        $len = \strlen($card);

        if ($len <= $this->visibleCount) {
            return $card;
        }

        return str_repeat($this->maskChar, $len - $this->visibleCount) . substr($card, -$this->visibleCount);
    }

    private function maskText(string $text): string
    {
        $len = mb_strlen($text);

        if ($len <= $this->visibleCount) {
            return str_repeat($this->maskChar, $len);
        }

        return mb_substr($text, 0, $this->visibleCount) . str_repeat($this->maskChar, $len - $this->visibleCount);
    }
}
