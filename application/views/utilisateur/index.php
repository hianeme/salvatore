<section class="content-header">
  <h1>Module utilisateurs</h1>
  <ol class="breadcrumb">
    <li><a href="#">Accueil</a></li>
    <li class="active">Utilisateurs</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Liste des utilisateurs</h3>
      <div class="pull-right box-tools">
        <a href="<?= base_url('utilisateur/add') ?>" class="btn btn-sm btn-block btn-success btn-flat">
          <i class="fa fa-plus"></i></button>
        </a>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="users-list" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Login</th>
          <th>Role</th>
        </tr>
        </thead>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
</section>
    