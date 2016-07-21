-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 21, 2016 at 12:42 AM
-- Server version: 5.5.49-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eotircom_irin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `userid` int(3) NOT NULL,
  `rank` int(11) NOT NULL,
  `teams` varchar(15) NOT NULL,
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userid`, `rank`, `teams`) VALUES
(0, 1, '0'),
(1, 5, '0'),
(2, 2, '35,31,32,33,34'),
(59, 3, '31,32,34'),
(60, 4, '31,34,35'),
(62, 1, '0'),
(63, 2, '31'),
(73, 1, '35'),
(79, 1, '31'),
(83, 1, '31'),
(86, 2, '34,32,35'),
(87, 3, '34,32,35'),
(89, 4, '33'),
(90, 1, '0'),
(91, 3, '32,33');

-- --------------------------------------------------------

--
-- Table structure for table `clearance_types`
--

CREATE TABLE IF NOT EXISTS `clearance_types` (
  `ctid` int(2) NOT NULL,
  `ctname` varchar(100) NOT NULL,
  PRIMARY KEY (`ctid`),
  UNIQUE KEY `2` (`ctname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clearance_types`
--

INSERT INTO `clearance_types` (`ctid`, `ctname`) VALUES
(1, 'Civilian'),
(2, 'Epsilon'),
(3, 'Delta Green'),
(4, 'Delta Red'),
(5, 'Alpha Green'),
(6, 'Alpha Blue'),
(7, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE IF NOT EXISTS `divisions` (
  `div_id` int(3) NOT NULL AUTO_INCREMENT,
  `div_name` varchar(100) NOT NULL,
  `subdiv` int(3) DEFAULT NULL,
  PRIMARY KEY (`div_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='List of IR Divisions' AUTO_INCREMENT=101 ;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`div_id`, `div_name`, `subdiv`) VALUES
(1, 'Ministry of Defense', NULL),
(2, 'Ministry of State', NULL),
(3, 'COMPNOR', NULL),
(4, 'Regional Governance', NULL),
(5, 'Royal Family', NULL),
(6, 'Throne', NULL),
(7, 'Armed Forces', 1),
(8, 'Research & Development', 1),
(9, 'Military Crime Investigative Service', 1),
(10, 'Imperial Republic Intelligence Service', 2),
(11, 'Galactic Senate', 2),
(12, 'Imperial Republic Security Bureau', 3),
(13, 'His Majesty''s Special Forces', 6),
(14, 'High Council', 6),
(15, 'Their Majesty''s Staff', 6),
(16, 'Royal Command Fleet', 6),
(0, 'EOTIR Staff', NULL),
(100, 'Unassigned', NULL),
(30, 'Intelligence Operations Bureau', 19),
(18, 'His Majesty''s Royal Guard', 6),
(19, 'Directorate of Operations', 10),
(17, 'Military Criminal Investigative Services', 1),
(31, 'OCOPS', 0),
(32, 'CAT', 0),
(33, 'PART', 0),
(34, 'FATE', 0),
(35, 'SMART', 0),
(20, 'Naval Forces', 1),
(21, 'Naval Intelligence', 20);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(6) NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `text` text NOT NULL,
  `clearance` int(3) NOT NULL DEFAULT '0',
  `creator` int(3) NOT NULL DEFAULT '0',
  `status` int(3) NOT NULL DEFAULT '0',
  `type` int(3) NOT NULL DEFAULT '0',
  `prefix` int(3) NOT NULL DEFAULT '0',
  `signed` longtext NOT NULL,
  `assignees` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `subject`, `text`, `clearance`, `creator`, `status`, `type`, `prefix`, `signed`, `assignees`, `date`) VALUES
