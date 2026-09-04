<?php

namespace App\Repository;

use App\Entity\CopieExamen;
use PDO;

final class PdoCopieExamenRepository extends AbstractRepository implements CopieExamenRepositoryInterface
{
    private static ?self $instance = null;

    public static function getInstance(PDO $pdo): self
    {
        if (self::$instance === null) {
            self::$instance = new self($pdo);
        }

        return self::$instance;
    }

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function save(CopieExamen $copieExamen): CopieExamen
    {
        $sql = 'INSERT INTO copies (note_brute, note_finale, penalite_appliquee, date_depot, date_limite)
                VALUES (:note_brute, :note_finale, :penalite_appliquee, :date_depot, :date_limite)';

        $id = $this->executeUpdate($sql, [
            'note_brute' => $copieExamen->getNoteBrute(),
            'note_finale' => $copieExamen->getNoteFinale(),
            'penalite_appliquee' => $copieExamen->isPenaliteAppliquee() ? 1 : 0,
            'date_depot' => $copieExamen->getDateDepot(),
            'date_limite' => $copieExamen->getDateLimite(),
        ]);

        $copieExamen->setId((int) $id);

        return $copieExamen;
    }

    public function findAll(): array
    {
        $lignes = $this->getAllData('copies');

        return array_map(
            fn ($ligne) => $this->toEntity($ligne),
            $lignes
        );
    }

    public function findById(int $id): ?CopieExamen
    {
        $sql = 'SELECT * FROM copies WHERE id = :id';

        $ligne = $this->executeQuery($sql, ['id' => $id]);

        if (!$ligne) {
            return null;
        }

        return $this->toEntity($ligne);
    }

    private function toEntity(\stdClass $ligne): CopieExamen
    {
        $copieExamen = new CopieExamen(
            new \DateTimeImmutable($ligne->date_depot),
            (float) $ligne->note_brute,
            (bool) $ligne->penalite_appliquee,
            new \DateTimeImmutable($ligne->date_limite),
            (int) $ligne->id
        );
        $copieExamen->setNoteFinale((float) $ligne->note_finale);

        return $copieExamen;
    }
}