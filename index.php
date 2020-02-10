<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = 'password';
    $databasename = 'triangle_db';

    function console_log($data){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }
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
        <div class='image-divs-container'>
        
        </div>
        <div class='text-divs-container'>
            <div class='input-fields'>
                Nome do Triângulo: 
                <input 
                    id='triangle-name' 
                    name='triangle-name'
                    placeholder='Triangulo Exemplo' 
                    type='text'
                    value=''
                ><br>
                <div id='name-warning'></div>
                Valores do Triângulo: 
                <input 
                    id='triangle-values'  
                    placeholder='1,2,3,3,2,1' 
                    type='text'
                    value=''
                ><br>
                <div id='values-warning'></div>
                <button name='confirm-button' onclick='getInputValues();' type='button'>
                    Verificar
                </button>
            </div>
            <div class='selection-field'>
                <select multiple='multiple' size='10'>
                    <?php
                        $conn = new mysqli($servername, $username, $password, $databasename);
                    
                        if($conn->connect_error) {
                            die('Connection failed: ' . $conn->connect_error);
                        }

                        $sql = 'SELECT * FROM Triangle';
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                            echo '<option>' . $row['triangle_name'] . '</option>';
                        }

                        $conn->close();
                    ?>
                </select>
            </div>
        </div>
        <div class='to-be-deleted-container'>
            <div class='input-display'>
                <div id='name-display'></div>
                <div id='values-display'></div>
            </div>
        </div>
    </body>
</html>