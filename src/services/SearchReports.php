<?php

require '../../config/ConnectionDB.php';

$status = false;

if (isset($_POST['calendario']) && isset($_POST['turno'])) {
    $data = $_POST['calendario'];
    $turno = $_POST['turno'];
    $data_atual = date('Y-m-d 09:00:00', strtotime($data));
    $data_seguinte = date('Y-m-d 01:00:00', strtotime('+1 day', strtotime($data)));

    if ($turno == 0) {
        /* Receita */
        $sql_valor_general_balcao = "SELECT SUM(valor) AS valor_vendas FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' ";
        $valor_general_balcao_response = $mysqli->query($sql_valor_general_balcao)->fetch_assoc();
        $valor_general_balcao = floatval($valor_general_balcao_response['valor_vendas']);
        $sql_valor_general_mesas = "SELECT SUM(valor) AS valor_vendas FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' ";
        $valor_general_mesas_response = $mysqli->query($sql_valor_general_mesas)->fetch_assoc();
        $valor_general_mesas = floatval($valor_general_mesas_response['valor_vendas']);
        $receita = $valor_general_balcao + $valor_general_mesas;

        /* Lucro */
        $sql_lucro_general_balcao = "SELECT SUM(lucro) AS lucro_vendas FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' ";
        $lucro_general_balcao_response = $mysqli->query($sql_lucro_general_balcao)->fetch_assoc();
        $lucro_general_balcao = floatval($lucro_general_balcao_response['lucro_vendas']);
        $sql_lucro_general_mesas = "SELECT SUM(lucro) AS lucro_vendas FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' ";
        $lucro_general_mesas_response = $mysqli->query($sql_lucro_general_mesas)->fetch_assoc();
        $lucro_general_mesas = floatval($lucro_general_mesas_response['lucro_vendas']);
        $lucro =  $lucro_general_balcao + $lucro_general_mesas;

        /* Produtos */
        $get_produtos_balcao = "SELECT id_produto, quantidade, valor, lucro FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' ";
        $get_produtos_balcao_response = $mysqli->query($get_produtos_balcao);
        $produtos_balcao = array();
        while ($resposta_produtos_balcao = $get_produtos_balcao_response->fetch_assoc()) {
            $produtos_balcao[] = $resposta_produtos_balcao;
        }
        $get_produtos_mesas = "SELECT id_produto, quantidade, valor, lucro FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' ";
        $get_produtos_mesas_response = $mysqli->query($get_produtos_mesas);
        $produtos_mesas = array();
        while ($resposta_produtos_mesas = $get_produtos_mesas_response->fetch_assoc()) {
            $produtos_mesas[] = $resposta_produtos_mesas;
        }
        $produtos = array_merge($produtos_balcao, $produtos_mesas);

    } else {
        /* Receita */
        $sql_valor_general_balcao = "SELECT SUM(valor) AS valor_vendas FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' AND turno = '$turno' ";
        $valor_general_balcao_response = $mysqli->query($sql_valor_general_balcao)->fetch_assoc();
        $valor_general_balcao = floatval($valor_general_balcao_response['valor_vendas']);
        $sql_valor_general_mesas = "SELECT SUM(valor) AS valor_vendas FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' AND turno = '$turno' ";
        $valor_general_mesas_response = $mysqli->query($sql_valor_general_mesas)->fetch_assoc();
        $valor_general_mesas = floatval($valor_general_mesas_response['valor_vendas']);
        $receita = $valor_general_balcao + $valor_general_mesas;

        /* Lucro */
        $sql_lucro_general_balcao = "SELECT SUM(lucro) AS lucro_vendas FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' AND turno = '$turno' ";
        $lucro_general_balcao_response = $mysqli->query($sql_lucro_general_balcao)->fetch_assoc();
        $lucro_general_balcao = floatval($lucro_general_balcao_response['lucro_vendas']);
        $sql_lucro_general_mesas = "SELECT SUM(lucro) AS lucro_vendas FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' AND turno = '$turno' ";
        $lucro_general_mesas_response = $mysqli->query($sql_lucro_general_mesas)->fetch_assoc();
        $lucro_general_mesas = floatval($lucro_general_mesas_response['lucro_vendas']);
        $lucro =  $lucro_general_balcao + $lucro_general_mesas;

        /* Produtos */
        $get_produtos_balcao = "SELECT id_produto, quantidade, valor, lucro FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' AND turno = '$turno' ";
        $get_produtos_balcao_response = $mysqli->query($get_produtos_balcao);
        $produtos_balcao = array();
        while ($resposta_produtos_balcao = $get_produtos_balcao_response->fetch_assoc()) {
            $produtos_balcao[] = $resposta_produtos_balcao;
        }
        $get_produtos_mesas = "SELECT id_produto, quantidade, valor, lucro FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' AND turno = '$turno' ";
        $get_produtos_mesas_response = $mysqli->query($get_produtos_mesas);
        $produtos_mesas = array();
        while ($resposta_produtos_mesas = $get_produtos_mesas_response->fetch_assoc()) {
            $produtos_mesas[] = $resposta_produtos_mesas;
        }
        $produtos = array_merge($produtos_balcao, $produtos_mesas);
    }

    $produtos_combinados = array();
    foreach ($produtos as $produto) {
        $id_produto = $produto['id_produto'];
        if (isset($produtos_combinados[$id_produto])) {
            $produtos_combinados[$id_produto]['quantidade'] += $produto['quantidade'];
            $produtos_combinados[$id_produto]['valor'] += $produto['valor'];
            $produtos_combinados[$id_produto]['lucro'] += $produto['lucro'];
        } else {
            $produtos_combinados[$id_produto] = $produto;
        }
    }
    $produtos_combinados = array_values($produtos_combinados);

    if (empty($produtos_combinados)) {
        $status = false;
    } else {
        $status = true;
    }
}

header('Content-Type: application/json');
$response = array(
    'status' => $status,
    'data_inicio' => $data_atual,
    'data_final' => $data_seguinte,
    'receita' => $receita,
    'lucro' => $lucro,
    'produtos_dados' => $produtos_combinados
);
echo json_encode($response);