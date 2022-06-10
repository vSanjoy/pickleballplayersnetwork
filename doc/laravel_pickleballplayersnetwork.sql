-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 02:12 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_pickleballplayersnetwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `up_availabilities`
--

CREATE TABLE `up_availabilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_availabilities`
--

INSERT INTO `up_availabilities` (`id`, `title`, `short_code`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Weekends', 'WE', 0, '1', '2022-05-18 07:44:01', '2022-06-07 05:59:25', NULL),
(2, 'Weekday Mornings', 'WM', 1, '1', '2022-05-18 07:44:27', '2022-06-07 05:58:44', NULL),
(3, 'Weekday Afternoons', 'WA', 2, '1', '2022-05-18 07:44:55', '2022-06-07 05:59:11', NULL),
(4, 'Weekday Evenings', 'WEV', 3, '1', '2022-05-18 07:45:19', '2022-06-07 05:59:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_banners`
--

CREATE TABLE `up_banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_title_mobile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt_mobile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_banners`
--

INSERT INTO `up_banners` (`id`, `title`, `short_title`, `short_description`, `image`, `image_title`, `image_alt`, `image_mobile`, `image_title_mobile`, `image_alt_mobile`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Banner 1', 'PICKLEBALL PLAYERS NETWORK', 'PICKLEBALL LEAGUES & PLAYING PARTNERS', 'banner_1652856250.jpg', 'Banner 1', 'Banner 1', 'banner_mobile_1652856250.jpg', 'Banner 1', 'Banner 1', 0, '1', '2022-05-17 18:14:10', '2022-05-17 18:14:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_cms`
--

CREATE TABLE `up_cms` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT 'Id from cities table',
  `is_home_page` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'N=>No, Y=>Yes',
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_short_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_cms`
--

INSERT INTO `up_cms` (`id`, `parent_id`, `is_home_page`, `page_name`, `title`, `slug`, `short_title`, `short_description`, `description`, `description2`, `other_description`, `banner_title`, `banner_short_title`, `banner_short_description`, `banner_image`, `banner_image_title`, `banner_image_alt`, `featured_image`, `featured_image_title`, `featured_image_alt`, `other_image`, `other_image_title`, `other_image_alt`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'N', 'Home', 'Home', 'home', 'About Pickleball Players Network', 'Pickleball Players Network Programs', '<p>Pickleball Players Network is an online platform that connects a community of both competitive and recreational pickleball players across the United States. Pickleball Players Network offers flexible leagues and partner programs to pickleball players of all skill levels. Our goal is to promote the sport by providing easy access between players in order to unite pickleball communities throughout the country.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'featured_image_1646523119.jpg', NULL, NULL, NULL, NULL, NULL, 'Pickleball Players Network | Pickleball Leagues & Playing Partners', NULL, 'Pickleball Players Network (PPN) is an online platform for flexible pickleball leagues and playing partners.', '1', '2021-12-27 08:25:59', '2022-03-11 13:46:36', NULL),
(2, NULL, 'N', 'User Registration', 'User Registration', 'user-registration', NULL, NULL, '<p>Create a Pickleball Players Network account to gain access to join leagues.</p>', '<p><strong>PLEASE READ AND TAKE NOTICE OF THE FOLLOWING:</strong></p>\r\n\r\n<p>As part of Your consideration for becoming a member of the Pickleball Players Network (&ldquo;PPN&rdquo;) and/or participating in PPN&rsquo;s organized pickleball leagues, competitions, social play, tournaments, and related activities and events (the pickleball leagues, competitions, social play, tournaments, and related activities and events collectively the &ldquo;Program&rdquo;), You, Your heirs, next of kin, assigns, successors in interest, and/or your estate (individually and collectively &ldquo;You,&rdquo; &ldquo;Your,&rdquo; and/or &ldquo;You&rsquo;re&rdquo;) agree to waive any and all rights to any and all claims, causes of action, and/or damages for injuries and/or harms to Your person or property, or any other claims of any nature You may have against PPN, its officers, directors, employees, representatives, successors in interest, agents, subsidiaries, affiliates, licensees, assigns, members and/or shareholders (individually and collectively hereinafter &ldquo;PPN&rsquo;s Indemnitees&rdquo;) and to hold harmless PPN and PPN&rsquo;s Indemnitees for the same.</p>\r\n\r\n<p>Further, You acknowledge, understand, and agree as follows:</p>\r\n\r\n<ol>\r\n	<li>Pickleball is a sport of players hitting hard plastic balls at each other, with paddles (metal, wood, and hard plastic), on either side of portable or permanent nets, played on concrete surfaces, and, as such, by playing and/or participating in the sport of Pickleball, You recognize there are inherent risks involved with the sport, including, but not limited to, minor, serious, temporary, and/or permanent injuries, partial or total disability, paralysis, and/or death to Your person and/or damage to Your property.</li>\r\n	<li>You have joined and become a member of PPN voluntarily and by Your own free-will, not under any duress, and/or Your participation in the Program has also been done voluntarily and by Your own free-will, not under any duress; as such, You are assuming the risks associated with playing and/or participating in Pickleball, as stated above (which is a non-comprehensive list), voluntarily and by Your own free-will, not under any duress.</li>\r\n	<li>As a member of PPN and a participant in the Program, I agree to take appropriate precautions for my own safety and that of others when participating in the Program and further agree that, before participating I will inspect the facilities and equipment to be used.</li>\r\n	<li>You agree to indemnify, defend and hold harmless PPN and the PPN Indemnitees harmless from and against any third-party claims, charges, damages, costs, expenses (including reasonable outside attorneys&#39; and accountant&#39;s fees and disbursements), judgments, settlements, penalties, liabilities or losses resulting from Your actions as a member of PPN and/or Your participation in the Program.</li>\r\n</ol>\r\n\r\n<p>I have read the above agreement of release and waiver of liability and fully understand its contents. Prior to the acknowledgement of this release and waiver, I accept that I have had an adequate opportunity to discuss its contents with an attorney of my own choosing. By the consenting of this release and waiver, I acknowledge that I am agreeing to give up substantial legal rights. I agree to this release and waiver of liability freely and voluntarily and without any coercion or duress.</p>\r\n\r\n<p>By applying my electronic signature to this agreement, I agree that my electronic signature is the legally binding equivalent of my handwritten signature on paper. I will not, at any future time, claim that my electronic signature is not legally binding or enforceable.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pickleball Players Network', 'Pickleball Players Network', 'Create a Pickleball Players Network account to gain access to join leagues.', '1', '2022-01-04 08:39:07', '2022-06-06 18:15:58', NULL),
(3, NULL, 'N', 'Login', 'Login', 'login', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pickleball Players Network', 'Pickleball Players Network', 'Pickleball Players Network', '1', '2022-01-05 09:05:38', '2022-02-16 07:38:09', '2022-02-16 05:37:54'),
(4, NULL, 'Y', 'Find A League', 'Find A League', 'find-a-league', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pickleball Players Network', 'Pickleball Players Network', 'Online platform for flexible pickleball leagues and playing partners', '1', '2022-01-18 05:25:06', '2022-05-18 17:17:49', NULL),
(5, NULL, 'N', 'About Us', 'ABOUT US', 'about-us', NULL, NULL, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'featured_image_1642511274.jpg', 'About Featured Image', 'About Featured Image Alt', NULL, NULL, NULL, 'Pickleball Players Network', 'Pickleball Players Network', 'Pickleball Players Network', '1', '2022-01-18 09:07:54', '2022-02-16 07:38:16', '2022-02-09 10:14:34'),
(6, NULL, 'N', 'Leagues', 'Pickleball Leagues', 'leagues', NULL, 'Our pickleball leagues offer a competitive yet flexible format with multiple seasons throughout the year. Players are grouped based on region, age, and skill level to compete in singles, doubles, or both - in pursuit of a league championship.', '<h2>How Our Flexible Pickleball Leagues Work</h2>\r\n\r\n<ul>\r\n	<li>Players will sign up for leagues (singles, doubles and/or mixed doubles) and be grouped based on location, age, and skill level</li>\r\n	<li>Once the season begins, players will coordinate with other players in their league to schedule and play matches in adherence to league rules</li>\r\n	<li style=\"margin-bottom:11px\">Each season runs approximately 2 months with playoffs and a championship</li>\r\n</ul>\r\n\r\n<h3>Signing Up For A League</h3>\r\n\r\n<ul>\r\n	<li>Registered Pickleball Players Network players can sign up for a league 60 days prior to the season starting and no later than one week after opening day</li>\r\n	<li>Players can choose one or multiple leagues to participate in, including singles, doubles, mixed doubles, 18+ and 50+</li>\r\n</ul>\r\n\r\n<h3>Opening Day</h3>\r\n\r\n<ul>\r\n	<li>When each season begins, players will be sent an opening day email which will contain all of the necessary information about their league(s), including a link to your league page as well as player contact information</li>\r\n</ul>\r\n\r\n<h3>Competing In Your Pickleball League</h3>\r\n\r\n<p><strong>How To Play</strong></p>\r\n\r\n<ul>\r\n	<li>After the opening day email has been sent, players are responsible for communicating with the other players in your league(s) to schedule league matches</li>\r\n	<li>Meet and play at local pickleball courts, community centers, private courts and clubs. The league highly recommends that players agree upon a court location that is convenient for both parties</li>\r\n	<li>We provide a comprehensive user-generated list of pickleball courts in each area, relying upon the pickleball players in the network to keep the list up to date</li>\r\n	<li>Players will agree upon and play based on two playing formats</li>\r\n	<li>Once the match is over, players will submit scores on their league page, which displays the current standing</li>\r\n</ul>\r\n\r\n<h3>Playoffs</h3>\r\n\r\n<ul>\r\n	<li>After each season, a single elimination playoff will occur for those that qualify. The league will determine the qualifying parameters prior to the season (i.e. win a minimum of five matches during the season)</li>\r\n	<li>A champion will be crowned at the end of the league playoffs with an opportunity to win a prize</li>\r\n</ul>', NULL, NULL, 'Pickleball Leagues', NULL, NULL, 'banner_1642660202.jpg', NULL, NULL, 'featured_image_1646523494.jpg', NULL, NULL, NULL, NULL, NULL, 'Pickleball Leagues | Pickleball Players Network', NULL, 'Our pickleball leagues offer a competitive yet flexible format. Leagues for all skill levels - single and doubles.', '1', '2022-01-20 02:16:58', '2022-03-11 13:57:17', NULL),
(7, NULL, 'N', 'Partner Program', 'Pickleball Partner Program', 'partner-program', NULL, 'Our partner program offers a casual playing format by connecting players from various pickleball communities. Partners can find others based on their home court and skill level, making it easy to meet up and play whether in your hometown or on the road.', '<h2>How Our Pickleball Partner Program Works</h2>\r\n\r\n<ul>\r\n	<li>Players will sign up for the Partner Program and be grouped with other members based on your location</li>\r\n	<li>Players can coordinate a time and a place to meet, whether it&rsquo;s to play a friendly match or to meet new people in your respective region</li>\r\n	<li style=\"margin-bottom:11px\">The Partner Program is less structured and less competitive than the Leagues, allowing all players from beginners to advanced to find others at a similar level who want to get out on the court</li>\r\n</ul>\r\n\r\n<h2>Who The Partner Program Is For</h2>\r\n\r\n<p><strong>The Pickleball Partner Program is for any player who wants to:</strong></p>\r\n\r\n<ul>\r\n	<li>Meet new playing partners</li>\r\n	<li>Participate in a less competitive playing format</li>\r\n	<li>Meet for casual play with others at a specific location</li>\r\n	<li>Meet for casual play with other who are of a simlar or specific skill level</li>\r\n</ul>', NULL, NULL, 'Pickleball Partner Program', 'Join The Pickleball Partner Program', NULL, 'banner_1643106436.jpg', NULL, NULL, 'featured_image_1646726905.png', NULL, NULL, NULL, NULL, NULL, 'Pickleball Partner Program | Pickleball Players Network', NULL, 'Our partner program offers a casual playing format. Meet new playing partners at home on the road.', '1', '2022-01-25 05:13:17', '2022-03-11 14:00:35', NULL),
(8, NULL, 'N', 'Contact Us', 'Contact Us', 'contact-us', 'Send us a Message', NULL, NULL, NULL, NULL, 'Contact Us', NULL, NULL, 'banner_1643110021.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Contact Us | Pickleball Players Network', NULL, 'Please use the form on this page to contact us with any questions, comments or suggestions.', '1', '2022-01-25 07:27:01', '2022-03-11 14:12:23', NULL),
(9, NULL, 'N', 'Privacy Policy', 'Privacy Policy', 'privacy-policy', NULL, NULL, '<h3>Welcome</h3>\r\n\r\n<p>Welcome to <a href=\"https://www.pickleballplayersnetwork.com\" style=\"color:#0563c1; text-decoration:underline\" target=\"_blank\">https://pickleballplayersnetwork.com</a>. This site (the &ldquo;Site&rdquo;) is owned by Pickleball Players Network LLC (&ldquo;PPN&rdquo;) and is operated by and on behalf of the PPN. This Privacy Policy is created to tell you about our practices regarding collection, disclosure and use of information that we may collect from and about you. Please be sure to read this Privacy Policy in its entirety before using or submitting information to this Site.</p>\r\n\r\n<h3>Consent</h3>\r\n\r\n<p>By using this Site, you agree with the terms of this Privacy Policy. Whenever you visit this Site, you consent to the collection, disclosure and use of that information in accordance with this Privacy Policy, the Terms of Use and any specific provisions of this Site that may be presented at the time that information is collected.</p>\r\n\r\n<h3>Children</h3>\r\n\r\n<p>The Site is a general audience site. We do not knowingly collect any personal information from children under the age of eighteen on the Site. If in the future, we collect personally identifiable information from children, we will do so in compliance with the Children&rsquo;s Online Privacy Protection Act of 1998 (15 U.S.C. 6501 et seq.). With that being said, PPN only permits players who are eighteen or older to participate in the league.</p>\r\n\r\n<h3>Active Information Collection</h3>\r\n\r\n<p>Similar to many websites, this Site actively collects from its visitors both by asking them specific questions and by permitting them to communicate directly with us via email, feedback forms, social media and so forth. Some of the information that you submit may be personally identifiable information (information that can be uniquely identified with you such as your full name, address, email address, phone number and so forth).</p>\r\n\r\n<p>In some areas of this Site, you may need to submit information in order to take advantage of certain features or participate in certain activities. Each information gathering point informs you what information you need and which information is optional.</p>\r\n\r\n<h3>Passive Information Collection</h3>\r\n\r\n<p>As you navigate this Site and/or receive emails in relation to this Site, certain information may be passively collected (gathered without you actively providing that information) using a variety of technologies, without limitation, those outlined below:</p>\r\n\r\n<h3>Cookies</h3>\r\n\r\n<p>Similar to many Websites, the Site utilizes technology called &ldquo;cookies,&rdquo; which are small data files that are transferred to your computer when you authorize your browser to accept cookies. Cookies automatically identify your Web browser to the Site whenever you visit the Site, allowing the Site easier access for you by saving your passwords, purchases, and preferences. By tracking how and when you use the Site, cookies assist us to determine which areas are popular and which are not. Most improvements and updates to the Site are based on data accumulated from cookies. Accepting cookies also allows for you to personalize your experience on the Site. Cookies may also allow the Site to present to you advertising which may be of interest to you. If you choose not to have information collect through the use of cookies, you can opt out of providing this information by turning off the cookies in your Web browser. However, some areas of the Site may not provide you with a personalized experience if you choose to disable the use of cookies.</p>\r\n\r\n<h3>Registration Data</h3>\r\n\r\n<p>In order to utilize some of the services offered by PPN, you may be required to register and/or provide personal information, such as name, phone number, email and age (&ldquo;Registration Data&rdquo;). Although information may be required to participate in particular activities, participants provide that information voluntarily. The PPN abides by strict data management protocols.</p>\r\n\r\n<p>By registering for PPN activities, you agree to: provide accurate, true and complete information about yourself as prompted by the registration form; and regularly update the Registration Data to keep it true, accurate and complete. You acknowledge and agree that the PPN shall have no liability associated with or arising from your failure to maintain accurate Registration Data, including, but not limited to, your failure to receive critical information about the site or any mobile service or your account. Your registration establishes permission for the PPN and Permitted Third Parties to contact you for promotional and/or marketing purposes. Your relationship with each Permitted Third Party is entirely independent of the PPN and subject to that Permitted Third Party&rsquo;s terms of use and/or privacy policy. By registering, you acknowledge and agree that PPN does not and cannot control the actions of any Permitted Third Party, and you agree to release and hold harmless PPN from any and all liability, injury, loss, or damage of any kind that may arise from or out of your interaction with such Permitted Third Party.</p>\r\n\r\n<h3>Use and Disclosure of Information</h3>\r\n\r\n<p>Except as otherwise stated, PPN may use information that you provide to improve the content of our Site, to directly communicate information to you, to customize the display of the Site to your preferences, for our marketing and research purposes, and for the purposes specified in this Privacy Policy.</p>\r\n\r\n<p>We may disclose your personally identifiable information as well as passively collected information to third parties located in the United States and/or any other country:</p>\r\n\r\n<ol class=\"number-list\">\r\n	<li>to our affiliates;</li>\r\n	<li>to our sponsors;</li>\r\n	<li>to other pickleball related organizations;</li>\r\n	<li>to select companies or organizations which we believe may offer services, products, materials or information of interest to visitors to this Site;</li>\r\n	<li>to third parties we use to support our business (including fulfillment services, technical support, delivery services, chat service providers, email service providers, forum service providers, advertisement sales and management services and financial institutions);</li>\r\n	<li>in connection with the sale, assignment or other transfer of the business of this Site to which the information relates; or</li>\r\n	<li>where required by applicable laws, court orders or government regulations.</li>\r\n</ol>\r\n\r\n<p>In addition, we will make full use of all information acquired through this Site that is not in personally identifiable form.</p>\r\n\r\n<h3>Third-Party Advertisement Serving</h3>\r\n\r\n<p>This Site may use third party network advertisers to serve the advertisements that you see. Network advertisers are third parties that display advertisements based on your visits to this Site and other Web sites you have visited. Third-party ad serving enables us to target advertisements to you for products or Web sites you might be interested in. In addition, we may share this information with our sponsors to allow our sponsors and their network advertisers to serve ads based on your interests to you.</p>\r\n\r\n<p>Please note that if you choose to opt out, you will still see ads, but these ads will not be customized based on your interests generated from your visits over time and across different Web sites. In addition, the preferences you select on the <a href=\"http://www.aboutads.info/choices\" style=\"color:#0563c1; text-decoration:underline\" target=\"_blank\">http://www.aboutads.info/choices</a> page may not apply to mobile devices. Due to the differences between using apps and websites on mobile devices, opt-outs will need to be set for both browsers and apps.</p>\r\n\r\n<h3>Accessing, Correcting, Deleting and Opting Out of Certain Disclosures of Your Information</h3>\r\n\r\n<p>PPN understands that you may want to better understand the information PPN has received about you, to correct your information with PPN, and to limit how PPN may retain and use your personal information.</p>\r\n\r\n<p>If you would like to learn more about:</p>\r\n\r\n<ul>\r\n	<li>the categories or specific items of personal information PPN has collected about you;</li>\r\n	<li>the categories of personal information shared with our sponsors and other companies or organizations which we believe may offer products, services, materials or information of interest to you; and/or</li>\r\n	<li>the categories of third parties to whom the personal information was sold.</li>\r\n</ul>\r\n\r\n<p>You may make such a request by emailing <a href=\"mailto:info@pickleballplayersnetwork.com\" style=\"color:#0563c1; text-decoration:underline\">info@pickleballplayersnetwork.com</a>. You may also contact PPN at <a href=\"mailto:info@pickleballplayersnetwork.com\" style=\"color:#0563c1; text-decoration:underline\">info@pickleballplayersnetwork.com</a> to correct or delete any information that PPN possesses about you or to request that PPN not share your information with the third parties described above. Please note that there are some limitations on these rights.&nbsp;PPN is able to provide your information only with respect to your interactions with PPN Membership programs.</p>\r\n\r\n<p>For your security, if your request comes from an email account other than the one PPN has on file for you, PPN may require you to verify your identity through your registered email address or by other means. You may also review and correct your account information, email subscriptions and other preferences by logging into your PPN account using your user ID and password.</p>\r\n\r\n<p>There may be some circumstances where PPN may not be able to honor a request to correct or delete your personal information. For example, without limitation, we cannot agree to delete your match data, as it will affect the records of other players, or when it is necessary to protect PPN&rsquo;s legal rights.</p>\r\n\r\n<p>If you would like to opt-out of PPN sharing your information with sponsors and other companies or organizations which we believe may offer products, services, materials or information of interest to you, you may request that we do so by emailing <a href=\"mailto:info@pickleballplayersnetwork.com\" style=\"color:#0563c1; text-decoration:underline\">info@pickleballplayersnetwork.com</a> to make such a request.</p>\r\n\r\n<h3>Security</h3>\r\n\r\n<p>We will take reasonable steps to protect your personally identifiable information as you transmit your information to our Site and to protect such information from misuse, loss and unauthorized access, disclosure, alteration or destruction in accordance with this Privacy Policy and the Terms of Use. You should be aware that no Internet transmission is ever entirely secure. For example, email sent to or from this Site may not be secure, and you should therefore take special consideration in deciding what information you send to us via e-mail. Additionally, where you use passwords, usernames, ID numbers or other special access features on this Site, it is your responsibility to safeguard them.</p>\r\n\r\n<h3>Links to Other Web Sites</h3>\r\n\r\n<p>You should be aware that when you are on the Site you could be directed to other sites beyond our jurisdiction. For example, if you &quot;click&quot; on a banner advertisement, the &quot;click&quot; may take you off the Site onto a different Web site. This includes links from sponsors, advertisers and partners that may use the Site&rsquo;s logo as part of a co-branding agreement. These other Web sites may send their own cookies to you, solicit personal information or independently collect data and may or may not have their own published privacy policies. If you visit a Website that is linked to our Site, you should consult that site&rsquo;s privacy policy before providing any personal information. Please note that PPN is not responsible for the privacy practices of third parties.</p>\r\n\r\n<h3>Other Terms</h3>\r\n\r\n<p>Your use of this Site is subject to the Terms and Conditions of Use. If you choose to use this Site, your visit and any dispute over privacy and data collection is subject to this Privacy Policy and our Terms and Conditions of Use including limitations on damages and application of the law of the State of California.</p>\r\n\r\n<h3>How to Contact Us</h3>\r\n\r\n<p>If you have any questions, comments or concerns about this Privacy Policy or the information practices of this Site, please contact us as follows:</p>\r\n\r\n<p>Pickleball Players Network<br />\r\n1401 21<sup>st</sup> Street Suite R, Sacramento, CA 95811<br />\r\n<a href=\"mailto:info@pickleballplayersnetwork.com\" style=\"color:#0563c1; text-decoration:underline\">info@pickleballplayersnetwork.com</a></p>\r\n\r\n<h3>California Privacy Rights</h3>\r\n\r\n<p>Pursuant to Section 1798.83 of the California Civil Code, our customers who are California residents have the right to request certain information regarding our disclosure of personal information to third parties for their direct marketing purposes.</p>\r\n\r\n<p>To make such a request, please contact the following with such request:</p>\r\n\r\n<p>Pickleball Players Network<br />\r\n1401 21<sup>st</sup> Street Suite R, Sacramento, CA 95811<br />\r\n<a href=\"mailto:info@pickleballplayersnetwork.com\" style=\"color:#0563c1; text-decoration:underline\">info@pickleballplayersnetwork.com</a></p>\r\n\r\n<h3>International Users</h3>\r\n\r\n<p>Users Outside the United States</p>\r\n\r\n<p>This site is directed solely towards users who reside in the United States.&nbsp; If you choose to use this website from outside the United States, you are consenting to the collection, storage, processing, and transfer of your information in and to the United States, pursuant to the laws of the United States.</p>\r\n\r\n<p>Notwithstanding the forgoing, similar to the processes described above, PPN will honor the following requests from users:</p>\r\n\r\n<ul>\r\n	<li>If the processing of personal data is based on your consent, the right to withdraw consent for future processing of that data.</li>\r\n	<li>The right to request from PPN access to and rectification of your personal data.</li>\r\n	<li>Subject to reasonable limitations, the right to request restriction of the processing of your personal data.</li>\r\n	<li>Subject to reasonable limitations, the right to request deletion of your personal data.</li>\r\n</ul>\r\n\r\n<p>You may contact PPN using any of the methods described in the &ldquo;Contact Us&rdquo; section of this Policy.</p>\r\n\r\n<h3>Changes to This Privacy Policy</h3>\r\n\r\n<p>If this Privacy Policy changes, the revised policy will be posted on this Site. Please check back periodically, and especially before you provide any personally identifiable information. This Privacy Policy was last updated on and is effective as of 01/27/2022.</p>', NULL, NULL, 'Privacy Policy', NULL, NULL, 'banner_1643113345.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Privacy Policy | Pickleball Players Network', NULL, 'Our Privacy Policy explains our practices regarding collection, disclosure and use of information that we may collect from and about you while using this Site.', '1', '2022-01-25 08:22:25', '2022-03-11 23:56:46', NULL),
(10, NULL, 'N', 'Terms Of Use', 'Terms Of Use', 'terms-of-use', NULL, NULL, '<h3>Introduction</h3>\r\n\r\n<p>Welcome to <a href=\"https://www.pickleballplayersnetwork.com\" style=\"color:#0563c1; text-decoration:underline\" target=\"_blank\">https://pickleballplayersnetwork.com</a>. This site is owned by Pickleball Players Network LLC (&ldquo;PPN&rdquo;) and is operated by and on behalf of the PPN. These terms of use are applicable to the PPN&rsquo;s digital platforms, inclusive of this website, mobile app, tablet app, and other online content offerings (collectively the &ldquo;site&rdquo;).</p>\r\n\r\n<p>We encourage you to read these terms and conditions of use very carefully prior to using the site.</p>\r\n\r\n<p>By using this site, you indicate that you agree to these Terms of Use and our Privacy Policy. Click here to review our Privacy Policy. If you do not agree to these Terms of Use, please do not use this site. We reserve the right, at our discretion, to modify, add, remove, or otherwise change portions of these Terms of Use at any given time. Please check these Terms of Use every so often for changes. Your continuous use of this site following the posting of changes to these Terms of Use means you accept those changes.</p>\r\n\r\n<h3>Ownership</h3>\r\n\r\n<p>All content included on this site, including, without limitation, text, graphics, logos, images, video or audio clips, data compilations and software, is the property of the PPN and is protected by the laws of the United States. The compilation of all content of this site is the property of the PPN and is protected by the laws of the United States. All other trademarks that are not owned by the PPN that appear on this site are the property of their respective owners, which may or may not be affiliated with to the PPN.</p>\r\n\r\n<h3>License and Site Use</h3>\r\n\r\n<p>The PPN grants you a limited license to access and make personal, non-commercial use of this site. In accordance with these Terms of Use, you are not allowed to download any material (including, without limitation, text, graphics, software or other content), except for printing single copies of pages, as necessary to access the site (for personal, non-commercial use provided that all copyright and proprietary notices are maintained), frame, link to any page within or modify all or part of the site without our written consent. You may not redistribute, sell, de-compile, reverse engineer, disassemble or otherwise reduce to a human-readable form software that you are permitted to download from the site hereunder, except as may be permitted by law. Except only as expressly provided herein, this site (or any derivative work version of it), its contents and any member or account information may not in any form or by any means now known or hereafter developed be reproduced, displayed, downloaded, uploaded, published, repurposed, posted, distributed, transmitted, resold, or otherwise exploited for any commercial purpose without our prior express written consent. All rights not expressly granted to you above, including ownership and title, are reserved for the owner and not transferred or licensed to you.</p>\r\n\r\n<h3>Registration Data</h3>\r\n\r\n<p>In order to access some of the services, applications or sweepstakes offered by the PPN, you may be required to register and/or provide personal information, such as name, email, telephone number and birthdate (&ldquo;Registration Data&rdquo;). Although this information may be required to participate in certain activities or promotions, participants voluntarily provide that information. The PPN adheres to strict data management protocols. Those protocols vary based on the category of participation with PPN.</p>\r\n\r\n<p>By registering, you agree to: i) provide true, accurate and complete information about yourself as prompted by the registration form; and (ii) maintain and promptly update the Registration Data to keep it true, accurate, current and complete. You acknowledge and agree that the PPN shall have no liability associated with or arising from your failure to maintain accurate Registration Data, including but not limited to your failure to receive critical information about the site or any mobile service or your account. You further agree the PPN is authorized to verify such Registration Data. The information we obtain through your use of this site, mobile site or any PPN app is subject to our Privacy Policy. Every subsequent PPN email communication will carry a simple opt-out or unsubscribe link at the bottom of the email. Any suspected abuse of your Registration Data should be reported to the PPN at the contact listed below for copyright infringement.</p>\r\n\r\n<p>You acknowledge and agree that PPN, in management of certain sweepstakes, promotions, or programs, may share your information with PPN affiliated businesses, sweepstakes partners or PPN sponsors (collectively, &ldquo;Permitted Third Parties&rdquo;). Your registration constitutes permission for the PPN and Permitted Third Parties to contact you for marketing and/or promotional purposes. Your relationship with each Permitted Third Party is independent of the PPN and subject to that Permitted Third Party&rsquo;s terms of use and/or privacy policy. By registering, you acknowledge and agree that PPN does not and cannot control the actions of any Permitted Third Party, and you further agree to release and hold harmless PPN from any and all liability, injury, loss or damage of any kind that may arise from or out of your interaction with such Permitted Third Party.</p>\r\n\r\n<h3>Your Account</h3>\r\n\r\n<p>If you use this site, you are responsible for maintaining the confidentiality of membership and account information, credit card information, usernames, passwords and usernames that may be required to use the site from time to time (&quot;Account Information&quot;) and for restricting access to your computer or other devices, and you agree that you are responsible for all activity that occurs under or with the use of your Account Information (including, without limitation, usernames and password). The PPN reserves the right in its sole discretion to refuse access to the site or services provided through it, terminate accounts and usage rights, edit or remove content or Submissions (as defined below) and cancel orders or requests for materials made through the site.</p>\r\n\r\n<h3>Submissions</h3>\r\n\r\n<p>Any information or materials you transmit, upload or otherwise submit to the PPN site (including, without limitation, comments, reviews, postings to chat, court information, or email messages, as the term is defined below) or any creative suggestions, ideas, notes, drawings, concepts or other information sent to the PPN via our site,&nbsp;through any PPN social media page, app or other means of transmission or delivery, shall be collectively referred to as &quot;Submissions.&quot; If you transmit or otherwise deliver Submissions to the PPN, you grant the PPN a nonexclusive, royalty-free, perpetual, irrevocable (or the longest period permitted under law) license (with the right to sublicense and assign) to use, reproduce, modify, adapt, publish, translate, publicly perform and display, transmit, make, sell, create derivative works from and distribute such Submissions or incorporate such Submissions into other works in any form or medium and through any means or modes of distribution or technology now known or hereafter developed. You hereby agree and represent to the PPN that you own or have been granted the necessary intellectual property and other rights in the Submissions (including, without limitation, a waiver of any applicable moral rights) to grant such license to the PPN, that no such Submissions are, or shall be, subject to any obligation of confidence on the part of the PPN and that the PPN shall not be liable for any use or disclosure of any Submissions. Without limitation of the foregoing, the PPN shall be entitled to unrestricted use of the Submissions for any purpose whatsoever, commercial or otherwise, without compensation to the provider of the Submissions. You agree that no Submission made by you will contain libelous, abusive, obscene or otherwise unlawful material and you acknowledge and agree that you are exclusively liable for the content of any Submission made by you.</p>\r\n\r\n<h3>Forums and Public Communication</h3>\r\n\r\n<p>&quot;Forum&quot; means a chat area, message board, social media site, app, email function or other function which allows you to transmit or submit material to the PPN site for display, storage or distribution, offered as part of any PPN site or by an affiliated company/organization and/or service provider of the PPN. Where the Forum is provided on a site other than a PPN site, you will be bound by the terms of service and privacy policy of the site you have linked to. If you participate in any Forum within a PPN site, you must not and agree that you will not through the use of any Submission or otherwise:</p>\r\n\r\n<ul>\r\n	<li>post material or make statements that do not generally pertain to the designated topic or theme of any chat room or bulletin board.</li>\r\n	<li>use the Forum for commercial purposes of any kind;</li>\r\n	<li>advertise or sell to, or solicit, others;</li>\r\n	<li>post or distribute any vulgar, obscene, discourteous or indecent language or images;</li>\r\n	<li>defame, abuse, harass or threaten others;</li>\r\n	<li>make any bigoted, hateful or racially offensive statements;</li>\r\n	<li>advocate illegal activity or discuss illegal activities with the intent to commit them;</li>\r\n	<li>post or distribute any material that infringes and/or violates any right of a third party or any law; or</li>\r\n	<li>post or distribute any software or other materials which contain a virus or other harmful component;</li>\r\n</ul>\r\n\r\n<p>In addition, you must note and agree that you will not use a false email address, impersonate any person or entity or otherwise mislead others as to the source of origin of a Submission.</p>\r\n\r\n<p>The PPN reserves the right to remove or edit content from any PPN Forum at any time and for any reason but does not regularly review posted Submissions.</p>\r\n\r\n<p>Any material transmitted, submitted or otherwise delivered to a Forum shall constitute a Submission and is hereby governed by the terms applicable to Submissions as described herein.</p>\r\n\r\n<p>When participating in a Forum, never assume that people are who they say they are, know what they say they know, or are affiliated with whom they say they are affiliated with in any chat room, message board or other user-generated content area. Information obtained in a Forum may not be reliable, and we are not responsible for the content or accuracy of any information.</p>\r\n\r\n<h3>Content Linked to the PPN Site</h3>\r\n\r\n<p>Please exercise caution while browsing the Internet using any PPN site. You should be aware that while you are on the PPN site, you could be directed to other sites that are out of our control. There are links to other sites from PPN pages that take you outside of our service. This includes links from sponsors and content partners that may use our logo(s) as part of a co-branding or other agreement. These other sites may send their own cookies to users, collect data, solicit personal information, or contain information that you may find inappropriate or offensive. The PPN reserves the right to disable links from third party sites to the PPN site. We make no representations concerning the content of sites linked to the PPN site or listed in any of our directories. Consequently, we cannot be held responsible for the accuracy, relevancy, copyright compliance, legality or decency of material contained in sites listed in our search results or otherwise linked to the PPN site. If you have any concerns regarding any external link, you should contact the link&rsquo;s administrator or Website.</p>\r\n\r\n<h3>Disclaimer</h3>\r\n\r\n<p>the materials in this PPN site are provided &quot;as is&quot; and without warranties of any kind, either express or implied. To the fullest extent permissible pursuant to applicable law, PPN disclaims all warranties, express or implied, including, but not limited to, implied warranties of merchantability and fitness for a particular purpose. The PPN does not warrant that the functions contained in the materials on the PPN site will be uninterrupted or error-free, that defects will be corrected, or that the PPN site or the servers that make such materials available are free of viruses or other harmful components. PPN does not warrant or make any representations regarding the use or the results of the use of the materials on the PPN site in terms of their correctness, accuracy, reliability or otherwise. You assume the entire cost of all necessary servicing, repair or correction. Applicable law may not allow the exclusion of implied warranties, so the above exclusion may not apply to you.</p>\r\n\r\n<p>We explicitly disclaim any responsibility for the accuracy, completeness, content or availability of information found on sites that link to or from the PPN site. We cannot ensure that you will be satisfied with any products or services that you purchase from a third-party site that links to or from the PPN site or third-party content on our site. We do not endorse any of the merchandise (if any) except as expressly provided, nor have we taken any steps to confirm the accuracy or reliability of any of the information contained in such third-party sites or content. We do not make any representations or warranties as to the security of any information (including, without limitation, credit card and other personal information) you might be requested to give any third-party, and you hereby irrevocably waive any claim against us with respect to such sites and third party content. We strongly recommend that you to make whatever investigation you feel necessary or appropriate before proceeding with any online or offline transaction with any of these third parties.</p>\r\n\r\n<h3>Credit Cards</h3>\r\n\r\n<p>We may provide your credit card number, billing and shipping information to participating merchants from whom you buy goods or services and financial institutions pursuant to transactions with the PPN. The merchants are solely responsible for how they use that information and any other information they independently acquire from you or about you. Otherwise, we do not share your credit card information with anyone else. For more information, please read our <a href=\"https://www.pickleballplayersnetwork.com/privacy-policy\" style=\"color:#0563c1; text-decoration: underline;\" target=\"_blank\">Privacy Policy</a>.</p>\r\n\r\n<p>To protect the security of your credit card information, we employ the industry-standard Secure Sockets Layer (SSL) technology. We also encrypt your credit card number when we store your order and whenever we transfer that information to participating merchants.</p>\r\n\r\n<h3>Indemnification</h3>\r\n\r\n<p>You are entirely responsible for maintaining the confidentiality and security of your Account Information and for all activities that occur under your account. You agree to indemnify, defend and hold the PPN and other affiliated companies/organizations and sponsors and their respective officers, directors, employees and agents harmless from and against any third-party claims, demands, actions, suits, proceedings, liabilities, damages, losses, judgments and expenses (including, but not limited to, the costs of collection, reasonable attorney&rsquo;s fees and other reasonable costs of defense or enforcing your obligations hereunder) resulting from or arising out of any breach of any of your representations or misuse of this or any PPN site or of any site linking to this or any other PPN site. You shall use your best efforts to cooperate with us in the defense of any claim.</p>\r\n\r\n<h3>Limitation of Liability</h3>\r\n\r\n<p>Under no circumstances, including, but not limited to, negligence, shall the PPN be liable for any direct, indirect, incidental, special or consequential damages that result from the use of, or the inability to use, the PPN site or materials or functions on any such site, even if the PPN has been advised of the possibility of such damages. applicable law may not allow the limitation or exclusion of liability or incidental or consequential damages, so the above limitation or exclusion may not apply to you. in no event shall our total liability to you for all damages, losses and causes of action whether in contract or tort (including, but not limited to, negligence, or otherwise) exceed the amount paid by you, if any, for membership in the PPN.</p>\r\n\r\n<p>In no event shall the PPN be liable for any breach in transaction security caused by a third-party arising out of or relating to any purchase or attempt to purchase merchandise.</p>\r\n\r\n<h3>Jurisdictional Issues</h3>\r\n\r\n<p>Unless otherwise specified, the materials in the PPN site are presented solely for the purpose of promoting pickleball, pickleball equipment, pickleball instruction and pickleball tournaments and other products and services available in the United States and its territories, possessions and protectorates. The PPN makes no representation that materials on the PPN site are appropriate or available for use in any particular location. Those who choose to access the PPN site do so on their own initiative and are responsible for compliance with local laws, if and to the extent local laws are applicable.</p>\r\n\r\n<h3>Termination</h3>\r\n\r\n<p>These Terms of Use are effective until terminated by either party. Your access to the PPN site may be terminated immediately without notice from us if, in our sole discretion, you fail to comply with any term of these Terms of Use. Upon such termination, you must cease use of the PPN site and destroy all materials obtained from such site and all copies thereof, whether made under the terms of these Terms of Use or otherwise. You may terminate at any time by discontinuing use of the PPN site. Upon such termination, you must destroy all materials obtained from the site and all related documentation and all copies and installations thereof, whether made under the terms of this Terms of Use or otherwise.</p>\r\n\r\n<h3>Notice and Procedure for Making Claims of Copyright Infringement</h3>\r\n\r\n<p>Pursuant to Title 17, United States Code, Section 512(c)(2), notifications of claimed copyright infringement should be sent to the Service Provider&#39;s Designated Agent.</p>\r\n\r\n<h3>Notification must be submitted to the following Designated Agent:</h3>\r\n\r\n<p>Pickleball Players Network<br />\r\nAttention: Legal Dept.<br />\r\n1401 21<sup>st</sup> Street Suite R, Sacramento, CA 95811</p>\r\n\r\n<h3>To be effective, the notification must be a written communication that includes the following:</h3>\r\n\r\n<ol class=\"number-list\">\r\n	<li>A physical or electronic signature of the person authorized to act on behalf of the owner of an exclusive right that is allegedly infringed;</li>\r\n	<li>Identification of the copyrighted work claimed to have been infringed or multiple copyrighted works at a single online site are covered by a single notification, and a representative list of such works at that site;</li>\r\n	<li>Identification of the material that is claimed to be infringing or to be the subject of infringing activity and that is to be removed or access to which is to be disabled, and information reasonably sufficient to permit the service provider to locate the material;</li>\r\n	<li>Information reasonably sufficient to permit the service provider to contact the complaining party, such as an address, a telephone number and, if available, an electronic mail address at which the complaining party may be contacted;</li>\r\n	<li>A statement that the complaining party has a good faith belief that use of the material in the manner complained of is not authorized by the copyright owner, its agent or the law;</li>\r\n	<li>A statement that the information in the notification is accurate and, under penalty of perjury, that the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</li>\r\n</ol>\r\n\r\n<h3>General Provisions</h3>\r\n\r\n<p>By visiting this site you agree that the Terms of Use shall be governed by and construed in accordance with the laws of the State of California, without giving effect to any principles of conflicts of law, and that any action at law or in equity arising out of or relating to these Terms of Use and the Privacy Policy shall be filed only in the state or federal courts located in Los Angeles County, California and you hereby consent and submit to the venue and personal jurisdiction of such courts for the purposes of such action. If any provision of these Terms of Use shall be unlawful, void or for any reason unenforceable, then that provision shall be deemed severable from these Terms of Use and shall not affect the validity and enforceability of any remaining provisions. These Terms of Use constitute the entire agreement between us relating to the subject matter herein and shall not be modified except in writing, signed by both parties.</p>\r\n\r\n<p>Last updated: February 16, 2022</p>', NULL, NULL, 'TERMS OF USE', NULL, NULL, 'banner_1643114517.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Terms of Use | Pickleball Players Network', NULL, NULL, '1', '2022-01-25 08:41:57', '2022-03-11 23:57:11', NULL);
INSERT INTO `up_cms` (`id`, `parent_id`, `is_home_page`, `page_name`, `title`, `slug`, `short_title`, `short_description`, `description`, `description2`, `other_description`, `banner_title`, `banner_short_title`, `banner_short_description`, `banner_image`, `banner_image_title`, `banner_image_alt`, `featured_image`, `featured_image_title`, `featured_image_alt`, `other_image`, `other_image_title`, `other_image_alt`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, NULL, 'N', 'Copyright Policy', 'Copyright Policy', 'copyright-policy', NULL, NULL, '<h3>What is Lorem Ipsum?</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<h3>Where does it come from</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<ul>\r\n	<li>Latin professor at Hampden-Sydney College in Virginia</li>\r\n	<li>sunt in culpa qui officia deserunt mollit anim id est laborum</li>\r\n	<li>Contrary to popular belief, Lorem Ipsum is not simply random text</li>\r\n	<li>consectetur adipiscing elit, sed do eiusmod tempor incididunt</li>\r\n</ul>\r\n\r\n<h3>Consectetur adipiscing elit, sed do eiusmod</h3>\r\n\r\n<p><strong>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</strong></p>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<p><strong>1914 translation by H. Rackham</strong></p>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<ol>\r\n	<li>Latin professor at Hampden-Sydney College in Virginia</li>\r\n	<li>sunt in culpa qui officia deserunt mollit anim id est laborum</li>\r\n	<li>Contrary to popular belief, Lorem Ipsum is not simply random text</li>\r\n	<li>consectetur adipiscing elit, sed do eiusmod tempor incididunt</li>\r\n</ol>\r\n\r\n<p>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</p>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<p>&nbsp;</p>', NULL, NULL, 'Copyright Policy', NULL, NULL, 'banner_1643114868.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pickleball Players Network', 'Pickleball Players Network', 'Online platform for flexible pickleball leagues and playing partners', '1', '2022-01-25 08:47:48', '2022-03-08 12:15:22', '2022-03-08 06:15:15'),
(12, NULL, 'N', 'Read Complete Rules', 'Read Complete Rules', 'read-complete-rules', NULL, 'League Rules', '<ol>\r\n	<li>\r\n	<p>Playing Formats (best 2 games out of 3 to 11 or one game to 15)</p>\r\n\r\n	<ol>\r\n		<li>Pickleball Players Network uses the best two out of three games to 11 points, win by two points, as the preferred format of play.</li>\r\n		<li>If time or court availability is an issue or all players consent prior to a match, one game to 15 points, win by two points, can be counted towards a league match.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Balls</p>\r\n\r\n	<ol>\r\n		<li>Each player/team is responsible for bringing two <a href=\"https://equipment.usapickleball.org/ball-list/\" style=\"text-decoration: underline;\" target=\"_blank\">USAP approved pickleballs</a> in accordance to the surface that is played on. Outdoor balls must be used for outdoor courts and indoor balls must be used for indoor courts. The first serving team will choose which ball to use. If a ball cracks, the first receiving team will choose which ball to use next.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Determining Serving Team</p>\r\n\r\n	<ol>\r\n		<li>Any fair method can be used to determine which player or team has first choice of side, service, or receive. Some examples include: coin toss, or writing a 1 or 2 on the back of a score sheet or any piece of paper.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Honor System</p>\r\n\r\n	<ol>\r\n		<li>Line calls must be made immediately (within ~ five seconds) by the side playing the ball. Otherwise, the ball will be considered in. If, during a doubles match, one partner calls the ball out and the other partner on the same team overrules the call, the ball will be considered in. Any questionable calls should be in favor of your opponent. <span style=\"text-decoration: underline;\">No points should be played over</span>. If you request the opinion of your opponent, you should accept his/her opinion. Ultimately, any rule of play in question should reference the USPA rulebook found <a href=\"https://usapickleball.org/what-is-pickleball/ifp-official-rules/\" style=\"text-decoration: underline;\" target=\"_blank\">here</a>.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Changing Court Sides</p>\r\n\r\n	<ol>\r\n		<li>In a 2 out of 3 game format, players will change court sides after each of the first two games. If a third game is played, players will switch after a player/team reaches 6 points. In a one game to 15 format, players will change court sides after a player/team reaches 8 points.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Choosing a Court Location</p>\r\n\r\n	<ol>\r\n		<li>Pickleball Players Network encourages players to choose a location to play that is convenient for all players. A simple suggestion would be to schedule a match at one&rsquo;s home court and then a rematch at the other&rsquo;s home court. Also, players can meet in the middle to play a league match.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Abiding by Rules of the Court</p>\r\n\r\n	<ol>\r\n		<li>All players must follow the rules of the courts they are playing at, even if this means pausing a match to allow other players to play on the court in order to finish the match later that day. Participating in a Pickleball Players Network match does not give you the right to break the rules of the court. If we hear that players are using the Pickleball Players Network as an excuse to break the rules of the court, all players will be immediately removed from the league.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Score Reporting</p>\r\n\r\n	<ol>\r\n		<li>All scores should be promptly reported by the winning player/team utilizing the website or app developed for the league. If a score is not reported within 24 hours of the match, then it will be nullified. If an issue arises from reporting the score, please contact your league administrator.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Rematch Rule</p>\r\n\r\n	<ol>\r\n		<li>Players are able to schedule league matches against the same opponent up to 3 times per season. While we understand that rematches may be played consecutively, we want to encourage players to compete against all of the opponents in the league.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Playoffs</p>\r\n\r\n	<ol>\r\n		<li>\r\n		<p>Qualifying for Playoffs</p>\r\n\r\n		<ol>\r\n			<li>In order to qualify for the playoffs, a player/team will need to achieve a specified number of wins during the season, which will be defined by the league at the beginning of a season. The number of wins will be defined based on the number of players/teams participating in the league. The playoffs will occur directly after the season has ended. A player/team that is in his/her/their first season will need to complete at least six matches in order to be qualified for the playoffs.</li>\r\n		</ol>\r\n		</li>\r\n		<li>\r\n		<p>Playoff Positioning</p>\r\n\r\n		<ol>\r\n			<li>Players eligible for the playoffs will be seeded based on their win-loss differential. Depending on the number of players eligible, some may receive a &ldquo;bye&rdquo; for the first round. If there is a tie in the win-loss differential, we will determine the higher seed based on the number of matches played, in season head-to-head record, and lastly the percentage of games won during league matches.</li>\r\n		</ol>\r\n		</li>\r\n		<li>\r\n		<p>Home Court for Playoff Matches</p>\r\n\r\n		<ol>\r\n			<li>The higher seeded player is entitled to home court and decides where the match will be played. However, we ask that players consider commutes and choose a court that is convenient for both parties.</li>\r\n		</ol>\r\n		</li>\r\n		<li>\r\n		<p>Enforcing Playoff Deadlines</p>\r\n\r\n		<ol>\r\n			<li>For every playoff round, there will be a one-week deadline to complete the match. With that being said, players are encouraged to complete their matches as quickly as possible. If the next round has been decided upon prior to the deadline, players can schedule and play their match before any/all deadlines.</li>\r\n			<li>If the deadline passes and neither player has reported a score, both players will be defaulted and the opponent in the next round will advance. If this occurs during a championship match, there will not be a champion crowned for the season.</li>\r\n			<li>If the deadline passes and the league admin has heard from either player, then the player who is least available will default the match.</li>\r\n			<li>If a player cancels a scheduled playoff match, then he/she forfeits the match unless the opposing player is willing to reschedule prior to the deadline.</li>\r\n			<li>If a playoff match for some unforeseen reason goes unfinished due to extenuating circumstances (light, court rules, etc.), then an earnest attempt must be made to finish the match. If both parties are unable to do so, then a winner will be determined by the number of points won.</li>\r\n		</ol>\r\n		</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Player Disqualification</p>\r\n\r\n	<ol>\r\n		<li>\r\n		<p>Pickleball Players Network reserves the right to:</p>\r\n\r\n		<ol>\r\n			<li>Place any player on probation for an indefinite period of time for violating the standards of proper conduct, abusing the cancellation policy, abusing league administrators, and not acting in accordance to fair play and/or good sportsmanship. League fees will not be reimbursed to those that are disqualified.</li>\r\n			<li>Ban any player from the league and/or network indefinitely.</li>\r\n			<li>Ban any player from the league and/or network that is found submitting a fake win for whatever reason.</li>\r\n			<li>Modify playoff results based on any player that is found to intentionally under rate their playing ability.</li>\r\n		</ol>\r\n		</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Three-Strike Policy</p>\r\n\r\n	<ol>\r\n		<li>A player may receive strikes based on poor sportsmanship or not abiding by the no-show and cancellation policy. If a player receives three strikes in a calendar year, he/she will be disqualified from the current season and subject to an indefinite ban from the network without a refund.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Canceling a Match</p>\r\n\r\n	<ol>\r\n		<li>A player is required to both make a phone call and send an email or text to cancel a pickleball match. The league is not responsible to cancel matches for players. It is imperative that you reach your opponent to let them know that you are cancelling the match. If the player does not try all forms of communication to cancel a match, the player will be given a strike. Three strikes on any player is an automatic disqualification from the league and subject to an indefinite ban from the network. Any match that is cancelled between the hours of 12:01am and 7am, does not count towards the four-hour cancellation window.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>No-Shows and Late Cancellations</p>\r\n\r\n	<ol>\r\n		<li>If a player does not show up to a match without attempting to call and send an email or text, he/she will receive a strike and the match will be recorded as a 0-0 win for the non-offending player. A player who gets a cancellation notification within one hour of the match is requested to submit a no-show. Also, the player who did not show up for the match needs to reimburse any court fees and/or parking fees before they will be allowed to continue playing.</li>\r\n		<li>If a player does not cancel a match within the four-hour time period, he/she will receive a strike and the non-offending player will receive a 0-0 win. The only exemption to the rule is if there is rain or the playing conditions are unsafe.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Court Fees upon No-Show</p>\r\n\r\n	<ol>\r\n		<li>If a player does not show up for his/her match and a court fee was paid for the court, the player who does not show up will be retired from the season until the entire court cost is reimbursed.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>League Withdrawals</p>\r\n\r\n	<ol>\r\n		<li>A player/team who decides to withdraw from the league due to an injury or for any other reason is required to inform the league administrator. The player/team will not be reimbursed for the league fee.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Match Play Defaults</p>\r\n\r\n	<ol>\r\n		<li>\r\n		<p>A player/team that is in violation of any of these rules below will result in a forfeit:</p>\r\n\r\n		<ol>\r\n			<li>Failure to appear on the court within 20 minutes of the starting time without notifying your opponent.</li>\r\n			<li>Failure to appear on the court within 30 minutes of the starting time when notifying your opponent.</li>\r\n			<li>Quitting before a match is completed due to an injury or a walk-off. The final score will be the score prior to the injury or the walk-off.</li>\r\n			<li>Equipment failing such as a broken paddle or your shoe falling apart as long as you do not have any back-up equipment.</li>\r\n		</ol>\r\n		</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Resolving on Court Conflicts</p>\r\n\r\n	<ol>\r\n		<li>All matches that report an on-court conflict to the league administrator will be addressed 24 hours after the match. If the conflict occurs on a weekend, then it will be resolved on the next non-holiday weekday.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Purity of Competition Rule (moving a player up or down in rating during a season)</p>\r\n\r\n	<p>A player/team can get promoted or demoted in several ways, some of which include:</p>\r\n\r\n	<ol>\r\n		<li>Pickleball Players Network reserves the right to move a player/team up or down a level during the season based on how the player/team performed in the previous season or during the current season.\r\n		<ol>\r\n			<li>By making the finals of their division&rsquo;s playoffs;</li>\r\n			<li>Based on how they perform during matches in the season.</li>\r\n		</ol>\r\n		</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Refund Policy</p>\r\n\r\n	<ol>\r\n		<li>Pickleball Players Network offers a 7-day money back guarantee after the league&rsquo;s start date. If you signed up for the partner program, you would be eligible for a full refund 7 days from your payment date.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Splitting of Court Fees</p>\r\n\r\n	<ol>\r\n		<li>Instances where a match is played at a court which costs a fee, the players are expected to split all fees, including a potential guest fee.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>General Rules of Pickleball (IFP Rulebook)</p>\r\n\r\n	<ol>\r\n		<li>All players/teams must follow the USA Pickleball/IFP Rulebook, which can be found <a href=\"https://usapickleball.org/what-is-pickleball/ifp-official-rules/\" style=\"text-decoration: underline;\" target=\"_blank\">here</a>. We encourage players to read and fully understand these rules prior to playing in order to resolve any on-court conflicts.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<p>Code of Conduct</p>\r\n\r\n	<ol>\r\n		<li>\r\n		<p>All players must adhere to a code of conduct while participating in the league, which include but are not exclusive to the following:</p>\r\n\r\n		<ol>\r\n			<li>Treating your opponents with respect (i.e. no trash talking, no blatant attempts to interfere with your opponent&rsquo;s play, etc.)</li>\r\n			<li>Showing up on-time to your matches</li>\r\n			<li>Abiding by all court rules</li>\r\n			<li>Being honest about line calls and foot faults</li>\r\n			<li>Reporting scores correctly</li>\r\n		</ol>\r\n		</li>\r\n	</ol>\r\n	</li>\r\n</ol>', NULL, NULL, 'Pickleball Players Network', 'League Rules', NULL, 'banner_1644924980.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PPN League Rules | Pickleball Players Network', NULL, 'PPN League Rules are a comprehensive set of rules that must be adhered to for all PPN League Matches.', '1', '2022-02-15 07:36:20', '2022-03-11 14:34:46', NULL),
(13, NULL, 'N', 'Rate Your Game', 'Rate Your Game', 'rate-your-game', NULL, NULL, '<p>Find your tennis rating using National Tennis Rating Program (NTRP) categories. The League uses the Purity of Competition rule to manage players playing level. The league is an actively managed program. We use the Purity of Competition Rule to adjust players mid-season if need be, so don&#39;t worry about being stuck in the wrong level for a whole season.</p>', '<table class=\"table rate_your_gamne\">\r\n	<thead>\r\n		<tr>\r\n			<th class=\"vertical-middle\" scope=\"col\">NTRP Rating</th>\r\n			<th class=\"vertical-middle\" scope=\"col\">Verbal Description and League Comments</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<th scope=\"row\">1.5 - 2.0</th>\r\n			<td>You could describe yourself as a beginner. You know how to serve and return points but you haven&#39;t developed any game consistency. You hopefully have learned how to keep score. You basically love the game and want to meet up with other people who have the same passion.<br />\r\n			<strong>Admin Comments</strong>: <strong>Recreational Division,</strong> About 5% of the players are in this division. You&#39;re a beginner. We&#39;d like all Beginner&#39;s to <strong>exclusively participate in the Tennis Partner Program</strong> until they gain enough experience to participate in the leagues.</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">2.5</th>\r\n			<td>Needs on-court experience. Has obvious stroke weaknesses but is familiar with basic positions for singles and doubles play. 2.5 Learning to judge where the ball is going although court coverage is weak. Can sustain a short rally of slow pace with other players of the same ability.<br />\r\n			<strong>Admin Comments</strong>: <strong>Recreational Division,</strong> About 10% of the players are in this division. You&#39;re an advanced beginner in this category. We hope the minimum ability players have is to be able to serve and maintain a couple stroke rally.</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">3.0</th>\r\n			<td>Fairly consistent when hitting medium-paced shots, but is not comfortable with all strokes and lacks execution when trying for directional control, depth or power. Most common doubles formation is one-up and one-back.<br />\r\n			<strong>Admin Comments</strong>: <strong>Skilled Division,</strong> About 25% of the players are in this division</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">3.25</th>\r\n			<td>You&#39;re in-between 3.0 and 3.5 Skill rating.<br />\r\n			<strong>Admin Comments</strong>: <strong>Competitive2 Division,</strong> This division appears when the city&#39;s league is large enough and we have enough returning players. The addition of this division allows the league to fine tune the levels and the matches tend to be closer. Playoff qualifiers play in the Competitive playoffs.</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">3.5</th>\r\n			<td>Has achieved improved stroke dependability with directional control on moderate shots, but still lacks depth and variety. Starting to exhibit more aggressive net play, has improved court coverage and is developing teamwork in doubles.<br />\r\n			<strong>Admin Comments</strong>: <strong>Competitive1 Division,</strong> About 40% of the players are in this division. The majority of non-trained adult players are at this level.</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">3.75</th>\r\n			<td>You&#39;re in-between 3.5 and 4.0 Skill rating.<br />\r\n			<strong>Admin Comments</strong>: <strong>Advanced2 Division,</strong> This division appears when the city&#39;s league is large enough and we have enough returning players. The addition of this division allows the league to fine tune the levels and the matches tend to be closer. Playoff qualifiers play in the Advanced playoffs.</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">4.0</th>\r\n			<td>Has dependable strokes, including directional control and depth on both forehand and backhand sides on moderate shots, plus the ability to use lobs, overheads, approach shots and volleys with some success. Occasionally forces errors when serving. Rallies may be lost due to impatience.<br />\r\n			<strong>Admin Comments</strong>: <strong>Advanced1 Division,</strong> About 15% of the players are in this division. Rusty players should start off in the Competitive Division first. Scores are closely monitored by the league for Purity of Competition Rules. The NTRP rating is just too easy, a 4.0 player has some strokes that very good. You are a solid player.</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">4.5</th>\r\n			<td>Mastered the use of power and spins and handles pace, has sound footwork, can control depth of shots and is beginning to vary game plan according to opponents. Can hit first serves with power and accuracy and place the second serve. Tends to over hit on difficult shots.<br />\r\n			<strong>Admin Comments</strong>: <strong>Elite Division,</strong> About <span style=\"background-color: #FFFF00\">5%</span> of the players are in this division. Most players need to earn their way into this division or have proof of 4.5 rating.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', NULL, NULL, NULL, NULL, 'banner_1645161348.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pickleball Players Network', 'Pickleball Players Network', 'Online platform for flexible pickleball leagues and playing partners', '1', '2022-02-18 01:09:56', '2022-02-23 07:31:14', NULL),
(14, NULL, 'N', 'Local Court', 'Pickleball Courts', 'local-court', NULL, NULL, NULL, '<p>It is the player&#39;s responsibility to check hours, court availability, and the conditions of these courts. Please contact the facility for this information.</p>\r\n\r\n<p>The court information is user generated - if there are discrepancies, please contact us.</p>\r\n\r\n<p>We will continue to update this page throughout the season.</p>', NULL, 'COURTS', NULL, NULL, 'banner_1645163275.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Find A Pickleball Court Near You | Pickleball Players Network', NULL, 'Find a local pickleball court near you to meet with a new playing partner or play a League Match.', '1', '2022-02-18 01:47:55', '2022-03-11 23:53:32', NULL),
(15, NULL, 'N', 'Partner', 'Partner Program', 'partner', NULL, NULL, '<h2>COMING SOON</h2>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pickleball Players Network', 'Pickleball Players Network', 'Online platform for flexible pickleball leagues and playing partners', '1', '2022-02-24 09:20:06', '2022-05-18 06:29:52', NULL),
(16, NULL, 'N', 'Rules', 'Rules', 'rules', NULL, NULL, '<h2>Coming Soon</h2>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pickleball Players Network', 'Pickleball Players Network', 'Online platform for flexible pickleball leagues and playing partners', '1', '2022-02-24 09:22:52', '2022-05-18 06:29:54', NULL),
(17, NULL, 'N', 'Pickleball Courts', 'Pickleball Courts', 'pickleball-courts', NULL, NULL, '<h2>COMING SOON</h2>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pickleball Players Network', 'Pickleball Players Network', 'Online platform for flexible pickleball leagues and playing partners', '1', '2022-02-25 02:51:04', '2022-05-18 06:29:56', NULL),
(18, NULL, 'N', 'Find A Match', 'Find A Match', 'find-a-match', NULL, NULL, '<h2>Coming Soon</h2>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pickleball Players Network', 'Pickleball Players Network', 'Online platform for flexible pickleball leagues and playing partners', '1', '2022-02-25 02:58:18', '2022-05-18 06:29:58', NULL),
(19, NULL, 'N', 'Join A League', 'Join A League', 'join-a-league', NULL, NULL, '<p>Register for the upcoming Pre-Launch season right here!</p>\r\n\r\n<p>Regular Season Start Date: March 28, 2022</p>\r\n\r\n<p>Regular Season End Date: May 22, 2022</p>\r\n\r\n<p>Playoffs Start Date: May 23, 2022</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Join A Pickleball League | Pickleball Players Network', NULL, 'Join a flexible pickleball league. Players are grouped by skill, level, age, and region. Singles/Doubles or both.', '1', '2022-03-01 14:35:01', '2022-03-19 10:34:51', NULL),
(21, NULL, 'N', 'What Is PPN', 'What Is PPN?', 'what-is-ppn', NULL, NULL, NULL, NULL, NULL, 'What Is PPN?', NULL, NULL, 'banner_1653398256.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pickleball Leagues & Playing Partners', NULL, 'Pickleball Players Network (PPN) is an online platform for flexible pickleball leagues and playing partners.', '1', '2022-05-24 00:42:44', '2022-05-24 00:47:59', NULL),
(22, NULL, 'N', 'FAQs', 'FAQs', 'faqs', NULL, NULL, NULL, NULL, NULL, 'FAQs', NULL, NULL, 'banner_1653398383.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-05-24 00:49:43', '2022-05-24 00:49:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_contacts`
--

CREATE TABLE `up_contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `up_migrations`
--

CREATE TABLE `up_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_migrations`
--

INSERT INTO `up_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_12_27_000000_create_users_table', 1),
(2, '2021_12_27_064801_create_roles_table', 1),
(3, '2021_12_27_064917_create_role_permissions_table', 1),
(4, '2021_12_27_065108_create_user_roles_table', 1),
(5, '2021_12_27_065206_create_role_pages_table', 1),
(6, '2021_12_27_071814_create_website_settings_table', 1),
(7, '2021_12_27_071920_create_cms_table', 1),
(8, '2022_01_04_073630_create_videos_table', 1),
(9, '2022_01_05_105521_create_user_details_table', 1),
(10, '2022_01_17_101041_create_banners_table', 1),
(11, '2022_01_25_120359_create_contacts_table', 1),
(12, '2022_05_17_235341_create_pickleball_courts_table', 2),
(13, '2022_05_18_004131_create_availabilities_table', 3),
(14, '2022_05_18_040911_create_user_availabilities_table', 4),
(15, '2022_05_22_232909_create_states_table', 5),
(16, '2022_05_23_022901_create_nets_table', 6),
(17, '2022_05_23_025959_create_pickleball_court_net_availabilities_table', 7),
(18, '2022_05_25_002633_create_promo_codes_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `up_nets`
--

CREATE TABLE `up_nets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_nets`
--

INSERT INTO `up_nets` (`id`, `title`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Permanent Nets', 0, '1', '2022-05-23 09:33:52', '2022-05-23 09:33:52', NULL),
(2, 'Portable Nets', 1, '1', '2022-05-23 09:34:09', '2022-05-23 09:34:09', NULL),
(3, 'BYON (Bring your own nets)', 2, '1', '2022-05-23 09:34:26', '2022-05-23 09:34:26', NULL),
(4, 'Unknown', 3, '1', '2022-05-23 09:34:56', '2022-05-23 09:34:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_pickleball_courts`
--

CREATE TABLE `up_pickleball_courts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL COMMENT 'Id from states table',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accessibility` enum('PR','PL','U') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'PR=>Private, PL=>Public, U=>Unknown',
  `indoor_outdoor` enum('ID','OD','B','U') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ID=>Indoor, OD=>Outdoor, B=>Both, U=>Unknown',
  `number_of_courts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lights` enum('N','Y','U') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'N=>No, Y=>Yes, U=>Unknown',
  `cost` enum('FP','DIF','MP','U') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FP=>Free to Play, DIF=>Drop-In Fee, MP=>Membership Fee, U=>Unknown',
  `reservations_requirements` enum('N','Y','U') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'N=>No, Y=>Yes, U=>Unknown',
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entered_by_user_id` int(11) DEFAULT NULL COMMENT 'Entered By',
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_pickleball_courts`
--

INSERT INTO `up_pickleball_courts` (`id`, `title`, `state_id`, `slug`, `city`, `address`, `address_2`, `zip`, `accessibility`, `indoor_outdoor`, `number_of_courts`, `lights`, `cost`, `reservations_requirements`, `phone_no`, `website`, `entered_by_user_id`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Private', 5, 'private', 'Los Angeles', 'Test address', 'Test address 2', '90001', 'U', 'ID', '10', 'U', 'U', 'U', NULL, NULL, NULL, 0, '1', '2022-05-23 16:56:58', '2022-05-29 21:00:33', NULL),
(2, 'Public', 5, 'public', 'Los Angeles', 'Test address', NULL, '90001', NULL, 'B', '5', NULL, NULL, NULL, NULL, NULL, NULL, 1, '1', '2022-05-23 17:27:51', '2022-05-23 17:27:51', NULL),
(3, 'Private Residence', 5, 'private-residence', 'Los Angeles', 'Test address', NULL, '90001', NULL, 'B', '10', NULL, NULL, NULL, NULL, NULL, NULL, 2, '1', '2022-05-23 17:31:18', '2022-05-23 17:31:18', NULL),
(4, 'Home', 5, 'home', 'Los Angeles', 'Test address', NULL, '90001', 'PL', 'B', '4', 'U', 'DIF', 'N', NULL, NULL, NULL, 3, '1', '2022-05-24 00:08:45', '2022-05-30 23:44:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_pickleball_court_net_availabilities`
--

CREATE TABLE `up_pickleball_court_net_availabilities` (
  `id` int(10) UNSIGNED NOT NULL,
  `pickleball_court_id` int(11) DEFAULT NULL COMMENT 'Id from pickleball_courts table',
  `net_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Id from nets table'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_pickleball_court_net_availabilities`
--

INSERT INTO `up_pickleball_court_net_availabilities` (`id`, `pickleball_court_id`, `net_id`) VALUES
(6, 1, '1'),
(7, 1, '2'),
(8, 1, '3'),
(9, 4, '1'),
(10, 4, '3'),
(11, 4, '4');

-- --------------------------------------------------------

--
-- Table structure for table `up_promo_codes`
--

CREATE TABLE `up_promo_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` enum('F','P') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'F' COMMENT 'F=>Flat, P=>Percent',
  `amount` double(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Flat/Percent discount amount',
  `is_one_time_use` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'N=>No, Y=>Yes',
  `maximum_number_of_use` int(11) DEFAULT NULL,
  `is_used` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'N=>No, Y=>Yes',
  `start_date_time` timestamp NULL DEFAULT NULL,
  `end_date_time` timestamp NULL DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_promo_codes`
--

INSERT INTO `up_promo_codes` (`id`, `code`, `discount_type`, `amount`, `is_one_time_use`, `maximum_number_of_use`, `is_used`, `start_date_time`, `end_date_time`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'FLAT20', 'F', 20.00, 'Y', NULL, 'N', '2022-05-24 18:30:00', '2022-09-30 18:29:00', 1653462000, 1664607540, '1', '2022-05-24 21:32:27', '2022-05-25 00:20:21', NULL),
(2, 'PERCENT40', 'P', 40.00, 'N', 10, 'N', '2022-05-24 18:30:00', NULL, 1653462000, NULL, '1', '2022-05-25 00:24:47', '2022-05-25 00:24:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_roles`
--

CREATE TABLE `up_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_roles`
--

INSERT INTO `up_roles` (`id`, `name`, `slug`, `is_admin`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'super-admin', '1', '1', '2022-05-17 17:46:51', '2022-05-17 17:46:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_role_pages`
--

CREATE TABLE `up_role_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `routeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `up_role_permissions`
--

CREATE TABLE `up_role_permissions` (
  `role_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `up_states`
--

CREATE TABLE `up_states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_states`
--

INSERT INTO `up_states` (`id`, `code`, `title`) VALUES
(1, 'AL', 'Alabama'),
(2, 'AK', 'Alaska'),
(3, 'AZ', 'Arizona'),
(4, 'AR', 'Arkansas'),
(5, 'CA', 'California'),
(6, 'CO', 'Colorado'),
(7, 'CT', 'Connecticut'),
(8, 'DE', 'Delaware'),
(9, 'DC', 'District of Columbia'),
(10, 'FL', 'Florida'),
(11, 'GA', 'Georgia'),
(12, 'HI', 'Hawaii'),
(13, 'ID', 'Idaho'),
(14, 'IL', 'Illinois'),
(15, 'IN', 'Indiana'),
(16, 'IA', 'Iowa'),
(17, 'KS', 'Kansas'),
(18, 'KY', 'Kentucky'),
(19, 'LA', 'Louisiana'),
(20, 'ME', 'Maine'),
(21, 'MD', 'Maryland'),
(22, 'MA', 'Massachusetts'),
(23, 'MI', 'Michigan'),
(24, 'MN', 'Minnesota'),
(25, 'MS', 'Mississippi'),
(26, 'MO', 'Missouri'),
(27, 'MT', 'Montana'),
(28, 'NE', 'Nebraska'),
(29, 'NV', 'Nevada'),
(30, 'NH', 'New Hampshire'),
(31, 'NJ', 'New Jersey'),
(32, 'NM', 'New Mexico'),
(33, 'NY', 'New York'),
(34, 'NC', 'North Carolina'),
(35, 'ND', 'North Dakota'),
(36, 'OH', 'Ohio'),
(37, 'OK', 'Oklahoma'),
(38, 'OR', 'Oregon'),
(39, 'PA', 'Pennsylvania'),
(40, 'PR', 'Puerto Rico'),
(41, 'RI', 'Rhode Island'),
(42, 'SC', 'South Carolina'),
(43, 'SD', 'South Dakota'),
(44, 'TN', 'Tennessee'),
(45, 'TX', 'Texas'),
(46, 'UT', 'Utah'),
(47, 'VT', 'Vermont'),
(48, 'VA', 'Virginia'),
(49, 'WA', 'Washington'),
(50, 'WV', 'West Virginia'),
(51, 'WI', 'Wisconsin'),
(52, 'WY', 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `up_users`
--

CREATE TABLE `up_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('M','F','U') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M' COMMENT 'M=>Male, F=>Female, U=>Prefer not to answer',
  `dob` datetime DEFAULT NULL COMMENT 'Date of birth',
  `player_rating` double(10,2) NOT NULL DEFAULT 2.00 COMMENT 'Player rating',
  `role_id` int(11) DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('SA','A','U') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'U' COMMENT 'SA=>Super Admin, A=>Sub Admin, U=>User',
  `agree` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y' COMMENT 'N=>No, Y=>Yes',
  `is_waiver_signed` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y' COMMENT 'N=>No, Y=>Yes',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `send_score_confirmation` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'N=>No, Y=>Yes',
  `lastlogintime` int(11) DEFAULT NULL,
  `sample_login_show` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=>Yes, N=>No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_users`
--

INSERT INTO `up_users` (`id`, `nickname`, `title`, `first_name`, `last_name`, `full_name`, `username`, `email`, `phone_no`, `password`, `profile_pic`, `gender`, `dob`, `player_rating`, `role_id`, `remember_token`, `auth_token`, `type`, `agree`, `is_waiver_signed`, `status`, `send_score_confirmation`, `lastlogintime`, `sample_login_show`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, 'Adam', 'Klein', 'Adam Klein', NULL, 'admin@pickleballplayersnetwork.com', '9876543210', '$2y$10$FXgoQ/e3ohiSOGmSAAKJaupTyN7iNFBDqUumGRDuqYHlLVl8gNjey', '', 'M', NULL, 2.00, 1, 'UvbfQNGuWtMuDFtItb406tqMXFSuwE6CSWGRUnJsESCZKNbyflzG04jPRPTY', NULL, 'SA', 'Y', 'N', '1', 'N', 1654848192, 'Y', '2022-05-17 01:16:51', '2022-06-10 12:09:09', NULL),
(2, NULL, NULL, 'John', 'Doe', 'John Doe', NULL, 'john@yopmail.com', '9876543210', '$2y$10$VF3gpCm1byzNQ6DOmzoYR.PRsNN5.ZXt6eVwzewzSOT6rEnMM/pzi', NULL, 'M', '1986-12-11 00:00:00', 4.00, NULL, NULL, NULL, 'U', 'Y', 'Y', '1', 'Y', 1653983642, 'N', '2022-05-17 13:05:00', '2022-06-02 17:49:22', NULL),
(3, NULL, NULL, 'Brendon', 'Macculam', 'Brendon Macculam', NULL, 'brendon@yopmail.com', '9876543210', '$2y$10$c6xIz//SneHOEMBln1MdIefRKkKVDiFLOC2MyZ0oMsdsHggO/BHqO', NULL, 'M', '1985-11-27 00:00:00', 4.50, NULL, NULL, NULL, 'U', 'Y', 'Y', '1', 'Y', NULL, 'N', '2022-05-18 16:50:42', '2022-05-18 16:50:42', NULL),
(4, NULL, NULL, 'Steve', 'Martyn', 'Steve Martyn', NULL, 'steve@yopmail.com', '9876543210', '$2y$10$sSuSxOJFk.loY4IJtuYrAuX3RZrEWmVG5R5jusDTJSA/VtXSHtO06', NULL, 'M', '1984-10-15 00:00:00', 3.50, NULL, NULL, NULL, 'U', 'Y', 'Y', '1', 'Y', NULL, 'N', '2022-05-18 17:00:59', '2022-05-18 17:00:59', NULL),
(7, NULL, NULL, 'Mitchel', 'Santner', 'Mitchel Santner', NULL, 'mitchel@yopmail.com', '9876543210', '$2y$10$oQvw3/DGyi1NN6z8RoHj5Ogq4Ez7ZaZAs13h5zGwkPo9VmwxTWEP.', NULL, 'F', '1986-12-11 00:00:00', 4.25, NULL, NULL, NULL, 'U', 'Y', 'Y', '1', 'Y', NULL, 'N', '2022-06-08 19:58:20', '2022-06-08 19:58:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_user_availabilities`
--

CREATE TABLE `up_user_availabilities` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'Id from users table',
  `availability_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Id from availabilitites table'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_user_availabilities`
--

INSERT INTO `up_user_availabilities` (`id`, `user_id`, `availability_id`) VALUES
(1, 2, '1'),
(2, 2, '3'),
(3, 2, '4'),
(4, 3, '1'),
(5, 4, '2'),
(6, 4, '4'),
(11, 7, '2'),
(12, 7, '4');

-- --------------------------------------------------------

--
-- Table structure for table `up_user_details`
--

CREATE TABLE `up_user_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'Id from users table',
  `home_court` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Preferred Home Court',
  `address_line_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Address line 1',
  `address_line_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Address line 2',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT NULL COMMENT 'Id from states table',
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `how_did_you_find_us` enum('SE','SM','RBF','BOP','AD','O') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SE=>Search engine (Google, Yahoo, etc.), SM=>Social Media (Facebook, Instagram, etc.), RBF=>Recommended by a friend, BOP=>Blog or Publication, AD=>Advertisement, O=>Other'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_user_details`
--

INSERT INTO `up_user_details` (`id`, `user_id`, `home_court`, `address_line_1`, `address_line_2`, `city`, `state`, `zip`, `how_did_you_find_us`) VALUES
(1, 2, '1', '14/23 Golf Club Road', 'Tollygunge', 'Kolkata', 5, '700033', 'SM'),
(2, 3, '4', '14/23 Gold Club Road', 'Tollygunge', 'Kolkata', 5, '700033', 'O'),
(3, 4, '3', '1/4 Motilal Road', 'Bhawanipur', 'Kolkata', 5, '700014', 'RBF'),
(6, 7, '3', '3/8 Lord Street', NULL, 'Los Angeles', 5, '90001', 'BOP');

-- --------------------------------------------------------

--
-- Table structure for table `up_user_roles`
--

CREATE TABLE `up_user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `up_videos`
--

CREATE TABLE `up_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cms_id` int(11) DEFAULT NULL COMMENT 'Id from cms table',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `embedded_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_videos`
--

INSERT INTO `up_videos` (`id`, `cms_id`, `title`, `embedded_code`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'League Video', '<iframe width=\"1280\" height=\"720\" src=\"https://www.youtube.com/embed/MfFBox4dmc0\" title=\"League Video\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '1', '2022-05-17 18:45:22', '2022-05-17 18:45:22', NULL),
(2, 7, 'Partner Program Video', '<iframe width=\"1280\" height=\"720\" src=\"https://www.youtube.com/embed/MfFBox4dmc0\" title=\"Partner Program Video\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '1', '2022-05-17 18:45:39', '2022-05-17 18:45:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_website_settings`
--

CREATE TABLE `up_website_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `googleplus_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rss_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dribble_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tumblr_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_line` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_gateway` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_website_settings`
--

INSERT INTO `up_website_settings` (`id`, `from_email`, `to_email`, `website_title`, `phone_no`, `fax`, `facebook_link`, `twitter_link`, `instagram_link`, `linkedin_link`, `pinterest_link`, `googleplus_link`, `youtube_link`, `rss_link`, `dribble_link`, `tumblr_link`, `default_meta_title`, `default_meta_keywords`, `default_meta_description`, `address`, `map`, `footer_address`, `copyright_text`, `tag_line`, `employee_gateway`, `logo`, `logo_title`, `logo_alt`, `footer_logo`, `footer_logo_title`, `footer_logo_alt`) VALUES
(1, 'info@pickleballplayersnetwork.com', 'admins@yopmail.com', 'Pickleball Players Network', NULL, NULL, 'https://www.facebook.com/pickleballplayersnetwork', NULL, 'https://www.instagram.com/pickleballplayersnetwork', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pickleball Players Network', 'Pickleball Players Network', 'Online platform for flexible pickleball leagues and playing partners', NULL, NULL, NULL, 'Pickleball Players Network', 'The PPN Team', NULL, 'logo_1652856184.png', 'Pickleball Players Network', 'Pickleball Players Network', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `up_availabilities`
--
ALTER TABLE `up_availabilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_banners`
--
ALTER TABLE `up_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_cms`
--
ALTER TABLE `up_cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_contacts`
--
ALTER TABLE `up_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_migrations`
--
ALTER TABLE `up_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_nets`
--
ALTER TABLE `up_nets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_pickleball_courts`
--
ALTER TABLE `up_pickleball_courts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_pickleball_court_net_availabilities`
--
ALTER TABLE `up_pickleball_court_net_availabilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_promo_codes`
--
ALTER TABLE `up_promo_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_roles`
--
ALTER TABLE `up_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_role_pages`
--
ALTER TABLE `up_role_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_states`
--
ALTER TABLE `up_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_users`
--
ALTER TABLE `up_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_user_availabilities`
--
ALTER TABLE `up_user_availabilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_user_details`
--
ALTER TABLE `up_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_videos`
--
ALTER TABLE `up_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_website_settings`
--
ALTER TABLE `up_website_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `up_availabilities`
--
ALTER TABLE `up_availabilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `up_banners`
--
ALTER TABLE `up_banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `up_cms`
--
ALTER TABLE `up_cms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `up_contacts`
--
ALTER TABLE `up_contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `up_migrations`
--
ALTER TABLE `up_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `up_nets`
--
ALTER TABLE `up_nets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `up_pickleball_courts`
--
ALTER TABLE `up_pickleball_courts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `up_pickleball_court_net_availabilities`
--
ALTER TABLE `up_pickleball_court_net_availabilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `up_promo_codes`
--
ALTER TABLE `up_promo_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `up_roles`
--
ALTER TABLE `up_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `up_role_pages`
--
ALTER TABLE `up_role_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `up_states`
--
ALTER TABLE `up_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `up_users`
--
ALTER TABLE `up_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `up_user_availabilities`
--
ALTER TABLE `up_user_availabilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `up_user_details`
--
ALTER TABLE `up_user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `up_videos`
--
ALTER TABLE `up_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `up_website_settings`
--
ALTER TABLE `up_website_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
