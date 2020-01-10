<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Failure $failure
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Failures'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="failures form large-9 medium-8 columns content">
    <?= $this->Form->create($failure) ?>
    <fieldset>
        <legend><?= __('Add Failure') ?></legend>
        <?php
            echo $this->Form->control('link_id');
            echo $this->Form->control('fail_start', ['empty' => true]);
            echo $this->Form->control('fail_end', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
