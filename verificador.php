<?php
$transicoes = file("gramatica.txt", FILE_IGNORE_NEW_LINES);

$pilha = array("Vazia");
$estado = "q";
$entrada = $_POST["entrada"];
$split = explode(" ", $entrada);

foreach ($split as $palavra) {
    $encontrouTransicao = false;
    foreach ($transicoes as $transicao) {
        $splitTransicao = explode(",", $transicao);
        if ($splitTransicao[0] === $estado && $splitTransicao[1] === $palavra && $splitTransicao[2] === end($pilha)) {
            $encontrouTransicao = true;
            $estado = $splitTransicao[3];
            if (strlen($splitTransicao[4]) > 1) {
                $splitdosplit = str_split($splitTransicao[4]);
                for ($i = 0; $i < count($splitdosplit) - 1; $i++) {
                    array_push($pilha, $splitdosplit[$i + 1]);
                }
            } else {
                array_pop($pilha);
                if ($splitTransicao[4] !== "e") {
                    array_push($pilha, $splitTransicao[4]);
                }
            }
            break;
        }
    }
    if (!$encontrouTransicao) {
        break;
    }
}

$resultado = end($pilha) === "Vazia" && $estado === "q" ? "Aceita" : "Não Aceita";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resultado</title>
</head>
<body>
    <h1>Resultado</h1>
    <p>Pilha: <?php echo implode(",", $pilha); ?></p>
    <p><?php echo $resultado; ?></p>
    <button><a href="index.php">Voltar</button>
</body>
</html>
