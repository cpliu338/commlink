<?php
namespace App\Lib;

class Common {

    public function parseColumn(\SimpleXmlElement $tr, int $index) : array {
    	$result = [];
		$col = $tr->td[$index];
		if (empty($col))
			$result['empty'] = true;
		else if (empty($col->a))
			$result['text'] = trim($col->__toString());
		else {
			$anchor = $col->a;
			$result['href'] = trim($anchor['href']->__toString());
			$result['text'] = trim($anchor->__toString());
		}
		return $result;
    }

}
