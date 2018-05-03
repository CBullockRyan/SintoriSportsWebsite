-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2018 at 01:15 PM
-- Server version: 5.7.19-log
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sintori`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `contentID` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(20) NOT NULL,
  `content` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`contentID`, `title`, `content`) VALUES
(1, 'Dance Classes', '<p>Come learn to dance with beginner, intermediate, and advanced dance classes. We also have classes for children. Classes are free to members but you must register for a class to be guaranteed admission. All of our classes are taught by professionals and we periodically have classes in these styles:</p><ul><li>Single Time Swing</li><li>West Coast Swing</li><li>Lindy Hop</li><li>Foxtrot</li><li>Waltz</li><li>Tango</li><li>Cha Cha</li><li>Rhumba</li><li>Salsa</li></ul><p>We also put on Dance Social Nights so keep an eye on the <a href=\"user_event_view.php\">event page</a>.</p><p>Please contact us if you want more information. If you are not a member, please <a href=\"user_contact.php\">contact us</a> to get the price on a set of classes.</p>'),
(2, 'Rock Climbing', '<p>Enjoy a <strong>FULL BODY WORKOUT </strong>with our indoor rock climbing gym. We have both top roping and bouldering facilities. Please note that you must get certified by us before you can top rope. You can bring your own gear from home, or rent some with us. Beginners welcome.</p><ul><li>Rock climbing shoes: $5</li><li>Harness and Carabiner: $10</li><li>Chalk and Chalk Bag: $5</li><li>Or all three for $15</li></ul>'),
(3, 'Hurling/Camogie', '<p>Want to learn a team sport? Sintori has hurling and camogie teams for all age groups. All skill levels welcome. Meeting times are as follows:</p><ul><li>Kinders: Saturdays at 10am</li><li>7-8 age group: Mondays at 4pm.</li><li>9-10 age group: Mondays at 6pm.</li><li>11-12 age group: Tuesdays and Thursdays at 4pm</li><li>13-14 age group: Tuesdays and Thursdays at 6pm</li><li>15-16 age group: Wednesdays and Fridays at 4pm</li><li>17-18 age group: Wednesdays and Fridays at 6pm</li><li>Adults: Saturdays and Sundays at 6pm</li></ul>'),
(4, 'Indoor Skydiving', '<p>Want the <i>thrill of <strong>skydiving</strong></i> but don\'t want the hefty fees? Sintori has indoor skydiving. Rent the gear for only $10. Please note that children under the age of 13 may not use the skydiving facilities.</p>'),
(5, 'Membership', '<p>All of our memberships are all inclusive. Try dancing, skydiving, rock climbing, and hurling/camogie or sign up for one of our social events. The types and rates are listed below:&nbsp;</p>'),
(6, 'Sintori Sports Club', '<p>Welcome to Sintori Sports Club! We are a unique sports club catered towards doing irregular sports such as <a href=\"user_rock.php\">rock climbing</a>, <a href=\"user_dance.php\">dance</a>, <a href=\"user_hurling.php\">hurling/camogie</a>, and <a href=\"user_skydiving.php\">indoor skydiving</a>. Our <a href=\"user_membership.php\">memberships</a> include access to all of our services and we also put on <a href=\"user_event_view.php\">events</a> open to the general public. If you have want to sign up for a membership or have any questions please <a href=\"user_contact.php\">contact us</a>. We look forward to seeing you soon!</p>');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `enquiryID` mediumint(8) UNSIGNED NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `enquiryComment` longtext NOT NULL,
  `resolved` enum('Y','N') NOT NULL DEFAULT 'N',
  `nonmemberID` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`enquiryID`, `subject`, `enquiryComment`, `resolved`, `nonmemberID`) VALUES
(24, 'Rock Climbing Hours', 'Hi,\r\n\r\nI was just wondering when the rock gym is open. Is it the same times as the entire gym or does it close earlier?\r\n\r\nThanks\r\n\r\nEthan Bullock', 'Y', 1),
(25, 'Dancing Shoes', 'Good Morning,\r\n\r\nI was just wondering if I needed dancing shoes for the dance classes? Or what should I where generally.\r\n\r\nBest,\r\n\r\nPaige', 'N', 3),
(26, 'Complaint', 'Hi,\r\n\r\nLast night when I came to visit the gym to get some information about it, the staff were too busy talking to each other and didn\'t even notice me for 5 minutes. The service here should be better.\r\n\r\nPaige', 'N', 3),
(27, 'Help', 'Hi,\r\n\r\nI wanted to find the location of this gym but I can\'t seem to find the address on google maps. It\'s like this place doesn\'t exist or something. Could you give me some directions to it?\r\n\r\nThank you,\r\n\r\nJeremy Fischer', 'N', 8);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventID` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `imgPath` varchar(200) DEFAULT NULL,
  `description` longtext NOT NULL,
  `eventTime` time NOT NULL,
  `eventDate` date NOT NULL,
  `maxAttendee` int(4) NOT NULL,
  `currentAttendee` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `title`, `imgPath`, `description`, `eventTime`, `eventDate`, `maxAttendee`, `currentAttendee`) VALUES
