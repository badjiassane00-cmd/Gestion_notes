<?php

namespace App\Entity;   


class CopieExamen extends AbstractDocument
{
    private float $noteBrute;
    private ?float $noteFinale = null;
    private bool $penaliteAppliquee;
    private string $dateLimite;

    public function __construct(string|\DateTimeImmutable $dateDepot, float $noteBrute, bool $penaliteAppliquee, string|\DateTimeImmutable $dateLimite, ?int $id = null)
    {
        parent::__construct($dateDepot, $id);
        $this->verifierNote($noteBrute);
        $this->noteBrute = $noteBrute;
        $this->penaliteAppliquee = $penaliteAppliquee;
        $this->dateLimite = $dateLimite;
    }

    public function getNoteBrute(): float
    {
        return $this->noteBrute;
    }

    public function setNoteBrute(float $noteBrute): void
    {
        $this->verifierNote($noteBrute);
        $this->noteBrute = $noteBrute;
    }

    public function getNoteFinale(): ?float
    {
        return $this->noteFinale;
    }

    public function setNoteFinale(float $noteFinale): void
    {
        $this->verifierNote($noteFinale);
        $this->noteFinale = $noteFinale;
    }

    public function isPenaliteAppliquee(): bool
    {
        return $this->penaliteAppliquee;
    }

    public function setPenaliteAppliquee(bool $penaliteAppliquee): void
    {
        $this->penaliteAppliquee = $penaliteAppliquee;
    }

    public function getDateLimite(): string
    {
        return $this->dateLimite;
    }

    private function verifierNote(float $note): void
    {
        if ($note < 0 || $note > 20) {
            throw new \InvalidArgumentException('La note doit être comprise entre 0 et 20.');
        }
    }
}