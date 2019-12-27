
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
        <caption><h2>Manual Page: Cron jobs</h2></caption>
    </p>
    <tr>
        <th><h3 style="font-size:180%;">Cron jobs</h3></th>
    </tr>
    <tr>
        <td>
            <p>The following is in the cron job list of the user owner the app folder, to see the list (below) of jobs,
                su to the owner and type crontab -l</p>
            <pre>
0 5 1 * *  cd /var/www/cake/mmd/ && ./bin/cake calibration createPending
0 6 1 * *  cd /var/www/cake/mmd/ && ./bin/cake mmdClient sendNotification [Server host IP address] /mmd
            </pre>
            <p>Note that you need to replace [Server host IP address] with the ip address of the server.
                <br>For example, for production server, the address should be 10.66.17.78</p>

        </td>

    </tr>
    <tr>
        <td><?= $this->Html->link('Home', ['action' => 'manual']) ?></br></td>
    </tr>
</table>
