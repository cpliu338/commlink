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

    <script language="javascript">
        function toggle(elementId) {
            var ele = document.getElementById(elementId);
            if (ele.style.display == "block") {
                ele.style.display = "none";
            }
            else {
                ele.style.display = "block";
            }
        }
    </script>
    <?php $this->end(); ?>
</div>


<table>
    <p>
        <caption><h2>Manual Page: database</h2></caption>
    </p>
    <tr>
        <th><h3>Tables:</h3></th>
    </tr>
    <tr>
        <td><b>The following tables are used.</b></br>
            </br>
            <a id="Mmds" href="javascript:toggle('toggleText');">Mmds</a>: This is show the details of Mmds information.
            <div onclick="javascript:toggle('toggleText');">
                <div id="toggleText" style="display:none; border: 1px solid #dddddd; text-align: left;">
                    CREATE TABLE IF NOT EXISTS `mmds` (</br>
                    `id` int(11) NOT NULL,</br>
                    `mmd_no` varchar(16) NOT NULL,</br>
                    `eqt_name` varchar(64) NOT NULL,</br>
                    `mmd_client_id` int(8) NOT NULL,</br>
                    `manufacturer` varchar(32) NOT NULL,</br>
                    `model` varchar(32) NOT NULL,</br>
                    `serial_no` varchar(64) NOT NULL,</br>
                    `nom_range` varchar(255) NOT NULL,</br>
                    `cal_pts` varchar(255) NOT NULL,</br>
                    `cal_standard` varchar(255) NOT NULL,</br>
                    `work_range` varchar(255) NOT NULL,</br>
                    `tolerance` varchar(255) NOT NULL,</br>
                    `remarks` text NOT NULL</br>
                    ) ENGINE=InnoDB AUTO_INCREMENT=1332 DEFAULT CHARSET=utf8;
                </div>
            </div>
            </br>

            <a id="Calibrations" href="javascript:toggle('toggleText1');">Calibrations</a>: This is show the details
            information of each Calibration.
            <div onclick="javascript:toggle('toggleText1');">
                <div id="toggleText1" style="display:none; border: 1px solid #dddddd; text-align: left;">
                    CREATE TABLE IF NOT EXISTS `calibrations` (</br>
                    `id` int(11) NOT NULL,</br>
                    `mmd_id` int(11) NOT NULL,</br>
                    `agent` varchar(255) NOT NULL,</br>
                    `freq_in_months` int(16) NOT NULL,</br>
                    `last_cal_date` date NOT NULL,</br>
                    `next_cal_date` date NOT NULL,</br>
                    `remarks` text NOT NULL</br>
                    ) ENGINE=InnoDB AUTO_INCREMENT=1335 DEFAULT CHARSET=utf8;
                </div>
            </div>
            </br>


            <a id="Mmd_Clients" href="javascript:toggle('toggleText3');">Mmd_Clients</a>: This is show the details
            information of each Mmds Clients.
            <div onclick="javascript:toggle('toggleText3');">
                <div id="toggleText3" style="display:none; border: 1px solid #dddddd; text-align: left;">
                    CREATE TABLE IF NOT EXISTS `mmd_clients` (</br>
                    `id` int(8) NOT NULL,</br>
                    `name` varchar(64) NOT NULL,</br>
                    `contacts` text NOT NULL</br>
                    ) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
                </div>
            </div>
            </br>

            <a id="Pending_Calibration" href="javascript:toggle('toggleText4');">Pending_Calibration</a>: A table to
            show which Mmd need to calibrate.
            <div onclick="javascript:toggle('toggleText4');">
                <div id="toggleText4" style="display:none; border: 1px solid #dddddd; text-align: left;">
                    CREATE TABLE IF NOT EXISTS `pending_calibrations` (</br>
                    `id` int(11) NOT NULL,</br>
                    `mmd_id` int(11) NOT NULL,</br>
                    `status` int(2) NOT NULL,</br>
                    `due_on` datetime NOT NULL</br>
                    ) ENGINE=InnoDB AUTO_INCREMENT=2486 DEFAULT CHARSET=utf8;
                </div>
            </div>
            </br>
        </td>
    </tr>

    <tr>
        <td><?= $this->Html->link('Home', ['action' => 'manual']) ?><br></td>
    </tr>

</table>












