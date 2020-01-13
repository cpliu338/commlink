<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rtus $rtu
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Rtus'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Comm Links'), ['controller' => 'CommLinks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comm Link'), ['controller' => 'CommLinks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rtus form large-9 medium-8 columns content">
    <?= $this->Form->create($rtu) ?>
    <fieldset>
        <legend><?= __('Add Rtu') ?></legend>
        <?php
            echo $this->Form->control('path');
            echo $this->Form->control('loc_code');
            foreach ($attributes as $attr) {
            	echo $this->Form->control($attr);
            }
            echo $this->Form->control('type');
            echo $this->Form->control('comm_links._ids', ['options' => $commLinks]);
            echo $this->Form->control('remark', ['type'=>'hidden']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?php
	$this->Html->scriptStart(['block'=>'scriptBottom']);
	echo $this->element('autocomplete_script', [
		'service'=>\Cake\Core\Configure::read('WebService.locations'),
		'code'=>'#loc-code', 'name'=>'#attr-location',
		'remark'=>'#remark'
		]);
	$this->Html->scriptEnd();
?>

