<?php

require_once "classes/template.php";

require_once "dao/familyservicebagDAO.php";
require_once "classes/familyservicebag.php";


$object = new familyservicebagDAO();

$template = new Template();

$template->header();
$template->sidebar();
$template->mainpanel();


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_month_reference = (isset($_POST["str_month_reference"]) && $_POST["str_month_reference"] != null) ? $_POST["str_month_reference"] : "";
    $str_year_reference = (isset($_POST["str_year_reference"]) && $_POST["str_year_reference"] != null) ? $_POST["str_year_reference"] : "";
    $str_month_competence = (isset($_POST["str_month_competence"]) && $_POST["str_month_competence"] != null) ? $_POST["str_month_competence"] : "";
    $str_year_competence = (isset($_POST["str_year_competence"]) && $_POST["str_year_competence"] != null) ? $_POST["str_year_competence"] : "";
    $date_sake = (isset($_POST["date_sake"]) && $_POST["date_sake"] != null) ? $_POST["date_sake"] : "";
    $db_value_sake = (isset($_POST["db_value_sake"]) && $_POST["db_value_sake"] != null) ? $_POST["db_value_sake"] : "";
    $tb_city_id_city = (isset($_POST["tb_city_id_city"]) && $_POST["tb_city_id_city"] != null) ? $_POST["tb_city_id_city"] : "";
    $tb_beneficiaries_id_beneficiaries = (isset($_POST["tb_beneficiaries_id_beneficiaries"]) && $_POST["tb_beneficiaries_id_beneficiaries"] != null) ? $_POST["tb_beneficiaries_id_beneficiaries"] : "";


} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_month_reference = NULL;
    $str_year_reference = NULL;
    $str_month_competence = NULL;
    $str_year_competence = NULL;
    $date_sake = NULL;
    $db_value_sake = NULL;
    $tb_beneficiaries_id_beneficiaries = NULL;
    $tb_city_id_city = NULL;

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    $fsb = new familyservicebag($id, '', '', '', '','', '', '', '');

    $resultado = $object->atualizar($fsb);
    $str_month_reference = $resultado->getStrMonthReference();
    $str_year_reference = $resultado->getStrYearReference();
    $str_month_competence = $resultado->getStrMonthCompetence();
    $str_year_competence = $resultado->getStrYearCompetence();
    $date_sake = $resultado->getDateSake();
    $db_value_sake = $resultado->getDbValueSake();
    $tb_beneficiaries_id_beneficiaries = $resultado->getTbBeneficiariesIdBeneficiaries();
    $tb_city_id_city = $resultado->getTbCityIdCity();

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_month_reference != "" && $str_year_reference != "" && $str_month_competence != "" && $str_year_competence != "" && $date_sake !="" && $db_value_sake!= "" && $tb_city_id_city != "" && $tb_beneficiaries_id_beneficiaries != "") {

    $fsb = new familyservicebag($id, $str_month_reference, $str_year_reference, $str_month_competence, $str_year_competence, $date_sake, $db_value_sake, $tb_beneficiaries_id_beneficiaries, $tb_city_id_city);
    $msg = $object->salvar($fsb);
    $id = null;
    $str_month_reference = null;
    $str_year_reference = null;
    $str_month_competence = null;
    $str_year_competence = null;
    $date_sake = null;
    $db_value_sake = null;
    $tb_beneficiaries_id_beneficiaries = null;
    $tb_city_id_city = null;

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $fsb = new familyservicebag($id, '', '','', '','', '', '', '');
    $msg = $object->remover($fsb);
    $id = null;
}

?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Family Service Bag</h4>
                        <p class='category'>List of Family Service Bag of the system</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save&id=" method="POST" name="form1">

                            <input type="hidden" name="id" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Month Reference:
                            <input class="form-control" type="text" maxlength="2" name="str_month_reference" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($str_month_reference) && ($str_month_reference != null || $str_month_reference != "")) ? $str_month_reference : '';
                            ?>"/>
                            <br/>
                            Year Reference:
                            <input class="form-control" type="text" maxlength="4" name="str_year_reference" value="<?php
                            // Preenche o sigla no campo sigla com um valor "value"
                            echo (isset($str_year_reference) && ($str_year_reference != null || $str_year_reference != "")) ? $str_year_reference : '';
                            ?>"/>
                            <br/>Month Competence:
                            <input class="form-control" type="text" maxlength="2" name="str_month_competence" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($str_month_competence) && ($str_month_competence != null || $str_month_competence != "")) ? $str_month_competence : '';
                            ?>"/>
                            <br/>
                            Year Competence:
                            <input class="form-control" type="text" maxlength="4" name="str_year_competence" value="<?php
                            // Preenche o sigla no campo sigla com um valor "value"
                            echo (isset($str_year_competence) && ($str_year_competence != null || $str_year_competence != "")) ? $str_year_competence : '';
                            ?>"/>
                            <br/>
                            Date Sake:
                            <input class="form-control" type="date" name="date_sake" value="<?php
                            // Preenche o sigla no campo sigla com um valor "value"
                            echo (isset($date_sake) && ($date_sake != null || $date_sake != "")) ? $date_sake : '';
                            ?>"/>
                            <br/>
                            Value Sake:
                            <input class="form-control" type="text" maxlength="14" name="db_value_sake" placeholder="Enter numbers only" value="<?php
                            // Preenche o sigla no campo sigla com um valor "value"
                            echo (isset($db_value_sake) && ($db_value_sake != null || $db_value_sake != "")) ? $db_value_sake : '';
                            ?>"/>
                            <br/>
                            NIS Benefit:
                            <select class="form-control" name="tb_beneficiaries_id_beneficiaries">
                                <?php
                                $query = "SELECT * FROM tb_beneficiaries order by str_nis;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($result as $rs) {
                                        if ($rs->id_beneficiaries == $tb_beneficiaries_id_beneficiaries) {
                                            echo "<option value='$rs->id_beneficiaries' selected >$rs->str_nis</option>";
                                        } else {
                                            echo "<option value='$rs->id_beneficiaries' >$rs->str_nis</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
                                }
                                ?>
                            </select>
                            <br/>
                            Code City:
                            <select class="form-control" name="tb_city_id_city">
                                <?php
                                $query = "SELECT * FROM tb_city order by str_cod_siafi_city;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($result as $rs) {
                                        if ($rs->id_city == $tb_city_id_city) {
                                            echo "<option value='$rs->id_city' selected>$rs->str_cod_siafi_city</option>";
                                        } else {
                                            echo "<option value='$rs->id_city'>$rs->str_cod_siafi_city</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
                                }
                                ?>
                            </select>
                            <br/>
                            <input class="btn btn-success" type="submit" value="REGISTER">
                            <hr>
                        </form>


                        <?php
                        echo (isset($msg) && ($msg != null || $msg != "")) ? $msg : '';
                        //chamada a paginação
                        $object->tabelapaginada();

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$template->footer();
?>
