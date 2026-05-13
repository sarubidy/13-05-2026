<?= $this->extend('layouts/employe') ?>

<?= $this->section('content') ?>
<div class="content">

    <!-- Flash succès ou message (dynamique en prod) -->
    <!--
    <div class="flash flash-success">
    <i class="bi bi-check-circle-fill"></i>
    Votre demande de congé a bien été soumise. Elle est en attente de validation.
    </div>
    -->

    <!-- Métriques -->
    <div class="metrics">
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-amber"><i class="bi bi-hourglass-split"></i></div></div>
        <div class="metric-val">2</div>
        <div class="metric-label">En attente</div>
    </div>
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-green"><i class="bi bi-check-circle"></i></div></div>
        <div class="metric-val">5</div>
        <div class="metric-label">Approuvées</div>
    </div>
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-forest"><i class="bi bi-calendar-check"></i></div></div>
        <div class="metric-val">18</div>
        <div class="metric-label">Jours restants</div>
        <div class="metric-sub">sur 30 cette année</div>
    </div>
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-red"><i class="bi bi-x-circle"></i></div></div>
        <div class="metric-val">1</div>
        <div class="metric-label">Refusée</div>
    </div>
    </div>

    <!-- Soldes de congés -->
    <div class="data-card">
    <div class="data-card-head"><h3>Mes soldes de congés — <?= date('Y') ?></h3></div>
    <div style="padding:1rem 1.25rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem">
        <div class="solde-card" style="margin:0">
        <div class="solde-header">
            <span class="solde-type">Congé annuel</span>
            <span class="solde-nums"><strong>18</strong> / 30 j</span>
        </div>
        <div class="solde-bar"><div class="solde-fill" style="width:60%"></div></div>
        <div class="solde-label">18 jours restants · 12 pris</div>
        </div>
        <div class="solde-card" style="margin:0">
        <div class="solde-header">
            <span class="solde-type">Congé maladie</span>
            <span class="solde-nums"><strong>8</strong> / 10 j</span>
        </div>
        <div class="solde-bar"><div class="solde-fill" style="width:80%"></div></div>
        <div class="solde-label">8 jours restants · 2 pris</div>
        </div>
        <div class="solde-card" style="margin:0">
        <div class="solde-header">
            <span class="solde-type">Congé spécial</span>
            <span class="solde-nums"><strong>1</strong> / 5 j</span>
        </div>
        <div class="solde-bar"><div class="solde-fill warn" style="width:20%"></div></div>
        <div class="solde-label">1 jour restant · 4 pris</div>
        </div>
    </div>
    </div>

</div>
<?= $this->endSection() ?>