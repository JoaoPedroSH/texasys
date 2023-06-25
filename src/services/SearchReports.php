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

        $sql_valor_general_balcao_T1 = "SELECT SUM(valor) AS valor_vendas FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte'  AND turno = '1' ";
        $valor_general_balcao_T1_response = $mysqli->query($sql_valor_general_balcao_T1)->fetch_assoc();
        $valor_general_balcao_T1 = floatval($valor_general_balcao_T1_response['valor_vendas']);
        $sql_valor_general_mesas_T1 = "SELECT SUM(valor) AS valor_vendas FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte'  AND turno = '1' ";
        $valor_general_mesas_T1_response = $mysqli->query($sql_valor_general_mesas_T1)->fetch_assoc();
        $valor_general_mesas_T1 = floatval($valor_general_mesas_T1_response['valor_vendas']);
        $receita_t1 = $valor_general_balcao_T1 + $valor_general_mesas_T1;

        $sql_valor_general_balcao_T2 = "SELECT SUM(valor) AS valor_vendas FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte'  AND turno = '2'  ";
        $valor_general_balcao_T2_response = $mysqli->query($sql_valor_general_balcao_T2)->fetch_assoc();
        $valor_general_balcao_T2 = floatval($valor_general_balcao_T2_response['valor_vendas']);
        $sql_valor_general_mesas_T2 = "SELECT SUM(valor) AS valor_vendas FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte'  AND turno = '2' ";
        $valor_general_mesas_T2_response = $mysqli->query($sql_valor_general_mesas_T2)->fetch_assoc();
        $valor_general_mesas_T2 = floatval($valor_general_mesas_T2_response['valor_vendas']);
        $receita_t2 = $valor_general_balcao_T2 + $valor_general_mesas_T2;

        $sql_valor_general_balcao_T3 = "SELECT SUM(valor) AS valor_vendas FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte'  AND turno = '3' ";
        $valor_general_balcao_T3_response = $mysqli->query($sql_valor_general_balcao_T3)->fetch_assoc();
        $valor_general_balcao_T3 = floatval($valor_general_balcao_T3_response['valor_vendas']);
        $sql_valor_general_mesas_T3 = "SELECT SUM(valor) AS valor_vendas FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte'  AND turno = '3' ";
        $valor_general_mesas_T3_response = $mysqli->query($sql_valor_general_mesas_T3)->fetch_assoc();
        $valor_general_mesas_T3 = floatval($valor_general_mesas_T3_response['valor_vendas']);
        $receita_t3 = $valor_general_balcao_T3 + $valor_general_mesas_T3;

        /* Lucro */
        $sql_lucro_general_balcao = "SELECT SUM(lucro) AS lucro_vendas FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' ";
        $lucro_general_balcao_response = $mysqli->query($sql_lucro_general_balcao)->fetch_assoc();
        $lucro_general_balcao = floatval($lucro_general_balcao_response['lucro_vendas']);
        $sql_lucro_general_mesas = "SELECT SUM(lucro) AS lucro_vendas FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' ";
        $lucro_general_mesas_response = $mysqli->query($sql_lucro_general_mesas)->fetch_assoc();
        $lucro_general_mesas = floatval($lucro_general_mesas_response['lucro_vendas']);
        $lucro =  $lucro_general_balcao + $lucro_general_mesas;

        $sql_lucro_general_balcao_T1 = "SELECT SUM(lucro) AS lucro_vendas FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' AND turno = '1' ";
        $lucro_general_balcao_T1_response = $mysqli->query($sql_lucro_general_balcao_T1)->fetch_assoc();
        $lucro_general_balcao_T1 = floatval($lucro_general_balcao_T1_response['lucro_vendas']);
        $sql_lucro_general_mesas_T1 = "SELECT SUM(lucro) AS lucro_vendas FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' AND turno = '1' ";
        $lucro_general_mesas_T1_response = $mysqli->query($sql_lucro_general_mesas_T1)->fetch_assoc();
        $lucro_general_mesas_T1 = floatval($lucro_general_mesas_T1_response['lucro_vendas']);
        $lucro_t1 =  $lucro_general_balcao_T1 + $lucro_general_mesas_T1;

        $sql_lucro_general_balcao_T2 = "SELECT SUM(lucro) AS lucro_vendas FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' AND turno = '2' ";
        $lucro_general_balcao_T2_response = $mysqli->query($sql_lucro_general_balcao_T2)->fetch_assoc();
        $lucro_general_balcao_T2 = floatval($lucro_general_balcao_T2_response['lucro_vendas']);
        $sql_lucro_general_mesas_T2 = "SELECT SUM(lucro) AS lucro_vendas FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' AND turno = '2' ";
        $lucro_general_mesas_T2_response = $mysqli->query($sql_lucro_general_mesas_T2)->fetch_assoc();
        $lucro_general_mesas_T2 = floatval($lucro_general_mesas_T2_response['lucro_vendas']);
        $lucro_t2 =  $lucro_general_balcao_T2 + $lucro_general_mesas_T2;

        $sql_lucro_general_balcao_T3 = "SELECT SUM(lucro) AS lucro_vendas FROM produtos_adicionados_balcao WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' AND turno = '3' ";
        $lucro_general_balcao_T3_response = $mysqli->query($sql_lucro_general_balcao_T3)->fetch_assoc();
        $lucro_general_balcao_T3 = floatval($lucro_general_balcao_T3_response['lucro_vendas']);
        $sql_lucro_general_mesas_T3 = "SELECT SUM(lucro) AS lucro_vendas FROM produtos_adicionados_mesas WHERE data_hora >= '$data_atual' AND data_hora <= '$data_seguinte' AND turno = '3' ";
        $lucro_general_mesas_T3_response = $mysqli->query($sql_lucro_general_mesas_T3)->fetch_assoc();
        $lucro_general_mesas_T3 = floatval($lucro_general_mesas_T3_response['lucro_vendas']);
        $lucro_t3 =  $lucro_general_balcao_T3 + $lucro_general_mesas_T3;

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

if ($turno == 0) {
    $response = array(
        'status' => $status,
        'data_inicio' => $data_atual,
        'data_final' => $data_seguinte,
        'receita' => $receita,
        'receita_t1' => $receita_t1,
        'receita_t2' => $receita_t2,
        'receita_t3' => $receita_t3,
        'lucro' => $lucro,
        'lucro_t1' => $lucro_t1,
        'lucro_t2' => $lucro_t2,
        'lucro_t3' => $lucro_t3,
        'produtos_dados' => $produtos_combinados
    );
} else {
    $response = array(
        'status' => $status,
        'data_inicio' => $data_atual,
        'data_final' => $data_seguinte,
        'receita' => $receita,
        'lucro' => $lucro,
        'produtos_dados' => $produtos_combinados
    );
}

header('Content-Type: application/json');
echo json_encode($response);