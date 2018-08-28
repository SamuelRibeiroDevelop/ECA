<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 23/08/2018
 * Time: 21:47
 */

class fishermaninsurance
{
    private $int_id;
    private $str_month;
    private $str_year;
    private $db_value;
    private $tb_beneficiaries_id_beneficiaries;
    private $tb_city_id_city;

    public function __construct($int_id, $str_month, $str_year, $db_value, $tb_beneficiaries_id_beneficiaries, $tb_city_id_city)
    {
        $this->int_id = $int_id;
        $this->str_month = $str_month;
        $this->str_year = $str_year;
        $this->db_value = $db_value;
        $this->tb_beneficiaries_id_beneficiaries = $tb_beneficiaries_id_beneficiaries;
        $this->tb_city_id_city = $tb_city_id_city;
    }

    public function getIntId()
    {
        return $this->int_id;
    }

    public function setIntId($int_id): void
    {
        $this->int_id = $int_id;
    }

    public function getStrMonth()
    {
        return $this->str_month;
    }

    public function setStrMonth($str_month): void
    {
        $this->str_month = $str_month;
    }

    public function getStrYear()
    {
        return $this->str_year;
    }

    public function setStrYear($str_year): void
    {
        $this->str_year = $str_year;
    }

    public function getDbValue()
    {
        return $this->db_value;
    }

    public function setDbValue($db_value): void
    {
        $this->db_value = $db_value;
    }

    public function getTbBeneficiariesIdBeneficiaries()
    {
        return $this->tb_beneficiaries_id_beneficiaries;
    }

    public function setTbBeneficiariesIdBeneficiaries($tb_beneficiaries_id_beneficiaries): void
    {
        $this->tb_beneficiaries_id_beneficiaries = $tb_beneficiaries_id_beneficiaries;
    }

    public function getTbCityIdCity()
    {
        return $this->tb_city_id_city;
    }

    public function setTbCityIdCity($tb_city_id_city): void
    {
        $this->tb_city_id_city = $tb_city_id_city;
    }


}