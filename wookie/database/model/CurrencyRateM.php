<?php

class CurrencyRateM extends BusinessModel {

    public function getList() {

        $query	= "SELECT ";
        $query .=   " `a`.`idx`, ";
        $query .=   " `m`.`nickname`, ";
        $query .=   " `a`.`title`, ";
        $query .=   " `a`.`content`, ";
        $query .=   " `a`.`views`, ";
        $query .=   " `a`.`release_date_time`, ";
        $query .=   " `a`.`updated_date_time` ";
		$query .= "FROM ";
        $query .=   "`article` as `a`, ";
        $query .=   "`member` as `m` ";
		$query .= "WHERE ";
        $query .=	"`a`.`member_idx`=`m`.`idx` AND ";
        if ($this->search_text!=null) { $query .= " (`a`.`title`  LIKE ? || `a`.`content` LIKE ?) AND "; }
        if ($this->category_idx!=null) { $query .= "`a`.`category_idx`=? AND "; }
        if ($this->member_idx!=null) { $query .= "`a`.`member_idx`=? AND "; }
		$query .=	"`a`.`status`=? ";
		$query .=	"ORDER BY `a`.`idx` desc ";

        $status = 1;

		$fmt = "";
        if ($this->search_text!=null) { $fmt .= "ss"; }
        if ($this->category_idx!=null) { $fmt .= "i"; }
        if ($this->member_idx!=null) { $fmt .= "i"; }

		$params = array($fmt."i");
        if ($this->search_text!=null) { $s = '%'.$this->search_text.'%'; $params[] = &$s; $params[] = &$s; }
        if ($this->category_idx!=null) { $params[] = &$this->category_idx; }
        if ($this->member_idx!=null) { $params[] = &$this->member_idx; }
		$params[] = &$status;

        return $this->postman->returnDataList( $query, $params );
    }

    public function get() {

        $query	= "SELECT ";
        $query .=   " `a`.`idx`, ";
        $query .=   " `a`.`category_idx`, ";
        $query .=   " `a`.`title`, ";
        $query .=   " `a`.`content`, ";
        $query .=   " `a`.`release_date_time` ";
		$query .= "FROM ";
        $query .=   "`article` as `a` ";
		$query .= "WHERE ";
        if ($this->idx!=null) { $query .= "`a`.`idx`=? AND "; }
        if ($this->member_idx!=null) { $query .= "`a`.`member_idx`=? AND "; }
		$query .=	"`a`.`status`=? ";

        $status = 1;

		$fmt = "";
        if ($this->idx!=null) { $fmt .= "i"; }
        if ($this->member_idx!=null) { $fmt .= "i"; }

		$params = array($fmt."i");
        if ($this->idx!=null) { $params[] = &$this->idx; }
        if ($this->member_idx!=null) { $params[] = &$this->member_idx; }
		$params[] = &$status;

        return ArticleM::new($this->postman->returnDataObject( $query, $params ));
    }

    public function update() {

        $query	= "UPDATE ";
        $query .=   "`article` ";
        $query .= "SET ";
        $query .=	"`category_idx`=?, ";
        $query .=	"`title`=?, ";
        $query .=	"`content`=?, ";
        $query .=	"`release_date_time`=?, ";
        $query .=	"`updated_date_time`=? ";
        $query .= "WHERE ";
        $query .=	"`idx`=? ";

        $updated_date_time = date('Y-m-d H:i:s');

        $this->postman->execute($query, array(
            'issssi', &$this->category_idx, &$this->title, &$this->content, &$this->release_date_time, &$this->updated_date_time, &$this->idx
        ));
    }
}
