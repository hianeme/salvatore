<?php $logged_user = $this->session->userdata('user') ?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('assets/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $logged_user->nom . ' ' . $logged_user->prenom ?></p>
          <p><?= $logged_user->role ?></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
        <?php if('ADMIN' === $logged_user->role) { ?>
        <li><a href="<?= base_url('utilisateur') ?> "><i class="fa fa-users"></i> <span>Utilisateurs</span></a></li>
        <?php } ?>
        <li><a href="<?= base_url('employe') ?>"><i class="fa fa-id-card"></i> <span>Employes</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>