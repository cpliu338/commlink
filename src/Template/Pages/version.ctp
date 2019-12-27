<div class="actions columns large-2 medium-3">
    <?= $this->element('chrome') ?>

    <?php $this->start('css');
    $this->assign('title', "Manual page"); ?>
    <style>
        table, th, td {
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
        <caption><h2>Manual Page: version</h2></caption>
    </p>
    <tr>
        <th><h3 style="font-size:180%;">Version History:</h3></th>
    </tr>
    <tr>
        <td>
            <b>0.0.0 (Summer intern developed in 2016 by Sophia and Tom)</b></br>
            <p style="font-size:100%;">Use CakePHP for MVC of development design</p>
            <b>1.0.0 (Summer intern in 2017 by Eric)</b></br>
            <p style="font-size:100%;">Bug fixes and various improvement</p>
        </td>

    </tr>
    <tr>
        <td><?= $this->Html->link('Home', ['action' => 'manual']) ?></br></td>
    </tr>
</table>