(4, 'Dance Social- Friday Night', 'uploads/dance_social.jpg', 'Hey everyone! Ready to show off all you best dance moves? We are having a dance social incorporating many styles of dance together in one night. Come along and join the fun. Beginners welcome.', '18:00:00', '2018-06-01', 150, 0),
(5, 'Rock Climbing Weekend Trip', 'uploads/weekend_rock.jpg', 'Want to spend the weekend climbing and getting to know other climbers? In this weekend event, we will transport you to a rock climbing location where climbers of all skill levels can test their skills. Transport, food and lodging are provided. We will meet at the rock wall at 4pm on Friday, June 15. All gear is provided. The cost is $100 per person, payable on the day at the meetup location. We get back at approximately 8pm Sunday, June 17. There are a limited number of spaces so sign up soon!', '16:00:00', '2018-06-15', 15, 15),
(6, 'Sintori Birthday Party', 'uploads/birthday.jpg', 'Sintori is turning 1 on May 8th. Join us for a raffle and some free food to celebrate.', '19:00:00', '2018-05-08', 250, 7);

-- --------------------------------------------------------

--
-- Table structure for table `eventbooking`
--

CREATE TABLE `eventbooking` (
  `eventBookingID` mediumint(8) UNSIGNED NOT NULL,
  `eventID` mediumint(8) UNSIGNED NOT NULL,
  `nonmemberID` mediumint(8) UNSIGNED DEFAULT NULL,
  `membershipID` mediumint(8) UNSIGNED DEFAULT NULL,
  `numAttendee` int(3) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eventbooking`
--

INSERT INTO `eventbooking` (`eventBookingID`, `eventID`, `nonmemberID`, `membershipID`, `numAttendee`) VALUES
(13, 6, NULL, 27, 6),
(14, 6, 9, NULL, 1),
(15, 5, NULL, 45, 15);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locationID` mediumint(8) UNSIGNED NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mon_thurs_open` time NOT NULL,
  `mon_thurs_close` time NOT NULL,
  `fri_sat_open` time NOT NULL,
  `fri_sat_close` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationID`, `phone`, `address`, `email`, `mon_thurs_open`, `mon_thurs_close`, `fri_sat_open`, `fri_sat_close`) VALUES
(1, '+1(503)555-7965', '22 Flowerly Ln, Salem, OR 97302', 'contact@sintori.com', '06:00:00', '22:00:00', '08:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `memberID` mediumint(8) UNSIGNED NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` enum('M','F') NOT NULL,
  `DoB` date NOT NULL,
  `membershipID` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `fname`, `lname`, `phone`, `email`, `address`, `gender`, `DoB`, `membershipID`) VALUES
