var utility = {
    getFormDataByName: function(formName){
        let serializedFormData = {};
        let formData = $('[name="'+ formName +'"]').serializeArray();

        formData.forEach(function(element, index){
            serializedFormData[element.name] = element.value;
        });

        return serializedFormData;
    },
    initFormErrors: function(formName){
        $('[name="'+ formName +'"]').find('.help-block').remove();
        $('[name="'+ formName +'"]').find('input').css('border-color', '#d2d6de');
    },
    validateFormByName: function(formName){
        this.initFormErrors(formName);

        let formData = $('[name="'+ formName +'"]').serializeArray();
        let errorsCounter = 0;
        
        formData.forEach(function(element, index){
            errorsCounter += utility.isFieldValid(element);
        });

        return errorsCounter;
    },
    isFieldValid: function(field){
        let fieldObject = $('[name="'+ field.name +'"]');
        let fieldValidations = fieldObject.data();
        let errorsCounter = 0;

        for(let key in fieldValidations ){
            let errors = [];
            let fieldValue = fieldObject.val();
            switch(key){
                case 'validationMandatory':
                    if('' === fieldValue){
                        this.marFieldError(fieldObject);
                        errors.push('Le champs ne doit pas être vide');
                    }
                    break;
                case 'validationMin':
                    if(fieldValue.length < fieldValidations[key]){
                        this.marFieldError(fieldObject);
                        errors.push('Le champs doit être suppérieur à '+ fieldValidations[key] +' caractères');
                    }
                    break;
                case 'validationType':
                    switch(fieldValidations[key]){
                        case 'num':
                            if(!/^[0-9]+$/.test(fieldValue)){
                                this.marFieldError(fieldObject);
                                errors.push('La chaine doit contenir des caractères numériques');
                            }
                            break;
                        case 'alpha':
                            if(!/^[a-zA-Z]+$/.test(fieldValue)){
                                this.marFieldError(fieldObject);
                                errors.push('La chaine doit contenir des caractères alphabétiques');
                            }
                            break;
                        case 'alpha-num':
                            if(!/^[a-zA-Z0-9]+$/.test(fieldValue)){
                                this.marFieldError(fieldObject);
                                errors.push('La chaine doit contenir des caractères alpha-numériques');
                            }
                            break;
                        case 'password':
                            if(!/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]$/.test(fieldValue)){
                                this.marFieldError(fieldObject);
                                errors.push('La chaine doit contenir : au moin un numéro, au moin un caractère spécial');
                            }
                            break;
                        case 'email':
                            if(!/[a-z0-9]+@[a-z]+\.[a-z]{2,3}/.test(fieldValue)){
                                this.marFieldError(fieldObject);
                                errors.push('Un email doit contenire un @ et un tld (.com, .net)');
                            }
                            break;
                    }
                    break;
                    
            }

            if(errors.length > 0){
                fieldObject.parent().append('<p class="help-block">'+ errors.join('<br>') +'</p>');
                errorsCounter++;
            }
        }

        return errorsCounter;
    },
    marFieldError: function(field){
        field.css('border-color', 'red');
    },
    getPathFormUrl: function(){
        var url = new URL(document.location.href);
        return url.pathname;
    }
}

export default utility;