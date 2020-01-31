<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rtus Entity
 *
 * @property int $id
 * @property string|null $path
 * @property string|null $loc_code
 * @property string|null $type
 * @property array|null $properties
 *
 * @property \App\Model\Entity\CommLink[] $comm_links
 */
class Rtus extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'path' => true,
        'loc_code' => true,
        'type' => true,
        'properties' => true,
        'comm_links' => true,
    ];
    /**
    * Override magic get method for 
    * the attribute fields start with attr_
    */
    public function &__get($property) {
    	if (substr($property, 0, 5)=='attr_') {
    		$prop = substr($property, 5);
    		return ($this->properties)[$prop];
    	}
    	return $this->get($property);
    }
}