(5, 'Henry', 'Mann', '45266325', 'hmann@example.com', '45 kilmurry', 'M', '1997-05-12', 27),
(6, 'Paige', 'Kennedy', '5065253256', 'paigebullock@some.com', '45 Rentenbury', 'F', '2000-05-07', 33),
(7, 'Sunshine', 'Williams', '503282585225', 'sunnywill@iam.com', '758 Justice ave', 'F', '1997-12-08', 34),
(8, 'Joey', 'Williams', '526225825625', 'joewill@iam.com', '758 Justice Ave', 'M', '1995-02-08', 34),
(9, 'Carrie', 'Jones', '5826825558', 'carrie@yeah.com', '89 Street View Ave, NC', 'F', '1990-05-08', 35),
(10, 'Matt', 'Jones', '58265826585', 'matt@yeah.com', '89 Street View Ave, NC', 'M', '1990-05-08', 35),
(11, 'Bonny', 'Jones', '', '', '89 Street View Ave, NC', 'F', '2011-05-02', 35),
(12, 'James', 'Atticus', '8025146356', 'atti_james@example.com', '28 Silverbird Rd, KY', 'M', '1981-08-05', 43),
(13, 'Jennette', 'Mann', '5213639657', 'jenn@example.com', '45 Kilmurry', 'F', '1994-05-09', 27),
(14, 'Ella', 'Mann', NULL, NULL, NULL, 'F', '2013-06-18', 27),
(15, 'Chelsea', 'Lott', '584 851 5414', 'cLott@example.com', '5645 Mesa St, Salem, OR', 'F', '1991-06-08', 45);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `membershipID` mediumint(8) UNSIGNED NOT NULL,
  `infoID` mediumint(8) UNSIGNED DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membershipID`, `infoID`, `status`) VALUES
(27, 2, 'ACTIVE'),
(33, 1, 'ACTIVE'),
(34, 3, 'ACTIVE'),
(35, 2, 'ACTIVE'),
(43, 1, 'ACTIVE'),
(45, 1, 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `membershipinfo`
--

CREATE TABLE `membershipinfo` (
  `infoID` mediumint(8) UNSIGNED NOT NULL,
  `membershipType` varchar(20) NOT NULL,
  `maxMembers` int(11) NOT NULL DEFAULT '1',
  `membershipFee` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membershipinfo`
--

