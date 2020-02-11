var problemTree;

function maxTreeSize(baseSize) {
    var maxSize=Math.pow(2,baseSize);
    return maxSize;
}

function clearTreeDisplay() {
    for(var i=0;i<maxTreeSize(5)-1;i++) {
        var nodeId = 'node-' + i;
        document.getElementById(nodeId).innerHTML = '';
    }
}

function updateNodeDisplay(node) {
    var nodeId = 'node-' + node.getId();
    document.getElementById(nodeId).innerHTML = node.getMaxSum();
    if(node.getLeft() != null) {
        updateNodeDisplay(node.getLeft());
    }
    if(node.getRight() != null) {
        updateNodeDisplay(node.getRight());
    }
}

function updateTreeDisplay(tree) {
    clearTreeDisplay();
    updateNodeDisplay(tree.getRoot());
}

function createNewTree() {
    var allValues = document.getElementById('triangle-attributes').value;
    if(allValues == '') {
        document.getElementById('selection-warning').innerHTML = 'Selecione um triângulo.'
    } else {
        var splitString = allValues.split('],[');
        splitString[0] = splitString[0].replace('[[', '');
        splitString[splitString.length-1] = splitString[splitString.length-1].replace(']]', '');
        
        var secondSplit = [];
        for(var i=0;i<splitString.length;i++) {
            secondSplit.push(splitString[i].split(',').map(Number));
        }
        problemTree = new Tree(secondSplit);
        updateTreeDisplay(problemTree);
    }
}

class Tree {
    constructor(input) {
        var newNode = new Node(input, 0, 0, 0, 0); //constructs tree by recursion
        this.root = newNode;
    }
    getRoot() {
        return this.root;
    }
}

class Node {
    constructor(list, level, position, passedId, treePosition) {
        var timerStart = performance.now();
        this.id = passedId;
        this.value = list[level][position];

        var leftChild; 
        var rightChild;
        if(level < list.length-1) {
            //children will always be one level below,
            //the left one in the same position in the next array, the right one in the next position
            leftChild = new Node(list, level+1, position, passedId+Math.pow(2,level)+treePosition, 2*treePosition);
            rightChild = new Node(list, level+1, position+1, passedId+Math.pow(2,level)+treePosition+1, 2*treePosition+1);
        } else {
            //leaves have no children
            leftChild = null;
            rightChild = null;
        }
        this.left = leftChild;
        this.right = rightChild;
        
        var sum;
        if(level == list.length-1) { 
            sum = this.value;
            this.method = 'none';
        } else { 
            var i;
            if(this.left.getMaxSum() > this.right.getMaxSum()) {
                sum = this.left.getMaxSum() + this.value;
                this.method = 'left';
            } else if(this.left.getMaxSum() < this.right.getMaxSum()) {
                sum = this.right.getMaxSum() + this.value;
                this.method = 'right';
            } else {
                sum = this.left.getMaxSum() + this.value; //could be right as well
                this.method = 'either';
            }
        }
        this.maxSum = sum;
        var timerEnd = performance.now();
        this.time = timerEnd-timerStart;
    }
    getId () {
        return this.id;
    }
    getValue() {
        return this.value;
    }
    getMaxSum() {
        return this.maxSum;
    }
    getTime() {
        return this.time;
    }
    getMethod() {
        return this.method;
    }
    getLeft() {
        return this.left;
    }
    getRight() {
        return this.right;
    }
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