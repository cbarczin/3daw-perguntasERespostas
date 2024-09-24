<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Perguntas</title>
</head>
<body>
<?php
$msg = ""; // Inicializa a mensagem

$pergAlterar = isset($_GET["pergAlterar"]) ? $_GET["pergAlterar"] : '';
$novaPerg = isset($_GET["novaPerg"]) ? $_GET["novaPerg"] : '';
$respostaCerta = isset($_GET["respostaCerta"]) ? $_GET["respostaCerta"] : '';
$alternativa2 = isset($_GET["alternativa2"]) ? $_GET["alternativa2"] : '';
$alternativa3 = isset($_GET["alternativa3"]) ? $_GET["alternativa3"] : '';
$alternativa4 = isset($_GET["alternativa4"]) ? $_GET["alternativa4"] : '';

    $arqDisc = fopen("pergEResps.txt", "r") or die("Erro ao abrir arquivo");
    $arqDiscNovo = fopen("pergEResps_novo.txt", "w") or die("Erro ao abrir arquivo"); 
    
    $encontrou = false; 
    
    while (!feof($arqDisc)) {
        $linha = fgets($arqDisc);
        $colunaDados = explode(";", $linha);

        if (isset($colunaDados[0]) && trim($colunaDados[0]) == $pergAlterar) {
            $linha = $novaPerg . ";" . $respostaCerta . ";" . $alternativa2 . ";" . $alternativa3 . ";" . $alternativa4 . "\n";
            $encontrou = true; 
        }

        fwrite($arqDiscNovo, $linha); 
    }
    
    fclose($arqDisc);
    fclose($arqDiscNovo);

    rename("pergEResps_novo.txt", "pergEResps.txt");

?>
    <main>
    <h3>Informe abaixo as informações necessárias para alterar as perguntas do sistema.</h3>
    <form action="<?=$_SERVER["PHP_SELF"]?>">
        <label for="pergAlterar">Qual pergunta será alterada?: </label>
        <input type="text" name="pergAlterar" id="pergAlterar">
        <br><br>
        <label for="novaPerg">E qual será a nova pergunta?: </label>
        <input type="text" name="novaPerg" id="novaPerg">
        <br><br>
        <label for="respostaCerta">Qual é a sua resposta certa?: </label>
        <input type="text" name="respostaCerta" id="respostaCerta">
        <br>
        <label for="alternativa2">Alternativa 2: </label>
        <input type="text" name="alternativa2" id="alternativa2">
        <br>
        <label for="alternativa">Alternativa 3: </label>
        <input type="text" name="alternativa3" id="alternativa3">
        <br>
        <label for="alternativa">Alternativa 4:</label>
        <input type="text" name="alternativa4" id="alternativa4">
        <br><br>
        <input type="submit" value="Alterar Pergunta">
        <p><a href="./home.html">Voltar</a></p>
    </form>
    </main>
</body>
</html>