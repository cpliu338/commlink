<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RtusCommLink Entity
 *
 * @property int $id
 * @property string|null $rtu_id
 * @property int $link_id
 * @property string|null $remark
 *
 * @property \App\Model\Entity\Rtus $rtus
 * @property \App\Model\Entity\Link $link
 */
class RtusCommLink extends Entity
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
        'rtu_id' => true,
        'link_id' => true,
        'remark' => true,
        'rtus' => true,
        'link' => true,
    ];
}
