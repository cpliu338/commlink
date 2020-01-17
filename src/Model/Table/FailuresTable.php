<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Failures Model
 *
 * @property \App\Model\Table\LinksTable&\Cake\ORM\Association\BelongsTo $Links
 *
 * @method \App\Model\Entity\Failure get($primaryKey, $options = [])
 * @method \App\Model\Entity\Failure newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Failure[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Failure|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Failure saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Failure patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Failure[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Failure findOrCreate($search, callable $callback = null, $options = [])
 */
class FailuresTable extends Table
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

        $this->setTable('failures');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('CommLinks', [
            'foreignKey' => 'link_id'
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
            ->dateTime('fail_start')
            ->allowEmptyDateTime('fail_start');

        $validator
            ->dateTime('fail_end')
            ->allowEmptyDateTime('fail_end');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['link_id'], 'CommLinks'));

        return $rules;
    }
}
