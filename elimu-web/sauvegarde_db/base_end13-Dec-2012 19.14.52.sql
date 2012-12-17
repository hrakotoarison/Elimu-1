-- ----------------------
-- dump de la base elimu au 13-Dec-2012
-- ----------------------


-- -----------------------------
-- creation de la table absence_eleve
-- -----------------------------
CREATE TABLE `absence_eleve` (
  `personnel` varchar(50) NOT NULL default '',
  `date_debut` date NOT NULL default '0000-00-00',
  `horaire_debut` time NOT NULL default '00:00:00',
  `horaire_fin` time NOT NULL default '00:00:00',
  `date_fin` date NOT NULL default '0000-00-00',
  `motif` varchar(100) NOT NULL default '',
  `annee` varchar(12) NOT NULL default '',
  `type` varchar(50) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table absence_personnel
-- -----------------------------
CREATE TABLE `absence_personnel` (
  `personnel` varchar(50) NOT NULL default '',
  `date_debut` date NOT NULL default '0000-00-00',
  `horaire_debut` time NOT NULL default '00:00:00',
  `horaire_fin` time NOT NULL default '00:00:00',
  `date_fin` date NOT NULL default '0000-00-00',
  `motif` varchar(100) NOT NULL default '',
  `annee` varchar(12) NOT NULL default '',
  `type` varchar(50) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table administrateurs
-- -----------------------------
CREATE TABLE `administrateurs` (
  `id` int(11) NOT NULL auto_increment,
  `Login1` varchar(20) NOT NULL default '',
  `Mot_de_Passe7` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table apreciations
-- -----------------------------
CREATE TABLE `apreciations` (
  `id` int(11) NOT NULL auto_increment,
  `libelle1` varchar(50) NOT NULL default '',
  `mini` varchar(11) NOT NULL default '0',
  `maxi` varchar(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `libelle` (`libelle1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table cahier_absence
-- -----------------------------
CREATE TABLE `cahier_absence` (
  `eleve` varchar(50) NOT NULL default '',
  `datejour` date NOT NULL default '0000-00-00',
  `emploi` varchar(50) NOT NULL default '',
  `annee` varchar(12) NOT NULL default '',
  `semestre` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`eleve`,`datejour`,`emploi`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table cahier_retard
-- -----------------------------
CREATE TABLE `cahier_retard` (
  `eleve` varchar(50) NOT NULL default '',
  `datejour` date NOT NULL default '0000-00-00',
  `emploi` varchar(50) NOT NULL default '',
  `annee` varchar(12) NOT NULL default '',
  `semestre` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`eleve`,`datejour`,`emploi`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table categories
-- -----------------------------
CREATE TABLE `categories` (
  `cycle` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`cycle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table classe_superieur
-- -----------------------------
CREATE TABLE `classe_superieur` (
  `classeinf` varchar(100) NOT NULL default '',
  `classesup` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`classeinf`,`classesup`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table classes
-- -----------------------------
CREATE TABLE `classes` (
  `etude` varchar(50) NOT NULL default '',
  `numero` varchar(50) default NULL,
  `libelle` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`libelle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table coefficients
-- -----------------------------
CREATE TABLE `coefficients` (
  `idcoef` int(11) NOT NULL auto_increment,
  `coef` varchar(20) NOT NULL default '0',
  `discipline` varchar(50) NOT NULL default '',
  `etude` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`idcoef`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table conduite
-- -----------------------------
CREATE TABLE `conduite` (
  `cycle` varchar(50) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table connecter
-- -----------------------------
CREATE TABLE `connecter` (
  `personnel` varchar(50) NOT NULL default '',
  `date_connect` date NOT NULL default '0000-00-00',
  `profile` varchar(50) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table corps5
-- -----------------------------
CREATE TABLE `corps5` (
  `id` int(11) NOT NULL auto_increment,
  `libelle1` varchar(35) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table cours
-- -----------------------------
CREATE TABLE `cours` (
  `classe` varchar(50) NOT NULL default '',
  `emploi` varchar(50) NOT NULL default '',
  `datejour` date NOT NULL default '0000-00-00',
  `titre` varchar(150) NOT NULL default '',
  `cahier_texte` blob NOT NULL,
  `annee` varchar(12) NOT NULL default '',
  `semestre` varchar(20) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table credit_horaire
-- -----------------------------
CREATE TABLE `credit_horaire` (
  `idch` int(11) NOT NULL auto_increment,
  `discipline` varchar(100) NOT NULL default '',
  `credit_horaire` varchar(11) NOT NULL default '0',
  `nbre_lesson` varchar(11) NOT NULL default '0',
  `etude` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`idch`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table decisions
-- -----------------------------
CREATE TABLE `decisions` (
  `libelle` varchar(50) NOT NULL default '',
  `mini` float NOT NULL default '0',
  `maxi` float NOT NULL default '0',
  `etude` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`libelle`,`etude`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table disciplines
-- -----------------------------
CREATE TABLE `disciplines` (
  `iddis` int(11) NOT NULL auto_increment,
  `libelle1` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`iddis`),
  UNIQUE KEY `libelle1` (`libelle1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table echelons5
-- -----------------------------
CREATE TABLE `echelons5` (
  `id` int(11) NOT NULL auto_increment,
  `libelle1` varchar(35) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table eleves
-- -----------------------------
CREATE TABLE `eleves` (
  `matricule` varchar(15) NOT NULL default '',
  `prenom8` varchar(50) NOT NULL default '',
  `nom8` varchar(50) NOT NULL default '',
  `sexe8` varchar(20) NOT NULL default '',
  `date_nais8` date NOT NULL default '0000-00-00',
  `lieu_nais8` varchar(100) NOT NULL default '',
  `tuteur8` varchar(100) NOT NULL default '',
  `email_tuteur8` varchar(50) NOT NULL default '',
  `tel_tuteur8` varchar(20) NOT NULL default '',
  `tel_eleve8` varchar(20) NOT NULL default '',
  `email_eleve8` varchar(50) NOT NULL default '',
  `adresse8` varchar(100) default NULL,
  `photo8` varchar(100) default NULL,
  `enable8` varchar(20) NOT NULL default 'true',
  PRIMARY KEY  (`matricule`),
  KEY `tel_eleve` (`tel_eleve8`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table emploi_temps
-- -----------------------------
CREATE TABLE `emploi_temps` (
  `id` int(11) NOT NULL auto_increment,
  `jour` int(50) NOT NULL default '0',
  `debut` time NOT NULL default '00:00:00',
  `fin` time NOT NULL default '00:00:00',
  `discipline` varchar(50) NOT NULL default '',
  `professeur` varchar(50) NOT NULL default '',
  `annee` varchar(12) NOT NULL default '',
  `salle` varchar(20) NOT NULL default '',
  `semestre` varchar(20) NOT NULL default '',
  `classe` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table enable5
-- -----------------------------
CREATE TABLE `enable5` (
  `id` int(11) NOT NULL auto_increment,
  `libelle` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table enseignant
-- -----------------------------
CREATE TABLE `enseignant` (
  `personnel` varchar(50) NOT NULL default '',
  `classe` varchar(50) NOT NULL default '',
  `annee` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`classe`,`personnel`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table enseigner
-- -----------------------------
CREATE TABLE `enseigner` (
  `personnel` varchar(50) NOT NULL default '',
  `classe` varchar(50) NOT NULL default '',
  `discipline` varchar(50) NOT NULL default '',
  `annee` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`classe`,`discipline`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table etablissements
-- -----------------------------
CREATE TABLE `etablissements` (
  `ia` varchar(75) NOT NULL default '',
  `iden` varchar(75) NOT NULL default '',
  `libelle` varchar(100) NOT NULL default '',
  `logo` tinytext NOT NULL,
  `slogan` varchar(100) NOT NULL default 'EXCELLENCE',
  `date_ouverture` varchar(10) NOT NULL default '0000-00-00',
  `adresse` varchar(100) NOT NULL default '',
  `tel` varchar(100) NOT NULL default '',
  `bp` varchar(10) NOT NULL default '',
  `web` varchar(100) default NULL,
  `faxe` varchar(20) NOT NULL default '',
  `mail` varchar(100) NOT NULL default '',
  `status` varchar(30) NOT NULL default '',
  `date_installe` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`libelle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table etudes
-- -----------------------------
CREATE TABLE `etudes` (
  `niveau` varchar(75) NOT NULL default '',
  `serie` char(3) NOT NULL default '',
  `libelle` varchar(75) NOT NULL default '',
  `cycle` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`libelle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table evaluations
-- -----------------------------
CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL auto_increment,
  `date_prevue` date NOT NULL default '0000-00-00',
  `heure_debut` time NOT NULL default '00:00:00',
  `heure_fin` time NOT NULL default '00:00:00',
  `discipline` varchar(50) NOT NULL default '',
  `classe` varchar(20) NOT NULL default '',
  `type` varchar(25) NOT NULL default '',
  `semestre` varchar(10) NOT NULL default '',
  `annee` varchar(12) NOT NULL default '',
  `salle` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table filieres
-- -----------------------------
CREATE TABLE `filieres` (
  `sigle1` varchar(10) NOT NULL default '',
  `libelle1` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`sigle1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table fonction
-- -----------------------------
CREATE TABLE `fonction` (
  `personnel` varchar(50) NOT NULL default '',
  `profile` varchar(50) NOT NULL default '',
  `cycle` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`personnel`,`profile`,`cycle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table formules
-- -----------------------------
CREATE TABLE `formules` (
  `libelle` varchar(100) NOT NULL default '',
  `valeur` varchar(10) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table grades5
-- -----------------------------
CREATE TABLE `grades5` (
  `id` int(11) NOT NULL auto_increment,
  `libelle1` varchar(35) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table honneurs
-- -----------------------------
CREATE TABLE `honneurs` (
  `id` int(11) NOT NULL auto_increment,
  `libelle1` varchar(50) NOT NULL default '',
  `mini` varchar(11) NOT NULL default '0',
  `maxi` varchar(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `libelle1` (`libelle1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table horaires
-- -----------------------------
CREATE TABLE `horaires` (
  `code` int(11) NOT NULL auto_increment,
  `debut` time NOT NULL default '00:00:00',
  `fin` time NOT NULL default '00:00:00',
  PRIMARY KEY  (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table inscription
-- -----------------------------
CREATE TABLE `inscription` (
  `eleve` varchar(15) NOT NULL default '',
  `classe` varchar(15) NOT NULL default '',
  `redoublant` char(3) NOT NULL default '',
  `date_inscription` date NOT NULL default '0000-00-00',
  `annee` varchar(12) NOT NULL default '',
  `agent` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`eleve`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table jours
-- -----------------------------
CREATE TABLE `jours` (
  `id` int(11) NOT NULL auto_increment,
  `libelle` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table matrimonial5
-- -----------------------------
CREATE TABLE `matrimonial5` (
  `id` int(11) NOT NULL auto_increment,
  `libelle` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table modulaire
-- -----------------------------
CREATE TABLE `modulaire` (
  `module` varchar(100) NOT NULL default '',
  `discipline` varchar(100) NOT NULL default '',
  `etude` varchar(50) NOT NULL default '',
  `notesup` float NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table modules
-- -----------------------------
CREATE TABLE `modules` (
  `libelle` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`libelle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table moyennes
-- -----------------------------
CREATE TABLE `moyennes` (
  `eleve` varchar(50) NOT NULL default '',
  `moyenne` double NOT NULL default '0',
  `semestre` varchar(10) NOT NULL default '0',
  `annee` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`eleve`,`moyenne`,`semestre`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table note_conduite
-- -----------------------------
CREATE TABLE `note_conduite` (
  `eleve` varchar(50) NOT NULL default '',
  `note` varchar(12) NOT NULL default '',
  `semestre` varchar(12) NOT NULL default '',
  `annee` varchar(12) NOT NULL default '',
  `code` int(11) NOT NULL auto_increment,
  `personnel` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table notes
-- -----------------------------
CREATE TABLE `notes` (
  `eleve` varchar(20) NOT NULL default '',
  `note` decimal(5,3) NOT NULL default '0.000',
  `evaluation` int(20) NOT NULL default '0',
  `code` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table passer
-- -----------------------------
CREATE TABLE `passer` (
  `eleve` varchar(50) NOT NULL default '',
  `proposition` varchar(50) NOT NULL default '',
  `annee` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`eleve`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table periodes
-- -----------------------------
CREATE TABLE `periodes` (
  `numero` varchar(11) NOT NULL default '',
  `mois` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`numero`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table personnels
-- -----------------------------
CREATE TABLE `personnels` (
  `matricule` varchar(15) NOT NULL default '0',
  `titre8` varchar(10) NOT NULL default '',
  `prenom` varchar(50) NOT NULL default '',
  `nom` varchar(50) NOT NULL default '',
  `matrimonial8` varchar(12) NOT NULL default '',
  `sexe8` varchar(15) NOT NULL default '',
  `date_nais8` varchar(12) NOT NULL default '0000-00-00',
  `lieu_nais8` varchar(50) NOT NULL default '',
  `tel` varchar(15) NOT NULL default '',
  `adresse` varchar(75) NOT NULL default '',
  `email8` varchar(50) NOT NULL default '',
  `photo8` varchar(50) NOT NULL default '',
  `enable8` varchar(20) NOT NULL default 'true',
  `corps5` varchar(20) NOT NULL default '',
  `grades5` varchar(20) NOT NULL default '',
  `echelons5` varchar(20) NOT NULL default '',
  `date_entre8` varchar(11) NOT NULL default '0000-00-00',
  PRIMARY KEY  (`matricule`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table profiles
-- -----------------------------
CREATE TABLE `profiles` (
  `libelle` varchar(100) NOT NULL default '',
  `cycle` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`libelle`,`cycle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table remarques
-- -----------------------------
CREATE TABLE `remarques` (
  `id` int(11) NOT NULL auto_increment,
  `libelle1` varchar(50) NOT NULL default '',
  `mini` varchar(11) NOT NULL default '0',
  `maxi` varchar(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `libelle` (`libelle1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table retard
-- -----------------------------
CREATE TABLE `retard` (
  `eleve` varchar(50) NOT NULL default '',
  `horaire` varchar(50) NOT NULL default '',
  `datejour` date NOT NULL default '0000-00-00',
  `enseigner` varchar(50) NOT NULL default '',
  `annee` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`eleve`,`horaire`,`datejour`,`enseigner`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table salles
-- -----------------------------
CREATE TABLE `salles` (
  `id` int(11) NOT NULL auto_increment,
  `libelle1` varchar(50) NOT NULL default '',
  `capacite` varchar(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `libelle` (`libelle1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table semestres
-- -----------------------------
CREATE TABLE `semestres` (
  `id` varchar(10) NOT NULL default '',
  `libelle` varchar(50) NOT NULL default '',
  `date_debut` date NOT NULL default '0000-00-00',
  `date_fin` date NOT NULL default '0000-00-00',
  `cycle` varchar(50) NOT NULL default '',
  `annee` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`id`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table series
-- -----------------------------
CREATE TABLE `series` (
  `id` int(11) NOT NULL auto_increment,
  `libelle1` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table sexe5
-- -----------------------------
CREATE TABLE `sexe5` (
  `id` int(11) NOT NULL auto_increment,
  `libelle` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table specialites
-- -----------------------------
CREATE TABLE `specialites` (
  `id` int(11) NOT NULL auto_increment,
  `professeur` varchar(50) NOT NULL default '',
  `discipline` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table surveiller
-- -----------------------------
CREATE TABLE `surveiller` (
  `personnel` varchar(50) NOT NULL default '',
  `classe` varchar(50) NOT NULL default '',
  `annee` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`personnel`,`classe`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table titre5
-- -----------------------------
CREATE TABLE `titre5` (
  `id` int(11) NOT NULL auto_increment,
  `libelle` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table user
-- -----------------------------
CREATE TABLE `user` (
  `cdeetud` varchar(50) NOT NULL default '0',
  `login1` varchar(10) NOT NULL default '',
  `motdepasse7` varchar(10) NOT NULL default '',
  `profile5` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`cdeetud`,`profile5`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



-- -----------------------------
-- insertions dans la table absence_eleve
-- -----------------------------

-- -----------------------------
-- insertions dans la table absence_personnel
-- -----------------------------

-- -----------------------------
-- insertions dans la table administrateurs
-- -----------------------------
INSERT INTO administrateurs VALUES(1, 'safia', 'safia');

-- -----------------------------
-- insertions dans la table apreciations
-- -----------------------------
INSERT INTO apreciations VALUES(2, 'TRÉS FAIBLE', '1', '5');

-- -----------------------------
-- insertions dans la table cahier_absence
-- -----------------------------
INSERT INTO cahier_absence VALUES('129/LO', 2012-11-28, '6', '2012/2013', 'S1');

-- -----------------------------
-- insertions dans la table cahier_retard
-- -----------------------------

-- -----------------------------
-- insertions dans la table categories
-- -----------------------------
INSERT INTO categories VALUES('ELEMENTAIRE');
INSERT INTO categories VALUES('MOYEN');
INSERT INTO categories VALUES('PRESCOLAIRE');
INSERT INTO categories VALUES('SECONDAIRE');

-- -----------------------------
-- insertions dans la table classe_superieur
-- -----------------------------

-- -----------------------------
-- insertions dans la table classes
-- -----------------------------
INSERT INTO classes VALUES('6i&eacute;me', 'C', '6i&eacute;meC');
INSERT INTO classes VALUES('6i&eacute;me', 'B', '6i&eacute;meB');
INSERT INTO classes VALUES('6i&eacute;me', 'A', '6i&eacute;meA');
INSERT INTO classes VALUES('6i&eacute;me', 'D', '6i&eacute;meD');
INSERT INTO classes VALUES('6i&eacute;me', 'E', '6i&eacute;meE');
INSERT INTO classes VALUES('6i&eacute;me', 'F', '6i&eacute;meF');
INSERT INTO classes VALUES('5i&eacute;me', 'A', '5i&eacute;meA');
INSERT INTO classes VALUES('5i&eacute;me', 'B', '5i&eacute;meB');
INSERT INTO classes VALUES('5i&eacute;me', 'C', '5i&eacute;meC');
INSERT INTO classes VALUES('4i&eacute;me', 'A', '4i&eacute;meA');
INSERT INTO classes VALUES('4i&eacute;me', 'B', '4i&eacute;meB');
INSERT INTO classes VALUES('3i&eacute;me', 'A', '3i&eacute;meA');
INSERT INTO classes VALUES('3i&eacute;me', 'B', '3i&eacute;meB');
INSERT INTO classes VALUES('2ndL', '', '2ndL');
INSERT INTO classes VALUES('2ndS', '', '2ndS');
INSERT INTO classes VALUES('1erL2', '', '1erL2');
INSERT INTO classes VALUES('TleL2', '', 'TleL2');

-- -----------------------------
-- insertions dans la table coefficients
-- -----------------------------
INSERT INTO coefficients VALUES(1, '4', '1', '3i&eacute;me');
INSERT INTO coefficients VALUES(2, '4', '1', '4i&eacute;me');
INSERT INTO coefficients VALUES(3, '4', '1', '5i&eacute;me');
INSERT INTO coefficients VALUES(4, '4', '1', '6i&eacute;me');
INSERT INTO coefficients VALUES(5, '2', '2', '3i&eacute;me');
INSERT INTO coefficients VALUES(6, '2', '2', '4i&eacute;me');
INSERT INTO coefficients VALUES(7, '2', '2', '5i&eacute;me');
INSERT INTO coefficients VALUES(8, '2', '2', '6i&eacute;me');
INSERT INTO coefficients VALUES(9, '2', '9', '3i&eacute;me');
INSERT INTO coefficients VALUES(10, '2', '9', '4i&eacute;me');
INSERT INTO coefficients VALUES(11, '2', '4', '3i&eacute;me');
INSERT INTO coefficients VALUES(12, '2', '4', '4i&eacute;me');
INSERT INTO coefficients VALUES(13, '2', '4', '5i&eacute;me');
INSERT INTO coefficients VALUES(14, '2', '4', '6i&eacute;me');
INSERT INTO coefficients VALUES(15, '2', '1', '1erL2');
INSERT INTO coefficients VALUES(16, '2', '1', '2ndL');
INSERT INTO coefficients VALUES(17, '5', '1', '2ndS');
INSERT INTO coefficients VALUES(18, '2', '1', 'TleL2');

-- -----------------------------
-- insertions dans la table conduite
-- -----------------------------
INSERT INTO conduite VALUES('MOYEN');

-- -----------------------------
-- insertions dans la table connecter
-- -----------------------------
INSERT INTO connecter VALUES('478512/P', 2012-12-08, 'SURVEILLANT');
INSERT INTO connecter VALUES('654-op', 2012-12-08, 'PROFESSEUR');
INSERT INTO connecter VALUES('12354/A', 2012-12-10, 'CENSEUR');

-- -----------------------------
-- insertions dans la table corps5
-- -----------------------------
INSERT INTO corps5 VALUES(1, 'corps12');

-- -----------------------------
-- insertions dans la table cours
-- -----------------------------
INSERT INTO cours VALUES('3i&eacute;meA', '5', 2012-11-28, 'test titre leçon', '<p>detail test le&ccedil;on</p>', '2012/2013', 'S1');

-- -----------------------------
-- insertions dans la table credit_horaire
-- -----------------------------
INSERT INTO credit_horaire VALUES(1, '1', '50', '0', '6i&eacute;me');
INSERT INTO credit_horaire VALUES(2, '1', '60', '0', '5i&eacute;me');
INSERT INTO credit_horaire VALUES(3, '1', '70', '0', '4i&eacute;me');
INSERT INTO credit_horaire VALUES(4, '1', '80', '0', '3i&eacute;me');
INSERT INTO credit_horaire VALUES(5, '2', '30', '0', '6i&eacute;me');
INSERT INTO credit_horaire VALUES(6, '2', '30', '0', '5i&eacute;me');
INSERT INTO credit_horaire VALUES(7, '2', '30', '0', '4i&eacute;me');
INSERT INTO credit_horaire VALUES(8, '2', '30', '0', '3i&eacute;me');
INSERT INTO credit_horaire VALUES(9, '4', '20', '0', '6i&eacute;me');
INSERT INTO credit_horaire VALUES(10, '4', '20', '0', '5i&eacute;me');
INSERT INTO credit_horaire VALUES(11, '4', '20', '10', '4i&eacute;me');
INSERT INTO credit_horaire VALUES(12, '4', '24', '7', '3i&eacute;me');
INSERT INTO credit_horaire VALUES(13, '9', '0', '0', '6i&eacute;me');
INSERT INTO credit_horaire VALUES(14, '9', '0', '0', '5i&eacute;me');
INSERT INTO credit_horaire VALUES(15, '9', '20', '0', '4i&eacute;me');
INSERT INTO credit_horaire VALUES(16, '9', '20', '0', '3i&eacute;me');
INSERT INTO credit_horaire VALUES(22, '7', '10', '5', '5i&eacute;me');
INSERT INTO credit_horaire VALUES(21, '7', '20', '10', '6i&eacute;me');
INSERT INTO credit_horaire VALUES(23, '7', '15', '7', '4i&eacute;me');
INSERT INTO credit_horaire VALUES(24, '7', '30', '17', '3i&eacute;me');
INSERT INTO credit_horaire VALUES(25, '1', '40', '20', '2ndL');
INSERT INTO credit_horaire VALUES(26, '1', '60', '30', '2ndS');
INSERT INTO credit_horaire VALUES(27, '1', '20', '10', '1erL2');
INSERT INTO credit_horaire VALUES(28, '1', '20', '10', 'TleL2');

-- -----------------------------
-- insertions dans la table decisions
-- -----------------------------

-- -----------------------------
-- insertions dans la table disciplines
-- -----------------------------
INSERT INTO disciplines VALUES(1, 'Mathématiques');
INSERT INTO disciplines VALUES(2, 'Anglais');
INSERT INTO disciplines VALUES(3, 'Français');
INSERT INTO disciplines VALUES(4, 'Histoire');
INSERT INTO disciplines VALUES(5, 'eps');
INSERT INTO disciplines VALUES(6, 'Sciences physique');
INSERT INTO disciplines VALUES(7, 'SVT');
INSERT INTO disciplines VALUES(8, 'Phylosophie');
INSERT INTO disciplines VALUES(9, 'Arabe');
INSERT INTO disciplines VALUES(10, 'Espagnol');
INSERT INTO disciplines VALUES(11, 'education civique');
INSERT INTO disciplines VALUES(12, 'Géographie');

-- -----------------------------
-- insertions dans la table echelons5
-- -----------------------------
INSERT INTO echelons5 VALUES(1, 'Echelon1');
INSERT INTO echelons5 VALUES(2, 'echelon2');

-- -----------------------------
-- insertions dans la table eleves
-- -----------------------------
INSERT INTO eleves VALUES('125-OP', 'ABDOULAYE', 'FALL', '1', 1998-10-01, 'DAKAR', 'SALIMATA NDIAYE', 'salam@yahoo.fr', '776124587', '415', '', 'PATTE DOIE VILLA N°12', 'eleve125-OP.JPG', 'true');
INSERT INTO eleves VALUES('1247-45', 'ABDOULAYE', 'NDIAYE', '1', 1998-08-01, 'YEUMBEUL SUD', 'ANDALLA MBENGUE', 'sades@gmail.com', '766822529', '773126042', 'amprojet@gmail.com', 'MÉDINA FASS MBAO, KM16', '', 'true');
INSERT INTO eleves VALUES('124-AZ', 'FATOU', 'FALL', '2', 1999-11-07, 'MÉDINA', 'BAYE COLY', 'sadez@gmail.com', '776548215', '', '', 'DAKAR,LIBERTÉ 5 VILLA N°125A', 'eleve124-AZ.JPG', 'true');
INSERT INTO eleves VALUES('856-ER', 'LAMINE', 'FALL', '1', 1996-08-02, 'KEUR MASSAR', 'BABACAR FALL', 'babar@yahoo.fr', '701248595', '', '', 'KEUR MASSAR', 'eleve856-ER.JPG', 'true');
INSERT INTO eleves VALUES('521-UJ', 'SADIYA', 'FALL', '2', 2006-11-11, 'KOLDA', 'SODA SEYE', '', '768652523', '', '', 'GRAND MBAO', '', 'true');
INSERT INTO eleves VALUES('129/LO', 'MODOU', 'SARR', '1', 1996-11-01, 'CAMBÉRÉNE1', 'NGOUDA SARR', 'keurrama@gmail.com', '775449425', '77', 'medzo@yahoo.fr', 'CAMBÉRÉNE 1', '', 'true');

-- -----------------------------
-- insertions dans la table emploi_temps
-- -----------------------------
INSERT INTO emploi_temps VALUES(1, 1, 08:00:00, 10:00:00, '4', '654-op', '2012/2013', '1', 'S1', '3i&eacute;meA');
INSERT INTO emploi_temps VALUES(5, 3, 08:00:00, 10:00:00, '9', '654-op', '2012/2013', '1', 'S1', '3i&eacute;meA');
INSERT INTO emploi_temps VALUES(3, 2, 08:00:00, 10:00:00, '4', '654-op', '2012/2013', '2', 'S1', '3i&eacute;meB');
INSERT INTO emploi_temps VALUES(6, 3, 15:00:00, 17:00:00, '4', '654-op', '2012/2013', '1', 'S1', '3i&eacute;meA');
INSERT INTO emploi_temps VALUES(7, 4, 10:00:00, 12:00:00, '1', '1245/AM', '2012/2013', '1', 'S1', '3i&eacute;meA');
INSERT INTO emploi_temps VALUES(8, 5, 08:00:00, 10:00:00, '1', '1245/AM', '2012/2013', '1', 'S1', '3i&eacute;meA');

-- -----------------------------
-- insertions dans la table enable5
-- -----------------------------
INSERT INTO enable5 VALUES(1, 'true');
INSERT INTO enable5 VALUES(2, 'retraite');
INSERT INTO enable5 VALUES(3, 'affectation');

-- -----------------------------
-- insertions dans la table enseignant
-- -----------------------------
INSERT INTO enseignant VALUES('', '', '');

-- -----------------------------
-- insertions dans la table enseigner
-- -----------------------------
INSERT INTO enseigner VALUES('654-op', '3i&eacute;meA', '9', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '4i&eacute;meA', '9', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '3i&eacute;meA', '4', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '3i&eacute;meB', '4', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '4i&eacute;meA', '4', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '4i&eacute;meB', '4', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '5i&eacute;meA', '4', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '5i&eacute;meB', '4', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '3i&eacute;meA', '1', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '4i&eacute;meA', '1', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '6i&eacute;meB', '1', '2012/2013');

-- -----------------------------
-- insertions dans la table etablissements
-- -----------------------------
INSERT INTO etablissements VALUES(' DAKAR', ' GRAND YOFF', 'SAMIBOU', '', '', '2008-10-16', 'grand yoff', '338658585', '', '', '', 'contact@gmail.com', '', 2012-12-08);

-- -----------------------------
-- insertions dans la table etudes
-- -----------------------------
INSERT INTO etudes VALUES('6i&eacute;me', '', '6i&eacute;me', 'MOYEN');
INSERT INTO etudes VALUES('5i&eacute;me', '', '5i&eacute;me', 'MOYEN');
INSERT INTO etudes VALUES('4i&eacute;me', '', '4i&eacute;me', 'MOYEN');
INSERT INTO etudes VALUES('3i&eacute;me', '', '3i&eacute;me', 'MOYEN');
INSERT INTO etudes VALUES('2nd', 'L', '2ndL', 'SECONDAIRE');
INSERT INTO etudes VALUES('2nd', 'S', '2ndS', 'SECONDAIRE');
INSERT INTO etudes VALUES('1er', 'L2', '1erL2', 'SECONDAIRE');
INSERT INTO etudes VALUES('Tle', 'L2', 'TleL2', 'SECONDAIRE');

-- -----------------------------
-- insertions dans la table evaluations
-- -----------------------------
INSERT INTO evaluations VALUES(1, 2012-11-28, 08:00:00, 10:00:00, '9', '3i&eacute;meA', 'DEVOIR', 'S1', '2012/2013', '1');
INSERT INTO evaluations VALUES(3, 2012-12-06, 08:00:00, 10:00:00, '9', '3i&eacute;meA', 'COMPOSITION', 'S1', '2012/2013', '1');
INSERT INTO evaluations VALUES(4, 2012-12-01, 08:00:00, 10:00:00, '1', '3i&eacute;meA', 'DEVOIR', 'S1', '2012/2013', '1');
INSERT INTO evaluations VALUES(5, 2012-12-15, 10:00:00, 12:00:00, '1', '3i&eacute;meA', 'COMPOSITION', 'S1', '2012/2013', '1');

-- -----------------------------
-- insertions dans la table filieres
-- -----------------------------

-- -----------------------------
-- insertions dans la table fonction
-- -----------------------------
INSERT INTO fonction VALUES('12354/54', 'PROFESSEUR', 'SECONDAIRE');
INSERT INTO fonction VALUES('124', 'PROFESSEUR', 'MOYEN');
INSERT INTO fonction VALUES('1245/AM', 'PROFESSEUR', 'MOYEN');
INSERT INTO fonction VALUES('1270/AN', 'SURVEILLANT', 'SECONDAIRE');
INSERT INTO fonction VALUES('1271/OP', 'PROFESSEUR', 'SECONDAIRE');
INSERT INTO fonction VALUES('1271/OP', 'SURVEILLANT', 'SECONDAIRE');
INSERT INTO fonction VALUES('1427-bn', 'PROFESSEUR', 'MOYEN');
INSERT INTO fonction VALUES('4578-az', 'SURVEILLANT', 'MOYEN');
INSERT INTO fonction VALUES('478512/P', 'SURVEILLANT', 'MOYEN');
INSERT INTO fonction VALUES('654-op', 'PROFESSEUR', 'MOYEN');

-- -----------------------------
-- insertions dans la table formules
-- -----------------------------
INSERT INTO formules VALUES('(MoySem1 + MoySem2)/2', '2');

-- -----------------------------
-- insertions dans la table grades5
-- -----------------------------
INSERT INTO grades5 VALUES(1, 'Grades1');

-- -----------------------------
-- insertions dans la table honneurs
-- -----------------------------
INSERT INTO honneurs VALUES(2, 'BLAME', '1', '6');

-- -----------------------------
-- insertions dans la table horaires
-- -----------------------------

-- -----------------------------
-- insertions dans la table inscription
-- -----------------------------
INSERT INTO inscription VALUES('125-OP', '6i&eacute;meB', 'NON', 2012-11-24, '2012/2013', '478512/P');
INSERT INTO inscription VALUES('1247-45', '6i&eacute;meB', 'NON', 2012-11-25, '2012/2013', '478512/P');
INSERT INTO inscription VALUES('124-AZ', '6i&eacute;meB', 'OUI', 2012-11-25, '2012/2013', '478512/P');
INSERT INTO inscription VALUES('856-ER', '6i&eacute;meB', 'OUI', 2012-11-25, '2012/2013', '478512/P');
INSERT INTO inscription VALUES('521-UJ', '6i&eacute;meA', 'NON', 2012-11-25, '2012/2013', '478512/P');
INSERT INTO inscription VALUES('129/LO', '3i&eacute;meA', 'NON', 2012-11-28, '2012/2013', '478512/P');

-- -----------------------------
-- insertions dans la table jours
-- -----------------------------
INSERT INTO jours VALUES(1, 'Lundi');
INSERT INTO jours VALUES(2, 'Mardi');
INSERT INTO jours VALUES(3, 'Mercredi');
INSERT INTO jours VALUES(4, 'Jeudi');
INSERT INTO jours VALUES(5, 'Vendredi');
INSERT INTO jours VALUES(6, 'Samedi');

-- -----------------------------
-- insertions dans la table matrimonial5
-- -----------------------------
INSERT INTO matrimonial5 VALUES(1, 'Marié(e)');
INSERT INTO matrimonial5 VALUES(2, 'Divorcé(e)');
INSERT INTO matrimonial5 VALUES(3, 'Célibataire');
INSERT INTO matrimonial5 VALUES(4, 'Veuf(ve)');

-- -----------------------------
-- insertions dans la table modulaire
-- -----------------------------

-- -----------------------------
-- insertions dans la table modules
-- -----------------------------

-- -----------------------------
-- insertions dans la table moyennes
-- -----------------------------

-- -----------------------------
-- insertions dans la table note_conduite
-- -----------------------------
INSERT INTO note_conduite VALUES('129/LO', '17', 'S1', '2012/2013', 1, '654-op');

-- -----------------------------
-- insertions dans la table notes
-- -----------------------------
INSERT INTO notes VALUES('129/LO', 17.000, 1, 3);
INSERT INTO notes VALUES('129/LO', 15.000, 3, 4);
INSERT INTO notes VALUES('129/LO', 12.000, 4, 5);
INSERT INTO notes VALUES('129/LO', 15.000, 5, 6);

-- -----------------------------
-- insertions dans la table passer
-- -----------------------------

-- -----------------------------
-- insertions dans la table periodes
-- -----------------------------

-- -----------------------------
-- insertions dans la table personnels
-- -----------------------------
INSERT INTO personnels VALUES('654-op', '1', 'ANDALLA', 'MBENGUE', '1', '1', '1983-08-02', 'YEUMBEUL', '776126042', 'FASS MBAO, TALLY MAME DIARA, Q MODOU FALL', 'amprojet@gmail.com', 'perso654-op.JPG', '1', '1', '1', '2', '2012-11-06');
INSERT INTO personnels VALUES('4578-az', '3', 'NDÉYE', 'COLY', '3', '2', '1985-10-12', 'YEUMBEIL', '776541243', 'FASS MBAO', 'colynd@yahoo.fr', '', '1', '1', '1', '2', '2010-10-01');
INSERT INTO personnels VALUES('1427-bn', '1', 'ALIOUNE', 'GUEYE', '3', '1', '1990-10-01', 'SAINT LOUIS', '766521245', 'HLM GRAND YOFF', 'kothie@gmail.com', 'perso1427-bn.jpg', '1', '1', '1', '1', '2011-10-01');
INSERT INTO personnels VALUES('12354/A', '1', 'NGOUDA', 'SARR', '1', '1', '1980-10-08', 'CAMBÉRÉNE1', '766521245', 'CAMBÉRÉNE1', 'keurama@gmail.com', 'perso12354-A.JPG', '1', '1', '1', '1', '2008-10-01');
INSERT INTO personnels VALUES('478512/P', '3', 'ALIMATOU', 'MBAYE', '1', '2', '1978-07-01', 'BAMBÉYE', '778569210', 'PARCELLE ASSAINIE U14', 'alima@yahoo.fr', 'perso478512-P.jpg', '1', '1', '1', '2', '2008-10-01');
INSERT INTO personnels VALUES('1245/AM', '1', 'SAMBA', 'FALL', '3', '1', '1984-01-12', 'LOUGA', '776124875', 'PA U22 N°15', 'samba@gmail.com', '', '1', '1', '1', '1', '2009-10-01');
INSERT INTO personnels VALUES('1271/OP', '1', 'TAPHA', 'SYLLA', '3', '1', '1977-08-15', 'DAKAR,MÉDINA', '776854582', 'MÉDINA', 'taf47@yahoo.fr', '', '1', '1', '1', '1', '2000-10-01');
INSERT INTO personnels VALUES('12354/54', '1', 'NDIAGA', 'COLY', '3', '1', '1983-08-06', 'DAKAR', '776126042', 'FASS', 'colynd@gmail.com', '', '1', '1', '1', '1', '2007-09-03');
INSERT INTO personnels VALUES('124', '1', 'MARÉMA', 'SEYE', '1', '2', '1969-12-06', 'KOLDA', '776126042', 'FASS MBAO', 'and@gmail.com', '', '1', '1', '1', '1', '2009-12-06');
INSERT INTO personnels VALUES('1270/AN', '1', 'ABOUL AZIZ', 'WADE', '1', '1', '1972-09-02', 'KEUR MASSAR', '776126042', 'KEUR MASSAR', 'wadesoft@gmail.com', '', '1', '1', '1', '1', '2002-10-04');

-- -----------------------------
-- insertions dans la table profiles
-- -----------------------------
INSERT INTO profiles VALUES('AUTRES', 'ELEMENTAIRE');
INSERT INTO profiles VALUES('AUTRES', 'MOYEN');
INSERT INTO profiles VALUES('AUTRES', 'SECONDAIRE');
INSERT INTO profiles VALUES('CENSEUR', 'SECONDAIRE');
INSERT INTO profiles VALUES('COMPTABLE', 'ELEMENTAIRE');
INSERT INTO profiles VALUES('COMPTABLE', 'MOYEN');
INSERT INTO profiles VALUES('COMPTABLE', 'SECONDAIRE');
INSERT INTO profiles VALUES('ENSEIGNANT', 'ELEMENTAIRE');
INSERT INTO profiles VALUES('PROFESSEUR', 'MOYEN');
INSERT INTO profiles VALUES('PROFESSEUR', 'SECONDAIRE');
INSERT INTO profiles VALUES('SURVEILLANT', 'MOYEN');
INSERT INTO profiles VALUES('SURVEILLANT', 'SECONDAIRE');
INSERT INTO profiles VALUES('SURVEILLANT GENERAL', 'MOYEN');
INSERT INTO profiles VALUES('SURVEILLANT GENERAL', 'SECONDAIRE');

-- -----------------------------
-- insertions dans la table remarques
-- -----------------------------
INSERT INTO remarques VALUES(2, 'ELEVE TRES FAIBLE', '1', '7');
INSERT INTO remarques VALUES(3, 'ELEVE FAIBLE', '7', '10');
INSERT INTO remarques VALUES(4, 'ELEVE PASSABLE', '10', '12');
INSERT INTO remarques VALUES(5, 'ASSEZ BON ELEVE', '12', '14');
INSERT INTO remarques VALUES(6, 'BON ELEVE', '14', '16');
INSERT INTO remarques VALUES(7, 'TRES BON ELEVE', '16', '18');
INSERT INTO remarques VALUES(8, 'EXCELLENT(E) ELEVE', '18', '21');

-- -----------------------------
-- insertions dans la table retard
-- -----------------------------

-- -----------------------------
-- insertions dans la table salles
-- -----------------------------
INSERT INTO salles VALUES(1, 'SALLE1', '100');
INSERT INTO salles VALUES(2, 'SALLE2', '150');

-- -----------------------------
-- insertions dans la table semestres
-- -----------------------------
INSERT INTO semestres VALUES('S1', 'PREMIER SEMESTRE', 2012-10-04, 2013-03-07, 'SUPERIEURE', '2012/2013');

-- -----------------------------
-- insertions dans la table series
-- -----------------------------
INSERT INTO series VALUES(1, 'L');
INSERT INTO series VALUES(2, 'S');
INSERT INTO series VALUES(3, 'S2');
INSERT INTO series VALUES(4, 'L2');

-- -----------------------------
-- insertions dans la table sexe5
-- -----------------------------
INSERT INTO sexe5 VALUES(1, 'Masculin');
INSERT INTO sexe5 VALUES(2, 'Féminin');

-- -----------------------------
-- insertions dans la table specialites
-- -----------------------------
INSERT INTO specialites VALUES(1, '654-op', '9');
INSERT INTO specialites VALUES(2, '654-op', '4');
INSERT INTO specialites VALUES(3, '1245/AM', '1');

-- -----------------------------
-- insertions dans la table surveiller
-- -----------------------------
INSERT INTO surveiller VALUES('1271/OP', '2ndL', '2012/2013');
INSERT INTO surveiller VALUES('1271/OP', '2ndS', '2012/2013');
INSERT INTO surveiller VALUES('4578-az', '4i&eacute;meA', '2012/2013');
INSERT INTO surveiller VALUES('4578-az', '4i&eacute;meB', '2012/2013');
INSERT INTO surveiller VALUES('478512/P', '3i&eacute;meA', '2012/2013');
INSERT INTO surveiller VALUES('478512/P', '3i&eacute;meB', '2012/2013');
INSERT INTO surveiller VALUES('478512/P', '6i&eacute;meA', '2012/2013');
INSERT INTO surveiller VALUES('478512/P', '6i&eacute;meB', '2012/2013');

-- -----------------------------
-- insertions dans la table titre5
-- -----------------------------
INSERT INTO titre5 VALUES(1, 'M.');
INSERT INTO titre5 VALUES(2, 'Mme');
INSERT INTO titre5 VALUES(3, 'Mlle');

-- -----------------------------
-- insertions dans la table user
-- -----------------------------
INSERT INTO user VALUES('654-op', 'mbopame', 'mbopame', 'PROFESSEUR');
INSERT INTO user VALUES('1427-bn', 'gueye', 'gueye', 'PROFESSEUR');
INSERT INTO user VALUES('4578-az', 'coly', 'coly', 'SURVEILLANT');
INSERT INTO user VALUES('12354/A', 'sarr', 'sarr', 'CENSEUR');
INSERT INTO user VALUES('478512/P', 'mbaye', 'mbaye', 'SURVEILLANT');
INSERT INTO user VALUES('1245/AM', 'samba', 'samba', 'PROFESSEUR');
INSERT INTO user VALUES('1271/OP', 'sylla', 'sylla', 'SURVEILLANT');
INSERT INTO user VALUES('1271/OP', 'sylla', 'sylla', 'PROFESSEUR');
INSERT INTO user VALUES('12354/54', 'ndiaga', 'ndiaga', 'PROFESSEUR');
INSERT INTO user VALUES('124', 'seye', 'seye', 'PROFESSEUR');
INSERT INTO user VALUES('1270/AN', 'wade', 'wade', 'SURVEILLANT');

