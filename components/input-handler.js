function getInputValues() {
    var triangleName = document.getElementById('triangle-name').value;
    var triangleValuesString = (document.getElementById('triangle-values').value).split(',');
    var triangleValues = triangleValuesString.map(Number);
    console.log(triangleName);
    console.log(triangleValues);
}