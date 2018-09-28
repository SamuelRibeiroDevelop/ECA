<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 10/09/2018
 * Time: 20:35
 */

class familyservicebag
{
    private $id_family_service_bag;
    private $str_month_reference;
    private $str_year_reference;
    private $str_month_competence;
    private $str_year_competence;
    private $date_sake;
    private $db_value_sake;
    private $tb_beneficiaries_id_beneficiaries;
    private $tb_city_id_city;

    public function __construct($id_family_service_bag, $str_month_reference, $str_year_reference, $str_month_competence, $str_year_competence, $date_sake, $db_value_sake, $tb_beneficiaries_id_beneficiaries, $tb_city_id_city)
    {
        $this->id_family_service_bag = $id_family_service_bag;
        $this->str_month_reference = $str_month_reference;
        $this->str_year_reference = $str_year_reference;
        $this->str_month_competence = $str_month_competence;
        $this->str_year_competence = $str_year_competence;
        $this->date_sake = $date_sake;
        $this->db_value_sake = $db_value_sake;
        $this->tb_beneficiaries_id_beneficiaries = $tb_beneficiaries_id_beneficiaries;
        $this->tb_city_id_city = $tb_city_id_city;
    }

    /**
     * @return mixed
     */
    public function getIdFamilyServiceBag()
    {
        return $this->id_family_service_bag;
    }

    /**
     * @param mixed $id_family_service_bag
     */
    public function setIdFamilyServiceBag($id_family_service_bag): void
    {
        $this->id_family_service_bag = $id_family_service_bag;
    }

    /**
     * @return mixed
     */
    public function getStrMonthReference()
    {
        return $this->str_month_reference;
    }

    /**
     * @param mixed $str_month_reference
     */
    public function setStrMonthReference($str_month_reference): void
    {
        $this->str_month_reference = $str_month_reference;
    }

    /**
     * @return mixed
     */
    public function getStrYearReference()
    {
        return $this->str_year_reference;
    }

    /**
     * @param mixed $str_year_reference
     */
    public function setStrYearReference($str_year_reference): void
    {
        $this->str_year_reference = $str_year_reference;
    }

    /**
     * @return mixed
     */
    public function getStrMonthCompetence()
    {
        return $this->str_month_competence;
    }

    /**
     * @param mixed $str_month_competence
     */
    public function setStrMonthCompetence($str_month_competence): void
    {
        $this->str_month_competence = $str_month_competence;
    }

    /**
     * @return mixed
     */
    public function getStrYearCompetence()
    {
        return $this->str_year_competence;
    }

    /**
     * @param mixed $str_year_competence
     */
    public function setStrYearCompetence($str_year_competence): void
    {
        $this->str_year_competence = $str_year_competence;
    }

    /**
     * @return mixed
     */
    public function getDateSake()
    {
        return $this->date_sake;
    }

    /**
     * @param mixed $date_sake
     */
    public function setDateSake($date_sake): void
    {
        $this->date_sake = $date_sake;
    }

    /**
     * @return mixed
     */
    public function getDbValueSake()
    {
        return $this->db_value_sake;
    }

    /**
     * @param mixed $db_value_sake
     */
    public function setDbValueSake($db_value_sake): void
    {
        $this->db_value_sake = $db_value_sake;
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