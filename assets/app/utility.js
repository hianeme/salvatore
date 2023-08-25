var utility = {
    getFormDataByName: function(formName){
        let serializedFormData = {};
        let formData = $('[name="'+ formName +'"]').serializeArray();

        formData.forEach(function(element, index){
            serializedFormData[element.name] = element.value;
        });

        return serializedFormData;
    },
    getPathFormUrl: function(){
        var url = new URL(document.location.href);
        let path = url.pathname.split('/');
        
        return (5 === path.length) ? path[4] : -1;
    }
}

export default utility;