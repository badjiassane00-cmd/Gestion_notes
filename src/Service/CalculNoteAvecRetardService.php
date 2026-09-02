<?php

namespace App\Service;

class CalculNoteAvecRetardService implements CalculNoteInterface
{
    public function calculer(float $noteBrute, bool $penaliteAppliquee): float
    {
        if (!$penaliteAppliquee) {
            return $noteBrute;
        }

        return max(0, $noteBrute - 2);
    }
   

}