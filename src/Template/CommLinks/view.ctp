<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CommLink $commLink
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Comm Link'), ['action' => 'edit', $commLink->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Comm Link'), ['action' => 'delete', $commLink->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commLink->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Comm Links'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comm Link'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="commLinks view large-9 medium-8 columns content">
    <h3><?= h($commLink->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($commLink->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Loc Code') ?></th>
            <td><?= h($commLink->loc_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($commLink->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Properties') ?></th>
            <td><dl>
<?php foreach (\Cake\Core\Configure::read('JsonCommLink.'.$commLink->type,[]) as $attr): ?>
	<dt><?=$attr?></dt>
	<dd><?=$commLink->__get($attr)?></dd>
<?php endforeach; ?>
            </dl></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Remark') ?></h4>
        <?= $this->Text->autoParagraph(h($commLink->remark)); ?>
    </div>
    <div class="row">
        <h4><?= __('Connected Rtus') ?></h4>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= __('id') ?></th>
                <th scope="col"><?= __('type') ?></th>
                <th scope="col"><?= __('properties') ?></th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($commLink->rtus as $rtu): ?>
			<tr>
				<td><?= $this->Html->link($rtu->id, [
					'controller'=>'Rtus',
					'action'=>'view',
					$rtu->id
						]) ?></td>
				<td><?= $rtu->type ?></td>
                <td><?= is_array($rtu->properties) ?
                	Cake\Utility\Text::truncate(json_encode($rtu->properties, 20)) : $rtu->properties
                ?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
	</table>
    </div>
</div>
