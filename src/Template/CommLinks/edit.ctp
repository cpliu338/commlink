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
            echo $this->Form->control('name', ['readonly'=>true]);
            echo $this->Form->control('type', [
            		'type'=>'select',
            		'multiple'=>false,
            		'options'=>$types]);
            echo $this->Form->control('loc_code');
            foreach ($attributes as $attr) {
            	echo $this->Form->control($attr);
            }
            echo $this->Form->control('remark');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script>
	$("#loc-code").autocomplete({
		source: function (request, response) {
			$.ajax({
				url: "<?= \Cake\Core\Configure::read('WebService.locations') ?>"+"?limit=20&name_filter="+
					request.term,
				type: "GET",
				headers: {
					"Accept": "application/json"
				}
			}).done(function (data) {
				response($.map(eval(data.suggestions), function (item) {
					return {
						label: item.name,
						value: item.code,
						region: item.region
					};
				}));
			});
		},
		/*[
			{label: 'Tuen Mun WTW', value: 'TW003'},
			{label: 'Tuen Mun FWPS', value: 'PS103'}
			],*/
		select: function(event, ui) {
			$("#loc-code").val(ui.item.value);
			$("#attr-location").val(ui.item.label);
			$("#remark").val($("#remark").val() + ui.item.region);
			return false;
		},
		minLength: 1
	});
</script>