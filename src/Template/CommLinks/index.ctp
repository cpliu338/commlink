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
        <li><?= $this->Html->link(__('List Rtus'), ['controller'=>'Rtus', 'action' => 'index']) ?></li>
    </ul>
    <fieldset style="display:inline; margin:0; padding:0">
    	<label for="uplinks">Uplink</label>
    	<select id="uplinks">
<?php foreach($uplinks as $key=>$value): ?>
	<option value="<?= $value?>"/><?=$key?></option>
<?php endforeach; ?>
		</select>
		<button id="add-uplink">Add Uplink</button>
    	<label for="nodes">Nodes</label>
    	<select id="nodes">
<?php foreach($nodes as $key=>$value): ?>
	<option value="<?= $value?>"/><?=$key?></option>
<?php endforeach; ?>
		</select>
		<button id="add-node">Add Node</button>
	</fieldset>
</nav>
<div class="commLinks index large-9 medium-8 columns content">
    <h3><?= __('Comm Links') ?></h3>
<!-- $this->Html->link($key, ['action'=>'add', '?'=>['name'=>$key]]) -->
    
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
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
                <td><?= h($commLink->type) ?></td>
                <td><?= h($commLink->loc_code) ?></td>
                <td><?= is_array($commLink->properties) ?
                	Cake\Utility\Text::truncate(json_encode($commLink->properties, 20)) : $commLink->properties
                ?></td>
                <td><?= nl2br(Cake\Utility\Text::truncate($commLink->remark, 20)) ?></td>
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
	$(function() {
		$("#add-uplink").button({icons: {primary: "ui-icon-plus"}});
	});
	$("#add-uplink").click(function() {
		var addpage = "<?= Cake\Routing\Router::url([
			'action'=>'add'])?>";
		var map = {'type':'broadband'};
		map.name = $("#uplinks option:selected").val();
		/*
		alert($.param(map));
		*/
		window.location = addpage + '?' + $.param(map);
		//return false;
	});
	$("#add-node").click(function() {
		var addpage = "<?= Cake\Routing\Router::url([
			'action'=>'add'])?>";
		var map = {'type':'leased_line'};
		map.name = $("#nodes option:selected").val();
		window.location = addpage + '?' + $.param(map);
		//return false;
	});
</script>