import utility from './utility.js'

var user = {
    USER_API_URL: BASE_URL + 'api/utilisateur/',
    dataTable: null,
    init: function(){
        this.initDataTable();
        this.initSaveButton();
        this.initSaveForm();
        this.initDeleteButton();
        this.initModel();
    },
    initDataTable: function(){
        user.dataTable = $('#users-list').DataTable({
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
                        buttonHtml += '<button class="btn btn-sm btn-danger btn-flat" data-delete-user-full-name="'+ row.nom + ' ' + row.prenom+'" data-delete-user-id="'+ row.id +'"><i class="fa fa-trash"></i></button>';
                        
                        return buttonHtml;
                    }
                }
            ]
          });
    },
    initSaveButton: function(){
        $('#save-user-button').on('click', function(){

            if(utility.validateFormByName('save-user-form') > 0){
                return;
            }

            let formData = utility.getFormDataByName('save-user-form');
            
            $.ajax({
                url: user.USER_API_URL + 'save',
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function(xhr){
                    $('.loader').show();
                },
                success: function(xhr){
                    if('OK' === xhr.status){
                        document.location.href = BASE_URL+'utilisateur';
                    }
                },
                error: function(log){
                    console.log(log);
                },
                complete: function(){
                    $('.loader').hide();
                }
            })
        });
    },
    initSaveForm: function(){

        let path = utility.getPathFormUrl().split('/');

        let id = -1;

        if(path.length > 3 ){
            
            let controller = path[path.length-3];
            let action = path[path.length-2];

            if('utilisateur' === controller && 'save' === action && undefined != path[path.length-1]){
                id = path[path.length-1];
            }
        }

        if(-1 !== id){
            $('[name="id"]').val(id);
            $.ajax({
                url: user.USER_API_URL + 'find/' + id,
                type: 'POST',
                dataType: 'json',
                beforeSend: function(xhr){
                    $('.loader').show();
                },
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
                },
                complete: function(){
                    $('.loader').hide();
                }
            })
        }
    },
    initDeleteButton: function(){
        $(document).on('click', '[data-delete-user-id]', function(){
            let userId = $(this).data('delete-user-id') 
            let userFullName = $(this).data('delete-user-full-name');
            $('[data-user-id]').data('user-id', userId);
            $('#modal-delete-user .user-full-name').html(userFullName);
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
                beforeSend: function(xhr){
                    $('.loader').show();
                },
                success: function(xhr){
                    const _response = xhr;
                    
                    if(_response.status){
                        $('#modal-delete-user').modal('toggle');
                        user.dataTable.draw('page');
                    }
                },
                error: function(log){
                    console.log(log);
                },
                complete: function(){
                    $('.loader').hide();
                }
            });
        })
    }
};

export default user;