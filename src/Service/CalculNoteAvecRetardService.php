<?php

namespace App\Service;
use App\Service\CalculNoteInterface;
final class CalculNoteAvecRetardService implements CalculNoteInterface
{
    private const PENALITE_RETARD = 2.0;

    public function estEnRetard(\DateTimeImmutable $dateDepot, \DateTimeImmutable $dateLimite): bool
    {
        return $dateDepot > $dateLimite;
    }

    public function calculerNoteFinale(float $noteBrute, bool $enRetard): float
    {
        if (!$enRetard) {
            return $noteBrute;
        }

        return max(0.0, $noteBrute - self::PENALITE_RETARD);
    }
}