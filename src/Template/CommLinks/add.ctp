<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CommLink $commLink
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Comm Links'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="commLinks form large-9 medium-8 columns content">
    <?= $this->Form->create($commLink) ?>
    <fieldset>
        <legend><?= __('Add Comm Link') ?></legend>
        <?php
            echo $this->Form->control('name', ['readonly'=>true]);
            echo $this->Form->control('type', [
            		'type'=>'select',
            		'multiple'=>false,
            		'options'=>$types]);
            echo $this->Form->control('loc_code');
            foreach ($attributes as $attr) {
            	echo $this->Form->control($attr);
            }
            //echo $this->Form->control('properties');
            echo $this->Form->control('remark');
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
		'callback'=>
'$("#remark").val(ui.item.region + "\n" + $("#remark").val())'
		]);
	if (in_array('attr_loc_code_up', $attributes))
		echo $this->element('autocomplete_script', [
		'service'=>\Cake\Core\Configure::read('WebService.locations'),
		'code'=>'#attr-loc-code-up', 'name'=>'#attr-location-up',
		'callback'=>
'$("#remark").val(ui.item.region + "\n" + $("#remark").val())'
		]);
	$this->Html->scriptEnd();
?>
