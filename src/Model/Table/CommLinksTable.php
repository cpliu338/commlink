<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * CommLinks Model
 *
 * @method \App\Model\Entity\CommLink get($primaryKey, $options = [])
 * @method \App\Model\Entity\CommLink newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CommLink[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CommLink|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommLink saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommLink patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CommLink[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CommLink findOrCreate($search, callable $callback = null, $options = [])
 */
class CommLinksTable extends Table
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

        $this->setTable('comm_links');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        //$this->hasMany('Failures')->setForeignKey('link_id');
        $this->belongsToMany('Rtus', [
            'foreignKey' => 'link_id',
            'targetForeignKey' => 'rtus_id',
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
            ->scalar('id')
            ->maxLength('id', 255)
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('loc_code')
            ->maxLength('loc_code', 16)
            ->allowEmptyString('loc_code');

        $validator
            ->requirePresence('type', 'create')
            ->notEmptyString('type')
            ->maxLength('type', 32);

        $validator
            ->requirePresence('properties', 'create')
            ->notEmptyString('properties');

        $validator
            ->scalar('remark');
            //->requirePresence('remark', 'create');
            //->notEmptyString('remark');

        return $validator;
    }
}
