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
        <a href="<?= base_url('utilisateur/save') ?>" class="btn btn-sm btn-block btn-success btn-flat">
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
          <th>Action</th>
        </tr>
        </thead>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
</section>
<div class="modal fade" id="modal-delete-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Suppression utilisateur</h4>
      </div>
      <div class="modal-body">
        <p>Etes-vous sur de supprimer: <span class="user-full-name"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-danger" id="delete-user-btn" data-user-id="">Oui</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>