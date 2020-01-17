<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * Rtus Model
 *
 * @property \App\Model\Table\CommLinksTable&\Cake\ORM\Association\BelongsToMany $CommLinks
 *
 * @method \App\Model\Entity\Rtus get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rtus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Rtus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rtus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rtus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rtus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rtus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rtus findOrCreate($search, callable $callback = null, $options = [])
 */
class RtusTable extends Table
{
	/**
	* Refactor this
	* into a behanvior?
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
    	if (empty($entity->id) && !empty($entity->name))
			$entity->id = $entity->name;
	}	
	
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('rtus');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('CommLinks', [
            'foreignKey' => 'rtu_id',
            'targetForeignKey' => 'link_id',
            'joinTable' => 'rtus_comm_links',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('path')
            ->maxLength('path', 64)
            ->allowEmptyString('path');

        $validator
            ->scalar('loc_code')
            ->maxLength('loc_code', 16)
            ->allowEmptyString('loc_code');

        $validator
            ->scalar('type')
            ->maxLength('type', 64)
            ->allowEmptyString('type');

        $validator
            ->allowEmptyString('properties');

        return $validator;
    }
}
