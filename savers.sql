-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2020 at 02:49 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `savers`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `bank_id` int(11) UNSIGNED NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_abbr` varchar(10) DEFAULT NULL,
  `bank_url` varchar(256) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_name`, `bank_abbr`, `bank_url`, `timestamp`) VALUES
(1, 'Up Bank', NULL, 'https://up.com.au/', '2019-09-25 12:38:49'),
(2, 'ING', NULL, 'https://www.ing.com.au/savings.html', '2019-09-25 12:38:30'),
(3, 'National Australia Bank', 'NAB', 'https://www.nab.com.au/personal/accounts/savings-accounts', '2019-09-25 12:37:20'),
(4, 'UBank', NULL, 'https://www.ubank.com.au/campaigns/savings-and-transaction-accounts', '2019-09-25 12:37:07'),
(5, 'Commonwealth Bank', 'CommBank', 'https://www.commbank.com.au/savings-accounts.html?pid=46423&sc_psk=34940&sc_crkey=153612994511&c', '2019-09-25 12:36:20'),
(6, 'Australia and New Zealand Banking Group', 'ANZ', 'https://www.anz.com.au/personal/bank-accounts/savings-accounts/', '2019-11-21 09:49:34'),
(7, 'Bendigo Bank', NULL, 'https://www.bendigobank.com.au/personal/savings-accounts/', '2019-09-25 12:35:38'),
(8, '86 400', NULL, 'https://www.86400.com.au/pay-and-save/', '2019-09-25 12:49:59'),
(9, 'Bank of Queensland', 'BOQ', 'https://www.boq.com.au/personal/banking/savings-and-term-deposits/fast-track-starter-account', '2019-09-25 12:43:08'),
(10, 'Westpac', NULL, 'https://www.westpac.com.au/personal-banking/bank-accounts/savings-accounts/life/?pid=iwc:dp:sav-cat_1803:cta:lifelnkFOM', '2019-09-29 09:41:01'),
(11, 'Suncorp', NULL, 'https://www.suncorp.com.au/banking/bank-accounts/savings-accounts.html', '2019-09-30 11:10:45'),
(12, 'ME Bank', NULL, 'https://www.mebank.com.au/lps/osa/high-online-savings-account/?cid=OSAC0167&&gclid=Cj0KCQjwz8bsBRC6ARIsAEyNnvoNjRv94puQTIUltbxsDkYmgkTvGocMPop5l_AHl58kOVqSfh0igVkaAvuVEALw_wcB&gclsrc=aw.ds', '2019-09-30 11:21:26'),
(13, 'AMP Bank', NULL, 'https://www.amp.com.au/personal/banking/products/savings-accounts/amp-saver-account?extcmp=saver-sem-google-brand&gclid=Cj0KCQjwz8bsBRC6ARIsAEyNnvoucjw5s7pVcV3-VSTEUZeY6ZW8eNu9-J6R3Pn5ZxyP2BHchCuKLL8aAkinEALw_wcB&gclsrc=aw.ds', '2019-09-30 11:21:45'),
(14, 'Bankwest', NULL, 'https://www.bankwest.com.au/personal/save-invest/savings-accounts?promocode=bwexp563&icid=bwexp563', '2019-09-30 11:37:41'),
(15, 'Rabobank', NULL, 'https://www.rabobank.com.au/personal-savings/', '2019-10-22 10:40:11'),
(16, 'Volt Bank', NULL, 'https://www.voltbank.com.au/', '2020-01-05 08:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `blog_cdate` datetime DEFAULT NULL,
  `blog_edate` datetime DEFAULT NULL,
  `blog_head` varchar(148) DEFAULT NULL,
  `blog_slug` varchar(255) DEFAULT NULL,
  `blog_img` varchar(255) DEFAULT NULL,
  `blog_content` text,
  `blog_ctg` varchar(32) DEFAULT NULL,
  `blog_vis` bit(1) NOT NULL DEFAULT b'1',
  `blog_feat` bit(1) NOT NULL DEFAULT b'0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `user_id`, `blog_cdate`, `blog_edate`, `blog_head`, `blog_slug`, `blog_img`, `blog_content`, `blog_ctg`, `blog_vis`, `blog_feat`, `timestamp`) VALUES
(1, 1, '2019-12-26 00:00:00', '2019-12-26 00:00:00', 'Finding the best savings account to grow your balance', 'finding-the-best-savings-account-to-grow-your-balance', 'img/articles/piggy.jpg', '<p>Whether you are saving money for your first home or a holiday to the Bahamas, savings accounts are one of the most simplistic ways to make small a passive income on the side from as little as just storing money with a particular bank. Before making a decision, it is important to recognize the differences between saving and transaction accounts and the characteristics to look for as certain accounts are tailored to different goals and objectives.</p>\r\n\r\n<h3>Transaction and Savings account</h3>\r\n<p>If you are using a bank for paying bills, you are most likely using a transaction account. These accounts are considered the basic bank account which allows you to make your day to day purchases and have your salary paid into. You can associate a debit card to these accounts which will allow you to tap and pay anywhere and gives you access to ATMs.</p>\r\n\r\n<p>Savings accounts on the other hand help increase your wealth by rewarding you with interest rates. These interest rates are offered to accounts as a reward for allowing the bank to borrow your money(think of you acting as the bank loaner in this situation). The bulk of your money should typically be stored in these accounts as transaction accounts usually pay low to no interest. Savings interest rates can be minuscule  to begin with but as you store more money, the money earned from interest snowballs to greater amounts.</p>\r\n\r\n<p>It is advised to have a savings account so that your money can keep up with inflation rates(increase of goods over time). Savings accounts are free to open if you have a transaction account set up already. </p>\r\n\r\n<h3>Choosing the right savings account</h3>\r\n<p>In Australia, there are hundreds of savings accounts to choose from. Before you lock your money in, make sure you are getting the most out of interest rates by looking out for the characteristics listed below:</p>\r\n\r\n<strong>High Interest rates:</strong>\r\n<br>\r\n<p>Using our Savings account comparison application, you can easily filter for the highest interest accounts in Australia. This ensures your savings account maximises its growth from interest.</p>\r\n\r\n<strong>Fair bonus conditions:</strong>\r\n<br>\r\n<p>Are the bonus conditions for obtaining the bonus interest achievable? Some savings accounts remove your bonus if you make a certain number of withdrawals. This can be a deal breaker if you like transferring money around from your savings accounts.</p>\r\n\r\n<p>There are also savings accounts that require a certain number of card purchases. These savings accounts are flexible for those who make regular card payments whether its groceries or frozen Cokes at McDonalds. </p>\r\n\r\n<p>Lastly, some accounts require a certain amount of money to be deposited in your transaction or savings account to qualify for the bonus interest rate. This is exceptionally straightforward to achieve for individuals working part time or full-time jobs where there salary can be directly paid to these accounts.</p>\r\n\r\n<strong>Honeymoon savings accounts:</strong>\r\n<br>\r\n<p>In contrast to different bonus conditions, it is important to determine if honeymoon savings accounts are right for you. These accounts offer bonus interest for a few months before reverting to the default interest rate.</p>\r\n\r\n<p>These accounts would be more appropriate for short-term goals such as holidays and the obvious honeymoon. If you are saving up for a house, it is better to look elsewhere.  </p>\r\n\r\n<strong>Balance limit for interest rate:</strong>\r\n<br>\r\n<p>Although some interest rates may look attractive for certain savings accounts, the bonus interest rate may stop taking effect after your money exceeds a certain limit. If you are planning to have a joint account with your family, you may want to consider savings accounts with higher balance limits as base rates can be fairly low once you go over the balance limit.</p>\r\n\r\n<strong>Fees for savings and transaction accounts:</strong>\r\n<br>\r\n<p>It is ideal to avoid accounts that charge monthly or annual fees. Although fees may be small, these payments usually build up over time and causes less money building interest in your savings.</p>\r\n\r\n<p>Most of the time, savings accounts do not charge account fees, but they may require to link to a transaction account. The transaction accounts may have monthly and annual administration fees. Always make sure to check transaction account fees as well. </p>\r\n\r\n<strong>ATM fees, International withdrawals and overdraft fees:</strong>\r\n<br>\r\n<p>Many banks appear to allow the use of other banks ATMs for free but there are still ATMs out there that will charge exceptionally high fees. Fortunately, there are some banks that waive any ATM fees such as ING’s Everyday bank account. Like account keeping fees, the fees from ATMs can build over time if you regularly use them.</p>\r\n\r\n<p>It is ideal to also check the fees associated with international payments and seeing how much you get charged for overdraft fees which can hurt your bank account if it happens.</p>\r\n\r\n<h3>Engage autopilot on those savings</h3>\r\n<p>As mentioned from Australia’s simplest money guide, the Barefoot Investor, you want to automate your savings as it will allow your savings to always grow without manual work.</p>\r\n\r\n<p>One dominant feature to look for is ‘Automatic Transfers.’ You can schedule certain days for your transaction account to split money into your savings accounts. This is useful if you have multiple savings account opened up for different purposes such as paying off debt. It also ensures that contributions into savings remains consistent.</p>\r\n\r\n<p>Another feature that some savings accounts will feature is ‘Round Ups’ which involves the application rounding up transactions to the nearest dollar and sending that loose change to your savings account. Savings account such as UP Bank allows you the further modify your round ups with transactions such as increase the round up to the nearest $10.</p>', 'Saving', b'1', b'1', '2020-01-05 08:47:49'),
(2, 1, '2020-01-04 00:00:00', '2020-01-04 00:00:00', 'How to secure your online savings account', 'how-to-secure-your-online-savings-account', 'img/articles/security.jpg', '<p>Cyber crime and identity fraud are rising issues that can affect anyone\'s hard earned cash. In 2018, it was reported by the Australian Competition and Consumer Commission(ACCC) that 177,516 scams were reported to Scamwatch and has represented a 10-percent increase since 2017. Fortunately, there are both online and physical measures that can be taken such as using up to date security software, enforcing strong passwords and being aware of anything unusual that may pocket your money.</p>\r\n\r\n\r\n<h3>Protecting your bank account online</h3>\r\n\r\n<h4>Using a VPN on a public network</h4>\r\n<p>The danger of banking on public networks is that criminals can use tools to sniff out private information from traffic on the network. This activity is known as packet sniffing. This can range from passwords to your bank account card details being stolen. The solution to avoid packet sniffers is to use a service called a Virtual Private Network(VPN).</p>\r\n\r\n<p>A VPN protects privacy by encrypting data leaving your computer and then getting decrypted at the VPN server which can be located anywhere around the world. VPN servers then route the decrypted data to the appropriate destination. The benefit is that encryption keeps the data safe from cyber criminals and also keeps your location anonymous as the destination server thinks the source is the VPN server.</p>\r\n\r\n<p>VPN’s are usually not free and are paid through a monthly or yearly subscription. One VPN we recommend is NordVPN. It allows you to easily access VPN servers anywhere around the world to ensure there is an encrypted connection when banking. The subscription also provides a service for your mobile phone.</p>\r\n\r\n\r\n<h4>Implementing Antivirus software</h4>\r\n\r\n<p>Up to date antivirus software will ensure that malicious software or code is removed from your computer or phone. Some antivirus software validates websites in real-time and will warn users if the source is untrusted.</p>\r\n\r\n<p>Malicious software can have the ability to record your keyboard strokes(known as keylogging). The captured data are sent to the cybercriminal where passwords and bank details may be identified. Other malicious code can even obtain a view of your desktop. </p>\r\n\r\n<p>Avast Antivirus is a free application that can be installed easily, but it is highly advised to purchase premium to get all the top-end security features such as advanced firewall. The stronger the protection, the less likely you will have your personal finance details stolen.</p>\r\n\r\n<h4>Enable two-factor authentication</h4>\r\n<p>Two-factor authentication is crucial for banking as it adds layers to accessing your bank account. It allows an additional code or action to be taken after a password has been entered. Check with your online bank to see if these features can be enabled.</p>\r\n\r\n<p>Linking your mobile phone is one example of two-factor authentication. It involves receiving a code sent to your mobile via SMS when logging in with your bank credentials. This second code acts as a failsafe incase your login details are stolen and the only way to proceed further is to obtain the code off a specific mobile.</p>\r\n\r\n<p>Another example is security tokens which involve passwords that change in short bursts of time. Security tokens can come in physical forms or e-tokens where the code is displayed on a smartphone. With the password constantly changing, it eliminates having the fraudster relying on login credentials to acquire your money. </p>\r\n\r\n<h4>Use strong passwords</h4>\r\n<p>The National cyber security center states that 23.2 million accounts were compromised with the password of 123456. With these numbers so high, it is critical to practice strong password habits. A weak password considerably increases your chances of cyber criminals guessing your password through methods of brute force and dictionary attacks. </p>\r\n\r\n<ul>\r\n<li><strong>Avoid using personal information - </strong>Passwords should not involve your birthdate, street name or mobile number. Hackers may use this information to guess your password first.</li>\r\n<li><strong>Do not use Dictionary words - </strong>Common words that appear in literature makes your password vulnerable to dictionary attacks which involves utilizing software to guess your password using common words. Use multiple words to reduce becoming a victim of this attack.</li>\r\n<li><strong>Make it long and meaningless - </strong>Similar to dictionary attack, brute force attack involves software using random numbers and symbols to guess a password. Enforce long passwords with a mix of random characters and symbols. It is also advised to use a mixture of upper and lower case to reduce brute force attacks.</li>\r\n</ul>\r\n\r\n<h4>Validating email and website scams</h4>\r\n<p>According to the Australian Competition and Consumer Commision(ACCC), half a billion dollars was reported to be lost to scammers in 2018. Scams are a rising issue and it is important to be educated so you don\'t fall victim to cyber criminals.</p>\r\n\r\n<p>One of the most common forms of scams is Phishing, which involves an email or website impersonating the victim’s bank. Their goal is to have the victim give their bank credentials through a fake login portal or email. These emails can also have links or attachments associated with them that should <strong>NEVER BE CLICKED ON.</strong> These attachments may have malware(Malicious code) that can steal your personal data.</p>\r\n\r\n<p>Scams can be identified by looking for the signs below:  </p>\r\n<ul>\r\n<li>Bad grammar and spelling throughout the email</li>\r\n<li>The email address does not match the sender, and website URL is not legitimate</li>\r\n<li>Email does not address your full name</li>\r\n<li>Email is asking for your personal information</li>\r\n<li>Branding or email does not feel right</li>\r\n</ul>\r\n\r\n<h3>Protecting your bank account in the real-world</h3>\r\n<h4>Card Skimming and PIN capturing ATMs</h4>\r\n<p>Criminals can attach replicated objects on ATMs which steal data from your debit card as well as recording the pin entered. For a criminal to successfully skim data, they need to capture your cards details and record your entering your PIN.</p>\r\n\r\n<p>Card skimming involves attaching a fake card entry slot over the existing card entry slot. The fake attachment contains electronics that can capture details in the cards magnetic strip which contains the card number and expiration date. To avoid becoming a victim of card skimming, check ATMs for any unusual part especially the standalone ones located at restaurants or service stations.</p>\r\n\r\n<p>Like card skimming attachments, PIN capturing attachments can come in the form of fake panels placed around the ATM. They are fitted with cameras that record PIN entry. Like Card skimmers, you can spot a PIN capture device by inspecting the ATM for any loose, detachable or suspicious parts. It is also ideal to cover the pin with your hand to avoid any PIN capturing cameras.</p>\r\n\r\n<h4>PIN Safety</h4>\r\n\r\n<p>If someone gets hold of your physical debit card, all they need to know is your four digit pin number to be able to access your money. Your PIN should never be written on your card nor should anyone else know it but yourself. It should also not be based off personal information that may be easy for a fraudster to guess such as birth dates or phone numbers.</p>\r\n\r\n<p>To further reduce a fraudster cracking the PIN, you can change the PIN from time to time. This ensures PINs captured from PIN capturing cameras are no longer valid.</p>\r\n\r\n<h3>Getting your money back</h3>\r\n<p>If you suspect an unauthorized transaction, contact your bank immediately to stop your stolen card and file a dispute.</p>\r\n<p>The likelihood of obtaining money back is dependant on the account holders actions. According to ASIC money smart, you are likely to obtain your money if your unauthorised transactions takes place after you report a stolen or missing card. If circumstances where you have written your PIN on the card or you delay notifying the finance institution, the chances of obtaining money back become slimmer. </p>', 'Security', b'1', b'1', '2020-01-07 01:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `contact_queries`
--

CREATE TABLE `contact_queries` (
  `contact_id` int(11) UNSIGNED NOT NULL,
  `contact_ip` varbinary(16) DEFAULT NULL,
  `contact_name` varchar(48) DEFAULT NULL,
  `contact_email` varchar(48) DEFAULT NULL,
  `contact_subject` varchar(100) DEFAULT NULL,
  `contact_msg` text,
  `contact_date` datetime DEFAULT NULL,
  `contact_status` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_queries`
--

INSERT INTO `contact_queries` (`contact_id`, `contact_ip`, `contact_name`, `contact_email`, `contact_subject`, `contact_msg`, `contact_date`, `contact_status`) VALUES
(1, '', NULL, NULL, NULL, NULL, NULL, b'0'),
(2, 0x3a3a31, NULL, NULL, NULL, NULL, NULL, b'0'),
(3, 0x3a3a31, 'Connor', 'connor.j.vernon97@gmail.com', 'Bugs and errors related to Dosh Alley', '', NULL, b'0'),
(4, 0x3a3a31, 'BoobyFRick', 'conjamver@hotmail.com', 'General Enquiry', 'sadasdasd', '2019-12-24 06:03:30', b'0'),
(5, 0x3a3a31, 'Lordyt', 'conjamver@hotmail.com', 'Bugs and errors related to Dosh Alley', 'dasdsasad', '2019-12-26 11:56:21', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `savers`
--

CREATE TABLE `savers` (
  `saver_id` int(11) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `rank_id` int(11) DEFAULT '8',
  `saver_name` varchar(128) DEFAULT NULL,
  `saver_cdate` datetime DEFAULT NULL,
  `saver_date` datetime DEFAULT NULL,
  `v_rate` decimal(9,2) DEFAULT '0.00',
  `b_rate` decimal(9,2) DEFAULT '0.00',
  `req` varchar(255) DEFAULT NULL,
  `max_bal` int(9) DEFAULT NULL,
  `s_hmoon` bit(1) DEFAULT b'0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savers`
--

INSERT INTO `savers` (`saver_id`, `bank_id`, `rank_id`, `saver_name`, `saver_cdate`, `saver_date`, `v_rate`, `b_rate`, `req`, `max_bal`, `s_hmoon`, `visible`, `timestamp`) VALUES
(1, 3, 5, 'ISaver', '2019-11-19 00:00:00', '2019-11-21 20:15:42', '0.11', '1.51', 'Make a minimum of one deposit each month.', 20000000, b'1', 1, '2019-11-21 09:24:50'),
(2, 3, 4, 'Reward Saver', '2019-11-19 00:00:00', '2019-09-28 00:00:00', '0.11', '1.50', 'Bonus rate applies to the first four months of opening ISaver account for balances up to 20 Mil.', NULL, b'0', -1, '2019-11-21 09:04:43'),
(3, 2, 1, 'Savings Maximiser', '2019-11-19 00:00:00', '2019-09-28 00:00:00', '0.25', '1.95', 'Deposit $1000 or more per month into your ING Orange every day account and make 5+ card purchases each month.', 100000, b'0', 1, '2019-11-21 09:25:00'),
(4, 4, 2, 'Ultra Saver', '2019-11-19 00:00:00', '2019-09-28 00:00:00', '1.04', '1.06', 'Link USaver account and deposit $200 or more monthly. ', 200000, b'0', 1, '2019-11-21 09:25:04'),
(5, 6, 4, 'Goal based saving', '2019-11-19 00:00:00', '2019-09-28 00:00:00', '0.01', '1.60', 'Make a $10 deposit or more each month with no withdrawal.', NULL, b'0', 1, '2019-11-21 09:07:45'),
(6, 6, 5, 'Flexible Saving', '2019-11-19 00:00:00', '2019-09-28 00:00:00', '0.10', '1.50', 'Bonus interest for 3 months.', NULL, b'1', 1, '2019-11-21 09:07:39'),
(7, 1, 1, 'Savings', '2019-11-19 00:00:00', '2019-09-28 00:00:00', '0.50', '2.00', 'Make 5+ card purchases per month with Everyday transaction account.', 50000, b'0', 1, '2019-11-21 09:25:33'),
(8, 8, 2, 'Savings', '2019-11-19 00:00:00', '2019-09-28 00:00:00', '0.40', '2.10', 'Deposit $1000+ into any 86 400 account.', 100000, b'0', 1, '2019-11-21 09:23:34'),
(9, 9, 3, 'Fast Track Starter', '2019-11-19 00:00:00', '2019-09-29 00:00:00', '0.35', '3.15', 'Deposit $200+ into linked Day2Day Plus account.', NULL, b'0', 1, '2019-11-19 10:07:40'),
(10, 9, 2, 'Fast Track Saver', '2019-11-19 00:00:00', '2019-09-29 00:00:00', '0.35', '2.50', '$1000+ is credited to the linked Day2Day plus account.', NULL, b'0', 1, '2019-11-19 10:07:39'),
(11, 10, 3, 'Goal saving', '2019-11-19 00:00:00', '2019-11-21 20:27:11', '0.45', '1.20', 'Deposit every month and make sure that latest balance is greater than last balance.', NULL, b'0', 1, '2019-11-21 09:27:11'),
(12, 11, 3, 'Growth Saver', '2019-11-19 00:00:00', '2019-09-30 00:00:00', '0.20', '1.85', 'Deposit $200+ every month and make no more than one withdrawl per month.', NULL, b'0', 1, '2019-11-19 10:07:38'),
(13, 12, 2, 'Online Savings', '2019-11-19 00:00:00', '2019-09-30 00:00:00', '0.80', '1.55', 'Make a tap and go payment with transaction account card.', NULL, b'0', 1, '2019-11-19 10:07:37'),
(14, 13, NULL, 'Saver Account', '2019-11-19 00:00:00', '2019-11-19 00:00:00', '1.65', '0.96', 'Introductory bonus rate for the first 4 moths for balances up to $250,000', NULL, b'0', 1, '2019-11-19 10:08:20'),
(15, 13, 4, 'Savings', '2019-11-19 00:00:00', '2019-09-30 00:00:00', '1.65', '0.96', 'Introductory bonus for first 4 months for balances up to $200,000.', NULL, b'1', 1, '2019-11-21 09:11:33'),
(16, 13, 6, 'B3tter', '2019-11-19 00:00:00', '2019-11-21 20:40:10', '1.00', '0.75', 'Deposit $2000+ into your AMP account.', NULL, b'0', 1, '2019-11-21 09:40:10'),
(17, 6, 5, 'Progress Saver', '2019-11-19 00:00:00', '2019-09-30 00:00:00', '0.01', '1.84', 'Deposit $10+ each month and no withdrawals each month.', NULL, b'0', 1, '2019-11-19 10:07:35'),
(18, 14, 3, 'Hero Saver', '2019-11-19 00:00:00', '2019-09-30 00:00:00', '0.01', '2.10', 'Deposit $200+ each month and no withdrawals each month.', NULL, b'0', 1, '2019-11-19 10:07:35'),
(19, 14, 7, 'TeleNet Saver', '2019-11-19 00:00:00', '2019-09-30 00:00:00', '0.50', '2.35', 'Introductory bonus for first 4 months and a linked transaction account.', NULL, b'1', 1, '2019-11-21 09:11:07'),
(20, 15, 4, 'High Interest Savings', '2019-11-19 00:00:00', '2019-10-22 00:00:00', '1.05', '1.45', 'Bonus rate effective for first 4 months. Must be linked to Rabobank transaction account.', NULL, b'1', 1, '2019-11-19 10:13:42'),
(21, 10, 5, 'eSaver', '2019-11-19 00:00:00', '2019-11-21 20:47:57', '0.10', '1.56', 'Introductory period available for first 5 months.', NULL, b'1', 1, '2019-11-21 09:47:57'),
(22, 16, 1, 'Savings', '2020-01-05 00:00:00', '2020-01-05 19:14:39', '2.15', '0.00', 'No bonus condition', 245000, b'0', 1, '2020-01-05 08:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `s_points`
--

CREATE TABLE `s_points` (
  `ID` int(11) UNSIGNED NOT NULL,
  `s_id` int(11) DEFAULT NULL,
  `point_type` tinyint(4) DEFAULT NULL,
  `point_desc` varchar(128) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_points`
--

INSERT INTO `s_points` (`ID`, `s_id`, `point_type`, `point_desc`, `timestamp`) VALUES
(1, 3, 1, 'Free ATMs in Australia and around the world. Fees Rebated.', '2019-10-14 10:05:58'),
(2, 2, 1, 'Easy bonus. Make one deposit each month.', '2019-10-17 11:11:41'),
(3, 2, 2, 'Bonus dissapears if any withdrawal is made.', '2019-10-14 10:05:59'),
(4, 3, 1, 'Competitive.', '2019-10-17 10:58:49');

-- --------------------------------------------------------

--
-- Table structure for table `s_rank`
--

CREATE TABLE `s_rank` (
  `rank_id` int(11) UNSIGNED NOT NULL,
  `rank` varchar(10) DEFAULT NULL,
  `rank_color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_rank`
--

INSERT INTO `s_rank` (`rank_id`, `rank`, `rank_color`) VALUES
(1, 'S', '#8e44ad'),
(2, 'A', '#3498db'),
(3, 'B', '#27ae60'),
(4, 'C', '#f39c12'),
(5, 'D', '#d35400'),
(6, 'E', '#e74c3c'),
(7, 'F', '#e74c3c'),
(8, 'TBA', '#d2d2d2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `firstname` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `user_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `firstname`, `lastname`, `user_created`) VALUES
(1, 'conjamver', 'xxx123xxx', 'Connor', 'James', '2019-12-26 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `contact_queries`
--
ALTER TABLE `contact_queries`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `savers`
--
ALTER TABLE `savers`
  ADD PRIMARY KEY (`saver_id`);

--
-- Indexes for table `s_points`
--
ALTER TABLE `s_points`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `s_rank`
--
ALTER TABLE `s_rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_queries`
--
ALTER TABLE `contact_queries`
  MODIFY `contact_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `savers`
--
ALTER TABLE `savers`
  MODIFY `saver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `s_points`
--
ALTER TABLE `s_points`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `s_rank`
--
ALTER TABLE `s_rank`
  MODIFY `rank_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
