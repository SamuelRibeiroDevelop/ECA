<?php

require_once "db/connection.php";
require_once "classes/familyservicebag.php";

class familyservicebagDAO
{

    public function remover($fsb)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM tb_family_service_bag WHERE id_family_service_bag = :id");
            $statement->bindValue(":id", $fsb->getIdFamilyServiceBag());
            if ($statement->execute()) {
                return "<script> alert('Registo foi excluído com êxito !'); </script>";
            } else {
                throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function salvar($fsb)
    {
        global $pdo;
        try {
            if ($fsb->getIdFamilyServiceBag() != "") {
                $statement = $pdo->prepare("UPDATE tb_family_service_bag SET str_month_reference=:str_month_reference, 
                str_year_reference=:str_year_reference, str_month_competence=:str_month_competence, str_year_competence=:str_year_competence, 
                date_sake=:date_sake, db_value_sake=:db_value_sake, tb_city_id_city=:tb_city_id_city, tb_beneficiaries_id_beneficiaries=:tb_beneficiaries_id_beneficiaries 
                WHERE id_family_service_bag = :id;");
                $statement->bindValue(":id", $fsb->getIdFamilyServiceBag());
            } else {
                $statement = $pdo->prepare("INSERT INTO tb_family_service_bag (str_month_reference, str_year_reference, str_month_competence, str_year_competence, date_sake, db_value_sake, tb_city_id_city, tb_beneficiaries_id_beneficiaries) VALUES (:str_month_reference, :str_year_reference, :str_month_competence, :str_year_competence, :date_sake, :db_value_sake, :tb_city_id_city, :tb_beneficiaries_id_beneficiaries)");
            }
            $statement->bindValue(":str_month_reference", $fsb->getStrMonthReference());
            $statement->bindValue(":str_year_reference", $fsb->getStrYearReference());
            $statement->bindValue(":str_month_competence", $fsb->getStrMonthCompetence());
            $statement->bindValue(":str_year_competence", $fsb->getStrYearCompetence());
            $statement->bindValue(":date_sake", $fsb->getDateSake());
            $statement->bindValue(":db_value_sake", $fsb->getDbValueSake());
            $statement->bindValue(":tb_city_id_city", $fsb->getTbCityIdCity());
            $statement->bindValue(":tb_beneficiaries_id_beneficiaries", $fsb->getTbBeneficiariesIdBeneficiaries());

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

    public function atualizar($fsb)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT id_family_service_bag, str_month_reference, str_year_reference, str_month_competence, str_year_competence, date_sake, db_value_sake, tb_city_id_city, tb_beneficiaries_id_beneficiaries FROM tb_family_service_bag WHERE id_family_service_bag = :id");
            $statement->bindValue(":id", $fsb->getIdFamilyServiceBag());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $fsb->setIdFamilyServiceBag($rs->id_family_service_bag);
                $fsb->setStrMonthReference($rs->str_month_reference);
                $fsb->setStrYearReference($rs->str_year_reference);
                $fsb->setStrMonthCompetence($rs->str_month_competence);
                $fsb->setStrYearCompetence($rs->str_year_competence);
                $fsb->setDateSake($rs->date_sake);
                $fsb->setDbValueSake($rs->db_value_sake);
                $fsb->setTbCityIdCity($rs->tb_city_id_city);
                $fsb->setTbBeneficiariesIdBeneficiaries($rs->tb_beneficiaries_id_beneficiaries);

                return $fsb;
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
        $sql = "SELECT FB.id_family_service_bag, FB.str_month_reference, FB.str_year_reference, FB.str_month_competence, FB.str_year_competence, FB.date_sake, FB.db_value_sake, 
        B.str_nis, B.str_name_person, S.str_uf,
        C.str_name_city, C.str_cod_siafi_city FROM tb_family_service_bag FB 
        INNER JOIN tb_city C ON FB.tb_city_id_city = C.id_city INNER JOIN tb_beneficiaries B ON FB.tb_beneficiaries_id_beneficiaries = B.id_beneficiaries
        INNER JOIN tb_state S ON S.id_state = C.tb_state_id_state 
        LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM tb_family_service_bag";
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
        <th style='text-align: center; font-weight: bolder;'>Month Reference</th>
        <th style='text-align: center; font-weight: bolder;'>Year Reference</th>
        <th style='text-align: center; font-weight: bolder;'>Month Competence</th>
        <th style='text-align: center; font-weight: bolder;'>Year Competence</th>
        <th style='text-align: center; font-weight: bolder;'>Date Sake</th>
        <th style='text-align: center; font-weight: bolder;'>Value Sake</th>
        <th style='text-align: center; font-weight: bolder;'>NIS Benefit</th>
        <th style='text-align: center; font-weight: bolder;'>Name Benefit</th>
        <th style='text-align: center; font-weight: bolder;'>Name City</th>
        <th style='text-align: center; font-weight: bolder;'>Code Siafi City</th>
        <th style='text-align: center; font-weight: bolder;'>UF State</th>
        <th style='text-align: center; font-weight: bolder;' colspan='2'>Actions</th>
       </tr>
     </thead>
     <tbody>";
            foreach ($dados as $fsb):
                echo "<tr>
        <td style='text-align: center'>$fsb->id_family_service_bag</td>
        <td style='text-align: center'>$fsb->str_month_reference</td>
        <td style='text-align: center'>$fsb->str_year_reference</td>
        <td style='text-align: center'>$fsb->str_month_competence</td>
        <td style='text-align: center'>$fsb->str_year_competence</td>
        <td style='text-align: center'>$fsb->date_sake</td>
        <td style='text-align: center'>$fsb->db_value_sake</td>
        <td style='text-align: center'>$fsb->str_nis</td>
        <td style='text-align: center'>$fsb->str_name_person</td>
        <td style='text-align: center'>$fsb->str_name_city</td>
        <td style='text-align: center'>$fsb->str_cod_siafi_city</td>
        <td style='text-align: center'>$fsb->str_uf</td>
        <td style='text-align: center'><a href='?act=upd&id=$fsb->id_family_service_bag' title='Alterar'><i class='ti-reload'></i></a></td>
        <td style='text-align: center'><a href='?act=del&id=$fsb->id_family_service_bag' title='Remover'><i class='ti-close'></i></a></td>
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