INSERT INTO `membershipinfo` (`infoID`, `membershipType`, `maxMembers`, `membershipFee`) VALUES
(1, 'Single', 1, 450),
(2, 'Family', 4, 1000),
(3, 'Couple', 2, 800);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsID` mediumint(8) UNSIGNED NOT NULL,
  `newsDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(30) NOT NULL,
  `description` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsID`, `newsDate`, `title`, `description`) VALUES
(4, '2018-05-03 11:19:27', 'Happy Birthday Sintori!', '<p>Sintori is having its 1st birthday in a week! Opened on May 8th, 2017, we will be celebrating by having a raffle that night where you can earn all kinds of prizes make sure to sign up on the <a href=\"user_event_memberRegister.php?id=6\">events</a> page. Our gym was founded with the intention of giving people a place to try out their interests which might be less common or too expensive. Our brilliant staff has worked hard this year to make sure this is a friendly environment to everyone. We look forward to the continued patronage of our members in the coming years and hope to expand the gym as time goes on.</p>'),
(5, '2018-04-13 11:20:08', 'Example Post', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque varius est vel lacus convallis, eget accumsan elit sollicitudin. Etiam sollicitudin vestibulum tortor eget mollis. Pellentesque sollicitudin sodales tellus. Quisque fringilla velit tellus, nec tristique massa viverra non. Maecenas ac lacus porta, feugiat urna dictum, tristique libero. Donec ac dolor varius dolor luctus feugiat. Sed pulvinar eros at neque aliquet cursus.</p><p>Donec convallis varius posuere. Sed hendrerit augue at nisl consequat, id aliquam mi sollicitudin. Mauris eget rutrum turpis. Praesent quis sem pellentesque, dapibus ante ac, sodales augue. Duis lobortis semper tellus, eu pharetra libero consequat sit amet. Vivamus dui ipsum, accumsan quis rhoncus in, convallis egestas risus. Fusce rutrum nisl massa, nec tincidunt justo fringilla a. Proin at neque feugiat, eleifend nisi vitae, varius neque. Fusce vitae cursus nisl. Etiam tincidunt aliquam dui non maximus. Donec eget cursus leo, eu porta tortor. Ut elementum, ligula at fringilla volutpat, turpis orci dapibus est, luctus suscipit urna augue id risus. Aenean sapien augue, convallis et posuere vitae, imperdiet sit amet libero. Praesent neque odio, placerat et massa at, aliquet sollicitudin justo. Curabitur dapibus mollis libero, et posuere sem. Curabitur id aliquet dui.</p><p>In id turpis sit amet erat convallis laoreet. Nunc sodales sapien orci, sit amet auctor lacus efficitur in. Morbi non ex tempor, euismod ante ac, accumsan ante. Curabitur eget turpis fringilla, luctus erat sagittis, imperdiet nibh. Maecenas gravida vitae est sit amet finibus. Pellentesque sed nunc tempor, placerat dui quis, molestie mi. Aliquam dictum eleifend lacus, id mollis metus ultricies non. Proin pellentesque tortor quis ipsum dapibus, id viverra mauris lacinia. Mauris vel pretium elit. Donec bibendum dui eleifend quam facilisis rutrum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>'),
(6, '2018-03-24 11:20:55', 'Example Post', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rutrum justo sit amet velit suscipit, ut faucibus nunc imperdiet. Suspendisse faucibus bibendum sollicitudin. Duis nec ullamcorper quam, ut accumsan nisi. Duis eros purus, convallis vel mollis eu, aliquam vitae nunc. Aliquam erat volutpat. Praesent nec purus sit amet lectus rhoncus cursus. Nullam sed facilisis nisi.</p><p>Etiam massa nisi, vulputate ac vehicula eu, suscipit vel lorem. In eget tortor et turpis faucibus dictum. Cras facilisis dui eget maximus feugiat. Maecenas sed magna volutpat, finibus mauris at, accumsan justo. Nullam ultricies sem eu leo mattis, eu gravida diam eleifend. Vestibulum placerat arcu id orci aliquet, in elementum nisl pretium. Curabitur faucibus et mi pulvinar congue.</p><p>Proin imperdiet nec lacus eget tincidunt. Nam massa turpis, vestibulum non auctor nec, imperdiet vel nibh. Aenean auctor erat a turpis tempus, id malesuada velit blandit. Nullam efficitur imperdiet sapien quis tincidunt. Praesent ut nisi et leo cursus interdum id posuere ante. Phasellus ullamcorper diam condimentum nisi convallis ultrices. Maecenas nec est volutpat, aliquet ipsum vel, auctor urna. Donec venenatis elementum tincidunt. Vivamus iaculis blandit lacus imperdiet tempus. Nulla facilisi.</p><p>Sed varius neque neque, eu porta ante auctor non. Quisque vitae nisl a lorem finibus posuere. Ut purus leo, gravida nec fringilla eu, posuere a magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin nec feugiat tortor, a scelerisque metus. Proin efficitur mauris quis sodales dignissim. Pellentesque a tincidunt ligula, a iaculis tellus. Nam ut cursus magna, pharetra vestibulum mi. Sed ac faucibus mauris, at viverra lorem. Donec eu pellentesque erat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id rhoncus dui. Suspendisse fringilla posuere tortor a gravida. Proin sodales eu urna vitae vehicula. Aenean at velit diam. Vestibulum placerat auctor cursus.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `nonmember`
--

CREATE TABLE `nonmember` (
  `nonmemberID` mediumint(8) UNSIGNED NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nonmember`
--

