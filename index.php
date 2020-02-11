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
                <!-- PHP can probably write both displays better, rewrite if possible -->
                <div class='triangle-display'>
                    <div class='triangle-display-row'>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-0'></div></div>
                    </div>
                    <div class='triangle-display-row'>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-1'></div></div>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-2'></div></div>
                    </div>
                    <div class='triangle-display-row'>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-3'></div></div>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-4'></div></div>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-5'></div></div>
                    </div>
                    <div class='triangle-display-row'>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-6'></div></div>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-7'></div></div>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-8'></div></div>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-9'></div></div>
                    </div>
                    <div class='triangle-display-row'>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-10'></div></div>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-11'></div></div>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-12'></div></div>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-13'></div></div>
                        <div class='triangle-display-item'><div class='triangle-text' id='display-14'></div></div>
                    </div>
                </div>
                <div class='triangle-display'>
                <div class='triangle-display-row'>
                    <div class='triangle-display-item' onclick='updateNodeStats(0);'><div class='sec-triangle-text' id='sum-display-0'></div></div>
                    </div>
                    <div class='triangle-display-row'>
                        <div class='triangle-display-item' onclick='updateNodeStats(1);'><div class='sec-triangle-text' id='sum-display-1'></div></div>
                        <div class='triangle-display-item' onclick='updateNodeStats(2);'><div class='sec-triangle-text' id='sum-display-2'></div></div>
                    </div>
                    <div class='triangle-display-row'>
                        <div class='triangle-display-item' onclick='updateNodeStats(3);'><div class='sec-triangle-text' id='sum-display-3'></div></div>
                        <div class='triangle-display-item' onclick='updateNodeStats(4);'><div class='sec-triangle-text' id='sum-display-4'></div></div>
                        <div class='triangle-display-item' onclick='updateNodeStats(5);'><div class='sec-triangle-text' id='sum-display-5'></div></div>
                    </div>
                    <div class='triangle-display-row'>
                        <div class='triangle-display-item' onclick='updateNodeStats(6);'><div class='sec-triangle-text' id='sum-display-6'></div></div>
                        <div class='triangle-display-item' onclick='updateNodeStats(7);'><div class='sec-triangle-text' id='sum-display-7'></div></div>
                        <div class='triangle-display-item' onclick='updateNodeStats(8);'><div class='sec-triangle-text' id='sum-display-8'></div></div>
                        <div class='triangle-display-item' onclick='updateNodeStats(9);'><div class='sec-triangle-text' id='sum-display-9'></div></div>
                    </div>
                    <div class='triangle-display-row'>
                        <div class='triangle-display-item' onclick='updateNodeStats(10);'><div class='sec-triangle-text' id='sum-display-10'></div></div>
                        <div class='triangle-display-item' onclick='updateNodeStats(11);'><div class='sec-triangle-text' id='sum-display-11'></div></div>
                        <div class='triangle-display-item' onclick='updateNodeStats(12);'><div class='sec-triangle-text' id='sum-display-12'></div></div>
                        <div class='triangle-display-item' onclick='updateNodeStats(13);'><div class='sec-triangle-text' id='sum-display-13'></div></div>
                        <div class='triangle-display-item' onclick='updateNodeStats(14);'><div class='sec-triangle-text' id='sum-display-14'></div></div>
                    </div>
                </div>
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
                    <select id='triangle-attributes' onchange='updateTriangleDisplay(); clearAllInfo(); updateNodeStats(null);' multiple='multiple' size='10'>
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
                    <button onclick='getSolution(); updateNodeStats(null);'>Gerar Solução</button>
                </div>
                <div class='info-field'><div class='info-text' id='info-text'></div></div>
            </div>
        </div>
    </body>
</html>