<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CommLink[]|\Cake\Collection\CollectionInterface $commLinks
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Comm Link'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="commLinks index large-9 medium-8 columns content">
    <h3><?= __('Comm Links') ?></h3>
    <form id="add-uplink" method="get" accept-charset="utf-8" action="/comm-links/add">
    <div class="input select">
    <fieldset>
    	<label for="uplinks">Uplink</label>
    	<select id="uplinks">
<?php foreach($uplinks as $key=>$value): ?>
	<option value="<?= $value?>"/><?=$key?></option>
<?php endforeach; ?>
		</select>
	</fieldset>
		<button id="add">Add</button>
	</div>
	</form>
<!-- $this->Html->link($key, ['action'=>'add', '?'=>['name'=>$key]]) -->
    
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('loc_code') ?></th>
                <th scope="col"><?= __('properties') ?></th>
                <th scope="col"><?= __('remark') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commLinks as $commLink): ?>
            <tr>
                <td><?= h($commLink->id) ?></td>
                <td><?= h($commLink->loc_code) ?></td>
                <td><?= is_array($commLink->properties) ?
                	Cake\Utility\Text::truncate(json_encode($commLink->properties, 20)) : $commLink->properties
                ?></td>
                <td><?= Cake\Utility\Text::truncate($commLink->remark, 20) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $commLink->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $commLink->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $commLink->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commLink->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
<script>
	$("#add-uplink").submit(
	//$("#add").click(
		function(e) {
		alert($("#uplinks option:selected").val());
		return false;
	});
</script>