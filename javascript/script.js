var trueSolution = [];

class SolutionItem {
    constructor(value, sum, method, timerStart) {
        this.value = value;
        this.sum = sum;
        this.method = method;
        var timerEnd = performance.now();
        this.time = timerEnd-timerStart;
    }
}

function clearAllInfo() {
    trueSolution = [];
    for(i=0;i<maxTriangleArraySize(5);i++) {
        var id = 'sum-display-' + i;
        document.getElementById(id).innerHTML = '';
    }
}

function updateSecTriangleDisplay(solution) {
    var i;
    for(i=0;i<solution.length;i++) {
        var id = 'sum-display-' + i;
        document.getElementById(id).innerHTML = solution[i].sum + '<br>(' + (solution[i].sum-solution[i].value) + '+' + solution[i].value + ')';
    }
    while(i<maxTriangleArraySize(5)) {
        solution.push(null);
        var id = 'sum-display-' + i;
        document.getElementById(id).innerHTML = '';
        i++;
    }
}

function solveProblem(problem) {
    var timerStart = performance.now();
    var solution = [];
    for(var i=problem.length-1;i>=0;i--) {
        var solutionInner = [];
        for(var j=0;j<problem[i].length;j++) {
            var sum;
            var method;
            if(i == problem.length-1) {
                sum = 0;
                method = 'none';
            } else if (solution[0][j].sum > solution[0][j+1].sum) {
                sum = solution[0][j].sum;
                method = 'left';
            } else if (solution[0][j].sum < solution[0][j+1].sum) {
                sum = solution[0][j+1].sum;
                method = 'right';
            } else {
                sum = solution[0][j].sum;
                method = 'either';
            }
            var newSolutionItem = new SolutionItem(problem[i][j], problem[i][j]+sum, method, timerStart)
            solutionInner.push(newSolutionItem);
        }
        solution.unshift(solutionInner);
    }
    var simpleSol = [];
    for(var i=0;i<solution.length;i++) {
        for(var j=0;j<solution[i].length;j++) {
            simpleSol.push(solution[i][j]);
        }
    }
    updateSecTriangleDisplay(simpleSol);
    trueSolution = simpleSol;
}

function getSolution() {
    var allValues = document.getElementById('triangle-attributes').value;
    if(allValues == '') {
        document.getElementById('info-text').innerHTML = 'Selecione um triângulo primeiro.'
    } else {
        var splitString = allValues.split('],[');
        splitString[0] = splitString[0].replace('[[', '');
        splitString[splitString.length-1] = splitString[splitString.length-1].replace(']]', '');
        
        var secondSplit = [];
        for(var i=0;i<splitString.length;i++) {
            secondSplit.push(splitString[i].split(',').map(Number));
        }
    }
    solveProblem(secondSplit);
}

function maxTriangleArraySize(baseSize) {
    var maxSize=0;
    for(var i=1;i<=baseSize;i++) {
        maxSize += i;
    }
    return maxSize;
}

function updateTriangleDisplay() {
    var numberArray = document.getElementById('triangle-attributes').value;
    var simpleArray = numberArray.replace(/[\[\]']+/g,'');
    var splitArray = simpleArray.split(',');

    var i;
    var idName;
    for(i=0;i<splitArray.length;i++) {
        idName = 'display-' + i.toString();
        document.getElementById(idName).innerHTML = splitArray[i];
    }
    while(i<maxTriangleArraySize(5)){
        idName = 'display-' + i.toString();
        document.getElementById(idName).innerHTML = '';
        i++;
    }
}

function updateNodeStats(id) {
    if(trueSolution.length == 0){
        document.getElementById('info-text').innerHTML = 'Gere uma solução primeiro.';
    } else if(trueSolution[id] == null) {
        document.getElementById('info-text').innerHTML = 'Clique em um componente com valores.';
    } else {
        var nodeValue = trueSolution[id].value;
        var nodeSum = trueSolution[id].sum;
        var nodeMethod;
        if(trueSolution[id].method == 'none') {
            nodeMethod = 'Nenhum, o valor pertence à base do triângulo.';
        } else if(trueSolution[id].method == 'left') {
            nodeMethod = 'Esquerda, por onde pode se obter soma maior.';
        } else if(trueSolution[id].method == 'right') {
            nodeMethod = 'Direita, por onde pode se obter soma maior.';
        } else if(trueSolution[id].method == 'either') {
            nodeMethod = 'Esquerda, porém a direita leva a uma mesma soma.';
        }
        var nodeTime = trueSolution[id].time;
        document.getElementById('info-text').innerHTML = 'Valor original: ' + nodeValue + '<br>Soma máxima: ' + nodeSum + '<br>Método escolhido: ' + nodeMethod + '<br>Tempo de execução: ' + nodeTime;
    }
}