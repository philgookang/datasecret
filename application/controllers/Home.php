<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {

		$model = new CurrencyRateM();
		$cnt = 0;
		
		$data = array();
		$data["categories"] = array();
		$data["series"] = array();
		$data["dates"] = array();

		if (isset($_GET["start_date"])) {
			
			for ($i = 0; $i < count($_GET["start_date"]); $i++) {

				$start = $_GET["start_date"][$i];
				$end = $_GET["end_date"][$i];

				if ($start == "" || $end == "") {
					continue;
				}

				array_push($data["dates"], array(
					"start" => $start,
					"end" => $end
				));

				// get data for this date
				$lst = $model->getRatesBetween("DOLWON", $start, $end);

				// save count
				if (count($lst) > $cnt)  {
					$cnt = count($lst);
				}

				// process data
				array_push($data["series"], array(
						"name" => $start . "~" . $end,
						"data" => array_map(function($item) {
							return $item->price;
						}, $lst)
					)
				);
				// end array_push
			}
			// end for
		}
		// end if

		for ($i = 1; $i <= $cnt; $i++) {
			array_push($data["categories"], $i);
		}

        $this->load->view('home', $data);
	}
}
