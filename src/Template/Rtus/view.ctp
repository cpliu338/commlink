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
            <td><?= h($rtus->properties) ?></td>
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
                <th scope="col"><?= __('Remark') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rtus->comm_links as $commLinks): ?>
            <tr>
                <td><?= h($commLinks->id) ?></td>
                <td><?= h($commLinks->loc_code) ?></td>
                <td><?= h($commLinks->properties) ?></td>
                <td><?= h($commLinks->remark) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CommLinks', 'action' => 'view', $commLinks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CommLinks', 'action' => 'edit', $commLinks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CommLinks', 'action' => 'delete', $commLinks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commLinks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
