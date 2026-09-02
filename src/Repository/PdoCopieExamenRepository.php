<?php

namespace App\Repository;

use App\Entity\CopieExamen;

class PdoCopieExamenRepository extends AbstractRepository implements CopieExamenRepositoryInterface
{
    public function __construct(\PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function save(CopieExamen $copie): CopieExamen
    {
        if ($copie->getId() === null) {
            return $this->insert($copie);
        }

        return $this->update($copie);
    }

    private function insert(CopieExamen $copie): CopieExamen
    {
        $sql = 'INSERT INTO copies (note_brute, note_finale, penalite_appliquee, date_limite, date_depot)
                VALUES (:note_brute, :note_finale, :penalite_appliquee, :date_limite, :date_depot)
                RETURNING id';

        $resultat = $this->executeQuery($sql, [
            'note_brute' => $copie->getNoteBrute(),
            'note_finale' => $copie->getNoteFinale(),
            'penalite_appliquee' => $copie->isPenaliteAppliquee(),
            'date_limite' => $copie->getDateLimite(),
            'date_depot' => $copie->getDateDepot(),
        ]);

        $copie->setId((int) $resultat->id);

        return $copie;
    }

    private function update(CopieExamen $copie): CopieExamen
    {
        $sql = 'UPDATE copies
                SET note_brute = :note_brute,
                    note_finale = :note_finale,
                    penalite_appliquee = :penalite_appliquee,
                    date_limite = :date_limite,
                    date_depot = :date_depot
                WHERE id = :id';

        $this->executeUpdate($sql, [
            'note_brute' => $copie->getNoteBrute(),
            'note_finale' => $copie->getNoteFinale(),
            'penalite_appliquee' => $copie->isPenaliteAppliquee(),
            'date_limite' => $copie->getDateLimite(),
            'date_depot' => $copie->getDateDepot(),
            'id' => $copie->getId(),
        ]);

        return $copie;
    }

    public function findAll(): array
    {
        $lignes = $this->getAllData('copies');

        return array_map(fn($ligne) => $this->hydrater($ligne), $lignes);
    }

    public function findById(int $id): ?CopieExamen
    {
        $sql = 'SELECT * FROM copies WHERE id = :id';

        $ligne = $this->executeQuery($sql, ['id' => $id]);

        if ($ligne === false) {
            return null;
        }

        return $this->hydrater($ligne);
    }

    private function hydrater(object $ligne): CopieExamen
    {
        $copie = new CopieExamen(
            dateDepot: $ligne->date_depot,
            noteBrute: (float) $ligne->note_brute,
            penaliteAppliquee: (bool) $ligne->penalite_appliquee,
            dateLimite: $ligne->date_limite,
            id: (int) $ligne->id
        );

        $copie->setNoteFinale((float) $ligne->note_finale);

        return $copie;
    }
}