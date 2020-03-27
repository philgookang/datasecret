<?php

class CurrencyRateM extends BusinessModel {

    public function getRatesBetween($type, $start_date, $end_date) {

        $query	= "SELECT ";
        $query .=   " * ";
		$query .= "FROM ";
        $query .=   "`currency_rate` ";
		$query .= "WHERE ";
        $query .=	"`type`=? AND ";
        $query .=	"`date_price`>=? AND ";
        $query .=	"`date_price`<=? AND ";
		$query .=	"`status`=? ";
		$query .= "ORDER BY `date_price` asc ";

		$status = 1;

        return $this->postman->returnDataList( $query,  array("sssi", &$type, &$start_date, &$end_date, &$status) );
    }
}
