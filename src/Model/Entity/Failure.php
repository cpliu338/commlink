<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Failure Entity
 *
 * @property int $id
 * @property string|null $link_id
 * @property \Cake\I18n\FrozenTime|null $fail_start
 * @property \Cake\I18n\FrozenTime|null $fail_end
 *
 * @property \App\Model\Entity\Link $link
 */
class Failure extends Entity
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
        'link_id' => true,
        'fail_start' => true,
        'fail_end' => true,
        'link' => true
    ];
    
    public function getDuration() {
    	return ($this->fail_end->getTimestamp() -
				$this->fail_start->getTimestamp()) / 60.0; 
    }
}
