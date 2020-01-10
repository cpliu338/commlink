<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Failure[]|\Cake\Collection\CollectionInterface $failures
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Failure'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comm Links'), ['controller'=>'CommLinks', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="failures index large-9 medium-8 columns content">
    <h3><?= __('Failures') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('link_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fail_start') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fail_end') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($failures as $failure): ?>
            <tr>
                <td><?= $this->Number->format($failure->id) ?></td>
                <td><?= h($failure->link_id) ?></td>
                <td><?= h($failure->fail_start) ?></td>
                <td><?= h($failure->fail_end) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $failure->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $failure->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $failure->id], ['confirm' => __('Are you sure you want to delete # {0}?', $failure->id)]) ?>
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
