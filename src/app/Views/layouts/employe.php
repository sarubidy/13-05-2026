<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>TechMada RH — Espace Employé</title>
<!-- Bootstrap Local -->
<link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet"/>
<!-- Icons (via CDN pour le moment) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
<!-- Fichier style externe -->
<link href="<?= base_url('assets/style.css') ?>" rel="stylesheet"/>
</head>
<body>

<div class="app-wrap">

  <!-- SIDEBAR EMPLOYÉ -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="sidebar-logo-icon"><i class="bi bi-briefcase"></i></div>
      <div class="sidebar-brand-name">TechMada RH<span>Espace employé</span></div>
    </div>
    <div class="sidebar-section">Menu</div>
    <ul class="sidebar-nav">
      <li><a href="<?= site_url('employe/dashboard') ?>" class="<?= url_is('employe/dashboard') ? 'active' : '' ?>"><i class="bi bi-grid-1x2"></i> Tableau de bord</a></li>
      <li><a href="<?= site_url('employe/demande/create') ?>" class="<?= url_is('employe/demande/create') ? 'active' : '' ?>"><i class="bi bi-plus-circle"></i> Nouvelle demande</a></li>
      <li>
        <a href="<?= site_url('employe/demandes') ?>" class="<?= url_is('employe/demandes') ? 'active' : '' ?>">
          <i class="bi bi-calendar3"></i> Mes demandes
          <span class="nav-badge alert">!</span>
        </a>
      </li>
      <li><a href="#" ><i class="bi bi-person"></i> Mon profil</a></li>
    </ul>
    <div class="sidebar-user">
      <div class="s-user-row">
        <div class="avatar av-green">SR</div>
        <div>
          <div class="user-name">Soa Rakoto</div>
          <div class="user-role">Employé · IT</div>
        </div>
        <a href="#" style="margin-left:auto;color:rgba(255,255,255,.25);font-size:1.1rem" title="Déconnexion"><i class="bi bi-box-arrow-right"></i></a>
      </div>
    </div>
  </aside>

  <!-- MAIN WRAPPER -->
  <div class="main">
    
    <!-- HEADER RENDERING -->
    <div class="topbar">
      <div>
        <div class="topbar-title"><?= $title ?? 'Tableau de bord' ?></div>
        <div class="topbar-breadcrumb">
          <a href="<?= site_url('employe/dashboard') ?>">Accueil</a> 
          <?php if(isset($breadcrumb)): ?>
          <i class="bi bi-chevron-right" style="font-size:.6rem"></i> <?= $breadcrumb ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="topbar-actions">
        <a href="<?= site_url('employe/demande/create') ?>" class="btn-forest" style="padding:7px 14px;font-size:.82rem">
          <i class="bi bi-plus-lg"></i> Nouvelle demande
        </a>
      </div>
    </div>

    <!-- MAIN VIEW RENDERING -->
    <?= $this->renderSection('content') ?>

    <div class="footer-app"><i class="bi bi-c-circle"></i> <?= date('Y') ?> <span>TechMada RH</span> — Projet CodeIgniter 4</div>
  </div>

</div>

<!-- Scripts (si nécessaire) -->
</body>
</html>