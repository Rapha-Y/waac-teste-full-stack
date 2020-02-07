class Tree {
    constructor(input) { //still needs input validation
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

var newTreeA = new Tree([[2], [4, 5], [8, 5, 1]]);
var newTreeB = new Tree([[1], [1, 1], [1, 1, 1]]);
var newTreeC = new Tree([[6], [3, 5], [9, 7, 1], [4, 6, 8, 4]]);

newTreeA.getResolution();
newTreeB.getResolution();
newTreeC.getResolution();