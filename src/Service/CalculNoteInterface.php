<?php

namespace App\Service;

interface CalculNoteInterface
{
    public function estEnRetard(\DateTimeImmutable $dateDepot, \DateTimeImmutable $dateLimite): bool;

    public function calculerNoteFinale(float $noteBrute, bool $enRetard): float;
}