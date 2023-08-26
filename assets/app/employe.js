import utility from './utility.js'

var employe = {
    EMPLOYE_API_URL: BASE_URL + 'api/employe/',
    dataTable: null,
    init: function(){
        this.initDataTable();
        this.initSaveButton();
        this.initSaveForm();
        this.initDeleteButton();
        this.initModel();
    },
    initDataTable: function(){
        employe.dataTable = $('#employes-list').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
              url: this.EMPLOYE_API_URL + 'findAll',
              type: 'GET',
              dataSrc:"data",
            },
            columns: [
                { data: 'id' },
                { data: 'nom' },
                { data: 'prenom' },
                { data: 'mail' },
                { data: 'adresse' },
                { data: 'telephone' },
                { data: 'poste' },
                {
                    "mData": "action",
                    "mRender": function (data, type, row) {
                        let buttonHtml = '';
                        
                        buttonHtml += '<a href="'+ BASE_URL +'employe/save/'+ row.id +'" class="btn btn-sm btn-info btn-flat"><i class="fa fa-pencil"></i></a> ';
                        buttonHtml += '<button class="btn btn-sm btn-danger btn-flat" data-delete-employe-full-name="'+ row.nom + ' ' + row.prenom+'" data-delete-employe-id="'+ row.id +'"><i class="fa fa-trash"></i></button>';
                        
                        return buttonHtml;
                    }
                }
            ]
          });
    },
    initSaveButton: function(){
        $('#save-employe-button').on('click', function(){

            if(utility.validateFormByName('save-employe-form') > 0){
                return;
            }
            
            let formData = utility.getFormDataByName('save-employe-form');
            
            $.ajax({
                url: employe.EMPLOYE_API_URL + 'save',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(xhr){
                    if('OK' === xhr.status){
                        document.location.href = BASE_URL+'employe';
                    }
                },
                error: function(log){
                    console.log(log);
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

            if('employe' === controller && 'save' === action && undefined != path[path.length-1]){
                id = path[path.length-1];
            }
        }

        if(-1 !== id){
            $('[name="save-employe-form"] [name="id"]').val(id);
            $.ajax({
                url: employe.EMPLOYE_API_URL + 'find/' + id,
                type: 'POST',
                dataType: 'json',
                success: function(xhr){
                    const _response = xhr;
                    if('OK' === _response.status){
                        let formData = utility.getFormDataByName('save-employe-form');
                        
                        for(let key in formData){
                            $('[name="'+ key +'"]').val(_response.employe[key]);
                        }
                    }
                },
                error: function(log){
                    console.log(log);
                }
            })
        }
    },
    initDeleteButton: function(){
        $(document).on('click', '[data-delete-employe-id]', function(){
            let employeId = $(this).data('delete-employe-id');
            let employeFullName = $(this).data('delete-employe-full-name');
            $('[data-employe-id]').data('employe-id', employeId);
            $('#modal-delete-employe .employe-full-name').html(employeFullName);
            $('#modal-delete-employe').modal();
        })
    },
    initModel: function(){
        $('#delete-employe-btn').on('click', function(){
            let employeId = $(this).data('employe-id');
            
            $.ajax({
                url: employe.EMPLOYE_API_URL + 'delete/' + employeId,
                type: 'POST',
                dataType: 'json',
                success: function(xhr){
                    const _response = xhr;
                    
                    if(_response.status){
                        $('#modal-delete-employe').modal('toggle');
                        employe.dataTable.draw('page');
                    }
                },
                error: function(log){
                    console.log(log);
                }
            });
        })
    }
};

export default employe;