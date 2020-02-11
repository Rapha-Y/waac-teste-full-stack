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

<html lang='pt'>
    <head>
        <title>
            Test
        </title>
        <link href='./styles/styles.css' rel='stylesheet' type='text/css'>
        <script src='./javascript/script.js'></script>
    </head>
    <body>
        <div class='page-container'>
            <div class='image-divs-container'>
                <div class='triangle-display'>
                    <table>
                        <!--
                            there's probably an automatic way to fill this table with divs.
                            to be revisited if enough time is left
                        -->
                        <tr>
                            <td><div id='display-0'></div></td>
                        </tr>
                        <tr>
                            <td><div id='display-1'></div></td>
                            <td><div id='display-2'></div></td>
                        </tr>
                        <tr>
                            <td><div id='display-3'></div></td>
                            <td><div id='display-4'></div></td>
                            <td><div id='display-5'></div></td>
                        </tr>
                        <tr>
                            <td><div id='display-6'></div></td>
                            <td><div id='display-7'></div></td>
                            <td><div id='display-8'></div></td>
                            <td><div id='display-9'></div></td>
                        </tr>
                        <tr>
                            <td><div id='display-10'></div></td>
                            <td><div id='display-11'></div></td>
                            <td><div id='display-12'></div></td>
                            <td><div id='display-13'></div></td>
                            <td><div id='display-14'></div></td>
                        </tr>
                        <tr>
                            <td><div id='display-15'></div></td>
                            <td><div id='display-16'></div></td>
                            <td><div id='display-17'></div></td>
                            <td><div id='display-18'></div></td>
                            <td><div id='display-19'></div></td>
                            <td><div id='display-20'></div></td>
                        </tr>
                        <tr>
                            <td><div id='display-21'></div></td>
                            <td><div id='display-22'></div></td>
                            <td><div id='display-23'></div></td>
                            <td><div id='display-24'></div></td>
                            <td><div id='display-25'></div></td>
                            <td><div id='display-26'></div></td>
                            <td><div id='display-27'></div></td>
                        </tr>
                        <tr>
                            <td><div id='display-28'></div></td>
                            <td><div id='display-29'></div></td>
                            <td><div id='display-30'></div></td>
                            <td><div id='display-31'></div></td>
                            <td><div id='display-32'></div></td>
                            <td><div id='display-33'></div></td>
                            <td><div id='display-34'></div></td>
                            <td><div id='display-35'></div></td>
                        </tr>
                        <tr>
                            <td><div id='display-36'></div></td>
                            <td><div id='display-37'></div></td>
                            <td><div id='display-38'></div></td>
                            <td><div id='display-39'></div></td>
                            <td><div id='display-40'></div></td>
                            <td><div id='display-41'></div></td>
                            <td><div id='display-42'></div></td>
                            <td><div id='display-43'></div></td>
                            <td><div id='display-44'></div></td>
                        </tr>
                        <tr>
                            <td><div id='display-45'></div></td>
                            <td><div id='display-46'></div></td>
                            <td><div id='display-47'></div></td>
                            <td><div id='display-48'></div></td>
                            <td><div id='display-49'></div></td>
                            <td><div id='display-50'></div></td>
                            <td><div id='display-51'></div></td>
                            <td><div id='display-52'></div></td>
                            <td><div id='display-53'></div></td>
                            <td><div id='display-54'></div></td>
                        </tr>
                    </table>
                </div>
                <div class='tree-display'></div>
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
                        <input name='numbers' placeholder='[[1],[2,3],[4,5,6]]' type='text'><br>
                        <div class='input-warning'>
                            <?php
                                $numbers_validation = true;
                                $numbers = $_GET['numbers'];
                                if(strlen($numbers) == 0 || $numbers == '') {
                                    $numbers_validation = false;
                                    echo 'Este campo é obrigatório.';
                                } else {
                                    $num_array = explode('],[', $numbers);
                                    $num_array[0] = trim($num_array[0], '[[');
                                    $num_array[sizeof($num_array)-1] = trim($num_array[sizeof($num_array)-1], ']]');
                                    for($i=0;$i<sizeof($num_array);$i++) {
                                        $num_array[$i] = explode(',', $num_array[$i]);
                                    }
                                    if(sizeof($num_array) > 5) {
                                        console_log(sizeof($num_array));
                                        $numbers_validation = false;
                                        echo 'A base do triângulo deve conter no máximo 5 números.';
                                    } else {
                                        for($i=0;$i<sizeof($num_array);$i++) {
                                            if(sizeof($num_array[$i]) != $i+1) {
                                                $numbers_validation = false;
                                                echo 'O topo do triângulo deve começar com valor único, incrementando de um em um nas próxima seções.';
                                                break;
                                            }
                                            for($j=0;$j<sizeof($num_array[$i]);$j++) {
                                                if(strlen($num_array[$i][$j]) == 0 || $num_array[$i][$j] == '') {
                                                    $numbers_validation = false;
                                                    echo 'Todos os números devem ser preenchidos.';
                                                    break 2;
                                                } else if(!preg_match('/[0-9]/', $num_array[$i][$j])) {
                                                    $numbers_validation = false;
                                                    echo 'Apenas números são permitidos.';
                                                    break 2;
                                                } else if(preg_match('/[\s]/', $num_array[$i][$j])) {
                                                    $numbers_validation = false;
                                                    echo 'Espaços não são permitidos.';
                                                    break 2;
                                                } else if(strlen($num_array[$i][$j]) > 1) {
                                                    $numbers_validation = false;
                                                    echo 'Apenas números entre 0 e 9.';
                                                    break 2;
                                                }
                                            }
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
                    <select id='triangle-attributes' onchange='updateTriangleDisplay();' multiple='multiple' size='10'>
                        <?php
                            $conn = new mysqli($servername, $username, $password, $databasename);
                        
                            if($conn->connect_error) {
                                die('Connection failed: ' . $conn->connect_error);
                            }

                            $sql = 'SELECT * FROM Triangle';
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                                echo '<option value=' . $row['numbers'] . '>' . $row['name'] . '</option>';
                            }

                            $conn->close();
                        ?>
                    </select><br>
                    <button onclick='createNewTree();'>Gerar Solução</button>
                    <div id='selection-warning' class='selection-warning'></div>
                </div>
                <div class='info-field'></div>
            </div>
        </div>
    </body>
</html>