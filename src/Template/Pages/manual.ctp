<div class="actions columns large-2 medium-3">
    <?= $this->element('chrome') ?>

    <?php $this->start('css');
    $this->assign('title', "About MMD application programme"); ?>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(odd) {
            background-color: rgb(238, 245, 245);
        }

        caption {
            text-align: left;
        }
    </style>
    <?php $this->end(); ?>
</div>

<table>
    <p>
        <caption><h2>MMD application programme</h2></caption>
    </p>
    <tr>
        <th><h3 style="font-size:180%;">Mmd Coordinator:</h3></th>
    </tr>
    <tr>
        <td><h4 style="font-size:140%;">M&amp;E/Maintenance</h4>
            <h5 style="font-size:100%;">SEE/M2, CTOI/W, STOI/W1, TO(I)W1</h5></td>
    </tr>
    <tr>
        <td><h2 style="font-size:180%;">Contents:</h2></td>
    </tr>
    <tr>
        <td>
            <li>
                <style= "font-size:100%;"><?= $this->Html->link('Version History', ['action' => 'version']) ?></li>
            <li>
                <style= "font-size:100%;"><?= $this->Html->link('Database structure', ['action' => 'database']) ?></li>
            <li>
                <style= "font-size:100%;"><?= $this->Html->link('Cron jobs', ['action' => 'cron']) ?></li>
        </td>
    </tr>
</table>





	


