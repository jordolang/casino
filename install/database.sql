-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2024 at 09:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xaxino`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@site.com', 'admin', NULL, '664c6aa07b0a71716284064.png', '$2y$12$xmtRzBzqvjc/W7hXwun8vuezU.mMp62Op79vr.KNYJ0Myb51we1lG', 'V5bdAbzDsTZnW1fe0ncauAiCJOPZZwiXlyJcGMGIgkQh80WFBLXdLi6XVuDC', NULL, '2024-05-21 03:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `click_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commission_logs`
--

CREATE TABLE `commission_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `who` int NOT NULL DEFAULT '0',
  `level` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `main_amo` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `title` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cron_jobs`
--

CREATE TABLE `cron_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cron_schedule_id` int NOT NULL DEFAULT '0',
  `next_run` datetime DEFAULT NULL,
  `last_run` datetime DEFAULT NULL,
  `is_running` tinyint(1) NOT NULL DEFAULT '1',
  `is_default` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cron_jobs`
--

INSERT INTO `cron_jobs` (`id`, `name`, `alias`, `action`, `url`, `cron_schedule_id`, `next_run`, `last_run`, `is_running`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Incomplete Game', 'incomplete_game', '[\"App\\\\Http\\\\Controllers\\\\CronController\", \"incompleteGame\"]', NULL, 1, '2024-05-22 07:36:39', '2024-05-21 07:36:39', 1, 1, '2024-01-09 08:11:00', '2024-05-21 01:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `cron_job_logs`
--

CREATE TABLE `cron_job_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `cron_job_id` int UNSIGNED NOT NULL DEFAULT '0',
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `duration` int NOT NULL DEFAULT '0',
  `error` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cron_schedules`
--

CREATE TABLE `cron_schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interval` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cron_schedules`
--

INSERT INTO `cron_schedules` (`id`, `name`, `interval`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Day', 86400, 1, '2024-01-09 08:06:11', '2024-01-09 08:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `method_code` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `method_currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `final_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `btc_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_try` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT '0',
  `admin_feedback` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `success_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `failed_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_cron` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE `device_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `is_app` tinyint(1) NOT NULL DEFAULT '0',
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'object',
  `support` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, '2019-10-18 23:16:05', '2022-09-17 05:59:49'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\r\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\r\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\r\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"6LdPC88fAAAAADQlUf_DV6Hrvgm-pZuLJFSLDOWV\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"6LdPC88fAAAAAG5SVaRYDnV2NpCrptLg2XLYKRKB\"}}', 'recaptcha.png', 0, '2019-10-18 23:16:05', '2024-05-21 01:36:30'),
(3, 'custom-captcha', 'Custom Captcha', 'Just put any random string', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, '2019-10-18 23:16:05', '2022-10-16 03:57:59'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{measurement_id}}\"></script>\n                <script>\n                  window.dataLayer = window.dataLayer || [];\n                  function gtag(){dataLayer.push(arguments);}\n                  gtag(\"js\", new Date());\n                \n                  gtag(\"config\", \"{{measurement_id}}\");\n                </script>', '{\"measurement_id\":{\"title\":\"Measurement ID\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, '2021-05-04 10:19:12'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"713047905830100\"}}', 'fb_com.png', 0, NULL, '2022-10-19 06:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint UNSIGNED NOT NULL,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_keys` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `tempname`, `slug`, `data_keys`, `data_values`, `seo_content`, `views`, `created_at`, `updated_at`) VALUES
(41, NULL, NULL, 'cookie.data', '{\"short_desc\":\"We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.\",\"description\":\"<div><h3><font>What information do we collect?<\\/font><\\/h3><p><font>We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/font><\\/p><\\/div><div><h3><font>How do we protect your information?<\\/font><\\/h3><p><font>All provided delicate\\/credit data is sent through Stripe.<br>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/font><\\/p><\\/div><div><h3><font>Do we disclose any information to outside parties?<\\/font><\\/h3><p><font>We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/font><\\/p><\\/div><div><h3><font>Children\'s Online Privacy Protection Act Compliance<\\/font><\\/h3><p><font>We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/font><\\/p><\\/div><div><h3><font>Changes to our Privacy Policy<\\/font><\\/h3><p><font>If we decide to change our privacy policy, we will post those changes on this page.<\\/font><\\/p><\\/div><div><h3><font>How long we retain your information?<\\/font><\\/h3><p><font>At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/font><\\/p><\\/div><div><h3><font>What we don\\u2019t do with your data<\\/font><\\/h3><p><font>We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/font><\\/p><\\/div>\",\"status\":1}', NULL, 0, '2020-07-04 23:42:52', '2024-05-21 01:07:29'),
(42, 'basic', 'privacy-policy', 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<p><font>Privacy Policy<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>1. Introduction<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>Welcome to Xaxino (\\\"Company\\\", \\\"we\\\", \\\"our\\\", \\\"us\\\"). We are committed to protecting your personal information and your right to privacy. If you have any questions or concerns about our policy, or our practices with regards to your personal information.<\\/font><\\/p><p><font>2. Information We Collect<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We collect personal information that you voluntarily provide to us when you register on the website, express an interest in obtaining information about us or our products and services, when you participate in activities on the website (such as posting messages in our online forums or entering competitions, contests or giveaways), or otherwise when you contact us.<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>The personal information that we collect depends on the context of your interactions with us and the website, the choices you make, and the products and features you use. The personal information we collect can include the following:<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>Personal Information Provided by You: We collect names; phone numbers; email addresses; mailing addresses; job titles; usernames; passwords; contact preferences; contact or authentication data; billing addresses; and other similar information.<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>Payment Data: We may collect data necessary to process your payment if you make purchases, such as your payment instrument number (e.g., a credit card number), and the security code associated with your payment instrument.<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>Social Media Login Data: We may provide you with the option to register using social media account details, like your Facebook, Twitter, or other social media account.<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>3. How We Use Your Information<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We use personal information collected via our website for a variety of business purposes described below. We process your personal information for these purposes in reliance on our legitimate business interests (\\\"Business Purposes\\\"), in order to enter into or perform a contract with you (\\\"Contractual\\\"), with your consent (\\\"Consent\\\"), and\\/or for compliance with our legal obligations (\\\"Legal Reasons\\\"). We indicate the specific processing grounds we rely on next to each purpose listed below:<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>To facilitate account creation and logon process.<\\/font><\\/p><p><font>To send administrative information to you for Business Purposes, Legal Reasons, and\\/or possibly for Contractual reasons.<\\/font><\\/p><p><font>To fulfill and manage your orders for Contractual reasons.<\\/font><\\/p><p><font>To manage user accounts for Business Purposes and\\/or Contractual reasons.<\\/font><\\/p><p><font>To enforce our terms, conditions, and policies for Business Purposes and\\/or Legal Reasons.<\\/font><\\/p><p><font>To respond to legal requests and prevent harm for Legal Reasons.<\\/font><\\/p><p><font>4. Sharing Your Information<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We may process or share your data that we hold based on the following legal basis:<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>Consent: We may process your data if you have given us specific consent to use your personal information in a specific purpose.<\\/font><\\/p><p><font>Legitimate Interests: We may process your data when it is reasonably necessary to achieve our legitimate business interests.<\\/font><\\/p><p><font>Performance of a Contract: Where we have entered into a contract with you, we may process your personal information to fulfill the terms of our contract.<\\/font><\\/p><p><font>Legal Obligations: We may disclose your information where we are legally required to do so in order to comply with applicable law, governmental requests, a judicial proceeding, court order, or legal process.<\\/font><\\/p><p><font>5. Cookies and Other Tracking Technologies<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We may use cookies and similar tracking technologies to access or store information. Specific information about how we use such technologies and how you can refuse certain cookies is set out in our Cookie Policy.<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>6. Data Retention<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We will only keep your personal information for as long as it is necessary for the purposes set out in this privacy policy, unless a longer retention period is required or permitted by law (such as tax, accounting, or other legal requirements).<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>7. Data Security<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We aim to protect your personal information through a system of organizational and technical security measures. However, despite our safeguards and efforts to secure your information, no electronic transmission over the Internet or information storage technology can be guaranteed to be 100% secure.<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>8. Your Privacy Rights<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>In some regions, such as the European Economic Area (EEA), you have rights that allow you greater access to and control over your personal information. These rights may include:<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>The right to request access and obtain a copy of your personal information.<\\/font><\\/p><p><font>The right to request rectification or erasure.<\\/font><\\/p><p><font>The right to restrict the processing of your personal information.<\\/font><\\/p><p><font>The right to data portability.<\\/font><\\/p><p><font>9. Updates to This Policy<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We may update this privacy policy from time to time in order to reflect, for example, changes to our practices or for other operational, legal, or regulatory reasons.<\\/font><\\/p><div><br \\/><\\/div>\"}', NULL, 0, '2021-06-09 08:50:42', '2024-05-21 03:02:39'),
(43, 'basic', 'terms-of-service', 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<p>Terms of Service<\\/p><p><br \\/><\\/p><p>1. Introduction<\\/p><p><br \\/><\\/p><p>Welcome to Xaxino (\\\"Company\\\", \\\"we\\\", \\\"our\\\", \\\"us\\\"). These Terms of Service (\\\"Terms\\\") govern your use of our website located at [Website URL] (the \\\"Site\\\") and our services (collectively, the \\\"Services\\\"). By accessing or using the Services, you agree to be bound by these Terms. If you do not agree to these Terms, please do not use the Services.<\\/p><p><br \\/><\\/p><p>2. Use of the Services<\\/p><p><br \\/><\\/p><p>Eligibility: You must be at least 18 years old to use the Services. By using the Services, you represent and warrant that you have the legal capacity to enter into these Terms.<\\/p><p><br \\/><\\/p><p>Account Registration: To access certain features of the Services, you may need to register for an account. You agree to provide accurate, current, and complete information during the registration process and to update such information to keep it accurate, current, and complete. You are responsible for safeguarding your account credentials and for all activities that occur under your account.<\\/p><p><br \\/><\\/p><p>Prohibited Conduct: You agree not to use the Services for any unlawful purpose or in any way that could harm the Services, or any person or entity, as determined by us in our sole discretion. Prohibited conduct includes, but is not limited to:<\\/p><p><br \\/><\\/p><p>Violating any applicable laws or regulations.<\\/p><p>Infringing on the rights of others.<\\/p><p>Interfering with the security or operation of the Services.<\\/p><p>Sending spam or engaging in other disruptive or harmful activities.<\\/p><p>3. Intellectual Property<\\/p><p><br \\/><\\/p><p>All content, trademarks, service marks, logos, and other intellectual property displayed on the Services are the property of Xaxino or its licensors. You are not permitted to use these without our prior written consent.<\\/p><p><br \\/><\\/p><p>4. User Content<\\/p><p><br \\/><\\/p><p>You may be able to submit, post, or upload content to the Services (\\\"User Content\\\"). By submitting User Content, you grant Xaxino a non-exclusive, worldwide, royalty-free, perpetual, irrevocable license to use, reproduce, modify, distribute, display, and perform the User Content in connection with the Services. You represent and warrant that you have all rights necessary to grant this license.<\\/p><p><br \\/><\\/p><p>5. Termination<\\/p><p><br \\/><\\/p><p>We may terminate or suspend your access to the Services, without prior notice or liability, for any reason, including if you breach these Terms. Upon termination, your right to use the Services will immediately cease.<\\/p><p><br \\/><\\/p><p>6. Disclaimers and Limitation of Liability<\\/p><p><br \\/><\\/p><p>Disclaimer of Warranties: The Services are provided \\\"as is\\\" and \\\"as available\\\" without warranties of any kind, either express or implied. We disclaim all warranties, including any implied warranties of merchantability, fitness for a particular purpose, title, and non-infringement.<\\/p><p><br \\/><\\/p><p>Limitation of Liability: To the fullest extent permitted by law, in no event shall [Company Name], its affiliates, directors, employees, or agents be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses, resulting from (a) your use of or inability to use the Services; (b) any unauthorized access to or use of our servers and\\/or any personal information stored therein; (c) any interruption or cessation of transmission to or from the Services; (d) any bugs, viruses, trojan horses, or the like that may be transmitted to or through our Services by any third party; (e) any errors or omissions in any content or for any loss or damage incurred as a result of the use of any content posted, emailed, transmitted, or otherwise made available through the Services; and\\/or (f) the defamatory, offensive, or illegal conduct of any third party.<\\/p><p><br \\/><\\/p><p>7. Indemnification<\\/p><p><br \\/><\\/p><p>You agree to indemnify, defend, and hold harmless [Company Name], its affiliates, officers, directors, employees, and agents, from and against any and all claims, liabilities, damages, losses, costs, and expenses, including, but not limited to, reasonable legal and accounting fees, arising out of or in any way connected with your access to or use of the Services, or your violation of these Terms.<\\/p><p><br \\/><\\/p><p>8. Governing Law and Dispute Resolution<\\/p><p><br \\/><\\/p><p>These Terms shall be governed by and construed in accordance with the laws of [Your State\\/Country], without regard to its conflict of law principles. Any dispute arising out of or relating to these Terms or the Services shall be resolved through binding arbitration conducted in [Your City\\/State], except that either party may seek injunctive or other equitable relief in a court of competent jurisdiction.<\\/p><p><br \\/><\\/p><p>9. Changes to These Terms<\\/p><p><br \\/><\\/p><p>We reserve the right to modify these Terms at any time. If we make changes, we will provide notice of such changes by posting the updated Terms on the Site or through other communications. Your continued use of the Services after the changes become effective constitutes your acceptance of the new Terms.<\\/p>\"}', NULL, 0, '2021-06-09 08:51:18', '2024-05-21 03:04:33'),
(44, NULL, NULL, 'maintenance.data', '{\"description\":\"<div><h3 style=\\\"text-align: center; \\\">We\'ll Be Right Back!<\\/h3><p style=\\\"text-align: center; \\\">Sorry, we are down for maintenance but we will be back as soon as possible.<\\/p><\\/div>\",\"image\":\"664c4d013dfba1716276481.png\"}', NULL, 0, '2020-07-04 23:42:52', '2024-05-21 01:28:01'),
(45, 'basic', NULL, 'banner.content', '{\"has_image\":\"1\",\"heading\":\"Play online games and win a lot of bonuses\",\"subheading\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos error quo cum illum, alias similique, suscipit nihil tempore.\",\"button_one\":\"Sign Up\",\"button_url_one\":\"user\\/register\",\"button_two\":\"Sign In\",\"button_url_two\":\"user\\/login\",\"image\":\"6305cef1a72c51661325041.jpg\"}', NULL, 0, '2022-08-24 05:40:41', '2022-10-19 06:11:22'),
(46, 'basic', NULL, 'about.content', '{\"has_image\":\"1\",\"heading\":\"About\",\"description\":\"Maecenas sagittis turpis vel orci malesuada\",\"button\":\"Learn More\",\"button_url\":\"about-us\",\"image\":\"6305cf36ddbcf1661325110.png\"}', NULL, 0, '2022-08-24 05:41:50', '2022-09-25 07:47:59'),
(47, 'basic', NULL, 'about.element', '{\"icon\":\"<i class=\\\"las la-cogs\\\"><\\/i>\",\"title\":\"Best Platform\"}', NULL, 0, '2022-08-24 05:42:12', '2022-08-24 05:42:12'),
(48, 'basic', NULL, 'about.element', '{\"icon\":\"<i class=\\\"las la-credit-card\\\"><\\/i>\",\"title\":\"Quick Deposit\"}', NULL, 0, '2022-08-24 05:42:24', '2022-08-24 05:42:24'),
(49, 'basic', NULL, 'about.element', '{\"icon\":\"<i class=\\\"las la-cloud-download-alt\\\"><\\/i>\",\"title\":\"Quick Withdraw\"}', NULL, 0, '2022-08-24 05:42:34', '2022-08-24 05:42:34'),
(50, 'basic', NULL, 'about.element', '{\"icon\":\"<i class=\\\"las la-hands-helping\\\"><\\/i>\",\"title\":\"24\\/7 Support\"}', NULL, 0, '2022-08-24 05:42:44', '2022-08-24 05:42:44'),
(52, 'basic', NULL, 'game.content', '{\"heading\":\"Our Awesome Games\",\"subheading\":\"Dolor sit amet consectetur adipisicing elit. Ipsa, harum quidem fuga ipsam dolores odio architecto, non neque minima atque nisi temporibus ullam\"}', NULL, 0, '2022-08-24 05:43:37', '2022-08-24 05:43:37'),
(53, 'basic', NULL, 'trx_win.content', '{\"heading\":\"Latest Transactions And Winners\",\"subheading\":\"Dolor sit amet consectetur adipisicing elit. Ipsa, harum quidem fuga ipsam dolores odio architecto, non neque minima atque nisi temporibus ullam\"}', NULL, 0, '2022-08-24 05:44:18', '2022-08-24 05:44:18'),
(54, 'basic', NULL, 'why_choose_us.content', '{\"has_image\":\"1\",\"heading\":\"Why Choose Xaxino\",\"subheading\":\"Dolor sit amet consectetur adipisicing elit. Ipsa, harum quidem fuga ipsam dolores odio architecto, non neque minima atque nisi tempor\",\"image\":\"6305d01520d811661325333.jpg\"}', NULL, 0, '2022-08-24 05:45:33', '2022-08-24 05:45:33'),
(55, 'basic', NULL, 'why_choose_us.element', '{\"icon\":\"<i class=\\\"far fa-heart\\\"><\\/i>\",\"title\":\"Awesome Gaming Platform\",\"description\":\"Adipisci harum cum, ipsum nulla hic earum quidem repellat ad! At quam odio non harum minima nihil exercitationem ex, distinctio.\"}', NULL, 0, '2022-08-24 05:45:47', '2022-08-24 05:45:47'),
(56, 'basic', NULL, 'why_choose_us.element', '{\"icon\":\"<i class=\\\"fab fa-hubspot\\\"><\\/i>\",\"title\":\"Referral Commission System\",\"description\":\"Adipisci harum cum, ipsum nulla hic earum quidem repellat ad! At quam odio non harum minima nihil exercitationem ex, distinctio.\"}', NULL, 0, '2022-08-24 05:46:00', '2022-08-24 05:46:00'),
(57, 'basic', NULL, 'why_choose_us.element', '{\"icon\":\"<i class=\\\"las la-lock\\\"><\\/i>\",\"title\":\"Secure Betting Platform\",\"description\":\"Adipisci harum cum, ipsum nulla hic earum quidem repellat ad! At quam odio non harum minima nihil exercitationem ex, distinctio.\"}', NULL, 0, '2022-08-24 05:46:12', '2022-08-24 05:46:12'),
(58, 'basic', NULL, 'why_choose_us.element', '{\"icon\":\"<i class=\\\"las la-dollar-sign\\\"><\\/i>\",\"title\":\"Invest Win And Earn\",\"description\":\"Adipisci harum cum, ipsum nulla hic earum quidem repellat ad! At quam odio non harum minima nihil exercitationem ex, distinctio.\"}', NULL, 0, '2022-08-24 05:46:24', '2022-08-24 05:46:24'),
(59, 'basic', NULL, 'why_choose_us.element', '{\"icon\":\"<i class=\\\"lar la-hand-paper\\\"><\\/i>\",\"title\":\"Quick Response\",\"description\":\"Adipisci harum cum, ipsum nulla hic earum quidem repellat ad! At quam odio non harum minima nihil exercitationem ex, distinctio.\"}', NULL, 0, '2022-08-24 05:46:37', '2022-08-24 05:46:37'),
(60, 'basic', NULL, 'why_choose_us.element', '{\"icon\":\"<i class=\\\"lab la-amazon-pay\\\"><\\/i>\",\"title\":\"26+ Payment Gateway\",\"description\":\"Adipisci harum cum, ipsum nulla hic earum quidem repellat ad! At quam odio non harum minima nihil exercitationem ex, distinctio.\"}', NULL, 0, '2022-08-24 05:46:48', '2022-08-24 05:46:48'),
(61, 'basic', NULL, 'statistics.element', '{\"icon\":\"<i class=\\\"las la-users\\\"><\\/i>\",\"title\":\"Total User\",\"amount\":\"1,255,000\"}', NULL, 0, '2022-08-24 05:52:06', '2022-08-24 05:52:06'),
(62, 'basic', NULL, 'statistics.element', '{\"icon\":\"<i class=\\\"las la-trophy\\\"><\\/i>\",\"title\":\"Total Winners\",\"amount\":\"845,000\"}', NULL, 0, '2022-08-24 05:52:22', '2022-08-24 05:52:22'),
(63, 'basic', NULL, 'statistics.element', '{\"icon\":\"<i class=\\\"lar la-credit-card\\\"><\\/i>\",\"title\":\"Total Deposit\",\"amount\":\"4,845,000\"}', NULL, 0, '2022-08-24 05:52:36', '2022-08-24 05:52:37'),
(64, 'basic', NULL, 'statistics.element', '{\"icon\":\"<i class=\\\"las la-download\\\"><\\/i>\",\"title\":\"Total Withdraw\",\"amount\":\"945,000\"}', NULL, 0, '2022-08-24 05:52:48', '2022-08-24 05:52:48'),
(65, 'basic', NULL, 'faq.content', '{\"heading\":\"Frequently Asked Questions\",\"subheading\":\"Dolor sit amet consectetur adipisicing elit. Ipsa, harum quidem fuga ipsam dolores odio architecto, non neque minima atque nisi temporibus ullam\"}', NULL, 0, '2022-08-24 05:53:26', '2022-08-24 05:53:26'),
(66, 'basic', NULL, 'faq.element', '{\"question\":\"Why Xaxino?\",\"answer\":\"Donec quisque sem molestie tortor ut, libero libero interdum nec quisque, et scelerisque nam, elit lectus mauris sed maecenas. Veniam urna eget habitasse aliquam\"}', NULL, 0, '2022-08-24 05:53:34', '2022-08-24 05:53:34'),
(67, 'basic', NULL, 'faq.element', '{\"question\":\"How to prediction?\",\"answer\":\"Donec quisque sem molestie tortor ut, libero libero interdum nec quisque, et scelerisque nam, elit lectus mauris sed maecenas. Veniam urna eget habitasse aliquam\"}', NULL, 0, '2022-08-24 05:53:43', '2022-08-24 05:53:43'),
(68, 'basic', NULL, 'faq.element', '{\"question\":\"Our vission And mission?\",\"answer\":\"Donec quisque sem molestie tortor ut, libero libero interdum nec quisque, et scelerisque nam, elit lectus mauris sed maecenas. Veniam urna eget habitasse aliquam\"}', NULL, 0, '2022-08-24 05:53:52', '2022-08-24 05:53:52'),
(69, 'basic', NULL, 'faq.element', '{\"question\":\"Why Xaxino?\",\"answer\":\"Donec quisque sem molestie tortor ut, libero libero interdum nec quisque, et scelerisque nam, elit lectus mauris sed maecenas. Veniam urna eget habitasse aliquam\"}', NULL, 0, '2022-08-24 05:54:02', '2022-08-24 05:54:02'),
(70, 'basic', NULL, 'faq.element', '{\"question\":\"How to prediction?\",\"answer\":\"Donec quisque sem molestie tortor ut, libero libero interdum nec quisque, et scelerisque nam, elit lectus mauris sed maecenas. Veniam urna eget habitasse aliquam\"}', NULL, 0, '2022-08-24 05:54:15', '2022-08-24 05:54:15'),
(71, 'basic', NULL, 'faq.element', '{\"question\":\"Our vission And mission?\",\"answer\":\"Donec quisque sem molestie tortor ut, libero libero interdum nec quisque, et scelerisque nam, elit lectus mauris sed maecenas. Veniam urna eget habitasse aliquam\"}', NULL, 0, '2022-08-24 05:54:23', '2022-08-24 05:54:23'),
(72, 'basic', NULL, 'faq.element', '{\"question\":\"Our vission And mission?\",\"answer\":\"Donec quisque sem molestie tortor ut, libero libero interdum nec quisque, et scelerisque nam, elit lectus mauris sed maecenas. Veniam urna eget habitasse aliquam\"}', NULL, 0, '2022-08-24 05:54:31', '2022-08-24 05:54:31'),
(73, 'basic', NULL, 'faq.element', '{\"question\":\"How to predict?\",\"answer\":\"Donec quisque sem molestie tortor ut, libero libero interdum nec quisque, et scelerisque nam, elit lectus mauris sed maecenas. Veniam urna eget habitasse aliquam\"}', NULL, 0, '2022-08-24 05:54:38', '2022-08-24 05:54:38'),
(74, 'basic', NULL, 'how_work.content', '{\"heading\":\"How Work Xaxino\"}', NULL, 0, '2022-08-24 05:56:32', '2022-08-24 05:56:32'),
(75, 'basic', NULL, 'how_work.element', '{\"icon\":\"<i class=\\\"las la-trophy\\\"><\\/i>\",\"title\":\"Win Lottery!\",\"description\":\"Amet odit iure eaeos autiste perferendis numquam sint excepturi.\"}', NULL, 0, '2022-08-24 05:56:43', '2022-08-24 05:56:43'),
(76, 'basic', NULL, 'how_work.element', '{\"icon\":\"<i class=\\\"las la-check-circle\\\"><\\/i>\",\"title\":\"Confirm Lottery\",\"description\":\"Amet odit iure eaeos autiste perferendis numquam sint excepturi.\"}', NULL, 0, '2022-08-24 05:56:54', '2022-08-24 05:56:54'),
(77, 'basic', NULL, 'how_work.element', '{\"icon\":\"<i class=\\\"las la-hand-pointer\\\"><\\/i>\",\"title\":\"Pick Number\",\"description\":\"Amet odit iure eaeos autiste perferendis numquam sint excepturi.\"}', NULL, 0, '2022-08-24 05:57:06', '2022-08-24 05:57:06'),
(78, 'basic', NULL, 'how_work.element', '{\"icon\":\"<i class=\\\"las la-check-square\\\"><\\/i>\",\"title\":\"Choose Lottery\",\"description\":\"Amet odit iure eaeos autiste perferendis numquam sint excepturi.\"}', NULL, 0, '2022-08-24 05:57:19', '2022-08-24 05:57:19'),
(79, 'basic', NULL, 'cta.content', '{\"has_image\":\"1\",\"heading\":\"Buy ticket and get million dollars for a click\",\"button\":\"Play Now\",\"button_url\":\"games\",\"image\":\"6305d32481af81661326116.jpg\"}', NULL, 0, '2022-08-24 05:58:36', '2022-09-03 07:19:55'),
(80, 'basic', NULL, 'referral.content', '{\"has_image\":\"1\",\"heading\":\"15% Referral Commission\",\"description\":\"<p style=\\\"margin-right:0px;margin-left:0px;font-size:16px;color:rgba(255,255,255,0.7);font-family:\'Open Sans\', sans-serif;background-color:rgb(6,3,34);\\\">Lorem\\r\\n ipsum dolor sit amet consectetur adipisicing elit. Reiciendis omnis \\r\\nrecusandae non quos aspernatur? Quisquam excepturi nobis laborum minima \\r\\nrecusandae, quidem voluptas, iusto fuga animi omnis eius eos assumenda \\r\\ndolore ipsum adipisci, iure aliquam exercitationem qui aliquid aperiam \\r\\ndolorum voluptate? Esse corrupti quia voluptatum minima natus voluptas \\r\\naspernatur quisquam id.<\\/p><p style=\\\"margin-right:0px;margin-left:0px;color:rgba(255,255,255,0.85);font-family:Roboto, sans-serif;font-size:16px;background-color:rgb(2,12,37);\\\"><\\/p><ul class=\\\"cmn-list\\\" style=\\\"margin-top:20px;color:rgba(255,255,255,0.85);font-family:Roboto, sans-serif;background-color:rgb(2,12,37);\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;padding-left:40px;\\\">10% Bibendum purus feugiat at, dolor convallis auctor congue Aliquam urna et neque nulla proin<\\/li><li style=\\\"margin-top:15px;margin-right:0px;margin-left:0px;padding-left:40px;\\\">03% Magnis faucibus amet irure metus, adipiscing ultricies elit interdum odio vel nibh.<\\/li><li style=\\\"margin-top:15px;margin-right:0px;margin-left:0px;padding-left:40px;\\\">02% Magnis faucibus amet irure metus, adipiscing ultricies elit interdu<\\/li><\\/ul>\",\"image\":\"6305d36b4f7971661326187.png\"}', NULL, 0, '2022-08-24 05:59:47', '2022-08-24 05:59:47'),
(81, 'basic', NULL, 'testimonial.content', '{\"heading\":\"What User Say About Xaxino\"}', NULL, 0, '2022-08-24 06:00:21', '2022-08-24 06:00:21'),
(82, 'basic', NULL, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Auyesha Hatun\",\"quote\":\"Doloribus porro nobis in provident rem eum reandae quasi voluptatum, quibusdam et itaque tenetur quos alias quo harum officiis quis vero. Enim omnis porro, cupiditate repellat harum et eius distinctio neque dolorem expedita obcaecati commodi.\",\"image\":\"6305d39d9015f1661326237.jpg\"}', NULL, 0, '2022-08-24 06:00:37', '2022-08-24 06:00:37'),
(83, 'basic', NULL, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Raba Khan\",\"quote\":\"Doloribus porro nobis in provident rem eum reandae quasi voluptatum, quibusdam et itaque tenetur quos alias quo harum officiis quis vero. Enim omnis porro, cupiditate repellat harum et eius distinctio neque dolorem expedita obcaecati commodi.\",\"image\":\"6305d3aa9b8261661326250.jpg\"}', NULL, 0, '2022-08-24 06:00:50', '2022-08-24 06:00:50'),
(84, 'basic', NULL, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Shunil Bhat\",\"quote\":\"Doloribus porro nobis in provident rem eum reandae quasi voluptatum, quibusdam et itaque tenetur quos alias quo harum officiis quis vero. Enim omnis porro, cupiditate repellat harum et eius distinctio neque dolorem expedita obcaecati commodi.\",\"image\":\"6305d3b9248db1661326265.jpg\"}', NULL, 0, '2022-08-24 06:01:05', '2022-08-24 06:01:05'),
(85, 'basic', NULL, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Raziya Khanam\",\"quote\":\"Doloribus porro nobis in provident rem eum reandae quasi voluptatum, quibusdam et itaque tenetur quos alias quo harum officiis quis vero. Enim omnis porro, cupiditate repellat harum et eius distinctio neque dolorem expedita obcaecati commodi.\",\"image\":\"6305d3c84dc131661326280.jpg\"}', NULL, 0, '2022-08-24 06:01:20', '2022-08-24 06:01:20'),
(86, 'basic', NULL, 'payment_method.content', '{\"heading\":\"We accept 21+ payment methods\"}', NULL, 0, '2022-08-24 06:01:53', '2022-08-24 06:01:53'),
(87, 'basic', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"6305d3f9179791661326329.png\"}', NULL, 0, '2022-08-24 06:02:09', '2022-08-24 06:02:09'),
(88, 'basic', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"6305d3ff200c91661326335.png\"}', NULL, 0, '2022-08-24 06:02:15', '2022-08-24 06:02:15'),
(89, 'basic', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"6305d40c7367b1661326348.png\"}', NULL, 0, '2022-08-24 06:02:28', '2022-08-24 06:02:28'),
(90, 'basic', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"6305d415136441661326357.png\"}', NULL, 0, '2022-08-24 06:02:37', '2022-08-24 06:02:37'),
(91, 'basic', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"6305d41c12b091661326364.png\"}', NULL, 0, '2022-08-24 06:02:44', '2022-08-24 06:02:44'),
(92, 'basic', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"6305d4214a6f11661326369.png\"}', NULL, 0, '2022-08-24 06:02:49', '2022-08-24 06:02:49'),
(93, 'basic', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"6305d426e29921661326374.png\"}', NULL, 0, '2022-08-24 06:02:54', '2022-08-24 06:02:54'),
(94, 'basic', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"6305d42ca68b61661326380.png\"}', NULL, 0, '2022-08-24 06:03:00', '2022-08-24 06:03:00'),
(95, 'basic', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"6305d433a7d4e1661326387.png\"}', NULL, 0, '2022-08-24 06:03:07', '2022-08-24 06:03:07'),
(96, 'basic', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"6305d43cd9bed1661326396.png\"}', NULL, 0, '2022-08-24 06:03:16', '2022-08-24 06:03:16'),
(97, 'basic', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"6305d44335e851661326403.png\"}', NULL, 0, '2022-08-24 06:03:23', '2022-08-24 06:03:23'),
(98, 'basic', NULL, 'blog.content', '{\"heading\":\"Our Blog News\",\"subheading\":\"Dolor sit amet consectetur adipisicing elit. Ipsa, harum quidem fuga ipsam dolores odio architecto, non neque minima atque nisi temporibus ullam\"}', NULL, 0, '2022-08-24 07:03:26', '2022-08-24 07:03:26'),
(99, 'basic', 'suspendisse-faucibus-nunc-et-pellentesque-egestas', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Suspendisse faucibus, nunc et pellentesque egestas\",\"description\":\"<p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Pellentesque\\r\\n magna vel fermentum, libero nulla fermentum integer elit ut maecenas, \\r\\ndiam suspendisse lectus, felis elit cras sint orci. Neque sit donec \\r\\narcu, ornare odio pulvinar ante aliquam, luctus ac ut justo sapien orci \\r\\na, eros blan proin vehicula morbi. Sed dui ut odio tristique, \\r\\nsuspendisse sapien laoreet, placerat lectus ornare placerat, libero ac \\r\\nsapien tincidunt consectetuer, vestibulum vivamus at nonummy sem. Nunc \\r\\nconvallis ornare non eget vitae, lectus pleradibus molestie, egestas \\r\\namet vestibulum ac faucibus mi, ultricies atque ornare malesuada morbi \\r\\nparturient, donec tempus suspendisse scelerisque phasellus. Porttitor \\r\\nultricies porttitor lacus arcu ultricies vitae, tempor mattis arcu sed \\r\\nviverra arcu natus, in wisi wisi dictum commodo erat justo, volutpat \\r\\nelit iaculis. Sit vel mauris nec magna odio. Et vel lobortis et. Aliquam\\r\\n enim felis turpis quis magnis consectetuer, tristique justo pulvinar mi\\r\\n libero maxime lectus. In massa semper reiciendis nulla a ante, quis \\r\\nvel, cras morbi sed.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Malesuada\\r\\n massa nibh interdum vel, adipiscing amet, vestibulum pede, nec ut vitae\\r\\n eros volutpat cras. Sed venenatis hymenaeos vestibulum at magna, ipsa \\r\\nmollis posuere ante lorem, sed erat, pulvinar vestibulum. Litora \\r\\npraesent duis eu amet at. Interdum urna eu malesuada vestibulum \\r\\ncurabitur velit, wisi vitae. Nulla sem. Mauris venenatis a vivamus sit, \\r\\negestas magna commodo vestibulum amet libero.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Turpis\\r\\n fusce dui, sed dui donec pharetra, integer imperdiet molestie \\r\\ntristique. Eros non et consectetuer sem, saepe nec nunc, feugiat ut \\r\\ntortor cras senectus fusce, euismod etiam mollis pharetra, commodo \\r\\ninceptos arcu aliquam lormet dui sit rutrum feugiat vivamus, integer \\r\\nleo. Hac eu urna eleifend quisque, at urna. Urna vel cras, pulvinar a \\r\\nnam leo gravida pede curabitur. Id justo dignissim pellentesque at, amet\\r\\n odit fusce, sit rutrum justo. Ornare nec nunc nibh consectetuer, \\r\\nullamcorper montes sociis. Etiam luctus porta velit, sed pellentesque \\r\\nmetus commodo<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Enim\\r\\n malesuada massa nibh interdum vel, adipiscing amet, vestibulum pede, \\r\\nnec ut vitae eros volutpat crasSeivenatis hymenaeos vestibulum at magna,\\r\\n ipsa mollis posuere ante lorem, sed erat, pulvinar vestibulum. Litora \\r\\npesent duis eu amet at. Interdum urna eu malesuada vestibulum curabitur \\r\\nvelit, wisi vitae. Nulla sem. Mauris venenatis a vivamus sit, egestas \\r\\nmagna commodo vestibulum, amet libero. commodo erat justo, volutpat elit\\r\\n iaculis. Sit vel mauris nec magna odio. Et vel lobortis et. Aliquam \\r\\nenim felis turpis quis magnis consectetuer, tristique justo pulvinar mi \\r\\nlibero maxime lectus. In massa semper reiciendis nulla a ante quis \\r\\nvelcras morbi sed.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Feugiat\\r\\n nibh, dis magna fusce turpis ut ante quam, ante neque non condimentum \\r\\nnec montes, enim vitae interdum. Id elementum enim volutpat pharetra \\r\\nerat sapien. Penatibus tincidunt praesent fringilla, dui eget in \\r\\ntristique nam nullam feugiat, sit auctor integer arcu risus. Aliquam \\r\\ninterdum nulla vestibulum sit, molestie elit eros mi, at nunc eget \\r\\nposuere duis. Gravida cum sit, nam nibh interdum nulla, suspendisse \\r\\nadipiscing fusce wisi. Curabitur ac non aptent volutpat nascetur sed, \\r\\nodio iaculis placerat, neque integer. Sagittis mauris egestas consequat \\r\\nsunt cras, sapien ac nunc magnis nisl, sed mi integer in. Accumsan dui, \\r\\nerat tristique tristique vitae mi augue.<\\/p>\",\"image\":\"630600f0daf711661337840.jpg\"}', NULL, 232, '2022-08-24 07:05:20', '2024-05-21 00:43:10'),
(100, 'basic', 'aenean-leo-ligula-porttitor-eu-consequat-vitae-eleifend-ac-enim', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim\",\"description\":\"<p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Pellentesque\\r\\n magna vel fermentum, libero nulla fermentum integer elit ut maecenas, \\r\\ndiam suspendisse lectus, felis elit cras sint orci. Neque sit donec \\r\\narcu, ornare odio pulvinar ante aliquam, luctus ac ut justo sapien orci \\r\\na, eros blan proin vehicula morbi. Sed dui ut odio tristique, \\r\\nsuspendisse sapien laoreet, placerat lectus ornare placerat, libero ac \\r\\nsapien tincidunt consectetuer, vestibulum vivamus at nonummy sem. Nunc \\r\\nconvallis ornare non eget vitae, lectus pleradibus molestie, egestas \\r\\namet vestibulum ac faucibus mi, ultricies atque ornare malesuada morbi \\r\\nparturient, donec tempus suspendisse scelerisque phasellus. Porttitor \\r\\nultricies porttitor lacus arcu ultricies vitae, tempor mattis arcu sed \\r\\nviverra arcu natus, in wisi wisi dictum commodo erat justo, volutpat \\r\\nelit iaculis. Sit vel mauris nec magna odio. Et vel lobortis et. Aliquam\\r\\n enim felis turpis quis magnis consectetuer, tristique justo pulvinar mi\\r\\n libero maxime lectus. In massa semper reiciendis nulla a ante, quis \\r\\nvel, cras morbi sed.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Malesuada\\r\\n massa nibh interdum vel, adipiscing amet, vestibulum pede, nec ut vitae\\r\\n eros volutpat cras. Sed venenatis hymenaeos vestibulum at magna, ipsa \\r\\nmollis posuere ante lorem, sed erat, pulvinar vestibulum. Litora \\r\\npraesent duis eu amet at. Interdum urna eu malesuada vestibulum \\r\\ncurabitur velit, wisi vitae. Nulla sem. Mauris venenatis a vivamus sit, \\r\\negestas magna commodo vestibulum amet libero.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Turpis\\r\\n fusce dui, sed dui donec pharetra, integer imperdiet molestie \\r\\ntristique. Eros non et consectetuer sem, saepe nec nunc, feugiat ut \\r\\ntortor cras senectus fusce, euismod etiam mollis pharetra, commodo \\r\\ninceptos arcu aliquam lormet dui sit rutrum feugiat vivamus, integer \\r\\nleo. Hac eu urna eleifend quisque, at urna. Urna vel cras, pulvinar a \\r\\nnam leo gravida pede curabitur. Id justo dignissim pellentesque at, amet\\r\\n odit fusce, sit rutrum justo. Ornare nec nunc nibh consectetuer, \\r\\nullamcorper montes sociis. Etiam luctus porta velit, sed pellentesque \\r\\nmetus commodo<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Enim\\r\\n malesuada massa nibh interdum vel, adipiscing amet, vestibulum pede, \\r\\nnec ut vitae eros volutpat crasSeivenatis hymenaeos vestibulum at magna,\\r\\n ipsa mollis posuere ante lorem, sed erat, pulvinar vestibulum. Litora \\r\\npesent duis eu amet at. Interdum urna eu malesuada vestibulum curabitur \\r\\nvelit, wisi vitae. Nulla sem. Mauris venenatis a vivamus sit, egestas \\r\\nmagna commodo vestibulum, amet libero. commodo erat justo, volutpat elit\\r\\n iaculis. Sit vel mauris nec magna odio. Et vel lobortis et. Aliquam \\r\\nenim felis turpis quis magnis consectetuer, tristique justo pulvinar mi \\r\\nlibero maxime lectus. In massa semper reiciendis nulla a ante quis \\r\\nvelcras morbi sed.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Feugiat\\r\\n nibh, dis magna fusce turpis ut ante quam, ante neque non condimentum \\r\\nnec montes, enim vitae interdum. Id elementum enim volutpat pharetra \\r\\nerat sapien. Penatibus tincidunt praesent fringilla, dui eget in \\r\\ntristique nam nullam feugiat, sit auctor integer arcu risus. Aliquam \\r\\ninterdum nulla vestibulum sit, molestie elit eros mi, at nunc eget \\r\\nposuere duis. Gravida cum sit, nam nibh interdum nulla, suspendisse \\r\\nadipiscing fusce wisi. Curabitur ac non aptent volutpat nascetur sed, \\r\\nodio iaculis placerat, neque integer. Sagittis mauris egestas consequat \\r\\nsunt cras, sapien ac nunc magnis nisl, sed mi integer in. Accumsan dui, \\r\\nerat tristique tristique vitae mi augue.<\\/p>\",\"image\":\"630600fc05c8a1661337852.jpg\"}', NULL, 274, '2022-08-24 07:05:44', '2024-05-21 00:42:50'),
(101, 'basic', 'pellentesque-posuere-vivamus-in-erat-ut-urna-cursus-vestibulum', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Pellentesque posuere. Vivamus in erat ut urna cursus vestibulum.\",\"description\":\"<p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Pellentesque\\r\\n magna vel fermentum, libero nulla fermentum integer elit ut maecenas, \\r\\ndiam suspendisse lectus, felis elit cras sint orci. Neque sit donec \\r\\narcu, ornare odio pulvinar ante aliquam, luctus ac ut justo sapien orci \\r\\na, eros blan proin vehicula morbi. Sed dui ut odio tristique, \\r\\nsuspendisse sapien laoreet, placerat lectus ornare placerat, libero ac \\r\\nsapien tincidunt consectetuer, vestibulum vivamus at nonummy sem. Nunc \\r\\nconvallis ornare non eget vitae, lectus pleradibus molestie, egestas \\r\\namet vestibulum ac faucibus mi, ultricies atque ornare malesuada morbi \\r\\nparturient, donec tempus suspendisse scelerisque phasellus. Porttitor \\r\\nultricies porttitor lacus arcu ultricies vitae, tempor mattis arcu sed \\r\\nviverra arcu natus, in wisi wisi dictum commodo erat justo, volutpat \\r\\nelit iaculis. Sit vel mauris nec magna odio. Et vel lobortis et. Aliquam\\r\\n enim felis turpis quis magnis consectetuer, tristique justo pulvinar mi\\r\\n libero maxime lectus. In massa semper reiciendis nulla a ante, quis \\r\\nvel, cras morbi sed.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Malesuada\\r\\n massa nibh interdum vel, adipiscing amet, vestibulum pede, nec ut vitae\\r\\n eros volutpat cras. Sed venenatis hymenaeos vestibulum at magna, ipsa \\r\\nmollis posuere ante lorem, sed erat, pulvinar vestibulum. Litora \\r\\npraesent duis eu amet at. Interdum urna eu malesuada vestibulum \\r\\ncurabitur velit, wisi vitae. Nulla sem. Mauris venenatis a vivamus sit, \\r\\negestas magna commodo vestibulum amet libero.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Turpis\\r\\n fusce dui, sed dui donec pharetra, integer imperdiet molestie \\r\\ntristique. Eros non et consectetuer sem, saepe nec nunc, feugiat ut \\r\\ntortor cras senectus fusce, euismod etiam mollis pharetra, commodo \\r\\ninceptos arcu aliquam lormet dui sit rutrum feugiat vivamus, integer \\r\\nleo. Hac eu urna eleifend quisque, at urna. Urna vel cras, pulvinar a \\r\\nnam leo gravida pede curabitur. Id justo dignissim pellentesque at, amet\\r\\n odit fusce, sit rutrum justo. Ornare nec nunc nibh consectetuer, \\r\\nullamcorper montes sociis. Etiam luctus porta velit, sed pellentesque \\r\\nmetus commodo<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Enim\\r\\n malesuada massa nibh interdum vel, adipiscing amet, vestibulum pede, \\r\\nnec ut vitae eros volutpat crasSeivenatis hymenaeos vestibulum at magna,\\r\\n ipsa mollis posuere ante lorem, sed erat, pulvinar vestibulum. Litora \\r\\npesent duis eu amet at. Interdum urna eu malesuada vestibulum curabitur \\r\\nvelit, wisi vitae. Nulla sem. Mauris venenatis a vivamus sit, egestas \\r\\nmagna commodo vestibulum, amet libero. commodo erat justo, volutpat elit\\r\\n iaculis. Sit vel mauris nec magna odio. Et vel lobortis et. Aliquam \\r\\nenim felis turpis quis magnis consectetuer, tristique justo pulvinar mi \\r\\nlibero maxime lectus. In massa semper reiciendis nulla a ante quis \\r\\nvelcras morbi sed.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Feugiat\\r\\n nibh, dis magna fusce turpis ut ante quam, ante neque non condimentum \\r\\nnec montes, enim vitae interdum. Id elementum enim volutpat pharetra \\r\\nerat sapien. Penatibus tincidunt praesent fringilla, dui eget in \\r\\ntristique nam nullam feugiat, sit auctor integer arcu risus. Aliquam \\r\\ninterdum nulla vestibulum sit, molestie elit eros mi, at nunc eget \\r\\nposuere duis. Gravida cum sit, nam nibh interdum nulla, suspendisse \\r\\nadipiscing fusce wisi. Curabitur ac non aptent volutpat nascetur sed, \\r\\nodio iaculis placerat, neque integer. Sagittis mauris egestas consequat \\r\\nsunt cras, sapien ac nunc magnis nisl, sed mi integer in. Accumsan dui, \\r\\nerat tristique tristique vitae mi augue.<\\/p>\",\"image\":\"6306010648eec1661337862.jpg\"}', NULL, 245, '2022-08-24 07:06:08', '2024-05-21 00:42:35'),
(102, 'basic', 'curabitur-at-lacus-ac-velit-ornare-lobortis-phasellus-blandit-leo-ut-odio', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Curabitur at lacus ac velit ornare lobortis. Phasellus blandit leo ut odio.\",\"description\":\"<p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Pellentesque\\r\\n magna vel fermentum, libero nulla fermentum integer elit ut maecenas, \\r\\ndiam suspendisse lectus, felis elit cras sint orci. Neque sit donec \\r\\narcu, ornare odio pulvinar ante aliquam, luctus ac ut justo sapien orci \\r\\na, eros blan proin vehicula morbi. Sed dui ut odio tristique, \\r\\nsuspendisse sapien laoreet, placerat lectus ornare placerat, libero ac \\r\\nsapien tincidunt consectetuer, vestibulum vivamus at nonummy sem. Nunc \\r\\nconvallis ornare non eget vitae, lectus pleradibus molestie, egestas \\r\\namet vestibulum ac faucibus mi, ultricies atque ornare malesuada morbi \\r\\nparturient, donec tempus suspendisse scelerisque phasellus. Porttitor \\r\\nultricies porttitor lacus arcu ultricies vitae, tempor mattis arcu sed \\r\\nviverra arcu natus, in wisi wisi dictum commodo erat justo, volutpat \\r\\nelit iaculis. Sit vel mauris nec magna odio. Et vel lobortis et. Aliquam\\r\\n enim felis turpis quis magnis consectetuer, tristique justo pulvinar mi\\r\\n libero maxime lectus. In massa semper reiciendis nulla a ante, quis \\r\\nvel, cras morbi sed.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Malesuada\\r\\n massa nibh interdum vel, adipiscing amet, vestibulum pede, nec ut vitae\\r\\n eros volutpat cras. Sed venenatis hymenaeos vestibulum at magna, ipsa \\r\\nmollis posuere ante lorem, sed erat, pulvinar vestibulum. Litora \\r\\npraesent duis eu amet at. Interdum urna eu malesuada vestibulum \\r\\ncurabitur velit, wisi vitae. Nulla sem. Mauris venenatis a vivamus sit, \\r\\negestas magna commodo vestibulum amet libero.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Turpis\\r\\n fusce dui, sed dui donec pharetra, integer imperdiet molestie \\r\\ntristique. Eros non et consectetuer sem, saepe nec nunc, feugiat ut \\r\\ntortor cras senectus fusce, euismod etiam mollis pharetra, commodo \\r\\ninceptos arcu aliquam lormet dui sit rutrum feugiat vivamus, integer \\r\\nleo. Hac eu urna eleifend quisque, at urna. Urna vel cras, pulvinar a \\r\\nnam leo gravida pede curabitur. Id justo dignissim pellentesque at, amet\\r\\n odit fusce, sit rutrum justo. Ornare nec nunc nibh consectetuer, \\r\\nullamcorper montes sociis. Etiam luctus porta velit, sed pellentesque \\r\\nmetus commodo<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Enim\\r\\n malesuada massa nibh interdum vel, adipiscing amet, vestibulum pede, \\r\\nnec ut vitae eros volutpat crasSeivenatis hymenaeos vestibulum at magna,\\r\\n ipsa mollis posuere ante lorem, sed erat, pulvinar vestibulum. Litora \\r\\npesent duis eu amet at. Interdum urna eu malesuada vestibulum curabitur \\r\\nvelit, wisi vitae. Nulla sem. Mauris venenatis a vivamus sit, egestas \\r\\nmagna commodo vestibulum, amet libero. commodo erat justo, volutpat elit\\r\\n iaculis. Sit vel mauris nec magna odio. Et vel lobortis et. Aliquam \\r\\nenim felis turpis quis magnis consectetuer, tristique justo pulvinar mi \\r\\nlibero maxime lectus. In massa semper reiciendis nulla a ante quis \\r\\nvelcras morbi sed.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Feugiat\\r\\n nibh, dis magna fusce turpis ut ante quam, ante neque non condimentum \\r\\nnec montes, enim vitae interdum. Id elementum enim volutpat pharetra \\r\\nerat sapien. Penatibus tincidunt praesent fringilla, dui eget in \\r\\ntristique nam nullam feugiat, sit auctor integer arcu risus. Aliquam \\r\\ninterdum nulla vestibulum sit, molestie elit eros mi, at nunc eget \\r\\nposuere duis. Gravida cum sit, nam nibh interdum nulla, suspendisse \\r\\nadipiscing fusce wisi. Curabitur ac non aptent volutpat nascetur sed, \\r\\nodio iaculis placerat, neque integer. Sagittis mauris egestas consequat \\r\\nsunt cras, sapien ac nunc magnis nisl, sed mi integer in. Accumsan dui, \\r\\nerat tristique tristique vitae mi augue.<\\/p>\",\"image\":\"63060112437731661337874.jpg\"}', NULL, 472, '2022-08-24 07:06:28', '2024-05-21 00:42:24');
INSERT INTO `frontends` (`id`, `tempname`, `slug`, `data_keys`, `data_values`, `seo_content`, `views`, `created_at`, `updated_at`) VALUES
(103, 'basic', 'sed-aliquam-ultrices-mauris-proin-viverra-ligula-sit-amet-ultrices-semper', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Sed aliquam ultrices mauris. Proin viverra, ligula sit amet ultrices semper\",\"description\":\"<p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Pellentesque\\r\\n magna vel fermentum, libero nulla fermentum integer elit ut maecenas, \\r\\ndiam suspendisse lectus, felis elit cras sint orci. Neque sit donec \\r\\narcu, ornare odio pulvinar ante aliquam, luctus ac ut justo sapien orci \\r\\na, eros blan proin vehicula morbi. Sed dui ut odio tristique, \\r\\nsuspendisse sapien laoreet, placerat lectus ornare placerat, libero ac \\r\\nsapien tincidunt consectetuer, vestibulum vivamus at nonummy sem. Nunc \\r\\nconvallis ornare non eget vitae, lectus pleradibus molestie, egestas \\r\\namet vestibulum ac faucibus mi, ultricies atque ornare malesuada morbi \\r\\nparturient, donec tempus suspendisse scelerisque phasellus. Porttitor \\r\\nultricies porttitor lacus arcu ultricies vitae, tempor mattis arcu sed \\r\\nviverra arcu natus, in wisi wisi dictum commodo erat justo, volutpat \\r\\nelit iaculis. Sit vel mauris nec magna odio. Et vel lobortis et. Aliquam\\r\\n enim felis turpis quis magnis consectetuer, tristique justo pulvinar mi\\r\\n libero maxime lectus. In massa semper reiciendis nulla a ante, quis \\r\\nvel, cras morbi sed.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Malesuada\\r\\n massa nibh interdum vel, adipiscing amet, vestibulum pede, nec ut vitae\\r\\n eros volutpat cras. Sed venenatis hymenaeos vestibulum at magna, ipsa \\r\\nmollis posuere ante lorem, sed erat, pulvinar vestibulum. Litora \\r\\npraesent duis eu amet at. Interdum urna eu malesuada vestibulum \\r\\ncurabitur velit, wisi vitae. Nulla sem. Mauris venenatis a vivamus sit, \\r\\negestas magna commodo vestibulum amet libero.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Turpis\\r\\n fusce dui, sed dui donec pharetra, integer imperdiet molestie \\r\\ntristique. Eros non et consectetuer sem, saepe nec nunc, feugiat ut \\r\\ntortor cras senectus fusce, euismod etiam mollis pharetra, commodo \\r\\ninceptos arcu aliquam lormet dui sit rutrum feugiat vivamus, integer \\r\\nleo. Hac eu urna eleifend quisque, at urna. Urna vel cras, pulvinar a \\r\\nnam leo gravida pede curabitur. Id justo dignissim pellentesque at, amet\\r\\n odit fusce, sit rutrum justo. Ornare nec nunc nibh consectetuer, \\r\\nullamcorper montes sociis. Etiam luctus porta velit, sed pellentesque \\r\\nmetus commod<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Enim\\r\\n malesuada massa nibh interdum vel, adipiscing amet, vestibulum pede, \\r\\nnec ut vitae eros volutpat crasSeivenatis hymenaeos vestibulum at magna,\\r\\n ipsa mollis posuere ante lorem, sed erat, pulvinar vestibulum. Litora \\r\\npesent duis eu amet at. Interdum urna eu malesuada vestibulum curabitur \\r\\nvelit, wisi vitae. Nulla sem. Mauris venenatis a vivamus sit, egestas \\r\\nmagna commodo vestibulum, amet libero. commodo erat justo, volutpat elit\\r\\n iaculis. Sit vel mauris nec magna odio. Et vel lobortis et. Aliquam \\r\\nenim felis turpis quis magnis consectetuer, tristique justo pulvinar mi \\r\\nlibero maxime lectus. In massa semper reiciendis nulla a ante quis \\r\\nvelcras morbi sed.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Feugiat\\r\\n nibh, dis magna fusce turpis ut ante quam, ante neque non condimentum \\r\\nnec montes, enim vitae interdum. Id elementum enim volutpat pharetra \\r\\nerat sapien. Penatibus tincidunt praesent fringilla, dui eget in \\r\\ntristique nam nullam feugiat, sit auctor integer arcu risus. Aliquam \\r\\ninterdum nulla vestibulum sit, molestie elit eros mi, at nunc eget \\r\\nposuere duis. Gravida cum sit, nam nibh interdum nulla, suspendisse \\r\\nadipiscing fusce wisi. Curabitur ac non aptent volutpat nascetur sed, \\r\\nodio iaculis placerat, neque integer. Sagittis mauris egestas consequat \\r\\nsunt cras, sapien ac nunc magnis nisl, sed mi integer in. Accumsan dui, \\r\\nerat tristique tristique vitae mi augue.<\\/p>\",\"image\":\"6306011c5afd11661337884.jpg\"}', NULL, 519, '2022-08-24 07:06:51', '2024-05-21 00:42:12'),
(104, 'basic', 'cras-sagittis-in-ut-quam-vitae-odio-lacinia-tincidunt', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Cras sagittis. In ut quam vitae odio lacinia tincidunt.\",\"description\":\"<p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Pellentesque\\r\\n magna vel fermentum, libero nulla fermentum integer elit ut maecenas, \\r\\ndiam suspendisse lectus, felis elit cras sint orci. Neque sit donec \\r\\narcu, ornare odio pulvinar ante aliquam, luctus ac ut justo sapien orci \\r\\na, eros blan proin vehicula morbi. Sed dui ut odio tristique, \\r\\nsuspendisse sapien laoreet, placerat lectus ornare placerat, libero ac \\r\\nsapien tincidunt consectetuer, vestibulum vivamus at nonummy sem. Nunc \\r\\nconvallis ornare non eget vitae, lectus pleradibus molestie, egestas \\r\\namet vestibulum ac faucibus mi, ultricies atque ornare malesuada morbi \\r\\nparturient, donec tempus suspendisse scelerisque phasellus. Porttitor \\r\\nultricies porttitor lacus arcu ultricies vitae, tempor mattis arcu sed \\r\\nviverra arcu natus, in wisi wisi dictum commodo erat justo, volutpat \\r\\nelit iaculis. Sit vel mauris nec magna odio. Et vel lobortis et. Aliquam\\r\\n enim felis turpis quis magnis consectetuer, tristique justo pulvinar mi\\r\\n libero maxime lectus. In massa semper reiciendis nulla a ante, quis \\r\\nvel, cras morbi sed.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Malesuada\\r\\n massa nibh interdum vel, adipiscing amet, vestibulum pede, nec ut vitae\\r\\n eros volutpat cras. Sed venenatis hymenaeos vestibulum at magna, ipsa \\r\\nmollis posuere ante lorem, sed erat, pulvinar vestibulum. Litora \\r\\npraesent duis eu amet at. Interdum urna eu malesuada vestibulum \\r\\ncurabitur velit, wisi vitae. Nulla sem. Mauris venenatis a vivamus sit, \\r\\negestas magna commodo vestibulum amet libero.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Turpis\\r\\n fusce dui, sed dui donec pharetra, integer imperdiet molestie \\r\\ntristique. Eros non et consectetuer sem, saepe nec nunc, feugiat ut \\r\\ntortor cras senectus fusce, euismod etiam mollis pharetra, commodo \\r\\ninceptos arcu aliquam lormet dui sit rutrum feugiat vivamus, integer \\r\\nleo. Hac eu urna eleifend quisque, at urna. Urna vel cras, pulvinar a \\r\\nnam leo gravida pede curabitur. Id justo dignissim pellentesque at, amet\\r\\n odit fusce, sit rutrum justo. Ornare nec nunc nibh consectetuer, \\r\\nullamcorper montes sociis. Etiam luctus porta velit, sed pellentesque \\r\\nmetus commodo<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Enim\\r\\n malesuada massa nibh interdum vel, adipiscing amet, vestibulum pede, \\r\\nnec ut vitae eros volutpat crasSeivenatis hymenaeos vestibulum at magna,\\r\\n ipsa mollis posuere ante lorem, sed erat, pulvinar vestibulum. Litora \\r\\npesent duis eu amet at. Interdum urna eu malesuada vestibulum curabitur \\r\\nvelit, wisi vitae. Nulla sem. Mauris venenatis a vivamus sit, egestas \\r\\nmagna commodo vestibulum, amet libero. commodo erat justo, volutpat elit\\r\\n iaculis. Sit vel mauris nec magna odio. Et vel lobortis et. Aliquam \\r\\nenim felis turpis quis magnis consectetuer, tristique justo pulvinar mi \\r\\nlibero maxime lectus. In massa semper reiciendis nulla a ante quis \\r\\nvelcras morbi sed.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;font-family:Roboto, sans-serif;\\\">Feugiat\\r\\n nibh, dis magna fusce turpis ut ante quam, ante neque non condimentum \\r\\nnec montes, enim vitae interdum. Id elementum enim volutpat pharetra \\r\\nerat sapien. Penatibus tincidunt praesent fringilla, dui eget in \\r\\ntristique nam nullam feugiat, sit auctor integer arcu risus. Aliquam \\r\\ninterdum nulla vestibulum sit, molestie elit eros mi, at nunc eget \\r\\nposuere duis. Gravida cum sit, nam nibh interdum nulla, suspendisse \\r\\nadipiscing fusce wisi. Curabitur ac non aptent volutpat nascetur sed, \\r\\nodio iaculis placerat, neque integer. Sagittis mauris egestas consequat \\r\\nsunt cras, sapien ac nunc magnis nisl, sed mi integer in. Accumsan dui, \\r\\nerat tristique tristique vitae mi augue.<\\/p>\",\"image\":\"63060126b38011661337894.jpg\"}', NULL, 539, '2022-08-24 07:07:24', '2024-05-21 00:41:58'),
(105, 'basic', NULL, 'login.content', '{\"has_image\":\"1\",\"title\":\"Welcome to Xaxino\",\"subtitle\":\"Sit iste delectus iure animi facere. Est veritatis illo officia.\",\"image\":\"6305e36cea4e31661330284.jpg\"}', NULL, 0, '2022-08-24 07:08:04', '2022-08-24 07:08:05'),
(106, 'basic', NULL, 'register.content', '{\"has_image\":\"1\",\"title\":\"Welcome to Xaxino\",\"subtitle\":\"Sit iste delectus iure animi facere. Est veritatis illo officia.\",\"image\":\"6305e38a6e8981661330314.jpg\"}', NULL, 0, '2022-08-24 07:08:34', '2022-08-24 07:08:34'),
(107, 'basic', NULL, 'contact_us.content', '{\"has_image\":\"1\",\"heading\":\"Quick Support\",\"subheading\":\"You can get all information\",\"title\":\"Get in touch\",\"image\":\"6305e3b0bf5fe1661330352.jpg\"}', NULL, 0, '2022-08-24 07:09:12', '2022-10-12 03:28:54'),
(108, 'basic', NULL, 'footer.content', '{\"footer_content\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ea possimus facilis aut veritatis, voluptate ullam, dolorem fugiat maxime cupiditate reiciendis voluptatum  incidunt deserunt.\",\"subscribe_title\":\"Subscribe to get updates\",\"subscribe_content\":\"Lorem ipsum dolor sit amet soluta consectetur adipisicing elit. Iste amet soluta possimus veniam non eaque.\"}', NULL, 0, '2022-08-24 07:10:20', '2022-08-24 07:10:20'),
(109, 'basic', NULL, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"fab fa-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', NULL, 0, '2022-08-24 07:11:53', '2022-08-31 10:05:49'),
(110, 'basic', NULL, 'social_icon.element', '{\"title\":\"Linkedin\",\"social_icon\":\"<i class=\\\"lab la-linkedin-in\\\"><\\/i>\",\"url\":\"https:\\/\\/www.google.com\\/\"}', NULL, 0, '2022-08-24 07:12:15', '2022-10-19 06:19:47'),
(111, 'basic', NULL, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/www.twitter.com\\/\"}', NULL, 0, '2022-08-24 07:12:29', '2022-08-24 07:12:29'),
(112, 'basic', NULL, 'social_icon.element', '{\"title\":\"Instagram\",\"social_icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', NULL, 0, '2022-08-24 07:18:46', '2022-08-24 07:18:46'),
(113, 'basic', NULL, 'breadcrumb.content', '{\"has_image\":\"1\",\"image\":\"6305e6a01b29d1661331104.jpg\"}', NULL, 0, '2022-08-24 07:21:44', '2022-08-24 07:21:44'),
(114, 'basic', NULL, 'user_kyc.content', '{\"verification_content\":\"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic officia quod natus, non dicta perspiciatis, quae repellendus ea illum aut debitis sint amet? Ratione voluptates beatae numquam.\",\"pending_content\":\"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic officia quod natus, non dicta perspiciatis, quae repellendus ea illum aut debitis sint amet .\"}', NULL, 0, '2022-08-31 05:32:19', '2022-08-31 05:32:19'),
(116, 'basic', NULL, 'contact_us.element', '{\"icon\":\"<i class=\\\"las la-phone\\\"><\\/i>\",\"title\":\"Call Us\",\"contact_info\":\"+7556555555555\"}', NULL, 0, '2022-10-12 03:23:54', '2022-10-12 03:23:54'),
(117, 'basic', NULL, 'contact_us.element', '{\"icon\":\"<i class=\\\"far fa-envelope\\\"><\\/i>\",\"title\":\"Mail Us\",\"contact_info\":\"jawimycava@mailinator.com\"}', NULL, 0, '2022-10-12 03:24:25', '2022-10-12 03:24:25'),
(119, 'basic', NULL, 'contact_us.element', '{\"icon\":\"<i class=\\\"las la-map-marker\\\"><\\/i>\",\"title\":\"Visit Us\",\"contact_info\":\"Velit minus rerum si\"}', NULL, 0, '2022-10-12 03:25:02', '2022-10-12 03:25:02'),
(120, 'basic', NULL, 'banned.content', '{\"has_image\":\"1\",\"heading\":\"You Are Banned\",\"image\":\"63467ec50796c1665564357.png\"}', NULL, 0, '2022-10-12 06:15:57', '2022-10-12 06:15:57'),
(121, NULL, '', 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"live game\",\"xaxino game\",\"casino platform\",\"casino\",\"poker\",\"blackjack\",\"mines\"],\"description\":\"Welcome to Xaxino - The ultimate casino platform! Join the fun and excitement of our extensive selection of games, including Head and tail, Spin Wheel, Number Guessing, Dice Rolling, Number Slot, and Casino Dice games. With top-notch security measures and 24\\/7 customer support, you can enjoy a safe and seamless gaming experience. Sign up today and get ready to win big!\",\"social_title\":\"Xaxino - Ultimate Casino Platform\",\"social_description\":\"Get ready for non-stop entertainment and big wins with Xaxino - Ultimate Casino Platform! Our platform offers various games, including Head and tail, Spin Wheel, Number Guessing, Dice Rolling, Number Slot, and Casino Dice games, and thrilling live dealer options. With seamless mobile compatibility, you can enjoy your favourite games anytime. Our friendly and knowledgeable customer support team is available 24\\/7 to ensure a smooth and enjoyable gaming experience. Join now and experience the excitement of our Casino Platform!\",\"image\":\"664c41ecc5f6c1716273644.png\"}', NULL, 0, '2020-07-05 03:42:52', '2024-05-21 03:14:13'),
(122, 'sunfyre', NULL, 'banner.content', '{\"has_image\":\"1\",\"image\":\"658aae753443d1703587445.png\",\"background_image\":\"658bb8c4e21681703655620.png\"}', NULL, 0, '2023-12-26 09:44:05', '2023-12-27 04:40:21'),
(123, 'sunfyre', NULL, 'banner.element', '{\"has_image\":\"1\",\"title\":\"Lucky Dwarfs\",\"subtitle\":\"Get insane prizes every week\",\"button_name\":\"Play Now\",\"button_url\":\"games\",\"image\":\"658ab14ab8da21703588170.png\"}', NULL, 0, '2023-12-26 09:56:10', '2024-01-02 12:59:05'),
(124, 'sunfyre', NULL, 'banner.element', '{\"has_image\":\"1\",\"title\":\"Lucky Dwarfs\",\"subtitle\":\"Get insane prizes every week\",\"button_name\":\"Play Now\",\"button_url\":\"games\",\"image\":\"658ab2c38d5ce1703588547.png\"}', NULL, 0, '2023-12-26 10:02:27', '2024-01-02 12:59:16'),
(125, 'sunfyre', NULL, 'banner.element', '{\"has_image\":\"1\",\"title\":\"Lucky Dwarfs\",\"subtitle\":\"Get insane prizes every week\",\"button_name\":\"Play Now\",\"button_url\":\"games\",\"image\":\"658ab2e54c9261703588581.png\"}', NULL, 0, '2023-12-26 10:03:01', '2024-01-02 12:59:20'),
(126, 'sunfyre', NULL, 'banner.element', '{\"has_image\":\"1\",\"title\":\"Lucky Dwarfs\",\"subtitle\":\"Get insane prizes every week\",\"button_name\":\"Play Now\",\"button_url\":\"games\",\"image\":\"658ab2faae0551703588602.png\"}', NULL, 0, '2023-12-26 10:03:22', '2024-01-02 12:59:24'),
(127, 'sunfyre', NULL, 'game.content', '{\"heading\":\"Our Awesome Games\",\"subheading\":\"Dolor sit amet consectetur adipisicing elit. Ipsaharum quidem fuga ipsam dolores odio architecto\"}', NULL, 0, '2023-12-26 10:07:50', '2023-12-26 10:07:50'),
(128, 'sunfyre', NULL, 'referral.content', '{\"has_image\":\"1\",\"heading\":\"Get 15% Referral Commission\",\"description\":\"Referral commissions are also known as a finders fee and referral rewards. Learn how to structure them\",\"button_name\":\"Know More\",\"button_url\":\"\\/user\\/login\",\"image\":\"658ab65a7bd351703589466.png\"}', NULL, 0, '2023-12-26 10:17:46', '2024-01-03 05:31:03'),
(129, 'sunfyre', NULL, 'why_choose_us.content', '{\"heading\":\"Why You Should Choose XAX\",\"subheading\":\"Dolor sit amet consectetur adipisicing elit. Ipsaharum quidem fuga ipsam dolores odio architecto\",\"color_title\":\"INO\"}', NULL, 0, '2023-12-26 10:19:19', '2023-12-27 04:59:40'),
(130, 'sunfyre', NULL, 'why_choose_us.element', '{\"icon\":\"<i class=\\\"fas fa-user\\\"><\\/i>\",\"title\":\"Total User\",\"digit\":\"1,25,000\"}', NULL, 0, '2023-12-26 10:19:42', '2023-12-26 10:19:47'),
(131, 'sunfyre', NULL, 'why_choose_us.element', '{\"icon\":\"<i class=\\\"fas fa-trophy\\\"><\\/i>\",\"title\":\"Total Winner\",\"digit\":\"2,25,000\"}', NULL, 0, '2023-12-26 10:20:20', '2023-12-26 10:20:20'),
(132, 'sunfyre', NULL, 'achivement.element', '{\"has_image\":\"1\",\"title\":\"Referral Commission System\",\"description\":\"Adipisci harum cumipsum nulla hic earum quidem repellat ad! At quam odio non harum\",\"image\":\"658ab77451be51703589748.png\"}', NULL, 0, '2023-12-26 10:22:28', '2023-12-26 10:22:28'),
(133, 'sunfyre', NULL, 'achivement.element', '{\"has_image\":\"1\",\"title\":\"Awsome Gaming Platform\",\"description\":\"Adipisci harum cumipsum nulla hic earum quidem repellat ad!\\r\\n At quam odio non harum\",\"image\":\"658ab78c6e2521703589772.png\"}', NULL, 0, '2023-12-26 10:22:52', '2024-01-03 05:27:25'),
(134, 'sunfyre', NULL, 'achivement.element', '{\"has_image\":\"1\",\"title\":\"Referral Commission System\",\"description\":\"Adipisci harum cumipsum nulla hic earum quidem repellat ad!    At quam odio non harum\",\"image\":\"658ab7ef7c7ab1703589871.png\"}', NULL, 0, '2023-12-26 10:24:31', '2023-12-26 10:24:31'),
(135, 'sunfyre', NULL, 'achivement.element', '{\"has_image\":\"1\",\"title\":\"Awsome Gaming Platform\",\"description\":\"Adipisci harum cumipsum nulla hic earum quidem repellat ad!\\r\\n At quam odio non harum\",\"image\":\"658ab805efeeb1703589893.png\"}', NULL, 0, '2023-12-26 10:24:53', '2023-12-26 10:24:53'),
(136, 'sunfyre', NULL, 'trx_win.content', '{\"heading\":\"Latest Transactions & Winners\",\"subheading\":\"Dolor sit amet consectetur adipisicing elit. Ipsaharum quidem fuga ipsam dolores odio architecto\"}', NULL, 0, '2023-12-26 10:25:36', '2023-12-26 10:25:36'),
(137, 'sunfyre', NULL, 'about.content', '{\"has_image\":\"1\",\"heading\":\"Know About XAXINO\",\"description\":\"Casinos offer a wide variety of games, each with its own set of rules, strategies, and odds. Here are brief descriptions of some popular casino games:\",\"image\":\"658ac1bf367351703592383.png\"}', NULL, 0, '2023-12-26 10:31:29', '2023-12-26 11:06:23'),
(138, 'sunfyre', NULL, 'how_work.content', '{\"has_image\":\"1\",\"heading\":\"How to Win Casion Game\",\"subheading\":\"Dolor sit amet consectetur adipisicing elit. Ipsaharum quidem fuga ipsam dolores odio architecto\",\"image\":\"658abe39086401703591481.png\"}', NULL, 0, '2023-12-26 10:47:03', '2023-12-26 10:51:21'),
(139, 'sunfyre', NULL, 'how_work.element', '{\"has_image\":\"1\",\"title\":\"Sign Up Account\",\"image\":\"658abd5b051d71703591259.png\"}', NULL, 0, '2023-12-26 10:47:39', '2023-12-26 10:47:39'),
(140, 'sunfyre', NULL, 'how_work.element', '{\"has_image\":\"1\",\"title\":\"Choose Lottery\",\"image\":\"658abd6c9e3b71703591276.png\"}', NULL, 0, '2023-12-26 10:47:56', '2023-12-26 10:47:56'),
(141, 'sunfyre', NULL, 'how_work.element', '{\"has_image\":\"1\",\"title\":\"Pick Number\",\"image\":\"658abd91917d81703591313.png\"}', NULL, 0, '2023-12-26 10:48:33', '2023-12-26 10:48:33'),
(142, 'sunfyre', NULL, 'how_work.element', '{\"has_image\":\"1\",\"title\":\"Win Lottery\",\"image\":\"658abda1a4ac21703591329.png\"}', NULL, 0, '2023-12-26 10:48:49', '2023-12-26 10:48:49'),
(143, 'sunfyre', NULL, 'faq.content', '{\"has_image\":\"1\",\"heading\":\"Asked Your Question About XAX\",\"subheading\":\"Dolor sit amet consectetur adipisicing elit. Ipsaharum quidem fuga ipsam dolores odio architecto\",\"title_color\":\"INO\",\"image\":\"658ac2b6c78061703592630.png\",\"background_image\":\"658ac2b6e1df21703592630.png\"}', NULL, 0, '2023-12-26 10:57:11', '2023-12-27 05:49:24'),
(144, 'sunfyre', NULL, 'faq.element', '{\"question\":\"Why Xaxino?\",\"answer\":\"Quisque sem molestie tortor ut, libero libero interdum nec quisque, et scelerisque nam, elit lectus mauris sed maecenas. Veniam urna eget habitasse aliquam\"}', NULL, 0, '2023-12-26 10:58:08', '2023-12-26 10:58:08'),
(145, 'sunfyre', NULL, 'faq.element', '{\"question\":\"Our Mission and Vission\",\"answer\":\"Quisque sem molestie tortor ut, libero libero interdum nec quisque, et scelerisque nam, elit lectus mauris sed maecenas. Veniam urna eget habitasse aliquam\"}', NULL, 0, '2023-12-26 10:58:30', '2023-12-26 10:58:30'),
(146, 'sunfyre', NULL, 'faq.element', '{\"question\":\"How to Prediction?\",\"answer\":\"Quisque sem molestie tortor ut, libero libero interdum nec quisque, et scelerisque nam, elit lectus mauris sed maecenas. Veniam urna eget habitasse aliquam\"}', NULL, 0, '2023-12-26 10:59:31', '2023-12-26 10:59:31'),
(147, 'sunfyre', NULL, 'faq.element', '{\"question\":\"How to Play?\",\"answer\":\"Quisque sem molestie tortor ut, libero libero interdum nec quisque, et scelerisque nam, elit lectus mauris sed maecenas. Veniam urna eget habitasse aliquam\"}', NULL, 0, '2023-12-26 10:59:56', '2023-12-26 10:59:56'),
(148, 'sunfyre', NULL, 'testimonial.content', '{\"has_image\":\"1\",\"heading\":\"What User Say About XAX\",\"title_color\":\"INO\",\"description\":\"Dolor sit amet consectetur adipisicing elit. Ipsaharum quidem fuga ipsam dolores odio architecto\",\"button_name\":\"Play Now\",\"button_url\":\"\\/games\",\"image\":\"658ac10a5e6541703592202.png\"}', NULL, 0, '2023-12-26 11:03:22', '2023-12-27 05:44:12'),
(149, 'sunfyre', NULL, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Aymond\",\"quote\":\"Vivamus in erat ut urna cursus vestibulum. Sed hendrerit. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo.\",\"image\":\"658ac11f93a501703592223.png\"}', NULL, 0, '2023-12-26 11:03:43', '2023-12-26 11:03:43'),
(150, 'sunfyre', NULL, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Daymon\",\"quote\":\"Vivamus in erat ut urna cursus vestibulum. Sed hendrerit. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo.\",\"image\":\"658ac12775ad71703592231.png\"}', NULL, 0, '2023-12-26 11:03:51', '2023-12-26 11:03:51'),
(151, 'sunfyre', NULL, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Alicent\",\"quote\":\"Vivamus in erat ut urna cursus vestibulum. Sed hendrerit. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo.\",\"image\":\"658ac133ef30e1703592243.png\"}', NULL, 0, '2023-12-26 11:04:03', '2023-12-26 11:04:03'),
(152, 'sunfyre', NULL, 'about.element', '{\"icon\":\"<i class=\\\"icon-poker-1-1\\\"><\\/i>\",\"title\":\"Best Platform\"}', NULL, 0, '2023-12-26 11:07:02', '2023-12-26 11:07:02'),
(153, 'sunfyre', NULL, 'about.element', '{\"icon\":\"<i class=\\\"icon-deposit\\\"><\\/i>\",\"title\":\"Quick Deposit\"}', NULL, 0, '2023-12-26 11:07:31', '2023-12-26 11:07:31'),
(154, 'sunfyre', NULL, 'about.element', '{\"icon\":\"<i class=\\\"icon-deposit\\\"><\\/i>\",\"title\":\"Quick Withdraw\"}', NULL, 0, '2023-12-26 11:08:03', '2023-12-26 11:08:03'),
(155, 'sunfyre', NULL, 'about.element', '{\"icon\":\"<i class=\\\"icon-Suppport\\\"><\\/i>\",\"title\":\"24\\/7 Support\"}', NULL, 0, '2023-12-26 11:08:28', '2023-12-26 11:08:28'),
(156, 'sunfyre', NULL, 'cta.content', '{\"has_image\":\"1\",\"heading\":\"Buy ticket and get million dollars for a click\",\"description\":\"Dolor sit amet consectetur adipisicing elit. Ipsaharum quidem fuga ipsam dolores odio architecto\",\"button\":\"Play Now\",\"button_url\":\"\\/games\",\"image\":\"658ac3481c6941703592776.png\"}', NULL, 0, '2023-12-26 11:12:56', '2023-12-26 11:12:56'),
(157, 'sunfyre', NULL, 'payment_method.content', '{\"heading\":\"We accept 25+ payment methods\"}', NULL, 0, '2023-12-26 11:13:46', '2023-12-26 11:13:46'),
(158, 'sunfyre', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"65910affa5c9c1704004351.png\"}', NULL, 0, '2023-12-26 11:13:54', '2023-12-31 05:32:31'),
(159, 'sunfyre', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"65910b046c5b91704004356.png\"}', NULL, 0, '2023-12-26 11:13:59', '2023-12-31 05:32:36'),
(160, 'sunfyre', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"65910b0951fdc1704004361.png\"}', NULL, 0, '2023-12-26 11:14:04', '2023-12-31 05:32:41'),
(161, 'sunfyre', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"65910b10593611704004368.png\"}', NULL, 0, '2023-12-26 11:14:08', '2023-12-31 05:32:48'),
(162, 'sunfyre', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"65910b157657e1704004373.png\"}', NULL, 0, '2023-12-26 11:14:13', '2023-12-31 05:32:53'),
(163, 'sunfyre', NULL, 'payment_method.element', '{\"has_image\":\"1\",\"image\":\"65910b1a7f81b1704004378.png\"}', NULL, 0, '2023-12-26 11:14:16', '2023-12-31 05:32:58'),
(164, 'sunfyre', NULL, 'social_icon.element', '{\"social_icon\":\"<i class=\\\"fab fa-facebook\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\"}', NULL, 0, '2023-12-26 11:15:12', '2023-12-26 11:15:12'),
(165, 'sunfyre', NULL, 'social_icon.element', '{\"social_icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/www.twitter.com\\/\"}', NULL, 0, '2023-12-26 11:15:27', '2023-12-26 11:15:27'),
(166, 'sunfyre', NULL, 'social_icon.element', '{\"social_icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', NULL, 0, '2023-12-26 11:15:44', '2023-12-26 11:15:44'),
(167, 'sunfyre', NULL, 'social_icon.element', '{\"social_icon\":\"<i class=\\\"fab fa-linkedin-in\\\"><\\/i>\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"}', NULL, 0, '2023-12-26 11:16:00', '2023-12-26 11:16:00'),
(168, 'sunfyre', 'privacy-policy', 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<p><font>Privacy Policy<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>1. Introduction<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>Welcome to Xaxino (\\\"Company\\\", \\\"we\\\", \\\"our\\\", \\\"us\\\"). We are committed to protecting your personal information and your right to privacy. If you have any questions or concerns about our policy, or our practices with regards to your personal information.<\\/font><\\/p><p><font>2. Information We Collect<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We collect personal information that you voluntarily provide to us when you register on the website, express an interest in obtaining information about us or our products and services, when you participate in activities on the website (such as posting messages in our online forums or entering competitions, contests or giveaways), or otherwise when you contact us.<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>The personal information that we collect depends on the context of your interactions with us and the website, the choices you make, and the products and features you use. The personal information we collect can include the following:<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>Personal Information Provided by You: We collect names; phone numbers; email addresses; mailing addresses; job titles; usernames; passwords; contact preferences; contact or authentication data; billing addresses; and other similar information.<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>Payment Data: We may collect data necessary to process your payment if you make purchases, such as your payment instrument number (e.g., a credit card number), and the security code associated with your payment instrument.<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>Social Media Login Data: We may provide you with the option to register using social media account details, like your Facebook, Twitter, or other social media account.<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>3. How We Use Your Information<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We use personal information collected via our website for a variety of business purposes described below. We process your personal information for these purposes in reliance on our legitimate business interests (\\\"Business Purposes\\\"), in order to enter into or perform a contract with you (\\\"Contractual\\\"), with your consent (\\\"Consent\\\"), and\\/or for compliance with our legal obligations (\\\"Legal Reasons\\\"). We indicate the specific processing grounds we rely on next to each purpose listed below:<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>To facilitate account creation and logon process.<\\/font><\\/p><p><font>To send administrative information to you for Business Purposes, Legal Reasons, and\\/or possibly for Contractual reasons.<\\/font><\\/p><p><font>To fulfill and manage your orders for Contractual reasons.<\\/font><\\/p><p><font>To manage user accounts for Business Purposes and\\/or Contractual reasons.<\\/font><\\/p><p><font>To enforce our terms, conditions, and policies for Business Purposes and\\/or Legal Reasons.<\\/font><\\/p><p><font>To respond to legal requests and prevent harm for Legal Reasons.<\\/font><\\/p><p><font>4. Sharing Your Information<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We may process or share your data that we hold based on the following legal basis:<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>Consent: We may process your data if you have given us specific consent to use your personal information in a specific purpose.<\\/font><\\/p><p><font>Legitimate Interests: We may process your data when it is reasonably necessary to achieve our legitimate business interests.<\\/font><\\/p><p><font>Performance of a Contract: Where we have entered into a contract with you, we may process your personal information to fulfill the terms of our contract.<\\/font><\\/p><p><font>Legal Obligations: We may disclose your information where we are legally required to do so in order to comply with applicable law, governmental requests, a judicial proceeding, court order, or legal process.<\\/font><\\/p><p><font>5. Cookies and Other Tracking Technologies<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We may use cookies and similar tracking technologies to access or store information. Specific information about how we use such technologies and how you can refuse certain cookies is set out in our Cookie Policy.<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>6. Data Retention<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We will only keep your personal information for as long as it is necessary for the purposes set out in this privacy policy, unless a longer retention period is required or permitted by law (such as tax, accounting, or other legal requirements).<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>7. Data Security<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We aim to protect your personal information through a system of organizational and technical security measures. However, despite our safeguards and efforts to secure your information, no electronic transmission over the Internet or information storage technology can be guaranteed to be 100% secure.<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>8. Your Privacy Rights<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>In some regions, such as the European Economic Area (EEA), you have rights that allow you greater access to and control over your personal information. These rights may include:<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>The right to request access and obtain a copy of your personal information.<\\/font><\\/p><p><font>The right to request rectification or erasure.<\\/font><\\/p><p><font>The right to restrict the processing of your personal information.<\\/font><\\/p><p><font>The right to data portability.<\\/font><\\/p><p><font>9. Updates to This Policy<\\/font><\\/p><p><font><br \\/><\\/font><\\/p><p><font>We may update this privacy policy from time to time in order to reflect, for example, changes to our practices or for other operational, legal, or regulatory reasons.<\\/font><\\/p><div><br \\/><\\/div>\"}', NULL, 0, '2023-12-26 11:19:15', '2024-05-21 03:02:08'),
(169, 'sunfyre', 'terms-of-service', 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<div>Terms of Service<\\/div><div><br \\/><\\/div><div>1. Introduction<\\/div><div><br \\/><\\/div><div>Welcome to Xaxino (\\\"Company\\\", \\\"we\\\", \\\"our\\\", \\\"us\\\"). These Terms of Service (\\\"Terms\\\") govern your use of our website located at [Website URL] (the \\\"Site\\\") and our services (collectively, the \\\"Services\\\"). By accessing or using the Services, you agree to be bound by these Terms. If you do not agree to these Terms, please do not use the Services.<\\/div><div><br \\/><\\/div><div>2. Use of the Services<\\/div><div><br \\/><\\/div><div>Eligibility: You must be at least 18 years old to use the Services. By using the Services, you represent and warrant that you have the legal capacity to enter into these Terms.<\\/div><div><br \\/><\\/div><div>Account Registration: To access certain features of the Services, you may need to register for an account. You agree to provide accurate, current, and complete information during the registration process and to update such information to keep it accurate, current, and complete. You are responsible for safeguarding your account credentials and for all activities that occur under your account.<\\/div><div><br \\/><\\/div><div>Prohibited Conduct: You agree not to use the Services for any unlawful purpose or in any way that could harm the Services, or any person or entity, as determined by us in our sole discretion. Prohibited conduct includes, but is not limited to:<\\/div><div><br \\/><\\/div><div>Violating any applicable laws or regulations.<\\/div><div>Infringing on the rights of others.<\\/div><div>Interfering with the security or operation of the Services.<\\/div><div>Sending spam or engaging in other disruptive or harmful activities.<\\/div><div>3. Intellectual Property<\\/div><div><br \\/><\\/div><div>All content, trademarks, service marks, logos, and other intellectual property displayed on the Services are the property of Xaxino or its licensors. You are not permitted to use these without our prior written consent.<\\/div><div><br \\/><\\/div><div>4. User Content<\\/div><div><br \\/><\\/div><div>You may be able to submit, post, or upload content to the Services (\\\"User Content\\\"). By submitting User Content, you grant Xaxino a non-exclusive, worldwide, royalty-free, perpetual, irrevocable license to use, reproduce, modify, distribute, display, and perform the User Content in connection with the Services. You represent and warrant that you have all rights necessary to grant this license.<\\/div><div><br \\/><\\/div><div>5. Termination<\\/div><div><br \\/><\\/div><div>We may terminate or suspend your access to the Services, without prior notice or liability, for any reason, including if you breach these Terms. Upon termination, your right to use the Services will immediately cease.<\\/div><div><br \\/><\\/div><div>6. Disclaimers and Limitation of Liability<\\/div><div><br \\/><\\/div><div>Disclaimer of Warranties: The Services are provided \\\"as is\\\" and \\\"as available\\\" without warranties of any kind, either express or implied. We disclaim all warranties, including any implied warranties of merchantability, fitness for a particular purpose, title, and non-infringement.<\\/div><div><br \\/><\\/div><div>Limitation of Liability: To the fullest extent permitted by law, in no event shall [Company Name], its affiliates, directors, employees, or agents be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses, resulting from (a) your use of or inability to use the Services; (b) any unauthorized access to or use of our servers and\\/or any personal information stored therein; (c) any interruption or cessation of transmission to or from the Services; (d) any bugs, viruses, trojan horses, or the like that may be transmitted to or through our Services by any third party; (e) any errors or omissions in any content or for any loss or damage incurred as a result of the use of any content posted, emailed, transmitted, or otherwise made available through the Services; and\\/or (f) the defamatory, offensive, or illegal conduct of any third party.<\\/div><div><br \\/><\\/div><div>7. Indemnification<\\/div><div><br \\/><\\/div><div>You agree to indemnify, defend, and hold harmless [Company Name], its affiliates, officers, directors, employees, and agents, from and against any and all claims, liabilities, damages, losses, costs, and expenses, including, but not limited to, reasonable legal and accounting fees, arising out of or in any way connected with your access to or use of the Services, or your violation of these Terms.<\\/div><div><br \\/><\\/div><div>8. Governing Law and Dispute Resolution<\\/div><div><br \\/><\\/div><div>These Terms shall be governed by and construed in accordance with the laws of [Your State\\/Country], without regard to its conflict of law principles. Any dispute arising out of or relating to these Terms or the Services shall be resolved through binding arbitration conducted in [Your City\\/State], except that either party may seek injunctive or other equitable relief in a court of competent jurisdiction.<\\/div><div><br \\/><\\/div><div>9. Changes to These Terms<\\/div><div><br \\/><\\/div><div>We reserve the right to modify these Terms at any time. If we make changes, we will provide notice of such changes by posting the updated Terms on the Site or through other communications. Your continued use of the Services after the changes become effective constitutes your acceptance of the new Terms.<\\/div>\"}', NULL, 0, '2023-12-26 11:19:36', '2024-05-21 03:05:24'),
(170, 'sunfyre', NULL, 'contact_us.content', '{\"has_image\":\"1\",\"heading\":\"Get in touch\",\"contact_address\":\"4517 Washington Ave.Manchester, Kentucky 39495\",\"contact_number\":\"(408) 777 - 8745\",\"email_address\":\"willie.jennings@example.com\",\"image\":\"658accb3c03db1703595187.png\"}', NULL, 0, '2023-12-26 11:53:07', '2023-12-26 11:53:07'),
(171, 'sunfyre', NULL, 'banned.content', '{\"has_image\":\"1\",\"heading\":\"You Are Banned\",\"image\":\"658acce94d5e11703595241.png\"}', NULL, 0, '2023-12-26 11:54:00', '2023-12-26 11:54:01'),
(172, 'sunfyre', NULL, 'breadcrumb.content', '{\"has_image\":\"1\",\"image\":\"658acd3f282ad1703595327.png\"}', NULL, 0, '2023-12-26 11:55:27', '2023-12-26 11:55:27'),
(173, 'sunfyre', '', 'login.content', '{\"has_image\":\"1\",\"heading\":\"Welcome to Xaxino\",\"image\":\"658ace17d1ff21703595543.png\"}', NULL, 0, '2023-12-26 11:59:03', '2024-05-21 03:15:46'),
(174, 'sunfyre', '', 'register.content', '{\"has_image\":\"1\",\"heading\":\"Welcome to Xaxino\",\"image\":\"658ace354794b1703595573.png\"}', NULL, 0, '2023-12-26 11:59:33', '2024-05-21 03:16:06'),
(175, 'sunfyre', NULL, 'footer.content', '{\"has_image\":\"1\",\"image\":\"658adaf2e91771703598834.png\"}', NULL, 0, '2023-12-26 12:53:54', '2023-12-26 12:53:55'),
(176, 'sunfyre', '', 'user_kyc.content', '{\"verification_content\":\"Phasellus a est. Vivamus elementum semper nisi. In turpis. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Praesent nec nisl a purus blandit viverra. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus.\",\"pending_content\":\"Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Fusce fermentum odio nec arcu. Ut id nisl quis enim dignissim sagittis. Vivamus elementum semper nisi. Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis.\",\"reject\":\"Your KYC application has been rejected. Please resubmit the required documents as per our guidelines. For assistance, contact our support team.\"}', NULL, 0, '2023-12-28 11:27:07', '2024-05-21 03:16:46'),
(177, 'sunfyre', 'sint-sit-dolore-dic', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Sint sit dolore dic\",\"description\":\"<div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><div>\\u00a0<\\/div><div><div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><\\/div>\",\"image\":\"659406c6072931704199878.png\"}', NULL, 32, '2024-01-02 06:04:31', '2024-05-05 14:04:29'),
(178, 'sunfyre', 'aenean-posuere-tortor-sed-cursus-feugiat', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Aenean posuere, tortor sed cursus feugiat\",\"description\":\"<div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><div>\\u00a0<\\/div><div><div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><\\/div>\",\"image\":\"659406ea405701704199914.png\"}', NULL, 93, '2024-01-02 06:05:40', '2024-05-05 14:02:41'),
(179, 'sunfyre', 'morbi-nec-metus-fusce-convallis-metus', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Morbi nec metus. Fusce convallis metus\",\"description\":\"<div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><div>\\u00a0<\\/div><div><div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><\\/div>\",\"image\":\"659406f92cbbf1704199929.png\"}', NULL, 64, '2024-01-02 06:06:01', '2024-05-12 16:04:26'),
(180, 'sunfyre', NULL, 'blog.content', '{\"heading\":\"Our Latest Update\",\"subheading\":\"Dolor sit amet consectetur adipisicing elit. Ipsaharum quidem fuga ipsam dolores odio architecto\"}', NULL, 0, '2024-01-02 10:27:21', '2024-01-02 10:27:21');
INSERT INTO `frontends` (`id`, `tempname`, `slug`, `data_keys`, `data_values`, `seo_content`, `views`, `created_at`, `updated_at`) VALUES
(181, 'sunfyre', 'suspendisse-enim-turpis-dictum-sed-iaculis-a', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Suspendisse enim turpis, dictum sed, iaculis a\",\"description\":\"<div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><div>\\u00a0<\\/div><div><div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><\\/div>\",\"image\":\"659407120d8351704199954.png\"}', NULL, 50, '2024-01-02 11:52:34', '2024-05-11 02:52:40'),
(182, 'sunfyre', 'donec-sodales-sagittis-magna-in-dui-magna', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Donec sodales sagittis magna. In dui magna\",\"description\":\"<div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><div>\\u00a0<\\/div><div><div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><\\/div>\",\"image\":\"6594072461d421704199972.png\"}', NULL, 55, '2024-01-02 11:52:52', '2024-05-10 18:46:57'),
(183, 'sunfyre', 'maecenas-vestibulum-mollis-diam', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Maecenas vestibulum mollis diam\",\"description\":\"<div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><div>\\u00a0<\\/div><div><div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><\\/div>\",\"image\":\"65940733290761704199987.png\"}', NULL, 45, '2024-01-02 11:53:07', '2024-05-12 21:39:36'),
(184, 'sunfyre', 'etiam-rhoncus-sed-a-libero-sed-hendrerit', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Etiam rhoncus. Sed a libero. Sed hendrerit.\",\"description\":\"<div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><div>\\u00a0<\\/div><div><div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><\\/div>\",\"image\":\"6594073d3327a1704199997.png\"}', NULL, 47, '2024-01-02 11:53:17', '2024-05-11 05:19:32'),
(185, 'sunfyre', 'etiam-ultricies-nisi-vel-augue-pellentesque-commodo-eros-a-enim', 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Etiam ultricies nisi vel augue. Pellentesque commodo eros a enim.\",\"description\":\"<div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><div>\\u00a0<\\/div><div><div>Vestibulum volutpat pretium libero. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur blandit mollis lacus. Aliquam eu nunc. Nullam dictum felis eu pede mollis pretium.<\\/div><div><br \\/><\\/div><div>Nunc interdum lacus sit amet orci. Sed libero. Duis lobortis massa imperdiet quam. Vestibulum fringilla pede sit amet augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\\/div><div><br \\/><\\/div><div>Nam at tortor in tellus interdum sagittis. Praesent nec nisl a purus blandit viverra. Pellentesque ut neque. Aenean viverra rhoncus pede. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/div><div><br \\/><\\/div><div>Praesent vestibulum dapibus nibh. Nunc interdum lacus sit amet orci. Duis lobortis massa imperdiet quam. Praesent ut ligula non mi varius sagittis. In hac habitasse platea dictumst.<\\/div><div><br \\/><\\/div><div>Cras non dolor.. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Cras dapibus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.<\\/div><\\/div>\",\"image\":\"6594074a276571704200010.png\"}', NULL, 58, '2024-01-02 11:53:30', '2024-05-11 12:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `trending` tinyint(1) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `win` decimal(28,8) DEFAULT '0.00000000' COMMENT 'Win Bonus',
  `max_limit` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `min_limit` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `invest_back` tinyint(1) DEFAULT '0',
  `probable_win` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instruction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `alias`, `image`, `status`, `trending`, `featured`, `win`, `max_limit`, `min_limit`, `invest_back`, `probable_win`, `type`, `level`, `instruction`, `short_desc`, `created_at`, `updated_at`) VALUES
(1, 'Head & Tail', 'head_tail', '6592b9b5aace01704114613.png', 1, 1, 1, 50.00000000, 100.00000000, 1.00000000, 1, '\"90\"', NULL, NULL, '<br><h2 style=\"font-family: Roboto, \" open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 400;=\"\" line-height:=\"\" 1.4;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" font-size:=\"\" 2.3125rem;=\"\" background-color:=\"transparent\">How to Play (Rule)</h2><div><br></div><div><b>Admin can write as he want. This text is controllable from admin panel.</b></div><div><br></div><div> Admin can write as he want. This text is controllable from admin panel. Admin can write as he want. This text is controllable from admin panel. Admin can write as he want. This text is controllable from admin panel. Admin can write as he want. This text is controllable from admin panel. Admin can write as he want. This text is controllable from admin panel. Admin can write as he want. This text is controllable from admin panel. Admin can write as he want. This text is controllable from admin panel. Admin can write as he want. This text is controllable from admin panel. Admin can write as he want. This text is controllable from admin panel.</div>', NULL, NULL, '2024-05-01 06:31:15'),
(2, 'Rock Paper scissors', 'rock_paper_scissors', '610515f76a27a1627723255.jpg', 1, 0, 0, 20.00000000, 100.00000000, 1.00000000, 1, '\"15\"', NULL, NULL, '<div><br></div><div><h2 open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 400;=\"\" line-height:=\"\" 1.4;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" font-size:=\"\" 2.3125rem;=\"\" background-color:=\"transparent\" style=\"margin-top: 0.2rem; margin-bottom: 0.5rem; font-family: \" color:=\"\" rgb(85,=\"\" 85,=\"\" 85);\"=\"\">How to play: Rock Paper &amp; Scissors</h2><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px;\"=\"\">Finding engaging ways to generate more revenue at your event (aka: giving donors every opportunity to give) is a key task. Don’t knock the traditional activities like Wall of Wine or Heads and Tails, just add your own flare.&nbsp;A Heads and Tails game isn’t your usual raffle;&nbsp;it’s a fun, novel way to engage event guests who might otherwise be hesitant to participate and bid in the live auction. It operates the same way as a standard raffle, but with a twist!</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Pick Your Prize</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\">First, select an item for your raffle that will appeal to a broad audience, to get as many people as possible to participate. The value of the prize itself can vary, but pick something that costs relative &nbsp;in relation to the ticket sale price.</p></div>', NULL, NULL, '2023-03-14 10:20:52'),
(3, 'Spin Wheel', 'spin_wheel', '61051d8469d731627725188.jpg', 1, 0, 0, 50.00000000, 10000.00000000, 1.00000000, 1, '\"100\"', NULL, NULL, '<div><br></div><div><h2 open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 400;=\"\" line-height:=\"\" 1.4;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" font-size:=\"\" 2.3125rem;=\"\" background-color:=\"transparent\" style=\"margin-top: 0.2rem; margin-bottom: 0.5rem; font-family: \" color:=\"\" rgb(85,=\"\" 85,=\"\" 85);\"=\"\">How to play: Spin Wheel</h2><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px;\"=\"\">Finding engaging ways to generate more revenue at your event (aka: giving donors every opportunity to give) is a key task. Don’t knock the traditional activities like Wall of Wine or Heads and Tails, just add your own flare.&nbsp;A Heads and Tails game isn’t your usual raffle;&nbsp;it’s a fun, novel way to engage event guests who might otherwise be hesitant to participate and bid in the live auction. It operates the same way as a standard raffle, but with a twist!</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Pick Your Prize</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\">First, select an item for your raffle that will appeal to a broad audience, to get as many people as possible to participate. The value of the prize itself can vary, but pick something that costs relative &nbsp;in relation to the ticket sale price</p></div>', NULL, NULL, '2022-10-16 06:33:09'),
(4, 'Number Guessing', 'number_guess', '61051a9ed28511627724446.jpg', 1, 0, 1, NULL, 100.00000000, 1.00000000, 0, NULL, NULL, NULL, '<div><span style=\"color: inherit; font-family: var(--heading-font); font-size: 44px; font-weight: 600;\">How to play: Number Guessing Game</span><br></div><div><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px;\"=\"\">Finding engaging ways to generate more revenue at your event (aka: giving donors every opportunity to give) is a key task. Don’t knock the traditional activities like Wall of Wine or Heads and Tails, just add your own flare.&nbsp;A Heads and Tails game isn’t your usual raffle;&nbsp;it’s a fun, novel way to engage event guests who might otherwise be hesitant to participate and bid in the live auction. It operates the same way as a standard raffle, but with a twist!</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Pick Your Prize</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\">First, select an item for your raffle that will appeal to a broad audience, to get as many people as possible to participate. The value of the prize itself can vary, but pick something that costs relative &nbsp;in relation to the ticket sale price.</p><blockquote open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" background-color:=\"transparent\" style=\"margin-bottom: 1.25rem; padding: 0.5625rem 1.25rem 0px 1.1875rem; border-left: 1px solid rgb(221, 221, 221); line-height: 1.6; color: rgb(145, 145, 145);\"><p style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: inherit; padding: 0px 0px 0px 30px; font-size: 1rem; line-height: 1.6; text-rendering: optimizelegibility;\">Generally, 20-25% of your guests will participate in a raffle—so the more guests you have, the more tickets you’ll sell.</p></blockquote><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\">Price your raffle ticket conscientious of your guests’ budgets; for your average smaller event, $15 is great. For larger events, $25. Big events can sometimes charge $50 or $100 depending on the value of the raffle prize.</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Promote the Game</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\">The best way to sell more raffle tickets? Promote it! Start spreading the word about the raffle prior to the event—put up a page on your event website about it, send out fliers advertising your prize, and make tickets available for sale online. Just be sure to track who’s already bought one, then add them to the list of event night raffle participants.</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Make it Fun</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\">Instead of giving out a ticket stub to raffle participants, give guests participating in Heads and Tails a&nbsp;<span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">fun and inexpensive party favor</span>, such as a light stick, a toy, a noisemaker, or another raffle favor tied into your event theme.</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\">For guests who purchased raffle tickets in advance, include the favors in the bidder packet that guests pick up at check-in.</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Maximize Participation</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\">A Heads and Tails raffle is a great way to&nbsp;<span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\"><a href=\"https://blog.greatergiving.com/top-7-ways-to-keep-your-audience-engaged-during-the-live-auction/\" target=\"_blank\" style=\"color: rgb(120, 160, 37); font-family: var(--para-font); line-height: inherit;\">spur engagement during the entertainment portion of your event</a></span>, before or during the live auction, so be sure to make arrangements with your auctioneer in advance of event night to announce and host it.</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px=\"\" 30px;\"=\"\">While the auctioneer is announcing the raffle, encourage last-minute participation. For guests who do decide to participate in the raffle at the last minute, make sign-up sheets available at each table, and send out a few volunteers to walk among the tables with extra raffle favors. Be sure to collect the sign-up sheets before the raffle starts.</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" padding:=\"\" 0px;\"=\"\"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">How “Heads and Tails” Works</span></p><ol open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-bottom: 1.25rem; margin-left: 1.4rem;\"><li style=\"font-family: var(--para-font); margin: 0px 0px 0.75rem; padding: 0px; counter-increment: item 1;\">When it’s time, your auctioneer should ask all Heads and Tails participants to stand up. Then participants select either “heads” or “tails” by putting their hands on their heads—or their tails!</li><li style=\"font-family: var(--para-font); margin: 0px 0px 0.75rem; padding: 0px; counter-increment: item 1;\">The auctioneer flips a coin and announces whether the coin came up heads or tails. Those participants whose choice matches the coin flip get to stay standing—everyone else sits down.</li><li style=\"font-family: var(--para-font); margin: 0px 0px 0.75rem; padding: 0px; counter-increment: item 1;\">The auctioneer continues asking participants to select “heads” or “tails,” then flipping the coin, eliminating more players until only a handful are left.</li><li style=\"font-family: var(--para-font); margin: 0px 0px 0.75rem; padding: 0px; counter-increment: item 1;\">Ask these few finalists to come to the stage for the last few coin tosses, until only one player is left standing. This is your raffle winner!</li></ol></div>', NULL, NULL, '2024-05-01 06:31:28'),
(5, 'Dice Rolling', 'dice_rolling', '61051cb37ad601627724979.jpg', 1, 0, 0, 5.00000000, 100.00000000, 1.00000000, 1, '\"5\"', NULL, NULL, '<font color=\"#000000\"><br></font><div><h2 open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 400;=\"\" line-height:=\"\" 1.4;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" font-size:=\"\" 2.3125rem;=\"\" background-color:=\"transparent\" color:=\"\" rgb(85,=\"\" 85,=\"\" 85);\"=\"\" style=\"margin-top: 0.2rem; margin-bottom: 0.5rem; font-family: \" rgb(33,=\"\" 37,=\"\" 41);\"=\"\"><font color=\"#ffffff\">How to play: Dice Rolling</font></h2><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" sans-serif;\"=\"\">Finding engaging ways to generate more revenue at your event (aka: giving donors every opportunity to give) is a key task. Don’t knock the traditional activities like Wall of Wine or Heads and Tails, just add your own flare.&nbsp;A Heads and Tails game isn’t your usual raffle;&nbsp;it’s a fun, novel way to engage event guests who might otherwise be hesitant to participate and bid in the live auction. It operates the same way as a standard raffle, but with a twist!</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" sans-serif;\"=\"\"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Pick Your Prize</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \" sans-serif;\"=\"\">First, select an item for your raffle that will appeal to a broad audience, to get as many people as possible to participate. The value of the prize itself can vary, but pick something that costs relative &nbsp;in relation to the ticket sale price.</p></div>', NULL, NULL, '2022-10-16 06:33:22'),
(6, 'Card Finding', 'card_finding', '610521608fde21627726176.jpg', 1, 0, 0, 50.00000000, 100.00000000, 1.00000000, 1, '\"10\"', NULL, NULL, '<div><br></div><div><h2 open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 400;=\"\" line-height:=\"\" 1.4;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" font-size:=\"\" 2.3125rem;=\"\" background-color:=\"transparent\" color:=\"\" rgb(85,=\"\" 85,=\"\" 85);\"=\"\" rgb(33,=\"\" 37,=\"\" 41);\"=\"\" style=\"margin-top: 0.2rem; margin-bottom: 0.5rem; font-family: \"><font color=\"#ffffff\">How to play: Card Finding</font></h2><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \">Finding engaging ways to generate more revenue at your event (aka: giving donors every opportunity to give) is a key task. Don’t knock the traditional activities like Wall of Wine or Heads and Tails, just add your own flare.&nbsp;A Heads and Tails game isn’t your usual raffle;&nbsp;it’s a fun, novel way to engage event guests who might otherwise be hesitant to participate and bid in the live auction. It operates the same way as a standard raffle, but with a twist!</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Pick Your Prize</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \">First, select an item for your raffle that will appeal to a broad audience, to get as many people as possible to participate. The value of the prize itself can vary, but pick something that costs relative &nbsp;in relation to the ticket sale price.</p></div>', NULL, NULL, '2022-10-16 06:33:26'),
(7, 'Number Slot', 'number_slot', '61052482a60ed1627726978.jpg', 1, 1, 0, NULL, 100.00000000, 1.00000000, 0, '[\"50\",\"40\",\"6\",\"4\"]', NULL, '[\"100\",\"150\",\"200\"]', '<br><div><h2 open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 400;=\"\" line-height:=\"\" 1.4;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" font-size:=\"\" 2.3125rem;=\"\" background-color:=\"transparent\" color:=\"\" rgb(85,=\"\" 85,=\"\" 85);\"=\"\" rgb(33,=\"\" 37,=\"\" 41);\"=\"\" style=\"margin-top: 0.2rem; margin-bottom: 0.5rem;\"><font color=\"#ffffff\">How to play: Number Slot</font></h2><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px;\">Finding engaging ways to generate more revenue at your event (aka: giving donors every opportunity to give) is a key task. Don’t knock the traditional activities like Wall of Wine or Heads and Tails, just add your own flare.&nbsp;A Heads and Tails game isn’t your usual raffle;&nbsp;it’s a fun, novel way to engage event guests who might otherwise be hesitant to participate and bid in the live auction. It operates the same way as a standard raffle, but with a twist!</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px;\"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Pick Your Prize</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px;\">First, select an item for your raffle that will appeal to a broad audience, to get as many people as possible to participate. The value of the prize itself can vary, but pick something that costs relative &nbsp;in relation to the ticket sale price.</p></div>', NULL, NULL, '2024-05-01 06:31:36'),
(8, 'Pool Number', 'number_pool', '610526fa315241627727610.jpg', 1, 1, 1, 50.00000000, 1000.00000000, 1.00000000, 1, '\"3\"', NULL, NULL, '<div><br></div><div><h2 open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 400;=\"\" line-height:=\"\" 1.4;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" font-size:=\"\" 2.3125rem;=\"\" background-color:=\"transparent\" color:=\"\" rgb(85,=\"\" 85,=\"\" 85);\"=\"\" rgb(33,=\"\" 37,=\"\" 41);\"=\"\" style=\"margin-top: 0.2rem; margin-bottom: 0.5rem; font-family: \"><font color=\"#ffffff\">How to play: Pool Number</font></h2><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \">Finding engaging ways to generate more revenue at your event (aka: giving donors every opportunity to give) is a key task. Don’t knock the traditional activities like Wall of Wine or Heads and Tails, just add your own flare.&nbsp;A Heads and Tails game isn’t your usual raffle;&nbsp;it’s a fun, novel way to engage event guests who might otherwise be hesitant to participate and bid in the live auction. It operates the same way as a standard raffle, but with a twist!</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Pick Your Prize</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \">First, select an item for your raffle that will appeal to a broad audience, to get as many people as possible to participate. The value of the prize itself can vary, but pick something that costs relative &nbsp;in relation to the ticket sale price.</p><blockquote open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" background-color:=\"transparent\" style=\"margin-bottom: 1.25rem; padding: 0.5625rem 1.25rem 0px 1.1875rem; border-left: 1px solid rgb(221, 221, 221); line-height: 1.6; color: rgb(145, 145, 145);\"><p style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: inherit; padding: 0px 0px 0px 30px; font-size: 1rem; line-height: 1.6; text-rendering: optimizelegibility;\">Generally, 20-25% of your guests will participate in a raffle—so the more guests you have, the more tickets you’ll sell.</p></blockquote><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \">Price your raffle ticket conscientious of your guests’ budgets; for your average smaller event, $15 is great. For larger events, $25. Big events can sometimes charge $50 or $100 depending on the value of the raffle prize.</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Promote the Game</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \">The best way to sell more raffle tickets? Promote it! Start spreading the word about the raffle prior to the event—put up a page on your event website about it, send out fliers advertising your prize, and make tickets available for sale online. Just be sure to track who’s already bought one, then add them to the list of event night raffle participants.</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Make it Fun</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \">Instead of giving out a ticket stub to raffle participants, give guests participating in Heads and Tails a&nbsp;<span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">fun and inexpensive party favor</span>, such as a light stick, a toy, a noisemaker, or another raffle favor tied into your event theme.</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \">For guests who purchased raffle tickets in advance, include the favors in the bidder packet that guests pick up at check-in.</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">Maximize Participation</span></p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \">A Heads and Tails raffle is a great way to&nbsp;<span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\"><a href=\"https://blog.greatergiving.com/top-7-ways-to-keep-your-audience-engaged-during-the-live-auction/\" target=\"_blank\" style=\"color: rgb(120, 160, 37); font-family: var(--para-font); line-height: inherit;\">spur engagement during the entertainment portion of your event</a></span>, before or during the live auction, so be sure to make arrangements with your auctioneer in advance of event night to announce and host it.</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px=\"\" 30px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \">While the auctioneer is announcing the raffle, encourage last-minute participation. For guests who do decide to participate in the raffle at the last minute, make sign-up sheets available at each table, and send out a few volunteers to walk among the tables with extra raffle favors. Be sure to collect the sign-up sheets before the raffle starts.</p><p open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" padding:=\"\" 0px;\"=\"\" sans-serif;\"=\"\" style=\"margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; font-family: \"><span style=\"font-family: var(--para-font); font-weight: 700; line-height: inherit;\">How “Heads and Tails” Works</span></p><ol open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 1.6;=\"\" color:=\"\" rgb(68,=\"\" 68,=\"\" 68);=\"\" background-color:=\"transparent\" style=\"margin-bottom: 1.25rem; margin-left: 1.4rem;\"><li style=\"font-family: var(--para-font); margin: 0px 0px 0.75rem; padding: 0px; counter-increment: item 1;\">When it’s time, your auctioneer should ask all Heads and Tails participants to stand up. Then participants select either “heads” or “tails” by putting their hands on their heads—or their tails!</li><li style=\"font-family: var(--para-font); margin: 0px 0px 0.75rem; padding: 0px; counter-increment: item 1;\">The auctioneer flips a coin and announces whether the coin came up heads or tails. Those participants whose choice matches the coin flip get to stay standing—everyone else sits down.</li><li style=\"font-family: var(--para-font); margin: 0px 0px 0.75rem; padding: 0px; counter-increment: item 1;\">The auctioneer continues asking participants to select “heads” or “tails,” then flipping the coin, eliminating more players until only a handful are left.</li><li style=\"font-family: var(--para-font); margin: 0px 0px 0.75rem; padding: 0px; counter-increment: item 1;\">Ask these few finalists to come to the stage for the last few coin tosses, until only one player is left standing. This is your raffle winner!</li></ol></div>', NULL, NULL, '2024-05-01 06:31:52'),
(9, 'Roulette', 'roulette', '63fc71d5784ce1677488597.jpg', 1, 0, 0, NULL, 1000.00000000, 1.00000000, 0, NULL, NULL, NULL, '<span id=\"docs-internal-guid-6b1ab23c-7fff-d231-3784-e58e69c7a9b4\"><font color=\"#ffffff\"><p dir=\"ltr\" style=\"line-height: 1.8; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size: 12pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">The roulette game is played with a wheel with colored pockets alternating red and black. The European version of the game has 37 pockets with numbers from 1 to 36 and a green bag marked 0. The American version, meanwhile, has 38 pockets with numbers from 1 to 36, as well as green pockets for 0 and 00. As you might expect, the American version of roulette has a higher house edge thanks to the extra bag.</span></p><br><p dir=\"ltr\" style=\"line-height: 1.8; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 8pt;\"><span style=\"font-size: 12pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">The goal of the player is to attempt to guess which pocket the ball will land in. This can be done by wagering on a single number, a group of numbers, or even the color of the pocket. Bets are made by placing chips on the section of the table known as the “layout.”</span></p><p dir=\"ltr\" style=\"line-height: 1.8; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 8pt;\"><span style=\"font-size: 12pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">While players place bets, a casino employee known as a croupier will start the wheel spinning. A small white ball is placed in the wheel and spun in the opposite direction.</span></p><p dir=\"ltr\" style=\"line-height: 1.8; margin-top: 0pt; margin-bottom: 8pt;\"><span style=\"font-size: 12pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">Betting continues until the croupier announces “No more bets.” The ball eventually slows enough that it drops into the lower section of the wheel, bounces about, and lands in a pocket. At this point, losing wagers are raked off the table, and winning bets are paid to players</span></p></font></span>', NULL, NULL, '2023-02-28 03:02:56'),
(10, 'Casino Dice', 'casino_dice', '657ff2e06f55f1702884064.jpg', 1, 0, 0, 10.00000000, 1000.00000000, 1.00000000, 1, '\"20\"', NULL, NULL, '<font color=\"#000000\"><div>When players at this table game win big, the whole of the Star knows about it. The cheers erupt and strangers high-five when the dice are hot. Don’t be intimidated by the many betting options or the slang of the Craps table – this is one of the most dynamic, popular, and social of all casino table games.</div><div>The basic principle is to bet on or against the total of the two dice thrown by the shooter. The shooter is the player who throws the dice. Each player will have the chance to shoot.</div><div>The game of Craps can look complicated at first, but it is actually quite simple. It is the variety of bets that sometimes makes the game seem difficult. However, the bets can be broken down into separate parts to make the game easier. The variety of bets you can make on Craps are listed in this brochure and they are explained to you. Read about them, then check the diagram in this brochure and when you are comfortable, see if you can find the bets on the table. Ideally, you should make your bets before the dice are thrown, however, bets may be accepted up until the dice come to rest.​</div><div>&nbsp;</div><div>Win Line Bets</div><div>Win Line bets can be made only before the first roll of the dice, the Come Out roll. You win on a Natural i.e. 7 or 11 and lose on Craps i.e. 2, 3, or 12. Any other number becomes the Point and the shooter must throw the Point again before a 7 to win. If a 7 rolls before the Point you lose. If the Point is rolled first then you win even money. After the Point is established, the shooter continues to roll the dice until a 7 is rolled. A Win Line bet cannot be reduced, increased or removed after the Point is established.</div><div>&nbsp;</div><div>Don\'t Win Line Bets</div><div>Don’t Win Line bets are the reverse of Win Line bets. They must be made before the Come Out roll. You lose on a Natural i.e. 7 or 11 on a Come Out roll, and win on Craps 3 or 12. Should a 2 come up, it is a stand-off (nobody wins). Any other number rolled becomes the Point. You win if the shooter throws a 7 before rolling the Point and you lose if the Point is rolled before a 7. Don’t Win Line bets may be reduced or removed at any time, however, the bet may not be increased or replaced after such removal or reduction until a new Come Out roll.</div><div>&nbsp;</div><div>Come Bets</div><div>Come bets are very similar to Win Line bets, however, they can only be made after the shooter has established the Point. On the roll immediately following the placement of the bet, you win on 7 or 11 and lose on Craps 2, 3, or 12. Any other number that rolls establish your Come Point, which must be rolled again before a 7 in order to win. If 7 rolls before the Come Point, you lose. A Come bet cannot be reduced or removed after the Come Point is established with respect to that bet. Come bets are always active until they either win or lose.</div><div>&nbsp;</div><div>Don\'t Come Bets</div><div>Don’t Come bets are similar to Don’t Win Line bets, however they can only be made after the shooter has established a Point. On a roll immediately following placement of the bet, you lose on 7 or 11 and win on Craps 12 or 3, with Craps 2 being a stand-off. Any other number that rolls establishes your Don’t Come Point. You win if a 7 is rolled before the Don’t Come Point and you lose if the Point is rolled before a 7. Don’t Come bets may be removed or reduced at any time, but may not be increased or replaced after such removal or reduction until a new Come Out roll. Don’t Come bets are always active until they either win, lose or are withdrawn.</div><div>&nbsp;</div><div>Supplemental Bets (Odds)</div><div>You can make a bet in addition to your original Win/Don’t Win, Come/Don’t Come bets at any time after a Point is established. These bets are known as Odds and may be taken with any Win Line bet or Come bet in an amount up to double the amount of your original bet. You may also lay odds on any Don’t Win or Don’t Come bet to win up to double your original bet. The bet will be in units determined by the odds for that Point. Odds on Come bets are off (not working) i.e. They cannot win or lose on the Come Out roll unless you designate that the bet is on (working).</div><div>&nbsp;</div><div>Field Bets</div><div>A Field (5) bet is a one-roll bet and can be made on any roll when the dice are in the centre of the table. A Field bet wins if the numbers 2, 3, 4, 9, 10, 11 or 12 are rolled on the very next roll. All winning bets pay even money on numbers 3, 4, 9, 10 and 11 and 2 to 1 on the numbers 2 and 12. If any other number is rolled, the bet loses.</div><div>&nbsp;</div><div>Place Bets - To Win</div><div>You can make a bet in addition to your original Win/Don’t Win, Come/Don’t Come bets at any time after a Point is established. These bets are known as Odds and may be taken with any Win Line bet or Come bet in an amount up to double the amount of your original bet. You may also lay odds on any Don’t Win or Don’t Come bet to win up to double your original bet. The bet will be in units determined by the odds for that Point. Odds on Come bets are off (not working) i.e. They cannot win or lose on the Come Out roll unless you designate that the bet is on (working).</div><div>&nbsp;</div><div>Place Bets - To Lose</div><div>You can make a bet in addition to your original Win/Don’t Win, Come/Don’t Come bets at any time after a Point is established. These bets are known as Odds and may be taken with any Win Line bet or Come bet in an amount up to double the amount of your original bet. You may also lay odds on any Don’t Win or Don’t Come bet to win up to double your original bet. The bet will be in units determined by the odds for that Point. Odds on Come bets are off (not working) i.e. They cannot win or lose on the Come Out roll unless you designate that the bet is on (working).</div><div>&nbsp;</div><div>Proposition Bets</div><div>Proposition bets are one-roll bets that can be bet on any roll of the dice. You win if your number is rolled. You lose if any other number is rolled. Winning bets placed on Any Craps i.e. 2, 3 and 12 pay 7.5 to 1. Winning bets placed on 2 or 12 individually pay 33 to 1. Winning bets on 3 or 11 individually pay 16 to 1 and winning bets on Any 7 pay 4 to 1. With Proposition bets (also known as Crap bets), if you have any winning and losing bet/s in the same roll, when the payout is calculated, the dealer will replace your losing bets for the next roll unless you say otherwise.</div><div>&nbsp;</div><div>Horn Bets</div><div>A Horn bet is a one-roll combination bet that consists of the four numbers 2, 3, 11 and 12. You win if any of these numbers are rolled. If any other number is rolled, you lose. Horn bets are accepted in even dollar units divisible by four with equal amounts bet on each of the four numbers. The odds are paid accordingly as if the numbers were bet individually.</div><div>&nbsp;</div><div>Horn High Bets</div><div>A Horn High bet is a one-roll bet that consists of the same numbers as the Horn bet i.e. 2, 3, 11 and 12. The difference between the Horn bet and the Horn High bet is that the Horn High bet is made in dollar units divisible by five instead of four. The player nominates which number they want the extra unit on. The Horn High bet has equal units on three of the numbers with double the amount on the nominated fourth number. Any of the numbers can be called the High. For example ‘Horn High 12.’ You will win if any of the four numbers are rolled on the next roll and lose if any other number is rolled.&nbsp;</div><div>&nbsp;</div><div>Hardways</div><div>Hardways are defined as even Point numbers. The numbers that can be a Point that are rolled with a double. As an example, Hardway 8 is two 4’s on the dice; Hardway 6 is two 3’s, etc. A Hard 4 would win, if the total of the dice add up to four but they must be 2 and 2. It would lose if the dice showed 3 and 1 or any combination of the total 7. Hardway bets can be made on any one individually or as many of them as you like. The bet can be made at any time, however, all Hardway bets are off on the Come Out roll unless you ask for them on.</div><div>&nbsp;</div><div>Buy Bets</div><div>Buy bets are the same as Place Bets to Win with one exception; a 5% commission is charged on the amount you bet to receive true odds. The commission is collected when the bet is made. Any Buy bet that has been removed will have the commission refunded. If a Buy bet wins and is left up, the commission must be collected again. Buy bets are indicated with a Buy marker button placed on them by the dealer.</div><div>&nbsp;</div><div>Lay Bets</div><div>Lay bets are the same as Place Bets to Lose with one exception; a 5% commission is charged on the amount you win to receive true odds. The commission is collected when the bet is made. Any Lay bet that has been removed will have the commission refunded. If a Lay bet wins and is left up, the commission must be collected again. Lay bets are indicated with a Lay marker button placed on them by the dealer. Learn to play Not sure how to play? Can’t tell a Natural Nine from a Blackjack? We have the answer. Just speak to one of our friendly dealers as they are experts in every table game. They will be able to assist you with any query you may have, from learning how to play, tournaments, a new table game, directions to one of our venues and even recommendations on where to eat here at The Star.</div><div><br></div></font><div><h2 open=\"\" sans\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 400;=\"\" line-height:=\"\" 1.4;=\"\" text-rendering:=\"\" optimizelegibility;=\"\" font-size:=\"\" 2.3125rem;=\"\" background-color:=\"transparent\" color:=\"\" rgb(85,=\"\" 85,=\"\" 85);\"=\"\" style=\"margin-top: 0.2rem; margin-bottom: 0.5rem; font-family: \" rgb(33,=\"\" 37,=\"\" 41);\"=\"\"><font color=\"#ffffff\">How to play: Dice</font></h2></div>', NULL, NULL, '2023-02-27 08:58:35');
INSERT INTO `games` (`id`, `name`, `alias`, `image`, `status`, `trending`, `featured`, `win`, `max_limit`, `min_limit`, `invest_back`, `probable_win`, `type`, `level`, `instruction`, `short_desc`, `created_at`, `updated_at`) VALUES
(11, 'Keno', 'keno', '6492c056a362e1687339094.png', 1, 1, 1, NULL, 100.00000000, 10.00000000, 0, '\"30\"', NULL, '{\"max_select_number\":\"10\",\"levels\":[{\"level\":\"4\",\"percent\":\"10\"},{\"level\":\"5\",\"percent\":\"20\"},{\"level\":\"6\",\"percent\":\"30\"},{\"level\":\"7\",\"percent\":\"40\"},{\"level\":\"8\",\"percent\":\"50\"},{\"level\":\"9\",\"percent\":\"60\"},{\"level\":\"10\",\"percent\":\"70\"}]}', '<p style=\"margin-bottom: 1rem; font-family: Lato; font-size: 17.5px; letter-spacing: 0.35px; line-height: 1.6;\"><font color=\"#ffffff\">Keno can pay a jackpot of up to $5,000,000 on a $2 ticket. It’s easy to see&nbsp;why Keno is so popular. Big money can be made on Keno for a very small&nbsp;investment. It’s a lottery-style game with payouts structured similarly as well.</font></p><p style=\"margin-bottom: 1rem; font-family: Lato; font-size: 17.5px; letter-spacing: 0.35px; line-height: 1.6;\"><font color=\"#ffffff\">Another reason the game has remained so popular is that Keno takes no skill&nbsp;to play. There are no difficult rules to learn or strategies to memorize. It is&nbsp;a game consisting solely of luck. This can be an attractive quality for those&nbsp;who don’t want to have to think, but rather just relax and see how their luck&nbsp;unfolds while gambling.</font></p><p style=\"margin-bottom: 1rem; font-family: Lato; font-size: 17.5px; letter-spacing: 0.35px; line-height: 1.6;\"><font color=\"#ffffff\">Keno offers a high amount of flexibility in choosing the type of gameplay you&nbsp;want. You can aim for higher payouts with a lower chance of winning. You can&nbsp;also choose to pick a lower amount of numbers, decreasing your jackpots but&nbsp;increasing your wins per round.</font></p><p style=\"margin-bottom: 1rem; font-family: Lato; font-size: 17.5px; letter-spacing: 0.35px; line-height: 1.6;\"><font color=\"#ffffff\">Another gameplay option available to Keno players is whether to play video&nbsp;Keno or in-person live Keno. This gives players the option of a fast or slow&nbsp;game speed. Video Keno can play around 16-19 rounds per minute. Compare this to&nbsp;live Keno, which is typically one round every 5-10 minutes.</font></p>', NULL, NULL, '2024-05-01 06:32:13'),
(12, 'Black Jack', 'blackjack', '641820a7bb36e1679302823.jpg', 1, 0, 0, 20.00000000, 100.00000000, 10.00000000, 0, '\"0\"', NULL, NULL, '<font color=\"#ffffff\">OBJECTIVE: The game is played against the dealer, and the object is to get as close a score to 21 as possible without exceeding that number. In order to win, you must beat the dealers’ total, however, if you go over 21 points that’s considered a bust and you automatically forfeit your bet.<br>OBJECTIVE: Each participant attempts to beat the dealer by getting a count as close to 21 as possible, without going over 21.<br>NUMBER OF PLAYERS: Up to 7 Players<br>NUMBER OF CARDS: One or More 52- deck cards<br>RANK OF CARDS: A (worth 11 or 1), K, Q, J (face cards worth 10), 10, 9, 8, 7, 6, 5, 4, 3, 2<br>TYPE OF GAME: Casino<br><br><br>Blackjack is a game of strategy and statistics. A good player will strive to consider all possibilities and choose moves that give the highest statistical chance for the greatest expected return.<br><b>OBJECTIVE:</b><br>The game is played against the dealer, and the object is to get as close a score to 21 as possible without exceeding that number. In order to win, you must beat the dealers’ total, however, if you go over 21 points that’s considered a bust and you automatically forfeit your bet.<br>CARD VALUES:<br>&nbsp;Kings, queens, and jacks are worth 10 points. Numbered cards retain their face value, meaning a two of clubs is worth two total points.<br>Aces are worth either one point or eleven points depending on what value advantages the player.<br>&nbsp;<br><b>HOW TO DEAL:</b><br>The dealer deals to his left. Each player receives one card face down and the dealer deals himself last. From there the dealer deals another round of cards, this time placing the card face up. If the dealer deals himself an ace as the face up card then he is required to ask players if they would like to purchase insurance. Insurance must equal half of the original bet placed. The dealer then flips over the second card and if he has blackjack all players that purchased insurance are given their original bets back and players that also have a blackjack are give their original bets back as well.<br>&nbsp;<br><b>HOW TO PLAY:</b><br>If the dealer does not deal himself an ace as a face-up card, then players are asked if they would like to “hit” or “stand”. To hit is to ask for another card, to stand is to pass. If you choose to hit and then receive a card that puts you over the value of 21, you’ve busted and are now out of that round. You may continue to hit until you are satisfied with your hand.<br><br><br></font>', 'Blackjack, also known as \"21,\" is a popular casino card game where players compete against the dealer. The objective is to get a hand total as close as possible to 21 without exceeding it. Players are dealt two cards at the beginning, and can choose to \"hit\" (take another card) or \"stand\" (keep their current hand).', NULL, '2024-05-01 07:07:24'),
(13, 'Mines', 'mines', '658138687ef751702967400.png', 1, 0, 0, NULL, 100.00000000, 10.00000000, 0, '\"40\"', NULL, NULL, '<font color=\"#ffffff\">OBJECTIVE: The game is played against the dealer, and the object is to get as close a score to 21 as possible without exceeding that number. In order to win, you must beat the dealers’ total, however, if you go over 21 points that’s considered a bust and you automatically forfeit your bet.<br>OBJECTIVE: Each participant attempts to beat the dealer by getting a count as close to 21 as possible, without going over 21.<br>NUMBER OF PLAYERS: Up to 7 Players<br>NUMBER OF CARDS: One or More 52- deck cards<br>RANK OF CARDS: A (worth 11 or 1), K, Q, J (face cards worth 10), 10, 9, 8, 7, 6, 5, 4, 3, 2<br>TYPE OF GAME: Casino<br><br><br>Blackjack is a game of strategy and statistics. A good player will strive to consider all possibilities and choose moves that give the highest statistical chance for the greatest expected return.<br><b>OBJECTIVE:</b><br>The game is played against the dealer, and the object is to get as close a score to 21 as possible without exceeding that number. In order to win, you must beat the dealers’ total, however, if you go over 21 points that’s considered a bust and you automatically forfeit your bet.<br>CARD VALUES:<br>&nbsp;Kings, queens, and jacks are worth 10 points. Numbered cards retain their face value, meaning a two of clubs is worth two total points.<br>Aces are worth either one point or eleven points depending on what value advantages the player.<br>&nbsp;<br><b>HOW TO DEAL:</b><br>The dealer deals to his left. Each player receives one card face down and the dealer deals himself last. From there the dealer deals another round of cards, this time placing the card face up. If the dealer deals himself an ace as the face up card then he is required to ask players if they would like to purchase insurance. Insurance must equal half of the original bet placed. The dealer then flips over the second card and if he has blackjack all players that purchased insurance are given their original bets back and players that also have a blackjack are give their original bets back as well.<br>&nbsp;<br><b>HOW TO PLAY:</b><br>If the dealer does not deal himself an ace as a face-up card, then players are asked if they would like to “hit” or “stand”. To hit is to ask for another card, to stand is to pass. If you choose to hit and then receive a card that puts you over the value of 21, you’ve busted and are now out of that round. You may continue to hit until you are satisfied with your hand.<br><br><br></font>', NULL, NULL, '2024-01-31 16:05:14'),
(14, 'Poker', 'poker', '659d119dc8d811704792477.png', 1, 0, 0, NULL, 100.00000000, 10.00000000, 0, '\"50\"', NULL, NULL, '<font color=\"#ffffff\"><div>Poker (Five-card draw) Hand Values</div><div>Below is a list of Poker hands ranked from highest to lowest in hand value.</div><div><br></div><div>Five of a Kind: The highest hand possible and can only be achieved when using wild cards. All cards have the same face value.</div><div>Ex. Having 4 queens and a wild card taking on the value of a queen.</div><div><br></div><div>Straight Flush: Five cards of the same suit that are in ascending order. Ex: (4,5,6,7,8) of spades. Like a regular straight, you can have and \'ace\' that counts as either a high card or low card. Ex: (Ace, King, Queen, Jack, Ten) of Hearts where the \'ace\' is the high card. This is also called a Royal Flush. A hand where the ace counts as the low card or 1 would look like&nbsp; (5,4,3,2,1) of hearts.</div><div><br></div><div>Four of a Kind: Four cards with the same value in a hand. Ex: 4 of Diamonds, 4 of Hearts, 4 of Spades, 4 of Clubs, 9 of Hearts.&nbsp; If two players have a \"four of a kind\" hand, the hand with the highest value set of cards wins. Ex: player A has (5,5,5,5,K), player B has (9,9,9,9,2). Player B would win. In certain versions of poker where there are many wildcards, it is possible that two or more players might have equal \"four of a kind.\" hands. In the event of a tie, the hand with the highest value fifth card would win.&nbsp;</div><div>&nbsp;</div><div><br></div><div>Full House: Three of a kind and a pair. Ex: Queen of Spades, Queen of Hearts, Queen of Diamonds, 4,4. If two players have a full house, the player with the higher value first three of a kind wins. Ex: King of Spades, King of Hearts, King of Diamonds, 4,4 beats Jack of Spades, Jack of Hearts, Jack of Clubs, 4,4.&nbsp;</div><div><br></div><div>Flush: All of the cards are of the same suit. Ex:(2,4,6,7,9) of Spades. In the event of a tie, the person holding the highest valued card wins. Ex: (2,3,5,7,J) of Hearts beats (3,5,6,7,9) of Clubs because the high card out of the two hands is the Jack. In the event that two or more players tie on the high card, the 2nd highest card determines the winner from all hands. Ex: (2,4,5,9,J) of Diamonds beats (4,5,7,8,J) of Clubs. Both of the hands contain a Jack as the high card, therefore the second highest card in each hand is used to determine the winner. The second highest card is the 9 of diamonds in the first hand which beats the 8 of Clubs in the second hand.</div><div><br></div><div>Straight: Five cards of any suit in ascending order. Ex:(3,4,5,6,7) of any suit. An \'Ace\' can counts as either a high card or low card. Ex: (Ace, King, Queen, Jack, Ten) of any suit where the \'ace\' is the high card. A hand where the ace counts as the low card or 1 would look like&nbsp; (5,4,3,2,1) of any suit. In the vent of a tie, the hand with the highest straight wins. Ex: (3,4,5,6,7) of any suit beats (2,3,4,5,6) of any suit.</div><div><br></div><div>Three of a Kind: Three cards with the same value and two that are not a pair. Ex: 7 of Hearts, 7 of Diamonds, 7 of Spades, 2 of Clubs, 6 of Clubs. If two or more players hold the same hand due to wild cards, the player with the highest valued card of the remaining two cards wins. Ex: (5,5,5,2,9) beats (5,5,5,2,4).</div><div><br></div><div>Two Pair: Two sets of distinct pair of cards. Ex: (2,2,K,K). The highest set of pair wins in the event of a tie. Ex: (5,5,7,7) beats (4,4,5,5).</div><div><br></div><div>Pair: One pair of cards in the hand. Ex: (5,5,7,J)</div><div>High Card: This is any hand that does not have any of the properties of the hands listed above. In the event that no player has at least a pair, the player with the highest card wins.</div></font>', NULL, NULL, '2024-01-31 16:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `game_logs`
--

CREATE TABLE `game_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `game_id` int NOT NULL DEFAULT '0',
  `user_select` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shuffled_cards` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `invest` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `win_amo` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `try` int DEFAULT '0',
  `win_status` tinyint(1) DEFAULT '0',
  `game_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mines` tinyint NOT NULL DEFAULT '0',
  `mine_available` int NOT NULL DEFAULT '0',
  `gold_count` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` int UNSIGNED NOT NULL DEFAULT '0',
  `code` int DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `supported_currencies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `crypto` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `form_id`, `code`, `name`, `alias`, `image`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 101, 'Paypal', 'Paypal', '664da0440dbe11716363332.png', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-owud61543012@business.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-22 01:35:32'),
(2, 0, 102, 'Perfect Money', 'PerfectMoney', '663a3920e30a31715091744.png', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"hR26aw02Q1eEeUPSIfuwNypXX\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:22:24'),
(3, 0, 103, 'Stripe Hosted', 'Stripe', '663a39861cb9d1715091846.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:24:06'),
(4, 0, 104, 'Skrill', 'Skrill', '663a39494c4a91715091785.png', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"---\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:23:05'),
(5, 0, 105, 'PayTM', 'Paytm', '664da05827c561716363352.png', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-22 01:35:52'),
(6, 0, 106, 'Payeer', 'Payeer', '664da0284256d1716363304.png', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, '2019-09-14 07:14:22', '2024-05-22 01:35:04'),
(7, 0, 107, 'PayStack', 'Paystack', '664da04f125c01716363343.png', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_cd330608eb47970889bca397ced55c1dd5ad3783\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_8a0b1f199362d7acc9c390bff72c4e81f74e2ac3\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, '2019-09-14 07:14:22', '2024-05-22 01:35:43'),
(9, 0, 109, 'Flutterwave', 'Flutterwave', '664d9fe1a81be1716363233.png', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-22 01:33:53'),
(10, 0, 110, 'RazorPay', 'Razorpay', '664da079273ae1716363385.png', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-22 01:36:25'),
(11, 0, 111, 'Stripe Storefront', 'StripeJs', '663a3995417171715091861.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:24:21'),
(12, 0, 112, 'Instamojo', 'Instamojo', '664d9feb13d071716363243.png', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-22 01:34:03'),
(13, 0, 501, 'Blockchain', 'Blockchain', '664d9f97462141716363159.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, '2019-09-14 07:14:22', '2024-05-22 01:32:39'),
(15, 0, 503, 'CoinPayments', 'Coinpayments', '664d9fcc279f61716363212.png', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"---------------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"---------------------\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"USDT.BEP20\":\"Tether USD (BSC Chain)\",\"USDT.ERC20\":\"Tether USD (ERC20)\",\"USDT.TRC20\":\"Tether USD (Tron/TRC20)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, '2019-09-14 07:14:22', '2024-05-22 01:33:32'),
(16, 0, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', '664d9fd5b7df41716363221.png', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"6515561\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-22 01:33:41'),
(17, 0, 505, 'Coingate', 'Coingate', '664d9fc310b8b1716363203.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"6354mwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-22 01:33:23'),
(18, 0, 506, 'Coinbase Commerce', 'CoinbaseCommerce', '664d9fb69217b1716363190.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, '2019-09-14 07:14:22', '2024-05-22 01:33:10'),
(24, 0, 113, 'Paypal Express', 'PaypalSdk', '664da03b8c86b1716363323.png', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-22 01:35:23'),
(25, 0, 114, 'Stripe Checkout', 'StripeV3', '663a39afb519f1715091887.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"whsec_lUmit1gtxwKTveLnSe88xCSDdnPOt8g5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, '2019-09-14 07:14:22', '2024-05-07 02:24:47'),
(27, 0, 115, 'Mollie', 'Mollie', '664d9fff5d8461716363263.png', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"vi@gmail.com\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-22 01:34:23'),
(30, 0, 116, 'Cashmaal', 'Cashmaal', '664d9fa04c3f71716363168.png', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"3748\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"546254628759524554647987\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, '2024-05-22 01:32:48'),
(36, 0, 119, 'Mercado Pago', 'MercadoPago', '664d9ff5e1dd01716363253.png', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"APP_USR-7924565816849832-082312-21941521997fab717db925cf1ea2c190-1071840315\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-05-22 01:34:13'),
(37, 0, 120, 'Authorize.net', 'Authorize', '664d9f6ce96ed1716363116.png', 1, '{\"login_id\":{\"title\":\"Login ID\",\"global\":true,\"value\":\"59e4P9DBcZv\"},\"transaction_key\":{\"title\":\"Transaction Key\",\"global\":true,\"value\":\"47x47TJyLw2E7DbR\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-05-22 01:31:56'),
(46, 0, 121, 'NMI', 'NMI', '664da0074ea0a1716363271.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"2F822Rw39fx762MaV7Yy86jXGTC7sCDy\"}}', '{\"AED\":\"AED\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"RUB\":\"RUB\",\"SEC\":\"SEC\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2024-05-22 01:34:31'),
(50, 0, 507, 'BTCPay', 'BTCPay', '664d9f758e9b01716363125.png', 1, '{\"store_id\":{\"title\":\"Store Id\",\"global\":true,\"value\":\"HsqFVTXSeUFJu7caoYZc3CTnP8g5LErVdHhEXPVTheHf\"},\"api_key\":{\"title\":\"Api Key\",\"global\":true,\"value\":\"4436bd706f99efae69305e7c4eff4780de1335ce\"},\"server_name\":{\"title\":\"Server Name\",\"global\":true,\"value\":\"https:\\/\\/testnet.demo.btcpayserver.org\"},\"secret_code\":{\"title\":\"Secret Code\",\"global\":true,\"value\":\"SUCdqPn9CDkY7RmJHfpQVHP2Lf2\"}}', '{\"BTC\":\"Bitcoin\",\"LTC\":\"Litecoin\"}', 1, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.BTCPay\"}}', NULL, NULL, '2024-05-22 01:32:05'),
(51, 0, 508, 'Now payments hosted', 'NowPaymentsHosted', '664da01c31eba1716363292.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"--------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------------\"}}', '{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}', 1, '', NULL, NULL, '2024-05-22 01:34:52'),
(52, 0, 509, 'Now payments checkout', 'NowPaymentsCheckout', '664da0106ebe71716363280.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"---------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 1, '', NULL, NULL, '2024-05-22 01:34:40'),
(53, 0, 122, '2Checkout', 'TwoCheckout', '663a39b8e64b91715091896.png', 1, '{\"merchant_code\":{\"title\":\"Merchant Code\",\"global\":true,\"value\":\"253248016872\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"eQM)ID@&vG84u!O*g[p+\"}}', '{\"AFN\": \"AFN\",\"ALL\": \"ALL\",\"DZD\": \"DZD\",\"ARS\": \"ARS\",\"AUD\": \"AUD\",\"AZN\": \"AZN\",\"BSD\": \"BSD\",\"BDT\": \"BDT\",\"BBD\": \"BBD\",\"BZD\": \"BZD\",\"BMD\": \"BMD\",\"BOB\": \"BOB\",\"BWP\": \"BWP\",\"BRL\": \"BRL\",\"GBP\": \"GBP\",\"BND\": \"BND\",\"BGN\": \"BGN\",\"CAD\": \"CAD\",\"CLP\": \"CLP\",\"CNY\": \"CNY\",\"COP\": \"COP\",\"CRC\": \"CRC\",\"HRK\": \"HRK\",\"CZK\": \"CZK\",\"DKK\": \"DKK\",\"DOP\": \"DOP\",\"XCD\": \"XCD\",\"EGP\": \"EGP\",\"EUR\": \"EUR\",\"FJD\": \"FJD\",\"GTQ\": \"GTQ\",\"HKD\": \"HKD\",\"HNL\": \"HNL\",\"HUF\": \"HUF\",\"INR\": \"INR\",\"IDR\": \"IDR\",\"ILS\": \"ILS\",\"JMD\": \"JMD\",\"JPY\": \"JPY\",\"KZT\": \"KZT\",\"KES\": \"KES\",\"LAK\": \"LAK\",\"MMK\": \"MMK\",\"LBP\": \"LBP\",\"LRD\": \"LRD\",\"MOP\": \"MOP\",\"MYR\": \"MYR\",\"MVR\": \"MVR\",\"MRO\": \"MRO\",\"MUR\": \"MUR\",\"MXN\": \"MXN\",\"MAD\": \"MAD\",\"NPR\": \"NPR\",\"TWD\": \"TWD\",\"NZD\": \"NZD\",\"NIO\": \"NIO\",\"NOK\": \"NOK\",\"PKR\": \"PKR\",\"PGK\": \"PGK\",\"PEN\": \"PEN\",\"PHP\": \"PHP\",\"PLN\": \"PLN\",\"QAR\": \"QAR\",\"RON\": \"RON\",\"RUB\": \"RUB\",\"WST\": \"WST\",\"SAR\": \"SAR\",\"SCR\": \"SCR\",\"SGD\": \"SGD\",\"SBD\": \"SBD\",\"ZAR\": \"ZAR\",\"KRW\": \"KRW\",\"LKR\": \"LKR\",\"SEK\": \"SEK\",\"CHF\": \"CHF\",\"SYP\": \"SYP\",\"THB\": \"THB\",\"TOP\": \"TOP\",\"TTD\": \"TTD\",\"TRY\": \"TRY\",\"UAH\": \"UAH\",\"AED\": \"AED\",\"USD\": \"USD\",\"VUV\": \"VUV\",\"VND\": \"VND\",\"XOF\": \"XOF\",\"YER\": \"YER\"}', 0, '{\"approved_url\":{\"title\": \"Approved URL\",\"value\":\"ipn.TwoCheckout\"}}', NULL, NULL, '2024-05-07 02:24:56'),
(54, 0, 123, 'Checkout', 'Checkout', '664d9fa98c8471716363177.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------\"},\"public_key\":{\"title\":\"PUBLIC KEY\",\"global\":true,\"value\":\"------\"},\"processing_channel_id\":{\"title\":\"PROCESSING CHANNEL\",\"global\":true,\"value\":\"------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"AUD\":\"AUD\",\"CAN\":\"CAN\",\"CHF\":\"CHF\",\"SGD\":\"SGD\",\"JPY\":\"JPY\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-05-22 01:32:57'),
(56, 0, 510, 'Binance', 'Binance', '664d9f879a11b1716363143.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"tsu3tjiq0oqfbtmlbevoeraxhfbp3brejnm9txhjxcp4to29ujvakvfl1ibsn3ja\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"jzngq4t04ltw8d4iqpi7admfl8tvnpehxnmi34id1zvfaenbwwvsvw7llw3zdko8\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"231129033\"}}', '{\"BTC\":\"Bitcoin\",\"USD\":\"USD\",\"BNB\":\"BNB\"}', 1, '{\"cron\":{\"title\": \"Cron Job URL\",\"value\":\"ipn.Binance\"}}', NULL, NULL, '2024-05-22 01:32:23'),
(57, 0, 124, 'SslCommerz', 'SslCommerz', '663a397a70c571715091834.png', 1, '{\"store_id\":{\"title\":\"Store ID\",\"global\":true,\"value\":\"---------\"},\"store_password\":{\"title\":\"Store Password\",\"global\":true,\"value\":\"----------\"}}', '{\"BDT\":\"BDT\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"SGD\":\"SGD\",\"INR\":\"INR\",\"MYR\":\"MYR\"}', 0, NULL, NULL, NULL, '2024-05-07 02:23:54'),
(58, 0, 125, 'Aamarpay', 'Aamarpay', '664d9f3f08eaa1716363071.png', 1, '{\"store_id\":{\"title\":\"Store ID\",\"global\":true,\"value\":\"---------\"},\"signature_key\":{\"title\":\"Signature Key\",\"global\":true,\"value\":\"----------\"}}', '{\"BDT\":\"BDT\"}', 0, NULL, NULL, NULL, '2024-05-22 01:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int DEFAULT NULL,
  `gateway_alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `max_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) NOT NULL DEFAULT '0.00',
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `gateway_parameter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'email configuration',
  `sms_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `firebase_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `global_shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kv` tinyint(1) NOT NULL DEFAULT '0',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sms notification, 0 - dont send, 1 - send',
  `pn` tinyint(1) NOT NULL DEFAULT '1',
  `force_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT '0',
  `secure_password` tinyint(1) NOT NULL DEFAULT '0',
  `agree` tinyint(1) NOT NULL DEFAULT '0',
  `multi_language` tinyint(1) NOT NULL DEFAULT '1',
  `dc` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'dc => deposit commission',
  `rb` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'rb => register bonus\r\n',
  `registration` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_customized` tinyint(1) NOT NULL DEFAULT '0',
  `paginate_number` int NOT NULL DEFAULT '0',
  `currency_format` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>Both\r\n2=>Text Only\r\n3=>Symbol Only',
  `register_bonus` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `last_cron` datetime DEFAULT NULL,
  `available_version` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `socialite_credentials` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `cur_text`, `cur_sym`, `email_from`, `email_from_name`, `email_template`, `sms_template`, `sms_from`, `push_title`, `push_template`, `base_color`, `secondary_color`, `mail_config`, `sms_config`, `firebase_config`, `global_shortcodes`, `kv`, `ev`, `en`, `sv`, `sn`, `pn`, `force_ssl`, `maintenance_mode`, `secure_password`, `agree`, `multi_language`, `dc`, `rb`, `registration`, `active_template`, `system_customized`, `paginate_number`, `currency_format`, `register_bonus`, `last_cron`, `available_version`, `socialite_credentials`, `created_at`, `updated_at`) VALUES
(1, 'Xaxino', 'USD', '$', 'no-reply@viserlab.com', 'ViserAdmin', '<html>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n<title>\r\n</title>\r\n<style type=\"text/css\">\r\n	.ReadMsgBody {\r\n		width: 100%;\r\n		background-color: #ffffff;\r\n	}\r\n	.ExternalClass {\r\n		width: 100%;\r\n		background-color: #ffffff;\r\n	}\r\n	.ExternalClass,\r\n	.ExternalClass p,\r\n	.ExternalClass span,\r\n	.ExternalClass font,\r\n	.ExternalClass td,\r\n	.ExternalClass div {\r\n		line-height: 100%;\r\n	}\r\n	html {\r\n		width: 100%;\r\n	}\r\n	body {\r\n		-webkit-text-size-adjust: none;\r\n		-ms-text-size-adjust: none;\r\n		margin: 0;\r\n		padding: 0;\r\n	}\r\n	table {\r\n		border-spacing: 0;\r\n		table-layout: fixed;\r\n		margin: 0 auto;\r\n		border-collapse: collapse;\r\n	}\r\n	table table table {\r\n		table-layout: auto;\r\n	}\r\n	.yshortcuts a {\r\n		border-bottom: none !important;\r\n	}\r\n	img:hover {\r\n		opacity: 0.9 !important;\r\n	}\r\n	a {\r\n		color: #0087ff;\r\n		text-decoration: none;\r\n	}\r\n	.textbutton a {\r\n		font-family: \"open sans\", arial, sans-serif !important;\r\n	}\r\n	.btn-link a {\r\n		color: #ffffff !important;\r\n	}\r\n	@media only screen and (max-width: 480px) {\r\n		body {\r\n			width: auto !important;\r\n		}\r\n		*[class=\"table-inner\"] {\r\n			width: 90% !important;\r\n			text-align: center !important;\r\n		}\r\n		*[class=\"table-full\"] {\r\n			width: 100% !important;\r\n			text-align: center !important;\r\n		} /* image */\r\n		img[class=\"img1\"] {\r\n			width: 100% !important;\r\n			height: auto !important;\r\n		}\r\n	}\r\n\r\n</style>\r\n<table bgcolor=\"#030442\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td height=\"50\">\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n				<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n					<tbody>\r\n						<tr>\r\n							<td align=\"center\" width=\"600\">\r\n								<table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n									<tbody>\r\n										<tr>\r\n											<td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n												<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n													<tbody>\r\n														<tr>\r\n															<td height=\"20\">\r\n															</td>\r\n														</tr>\r\n														<tr>\r\n															<td align=\"center\" style=\"font-family: Open sans, Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">\r\n															This is a System Generated Email</td>\r\n														</tr>\r\n														<tr>\r\n															<td height=\"20\">\r\n															</td>\r\n														</tr>\r\n													</tbody>\r\n												</table>\r\n											</td>\r\n										</tr>\r\n									</tbody>\r\n								</table>\r\n								<table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n									<tbody>\r\n										<tr>\r\n											<td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n												<table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n													<tbody>\r\n														<tr>\r\n															<td height=\"35\">\r\n															</td>\r\n														</tr>\r\n														<tr>\r\n															<td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n																<a href=\"#\">\r\n																	<img style=\"display:block; line-height:0px; font-size:0px; border:0px; width: 240px;\" width=\"240px\" src=\"https://viserlab.com/assets/images/logoIcon/logo-dark.png\" alt=\"img\">\r\n																</a>\r\n															</td>\r\n														</tr>\r\n														<tr>\r\n															<td height=\"40\"></td>\r\n														</tr>\r\n														<tr>\r\n															<td align=\"center\" style=\"font-family: Open Sans, Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">\r\n															Hello {{fullname}} ({{username}}) </td>\r\n														</tr>\r\n														<tr>\r\n															<td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n																<table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n																	<tbody>\r\n																		<tr>\r\n																			<td height=\"20\" style=\" border-bottom:3px solid #0087ff;\">\r\n																			</td>\r\n																		</tr>\r\n																	</tbody>\r\n																</table>\r\n															</td>\r\n														</tr>\r\n														<tr>\r\n															<td height=\"30\"></td>\r\n														</tr>\r\n														<tr>\r\n															<td align=\"left\" style=\"font-family: Open sans, Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">\r\n															{{message}}</td>\r\n														</tr>\r\n														<tr>\r\n															<td height=\"60\"></td>\r\n														</tr>\r\n													</tbody>\r\n												</table>\r\n											</td>\r\n										</tr>\r\n										<tr>\r\n											<td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n												<table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n													<tbody>\r\n														<tr>\r\n															<td height=\"10\"></td>\r\n														</tr>\r\n														<tr>\r\n															<td class=\"preference-link\" align=\"center\" style=\"font-family: Open sans, Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n																© 2023 <a href=\"#\">{{site_name}}</a> &nbsp;. All Rights Reserved. </td>\r\n														</tr>\r\n														<tr>\r\n															<td height=\"10\"></td>\r\n														</tr>\r\n													</tbody>\r\n												</table>\r\n											</td>\r\n										</tr>\r\n									</tbody>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n					</tbody>\r\n				</table>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td height=\"60\"></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</html>', 'hi {{fullname}} ({{username}}), {{message}}', 'ViserAdmin', NULL, NULL, 'E3BC3F', '', '{\"name\":\"php\"}', '{\"name\":\"nexmo\",\"clickatell\":{\"api_key\":\"----------------\"},\"infobip\":{\"username\":\"------------8888888\",\"password\":\"-----------------\"},\"message_bird\":{\"api_key\":\"-------------------\"},\"nexmo\":{\"api_key\":\"----------------------\",\"api_secret\":\"----------------------\"},\"sms_broadcast\":{\"username\":\"----------------------\",\"password\":\"-----------------------------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\"},\"text_magic\":{\"username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', '{\"apiKey\":\"-----------\",\"authDomain\":\"---------\",\"projectId\":\"-----------\",\"storageBucket\":\"------------\",\"messagingSenderId\":\"-----------\",\"appId\":\"-----------\",\"measurementId\":\"----------\",\"serverKey\":\"-----------\"}', '{\n    \"site_name\":\"Name of your site\",\n    \"site_currency\":\"Currency of your site\",\n    \"currency_symbol\":\"Symbol of currency\"\n}', 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 'basic', 0, 20, 1, 10.00000000, '2024-05-21 07:36:39', '0', '{\"google\":{\"client_id\":\"------------------------\",\"client_secret\":\"------------------------\",\"status\":0},\"facebook\":{\"client_id\":\"------------------------\",\"client_secret\":\"------------------------\",\"status\":0},\"linkedin\":{\"client_id\":\"------------------------\",\"client_secret\":\"------------------------\",\"status\":0}}', NULL, '2024-05-22 01:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `guess_bonuses`
--

CREATE TABLE `guess_bonuses` (
  `id` bigint UNSIGNED NOT NULL,
  `chance` int NOT NULL DEFAULT '0',
  `percent` decimal(5,2) DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guess_bonuses`
--

INSERT INTO `guess_bonuses` (`id`, `chance`, `percent`, `status`, `alias`, `created_at`, `updated_at`) VALUES
(1, 1, 15.00, 1, NULL, NULL, NULL),
(2, 2, 10.00, 1, NULL, NULL, NULL),
(3, 3, 5.00, 1, NULL, NULL, NULL),
(4, 1, 1.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(5, 2, 2.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(6, 3, 3.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(7, 4, 4.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(8, 5, 5.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(9, 6, 6.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(10, 7, 7.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(11, 8, 8.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(12, 9, 9.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(13, 10, 10.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(14, 11, 11.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(15, 12, 12.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(16, 13, 13.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(17, 14, 14.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(18, 15, 15.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(19, 16, 16.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(20, 17, 17.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(21, 18, 18.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(22, 19, 19.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(23, 20, 20.00, 1, 'mines', '2023-12-25 05:16:34', NULL),
(24, 1, 50.00, 1, 'poker', '2023-12-25 05:22:29', NULL),
(25, 2, 45.00, 1, 'poker', '2023-12-25 05:22:29', NULL),
(26, 3, 40.00, 1, 'poker', '2023-12-25 05:22:29', NULL),
(27, 4, 35.00, 1, 'poker', '2023-12-25 05:22:29', NULL),
(28, 5, 30.00, 1, 'poker', '2023-12-25 05:22:29', NULL),
(29, 6, 25.00, 1, 'poker', '2023-12-25 05:22:29', NULL),
(30, 7, 20.00, 1, 'poker', '2023-12-25 05:22:29', NULL),
(31, 8, 15.00, 1, 'poker', '2023-12-25 05:22:29', NULL),
(32, 9, 10.00, 1, 'poker', '2023-12-25 05:22:29', NULL),
(33, 10, 5.00, 1, 'poker', '2023-12-25 05:22:29', NULL),
(34, 1, 130.00, 1, 'number_guess', '2024-01-31 16:11:13', NULL),
(35, 2, 110.00, 1, 'number_guess', '2024-01-31 16:11:13', NULL),
(36, 3, 100.00, 1, 'number_guess', '2024-01-31 16:11:13', NULL),
(37, 4, 90.00, 1, 'number_guess', '2024-01-31 16:11:13', NULL),
(38, 5, 10.00, 1, 'number_guess', '2024-01-31 16:11:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: not default language, 1: default language',
  `image` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `is_default`, `image`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 1, '664c4dbd13b6a1716276669.png', '2020-07-06 03:47:55', '2024-05-21 01:31:09'),
(13, 'Spanish', 'es', 0, '664c4e18c05091716276760.png', '2024-05-21 01:31:23', '2024-05-21 01:32:40'),
(14, 'Franch', 'fr', 0, '664c4dd52065e1716276693.png', '2024-05-21 01:31:33', '2024-05-21 01:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `sender` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_to` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notification_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_read` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `push_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_status` tinyint(1) NOT NULL DEFAULT '1',
  `email_sent_from_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_sent_from_address` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_status` tinyint(1) NOT NULL DEFAULT '1',
  `sms_sent_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subject`, `push_title`, `email_body`, `sms_body`, `push_body`, `shortcodes`, `email_status`, `email_sent_from_name`, `email_sent_from_address`, `sms_status`, `sms_sent_from`, `push_status`, `created_at`, `updated_at`) VALUES
(1, 'BAL_ADD', 'Balance - Added', 'Your Account has been Credited', '{{site_name}}', '<div><div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been added to your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}&nbsp;</span></font><br></div><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin note:&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 12px; font-weight: 600; white-space: nowrap; text-align: var(--bs-body-text-align);\">{{remark}}</span></div>', '{{amount}} {{site_currency}} credited in your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin note is \"{{remark}}\"', '{{site_name}}', '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, '{{site_name}}', NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:18:28'),
(2, 'BAL_SUB', 'Balance - Subtracted', 'Your Account has been Debited', '{{site_name}}', '<div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been subtracted from your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}</span></font><br><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin Note: {{remark}}</div>', '{{amount}} {{site_currency}} debited from your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin Note is {{remark}}', '{{site_name}}', '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:24:11'),
(3, 'DEPOSIT_COMPLETE', 'Deposit - Automated - Successful', 'Deposit Completed Successfully', '{{site_name}}', '<div>Your deposit of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been completed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#000000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Received : {{method_amount}} {{method_currency}}<br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Deposit successfully by {{method_name}}', '{{site_name}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:25:43'),
(4, 'DEPOSIT_APPROVE', 'Deposit - Manual - Approved', 'Your Deposit is Approved', '{{site_name}}', '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>is Approved .<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Admin Approve Your {{amount}} {{site_currency}} payment request by {{method_name}} transaction : {{trx}}', '{{site_name}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:26:07'),
(5, 'DEPOSIT_REJECT', 'Deposit - Manual - Rejected', 'Your Deposit Request is Rejected', '{{site_name}}', '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}} has been rejected</span>.<span style=\"font-weight: bolder;\"><br></span></div><div><br></div><div><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge: {{charge}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number was : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">if you have any queries, feel free to contact us.<br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><br><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">{{rejection_message}}</span><br>', 'Admin Rejected Your {{amount}} {{site_currency}} payment request by {{method_name}}\r\n\r\n{{rejection_message}}', '{{site_name}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"rejection_message\":\"Rejection message by the admin\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-04-05 03:45:27'),
(6, 'DEPOSIT_REQUEST', 'Deposit - Manual - Requested', 'Deposit Request Submitted Successfully', '{{site_name}}', '<div>Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>submitted successfully<span style=\"font-weight: bolder;\">&nbsp;.<br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Deposit requested by {{method_name}}. Charge: {{charge}} . Trx: {{trx}}', '{{site_name}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:29:19'),
(7, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', '{{site_name}}', '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', '{{site_name}}', '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, '{{site_name}}', NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:05'),
(8, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have reset your password', '{{site_name}}', '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not change that, please contact us as soon as possible.</font></span></p>', 'Your password has been changed successfully', '{{site_name}}', '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-04-05 03:46:35'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', '{{site_name}}', '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', '{{site_name}}', '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:51'),
(10, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', '{{site_name}}', '<div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', 'Your email verification code is: {{code}}', '{{site_name}}', '{\"code\":\"Email verification code\"}', 1, '{{site_name}}', NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-10-12 06:19:59'),
(11, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', '{{site_name}}', '---', 'Your phone verification code is: {{code}}', '{{site_name}}', '{\"code\":\"SMS Verification Code\"}', 0, '{{site_name}}', NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 19:24:37'),
(12, 'WITHDRAW_APPROVE', 'Withdraw - Approved', 'Withdraw Request has been Processed and your money is sent', '{{site_name}}', '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been Processed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You will get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">-----</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\">Details of Processed Payment :</font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\"><span style=\"font-weight: bolder;\">{{admin_details}}</span></font></div>', 'Admin Approve Your {{amount}} {{site_currency}} withdraw request by {{method_name}}. Transaction {{trx}}', '{{site_name}}', '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"admin_details\":\"Details provided by the admin\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 20:50:16'),
(13, 'WITHDRAW_REJECT', 'Withdraw - Rejected', 'Withdraw Request has been Rejected and your money is refunded to your account', '{{site_name}}', '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been Rejected.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You should get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">----</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><br></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\">{{amount}} {{currency}} has been&nbsp;<span style=\"font-weight: bolder;\">refunded&nbsp;</span>to your account and your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}}</span><span style=\"font-weight: bolder;\">&nbsp;{{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">-----</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\">Details of Rejection :</font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\"><span style=\"font-weight: bolder;\">{{admin_details}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br><br><br><br><br></div><div></div><div></div>', 'Admin Rejected Your {{amount}} {{site_currency}} withdraw request. Your Main Balance {{post_balance}}  {{method_name}} , Transaction {{trx}}', '{{site_name}}', '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after fter this action\",\"admin_details\":\"Rejection message by the admin\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 20:57:46'),
(14, 'WITHDRAW_REQUEST', 'Withdraw - Requested', 'Withdraw Request Submitted Successfully', '{{site_name}}', '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been submitted Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You will get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br><br><br></div>', '{{amount}} {{site_currency}} withdraw requested by {{method_name}}. You will get {{method_amount}} {{method_currency}} Trx: {{trx}}', '{{site_name}}', '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after fter this transaction\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-21 04:39:03'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', '{{site_name}}', '{{message}}', '{{message}}', '{{site_name}}', '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(16, 'KYC_APPROVE', 'KYC Approved', 'KYC has been approved', '{{site_name}}', 'Your KYC has been approved by Admin', 'Your KYC has been approved by Admin', '{{site_name}}', '[]', 1, '{{site_name}}', NULL, 1, NULL, 0, NULL, '2022-10-12 06:21:25'),
(17, 'KYC_REJECT', 'KYC Rejected', 'KYC has been rejected', '{{site_name}}', '<span style=\"color: rgb(33, 37, 41);\">Your KYC has been rejected by Admin</span><br>', 'Your KYC has been rejected by Admin', '{{site_name}}', '{\"reason\":\"Rejection Reason\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, NULL, '2022-10-12 06:22:07'),
(18, 'REFERRAL_COMMISSION', 'Referral Commission', 'User Referral Commission', '{{site_name}}', 'Bonus: {{amount}}&nbsp;<span style=\"color: rgb(33, 37, 41);\">{{currency}}</span>,&nbsp;<div>Current Balance: {{post_balance}},</div><div><span style=\"font-family: &quot;Open Sans&quot;, sans-serif;\">{{level}}</span><span style=\"font-family: &quot;Open Sans&quot;, sans-serif;\">,</span></div><div>Transaction: {{trx}},</div>', 'Bonus: {{amount}} {{currency}}, \r\nTransaction: {{trx}},', '{{site_name}}', '{\"amount\":\"Amount\", \"post_balance\":\"Post Balance\", \"trx\":\"Transaction\",\"level\":\"Level\", 	\"currency\":\"currency\" }', 1, '{{site_name}}', NULL, 1, NULL, 0, NULL, '2022-08-31 04:48:11'),
(19, 'REGISTER_BONUS', 'Register Bonus', 'User Register Bonus', '{{site_name}}', '<div>Hi, {{username}}</div><div></div><div>You have got {{amount}} {{site_currency}} for register bonus.&nbsp;<br></div><div>Your current Balance: {{post_balance}} {{site_currency}},</div><div>Transaction Number : {{trx}},</div>', 'You have got {{amount}} {{site_currency}} for register bonus. \r\nTransaction: {{trx}},', '{{site_name}}', '{\"trx\":\"Transaction number\",\"amount\":\"Bonus Amount\",\"username\":\"User name\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, '{{site_name}}', NULL, 1, NULL, 0, NULL, '2022-09-01 10:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `seo_content`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '/', 'templates.basic.', '[\"statistics\",\"game\",\"about\",\"why_choose_us\",\"trx_win\",\"cta\",\"how_work\",\"faq\",\"referral\",\"testimonial\",\"blog\"]', NULL, 1, '2020-07-11 06:23:58', '2023-03-14 10:57:25'),
(4, 'Blog', 'blog', 'templates.basic.', NULL, NULL, 1, '2020-10-22 01:14:43', '2022-08-31 07:46:38'),
(5, 'Contact', 'contact', 'templates.basic.', NULL, NULL, 1, '2020-10-22 01:14:53', '2022-08-31 07:48:18'),
(19, 'About Us', 'about-us', 'templates.basic.', '[\"about\",\"why_choose_us\",\"faq\",\"testimonial\"]', NULL, 0, '2022-08-24 09:25:39', '2022-08-24 09:26:12'),
(20, 'Games', 'games', 'templates.basic.', '[\"how_work\",\"why_choose_us\"]', NULL, 1, '2022-08-24 09:26:42', '2023-03-14 10:52:24'),
(21, 'HOME', '/', 'templates.sunfyre.', '[\"game\",\"why_choose_us\",\"trx_win\",\"testimonial\",\"how_work\",\"faq\",\"blog\",\"cta\"]', NULL, 1, '2020-07-11 10:23:58', '2024-01-02 10:27:35'),
(22, 'About', 'about', 'templates.sunfyre.', '[\"about\",\"how_work\",\"testimonial\",\"referral\",\"faq\"]', NULL, 0, '2023-12-27 09:46:30', '2023-12-27 09:47:00'),
(23, 'Game', 'game', 'templates.sunfyre.', NULL, NULL, 1, '2023-12-27 09:47:34', '2023-12-27 09:47:34'),
(24, 'Blog', 'blog', 'templates.sunfyre.', NULL, NULL, 1, '2024-01-02 10:29:47', '2024-01-02 11:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint UNSIGNED NOT NULL,
  `level` int NOT NULL DEFAULT '0',
  `percent` decimal(5,2) DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `support_message_id` int UNSIGNED NOT NULL DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `support_ticket_id` int UNSIGNED NOT NULL DEFAULT '0',
  `admin_id` int UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `post_balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `trx_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `update_logs`
--

CREATE TABLE `update_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_log` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `firstname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dial_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_by` int UNSIGNED DEFAULT NULL,
  `balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: banned, 1: active',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: sms unverified, 1: sms verified',
  `ver_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kyc_rejection_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kv` tinyint(1) NOT NULL DEFAULT '0',
  `profile_complete` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_by` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `user_ip` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint UNSIGNED NOT NULL,
  `method_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `final_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `after_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `withdraw_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel, ',
  `admin_feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` int UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_limit` decimal(28,8) DEFAULT '0.00000000',
  `max_limit` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `fixed_charge` decimal(28,8) DEFAULT '0.00000000',
  `rate` decimal(28,8) DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) DEFAULT NULL,
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_logs`
--
ALTER TABLE `commission_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cron_jobs`
--
ALTER TABLE `cron_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cron_job_logs`
--
ALTER TABLE `cron_job_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cron_schedules`
--
ALTER TABLE `cron_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_logs`
--
ALTER TABLE `game_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guess_bonuses`
--
ALTER TABLE `guess_bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update_logs`
--
ALTER TABLE `update_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commission_logs`
--
ALTER TABLE `commission_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cron_jobs`
--
ALTER TABLE `cron_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cron_job_logs`
--
ALTER TABLE `cron_job_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cron_schedules`
--
ALTER TABLE `cron_schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_tokens`
--
ALTER TABLE `device_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `game_logs`
--
ALTER TABLE `game_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guess_bonuses`
--
ALTER TABLE `guess_bonuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `update_logs`
--
ALTER TABLE `update_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
