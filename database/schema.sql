CREATE TABLE copies (
    id SERIAL PRIMARY KEY,
    note_brute FLOAT NOT NULL,
    note_finale FLOAT NOT NULL,
    penalite_appliquee BOOLEAN NOT NULL,
    date_limite DATE NOT NULL,
    date_depot DATE NOT NULL
);
