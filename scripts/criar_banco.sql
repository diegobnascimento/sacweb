--
-- Database: `db_confort`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcli`
--

CREATE TABLE IF NOT EXISTS `tbcli` (
  `clicod` int(11) NOT NULL,
  `clinome` varchar(80) NOT NULL,
  `clidoc` varchar(14) NOT NULL,
  `cliie` varchar(12) NOT NULL,
  `climail` varchar(80) NOT NULL,
  `cliend` varchar(80) NOT NULL,
  `clinum` varchar(6) NOT NULL,
  `clibai` varchar(80) NOT NULL,
  `clicid` varchar(80) NOT NULL,
  `cliuf` char(2) NOT NULL,
  `clicep` char(8) NOT NULL,
  `clitel` char(10) NOT NULL,
  `clicel` char(11) NOT NULL,
  `cliop` int(11) NOT NULL,
  `cliobs1` varchar(80) NOT NULL,  
  `cliobs2` varchar(80) NOT NULL,
  `cliobs3` varchar(80) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `tbfor`
--

CREATE TABLE IF NOT EXISTS `tbfor` (
  `forcod` int(11) NOT NULL,
  `fornome` varchar(80) NOT NULL,
  `fordoc` varchar(14) NOT NULL,
  `forie` varchar(12) NOT NULL,
  `formail` varchar(80) NOT NULL,
  `forend` varchar(80) NOT NULL,
  `fornum` varchar(6) NOT NULL,
  `forbai` varchar(80) NOT NULL,
  `forcid` varchar(80) NOT NULL,
  `foruf` char(2) NOT NULL,
  `forcep` char(8) NOT NULL,
  `fortel` char(10) NOT NULL,
  `forcel` char(11) NOT NULL,
  `forop` int(11) NOT NULL,
  `forobs1` varchar(80) NOT NULL,  
  `forobs2` varchar(80) NOT NULL,
  `forobs3` varchar(80) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `tbemp`
--

CREATE TABLE IF NOT EXISTS `tbemp` (
  `empcod` int(11) NOT NULL,
  `empnome` varchar(80) NOT NULL,
  `empfant` varchar(80) NOT NULL,
  `empcnpj` varchar(14) NOT NULL,
  `empie` varchar(12) NOT NULL,
  `empend` varchar(80) NOT NULL,
  `empnum` varchar(6) NOT NULL,
  `empbai` varchar(80) NOT NULL,
  `empcid` varchar(80) NOT NULL,
  `empuf` char(2) NOT NULL,
  `empcep` varchar(8) NOT NULL,
  `emptel` varchar(11) NOT NULL,
  `empmail` varchar(80) NOT NULL,
  `empnfe` char(3) NOT NULL DEFAULT 'NAO'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbemp`
--

INSERT INTO `tbemp` (`empcod`, `empnome`, `empfant`, `empcnpj`, `empie`, `empend`, `empnum`, `empbai`, `empcid`, `empuf`, `empcep`, `emptel`, `empmail`) VALUES
(1, '', '', '', '', '', '', '', '', '', '', '', '');

--
-- Estrutura da tabela `tbop`
--

