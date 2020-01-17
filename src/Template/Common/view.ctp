<?php if ($loggedIn): ?>
    <div class="actions columns large-2 medium-3">
        <?= $this->element('chrome') ?>
    </div>
<?php else: ?>
    <div class="columns large-2 medium-3">
    </div>
   <!-- <div class="actions columns large-2 medium-3">
        <?= $this->element('login') ?>
    </div>
    -->
<?php endif; ?>
<?= $this->fetch('content') ?>