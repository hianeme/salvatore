<section class="content-header">
  <h1>Module employes</h1>
  <ol class="breadcrumb">
    <li><a href="#">Accueil</a></li>
    <li class="active">Employes</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Ajouter un employe</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" name="save-employe-form" autocomplete="off">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-6">
                    <input name="nom" type="text" class="form-control" placeholder="Nom" data-validation-type="alpha" data-validation-min="2" data-validation-mandatory="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Prénom</label>
                <div class="col-sm-6">
                    <input name="prenom" type="text" class="form-control" placeholder="Prénom" data-validation-type="alpha" data-validation-min="2" data-validation-mandatory="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Mail</label>
                <div class="col-sm-6">
                    <input name="mail" type="text" class="form-control" placeholder="Mail" data-validation-type="email" data-validation-min="2" data-validation-mandatory="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Adresse</label>
                <div class="col-sm-6">
                    <textarea name="adresse" class="form-control" placeholder="Adresse" data-validation-min="6" data-validation-mandatory="true"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Telephone</label>
                <div class="col-sm-6">
                    <textarea name="telephone" class="form-control" placeholder="Telephone" data-validation-min="6" data-validation-mandatory="true"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Poste</label>
                <div class="col-sm-6">
                    <select name="poste" class="form-control">
                        <option value="1">Gérant</option>
                        <option value="2">Livreur</option>
                        <option value="3">Cuisinier</option>
                    </select>
                </div>
            </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <input type="hidden" name="id" value="" />
            <div class="col-sm-2"></div>
            <div class="col-sm-6">
                <button type="button" id="save-employe-button" class="btn btn-info btn-flat pull-right">Enregistrer</button>
            </div>
        </div>
        <!-- /.box-footer -->
    </form>
  </div>
    <!-- /.box-body -->
</section>
    