(849807, 'The Lord Protector', 'In the event of an attack on the Supreme Ruler or any other member of the Royal Imperial Throne while in the territories of the Regasterra, the Lord Protector of the Imperial Republic shall assume full tactical command of the Armed Forces in the Regasterra, including Royal Armed Forces or Royal Security Forces of the Noble and Great Houses of the Regasterra. In the event that the Supreme Ruler or his designee becomes incapacitated or seriously injured, the Lord Protector shall also assume command of His Majesty’s Royal Fleet until the Supreme Ruler is secured and regains use of his faculties or gives orders to the contrary.\r\n\r\nIn the event that the Lord Protector is not available or is also incapacitated or seriously injured, or otherwise absent, the same duty and authority shall fall on the nearest member of the Praetorian order, who shall immediately and hastily make way to the situation room or command post whether it be on ground or aboard a capital warship.', 3, 2, 4, 0, 1, '2', '0', '2015-03-31 06:02:19'),
(94217, 'A Secret Divorce', 'CONFIDENTIAL LEVEL ULTRA - \r\nOfficial Document (Force) Artifact(ODFA) / Original Digital Document Artifact\r\nOfficial Transcript on file with the Hapan Royal Archivist -Sealed by Order of the Queen\r\n\r\nI, Layha Solo [Centurion], of Hapes, do hereby request a decree of divorcement from my legal husband, Revan Centurion of Naboo, to be decreed within the governments of Hapes, the Imperial Republic, and to unbind that which was bound in the Great Houses of the Regasterra.\r\n\r\nI do solemnly submit this request of my own will and accord. I request that this be handled by the authorities of the above listed governments and territories and that the request not be submitted nor made known if possible to James Taylor Stratus.\r\n\r\nSigned and sealed before the Royal Archivist of Hapes this Coronation Day of Queen Phoenix Katarn of Hapes, 26 IRY.\r\n.OP/.DLOTS\r\n', 6, 2, 1, 0, 9, '0', '0', '2015-03-31 06:22:00'),
(517434, 'Fury of the Phoenix', 'The Fury of the Phoenix\r\n\r\nIn the event that His Royal Highness the Supreme Ruler of the Imperial Republic, Supreme Commander of the Imperial Republic Armed Forces, while aboard the Monarch-class Sovereign BattleCruiser Phoenix. should order that the Critical Radiance superweapon onboard by Supreme Command, fire upon any target, an encoded message shall be sent as an alert to all commands “The Fury of the Phoenix”, upon receipt which the commanding officers of all fleets, task forces or battlegroups, shall respond with their full name and rank in similar encoded messages back to the Phoenix acknowledging. However, should the Supreme Ruler exercise Executive Privilege and waive (or in effect, cancel) the alert to all commands, no such protocol shall be followed. The command and control computer aboard the Phoenix shall verify the Supreme Ruler’s orders by verifying his physical identity and ultimate authorization codes, all of which are hard-coded and cannot be changed. \r\n', 4, 2, 4, 0, 3, '0', '0', '2015-03-31 22:30:19'),
(579921, 'The Phoenix is on Fire', 'The Phoenix is on Fire\r\n\r\nIn the event of a direct attack on the Monarch-class Sovereign (also sometimes referred to as Super) Battlecruiser Phoenix, an encoded message will be sent to all commands “The Phoenix is on Fire” at which point the commanding officers of all commands are to respond first simply by stating their full rank and full name in an encoded message back to the Phoenix routed through their various headquarters and then they are to second, put their fleet, task force or battlegroup at the highest alert battle readiness and to begin moving their units into positions in which they are directly prepared to relieve the Royal fleet battleships from battle and or provide reinforcements. Those units nearest the Royal fleet while it has come under attack are to immediately leave their posts and provide reinforcements to the Royal Fleet. All other units are to move in to relieve the relief, and be prepared to move into primary attack positions surrounding the Royal BattleCruiser Phoenix. \r\n', 4, 2, 4, 0, 3, '0', '0', '2015-03-31 22:31:09'),
(609765, 'Exoneration of Former IRSB Agents', 'Imperial Republic Government\r\nRoyal Imperial Throne\r\nOffice of the Supreme Ruler\r\nHis Majesty the Supreme Ruler\r\nTo:  Executor Tavria Treyson, Grand Minister of COMPNOR\r\n       Praetor Bryan Dugaan, High Minister of COMPNOR, COMPNOR General Counsel\r\n       Praetor Kaidlen Shan, Commandant of His Majesty''s Royal Guard\r\n       Praetor Alexia Preston, His Majesty''s Special Forces\r\n       High Judicator Hosk Bu''watu, Imperial Republic High Judicate, presiding\r\n       Judicator Elouna Jofforu, Imperial Republic High Judicate\r\n       Judicator Allan Deapoli, Imperial Republic High Judicate\r\n      Corey Killinger, HMPS Policy Advisor (COMPNOR)\r\n      Lady Diandra Devin, HMPS Chief of Staff\r\n      Lady Selena Vadcasta, State Security Advisor\r\n      Vassim Feladora, COMPNOR Security Officer, IRSB\r\n      Jenov Raveshaw, Director of Imperial Republic Intelligence Service\r\n      Karcye Tanex, EPS Chief of Staff\r\n      General Raithos Bodost, Director-General of the Imperial Republic Security Bureau\r\n      Lieutenant Colonel Koru Tav, Adjutant of His Majesty''s Royal Guard\r\n      Nathan Gilmore, EPS General Counsel\r\nFrom: High Prince James T. Stratus, Supreme Ruler of the Imperial Republic\r\n\r\nSUBJECT: Executive Order Exonerating Former IRSB Agents\r\n\r\nAfter further review and investigation, it has been discovered that during the purge of defectors from the Imperial Republic Security Bureau led by former General Oho Gomao, innocent agents and former leaders of the IRSB before Oho Gomao infiltrated it were negatively affected. First, on behalf of the Imperial Republic Government, the Royal Imperial Throne, I sincerely offer my regrets for this horrible occurrence, and having met with and personally apologized to these agents, I further extend my apologies to their families and friends for all the pain and circumstance this has brought them. \r\n\r\nBy Executor Order, I hereby exonerate the following agents and further order that their pensions be restored retroactively and further grant eligibility to these personnel to be restored to full employment in COMPNOR, the Imperial Republic Security Bureau, the Ministry of State, the Imperial Republic Armed Forces or any other government position or office for which they are eligible. It is further ordered that their security clearances be restored. All medical and other benefits that are offered to full-time employees shall be extended to their families up to six generations as long as they live. The Royal Family is also offering full-ride scholarships with housing, medical, and food budget benefits to the same. COMPNOR is hereby directed to administrate these funds and benefits to the agents and their families and to provide in any ways possible to right this wrong. \r\n\r\nCOMPNOR is further directed to investigate in joint with the Royal Guard any other former agents that should have been exonerated. If cleared by the Royal Guard and a joint investigation with the COMPNOR Inspector General, the benefits extended in this Executive Order shall apply to the same.\r\n\r\nAny lawsuits brought forth by the agents and/or their families shall be treated as individual complaints against Government Operations and shall be taken seriously. This Executive Order shall not be taken into consideration as a settlement for their cases. COMPNOR shall further abide by any Court Order issued by the High Judicate. All cases regarding this shall be handled by the same. \r\n\r\nThe following former IRSB agents named are hereby exonerated and issued a full pardon:\r\nAragon Havalon\r\nIRSB-General Damon Delaynie (ret.)\r\nDavion Ronack\r\nHelaina Solo\r\nJerec Rahn\r\nKad Fallon\r\nNatalie Karaim\r\nRian Kats\r\nRonavin Dannaue \r\nTania Latta \r\nVincet Aldalon \r\nYevin Duchvony \r\nLyle Vandagroove\r\nMikael Solo \r\nSo ordered in the presence of the above named by High Prince James Stratus, Supreme Ruler of the Imperial Republic.', 2, 2, 4, 0, 2, '2', '0', '2015-06-08 02:51:40'),
(603586, 'Oath of Office', 'On [23 April 2009], the High Council voted that all government employees and military personnel shall take an oath upon gaining employment, voluntary or otherwise, and all currently serving government personnel, elected, appointed, hired, or conscripted shall take the aforementioned oath immediately within 72 hours.\r\n\r\nThe Government Oath:\r\nI [YOUR NAME HERE], do solemnly swear that I will support and defend the Charter of the Imperial Republic against all enemies, foreign and domestic, that I will bear true faith and allegiance to the same, that I will protect and defend the Sovereignty of the Imperial Republic, the High Prince and Throne, and the Royal Family as the guardians of our liberty, that I take this obligation freely, without any mental reservation or purpose of evasion, and I will well and faithfully discharge the duties of the office on which I am about to enter. \r\n\r\nThe Military Oaths:\r\nEnlisted Oath\r\n\r\n"I, [YOUR NAME HERE], do solemnly swear (or affirm) that I will support and defend the Charter of the Imperial Republic against all enemies, foreign and domestic; that I will bear true faith and allegiance to the same; that I pledge my absolute loyalty and faith in the Supreme Ruler of the Imperial Republic and the Royal Family; and that I will obey the orders of the Throne, Minister of Defense, and the orders of the officers appointed over me, according to regulations and the Ministry of Defense Standard Operating Procedures." \r\n\r\nOfficer’s Oath\r\n\r\n"I, [YOUR NAME HERE] , having been appointed an officer in the Imperial Republic Armed Forces, as indicated above in the grade of [rank and grade here] do solemnly swear (or affirm) that I will support and defend the Charter of the Imperial Republic against all enemies, foreign or domestic, that I will bear true faith and allegiance to the same; that I pledge my absolute loyalty and faith in the Supreme Ruler of the Imperial Republic and the Royal Family; and that I will obey the orders of the Throne, Minister of Defense, that I will I will uphold the ideals of His Majesty''s New Order; that I take this obligation freely, without any mental reservations or purpose of evasion; and that I will well and faithfully discharge the duties of the office upon which I am about to enter."\r\n\r\nCommanded by the Imperial Republic High Council this day on [23 April 2009].', 1, 2, 4, 0, 6, '2', '0', '2015-06-30 10:10:40'),
(444605, 'CODE System', 'CODE System\r\nCommand Operations Declare Emergency\r\n\r\nFor use by Royal Guard and High Command and their Security Details \r\n \r\nCODE NO.\r\nALARM DESCRIPTION\r\nCODE 1\r\nDEATH OF PROTECTEE\r\nCODE 2\r\nGUARDS DOWN\r\nCODE 3\r\nDIRECT ATTACK/ENGAGEMENT OF PROTECTEE OR PALACE\r\nCODE 4\r\nDETONATOR/EXPLOSIVES THREAT/DISCOVERY\r\nCODE 5\r\nPROTECTEE MISSING\r\nCODE 6\r\nMEDICAL EMERGENCY (PROTECTEE DOWN - NOT DEAD)\r\nCODE 7\r\nBETRAYAL/INFILITRATION OF SECURITY OR TRUSTED INDIVIDUALS\r\nCODE 8\r\nCOMMUNICATIONS JAMMING OF PROTECTEE''S AREA\r\nCODE 9\r\nIMPENDING THREAT AGAINST PROTECTEE\r\nCODE RED\r\nHIGH SECURITY ALERT ALL UNITS/LOCKDOWN/LOCAL MILITARY UNITS TO RED STATUS\r\nCODE YELLOW\r\nHIGHTENED SECURITY ALERT (LOWER THAN RED) TO ALL UNITS\r\nCODE GREEN\r\nALL CLEAR - CALL OF SECURITY ALERTS\r\n\r\nIntegrate with IRIN maybe? Need php programmer for that.\r\n \r\nFORMAT For TRANSMISSION OF CODE ALARM\r\n \r\nMESSAGE:\r\nCODE (#HERE) (TARGET/OR GROUP/INDIVIDUAL) (LOCATION) (GROUP/UNIT/INDIVIDUAL RECIPIENTS) (DATE) (SENDER)\r\n \r\nWHO CAN SEND CODE ALARMS: RG, PSA, IRIS, IRSB, MOD, HC, THRONE, RF, HMPS\r\n', 3, 2, 4, 0, 5, '2', '0', '2015-07-02 02:03:10'),
(54478, 'Facilities Management', 'EXECUTIVE OFFICE OF THE GRAND MINISTER\r\nIMPERIAL REPUBLIC GOVERNMENT\r\nFOR IMMEDIATE RELEASE\r\n\r\n\r\nANNOUNCEMENT FOR THE EMPRESS\r\nFROM:Kevin Lyles\r\nDirector of Construction and Facilities Management\r\nSUBJECT: Update on Important Government Facilities\r\n\r\nThe following is the updated list of Government maintained facilities for use by COMPNOR, the Imperial Republic High Command, and the Throne:\r\n\r\nCoruscant\r\nImperial Palace - Official Residence of the Throne and Seat of the Imperial Republic \r\nCapitol Building - Ministry of State\r\nRepublic Executive Building - Center for Government People Services \r\nValorum Hall - Offices of the High Councilors of the Imperial Republic High Command\r\nChancellor''s Estate - Center for Palace Services\r\nCitadel de Maceau - Center for the Revenue Cabinent\r\nZalliace Palace - Office of Galactic Development\r\nCastle de Kayliaz - Private Retreat of the Executor\r\nChateau de Valciaz - Private Retreat of the Sovereign\r\nPresidential Palace - Center for Construction and Facilities Management\r\nImperial Republica - COMPNOR Administrative Headquarters\r\nStratus Imperiala - Center for Government Technical Services\r\nStratus Republica - COMPNOR Support Services\r\nImperial Financia - Ministry of Finance\r\nImperial Justicia - Ministry of Justice\r\nImperiala Solarus - Ministry of Public Affairs\r\nImeriala Galactica - Ministry of Transportation\r\nImperiala Commerica - Ministry of Labor\r\nImperial Healia - Ministry of Health\r\nImpeiala Medica - Imperial Government Medical Center \r\nImperial Knowlia - Great Imperial Library & Archives \r\nKuat \r\nChateau de Glaceau - The Kuati Estate of the High Councilors & Throne\r\nRoyal Imperial Estate - The Imperial Palacial Estate at Kuat \r\nHapes\r\nImperiala Royale - The Imperial Palace at Hapes\r\nSaliana Castle - The Hapan Estate of the High Councilors & Throne\r\nOther Imperial Palaces \r\nThe Republician Mansion - The Imperial Mansion at Byss\r\nThe Achenea Villa - The Imperial Villa at Anaxes\r\nThe Imperialite Manor - The Imperial Manor at Chandrilla\r\nThe Imperia Alcazar - The Imperial Fortress at Naboo \r\nThe Corella Citadel - The Imperial Citadel at Corellia\r\nThe Imperial Bastion - The Imperial Palace at Bastion\r\n\r\nKevin Lyles\r\nDirector of Construction and Facilities Management\r\nCOMPNOR\r\n\r\nApproved By: \r\nLord Hayden Warden\r\nDeputy to the High Councilor\r\nOffice of High Councilor Treyson\r\n\r\nBy Executive Order of the Grand Minister of COMPNOR\r\nHigh Councilor Tavria Treyson, Duchess of Maires\r\n\r\n\r\nDuchess Tavria Treyson\r\nGrand Minister of COMPNOR', 5, 0, 2, 0, 2, '0', '0', '2012-07-24 16:03:54'),
(360759, 'Investigative Jurisdiction: Residential Attack on the High Marshall', 'The investigation of the incident at High Marshall Cognatus'' residence is considered to be an attack on the State by an outward threat, in accordance with recent military activities, reports, and IRIS reports. I hereby order jurisdiction of this investigation solely under the Imperial Republic Intelligence Service. All agencies are directed to cooperate fully with IRIS in this and all connected investigations.', 5, 0, 2, 0, 2, '0', '0', '2011-06-12 05:17:48'),
(405047, 'Prime Directive', 'THE PRIME DIRECTIVE OF THE IMPERIAL REPUBLIC\n\nIS TO\n\nDEFEND THE CHARTER\n\nPROTECT THE THRONE\n\nPRESERVE THE REPUBLIC\n\nEXPAND THE EMPIRE\n\nENSURE THE  PROSPERITY OF THE ROYAL FAMILY\n\nELIMINATE CORRUPTION\n\nand MAINTAIN ORDER\n\nOFFICERS OF THE PRIME DIRECTIVE:\n(The Royal Family, The Executor and the Five Praetors of the Imperial Republic)\n[in order of authority and succession]\nExecutor Treyson\nSupreme Chancellor Quick\nPraetor OVERMIND\nPraetor Dugaan\nPraetor Shan\nPraetor Preston *TO REMAIN CLASSIFIED*\n\nENFORCERS OF THE PRIME DIRECTIVE:\nImperial Republic Security Bureau (COMPNOR)\nImperial Republic Armed Forces (DEFENSE)\nState Security Forces (IRIS)\nHis Majestyï¿½s Royal Guard (THRONE)\nPaladins of the Throne (SPECOPS)\n\nPowers of the Praetors\nPraetors are essentially Agents of the Throne and High Ministers which oversee functionality and operations of superministries of the Imperial Republic Government. Together with the Executor they make up the (name of organization here) and have the following special powers:\n-Execute the Prime Directive\n-Weld and use an Ultimate Authorization Code\n-Issue orders/commands on behalf of the Throne in person or via official communique\n\n\nUltimate Authorization Codes\nOfficers of the Prime Directive are issued Alpha Green security clearances at the discretion of the Supreme Ruler of the Imperial Republic. With this security clearance they are issued an ultimate authorization code, similar in use, power, and access to the militaryï¿½s command authorization codes. Ultimate Authorization is the power and authority of the Throne itself, and with it a welder can command and carry out the Prime Directive on behalf of the Throne as if the welder sat upon the very Throne itself. These codes are five to seven digits and must be used in conjunction with the welderï¿½s voiceprint and palm/retinal scan. Ultimate Authorization Codes allow a welder to:\n-Initiate self-destruct of a specific facility or Imperial Republic ship\n-Raise or Lower the shield of any planet\n-Priority clearance and/or escort through any defense line, security grid, fleet, blockade, etc.\n-Gain access to any secure facility, ship, area, or data\n-Commandeer any resource (including state ', 5, 2, 6, 0, 1, '2', '0', '2016-01-21 14:46:17'),
(948780, 'Authorized Travel Unattended', 'To : Praetor Kaidlen Shan\r\nFROM: High Prince Stratus\r\n\r\nPraetor Shan,\r\n\r\nI hereby authorize an unannounced trip for Dene Vye Cognatus and the Royal Princess Aurielle Stratus. It is a difficult decision to make but lets just say I owe them one. This trip will not be on record and there will be no protection detail from either HMRG or HMSG. I have been assured a military presence will be nearby and on call in case help is needed, but they will not be aware of the traveler''s identities for security purposes. Let it be clear that this is a once-only authorization for a specific trip to an unspecified location of their choosing not to exceed one month in duration.\r\n\r\nMay the Force watch over and protect them.\r\n\r\nJames T. Stratus\r\nSupreme Ruler ', 4, 2, 4, 0, 5, '0,2', '0', '2011-07-26 18:07:03'),
(371078, 'Military Base of Operations Transfer', 'In light of the merger and due to the needs of Government, I hereby order relocation of Military Command Base of Operations transfer from Berchest to Kuat, effective immediately, replacing the old Naval Headquarters.\r\n\r\nHigh Prince James Stratus\r\n\r\nSupreme Ruler', 3, 2, 4, 0, 3, '0', '0', '2011-07-26 18:22:02'),
(745349, 'RG Protectee Codenames', 'Protectee Actual Name: Protectee Codename\r\nHigh Prince James Stratus: Phoenix\r\nExecutor Tavria Treyson: Bahamut\r\nSupreme Chancellor Joesefus Quick: Arion\r\nLord Praetor Revan Centurion: Griffin\r\nLord Praetor OVERMIND: Chimaera\r\nPraetor Alexia Preston: Paladin\r\nPraetor Bryan Dugaan: Father Time\r\nPraetor Kaidlen Shan: Mother Nature\r\nWarlord Dene Vye Cognatus: Bigfoot\r\nPrince Marc Stratus: Pegasus\r\nPrincess Ashlee Gourdine: Bysen\r\nPrincess Nicole McFayden: Capricorn\r\nPrincess Aurielle Stratus: Mermaid\r\nDirector Drexel Oren: Cyclops\r\nHigh Councilor Ieyena Cohean: Angel\r\nGrand Admiral Locke Firecam: Python', 5, 2, 6, 0, 5, '2', '0', '2011-07-26 22:56:09'),
(986375, 'Royal Decree & Proclamation to COMPNOR: Galactic Competitions', 'Imperial Republic Government\r\nRoyal Imperial Throne of the Imperial Republic\r\nOffice of the Supreme Ruler\r\nHis Majesty the Supreme Ruler of the Imperial Republic\r\n\r\nFOR IMMEDIATE RELEASE\r\n\r\n \r\n\r\nTo: COMPNOR Chair & Grand Minister, Executor Tavria Treyson; High Minister & Vice Chair-COMPNOR, Praetor Bryan Duugan\r\n\r\n \r\n\r\nSUBJECT: Royal Decree & Proclamation to COMPNOR: Galactic Competitions\r\n\r\n \r\n\r\nIt is hereby ordered, that the Commission for the Preservation of His Majesty''s New Order organize and commission a Galaxy-wide competition and gaming organization or commission that is charged with the organization of artistic, cultural, and friendly competition between planets and systems to be hosted every four years by commission-designated planets. The naming of this commission, governance, and charter shall be decided by the leadership of COMPNOR and submitted to the Royal Imperial Throne and High Council for endorsement.\r\n\r\n \r\n\r\nThe funding of the said commission shall be based on contributions from all participating systems and planets, and other inter-galactic delegations who participate in such competitions.\r\n\r\n \r\n\r\n \r\n\r\nOrdered by His Majesty the Supreme Ruler in the 34th Year of the Imperial Republic.\r\n\r\n \r\n\r\nJames Taylor Stratus', 1, 2, 4, 0, 2, '0', '61', '2014-02-09 00:13:54'),
(930161, 'Royal Escort to Almania', 'To: Admiral John Kelly\r\nFrom: High Prince Stratus\r\ncc: Grand Admiral Taftican, Grand Admiral Quinn\r\n\r\nRelayed by Coruscant Palace Situation Room Duty Officer Commander Barthalemeu.\r\n\r\nAdmiral,\r\n\r\nEscort the Princess Ashlee Stratus-Gourdine and her husband, Commodore Gourdine to Grand Admiral Tatfican''s flagship at Almania. Report in to the Grand Admiral for any orders once you arrive. You are tasked with the safety of a member of the Royal First Family.', 4, 2, 4, 0, 3, '2', '82', '2014-03-09 21:52:25'),
(366809, 'Operation Recovery', 'His Majesty the Supreme Ruler authorizes Grand Admiral Lightstar, the Second Assault Fleet, and its officers to conduct operations to eliminate the threat of the Shadow Kong Pirates and to shut down their organization entirely. The Imperial Republic will not tolerate the kidnapping of its citizens or their children by such organizations for the purpose of politican gain and direclty challenges the sovereignty of the Imperial Republic and its leaders. The Grand Admiral is to ensure the survival of the kidnapped children at all costs, but is to move in swiftly and eliminate these pirates. The Imperial Republic will not tolerate these crimes, and we will take immediate action against them.\r\n\r\nSigned this day in the presence of the Minister of Defense by His Majesty', 4, 2, 2, 0, 2, '2,0', '0', '2009-01-08 19:52:22'),
(470516, 'Operation Recovery', 'Due to recent circumstances, the Second Assault Fleet is now under a classified mission for the Supreme Ruler. You are to assemble your fleet and launch within the next forty-eight hours. Your mission will be to transport the Adar Commando-Squadron to just outside of the Pii Sector, where you will wait until summoned by the Adar Squadron and encircle Pii 4. You will then land troops to secure the planet and the base and will be responsible in assisting in the transportation of all members of the Shadow Kong and the kidnapped children to Coruscant under guard. Note; these children have more than likely been brainwashed and may need to be subdued. The children are not to be harmed under any circumstance, even if they are armed and dangerous. Pii 4 is a moderately populated planet and caution should be used so as not to frighten the civilians.', 4, 0, 2, 0, 2, '0', '0', '2011-06-12 05:16:32'),
(572119, 'Mission Giddy Prime', 'Major Palleon,\r\n\r\nYou are to leave for Giddy Prime ASAP to attend to the profile given to you with this chip. This target will be watched carefully, and you will be inconspicious and unnoticed while doing so. \r\n\r\nYou will be flown there by a civilian pilot that knows nothing of this mission, and we shall keep it that way. He is also not to be put in harms way, so if there is immediate needs for escaping, and your cover has been blown, you are to find other means of transportation. \r\n\r\nWe need as much information on this target as possible. Where they go frequently, what they do, who they speak to. We want names. The mission lasts as long as you want it to, however, we ask that it not take more than 2 months. If your situation permits, please contact me at 1600 hours of every fifth day. This is a means for me knowing you are still safe. If the time is conflicting with your Targets schedule, you can delay the transmission until it is safe. Nothing important can be said over this holo-transmission for security sake, it is merely for our knowledge of your safety and that the mission has not gone stale. \r\n\r\nBe safe and undetected. May the force be with you.\r\n\r\nDirector Miller', 4, 0, 2, 0, 4, '0', '0', '2011-06-12 05:18:41'),
(934803, 'The Hunt', 'To: Grand Minister of COMPNOR Layha Solo-Katarn\r\nFrom: IRSB General Oho Gomao\r\n\r\nGrand Minister,\r\n\r\nAs my earlier message made mention of, I will be leaving Coruscant on an operation. I will be traveling to the spaceport moon of Nar Shaddaa. The target of the operation is none other than A''ya. You may remember the name from the Anobis incident from several years ago. I have received information she is trying to recruit new soldiers for what will most certainty be a new rebirth of the old organization. With this growing resistance, combined with her ability to seemingly always escape if we give her the possibility, I feel it imperative to leave immediately. As a result, I will be unassisted at first, but will request assistance from the nearby field offices should the situation require it. I will have left the planet by the time you receive this, and I plan on taking a direct route to Nar Shaddaa in order to cut down on the possibility of her eluding me yet again. My office will know what to do should I fail to check in after any considerable amount of time.', 5, 0, 1, 0, 5, '0,2', '0,2', '2011-06-12 05:19:07'),
(265768, 'Locate Gomao', 'Director Raveshaw, Commander Lokia,\r\n\r\nFind the location of General Oho Gomao. I do believe he is alive. Find him at all costs, but do not attempt to rescue him under any circumstances. Once you have located him report back to Executor Solo-Katarn and myself and await my instructions. If it is easy for him to escape, then he will not need rescue. But whoever managed to capture him is very deadly, because it is near impossible to capture the General. Proceed with caution, but get it done.', 5, 2, 3, 0, 4, '2', '0', '2011-06-12 05:15:34'),
(379051, 'Wartime Crimes Against the State', 'General Miller,\r\n\r\nOn 8 February 2006 Earth time, Amie Porter-Stratus was caught fratenizing with a known enemy of the State during a critical time of war. After specifically being ordered to report to a secure bunker for her own safety and the security of the Royal Family, Amie Porter-Stratus fled towards the enemy, and Imperial Republic Special Forces had to abort their own missions in order to intercept her for apprehension. She is currently in a medical holding cell aboard the Prince''s Pride.\r\n\r\nThese crimes warrant an arrest on charges of Treason, violation of direct orders from the Throne, and crimes against the State during war. I am turning this into your hands. The person in question is a member of the Royal Family and my sister-in-law. I hereby authorize and request that said charges be levied against her and that she be placed under arrest. She is to remain under custody of the Royal Guard until she has completed her labor in delivering her baby and the medics release her to authorities being in satisfactory condition as per Republic statutes.', 4, 2, 2, 0, 5, '2', '0', '2011-06-12 05:19:21'),
(535403, 'Operation Paladin', 'To protect and preserve the stability of order in the Galaxy, and to preserve the government of His Majesty’s New Order, sometimes drastic measures must taken. These measures, while not specifically prohibited by Imperial Republic Law, would be found questionable by the public and the legislative and executive bodies under which authority it and all other government security agencies operate. Therefore it is necessary for some measures, especially those of drastic nature to be performed covertly without the knowledge of these supervisory agencies and legislative bodies with supervisory authority. Accountability of those who perform these special services or take drastic measures on behalf of the preservation of the New Order is essential, therefore selected individuals will oversee all efforts and operations conducted by these individuals, and report directly and act only on authority of the highest authority.\r\n\r\n1.	Article 7.0 of the Imperial Republic Charter authorizes the Supreme Ruler to create, maintain, and dissolve Special Armed Services Units at his or her discretion.\r\n2.	Therefore, the Supreme Ruler, by Supreme Command, authorizes the Chief of Special Operations and the Imperial Republic Special Operations Command to conduct Operation Paladin as herewith described.\r\n3.	All individuals associated with this Operation will henceforth be referred to as Paladins of His Majesty’s Special Forces, also individually referred to as a Paladin.\r\n4.	All operations and targets of Operation Paladin shall be carried out under the direct authority and supervision of the Supreme Ruler of the Imperial Republic and his appointed agent.\r\n5.	Paladins are authorized to perform any and all tasks deemed necessary for the preservation of His Majesty’s New Order, to ensure stability of government, and to protect the Throne. All such tasks must have prior authorization from the Supreme Ruler.\r\n6.	The Supreme Ruler authorizes the Chief of Special Operations to commission any Paladin an officer of the Armed Forces or to infiltrate any government agency for specific assignments and missions he authorizes.\r\n7.	The Supreme Ruler authorizes the Chief of Special Operations to commandeer any vessel, building or facility including military, government, or civilian deemed vital to an authorized mission or operation of a Paladin.\r\n8.	Operation Paladin shall be deemed classified as Top Secret at the level of an Alpha Green security clearance and a Delta Red for those directly involved in its operation.\r\n9.	Paladins are granted the same authority and privileges of the members of His Majesty’s Royal Guard.\r\n', 5, 2, 6, 0, 1, '2', '0', '2011-06-12 05:20:19'),
(540827, 'COMPNOR Deputy Minister Order of Succession', 'Executive Order: Establishing the Order of Succession of COMPNOR: E-540827\r\n\r\nBy the authority vested in me as Grand Minister of COMPNOR by the Charter and the laws of the Imperial Republic Government, it is hereby ordered that: \r\n\r\nSection 1. Order of Succession. During any period when the Deputy Minister of COMPNOR has died, resigned, or has otherwise become unable to perform the functions and duties of the office of the Deputy Minister of COMPNOR, the following officials of COMPNOR, in the order listed, shall perform the functions and duties of the office of the Deputy Minister of COMPNOR, until such time as the Deputy Minister of COMPNOR is able to perform the functions and duties of the office of Deputy Minister of COMPNOR: \r\n\r\n(a) Minister of Justice; \r\n\r\n(b) Minister of Finance; \r\n\r\n(c) Director of the IRSB; \r\n\r\n(d) Minister of Public Affairs; \r\n\r\n(e) Minister of Health; \r\n\r\n(f) Minister of Transportation; \r\n\r\n(g) Minister of Labor;  \r\n\r\n(h) Principal Deputy Minister of Justice; \r\n\r\n(i) Principal Deputy Minister of Finance; \r\n\r\n(j) Deputy Directior of the IRSB; \r\n\r\n(k) Principal Deputy Minister of Public Affairs; \r\n\r\n(l) Deputy Minister of Health; \r\n\r\n(m) Deputy Minister of Transportation;\r\n\r\n(n) Deputy Minister of Labor; \r\n\r\n(o) Deputy Minister of Justice for Royal Affairs;\r\n\r\n(p) Deputy Minister of Justice for Administration;\r\n\r\n(q) Deputy Minister of Justice for Law;\r\n\r\n(r) Deputy Minister of Justice for Enforcement;\r\n\r\n(s) Deputy Minister of Finance for Administration; \r\n\r\n(t) Deputy Minister of Finance for Monetary Policy; \r\n\r\n(u) Deputy Minister of Finance for Investigations and Enforcement; \r\n\r\n(v) UnderDirector of the IRSB for Investigations; \r\n\r\n(w) UnderDirector of the IRSB for Public Safety;\r\n\r\n(x) Deputy Minister of Public Affairs for Royal Correspondence;\r\n\r\n(y) Deputy Minister of Public Affairs for Administration; and\r\n\r\n(z) Deputy Minister of Public Affairs for Media and Communications.\r\nSec. 2. Exceptions. \r\n\r\n(a) No individual who is serving in an office listed in section 1 in an acting capacity, by virtue of so serving, shall act as the Deputy Minister of COMPNOR pursuant to this Executive Order. \r\n\r\n(b) No individual shall act as Deputy Minister unless that individual is otherwise eligible to so serve. \r\n\r\n(c) Notwithstanding the provisions of this Executive Order, the Grand Minister, Executor and Sovereign retain discretion, to depart from this Executive Order in designating an acting Deputy Minister of COMPNOR. \r\n\r\nSec. 3. Judicial Review. This Executive Order is intended to improve the internal management of COMPNOR and is not intended to, and does not, create any right or benefit, substantive or procedural, enforceable at law or in equity by any party against the Imperial Government of the Imperial Republic, its departments, agencies, or entities, its officers, employees, or agents, or any other person.', 5, 0, 6, 0, 2, '0', '0', '2011-07-06 14:11:43'),
(507286, 'Tax Exemption', 'By Order of the Grand Minister of COMPNOR:\r\n\r\nThe following individuals are exempt from the Income Tax: Present and Former Sovereigns, and Present and Former Executors and Second Executors.\r\n\r\nBy Executive Order of the Duchess Tavria Treyson.', 2, 0, 6, 0, 2, '0', '0', '2011-07-06 14:10:53'),
(175807, 'Royal Fleet Emergency Summons', 'The Royal Fleet shall respond immediately to an emergency summons from the Dawn Treader issued solely by High Prince James Stratus upon recieving said summons, and shall not inform anyone until the said person is brought into security of the Royal Fleet and the situation is deemed secure. The Royal Fleet will then notify the Ministry of Defense and/or a member of the Throne presiding at Coruscant upon their return of their status. This summons can be executed at any time only by the person mentioned above.', 6, 2, 6, 0, 1, '2', '0', '2008-08-12 18:55:29'),
(134363, 'Operation Phoenix', 'OPERATION PHOENIX\r\n \r\nCLASSIFIED TOP SECRET \r\n \r\n \r\nCoruscant houses the central government of the galaxy. From the ancient Old Republic to the Galactic Empire, the Rebel Alliance, the New Republic, the Outside Reign, and the late Galactic Alliance. No galactic government can function without control of this system and planet. Therefore the safety and security of Coruscant is of the utmost importance to ensure the stability of His Majesty''s New Order. In the event of insurgence, uprising, civil unrest, or other destabilizing crises, the protocols that are found in this document shall be initiated by the authority of the Supreme Ruler by the same, or as authorized by the Supreme Chancellor in cooperation with the Chairperson of the Commission for the Preservation of His Majesty''s New Order. \r\n \r\nI. Activation of Coruscant Reserve Security Forces\r\nUpon initiation of this protocol the Imperial Republic Security Bureau''s Capital Reserve Defense Forces and Ubiqtorate Reserve Guards shall be called to active duty in defense of the capital city of Coruscant.\r\n \r\nII. Escalation of Powers to Arrest Delegated\r\nThe IRSB''s power to arrest shall be escalated galactically to include any High Council member or military personnel suspected of treason. The Directorate of Counterintelligence - IRIS, shall assist the IRSB and take over this task in the event of its failure. His Majesty''s Royal Guard''s power to arrest shall be escalated to include any Throne member save the Supreme Ruler only unless ordered by the Royal Supreme Court. Their power to arrest already exists below any Throne member suspected of treason.\r\n\r\nIII. Military Forces Alert Status\r\nUpon initiation of this protocol all military forces in the Coruscant, Kuat, Fakir, and the Hapes Consortium shall stand at Red Alert. All planetary shields in the capital planets of these systems shall be brought to full power with all traffic halted. The sector governor or Throne Agent''s permission will be required for emergency passage. All other military forces shall go to Yellow Alert and non-essential traffic in key systems will be redirected elsewhere.\r\n\r\nIV. Transfer of Military Authority\r\nIn the absence of the Supreme Ruler, should an Executor be present on Coruscant all military authority shall be vested in the same. In the absence of the Executor and the Minister of Defense on Coruscant, all military authority on Coruscant shall be transferred to the Commandant of the Royal Guard.\r\n \r\nV. Necessity of Throne Regency\r\nIn the absence of the Supreme Ruler, should the situation escalate for an extended period of time, Throne Regency may be declared by those whom the Charter gives power to do so and as outlined by the charter, with the strictest compliance with said procedures.\r\n \r\n', 5, 2, 6, 0, 1, '2,0', '0', '2011-06-12 05:20:36'),
(116842, 'Defectors Ship Protocol', '\r\nDefecting Flagship Protocol\r\n“The Admiral’s Folly”\r\nSUPREME COMMAND C116842\r\nCLASSIFIED TOP SECRET - SCI\r\n\r\nOriginally established after the defection of General Oho Gomao, and called the Gomao Protocol, and later officially renamed the Defecting (or Defector) Ship Protocol, it is more commonly known as the Admiral’s Folly to those few who are secretly briefed of its existence.\r\n\r\n\r\nApplies to the flagship of every fleet, group, and task force. \r\nClearance: The High Council and the Grand Admiralty, Royal Family, Royal Guard\r\nSecret Clearance: Captains or commanders of the flagships  The Admiralty is not informed that the captains are briefed, and the captains are not aware of the Admiralty’s knowledge. Both have  a different knowledge or briefing with details unique.\r\n\r\nUpon detection of the flagship Admiral or other similar rank (CO) by various security systems, reports from both regular fleet security officers and undercover DCI agents and Royal Guardsman, the protocol will activate an announce itself to the bridge and its officers. \r\n\r\nThe following systems begin to go offline in order: Weapons, Engines & Thrusters, Shields, Communications, all except sensors and escape pods, and some limited tight beam communications to warn the fleet to spread out. Self-destruct mechanism arms.\r\n\r\nThe protocol may be remotely activated by a member of the Throne, or activated in person by members of the High Council and/or Royal Family. Upon activation, alarms begin to sound, the High Prince’s recording plays to the bridge and announces a traitor of high rank and empowers the officers to relieve and take into custody and are given one chance only to secure the ship. If the same security protocol detects the traitor is apprehended and relieved the mechanism will disengage. If the protocol detects command is restored to the “traitor” at any time it will re-arm and cannot be disarmed except by a member of the Throne remotely unless the traitor has already undergone a full investigatory trial and been cleared by their superiors.\r\n', 5, 2, 4, 0, 1, '0', '0', '2015-07-02 02:44:44'),
(545668, 'IRIS Reorganization', 'Intelligence Reorganization\r\n\r\nhttp://images.eotir.com/charts/IRIS_Org_Chart.pdf', 4, 2, 4, 0, 2, '0', '0', '2015-07-03 00:52:31'),
(929140, 'HMPS Deputy Chief of Staff', 'Imperial Republic Government\nRoyal Imperial Throne of the Imperial Republic\nOffice of the Supreme Ruler\nLady Diandra Devin, His Majesty''s Chief of Staff\n\nFOR IMMEDIATE RELEASE [EFFECTIVE 1 CLOWA 36 IRY]\n \nSUBJECT: HMPS / DEPUTY CHIEF OF STAFF\n \nHis Supreme Majesty, the Supreme Ruler of the Imperial Republic High Prince James Stratus, does hereunto appoint Terrisa Klone as Deputy Chief of His Majesty''s Personal Staff. Lieutenant Colonel Terrisa Klone joins His Majesty''s Staff after serving 17 years in the Imperial Republic Security Bureau serving most recently as the Security Bureau''s Liaison to the Imperial Republic Intelligence Service. Prior to serving as IRIS Liaison, Lt. Col. Klone served in the IRSB''s Special Operations Bureau - Criminal Intelligence Division in various leadership positions in different regions of the galaxy. Terrisa Klone attended the University of Corellia where she earned her Bachelor''s Degree in Criminal Justice. While serving in the IRSB, Terrisa earned her Master''s degree from the University of Coruscant College of Criminal Justice and later through a full-ride COMPNOR scholarship obtained her Doctorate Degree from Stratus University''s Treyson College of Public Administration.\n \nHis Majesty invests in Deputy Chief of Staff Terrisa Klone all the rights, powers, privileges, and responsibilities thereof, and bestows upon her the title of Countess. Countess Klone will retain full membership in the Commission for the Preservation of His Majesty''s New Order (COMPNOR).', 1, 1, 4, 0, 6, '1', '0', '2015-10-10 00:05:14'),
(490152, 'New High Council Appointment', 'Imperial Republic Government\nRoyal Imperial Throne of the Imperial Republic\nOffice of the Supreme Ruler\nHis Majesty the Supreme Ruler of the Imperial Republic\n\nFOR IMMEDIATE RELEASE\n \nSUBJECT: NEW HIGH COUNCIL APPOINTMENT / DIRECTOR OF INTELLIGENCE\n \nI am please to announce the appointment of Lan Klone to the position of Director of the Imperial Republic Intelligene Service and subsequent appointment to the High Council as a full voting member with all the rights, privileges and responsibilities therein. Director Klone has served these past years in the Intelligence Service and will continue to head the IRIN Project as Director of IRIN. Director Klone and his team have been hard at work at doing a complete overhaul of the Imperial Republic Information Network (IRIN Project) and I am pleased to award Director Lan Klone with the Government Betterment Award and a Letter of Commendation for his service.\n \nDeclared by His Majesty the Supreme Ruler in the 35th Year of the Imperial Republic.\n \nJames Taylor Stratus', 1, 59, 4, 0, 6, '59', '2', '2015-10-10 00:14:33'),
(546139, 'Executive Order: Amending and Restating the Order of Succession of COMPNOR previously established under E-540827', 'Executive Order: Amending and Restating the Order of Succession of COMPNOR previously established under E-540827\r\n\r\nBy the authority vested in me as Chairman and Grand Minister of COMPNOR by the Charter and the laws of the Imperial Republic Government, it is hereby ordered that: \r\n\r\nSection 1. Order of Succession. During any period when the Vice Chairman & High Minister of COMPNOR has died, resigned, or has otherwise become unable to perform the functions and duties of the office of the Vice Chairman & High Minister, the following officials of COMPNOR, in the order listed, shall perform the functions and duties of the office of the Vice Chairman & High Minister of COMPNOR, until such time as the Vice Chairman & High Minister of COMPNOR is able to perform the functions and duties of the office of Vice Chairman & High Minister or replacements are named by the Royal Imperial Throne:\r\n \r\n(a) Sr. Minister & Executive Director of the Imperial Republic Sovereign Wealth Fund; \r\n \r\n(b ) Sr. Minister & Imperial Republic Comptroller General; \r\n \r\n(c ) Sr. Minister of National Heritage &  Valorumian President; \r\n \r\n(d) Sr. Minister of Government Services; \r\n \r\n(e) Minister & Investment Director of the Imperial Republic Sovereign Wealth Fund; \r\n \r\n(f) Minister of Public Affairs; \r\n \r\n(g) Minister of the Select Committee Office; \r\n \r\n(h) Minister of Plans, Strategic Policy, & Political Affairs; \r\n \r\n(i) Minister of Economic Strategy & The Galactic Economy; \r\n \r\n(j) Minister & COMPNOR Comptroller General; \r\n \r\n(k) Minister of Finance; \r\n \r\n(l) Minister for Corporate Affairs and Entrepreneurship; \r\n \r\n(m) Minister of National Development and Infrastructure;\r\n \r\n(n) Minister of Public Policy & Legislative Affairs; \r\n \r\n(o) Imperial Republic Security Bureau Director;\r\n \r\n(p) Minister of Strategy & Planning;\r\n \r\n(q) Minister & Imperial Republic Inspector General;\r\n \r\n(r) Minister & COMPNOR Inspector General;\r\n \r\n(s) Minister of Galactic Logistics & Supply Chain Management; \r\n \r\n(t) Minister of Justice; \r\n \r\n(u) Minister of R&D, Technology & Innovation; \r\n \r\n(v) Minister of Information & Technology; \r\n \r\n(w) Minister of COMPNOR Consulting & Advisory Services;\r\n \r\n(x) Minister of R&D & New Concept Development;\r\n \r\n(y) Minister of Transformation and System Planning;\r\n \r\n(z) Minister of Labor;\r\n \r\n(aa) Minister of Transportation;\r\n \r\n(ab) Minister & Chief Personnel Officer;\r\n \r\n(ac) Minister of Education;\r\n \r\n(ad) Minister of Operational Excellence;\r\n \r\n(ae) Minister of Administrative Affairs;\r\n \r\n(af) Minister of Health;\r\n \r\n(ag) Minister of Combat Medicine;\r\n \r\n(ah) Minister of Galactic Health Database;\r\n \r\n(ai) Valorumian Institute Executive Vice President & President of the IR Policy Institute;\r\n \r\n(aj) Valorumian Institute Executive Vice President & Chief Research Officer;\r\n \r\n(ak) Minister of Sports & Tourism;\r\n \r\n(al) Minister & Imperial Republic Librarian & Archives;\r\n \r\n(am) Minister of Culture & Preservation;\r\n \r\n(an) Minister of the IR Capital Planning Authority; and\r\n \r\n(ao) Minister of Indigenous Affairs.\r\n \r\nSec. 2. Exceptions. \r\n \r\n(a) No individual who is serving in an office listed in section 1 in an acting capacity, by virtue of so serving, shall act as the Vice Chairman & High Minister of COMPNOR pursuant to this Executive Order. \r\n \r\n(b ) No individual shall act as Vice Chairman & High Minister unless that individual is otherwise eligible to so serve. \r\n \r\n(c ) Notwithstanding the provisions of this Executive Order, the Grand Minister, Executor and Sovereign retain discretion, to depart from this Executive Order in designating an acting Vice Chairman & High Minister of COMPNOR. \r\n \r\nSec. 3. Judicial Review. This Executive Order is intended to improve the internal management of COMPNOR and is not intended to, and does not, create any right or benefit, substantive or procedural, enforceable at law or in equity by any party against the Imperial Government of the Imperial Republic, its departments, agencies, or entities, its officers, employees, or agents, or any other person.', 5, 61, 6, 0, 2, '61', '61', '2015-10-11 21:48:55'),
(698797, 'Theta Protocol', 'Theta Protocol\nÎ˜ CODE 3-6 APOLLO Î¸\nThis protocol is activated by the Lord Protector of the Imperial Republic in the event of an attack on the Supreme Ruler which results in a medical emergency. This protocol may be activated by another member of the Throne, Throne Regent, or a member of the Praetorian Order IF the Lord Protector is not able to perform his or her duties.\n', 4, 2, 4, 0, 5, '2', '0', '2015-10-29 19:06:05'),
(860957, 'Orders to Attend Admiral''s Summit', 'TO: ALL FLEET COMMANDERS IN SECTORS 1-5 and the GRAND ADMIRALTY\nFROM: GRAND ADMIRAL JARED QUINN, MINISTER OF DEFENSE\nRE: ORDERS TO ATTEND ADMIRAL''s SUMMIT ON CORUSCANT\n\nYou are hereby ordered to attend a Summit of Command Officers on Coruscant to be held on 21 PÃ»rga 36 IRY.. The Summit will be held at the Royal Palace of Coruscant.\n\nThe following agenda will take place.\n\nCommand Training\nSecurity Concern\nStarship Upgrades\nProtocol Updates\nDinner with the Throne\nMarching Orders\n\nNo exceptions will be made. Be sure your Executive Officers are ready and fit for temporary command of your respective units and that you can maintain contact with them throughout the summit. Temporary quarters have been arranged within the Royal Palace and all meals will be catered by the Royal Palace Kitchens.\n\nOrdered by the Supreme Ruler on 3 Anak 36 IRY. ', 3, 2, 4, 0, 3, '2', '0', '2015-11-06 18:19:23'),
(819502, 'Omega Protocol', 'Omega Protocol\n\nIn case of treason among the Armed Forces, the Security Bureau or the Royal Guard, this protocol shall be enacted activating the secret heavy battle droid Centurions that are hidden inside the Palace within the walls, in the ships of the Command fleets, and a full armament and army inside Sanctuary. \n\nCan be activated only by the Praetorian, the Throne, the Director of IRIS and Assistant Director of IRIS-DCI. \n\nCenturions everywhere will emerge from their hidden places and secure the facilities, ships, palaces, buildings, etc., of the areas they are assigned and stationed, and terminate all individuals branded and detected as traitors and continue this pursuit until countermanded by two Praetorians or one member of the Throne.\n', 5, 2, 4, 0, 2, '2', '0', '2016-01-06 00:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `document_statuses`
--

CREATE TABLE IF NOT EXISTS `document_statuses` (
  `statusid` int(2) NOT NULL,
  `status_name` varchar(100) NOT NULL,
  PRIMARY KEY (`statusid`),
  UNIQUE KEY `2` (`status_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document_statuses`
--

INSERT INTO `document_statuses` (`statusid`, `status_name`) VALUES
(1, 'For Review'),
(2, 'Complete'),
(3, 'Revoked'),
(4, 'New'),
(5, 'In Process'),
(6, 'Permanent');

-- --------------------------------------------------------

--
-- Table structure for table `errors`
--

CREATE TABLE IF NOT EXISTS `errors` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `type` int(1) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `errors`
--

INSERT INTO `errors` (`id`, `message`, `type`, `time`) VALUES
(1, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2015-10-09 20:18:15'),
(2, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2015-10-09 20:18:18'),
(3, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2015-10-09 20:19:16'),
(4, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2015-10-09 20:20:01'),
(5, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2015-10-09 20:26:06'),
(6, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2015-10-09 20:26:07'),
(7, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2015-10-09 21:05:14'),
(8, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2015-10-09 21:05:14'),
(9, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2015-10-09 21:06:31'),
(10, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''s Summit'', ''    TO: ALL FLEET COMMANDERS IN SECTORS 1-5 '', 3, 2, 4, 0, 3, ''2'', '''' at line 1', 1, '2015-11-05 23:35:35'),
(11, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''s Summit'', ''TO: ALL FLEET COMMANDERS IN SECTORS 1-5 '', 3, 2, 4, 0, 3, ''2'', ''0'', '' at line 1', 1, '2015-11-05 23:56:06'),
(12, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''s Summit'', ''TO: ALL FLEET COMMANDERS IN SECTORS 1-5 '', 1, 59, 4, 0, 1, ''59'', ''0'''' at line 1', 1, '2015-11-06 08:56:26'),
(13, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2016-01-17 21:40:07'),
(14, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2016-01-17 21:42:10'),
(15, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2016-01-17 21:42:13'),
(16, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2016-01-17 21:42:27'),
(17, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2016-01-17 21:43:38'),
(18, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2016-01-17 22:01:12'),
(19, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2016-01-17 22:01:38'),
(20, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2016-01-17 22:01:46'),
(21, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2016-01-17 22:02:56'),
(22, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2016-01-17 22:12:49'),
(23, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2016-01-23 23:30:15'),
(24, 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2016-01-23 23:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `irclock`
--

CREATE TABLE IF NOT EXISTS `irclock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(10) NOT NULL,
  `era` int(2) NOT NULL,
  `date` date NOT NULL,
  `latest` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `irclock`
--

INSERT INTO `irclock` (`id`, `year`, `era`, `date`, `latest`) VALUES
(1, 40, 1, '2012-07-12', 0),
(2, 39, 1, '2012-07-12', 0),
(3, 38, 1, '2012-07-12', 0),
(4, 37, 1, '2012-07-12', 0),
(5, 36, 1, '2012-07-12', 0),
(6, 35, 1, '2012-07-12', 0),
(7, 34, 1, '2012-07-12', 0),
(8, 33, 1, '2012-07-12', 0),
(9, 32, 1, '2012-07-12', 0),
(10, 31, 1, '2012-07-12', 0),
(11, 30, 1, '2012-07-12', 0),
(12, 29, 1, '2012-07-12', 0),
(13, 28, 1, '2012-07-12', 0),
(14, 27, 1, '2012-07-12', 0),
(15, 26, 1, '2012-07-12', 0),
(16, 25, 1, '2012-07-12', 0),
(17, 24, 1, '2012-07-12', 0),
(18, 23, 1, '2012-07-12', 0),
(19, 22, 1, '2012-07-12', 0),
(20, 21, 1, '2012-07-12', 0),
(21, 20, 1, '2012-07-12', 0),
(22, 19, 1, '2012-07-12', 0),
(23, 18, 1, '2012-07-12', 0),
(24, 17, 1, '2012-07-12', 0),
(25, 16, 1, '2012-07-12', 0),
(26, 15, 1, '2012-07-12', 0),
(27, 14, 1, '2012-07-12', 0),
(28, 13, 1, '2012-07-12', 0),
(29, 12, 1, '2012-07-12', 0),
(30, 11, 1, '2012-07-12', 0),
(31, 10, 1, '2012-07-12', 0),
(32, 9, 1, '2012-07-12', 0),
(33, 8, 1, '2012-07-12', 0),
(34, 7, 1, '2012-07-12', 0),
(35, 6, 1, '2012-07-12', 0),
(36, 5, 1, '2012-07-12', 0),
(37, 4, 1, '2012-07-12', 0),
(38, 3, 1, '2012-07-12', 0),
(39, 2, 1, '2012-07-12', 0),
(40, 1, 1, '2012-07-12', 0),
(41, 0, 2, '2012-07-12', 0),
(42, 1, 2, '2012-07-12', 0),
(43, 2, 2, '2012-07-12', 0),
(44, 3, 2, '2012-07-12', 0),
(45, 4, 2, '2012-07-12', 0),
(46, 5, 2, '2012-07-12', 0),
(47, 6, 2, '2012-07-12', 0),
(48, 7, 2, '2012-07-12', 0),
(49, 8, 2, '2012-07-12', 0),
(50, 9, 2, '2012-07-12', 0),
(51, 10, 2, '2012-07-12', 0),
(52, 11, 2, '2012-07-12', 0),
(53, 12, 2, '2012-07-12', 0),
(54, 13, 2, '2012-07-12', 0),
(55, 14, 2, '2012-07-12', 0),
(56, 15, 2, '2012-07-12', 0),
(57, 16, 2, '2012-07-12', 0),
(58, 17, 2, '2012-07-12', 0),
(59, 18, 2, '2012-07-12', 0),
(60, 19, 2, '2012-07-12', 0),
(61, 20, 2, '2012-07-12', 0),
(62, 21, 2, '2012-07-12', 0),
(63, 22, 2, '2012-07-12', 0),
(64, 23, 2, '2012-07-12', 0),
(65, 24, 2, '2012-07-12', 0),
(66, 25, 2, '2012-07-12', 0),
(67, 26, 2, '2012-07-12', 0),
(68, 27, 2, '2012-07-12', 0),
(69, 28, 2, '2012-07-12', 0),
(70, 29, 2, '2012-07-12', 0),
(71, 30, 2, '2012-07-12', 0),
(72, 31, 2, '2012-07-12', 0),
(73, 32, 2, '2012-07-12', 0),
(74, 33, 2, '2012-07-12', 0),
(75, 34, 2, '2012-07-12', 0),
(76, 35, 2, '2012-07-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(6) NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `text` text NOT NULL,
  `clearance` int(3) NOT NULL DEFAULT '0',
  `creator` int(3) NOT NULL DEFAULT '0',
  `status` int(3) NOT NULL DEFAULT '0',
  `type` int(3) NOT NULL DEFAULT '0',
  `prefix` int(3) NOT NULL DEFAULT '0',
  `signed` longtext NOT NULL,
  `assignees` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `subject`, `text`, `clearance`, `creator`, `status`, `type`, `prefix`, `signed`, `assignees`, `date`) VALUES
(366809, 'Operation Recovery', 'His Majesty the Supreme Ruler authorizes Grand Admiral Lightstar, the Second Assault Fleet, and its officers to conduct operations to eliminate the threat of the Shadow Kong Pirates and to shut down their organization entirely. The Imperial Republic will not tolerate the kidnapping of its citizens or their children by such organizations for the purpose of politican gain and direclty challenges the sovereignty of the Imperial Republic and its leaders. The Grand Admiral is to ensure the survival of the kidnapped children at all costs, but is to move in swiftly and eliminate these pirates. The Imperial Republic will not tolerate these crimes, and we will take immediate action against them.\r\n\r\nSigned this day in the presence of the Minister of Defense by His Majesty', 4, 2, 2, 0, 2, '2,11,59', '11,12,13,22,8,10,4,23', '2009-01-08 19:52:22'),
(470516, 'Operation Recovery', 'Due to recent circumstances, the Second Assault Fleet is now under a classified mission for the Supreme Ruler. You are to assemble your fleet and launch within the next forty-eight hours. Your mission will be to transport the Adar Commando-Squadron to just outside of the Pii Sector, where you will wait until summoned by the Adar Squadron and encircle Pii 4. You will then land troops to secure the planet and the base and will be responsible in assisting in the transportation of all members of the Shadow Kong and the kidnapped children to Coruscant under guard. Note; these children have more than likely been brainwashed and may need to be subdued. The children are not to be harmed under any circumstance, even if they are armed and dangerous. Pii 4 is a moderately populated planet and caution should be used so as not to frighten the civilians.', 4, 23, 2, 0, 2, '23', '10,6,11,8', '2011-06-12 05:16:32'),
(572119, 'Mission Giddy Prime', 'Major Palleon,\r\n\r\nYou are to leave for Giddy Prime ASAP to attend to the profile given to you with this chip. This target will be watched carefully, and you will be inconspicious and unnoticed while doing so. \r\n\r\nYou will be flown there by a civilian pilot that knows nothing of this mission, and we shall keep it that way. He is also not to be put in harms way, so if there is immediate needs for escaping, and your cover has been blown, you are to find other means of transportation. \r\n\r\nWe need as much information on this target as possible. Where they go frequently, what they do, who they speak to. We want names. The mission lasts as long as you want it to, however, we ask that it not take more than 2 months. If your situation permits, please contact me at 1600 hours of every fifth day. This is a means for me knowing you are still safe. If the time is conflicting with your Targets schedule, you can delay the transmission until it is safe. Nothing important can be said over this holo-transmission for security sake, it is merely for our knowledge of your safety and that the mission has not gone stale. \r\n\r\nBe safe and undetected. May the force be with you.\r\n\r\nDirector Miller', 4, 37, 2, 0, 4, '', '', '2011-06-12 05:18:41'),
(934803, 'The Hunt', 'To: Grand Minister of COMPNOR Layha Solo-Katarn\r\nFrom: IRSB General Oho Gomao\r\n\r\nGrand Minister,\r\n\r\nAs my earlier message made mention of, I will be leaving Coruscant on an operation. I will be traveling to the spaceport moon of Nar Shaddaa. The target of the operation is none other than A''ya. You may remember the name from the Anobis incident from several years ago. I have received information she is trying to recruit new soldiers for what will most certainty be a new rebirth of the old organization. With this growing resistance, combined with her ability to seemingly always escape if we give her the possibility, I feel it imperative to leave immediately. As a result, I will be unassisted at first, but will request assistance from the nearby field offices should the situation require it. I will have left the planet by the time you receive this, and I plan on taking a direct route to Nar Shaddaa in order to cut down on the possibility of her eluding me yet again. My office will know what to do should I fail to check in after any considerable amount of time.', 5, 7, 1, 0, 5, '7,2', '6,2', '2011-06-12 05:19:07'),
(265768, 'Locate Gomao', 'Director Raveshaw, Commander Lokia,\r\n\r\nFind the location of General Oho Gomao. I do believe he is alive. Find him at all costs, but do not attempt to rescue him under any circumstances. Once you have located him report back to Executor Solo-Katarn and myself and await my instructions. If it is easy for him to escape, then he will not need rescue. But whoever managed to capture him is very deadly, because it is near impossible to capture the General. Proceed with caution, but get it done.', 5, 2, 3, 0, 4, '2', '32,7,6', '2011-06-12 05:15:34'),
(379051, 'Wartime Crimes Against the State', 'General Miller,\r\n\r\nOn 8 February 2006 Earth time, Amie Porter-Stratus was caught fratenizing with a known enemy of the State during a critical time of war. After specifically being ordered to report to a secure bunker for her own safety and the security of the Royal Family, Amie Porter-Stratus fled towards the enemy, and Imperial Republic Special Forces had to abort their own missions in order to intercept her for apprehension. She is currently in a medical holding cell aboard the Prince''s Pride.\r\n\r\nThese crimes warrant an arrest on charges of Treason, violation of direct orders from the Throne, and crimes against the State during war. I am turning this into your hands. The person in question is a member of the Royal Family and my sister-in-law. I hereby authorize and request that said charges be levied against her and that she be placed under arrest. She is to remain under custody of the Royal Guard until she has completed her labor in delivering her baby and the medics release her to authorities being in satisfactory condition as per Republic statutes.', 4, 2, 2, 0, 5, '2', '37,32', '2011-06-12 05:19:21'),
(535403, 'Operation Paladin', 'To protect and preserve the stability of order in the Galaxy, and to preserve the government of His Majesty’s New Order, sometimes drastic measures must taken. These measures, while not specifically prohibited by Imperial Republic Law, would be found questionable by the public and the legislative and executive bodies under which authority it and all other government security agencies operate. Therefore it is necessary for some measures, especially those of drastic nature to be performed covertly without the knowledge of these supervisory agencies and legislative bodies with supervisory authority. Accountability of those who perform these special services or take drastic measures on behalf of the preservation of the New Order is essential, therefore selected individuals will oversee all efforts and operations conducted by these individuals, and report directly and act only on authority of the highest authority.\r\n\r\n1.	Article 7.0 of the Imperial Republic Charter authorizes the Supreme Ruler to create, maintain, and dissolve Special Armed Services Units at his or her discretion.\r\n2.	Therefore, the Supreme Ruler, by Supreme Command, authorizes the Chief of Special Operations and the Imperial Republic Special Operations Command to conduct Operation Paladin as herewith described.\r\n3.	All individuals associated with this Operation will henceforth be referred to as Paladins of His Majesty’s Special Forces, also individually referred to as a Paladin.\r\n4.	All operations and targets of Operation Paladin shall be carried out under the direct authority and supervision of the Supreme Ruler of the Imperial Republic and his appointed agent.\r\n5.	Paladins are authorized to perform any and all tasks deemed necessary for the preservation of His Majesty’s New Order, to ensure stability of government, and to protect the Throne. All such tasks must have prior authorization from the Supreme Ruler.\r\n6.	The Supreme Ruler authorizes the Chief of Special Operations to commission any Paladin an officer of the Armed Forces or to infiltrate any government agency for specific assignments and missions he authorizes.\r\n7.	The Supreme Ruler authorizes the Chief of Special Operations to commandeer any vessel, building or facility including military, government, or civilian deemed vital to an authorized mission or operation of a Paladin.\r\n8.	Operation Paladin shall be deemed classified as Top Secret at the level of an Alpha Green security clearance and a Delta Red for those directly involved in its operation.\r\n9.	Paladins are granted the same authority and privileges of the members of His Majesty’s Royal Guard.\r\n', 5, 2, 6, 0, 1, '2', '52,22', '2011-06-12 05:20:19'),
(540827, 'COMPNOR Deputy Minister Order of Succession', 'Executive Order: Establishing the Order of Succession of COMPNOR: E-540827\r\n\r\nBy the authority vested in me as Grand Minister of COMPNOR by the Charter and the laws of the Imperial Republic Government, it is hereby ordered that: \r\n\r\nSection 1. Order of Succession. During any period when the Deputy Minister of COMPNOR has died, resigned, or has otherwise become unable to perform the functions and duties of the office of the Deputy Minister of COMPNOR, the following officials of COMPNOR, in the order listed, shall perform the functions and duties of the office of the Deputy Minister of COMPNOR, until such time as the Deputy Minister of COMPNOR is able to perform the functions and duties of the office of Deputy Minister of COMPNOR: \r\n\r\n(a) Minister of Justice; \r\n\r\n(b) Minister of Finance; \r\n\r\n(c) Director of the IRSB; \r\n\r\n(d) Minister of Public Affairs; \r\n\r\n(e) Minister of Health; \r\n\r\n(f) Minister of Transportation; \r\n\r\n(g) Minister of Labor;  \r\n\r\n(h) Principal Deputy Minister of Justice; \r\n\r\n(i) Principal Deputy Minister of Finance; \r\n\r\n(j) Deputy Directior of the IRSB; \r\n\r\n(k) Principal Deputy Minister of Public Affairs; \r\n\r\n(l) Deputy Minister of Health; \r\n\r\n(m) Deputy Minister of Transportation;\r\n\r\n(n) Deputy Minister of Labor; \r\n\r\n(o) Deputy Minister of Justice for Royal Affairs;\r\n\r\n(p) Deputy Minister of Justice for Administration;\r\n\r\n(q) Deputy Minister of Justice for Law;\r\n\r\n(r) Deputy Minister of Justice for Enforcement;\r\n\r\n(s) Deputy Minister of Finance for Administration; \r\n\r\n(t) Deputy Minister of Finance for Monetary Policy; \r\n\r\n(u) Deputy Minister of Finance for Investigations and Enforcement; \r\n\r\n(v) UnderDirector of the IRSB for Investigations; \r\n\r\n(w) UnderDirector of the IRSB for Public Safety;\r\n\r\n(x) Deputy Minister of Public Affairs for Royal Correspondence;\r\n\r\n(y) Deputy Minister of Public Affairs for Administration; and\r\n\r\n(z) Deputy Minister of Public Affairs for Media and Communications.\r\nSec. 2. Exceptions. \r\n\r\n(a) No individual who is serving in an office listed in section 1 in an acting capacity, by virtue of so serving, shall act as the Deputy Minister of COMPNOR pursuant to this Executive Order. \r\n\r\n(b) No individual shall act as Deputy Minister unless that individual is otherwise eligible to so serve. \r\n\r\n(c) Notwithstanding the provisions of this Executive Order, the Grand Minister, Executor and Sovereign retain discretion, to depart from this Executive Order in designating an acting Deputy Minister of COMPNOR. \r\n\r\nSec. 3. Judicial Review. This Executive Order is intended to improve the internal management of COMPNOR and is not intended to, and does not, create any right or benefit, substantive or procedural, enforceable at law or in equity by any party against the Imperial Government of the Imperial Republic, its departments, agencies, or entities, its officers, employees, or agents, or any other person.', 5, 40, 6, 0, 2, '40,41', '6', '2011-07-06 14:11:43'),
(507286, 'Tax Exemption', 'By Order of the Grand Minister of COMPNOR:\r\n\r\nThe following individuals are exempt from the Income Tax: Present and Former Sovereigns, and Present and Former Executors and Second Executors.\r\n\r\nBy Executive Order of the Duchess Tavria Treyson.', 2, 40, 6, 0, 2, '40,41', '6', '2011-07-06 14:10:53'),
(175807, 'Royal Fleet Emergency Summons', 'The Royal Fleet shall respond immediately to an emergency summons from the Dawn Treader issued solely by High Prince James Stratus upon recieving said summons, and shall not inform anyone until the said person is brought into security of the Royal Fleet and the situation is deemed secure. The Royal Fleet will then notify the Ministry of Defense and/or a member of the Throne presiding at Coruscant upon their return of their status. This summons can be executed at any time only by the person mentioned above.', 6, 2, 6, 0, 1, '2', '', '2008-08-12 18:55:29'),
(134363, 'Operation Phoenix', 'OPERATION PHOENIX\r\n \r\nCLASSIFIED TOP SECRET \r\n \r\n \r\nCoruscant houses the central government of the galaxy. From the ancient Old Republic to the Galactic Empire, the Rebel Alliance, the New Republic, the Outside Reign, and the late Galactic Alliance. No galactic government can function without control of this system and planet. Therefore the safety and security of Coruscant is of the utmost importance to ensure the stability of His Majesty''s New Order. In the event of insurgence, uprising, civil unrest, or other destabilizing crises, the protocols that are found in this document shall be initiated by the authority of the Supreme Ruler by the same, or as authorized by the Supreme Chancellor in cooperation with the Chairperson of the Commission for the Preservation of His Majesty''s New Order. \r\n \r\nI. Activation of Coruscant Reserve Security Forces\r\nUpon initiation of this protocol the Imperial Republic Security Bureau''s Capital Reserve Defense Forces and Ubiqtorate Reserve Guards shall be called to active duty in defense of the capital city of Coruscant.\r\n \r\nII. Escalation of Powers to Arrest Delegated\r\nThe IRSB''s power to arrest shall be escalated galactically to include any High Council member or military personnel suspected of treason. The Directorate of Counterintelligence - IRIS, shall assist the IRSB and take over this task in the event of its failure. His Majesty''s Royal Guard''s power to arrest shall be escalated to include any Throne member save the Supreme Ruler only unless ordered by the Royal Supreme Court. Their power to arrest already exists below any Throne member suspected of treason.\r\n\r\nIII. Military Forces Alert Status\r\nUpon initiation of this protocol all military forces in the Coruscant, Kuat, Fakir, and the Hapes Consortium shall stand at Red Alert. All planetary shields in the capital planets of these systems shall be brought to full power with all traffic halted. The sector governor or Throne Agent''s permission will be required for emergency passage. All other military forces shall go to Yellow Alert and non-essential traffic in key systems will be redirected elsewhere.\r\n\r\nIV. Transfer of Military Authority\r\nIn the absence of the Supreme Ruler, should an Executor be present on Coruscant all military authority shall be vested in the same. In the absence of the Executor and the Minister of Defense on Coruscant, all military authority on Coruscant shall be transferred to the Commandant of the Royal Guard.\r\n \r\nV. Necessity of Throne Regency\r\nIn the absence of the Supreme Ruler, should the situation escalate for an extended period of time, Throne Regency may be declared by those whom the Charter gives power to do so and as outlined by the charter, with the strictest compliance with said procedures.\r\n \r\n', 5, 2, 6, 0, 1, '2,40', '23,40,32', '2011-06-12 05:20:36'),
(54478, 'Facilities Management', 'EXECUTIVE OFFICE OF THE GRAND MINISTER\r\nIMPERIAL REPUBLIC GOVERNMENT\r\nFOR IMMEDIATE RELEASE\r\n\r\n\r\nANNOUNCEMENT FOR THE EMPRESS\r\nFROM:Kevin Lyles\r\nDirector of Construction and Facilities Management\r\nSUBJECT: Update on Important Government Facilities\r\n\r\nThe following is the updated list of Government maintained facilities for use by COMPNOR, the Imperial Republic High Command, and the Throne:\r\n\r\nCoruscant\r\nImperial Palace - Official Residence of the Throne and Seat of the Imperial Republic \r\nCapitol Building - Ministry of State\r\nRepublic Executive Building - Center for Government People Services \r\nValorum Hall - Offices of the High Councilors of the Imperial Republic High Command\r\nChancellor''s Estate - Center for Palace Services\r\nCitadel de Maceau - Center for the Revenue Cabinent\r\nZalliace Palace - Office of Galactic Development\r\nCastle de Kayliaz - Private Retreat of the Executor\r\nChateau de Valciaz - Private Retreat of the Sovereign\r\nPresidential Palace - Center for Construction and Facilities Management\r\nImperial Republica - COMPNOR Administrative Headquarters\r\nStratus Imperiala - Center for Government Technical Services\r\nStratus Republica - COMPNOR Support Services\r\nImperial Financia - Ministry of Finance\r\nImperial Justicia - Ministry of Justice\r\nImperiala Solarus - Ministry of Public Affairs\r\nImeriala Galactica - Ministry of Transportation\r\nImperiala Commerica - Ministry of Labor\r\nImperial Healia - Ministry of Health\r\nImpeiala Medica - Imperial Government Medical Center \r\nImperial Knowlia - Great Imperial Library & Archives \r\nKuat \r\nChateau de Glaceau - The Kuati Estate of the High Councilors & Throne\r\nRoyal Imperial Estate - The Imperial Palacial Estate at Kuat \r\nHapes\r\nImperiala Royale - The Imperial Palace at Hapes\r\nSaliana Castle - The Hapan Estate of the High Councilors & Throne\r\nOther Imperial Palaces \r\nThe Republician Mansion - The Imperial Mansion at Byss\r\nThe Achenea Villa - The Imperial Villa at Anaxes\r\nThe Imperialite Manor - The Imperial Manor at Chandrilla\r\nThe Imperia Alcazar - The Imperial Fortress at Naboo \r\nThe Corella Citadel - The Imperial Citadel at Corellia\r\nThe Imperial Bastion - The Imperial Palace at Bastion\r\n\r\nKevin Lyles\r\nDirector of Construction and Facilities Management\r\nCOMPNOR\r\n\r\nApproved By: \r\nLord Hayden Warden\r\nDeputy to the High Councilor\r\nOffice of High Councilor Treyson\r\n\r\nBy Executive Order of the Grand Minister of COMPNOR\r\nHigh Councilor Tavria Treyson, Duchess of Maires\r\n\r\n\r\nDuchess Tavria Treyson\r\nGrand Minister of COMPNOR', 5, 40, 2, 0, 2, '40,41', '', '2012-07-24 16:03:54'),
(360759, 'Investigative Jurisdiction: Residential Attack on the High Marshall', 'The investigation of the incident at High Marshall Cognatus'' residence is considered to be an attack on the State by an outward threat, in accordance with recent military activities, reports, and IRIS reports. I hereby order jurisdiction of this investigation solely under the Imperial Republic Intelligence Service. All agencies are directed to cooperate fully with IRIS in this and all connected investigations.', 5, 23, 2, 0, 2, '23', '', '2011-06-12 05:17:48'),
(405047, 'Prime Directive', 'THE PRIME DIRECTIVE OF THE IMPERIAL REPUBLIC\r\n\r\nIS TO\r\n\r\nDEFEND THE CHARTER\r\n\r\nPROTECT THE THRONE\r\n\r\nPRESERVE THE REPUBLIC\r\n\r\nEXPAND THE EMPIRE\r\n\r\nENSURE THE  PROSPERITY OF THE ROYAL FAMILY\r\n\r\nELIMINATE CORRUPTION\r\n\r\nand MAINTAIN ORDER\r\n\r\nOFFICERS OF THE PRIME DIRECTIVE:\r\n(The Royal Family, The Executor and the Five Praetors of the Imperial Republic)\r\n[in order of authority and succession]\r\nExecutor Treyson\r\nSupreme Chancellor Quick\r\nPraetor OVERMIND\r\nPraetor Dugaan\r\nPraetor Shan\r\nPraetor Preston *TO REMAIN CLASSIFIED*\r\n\r\nENFORCERS OF THE PRIME DIRECTIVE:\r\nImperial Republic Security Bureau (COMPNOR)\r\nImperial Republic Armed Forces (DEFENSE)\r\nState Security Forces (IRIS)\r\nHis Majesty’s Royal Guard (THRONE)\r\nPaladins of the Throne (SPECOPS)\r\n\r\nPowers of the Praetors\r\nPraetors are essentially Agents of the Throne and High Ministers which oversee functionality and operations of superministries of the Imperial Republic Government. Together with the Executor they make up the (name of organization here) and have the following special powers:\r\n-Execute the Prime Directive\r\n-Weld and use an Ultimate Authorization Code\r\n-Issue orders/commands on behalf of the Throne in person or via official communique\r\n\r\n\r\nUltimate Authorization Codes\r\nOfficers of the Prime Directive are issued Alpha Green security clearances at the discretion of the Supreme Ruler of the Imperial Republic. With this security clearance they are issued an ultimate authorization code, similar in use, power, and access to the military’s command authorization codes. Ultimate Authorization is the power and authority of the Throne itself, and with it a welder can command and carry out the Prime Directive on behalf of the Throne as if the welder sat upon the very Throne itself. These codes are five to seven digits and must be used in conjunction with the welder’s voiceprint and palm/retinal scan. Ultimate Authorization Codes allow a welder to:\r\n-Initiate self-destruct of a specific facility or Imperial Republic ship\r\n-Raise or Lower the shield of any planet\r\n-Priority clearance and/or escort through any defense line, security grid, fleet, blockade, etc.\r\n-Gain access to any secure facility, ship, area, or data\r\n-Commandeer any resource (including state & military assets) of the Imperial Republic', 5, 2, 4, 0, 1, '2', '40,23', '2011-06-12 05:13:37'),
(948780, 'Authorized Travel Unattended', 'To : Praetor Kaidlen Shan\r\nFROM: High Prince Stratus\r\n\r\nPraetor Shan,\r\n\r\nI hereby authorize an unannounced trip for Dene Vye Cognatus and the Royal Princess Aurielle Stratus. It is a difficult decision to make but lets just say I owe them one. This trip will not be on record and there will be no protection detail from either HMRG or HMSG. I have been assured a military presence will be nearby and on call in case help is needed, but they will not be aware of the traveler''s identities for security purposes. Let it be clear that this is a once-only authorization for a specific trip to an unspecified location of their choosing not to exceed one month in duration.\r\n\r\nMay the Force watch over and protect them.\r\n\r\nJames T. Stratus\r\nSupreme Ruler ', 4, 2, 4, 0, 5, '', '', '2011-07-26 18:07:03'),
(371078, 'Military Base of Operations Transfer', 'In light of the merger and due to the needs of Government, I hereby order relocation of Military Command Base of Operations transfer from Berchest to Kuat, effective immediately, replacing the old Naval Headquarters.\r\n\r\nHigh Prince James Stratus\r\n\r\nSupreme Ruler', 3, 2, 4, 0, 3, '', '', '2011-07-26 18:22:02'),
(745349, 'RG Protectee Codenames', 'Protectee Actual Name: Protectee Codename\r\nHigh Prince James Stratus: Phoenix\r\nExecutor Tavria Treyson: Bahamut\r\nSupreme Chancellor Joesefus Quick: Arion\r\nLord Praetor Revan Centurion: Griffin\r\nLord Praetor OVERMIND: Chimaera\r\nPraetor Alexia Preston: Paladin\r\nPraetor Bryan Dugaan: Father Time\r\nPraetor Kaidlen Shan: Mother Nature\r\nWarlord Dene Vye Cognatus: Bigfoot\r\nPrince Marc Stratus: Pegasus\r\nPrincess Ashlee Gourdine: Bysen\r\nPrincess Nicole McFayden: Capricorn\r\nPrincess Aurielle Stratus: Mermaid\r\nDirector Drexel Oren: Cyclops\r\nHigh Councilor Ieyena Cohean: Angel\r\nGrand Admiral Locke Firecam: Python', 5, 2, 6, 0, 5, '2', '', '2011-07-26 22:56:09'),
(986375, 'Royal Decree & Proclamation to COMPNOR: Galactic Competitions', 'Imperial Republic Government\r\nRoyal Imperial Throne of the Imperial Republic\r\nOffice of the Supreme Ruler\r\nHis Majesty the Supreme Ruler of the Imperial Republic\r\n\r\nFOR IMMEDIATE RELEASE\r\n\r\n \r\n\r\nTo: COMPNOR Chair & Grand Minister, Executor Tavria Treyson; High Minister & Vice Chair-COMPNOR, Praetor Bryan Duugan\r\n\r\n \r\n\r\nSUBJECT: Royal Decree & Proclamation to COMPNOR: Galactic Competitions\r\n\r\n \r\n\r\nIt is hereby ordered, that the Commission for the Preservation of His Majesty''s New Order organize and commission a Galaxy-wide competition and gaming organization or commission that is charged with the organization of artistic, cultural, and friendly competition between planets and systems to be hosted every four years by commission-designated planets. The naming of this commission, governance, and charter shall be decided by the leadership of COMPNOR and submitted to the Royal Imperial Throne and High Council for endorsement.\r\n\r\n \r\n\r\nThe funding of the said commission shall be based on contributions from all participating systems and planets, and other inter-galactic delegations who participate in such competitions.\r\n\r\n \r\n\r\n \r\n\r\nOrdered by His Majesty the Supreme Ruler in the 34th Year of the Imperial Republic.\r\n\r\n \r\n\r\nJames Taylor Stratus', 1, 2, 4, 0, 2, '', '61', '2014-02-09 00:13:54'),
(930161, 'Royal Escort to Almania', 'To: Admiral John Kelly\r\nFrom: High Prince Stratus\r\ncc: Grand Admiral Taftican, Grand Admiral Quinn\r\n\r\nRelayed by Coruscant Palace Situation Room Duty Officer Commander Barthalemeu.\r\n\r\nAdmiral,\r\n\r\nEscort the Princess Ashlee Stratus-Gourdine and her husband, Commodore Gourdine to Grand Admiral Tatfican''s flagship at Almania. Report in to the Grand Admiral for any orders once you arrive. You are tasked with the safety of a member of the Royal First Family.', 4, 2, 4, 0, 3, '2', '82', '2014-03-09 21:52:25'),
(116842, 'Defectors Ship Protocol', '\r\nDefecting Flagship Protocol\r\n“The Admiral’s Folly”\r\nSUPREME COMMAND C116842\r\nCLASSIFIED TOP SECRET - SCI\r\n\r\nOriginally established after the defection of General Oho Gomao, and called the Gomao Protocol, and later officially renamed the Defecting (or Defector) Ship Protocol, it is more commonly known as the Admiral’s Folly to those few who are secretly briefed of its existence.\r\n\r\n\r\nApplies to the flagship of every fleet, group, and task force. \r\nClearance: The High Council and the Grand Admiralty, Royal Family, Royal Guard\r\nSecret Clearance: Captains or commanders of the flagships  The Admiralty is not informed that the captains are briefed, and the captains are not aware of the Admiralty’s knowledge. Both have  a different knowledge or briefing with details unique.\r\n\r\nUpon detection of the flagship Admiral or other similar rank (CO) by various security systems, reports from both regular fleet security officers and undercover DCI agents and Royal Guardsman, the protocol will activate an announce itself to the bridge and its officers. \r\n\r\nThe following systems begin to go offline in order: Weapons, Engines & Thrusters, Shields, Communications, all except sensors and escape pods, and some limited tight beam communications to warn the fleet to spread out. Self-destruct mechanism arms.\r\n\r\nThe protocol may be remotely activated by a member of the Throne, or activated in person by members of the High Council and/or Royal Family. Upon activation, alarms begin to sound, the High Prince’s recording plays to the bridge and announces a traitor of high rank and empowers the officers to relieve and take into custody and are given one chance only to secure the ship. If the same security protocol detects the traitor is apprehended and relieved the mechanism will disengage. If the protocol detects command is restored to the “traitor” at any time it will re-arm and cannot be disarmed except by a member of the Throne remotely unless the traitor has already undergone a full investigatory trial and been cleared by their superiors.\r\n', 5, 2, 4, 0, 1, '', '', '2015-07-02 02:44:44'),
(849807, 'The Lord Protector', 'In the event of an attack on the Supreme Ruler or any other member of the Royal Imperial Throne while in the territories of the Regasterra, the Lord Protector of the Imperial Republic shall assume full tactical command of the Armed Forces in the Regasterra, including Royal Armed Forces or Royal Security Forces of the Noble and Great Houses of the Regasterra. In the event that the Supreme Ruler or his designee becomes incapacitated or seriously injured, the Lord Protector shall also assume command of His Majesty’s Royal Fleet until the Supreme Ruler is secured and regains use of his faculties or gives orders to the contrary.\r\n\r\nIn the event that the Lord Protector is not available or is also incapacitated or seriously injured, or otherwise absent, the same duty and authority shall fall on the nearest member of the Praetorian order, who shall immediately and hastily make way to the situation room or command post whether it be on ground or aboard a capital warship.', 3, 2, 4, 0, 1, '2', '', '2015-03-31 06:02:19'),
(94217, 'A Secret Divorce', 'CONFIDENTIAL LEVEL ULTRA - \r\nOfficial Document (Force) Artifact(ODFA) / Original Digital Document Artifact\r\nOfficial Transcript on file with the Hapan Royal Archivist -Sealed by Order of the Queen\r\n\r\nI, Layha Solo [Centurion], of Hapes, do hereby request a decree of divorcement from my legal husband, Revan Centurion of Naboo, to be decreed within the governments of Hapes, the Imperial Republic, and to unbind that which was bound in the Great Houses of the Regasterra.\r\n\r\nI do solemnly submit this request of my own will and accord. I request that this be handled by the authorities of the above listed governments and territories and that the request not be submitted nor made known if possible to James Taylor Stratus.\r\n\r\nSigned and sealed before the Royal Archivist of Hapes this Coronation Day of Queen Phoenix Katarn of Hapes, 26 IRY.\r\n.OP/.DLOTS\r\n', 6, 2, 1, 0, 9, '', '', '2015-03-31 06:22:00'),
(517434, 'Fury of the Phoenix', 'The Fury of the Phoenix\r\n\r\nIn the event that His Royal Highness the Supreme Ruler of the Imperial Republic, Supreme Commander of the Imperial Republic Armed Forces, while aboard the Monarch-class Sovereign BattleCruiser Phoenix. should order that the Critical Radiance superweapon onboard by Supreme Command, fire upon any target, an encoded message shall be sent as an alert to all commands “The Fury of the Phoenix”, upon receipt which the commanding officers of all fleets, task forces or battlegroups, shall respond with their full name and rank in similar encoded messages back to the Phoenix acknowledging. However, should the Supreme Ruler exercise Executive Privilege and waive (or in effect, cancel) the alert to all commands, no such protocol shall be followed. The command and control computer aboard the Phoenix shall verify the Supreme Ruler’s orders by verifying his physical identity and ultimate authorization codes, all of which are hard-coded and cannot be changed. \r\n', 4, 2, 4, 0, 3, '', '', '2015-03-31 22:30:19'),
(579921, 'The Phoenix is on Fire', 'The Phoenix is on Fire\r\n\r\nIn the event of a direct attack on the Monarch-class Sovereign (also sometimes referred to as Super) Battlecruiser Phoenix, an encoded message will be sent to all commands “The Phoenix is on Fire” at which point the commanding officers of all commands are to respond first simply by stating their full rank and full name in an encoded message back to the Phoenix routed through their various headquarters and then they are to second, put their fleet, task force or battlegroup at the highest alert battle readiness and to begin moving their units into positions in which they are directly prepared to relieve the Royal fleet battleships from battle and or provide reinforcements. Those units nearest the Royal fleet while it has come under attack are to immediately leave their posts and provide reinforcements to the Royal Fleet. All other units are to move in to relieve the relief, and be prepared to move into primary attack positions surrounding the Royal BattleCruiser Phoenix. \r\n', 4, 2, 4, 0, 3, '', '', '2015-03-31 22:31:09'),
(609765, 'Exoneration of Former IRSB Agents', 'Imperial Republic Government\r\nRoyal Imperial Throne\r\nOffice of the Supreme Ruler\r\nHis Majesty the Supreme Ruler\r\nTo:  Executor Tavria Treyson, Grand Minister of COMPNOR\r\n       Praetor Bryan Dugaan, High Minister of COMPNOR, COMPNOR General Counsel\r\n       Praetor Kaidlen Shan, Commandant of His Majesty''s Royal Guard\r\n       Praetor Alexia Preston, His Majesty''s Special Forces\r\n       High Judicator Hosk Bu''watu, Imperial Republic High Judicate, presiding\r\n       Judicator Elouna Jofforu, Imperial Republic High Judicate\r\n       Judicator Allan Deapoli, Imperial Republic High Judicate\r\n      Corey Killinger, HMPS Policy Advisor (COMPNOR)\r\n      Lady Diandra Devin, HMPS Chief of Staff\r\n      Lady Selena Vadcasta, State Security Advisor\r\n      Vassim Feladora, COMPNOR Security Officer, IRSB\r\n      Jenov Raveshaw, Director of Imperial Republic Intelligence Service\r\n      Karcye Tanex, EPS Chief of Staff\r\n      General Raithos Bodost, Director-General of the Imperial Republic Security Bureau\r\n      Lieutenant Colonel Koru Tav, Adjutant of His Majesty''s Royal Guard\r\n      Nathan Gilmore, EPS General Counsel\r\nFrom: High Prince James T. Stratus, Supreme Ruler of the Imperial Republic\r\n\r\nSUBJECT: Executive Order Exonerating Former IRSB Agents\r\n\r\nAfter further review and investigation, it has been discovered that during the purge of defectors from the Imperial Republic Security Bureau led by former General Oho Gomao, innocent agents and former leaders of the IRSB before Oho Gomao infiltrated it were negatively affected. First, on behalf of the Imperial Republic Government, the Royal Imperial Throne, I sincerely offer my regrets for this horrible occurrence, and having met with and personally apologized to these agents, I further extend my apologies to their families and friends for all the pain and circumstance this has brought them. \r\n\r\nBy Executor Order, I hereby exonerate the following agents and further order that their pensions be restored retroactively and further grant eligibility to these personnel to be restored to full employment in COMPNOR, the Imperial Republic Security Bureau, the Ministry of State, the Imperial Republic Armed Forces or any other government position or office for which they are eligible. It is further ordered that their security clearances be restored. All medical and other benefits that are offered to full-time employees shall be extended to their families up to six generations as long as they live. The Royal Family is also offering full-ride scholarships with housing, medical, and food budget benefits to the same. COMPNOR is hereby directed to administrate these funds and benefits to the agents and their families and to provide in any ways possible to right this wrong. \r\n\r\nCOMPNOR is further directed to investigate in joint with the Royal Guard any other former agents that should have been exonerated. If cleared by the Royal Guard and a joint investigation with the COMPNOR Inspector General, the benefits extended in this Executive Order shall apply to the same.\r\n\r\nAny lawsuits brought forth by the agents and/or their families shall be treated as individual complaints against Government Operations and shall be taken seriously. This Executive Order shall not be taken into consideration as a settlement for their cases. COMPNOR shall further abide by any Court Order issued by the High Judicate. All cases regarding this shall be handled by the same. \r\n\r\nThe following former IRSB agents named are hereby exonerated and issued a full pardon:\r\nAragon Havalon\r\nIRSB-General Damon Delaynie (ret.)\r\nDavion Ronack\r\nHelaina Solo\r\nJerec Rahn\r\nKad Fallon\r\nNatalie Karaim\r\nRian Kats\r\nRonavin Dannaue \r\nTania Latta \r\nVincet Aldalon \r\nYevin Duchvony \r\nLyle Vandagroove\r\nMikael Solo \r\nSo ordered in the presence of the above named by High Prince James Stratus, Supreme Ruler of the Imperial Republic.', 2, 2, 4, 0, 2, '2', '', '2015-06-08 02:51:40'),
(603586, 'Oath of Office', 'On [23 April 2009], the High Council voted that all government employees and military personnel shall take an oath upon gaining employment, voluntary or otherwise, and all currently serving government personnel, elected, appointed, hired, or conscripted shall take the aforementioned oath immediately within 72 hours.\r\n\r\nThe Government Oath:\r\nI [YOUR NAME HERE], do solemnly swear that I will support and defend the Charter of the Imperial Republic against all enemies, foreign and domestic, that I will bear true faith and allegiance to the same, that I will protect and defend the Sovereignty of the Imperial Republic, the High Prince and Throne, and the Royal Family as the guardians of our liberty, that I take this obligation freely, without any mental reservation or purpose of evasion, and I will well and faithfully discharge the duties of the office on which I am about to enter. \r\n\r\nThe Military Oaths:\r\nEnlisted Oath\r\n\r\n"I, [YOUR NAME HERE], do solemnly swear (or affirm) that I will support and defend the Charter of the Imperial Republic against all enemies, foreign and domestic; that I will bear true faith and allegiance to the same; that I pledge my absolute loyalty and faith in the Supreme Ruler of the Imperial Republic and the Royal Family; and that I will obey the orders of the Throne, Minister of Defense, and the orders of the officers appointed over me, according to regulations and the Ministry of Defense Standard Operating Procedures." \r\n\r\nOfficer’s Oath\r\n\r\n"I, [YOUR NAME HERE] , having been appointed an officer in the Imperial Republic Armed Forces, as indicated above in the grade of [rank and grade here] do solemnly swear (or affirm) that I will support and defend the Charter of the Imperial Republic against all enemies, foreign or domestic, that I will bear true faith and allegiance to the same; that I pledge my absolute loyalty and faith in the Supreme Ruler of the Imperial Republic and the Royal Family; and that I will obey the orders of the Throne, Minister of Defense, that I will I will uphold the ideals of His Majesty''s New Order; that I take this obligation freely, without any mental reservations or purpose of evasion; and that I will well and faithfully discharge the duties of the office upon which I am about to enter."\r\n\r\nCommanded by the Imperial Republic High Council this day on [23 April 2009].', 1, 2, 4, 0, 6, '2', '', '2015-06-30 10:10:40'),
(444605, 'CODE System', 'CODE System\r\nCommand Operations Declare Emergency\r\n\r\nFor use by Royal Guard and High Command and their Security Details \r\n \r\nCODE NO.\r\nALARM DESCRIPTION\r\nCODE 1\r\nDEATH OF PROTECTEE\r\nCODE 2\r\nGUARDS DOWN\r\nCODE 3\r\nDIRECT ATTACK/ENGAGEMENT OF PROTECTEE OR PALACE\r\nCODE 4\r\nDETONATOR/EXPLOSIVES THREAT/DISCOVERY\r\nCODE 5\r\nPROTECTEE MISSING\r\nCODE 6\r\nMEDICAL EMERGENCY (PROTECTEE DOWN - NOT DEAD)\r\nCODE 7\r\nBETRAYAL/INFILITRATION OF SECURITY OR TRUSTED INDIVIDUALS\r\nCODE 8\r\nCOMMUNICATIONS JAMMING OF PROTECTEE''S AREA\r\nCODE 9\r\nIMPENDING THREAT AGAINST PROTECTEE\r\nCODE RED\r\nHIGH SECURITY ALERT ALL UNITS/LOCKDOWN/LOCAL MILITARY UNITS TO RED STATUS\r\nCODE YELLOW\r\nHIGHTENED SECURITY ALERT (LOWER THAN RED) TO ALL UNITS\r\nCODE GREEN\r\nALL CLEAR - CALL OF SECURITY ALERTS\r\n\r\nIntegrate with IRIN maybe? Need php programmer for that.\r\n \r\nFORMAT For TRANSMISSION OF CODE ALARM\r\n \r\nMESSAGE:\r\nCODE (#HERE) (TARGET/OR GROUP/INDIVIDUAL) (LOCATION) (GROUP/UNIT/INDIVIDUAL RECIPIENTS) (DATE) (SENDER)\r\n \r\nWHO CAN SEND CODE ALARMS: RG, PSA, IRIS, IRSB, MOD, HC, THRONE, RF, HMPS\r\n', 3, 2, 4, 0, 5, '2', '', '2015-07-02 02:03:10'),
(545668, 'IRIS Reorganization', 'Intelligence Reorganization\r\n\r\nhttp://images.eotir.com/charts/IRIS_Org_Chart.pdf', 4, 2, 2, 0, 2, '2', '', '2015-10-06 02:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `desc` varchar(100) NOT NULL DEFAULT '',
  `page` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `clearance` int(3) NOT NULL DEFAULT '0',
  `admin` int(3) NOT NULL DEFAULT '0',
  `team` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `desc`, `page`, `title`, `clearance`, `admin`, `team`) VALUES
(1, 'Home', 'Home Page', 'home', 'Home', 0, 0, 0),
(2, 'User Info', 'Your Information', 'info', 'User Information', 0, 0, 0),
(3, 'Documents', 'IRIN Documents', 'documents', 'IRIN Documents', 0, 0, 0),
(4, 'Security Clearances', 'Manage Security Clearances', 'clearances', 'Security Clearances', 4, 0, 0),
(19, 'Manage Users', 'Manage Users', 'users', 'Manage Users', 0, 1, 0),
(9, 'Merit System', 'Merit System', 'meritdb', 'Merit System Database', 4, 0, 0),
(20, 'Development Work Log', 'Developer''s Log of Changes to IRIN', 'devworklog', 'Developer''s Work Log', 0, 1, 31),
(5, 'Security Clearance Request', 'Security Clearance Request Form', 'securityrequest', 'Security Clearance Request Form', 4, 0, 0),
(6, 'Senate Registry Listing', 'Senate Registry', 'senateregistry', 'Senate Registry', 2, 0, 0),
(7, 'Senator Registration', 'Senator Registration Form', 'registersenator', 'Senator Registration Form', 1, 0, 0),
(11, 'Rank Information', 'Rank Information', 'ranks', 'Rank Information', 0, 1, 0),
(24, 'Update Version', 'Update IRIN Version', 'version', 'IRIN System Version Update', 0, 3, 0),
(17, 'Code Generator', 'Code Generator', 'codegen', 'Code Generator', 0, 1, 0),
(18, 'Admin Editor', 'Administrative Staff Editor', 'admin', 'Administrative Staff Editor', 0, 4, 0),
(10, 'Holonet', 'Holonet', 'holonet', 'Holonet', 1, 0, 0),
(23, 'Update Year', 'Update IR Year', 'irclockup', 'Imperial Republic Year Update', 0, 3, 0),
(12, 'Record Oath', 'Record Oath of Office', 'recoath', 'Record Oath of Office', 3, 0, 0),
(13, 'View Oath', 'View Oath of Office', 'viewoath', 'View Oath of Office', 3, 0, 0),
(21, 'Error Logging', 'Error Logging', 'errors', 'Error Logging', 0, 2, 31);

-- --------------------------------------------------------

--
-- Table structure for table `prefixes`
--

CREATE TABLE IF NOT EXISTS `prefixes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `abbrev` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `prefixes`
--

INSERT INTO `prefixes` (`id`, `name`, `abbrev`) VALUES
(1, 'Supreme Command', 'C'),
(2, 'Executive Order', 'E'),
(3, 'Defense', 'D'),
(4, 'Intelligence', 'I'),
(5, 'Security', 'S'),
(6, 'Government', 'G'),
(7, 'Financial', 'F'),
(8, 'Business', 'B'),
(9, 'Private', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE IF NOT EXISTS `ranks` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `division` int(1) NOT NULL DEFAULT '0',
  `abbrev` varchar(100) NOT NULL DEFAULT '',
  `rank` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`id`, `name`, `division`, `abbrev`, `rank`) VALUES
(1, 'Cadet', 1, 'CDT', 'E-1'),
(2, 'Crewman', 1, 'CWM', 'E-2'),
(3, 'Crewman 1st Class', 1, 'CFC', 'E-3'),
(4, 'Lance Corporal', 1, 'LCPL', 'E-4'),
(5, 'Staff Corporal', 1, 'SCPL', 'E-5'),
(6, 'Sergeant', 1, 'SGT', 'E-6'),
(7, 'Staff Flight Sergeant', 1, 'SFSGT', 'E-7'),
(8, 'Warrant Officer', 1, 'WOFF', 'O-1'),
(9, 'Sub Lieutenant', 1, 'SLT', 'O-2'),
(10, 'Lieutenant', 1, 'LT', 'O-3'),
(11, 'Major', 1, 'MAJ', 'O-4'),
(12, 'Commander', 1, 'CMDR', 'O-5'),
(13, 'Captain', 1, 'CPT', 'O-6'),
(14, 'Group Captain', 1, 'GCPT', 'O-7'),
(15, 'Colonel', 1, 'COL', 'O-8'),
(16, 'Commodore', 1, 'CDRE', 'C-1'),
(17, 'Marshall', 1, 'MSHL', 'C-2'),
(18, 'General', 1, 'GEN', 'C-3'),
(19, 'Admiral', 1, 'ADM', 'C-4'),
(20, 'Command Marshall', 1, 'CMSHL', 'C-5'),
(21, 'Fleet Admiral', 1, 'FADM', 'C-6'),
(22, 'High Marshall', 1, 'HMSHL', 'HC-1'),
(23, 'Grand General', 1, 'GGEN', 'HC-2'),
(24, 'Grand Admiral', 1, 'GADM', 'HC-3'),
(25, 'Grand Marshall', 1, 'GMSHL', 'HC-3'),
(26, 'Lord Admiral', 1, 'LADM', 'HC-4'),
(27, 'Lord Marshall', 1, 'LMSHL', 'HC-4'),
(28, 'Clerk', 4, 'Clerk', 'O-1'),
(29, 'Jr. Senator', 11, 'Sen.', 'O-2'),
(30, 'Sr. Senator', 11, 'Sen.', 'O-3'),
(31, 'System Constable', 4, 'Const.', 'O-4'),
(32, 'Sector Ranger', 4, 'Ranger', 'O-5'),
(33, 'Territorial Administrator', 4, 'Administrator', 'O-6'),
(34, 'Sr. Political Commissioner', 4, 'Commissioner', 'C-1'),
(35, 'Federal Inspector', 4, 'Inspector', 'C-2'),
(36, 'Ethics Marshall', 4, 'E. Marshall', 'C-3'),
(37, 'IR Attorney', 4, 'Counselor', 'C-4'),
(38, 'Regional Director', 4, 'Director', 'C-5'),
(39, 'Compliance Coordinator', 4, 'Com.Coord.', 'C-6'),
(40, 'Technical Chancellor', 4, 'TChanc.', 'HC-1'),
(41, 'Trustee', 4, 'Trustee', 'HC-2'),
(42, 'Mayor', 2, 'Mayor', 'O-1'),
(43, 'Prefect', 2, 'Prefect', 'O-2'),
(44, 'Lieutenant Governor', 2, 'Lt. Governor', 'O-3'),
(45, 'Governor', 2, 'Gov.', 'O-5'),
(46, 'Sr. Diplomat', 2, 'Diplmat', 'C-1'),
(47, 'Sector Adjutant', 2, 'Sec. Adj.', 'C-2'),
(48, 'Representative', 2, 'Rep.', 'C-3'),
(49, 'Consul', 2, 'Consul', 'C-4'),
(50, 'Special Envoy', 2, 'Envoy', 'C-5'),
(51, 'Dep. Chief of Mission', 2, 'Dep. Chief-Mission', 'C-6'),
(52, 'Ambassador', 2, 'Ambassador', 'HC-1'),
(53, 'Moff', 2, 'Moff', 'HC-1'),
(54, 'Grand Moff', 2, 'G.Moff.', 'HC-2'),
(55, 'Agent of the Throne', 6, 'Agent', 'RT-1'),
(56, 'Praetor', 6, 'Praetor', 'RT-2'),
(57, 'Supreme Chancellor', 6, 'Supreme Chancellor', 'RT-3'),
(58, 'Executor', 6, 'Executor', 'RT-4'),
(59, 'Grand Vizier', 6, 'Lord', 'RT-5'),
(60, 'Supreme Ruler', 6, 'High Prince', 'RT--6'),
(61, 'Junior Agent', 10, 'Jr. Agent', 'O-1'),
(62, 'Agent', 10, 'Agent', 'O-2'),
(63, 'Senior Agent', 10, 'Sr. Agent', 'O-3'),
(64, 'Staff Agent', 10, 'Staff Agent', 'O-4'),
(65, 'Master Agent', 10, 'M. Agent', 'O-5'),
(66, 'Assistant Chief', 10, 'Ast. Chief', 'O-6'),
(67, 'Chief', 10, 'Chief', 'C-1'),
(68, 'Assistant Bureau Chief', 10, 'Chief', 'C-2'),
(69, 'Bureau Chief', 10, 'Chief', 'C-4'),
(70, 'Underdirector', 10, 'Director', 'C-5'),
(71, 'Deputy Director', 10, 'Director', 'C-6'),
(72, 'Director', 10, 'Director', 'HC-1'),
(73, 'Lord', 15, 'Lord', 'C-1'),
(74, 'Lady', 15, 'Lady', 'C-1'),
(75, 'High Councilor', 2, 'Councilor', 'HC-3'),
(76, 'Staff', 0, 'Staff', 'S-1'),
(77, 'Developer', 0, 'Dev.', 'S-2'),
(79, 'Administrator', 0, 'Admin', 'S-3'),
(80, 'Lead Administrator', 0, 'Lead Admin', 'S-6'),
(81, 'Civillian', 2, 'Civillian', 'E-0'),
(82, 'Line Captain', 20, 'LCAPT', 'C-1'),
(83, 'Commodore', 20, 'CDRE', 'C-2'),
(84, 'Rear Admiral', 20, 'RADM', 'C-3'),
(85, 'Vice Admiral', 20, 'VADM', 'C-4'),
(86, 'Admiral', 20, 'ADM', 'C-5'),
(87, 'Fleet Admiral', 20, 'FADM', 'C-6');

-- --------------------------------------------------------

--
-- Table structure for table `stacktrace`
--

CREATE TABLE IF NOT EXISTS `stacktrace` (
  `errorNo` int(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `line` int(5) NOT NULL,
  `class` varchar(25) DEFAULT NULL,
  `function` varchar(50) DEFAULT NULL,
  `args` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stacktrace`
--

INSERT INTO `stacktrace` (`errorNo`, `file`, `line`, `class`, `function`, `args`) VALUES
(1, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(1, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '63'),
(1, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '63'),
(2, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(2, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '63'),
(2, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '63'),
(3, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(3, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '63'),
(3, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '63'),
(4, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(4, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '63'),
(4, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '63'),
(5, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(5, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '87'),
(5, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '87'),
(6, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(6, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '87'),
(6, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '87'),
(7, '/home/eotircom/public_html/irin/lib/document.class.php', 57, 'User', '__construct', ''),
(7, '/home/eotircom/public_html/irin/lib/document.class.php', 140, 'Document', '__construct', '929140'),
(8, '/home/eotircom/public_html/irin/lib/document.class.php', 57, 'User', '__construct', ''),
(8, '/home/eotircom/public_html/irin/lib/document.class.php', 106, 'Document', '__construct', '929140'),
(9, '/home/eotircom/public_html/irin/lib/document.class.php', 57, 'User', '__construct', ''),
(9, '/home/eotircom/public_html/irin/lib/document.class.php', 106, 'Document', '__construct', '929140'),
(13, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(13, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '88'),
(13, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '88'),
(14, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(14, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '88'),
(14, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '88'),
(15, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(15, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '88'),
(15, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '88'),
(16, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(16, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '88'),
(16, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '88'),
(17, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(17, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '88'),
(17, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '88'),
(18, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(18, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '88'),
(18, '/home/eotircom/public_html/irin/lib/admin.class.php', 48, 'User', '__construct', '88'),
(18, '/home/eotircom/public_html/irin/admin.php', 20, 'Admin', 'getAdmins', ''),
(19, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(19, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '88'),
(19, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '88'),
(20, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(20, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '88'),
(20, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '88'),
(21, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(21, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '88'),
(21, '/home/eotircom/public_html/irin/lib/admin.class.php', 48, 'User', '__construct', '88'),
(21, '/home/eotircom/public_html/irin/admin.php', 20, 'Admin', 'getAdmins', ''),
(22, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(22, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '88'),
(22, '/home/eotircom/public_html/irin/lib/user.class.php', 110, 'User', '__construct', '88'),
(23, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(23, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '90'),
(23, '/home/eotircom/public_html/irin/lib/user.class.php', 73, 'User', '__construct', '90'),
(23, '/home/eotircom/public_html/irin/login.php', 7, 'User', 'login', 'alun, F1Dt7jtc'),
(24, '/home/eotircom/public_html/irin/lib/admin.class.php', 34, 'Division', '__construct', ''),
(24, '/home/eotircom/public_html/irin/lib/user.class.php', 44, 'Admin', '__construct', '90'),
(24, '/home/eotircom/public_html/irin/lib/user.class.php', 73, 'User', '__construct', '90'),
(24, '/home/eotircom/public_html/irin/login.php', 7, 'User', 'login', 'alun, F1Dt7jtc');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `rank` int(3) NOT NULL DEFAULT '81',
  `ip` varchar(100) NOT NULL DEFAULT '',
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(100) NOT NULL DEFAULT '',
  `clearance` int(3) NOT NULL DEFAULT '0',
  `division` int(2) NOT NULL DEFAULT '17',
  `merits` varchar(10) NOT NULL DEFAULT '0',
  `unitleader` int(1) NOT NULL DEFAULT '0',
  `subdivleader` int(1) NOT NULL DEFAULT '0',
  `divleader` int(1) NOT NULL DEFAULT '0',
  `admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `rank`, `ip`, `lastlogin`, `name`, `clearance`, `division`, `merits`, `unitleader`, `subdivleader`, `divleader`, `admin`) VALUES
(1, 'ryan', '5c829688fa749af4624e122624444222', 'ryan.mander@gmail.com', 80, '184.98.198.42', '2016-02-16 16:54:20', 'Ryan', 7, 0, '0', 1, 1, 1, 6),
(2, 'Stratus', 'fdeea652a89ec3e970d22a86698ac8c4', 'stratus@eotir.net', 60, '184.98.198.42', '2016-02-16 19:36:35', 'James Stratus', 6, 6, '0', 0, 0, 1, 1),
(59, 'keshaun', 'f52788b00c9a6f683a6290fb10990577', 'keshaun@eotir.com', 79, '24.191.200.108', '2016-02-10 20:39:22', 'Keshaun', 7, 31, '0', 0, 0, 0, 4),
(60, 'planewalker', '6d74b2640e408ffe23db3b1c193aa7ab', 'planewalker@eotir.com', 79, '172.2.181.242', '2016-02-18 15:56:18', 'Planewalker', 7, 0, '0', 1, 1, 0, 5),
(61, 'tavria', '3159f4f9de66672f935b7d106096a1e8', 'tavria.treyson@gmail.com', 58, '96.28.121.28', '2016-01-23 23:52:21', 'Tavria Treyson', 6, 6, '0', 0, 0, 1, 0),
(62, 'evaders99', '282b931dc2722ad70676e085abce85b9', 'evaders99@gmail.com', 77, '', '0000-00-00 00:00:00', 'Evaders99', 7, 0, '0', 0, 0, 0, 0),
(63, 'lan', 'f52788b00c9a6f683a6290fb10990577', 'lan@eotir.net', 72, '', '0000-00-00 00:00:00', 'Lan Klone', 5, 10, '1200', 1, 1, 1, 1),
(73, 'mavrick', '8fe70c5429281da7774f7c49b200c9fb', 'mavrick@eotir.com', 76, '', '0000-00-00 00:00:00', 'Mavrick', 7, 0, '0', 0, 0, 0, 0),
(71, 'preston', '3bfa31b5f8e5c201b1746cea6cc9c488', 'talkinghandz2005@gmail.com', 56, '', '0000-00-00 00:00:00', 'Alexia Preston', 5, 13, '0', 1, 0, 1, 0),
(68, 'Jared', 'a8d40c9bae9acba3dcc3c8ee741edc5b', 'jquinn@nerddom.com', 24, '', '0000-00-00 00:00:00', 'Jared Quinn', 4, 7, '24', 1, 1, 1, 0),
(69, 'simon', '45a59fce1e889636c94d059828f3854f', 'k12345kk@aim.com', 13, '', '0000-00-00 00:00:00', 'Simon Moris', 4, 18, '0', 1, 0, 0, 0),
(70, 'diandra', 'feb805b323b4c816f04d2a5fc672ce91', 'lunarwinds@msn.com', 74, '', '0000-00-00 00:00:00', 'Diandra Devin', 5, 15, '0', 1, 0, 0, 0),
(72, 'revan', '18f58d4a140c1542ed5679ef588c5346', 'revan.centurion@gmail.com', 56, '', '0000-00-00 00:00:00', 'Revan Centurion', 5, 6, '0', 0, 0, 0, 0),
(74, 'terrisa', '91ca5e2b27443fc09e8958fa6623dc5b', 'terrisa@eotir.net', 74, '', '0000-00-00 00:00:00', 'Terrisa Klone', 4, 15, '0', 0, 1, 0, 0),
(78, 'dene', '7fdb607cd0237e14fe141dcb50cbfee3', 'robert.grincho@gmail.com', 27, '98.167.36.138', '2016-02-10 20:40:50', 'Dene Vye Cognatus', 4, 1, '0', 1, 1, 0, 0),
(79, 'vacosa', '959b13bf763dcd443de91752ef981042', 'ryou@vacosa.org', 77, '', '0000-00-00 00:00:00', 'Ryou Vacosa', 7, 0, '0', 0, 0, 0, 0),
(82, 'jkelly', 'bcd9023f045c42a20f27af32d4a7a2f7', 'drchambers78@gmail.com', 19, '', '0000-00-00 00:00:00', 'John Kelly', 4, 7, '0', 1, 0, 0, 0),
(83, 'novocast7', '122b17481c894afbcd53edbd63525bf5', 'novocast7@gmail.com', 77, '', '0000-00-00 00:00:00', 'novocast7', 7, 0, '0', 1, 1, 1, 0),
(84, 'phoenix', '03f54ec0ebc8340a44bb35a736dea1cc', 'phoenix@eotir.net', 54, '', '0000-00-00 00:00:00', 'Phoenix Katarn', 5, 2, '0', 0, 0, 0, 0),
(0, 'system', '7a676a42d4074fe3f78c1b53b0671363', 'operations@eotir.com', 79, '', '0000-00-00 00:00:00', 'System', 7, 0, '0', 0, 0, 0, 0),
(86, 'kshan', '2c420fa85e002bf38fd3880968220c9c', 'syberjedi@kimbanet.com', 56, '', '0000-00-00 00:00:00', 'Kaidlen Shan', 7, 18, '0', 0, 1, 1, 0),
(87, 'SyberJedi', '875291d9c2c9ba180f205c1bf397f06b', 'kaylene@syberjedi.com', 76, '', '0000-00-00 00:00:00', 'Kaylene SyberJedi', 7, 0, '0', 0, 0, 0, 0),
(89, 'Patrick', 'dc856ca2bf397761e5aff00507fb80b8', 'patrick@eotir.com', 79, '184.98.150.67', '2016-01-17 23:24:47', 'Patrick', 7, 0, '0', 0, 1, 1, 0),
(90, 'alun', '0e6f3ebde5c3594bd49318ac59fab9b5', 'raven@raven-nc.net', 84, '65.188.189.198', '2016-02-16 20:09:58', 'Alun Tringad', 4, 21, '0', 0, 1, 1, 1),
(91, 'Katherine', 'c5e620e4cbd5fe13a50c42c775ae4f86', 'katherine@eotir.com', 79, '68.228.234.35', '2016-01-30 00:41:28', 'Katherine', 7, 32, '0', 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE IF NOT EXISTS `version` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `version` varchar(12) NOT NULL,
  `vtimestamp` date NOT NULL,
  `latest` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `version` (`version`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='IRIN Version Updates' AUTO_INCREMENT=14 ;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `version`, `vtimestamp`, `latest`) VALUES
(1, '1.0&alpha;', '2005-06-14', 0),
(2, '&alpha;', '2005-06-14', 0),
(3, '1.1&alpha;', '2005-06-14', 0),
(4, '1.2&alpha;', '2005-04-02', 0),
(5, '1.3&alpha;', '2011-06-21', 0),
(6, '1.4&beta;', '2011-06-21', 0),
(7, '1.5&beta;', '2011-06-28', 0),
(8, '1.6&beta;', '2011-07-03', 0),
(9, '1.7&beta;', '2011-07-04', 0),
(10, '1.8&beta;', '2011-07-05', 0),
(11, '1.9&beta;', '2011-07-06', 0),
(12, '2.0', '2012-07-16', 0),
(13, '3.0', '2015-10-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `worklog`
--

CREATE TABLE IF NOT EXISTS `worklog` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `log` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `pcrNum` int(3) NOT NULL,
  `minorPCR` int(2) DEFAULT NULL,
  `assigned` int(3) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `worklog`
--

INSERT INTO `worklog` (`id`, `log`, `status`, `pcrNum`, `minorPCR`, `assigned`, `date`) VALUES
(1, 'Design IRIN Logo based on current color theme (fancy text? IR image? Shapes around text?)', 2, 1, NULL, 60, '6/21/11'),
(2, 'Change logon IDs from generated numbers to usernames and allow admin to set username upon "new user" function.', 2, 2, NULL, 59, '6/21/11'),
(3, 'Add/Modify "Documents" features and design. <b><font color=red>PRIORITY</font></b>', 2, 3, NULL, 59, '7/3/11'),
(4, 'Cleanup & Beef Up Individual Document Display (organize html code/format). <b><font color=red>PRIORITY</font></b>', 2, 4, NULL, 59, '7/3/11'),
(5, 'Associate Users with Divisions (see new divisions table) <b><font color=red>PRIORITY</font></b>', 2, 5, NULL, 59, '7/5/11'),
(6, 'Re-design IRIN website/format to Template', 2, 6, NULL, 1, '6/21/11'),
(7, 'Edit the "Edit User" feature to allow administrators to edit login IDs', 2, 7, NULL, 59, '6/29/11'),
(8, 'Change Security Clearance page to import from Google Docs spreadsheet', 1, 8, NULL, 1, NULL),
(9, 'Creation of Divisions/units to sort messages and prevent users from directly listing other division''s documents/orders. Note: Any document is viewable still with the search function IF the security clearance is valid enough (but they have to know the exact ID#). This will be for "verifying orders" in IC situations.', 1, 9, NULL, 60, NULL),
(10, 'Integrate/Merge Merit Database/System into IRIN - recode from fleets to "units" - http://dev.eotir.net/meritdb/ <b><font color=red>PRIORITY</font></b>', 2, 10, NULL, 59, '7/4/11'),
(11, 'Add a changelog file that reflects each PCR as they are applied and add a version number to the bottom of all pages that queries from a file or db value. Version numbers starting at 1.1 with PCR-1. PCR-10 will mark Version 2.0.', 2, 11, NULL, 59, '7/4/11'),
(12, 'Use template for logon page (index.php) for the lost password page and edit where logon errors display so they are readable in the center bottom or top (below form entry) area.', 1, 12, NULL, 1, NULL),
(13, 'Manage Ranks page = ability to edit ranks table on scripted page for admins.', 2, 13, NULL, 59, '7/5/11'),
(14, 'Modify logout.php to have the same html template as the login page (index.php).', 1, 14, NULL, 1, NULL),
(15, 'Add Senator Registration and Senate Registry to IRIN', 2, 15, NULL, 1, '6/28/11'),
(16, 'Add Unit Leader''s security clearance request form', 2, 16, NULL, 1, '6/28/11'),
(17, 'Maintain a Work Log of completed, planned, and in progress changes to IRIN maintained by Developers.', 2, 17, NULL, 59, '6/27/11'),
(18, 'Security Clearance Viewing Restrictions', 2, 18, NULL, 1, '6/28/2011'),
(19, 'add Internet Relay Chat integrated page', 1, 19, NULL, NULL, NULL),
(20, 'Update Version page for admin level 2 and up - | version.php - variables should be set from the table "version"in the database. Tw variables, \r\nversion"and "datetime". The admin page would simply update the version and timestamp/datetime the time the version update takes place.', 1, 20, NULL, NULL, NULL),
(21, 'Ability for admin level 2 to update Development Work log with an edit button (raw file edit - not DB/SQL, file-based only). (Basically a plain text edit boxwith a save button). Is this possible?', 1, 21, NULL, NULL, NULL),
(22, 'On successful user logon, update "lastlogon" field on the users table with current "timestamp" and obtain and update IP address to the "ip" field on the user''s table.', 1, 22, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zPLANNEDUSE_units`
--

CREATE TABLE IF NOT EXISTS `zPLANNEDUSE_units` (
  `unit_id` int(3) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `unit_type` tinyint(2) NOT NULL DEFAULT '1',
  `parent_unit` int(3) DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='List of IR Divisions' AUTO_INCREMENT=18 ;

--
-- Dumping data for table `zPLANNEDUSE_units`
--

INSERT INTO `zPLANNEDUSE_units` (`unit_id`, `unit_name`, `unit_type`, `parent_unit`) VALUES
(1, 'Ministry of Defense', 1, NULL),
(2, 'Ministry of State', 1, NULL),
(3, 'COMPNOR', 1, NULL),
(4, 'Regional Governance', 1, NULL),
(5, 'Royal Family', 1, NULL),
(6, 'Throne', 1, NULL),
(7, 'Armed Forces', 1, 1),
(8, 'Research & Development', 1, 1),
(9, 'Military Crime Investigative Service', 1, 1),
(10, 'Imperial Republic Intelligence Service', 1, 2),
(11, 'Galactic Senate', 1, 2),
(12, 'Imperial Republic Security Bureau', 1, 3),
(13, 'His Majesty''s Special Forces', 1, 6),
(14, 'High Council', 1, 6),
(15, 'Their Majesty''s Staff', 1, 6),
(16, 'Royal Command Fleet', 1, 6),
(17, 'EOTIR Staff', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zPLANNEDUSE_unit_types`
--

CREATE TABLE IF NOT EXISTS `zPLANNEDUSE_unit_types` (
  `utype_id` int(3) NOT NULL AUTO_INCREMENT,
  `utype_name` varchar(100) NOT NULL,
  PRIMARY KEY (`utype_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `zPLANNEDUSE_unit_types`
--

INSERT INTO `zPLANNEDUSE_unit_types` (`utype_id`, `utype_name`) VALUES
(1, 'Government'),
(2, 'Division'),
(3, 'Subdivison'),
(5, 'Unit');

-- --------------------------------------------------------

--
-- Table structure for table `zREFERENCE_admin_levels`
--

CREATE TABLE IF NOT EXISTS `zREFERENCE_admin_levels` (
  `admin_lvl` int(3) NOT NULL,
  `admlvl_desc` varchar(100) NOT NULL,
  `admlvl_who` varchar(100) NOT NULL,
  PRIMARY KEY (`admin_lvl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='List of Admin Levels';

--
-- Dumping data for table `zREFERENCE_admin_levels`
--

INSERT INTO `zREFERENCE_admin_levels` (`admin_lvl`, `admlvl_desc`, `admlvl_who`) VALUES
(0, 'Regular User', 'Default'),
(1, 'Basic Admin', 'In-Character Security Officers, etc.'),
(2, 'Power Admin', 'Faction Leaders and their designates'),
(3, 'Developer Admin', 'OOC Development Staff'),
(4, 'Admin Supervisor', 'OOC Assistant Admin / Team Leader'),
(5, 'Senior Admin', 'OOC Sr. Assistant Admin'),
(6, 'Lead Admin', 'OOC Lead Admin / Owner');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
