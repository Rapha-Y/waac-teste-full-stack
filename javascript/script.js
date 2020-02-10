class Tree {
    constructor(input) { 
        var newNode = new Node(input, 0, 0); //constructs tree by recursion
        this.root = newNode;
        this.maxSum = newNode.getMaxSum();
        this.maxPath = newNode.getMaxPath();
    }
    getResolution() {
        //early test - to be deleted
        console.log("The maximum sum is " + this.maxSum + "\n");
        console.log("The maximum paths are \n");
        var i;
        for(i=0;i<this.maxPath.length;i++) {
            console.log("Path #" + (i+1) + ": " + this.maxPath[i] + "\n");
        }
    }
}

class Node {
    constructor(list, level, position) {
        this.value = list[level][position];

        var leftChild; 
        var rightChild;
        if(level < list.length-1) {
            //children will always be one level below,
            //the left one in the same position in the next array, the right one in the next position
            leftChild = new Node(list, level+1, position);
            rightChild = new Node(list, level+1, position+1);
        } else {
            //leaves have no children
            leftChild = null;
            rightChild = null;
        }
        this.left = leftChild;
        this.right = rightChild;
        
        var sum;
        var path;
        if(level == list.length-1) { 
            sum = this.value;
            path = [[]];
        } else { 
            var i;
            if(this.left.getMaxSum() > this.right.getMaxSum()) {
                sum = this.left.getMaxSum() + this.value;
                path = this.left.getMaxPath();
                //direction to which the max sum is must be added onto all possible paths
                for(i=0;i<path.length;i++) {
                    path[i].unshift('L');
                }
            } else if(this.left.getMaxSum() < this.right.getMaxSum()) {
                sum = this.right.getMaxSum() + this.value;
                path = this.right.getMaxPath();
                for(i=0;i<path.length;i++) {
                    path[i].unshift('R');
                }
            } else {
                sum = this.left.getMaxSum() + this.value; //could be right as well
                //since either path can be taken, we need to update both sides' directions accordingly
                var leftPath = this.left.getMaxPath();
                for(i=0;i<leftPath.length;i++) {
                    leftPath[i].unshift('L');
                }
                var rightPath = this.right.getMaxPath();
                for(i=0;i<rightPath.length;i++) {
                    rightPath[i].unshift('R');
                }
                path = (leftPath).concat(rightPath);
            }
        }
        this.maxSum = sum;
        this.maxPath = path;
    }
    getMaxSum() {
        return this.maxSum;
    }
    getMaxPath() {
        return this.maxPath;
    }
}

function maxTriangleArraySize(baseSize) {
    var maxSize=0;
    for(var i=1;i<=baseSize;i++) {
        maxSize += i;
    }
    return maxSize;
}

function updateTriangleDisplay(numbers) {
    var num_array = numbers.split(',');
    
    var i;
    var idName;
    for(i=0;i<num_array.length;i++) {
        idName = 'display-' + i.toString();
        document.getElementById(idName).innerHTML = num_array[i];
    }
    while(i<maxTriangleArraySize(10)){
        idName = 'display-' + i.toString();
        document.getElementById(idName).innerHTML = '';
        i++;
    }
}

//delete after push - made just for testing
function showTemps() {
    var aux = document.getElementById('triangle-attributes').value;
    console.log(aux);
    var auxi = aux.split('|');
    document.getElementById('temp-display-1').innerHTML = auxi[0];
    document.getElementById('temp-display-2').innerHTML = auxi[1];
}