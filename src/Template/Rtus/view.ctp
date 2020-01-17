<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rtus $rtus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rtus'), ['action' => 'edit', $rtus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rtus'), ['action' => 'delete', $rtus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rtus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rtus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rtus'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comm Links'), ['controller' => 'CommLinks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comm Link'), ['controller' => 'CommLinks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rtus view large-9 medium-8 columns content">
    <h3><?= h($rtus->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Path') ?></th>
            <td><?= h($rtus->path) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Loc Code') ?></th>
            <td><?= h($rtus->loc_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($rtus->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Properties') ?></th>
            <td><?= is_array($rtus->properties) ?
                	Cake\Utility\Text::truncate(json_encode($rtus->properties, 20)) : $rtus->properties
			?></td>
		</tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rtus->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Comm Links') ?></h4>
        <?php if (!empty($rtus->comm_links)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Loc Code') ?></th>
                <th scope="col"><?= __('Properties') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rtus->comm_links as $commLink): ?>
            <tr>
                <td><?= h($commLink->id) ?></td>
                <td><?= h($commLink->loc_code) ?></td>
                <td><?= is_array($commLink->properties) ?
                	Cake\Utility\Text::truncate(json_encode($commLink->properties, 20)) : $commLink->properties
				?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CommLinks', 'action' => 'view', $commLink->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CommLinks', 'action' => 'edit', $commLink->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
