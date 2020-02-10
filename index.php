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

    $name = '';
    $numbers = '';

    console_log($name);
    console_log($numbers);
?>

<!DOCTYPE html>

<html lang='en'>
    <head>
        <title>
            Test
        </title>
    </head>
    <body>
        <div class='page-container'>
            <div class='image-divs-container'>
            
            </div>
            <div class='text-divs-container'>
                <div class='input-fields'>
                    <form action='index.php' method='get'>
                        Nome do Triângulo:
                        <input name='name' placeholder='Triangulo Exemplo' type='text'><br>
                        <div class='input-warning'>
                            <?php 
                                $name_validation = true;
                                $name = $_GET['name'];
                                if(strlen($name) == 0) {
                                    $name_validation = false;
                                    echo 'Este campo é obrigatório.';
                                } else if(strlen($name) > 50) {
                                    $name_validation = false;
                                    echo 'O nome deve conter menos de 50 caracteres.';
                                } else if(preg_match('/[^A-Za-z\s]/', $name)) {
                                    $name_validation = false;
                                    echo 'Apenas letras e espaços são permitidos.';
                                }
                            ?>
                        </div>
                        Valores do Triângulo: 
                        <input name='numbers' placeholder='1,2,3,4,5,6' type='text'><br>
                        <div class='input-warning'>
                            <?php
                                $numbers_validation = true;
                                $numbers = $_GET['numbers'];
                                if(strlen($numbers) == 0 || $numbers == '') {
                                    $numbers_validation = false;
                                    echo 'Este campo é obrigatório.';
                                } else {
                                    $num_array = explode(',',$numbers);
                                    foreach($num_array as $i => $num_value) {
                                        if(strlen($num_value) == 0 || $num_value == '') {
                                            $numbers_validation = false;
                                            echo 'Todos os números devem ser preenchidos.';
                                            break;
                                        } else if(!preg_match('/[0-9]/', $num_value)) {
                                            $numbers_validation = false;
                                            echo 'Apenas números são permitidos.';
                                            break;
                                        } else if(preg_match('/[\s]/', $num_value)) {
                                            $numbers_validation = false;
                                            echo 'Espaços não são permitidos.';
                                            break;
                                        } else if(strlen($num_value) > 2) {
                                            $numbers_validation = false;
                                            echo 'Apenas números entre 0 e 99.';
                                            break;
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <input type='submit'>
                        <?php 
                            if($name_validation == true && $numbers_validation == true) {
                                $conn = new mysqli($servername, $username, $password, $databasename);
                                if($conn->connect_error) {
                                    die('Conexão falhou: ' . $conn->connect_error);
                                }
                                $sql = 'INSERT INTO Triangle(name, numbers) VALUES(?, ?)';
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('ss', $name, $numbers);
                                $stmt->execute();
                                $conn->close();
                                echo 'Triângulo adicionado com sucesso!';
                            } else {
                                echo 'Preencha os campos corretamente.';
                            }
                        ?>
                    </form>
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
                                echo '<option>' . $row['name'] . '</option>';
                            }

                            $conn->close();
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </body>
</html>