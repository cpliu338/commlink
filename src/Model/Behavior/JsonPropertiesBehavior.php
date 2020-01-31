<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Event\Event;
use ArrayObject;

class JsonPropertiesBehavior extends Behavior
{
	/**
	* Called before HTTP form data is marshalled to form an Entity object
	* recreate the JSON array 'properties'
	*/
	public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
	{
		$properties = [];
		foreach ($data as $key => $value) {
			if (is_string($value)) {
				$data[$key] = trim($value);
			}
		}
    	foreach ($data as $attr=>$val) {
			$at = substr($attr, 5);
    		if (substr($attr, 0, 5) == 'attr_') {
    			$properties[$at] = $data[$attr];
    		}
    	}
    	$data['properties'] = $properties;
    }
    
	/**
	* Called before saving to database
	* propety name copied to id
	*/
    public function beforeSave(Event $event) {
    	$entity = $event->getData('entity');
    	if (empty($entity->id) && !empty($entity->name)) {
			$entity->id = $entity->name;
		}
	}	
}
