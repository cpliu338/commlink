<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Failure $failure
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Failure'), ['action' => 'edit', $failure->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Failure'), ['action' => 'delete', $failure->id], ['confirm' => __('Are you sure you want to delete # {0}?', $failure->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Failures'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Failure'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comm Links'), ['controller'=>'CommLinks', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="failures view large-9 medium-8 columns content">
    <h3><?= h($failure->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Comm Link') ?></th>
            <td><?= $this->Html->link($failure->link_id, [
				'controller'=>'CommLinks',
				'action'=>'view', $failure->link_id
            	]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($failure->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fail Start') ?></th>
            <td><?= h($failure->fail_start) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fail End') ?></th>
            <td><?= h($failure->fail_end) ?></td>
        </tr>
    </table>
</div>
