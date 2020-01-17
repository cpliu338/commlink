<ul class="side-nav">
    <li><?= $this->Html->link(__('List Mmds'), ['controller' => 'Mmds', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('List Calibrations'), ['controller' => 'Calibrations', 'action' => 'index', '?' => ['sort' => 'mmd_no', 'direction' => 'asc']]) ?> </li>
    <li><?= $this->Html->link(__('List Mmd Clients'), ['controller' => 'MmdClients', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('List Pending Calibrations'), ['controller' => 'PendingCalibrations', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('About'), ['controller' => 'Pages', 'action' => 'manual']) ?> </li>
</ul>
