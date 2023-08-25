import utility from './utility.js'

var user = {
    USER_API_URL: BASE_URL + 'api/utilisateur/',
    userDataTable: null,
    init: function(){
        this.initDataTable();
        this.initSaveUserButton();
        this.initSaveForm();
        this.initDeleteUserButton();
        this.initModel();
    },
    initDataTable: function(){
        user.userDataTable = $('#users-list').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
              url: this.USER_API_URL + 'findAll',
              type: 'GET',
              dataSrc:"data",
            },
            columns: [
                { data: 'id' },
                { data: 'nom' },
                { data: 'prenom' },
                { data: 'login' },
                { data: 'role' },
                {
                    "mData": "action",
                    "mRender": function (data, type, row) {
                        let buttonHtml = '';
                        
                        buttonHtml += '<a href="'+ BASE_URL +'utilisateur/save/'+ row.id +'" class="btn btn-sm btn-info btn-flat"><i class="fa fa-pencil"></i></a> ';
                        buttonHtml += '<button class="btn btn-sm btn-danger btn-flat" data-delete-user-id="'+ row.id +'"><i class="fa fa-trash"></i></button>';
                        
                        return buttonHtml;
                    }
                }
            ]
          });
    },
    initSaveUserButton: function(){
        $('#save-user-button').on('click', function(){
            let formData = utility.getFormDataByName('save-user-form');
            
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
    },
    initSaveForm: function(){
        let id = utility.getPathFormUrl();

        if(-1 !== id){
            $('[name="id"]').val(id);
            $.ajax({
                url: user.USER_API_URL + 'find/' + id,
                type: 'POST',
                dataType: 'json',
                success: function(xhr){
                    const _response = xhr;
                    if('OK' === _response.status){
                        let formData = utility.getFormDataByName('save-user-form');
                        
                        for(let key in formData){
                            if('mot_de_passe' !== key){
                                $('[name="'+ key +'"]').val(_response.user[key]);
                            }
                        }
                        $('[name="mot_de_passe"]').val('********');
                    }
                },
                error: function(log){
                    console.log(log);
                }
            })
        }
    },
    initDeleteUserButton: function(){
        $(document).on('click', '[data-delete-user-id]', function(){
            let userId = $(this).data('delete-user-id') 
            $('[data-user-id]').data('user-id', userId);
            $('#modal-delete-user').modal();
        })
    },
    initModel: function(){
        $('#delete-user-btn').on('click', function(){
            let userId = $(this).data('user-id');
            
            $.ajax({
                url: user.USER_API_URL + 'delete/' + userId,
                type: 'POST',
                dataType: 'json',
                success: function(xhr){
                    const _response = xhr;
                    
                    if(_response.status){
                        $('#modal-delete-user').modal('toggle');
                        user.userDataTable.draw('page');
                    }
                },
                error: function(log){
                    console.log(log);
                }
            });
        })
    }
};

export default user;