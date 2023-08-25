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
      <h3 class="box-title">Ajouter un utilisateur</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" name="save-user-form" autocomplete="off">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-6">
                    <input name="nom" type="text" class="form-control" placeholder="Nom">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Prénom</label>
                <div class="col-sm-6">
                    <input name="prenom" type="text" class="form-control" placeholder="Prénom">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Login</label>
                <div class="col-sm-6">
                    <input name="login" type="text" class="form-control" placeholder="Login">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Mot de passe</label>
                <div class="col-sm-6">
                    <input name="mot_de_passe" type="password" class="form-control" placeholder="Mot de passe">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Role</label>
                <div class="col-sm-6">
                    <select name="role" class="form-control">
                        <option value="1">ADMIN</option>
                        <option value="2">USER</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <input type="hidden" name="id" value="" />
            <div class="col-sm-2"></div>
            <div class="col-sm-6">
                <button type="button" id="save-user-button" class="btn btn-info btn-flat">Enregistrer</button>
            </div>
        </div>
        <!-- /.box-footer -->
    </form>
  </div>
    <!-- /.box-body -->
</section>
    