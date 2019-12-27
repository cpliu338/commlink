<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
            ->requirePresence('properties', 'create')
            ->notEmptyString('properties');

        $validator
            ->scalar('remark')
            ->requirePresence('remark', 'create')
            ->notEmptyString('remark');

        return $validator;
    }
}
