<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/style.css">
    <title>Nouvelle copie | Gestion des notes</title>
</head>
<body>
    <?php $formulaire = $_POST ?? []; ?>
    <header class="site-header">
        <nav class="navbar" aria-label="Navigation principale">
            <a class="brand" href="/">
                <span class="brand-mark">GN</span>
                <span class="brand-name">Gestion des notes</span>
            </a>
            <div class="nav-links">
                <a href="/copies">Les copies</a>
                <a class="active" href="/copies/create">Nouvelle copie</a>
            </div>
        </nav>
    </header>

    <main class="page">
        <div class="eyebrow">Espace enseignant</div>
        <h1>Enregistrer une nouvelle copie.</h1>
        <p class="subtitle">Saisissez les informations de l'étudiant et laissez le système calculer automatiquement la note finale.</p>

      

        <div class="form-shell">
            <aside class="info-panel">
                <h2>Une saisie claire, un calcul fiable.</h2>
                <p>Les dates permettent d'identifier automatiquement les dépôts en retard et d'appliquer la pénalité prévue.</p>
                <ul class="info-list">
                    <li><span>1</span> Note comprise entre 0 et 20</li>
                    <li><span>2</span> Dates vérifiées à la saisie</li>
                    <li><span>3</span> Résultat calculé instantanément</li>
                </ul>
            </aside>
            <form class="form-card" method="post" action="/copies">
                <h2>Détails de la copie</h2>
                <div class="field">
                    <label for="note_brute">Note brute <span>(sur 20)</span></label>
                    <input type="number" step="0.01" min="0" max="20" name="note_brute" id="note_brute" value="<?= htmlspecialchars((string) ($formulaire['note_brute'] ?? '')) ?>" required>
                </div>
                <div class="field">
                    <label for="date_depot">Date de dépôt</label>
                    <input type="date" name="date_depot" id="date_depot" value="<?= htmlspecialchars((string) ($formulaire['date_depot'] ?? '')) ?>" required>
                </div>
                <div class="field">
                    <label for="date_limite">Date limite</label>
                    <input type="date" name="date_limite" id="date_limite" value="<?= htmlspecialchars((string) ($formulaire['date_limite'] ?? '')) ?>" required>
                </div>
                <p class="form-note">Tous les champs sont obligatoires.</p>
                <button class="button" type="submit">Enregistrer la copie <span aria-hidden="true">→</span></button>
            </form>
        </div>
    </main>
</body>
</html>