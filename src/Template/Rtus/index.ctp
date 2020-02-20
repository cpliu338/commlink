<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rtus[]|\Cake\Collection\CollectionInterface $rtus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Rtu'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comm Links'), ['controller' => 'CommLinks', 'action' => 'index']) ?></li>
    </ul>
    <form method="get">
    <fieldset>
        <legend><?= __('Filter') ?></legend>
    <label for="column">Column</label>
    <select name="column" id="column">
	    <option value="">-- choose one --</option>
    	<option value="path">Path</option>
    	<option value="properties">Properties</option>
    </select>
    <label for="value">Value</label>
    <input type="text" name="value" id="value" value="<?=$value?>"/>
    </fieldset>
    <button id="filter">Filter</button>
    <button id="reset" style="background-color: black">Reset</button>
    </form>
</nav>
<div class="rtus index large-9 medium-8 columns content">
    <h3><?= __('Rtus') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('path') ?></th>
                <th scope="col"><?= $this->Paginator->sort('loc_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('properties') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rtus as $rtus): ?>
            <tr>
                <td><?= $this->Number->format($rtus->id) ?></td>
                <td><?= h($rtus->path) ?></td>
                <td><?= h($rtus->loc_code) ?></td>
                <td><?= h($rtus->type) ?></td>
                <td><?= is_array($rtus->properties) ?
                	Cake\Utility\Text::truncate(json_encode($rtus->properties, 20)) : $rtus->properties
                ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rtus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rtus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rtus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rtus->id)]) ?>
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
$(function(){
	$("#column").val("<?=$column?>");
	$("#reset").click(function() {
		$("#value").val("");
		$("#column").val("");
	});
});
</script>