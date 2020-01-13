<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RtusCommLinks Model
 *
 * @property \App\Model\Table\RtusTable&\Cake\ORM\Association\BelongsTo $Rtus
 * @property \App\Model\Table\LinksTable&\Cake\ORM\Association\BelongsTo $Links
 *
 * @method \App\Model\Entity\RtusCommLink get($primaryKey, $options = [])
 * @method \App\Model\Entity\RtusCommLink newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RtusCommLink[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RtusCommLink|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RtusCommLink saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RtusCommLink patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RtusCommLink[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RtusCommLink findOrCreate($search, callable $callback = null, $options = [])
 */
class RtusCommLinksTable extends Table
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

        $this->setTable('rtus_comm_links');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Rtus', [
            'foreignKey' => 'rtu_id',
        ]);
        $this->belongsTo('CommLinks', [
            'foreignKey' => 'link_id',
            //'joinType' => 'INNER',
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
            ->scalar('remark')
            ->maxLength('remark', 64)
            ->allowEmptyString('remark');

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
        $rules->add($rules->existsIn(['rtu_id'], 'Rtus'));
        $rules->add($rules->existsIn(['link_id'], 'CommLinks'));

        return $rules;
    }
}