INSERT INTO `nonmember` (`nonmemberID`, `fname`, `lname`, `email`, `phone`) VALUES
(1, 'Ethan', 'Bullock', 'ebullock@some.com', '53262555426'),
(2, 'Paige', 'Knell', 'mello@example.com', '526352556625'),
(3, 'paige', 'nottingham', 'some@ys.com', '525635933215'),
(8, 'Jeremy', 'Fischer', 'jermFish@example.com', '586 414 7451'),
(9, 'George', 'Kinsey', 'kinster@example.com', '521 8224552');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` mediumint(8) UNSIGNED NOT NULL,
  `datePaid` date NOT NULL,
  `amount` decimal(6,2) NOT NULL,
  `membershipID` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `datePaid`, `amount`, `membershipID`) VALUES
(29, '2018-05-03', '450.00', 43),
(30, '2018-01-05', '500.00', 27),
(31, '2018-05-03', '500.00', 27),
(32, '2018-02-15', '450.00', 33),
(33, '2018-02-06', '400.00', 34),
(34, '2018-04-27', '400.00', 34),
(35, '2018-03-08', '1000.00', 35),
(37, '2018-01-03', '450.00', 45);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` mediumint(8) UNSIGNED NOT NULL,
  `position` enum('manager','other') NOT NULL,
  `staffPass` varchar(40) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `DoB` date NOT NULL,
  `hireDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `position`, `staffPass`, `fname`, `lname`, `email`, `address`, `phone`, `gender`, `DoB`, `hireDate`) VALUES
(1, 'manager', 'f09fee0f53947c6cb9c34ff05315c20d2bd4e443', 'Cassidy', 'Bullock', 'cassidybullock@msn.com', '4031 Camellia Dr S Salem OR', '5035881325', 'F', '1997-04-08', '2018-03-30'),
(3, 'other', '1af17e73721dbe0c40011b82ed4bb1a7dbe3ce29', 'Declan', 'Ryan', 'daplr@yahoo.com', 'Cois Locha, Derrycastle, Ballina Tipperary', '858524863', 'M', '1993-04-23', '2018-03-31'),
(5, 'other', 'f09fee0f53947c6cb9c34ff05315c20d2bd4e443', 'Jill', 'MacMarion', 'example@yes.org', '89 Street View Ave, NC', '56223322', 'F', '1987-08-09', '2018-04-14'),
(28, 'manager', 'c3499c2729730a7f807efb8676a92dcb6f8a3f8f', 'Staff', 'Example', 'staff@example.com', '25 Georgie Ln, NH', '5262656365', 'M', '1985-08-05', '2018-02-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`contentID`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`enquiryID`),
  ADD KEY `nonmemberID` (`nonmemberID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `eventbooking`
--
ALTER TABLE `eventbooking`
  ADD PRIMARY KEY (`eventBookingID`),
  ADD KEY `eventbooking_ibfk_1` (`eventID`),
  ADD KEY `eventbooking_ibfk_2` (`nonmemberID`),
  ADD KEY `eventbooking_ibfk_3` (`membershipID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`),
  ADD KEY `member_ibfk_1` (`membershipID`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`membershipID`),
  ADD KEY `infoID` (`infoID`);

--
-- Indexes for table `membershipinfo`
--
ALTER TABLE `membershipinfo`
  ADD PRIMARY KEY (`infoID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`);

--
-- Indexes for table `nonmember`
--
ALTER TABLE `nonmember`
  ADD PRIMARY KEY (`nonmemberID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `payment_ibfk_1` (`membershipID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `contentID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `enquiryID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `eventbooking`
--
ALTER TABLE `eventbooking`
  MODIFY `eventBookingID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `membershipID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `membershipinfo`
--
ALTER TABLE `membershipinfo`
  MODIFY `infoID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nonmember`
--
ALTER TABLE `nonmember`
  MODIFY `nonmemberID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD CONSTRAINT `enquiry_ibfk_1` FOREIGN KEY (`nonmemberID`) REFERENCES `nonmember` (`nonmemberID`);

--
-- Constraints for table `eventbooking`
--
ALTER TABLE `eventbooking`
  ADD CONSTRAINT `eventbooking_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventbooking_ibfk_2` FOREIGN KEY (`nonmemberID`) REFERENCES `nonmember` (`nonmemberID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `eventbooking_ibfk_3` FOREIGN KEY (`membershipID`) REFERENCES `membership` (`membershipID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`membershipID`) REFERENCES `membership` (`membershipID`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`membershipID`) REFERENCES `membership` (`membershipID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
