<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; color: #000; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #1F4E79; padding-bottom: 15px; }
        .header h2 { color: #1F4E79; font-size: 18px; margin: 5px 0; }
        .header h3 { color: #2E75B6; font-size: 15px; margin: 5px 0; }
        .section { margin: 20px 0; }
        .section-title { background: #1F4E79; color: #fff; padding: 6px 12px; font-weight: bold; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        table td, table th { border: 1px solid #ccc; padding: 7px 10px; }
        table th { background: #f0f4f8; font-weight: bold; width: 40%; }
        .jury-table th { background: #1F4E79; color: #fff; text-align: center; }
        .decision { text-align: center; font-size: 16px; font-weight: bold; padding: 12px;
                    border: 2px solid #1F4E79; color: #1F4E79; margin: 20px 0; }
        .signatures { margin-top: 40px; }
        .sig-row { display: flex; justify-content: space-between; margin-top: 60px; }
        .sig-box { text-align: center; width: 30%; border-top: 1px solid #000; padding-top: 5px; font-size: 12px; }
        .footer { margin-top: 40px; text-align: center; font-size: 11px; color: #666;
                  border-top: 1px solid #ccc; padding-top: 10px; }
    </style>
</head>
<body>

<div class="header">
    <h2>INSTITUT SUPÉRIEUR D'INFORMATIQUE</h2>
    <h3>PROCÈS-VERBAL DE SOUTENANCE</h3>
    <p>Année Universitaire 2025 – 2026</p>
</div>

<div class="section">
    <div class="section-title">INFORMATIONS DE LA SOUTENANCE</div>
    <table>
        <tr><th>Étudiant(e)</th><td>{{ $pv->soutenance->etudiant_prenom }} {{ $pv->soutenance->etudiant_nom }}</td></tr>
        <tr><th>Filière</th><td>{{ $pv->soutenance->filiere }}</td></tr>
        <tr><th>Titre du mémoire</th><td>{{ $pv->soutenance->titre_memoire }}</td></tr>
        <tr><th>Date de soutenance</th><td>{{ \Carbon\Carbon::parse($pv->soutenance->date_soutenance)->format('d/m/Y') }}</td></tr>
        <tr><th>Horaire</th><td>{{ $pv->soutenance->heure_debut }} – {{ $pv->soutenance->heure_fin }}</td></tr>
        <tr><th>Salle</th><td>{{ $pv->soutenance->salle }}</td></tr>
    </table>
</div>

<div class="section">
    <div class="section-title">COMPOSITION DU JURY</div>
    <table class="jury-table">
        <thead>
            <tr>
                <th>Nom & Prénom</th>
                <th>Grade</th>
                <th>Rôle</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pv->soutenance->juries as $jury)
            <tr>
                <td>{{ $jury->prenom }} {{ $jury->nom }}</td>
                <td>{{ $jury->grade ?? '—' }}</td>
                <td>{{ ucfirst($jury->role) }}</td>
            </tr>
            @empty
            <tr><td colspan="3" style="text-align:center">Aucun membre enregistré</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="section">
    <div class="section-title">RÉSULTATS DE LA DÉLIBÉRATION</div>
    <table>
        <tr><th>Note obtenue</th><td><strong>{{ $pv->note }} / 20</strong></td></tr>
        <tr><th>Mention</th><td><strong>{{ $pv->mention }}</strong></td></tr>
        <tr><th>Date du PV</th><td>{{ \Carbon\Carbon::parse($pv->date_pv)->format('d/m/Y') }}</td></tr>
    </table>
    @if($pv->appreciation)
    <table style="margin-top:8px">
        <tr><th>Appréciation du jury</th><td>{{ $pv->appreciation }}</td></tr>
    </table>
    @endif
</div>

<div class="decision">
    DÉCISION DU JURY : {{ strtoupper($pv->decision) }}
</div>

<div class="signatures">
    <div class="section-title">SIGNATURES</div>
    <table style="margin-top: 50px; border: none;">
        <tr>
            @foreach($pv->soutenance->juries as $jury)
            <td style="text-align:center; border: none; padding: 10px;">
                <div style="border-top: 1px solid #000; padding-top: 5px; margin-top: 40px;">
                    <strong>{{ ucfirst($jury->role) }}</strong><br>
                    {{ $jury->prenom }} {{ $jury->nom }}
                </div>
            </td>
            @endforeach
        </tr>
    </table>
</div>

<div class="footer">
    Document généré le {{ \Carbon\Carbon::now()->format('d/m/Y à H:i') }} — Institut Supérieur d'Informatique
</div>

</body>
</html>