CREATE TABLE IF NOT EXISTS `tbop` (
  `opcod` int(11) NOT NULL,
  `opmail` varchar(50) NOT NULL,
  `opsenha` varchar(10) NOT NULL,
  `opnome` varchar(80) NOT NULL,
  `optipo` char(1) NOT NULL,
  `opreg` varchar(50) NOT NULL,
  `opcel` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbop`
--

INSERT INTO `tbop` (`opcod`, `opmail`, `opsenha`, `opnome`, `optipo`, `opreg`, `opcel`) VALUES
(1, 'admin@sacsystem', 'admin', 'ADMINISTRADOR', 'G', '', '');

--
-- Estrutura da tabela `tbcar`
--

CREATE TABLE IF NOT EXISTS `tbcar` (
  `carcod` int(11) NOT NULL,
  `carmod` varchar(30) NOT NULL,
  `carfab` varchar(30) NOT NULL,
  `carplaca` char(7) NOT NULL,
  `carporte` varchar(7) NOT NULL,
  `caruf` char(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `tbped`
--

CREATE TABLE IF NOT EXISTS `tbped` (
  `pedcod` int(11) NOT NULL,
  `pedcli` int(11) NOT NULL,
  `pedncli` varchar(80) NOT NULL,
  `pedfor` int(11) NOT NULL,
  `pednfor` varchar(80) NOT NULL,
  `peddata` date NOT NULL,
  `pedhora` time NOT NULL,
  `pedop` int(11) NOT NULL,
  `pednop` varchar(80) NOT NULL,
  `pedfrete` double NOT NULL,
  `peddesc` double NOT NULL,
  `pedtot` double NOT NULL,
  `pednfe` char(13) NOT NULL,
  `pedchave` char(44) NOT NULL,
  `pednfesit` varchar(13) NOT NULL,
  `pedtipo` char(1) NOT NULL,
  `pedvol` varchar(10) NOT NULL,
  `pedqvol` double NOT NULL DEFAULT '1' 
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `tbpro`
--

CREATE TABLE IF NOT EXISTS `tbpro` (
  `procod` int(11) NOT NULL,  
  `profcod` varchar(10) DEFAULT NULL,
  `pronome` varchar(80) NOT NULL,
  `proum` varchar(4) NOT NULL,
  `proval` double NOT NULL,
  `progtin` varchar(14) NOT NULL,
  `proncm` varchar(8) NOT NULL,
  `procest` varchar(7) NOT NULL,
  `proicms` varchar(3) NOT NULL,
  `proalqicms` double NOT NULL,
  `proipi` char(2) NOT NULL,
  `proalqipi` double NOT NULL,
  `propis` char(2) NOT NULL,
  `proalqpis` double NOT NULL,
  `procof` char(2) NOT NULL,
  `proalqcof` double NOT NULL,
  `progrupo` varchar(80) NOT NULL,
  `propeso` double NOT NULL,
  `procfopent` char(4) NOT NULL,
  `procfopsai` char(4) NOT NULL,
  `proenquad` char(3) NOT NULL,
  `proorig` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `tbsai`
--

CREATE TABLE IF NOT EXISTS `tbsai` (
  `saicod` int(11) NOT NULL,
  `saiped` int(11) NOT NULL,
  `saipro` varchar(10) NOT NULL,
  `sainpro` varchar(80) NOT NULL,
  `saigtin` varchar(14) NOT NULL,
  `saium` varchar(4) NOT NULL,
  `saiqtd` double NOT NULL,
  `saival` double NOT NULL,
  `saitot` double NOT NULL,
  `saigrupo` varchar(80) NOT NULL,
  `saincm` varchar(8) NOT NULL,
  `saicest` varchar(7) NOT NULL,
  `saiicms` char(3) NOT NULL,
  `saialqicms` double NOT NULL,
  `saiipi` char(2) NOT NULL,
  `saialqipi` double NOT NULL,
  `saipis` char(2) NOT NULL,
  `saialqpis` double NOT NULL,
  `saicof` char(2) NOT NULL,
  `saialqcof` double NOT NULL,
  `saipeso` double NOT NULL,
  `saicfop` char(4) NOT NULL,
  `saienquad` char(3) NOT NULL,
  `saiorig` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

--
-- Indexes for table `tbcli`
--
ALTER TABLE `tbcli`
  ADD PRIMARY KEY (`clicod`);

--
-- Indexes for table `tbcli`
--
ALTER TABLE `tbfor`
  ADD PRIMARY KEY (`forcod`);

--
-- Indexes for table `tbemp`
--
ALTER TABLE `tbemp`
  ADD PRIMARY KEY (`empcod`);  

--
-- Indexes for table `tbop`
--
ALTER TABLE `tbop`
  ADD PRIMARY KEY (`opcod`);
  
--
-- Indexes for table `tbcar`
--
ALTER TABLE `tbcar`
  ADD PRIMARY KEY (`carcod`);

--
-- Indexes for table `tbped`
--
ALTER TABLE `tbped`
  ADD PRIMARY KEY (`pedcod`);

--
-- Indexes for table `tbpro`
--
ALTER TABLE `tbpro`
  ADD PRIMARY KEY (`procod`),
  ADD UNIQUE KEY `UK_TBPRO_PROFCOD` (`profcod`);

--
-- Indexes for table `tbsai`
--
ALTER TABLE `tbsai`
  ADD PRIMARY KEY (`saicod`);

--
-- AUTO_INCREMENT for table `tbcli`
--
ALTER TABLE `tbcli`
  MODIFY `clicod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
  
--
-- AUTO_INCREMENT for table `tbfor`
--
ALTER TABLE `tbfor`
  MODIFY `forcod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
  
--
-- AUTO_INCREMENT for table `tbop`
--
ALTER TABLE `tbop`
  MODIFY `opcod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
  
--
-- AUTO_INCREMENT for table `tbcar`
--
ALTER TABLE `tbcar`
  MODIFY `carcod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
  
--
-- AUTO_INCREMENT for table `tbped`
--
ALTER TABLE `tbped`
  MODIFY `pedcod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
  
--
-- AUTO_INCREMENT for table `tbpro`
--
ALTER TABLE `tbpro`
  MODIFY `procod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
  
--
-- AUTO_INCREMENT for table `tbsai`
--
ALTER TABLE `tbsai`
  MODIFY `saicod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
  
--
-- AUTO_INCREMENT for table `tbemp`
--
ALTER TABLE `tbemp`
  MODIFY `empcod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;