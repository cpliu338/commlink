<h1>Calibrations</h1>
<pre>
DROP TABLE IF EXISTS `calibrations`;
CREATE TABLE IF NOT EXISTS `calibrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
-- looked up from mmds table
  `mmd_id` int(11) NOT NULL,
-- raw column Cal_Org should use autocomplete for editing, need to normalize
  `agent` varchar(255) NOT NULL,
-- raw column (freq) is ONE YEAR, TWO ... FIVE YEARS, use freq_in_months to do date arithmetic
  `freq_in_months` int(16) NOT NULL,
-- raw column cal_date
  `last_cal_date` date NOT NULL,
-- raw column ncal_date
  `next_cal_date` date NOT NULL,
-- raw column Cal_Rmk
  `remarks` text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
</pre>
<h1>Mmds</h1>
<pre>
DROP TABLE IF EXISTS `mmds`;
-- text column changes: ['¡?'=>'+/-', 'oC'=>'degC']
CREATE TABLE IF NOT EXISTS `mmds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
-- raw column MMD_NO
  `mmd_no` varchar(16) NOT NULL,
-- raw column EQT_NAME
  `eqt_name` varchar(64) NOT NULL,
-- looked up from clients table
  `mmd_client_id` int(8) NOT NULL,
-- raw column MFT
  `manufacturer` varchar(32) NOT NULL,
-- raw column MODEL
  `model` varchar(32) NOT NULL,
-- raw column SN
  `serial_no` varchar(64) NOT NULL,
-- raw column Range, oC to degC
  `nom_range` varchar(32) NOT NULL,
-- raw column Cal_Pt, oC to degC
  `cal_pts` varchar(32) NOT NULL,
-- raw column Cal_Std
  `cal_standard` varchar(64) NOT NULL,
-- raw column Wk_Range, oC to degC
  `work_range` varchar(32) NOT NULL,
-- raw column TOL
  `tolerance` varchar(32) NOT NULL,
-- raw column Reg_Rmk
  `remarks` TEXT NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

</pre>
<h1>MmdClients</h1>
<pre>
DROP TABLE IF EXISTS `mmd_clients`;
CREATE TABLE IF NOT EXISTS `mmd_clients` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
-- new column, a list of posts to look up in ITNRS
  `contacts` TEXT NOT NULL DEFAULT '',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- mmd_clients is initialized by INSERT INTO mmd_clients (name) (SELECT DISTINCT SECTION FROM `mmdrg` ORDER BY SECTION)
</pre>