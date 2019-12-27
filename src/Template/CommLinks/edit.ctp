<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CommLink $commLink
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $commLink->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $commLink->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Comm Links'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="commLinks form large-9 medium-8 columns content">
    <?= $this->Form->create($commLink) ?>
    <fieldset>
        <legend><?= __('Edit Comm Link') ?></legend>
        <?php
            echo $this->Form->control('loc_code');
            echo $this->Form->control('properties');
            echo $this->Form->control('remark');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
