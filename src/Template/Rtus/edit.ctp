<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rtus $rtus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rtus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rtus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Rtus'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Comm Links'), ['controller' => 'CommLinks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comm Link'), ['controller' => 'CommLinks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rtus form large-9 medium-8 columns content">
    <?= $this->Form->create($rtus) ?>
    <fieldset>
        <legend><?= __('Edit Rtus') ?></legend>
        <?php
            echo $this->Form->control('path');
            echo $this->Form->control('loc_code');
            echo $this->Form->control('type');
            echo $this->Form->control('properties');
            echo $this->Form->control('comm_links._ids', ['options' => $commLinks]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
