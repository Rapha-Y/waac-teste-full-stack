var triangleName;
var triangleValues;

function getInputValues() {
    triangleName = document.getElementById('triangle-name').value;
    var triangleValuesString = (document.getElementById('triangle-values').value).split(',');
    triangleValues = triangleValuesString.map(Number);
    writeInputValues();
}

function writeInputValues(){
    var triName = triangleName;
    var triValues = triangleValues;
    document.getElementById('name-display').innerHTML = triName;
    document.getElementById('values-display').innerHTML = triValues;
}