var triangleName;
var triangleValues;

function triangleLengthIsInvalid(size) { //sees if values makes a triangle
    var accumulated = 0;
    for(var i=1;i<10;i++) { //maximum triangle size is 10
        accumulated += i;
        if(accumulated === size) {
            return false;
        }
    }
    return true;
}

function getInputValues() {
    //gets inputs
    triangleName = document.getElementById('triangle-name').value;
    var triangleValuesString = (document.getElementById('triangle-values').value).split(',');

    //validates name
    if(triangleName.length !== 0 && triangleName.length <= 30 && /^[a-zA-Z\s]+$/.test(triangleName)) {
        document.getElementById('name-warning').innerHTML = '';
        var valuesAreInvalid = false;
        //validates values' array size
        if(triangleLengthIsInvalid(triangleValuesString.length)) { 
            valuesAreInvalid = true;
        } else {
            for(var i=0;i<triangleValuesString.length;i++) {
                //validates values
                if(!(/^\d+$/.test(triangleValuesString[i])) || triangleValuesString[i] > 100 || triangleValuesString[i] < 0) {
                    valuesAreInvalid = true;
                    i = triangleValuesString.length;
                }
            }
        }
        if(valuesAreInvalid == false){
            document.getElementById('values-warning').innerHTML = '';
            triangleValues = triangleValuesString.map(Number);
            writeInputValues();
        } else {
            document.getElementById('values-warning').innerHTML = 'Os valores inseridos devem estar entre 0 e 100, e a quantidade de números deve ser estritamente 1, 3, 6, 10, 15, 21, 28, 36 ou 45. Separe os números por vírgula, sem espaços.'
        }
    } else {
        document.getElementById('name-warning').innerHTML = 'Nomes devem conter apenas letras e espaços, sem acentuação.\n';
    }
}

function writeInputValues(){
    var triName = triangleName;
    var triValues = triangleValues;
    document.getElementById('name-display').innerHTML = triName;
    document.getElementById('values-display').innerHTML = triValues;
}