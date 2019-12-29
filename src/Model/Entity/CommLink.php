<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CommLink Entity
 *
 * @property string $id
 * @property string|null $loc_code
 * @property array $properties
 * @property string $remark
 */
class CommLink extends Entity
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
        'loc_code' => true,
        'properties' => true,
        'remark' => true,
        'name' => true // this is not an actual column
    ];
    
    /**
    * Set attribute fields for html form control using JSON column properties
    * the attribute fields start with attr_
    */
    public function populateAttr() {
    	foreach ($this->properties as $attr=>$val) {
			$this->set('attr_'.$attr, ($this->properties)[$attr]);
    	}    	
    }
    
}
