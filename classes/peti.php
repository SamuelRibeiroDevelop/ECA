<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 10/09/2018
 * Time: 20:35
 */

class peti
{
    private $id_peti;
    private $str_month;
    private $str_year;
    private $str_situacao;
    private $db_value_portion;
    private $tb_beneficiaries_id_beneficiaries;
    private $tb_city_id_city;

    /**
     * peti constructor.
     * @param $id_peti
     * @param $str_month
     * @param $str_year
     * @param $str_situacao
     * @param $db_value_portion
     * @param $tb_beneficiaries_id_beneficiaries
     * @param $tb_city_id_city
     */
    public function __construct($id_peti, $str_month, $str_year, $str_situacao, $db_value_portion, $tb_beneficiaries_id_beneficiaries, $tb_city_id_city)
    {
        $this->id_peti = $id_peti;
        $this->str_month = $str_month;
        $this->str_year = $str_year;
        $this->str_situacao = $str_situacao;
        $this->db_value_portion = $db_value_portion;
        $this->tb_beneficiaries_id_beneficiaries = $tb_beneficiaries_id_beneficiaries;
        $this->tb_city_id_city = $tb_city_id_city;
    }

    /**
     * @return mixed
     */
    public function getIdPeti()
    {
        return $this->id_peti;
    }

    /**
     * @param mixed $id_peti
     */
    public function setIdPeti($id_peti): void
    {
        $this->id_peti = $id_peti;
    }

    /**
     * @return mixed
     */
    public function getStrMonth()
    {
        return $this->str_month;
    }

    /**
     * @param mixed $str_month
     */
    public function setStrMonth($str_month): void
    {
        $this->str_month = $str_month;
    }

    /**
     * @return mixed
     */
    public function getStrYear()
    {
        return $this->str_year;
    }

    /**
     * @param mixed $str_year
     */
    public function setStrYear($str_year): void
    {
        $this->str_year = $str_year;
    }

    /**
     * @return mixed
     */
    public function getStrSituacao()
    {
        return $this->str_situacao;
    }

    /**
     * @param mixed $str_situacao
     */
    public function setStrSituacao($str_situacao): void
    {
        $this->str_situacao = $str_situacao;
    }

    /**
     * @return mixed
     */
    public function getDbValuePortion()
    {
        return $this->db_value_portion;
    }

    /**
     * @param mixed $db_value_portion
     */
    public function setDbValuePortion($db_value_portion): void
    {
        $this->db_value_portion = $db_value_portion;
    }

    /**
     * @return mixed
     */
    public function getTbBeneficiariesIdBeneficiaries()
    {
        return $this->tb_beneficiaries_id_beneficiaries;
    }

    /**
     * @param mixed $tb_beneficiaries_id_beneficiaries
     */
    public function setTbBeneficiariesIdBeneficiaries($tb_beneficiaries_id_beneficiaries): void
    {
        $this->tb_beneficiaries_id_beneficiaries = $tb_beneficiaries_id_beneficiaries;
    }

    /**
     * @return mixed
     */
    public function getTbCityIdCity()
    {
        return $this->tb_city_id_city;
    }

    /**
     * @param mixed $tb_city_id_city
     */
    public function setTbCityIdCity($tb_city_id_city): void
    {
        $this->tb_city_id_city = $tb_city_id_city;
    }


}