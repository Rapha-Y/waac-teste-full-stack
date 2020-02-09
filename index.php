<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = 'password';
    $databasename = 'triangle_db';

    $conn = new mysqli($servername, $username, $password, $databasename);

    if($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    /*
    delete after push - for progress tracking only

    $sql = 'INSERT INTO Triangle(triangle_name) VALUES("Test Triangle 2")';
    if($conn->query($sql) === TRUE) {
        echo 'Insertion done, check it';
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }
    */

    $sql = 'SELECT * FROM Triangle';
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo 'id: ' . $row['triangle_id']. ', name: ' . $row['triangle_name'] . ', root: ' . $row['root_id']. '<br>';
        }
    } else {
        echo 'nothing in there';
    }

    $conn->close();
?>

<!DOCTYPE html>

<html lang='en'>
    <head>
        <title>
            Test
        </title>
        <script type='text/javascript' src='./components/input-handler.js'></script>
    </head>
    <body>
        <div class='creation-container'>
            <div class='input-display'>
                <div id='name-display'></div>
                <div id='values-display'></div>
            </div>
            <div class='input-fields'>
                Nome do Triângulo: 
                <input 
                    id='triangle-name' 
                    name='triangle-name'
                    placeholder='Triangulo Exemplo' 
                    type='text'
                    value=''
                ><br>
                Valores do Triângulo: 
                <input 
                    id='triangle-values'  
                    placeholder='1,2,3,3,2,1' 
                    type='text'
                    value=''
                ><br>
                <button name='confirm-button' onclick='getInputValues();' type='button'>
                    Adicionar ao banco de dados
                </button>
            </div>
        </div>
    </body>
</html>