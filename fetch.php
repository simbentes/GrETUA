<?php 
$link = new_db_connection();
$output = '';
$sql = "SELECT * FROM eventos WHERE nome LIKE '%".$_POST["pesquisa"]."%'";
$result = mysqli_query($link, $sql);
if(mysqli_num_rows($result) >0){
    $output .= '<h4 align="center"> Resultado da pesquisa</h4>';
    while($row = mysqli_fetch_array($result)){
        $output .= '<h4 align="center">'.$row["nome"]'</h4>';
    }
    echo $output;
}else{
    echo 'Sem resultado';
}
?>