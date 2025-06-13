<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche PFE - {{ $fiche->etudiant->name ?? '' }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; line-height: 1.5; color: #333; }
        .header { text-align: center; margin-bottom: 40px; }
        .header h1 { font-size: 24px; margin: 0; color: #000; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { font-size: 18px; margin: 5px 0; font-weight: normal; }
        .section { margin-bottom: 25px; }
        .section h3 { font-size: 16px; color: #1a237e; border-bottom: 1px solid #c5cae9; padding-bottom: 5px; margin-bottom: 15px; }
        .details-grid { line-height: 2; }
        .details-grid strong { display: inline-block; width: 200px; color: #000; }
        .content-block { padding: 15px; border-left: 3px solid #e8eaf6; background-color: #f9f9fc; margin-top: 10px; }
        .footer { text-align: center; position: fixed; bottom: 0; width: 100%; font-size: 10px; color: #777; }
        .signature-section { margin-top: 80px; }
        .signature-box { display: inline-block; width: 45%; text-align: center; }
        .signature-line { border-top: 1px solid #333; margin-top: 60px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Fiche de Proposition de Projet de Fin d'Études</h1>
        <h2>Année Universitaire {{ date('Y') }} - {{ date('Y') + 1 }}</h2>
    </div>

    <div class="section">
        <h3>1. Identification de l'Étudiant(e)</h3>
        <div class="details-grid">
            <p><strong>Nom et Prénom :</strong> {{ $fiche->etudiant->name ?? 'N/A' }}</p>
            <p><strong>Email :</strong> {{ $fiche->etudiant->email ?? 'N/A' }}</p>
            <p><strong>Encadrant Pédagogique :</strong> {{ $fiche->enseignant->name ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="section">
        <h3>2. Organisme d'Accueil</h3>
        <div class="details-grid">
            <p><strong>Société :</strong> {{ $fiche->societe_acceuil }}</p>
            <p><strong>Encadrant Externe :</strong> {{ $fiche->encadrant_externe }}</p>
            <p><strong>Téléphone :</strong> {{ $fiche->ntel_societe }}</p>
            <p><strong>Email :</strong> {{ $fiche->mail_societe }}</p>
        </div>
    </div>

    <div class="section">
        <h3>3. Description du Projet</h3>
        <h4>Intitulé du PFE</h4>
        <div class="content-block">
            <p>{{ $fiche->intitule_pfe }}</p>
        </div>
        <h4>Besoins Fonctionnels</h4>
        <div class="content-block">
            <p>{{ $fiche->besions_fonctionnels }}</p>
        </div>
        <h4>Technologies Utilisées</h4>
        <div class="content-block">
            <p>{{ $fiche->technologies_utilisees }}</p>
        </div>
        <h4>Langue de Rédaction</h4>
        <div class="content-block">
            <p>{{ $fiche->langue }}</p>
        </div>
    </div>
    
    <div class="signature-section">
        <div class="signature-box" style="float: left;">
            <p>Signature de l'Étudiant(e)</p>
            <div class="signature-line"></div>
        </div>
        <div class="signature-box" style="float: right;">
            <p>Signature de l'Encadrant Pédagogique</p>
            <div class="signature-line"></div>
        </div>
    </div>

    <div class="footer">
        Document généré le {{ date('d/m/Y') }} - Plateforme de Gestion des PFE
    </div>
</body>
</html>