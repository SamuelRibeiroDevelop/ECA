<?php

require_once "db/connection.php";
require_once "classes/peti.php";

class petiDAO
{

    public function remover($peti)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM tb_peti WHERE id_peti = :id");
            $statement->bindValue(":id", $peti->getIdPeti());
            if ($statement->execute()) {
                return "<script> alert('Registo foi excluído com êxito !'); </script>";
            } else {
                throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function salvar($peti)
    {
        global $pdo;
        try {
            if ($peti->getIdPeti() != "") {
                $statement = $pdo->prepare("UPDATE tb_peti SET str_month=:str_month, str_year=:str_year, str_situacao=:str_situacao, db_value_portion=:db_value_portion, tb_beneficiaries_id_beneficiaries=:tb_beneficiaries_id_beneficiaries, tb_city_id_city=:tb_city_id_city WHERE id_peti = :id;");
                $statement->bindValue(":id", $peti->getIdPeti());
            } else {
                $statement = $pdo->prepare("INSERT INTO tb_peti (str_month, str_year, str_situacao, db_value_portion, tb_beneficiaries_id_beneficiaries, tb_city_id_city) VALUES (:str_month, :str_year, :str_situacao, :db_value_portion, :tb_beneficiaries_id_beneficiaries, :tb_city_id_city)");
            }
            $statement->bindValue(":str_month", $peti->getStrMonth());
            $statement->bindValue(":str_year", $peti->getStrYear());
            $statement->bindValue(":str_situacao", $peti->getStrSituacao());
            $statement->bindValue(":db_value_portion", $peti->getDbValuePortion());
            $statement->bindValue(":tb_beneficiaries_id_beneficiaries", $peti->getTbBeneficiariesIdBeneficiaries());
            $statement->bindValue(":tb_city_id_city", $peti->getTbCityIdCity());

            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    return "<script> alert('Dados cadastrados com sucesso !'); </script>";
                } else {
                    return "<script> alert('Erro ao tentar efetivar cadastro !'); </script>";
                }
            } else {
                throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function atualizar($peti)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT id_peti, str_month, str_year, str_situacao, db_value_portion, tb_beneficiaries_id_beneficiaries, tb_city_id_city FROM tb_peti WHERE id_peti = :id");
            $statement->bindValue(":id", $peti->getIdPeti());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $peti->setIdPeti($rs->int_id);
                $peti->setStrMonth($rs->str_month);
                $peti->setStrYear($rs->str_year);
                $peti->setStrSituacao($rs->str_situacao);
                $peti->setDbValuePortion($rs->db_value_portion);
                $peti->setTbBeneficiariesIdBeneficiaries($rs->tb_beneficiaries_id_beneficiaries);
                $peti->setTbCityIdCity($rs->tb_city_id_city);

                return $peti;
            } else {
                throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function tabelapaginada()
    {

        //carrega o banco
        global $pdo;

        //endereço atual da página
        $endereco = $_SERVER ['PHP_SELF'];

        /* Constantes de configuração */
        define('QTDE_REGISTROS', 10);
        define('RANGE_PAGINAS', 2);

        /* Recebe o número da página via parâmetro na URL */
        $pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

        /* Calcula a linha inicial da consulta */
        $linha_inicial = ($pagina_atual - 1) * QTDE_REGISTROS;

        /* Instrução de consulta para paginação com MySQL */
        $sql = "SELECT P.id_peti, P.str_month, P.str_year, P.str_situacao, P.db_value_portion, 
        B.str_nis, B.str_name_person, S.str_uf,
        C.str_name_city, C.str_cod_siafi_city FROM tb_peti P 
        INNER JOIN tb_city C ON P.tb_city_id_city = C.id_city INNER JOIN tb_beneficiaries B ON P.tb_beneficiaries_id_beneficiaries = B.id_beneficiaries
        INNER JOIN tb_state S ON S.id_state = C.tb_state_id_state 
        LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM tb_peti";
        $statement = $pdo->prepare($sqlContador);
        $statement->execute();
        $valor = $statement->fetch(PDO::FETCH_OBJ);

        /* Idêntifica a primeira página */
        $primeira_pagina = 1;

        /* Cálcula qual será a última página */
        $ultima_pagina = ceil($valor->total_registros / QTDE_REGISTROS);

        /* Cálcula qual será a página anterior em relação a página atual em exibição */
        $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual - 1 : 0;

        /* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
        $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual + 1 : 0;

        /* Cálcula qual será a página inicial do nosso range */
        $range_inicial = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1;

        /* Cálcula qual será a página final do nosso range */
        $range_final = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

        /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
        $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';

        /* Verifica se vai exibir o botão "Anterior" e "Último" */
        $exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';

        if (!empty($dados)):
            echo "
     <table class='table table-striped table-bordered'>
     <thead>
       <tr style='text-transform: uppercase;' class='active'>
        <th style='text-align: center; font-weight: bolder;'>Code</th>
        <th style='text-align: center; font-weight: bolder;'>Month</th>
        <th style='text-align: center; font-weight: bolder;'>Year</th>
        <th style='text-align: center; font-weight: bolder;'>Situation</th>
        <th style='text-align: center; font-weight: bolder;'>Value Portion</th>
        <th style='text-align: center; font-weight: bolder;'>NIS Benefit</th>
        <th style='text-align: center; font-weight: bolder;'>Name Benefit</th>
        <th style='text-align: center; font-weight: bolder;'>Name City</th>
        <th style='text-align: center; font-weight: bolder;'>Code Siafi City</th>
        <th style='text-align: center; font-weight: bolder;'>UF State</th>
        <th style='text-align: center; font-weight: bolder;' colspan='2'>Actions</th>
       </tr>
     </thead>
     <tbody>";
            foreach ($dados as $peti):
                echo "<tr>
        <td style='text-align: center'>$peti->id_peti</td>
        <td style='text-align: center'>$peti->str_month</td>
        <td style='text-align: center'>$peti->str_year</td>
        <td style='text-align: center'>$peti->str_situacao</td>
        <td style='text-align: center'>$peti->db_value_portion</td>
        <td style='text-align: center'>$peti->str_nis</td>
        <td style='text-align: center'>$peti->str_name_person</td>
        <td style='text-align: center'>$peti->str_name_city</td>
        <td style='text-align: center'>$peti->str_cod_siafi_city</td>
        <td style='text-align: center'>$peti->str_uf</td>
        <td style='text-align: center'><a href='?act=upd&id=$peti->id_peti' title='Alterar'><i class='ti-reload'></i></a></td>
        <td style='text-align: center'><a href='?act=del&id=$peti->id_peti' title='Remover'><i class='ti-close'></i></a></td>
       </tr>";
            endforeach;
            echo "
</tbody>
     </table>

    <div class='box-paginacao' style='text-align: center'>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$primeira_pagina' title='Primeira Página'> FIRST  |</a>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$pagina_anterior' title='Página Anterior'> PREVIOUS  |</a>
";

            /* Loop para montar a páginação central com os números */
            for ($i = $range_inicial; $i <= $range_final; $i++):
                $destaque = ($i == $pagina_atual) ? 'destaque' : '';
                echo "<a class='box-numero $destaque' href='$endereco?page=$i'> ( $i ) </a>";
            endfor;

            echo "<a class='box-navegacao $exibir_botao_final' href='$endereco?page=$proxima_pagina' title='Próxima Página'>| NEXT  </a>
                  <a class='box-navegacao $exibir_botao_final' href='$endereco?page=$ultima_pagina'  title='Última Página'>| LAST  </a>
     </div>";
        else:
            echo "<p class='bg-danger'>Nenhum registro foi encontrado!</p>
     ";
        endif;

    }


}