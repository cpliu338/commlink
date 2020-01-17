<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\Utility\Xml;

class ImportShell extends Shell
{
	
	public function xml() {
    	$xml = Xml::build(ROOT . DS . 'TandSData.xml');
    	$cnt = 0;
    	foreach ($xml as $tr) {
    		$cnt++;
    		$col1 = (Xml::toArray($tr->td[0]))['td'];
    		if (is_array($col1))
    			var_dump($col1);
    		else if (is_string($col1))
    			$this->out($col1);
    		else
    			$this->out($cnt);
    		if ($cnt > 6) break;
    	}
	}
	
    public function main()
    {
    	$xml = simplexml_load_file(ROOT . DS . 'TandSData.xml');
        $rowcount = 0;
        $this->loadModel('CommLinks');
        //$this->CommLinks->deleteAll(['id >'=>0]);
        $this->import_uplinks($xml);
    }
    
    function parseCol(\SimpleXmlElement $tr, int $index) : array {
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

    public function import_uplinks($xml)
    {
        $rowcount = 0;
        $table = [];
        //$this->CommLinks->deleteAll(['id >'=>0]);
    	foreach ($xml->children() as $tr) {
        	$uplink_name = $this->parseCol($tr, 2);
        	$uplink_code = $this->parseCol($tr, 3);
			$operator = $this->parseCol($tr, 4);
        	if (empty($uplink_name['text']) ||
        		empty($uplink_code['text']))
        		throw new \Exception($rowcount);
        	if (empty($table[$uplink_code['text']])) {
        		$table[$uplink_code['text']] = [
        			'loc'=>$uplink_name['text'],
        			'operator'=>empty($operator['text']) ? 'X' : $operator['text']
        			];
        	}
        	else {
        		if ($table[$uplink_code['text']]['operator'] == 'X') {
        			$table[$uplink_code['text']]['operator'] = 
        			empty($operator['text']) ? 'X' : $operator['text'];
        		}
        		else {
        			var_dump($table);
        			throw new \Exception(var_export(array_merge($uplink_code,
        					['rowcount'=>$rowcount]), true
        					));
        		}
        	}
        	$rowcount++;
        	if ($rowcount > 50) return;
        }
		$this->out(var_export($table));
    }
    
    public function import_links()
    {
        $rowcount = 0;
    	foreach ($xml->children() as $tr) {
        	$properties = [];
        	$rowcount++;
        	$col0 = $tr->td[0];
        	$line = $tr->td[1];
        	if (empty($col0->a))
        		$loc = $col0->__toString();
        	else {
        		$loc = $col0->a->__toString();
        		$properties['geo_link'] = $col0->a['href']->__toString();
        		var_dump($properties);
        	}
        	$this->out($loc);
        	$entity = $this->CommLinks->newEntity([
				'location'=>trim($loc),
				'name'=>trim($line->__toString()),
				'properties' => $properties
			]);
			if ($this->CommLinks->save($entity))
				$this->out($rowcount);
			else {
				var_dump($entity);
				break;
			}
        	/*
			*/
        }
        $this->out($rowcount);
    }
}
