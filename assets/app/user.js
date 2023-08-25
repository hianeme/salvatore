import utility from './utility.js'

var user = {
    USER_API_URL: BASE_URL + 'api/utilisateur/',
    init: function(){
        this.initDataTable();
        this.initSaveUserButton();
    },
    initDataTable: function(){
        $('#users-list').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
              url: this.USER_API_URL + 'findAll',
              type: 'GET',
              dataSrc:"data"
            },
            columns: [
                { data: 'id' },
                { data: 'nom' },
                { data: 'prenom' },
                { data: 'login' },
                { data: 'role' },
            ]
          });
    },
    initSaveUserButton: function(){
        $('#save-user-button').on('click', function(){
            let formData = utility.getFormDataByName('save-user-form');
            
            console.log(formData);
            $.ajax({
                url: user.USER_API_URL + 'save',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(xhr){
                    if('OK' === xhr.status){
                        document.location.href = BASE_URL+'utilisateur';
                    }
                },
                error: function(log){
                    console.log(log);
                }
            })
        });
    }
};

export default user;