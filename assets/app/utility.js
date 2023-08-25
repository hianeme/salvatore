var utility = {
    getFormDataByName: function(formName){
        let serializedFormData = {};
        let formData = $('[name="'+ formName +'"]').serializeArray();

        formData.forEach(function(element, index){
            serializedFormData[element.name] = element.value;
        });

        return serializedFormData;
    }
}

export default utility;