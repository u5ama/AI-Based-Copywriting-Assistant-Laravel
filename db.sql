# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.6.4-MariaDB)
# Database: typeskip
# Generation Time: 2021-12-24 03:23:46 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ad_responses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ad_responses`;

CREATE TABLE `ad_responses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ads_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ad_responses_user_id_foreign` (`user_id`),
  CONSTRAINT `ad_responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table ads
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ads`;

CREATE TABLE `ads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `ads_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avoid_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_outputs` int(11) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ads_user_id_foreign` (`user_id`),
  CONSTRAINT `ads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table ads_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ads_items`;

CREATE TABLE `ads_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ads_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table content_tool_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content_tool_items`;

CREATE TABLE `content_tool_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `input_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_info_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_info_placeholder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` int(11) NOT NULL DEFAULT 0,
  `input_limit` int(11) NOT NULL DEFAULT 80,
  `input_options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_type` enum('input','select','multi-select','number','textarea') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'input',
  `status` enum('active','de-active') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_tool_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `content_tool_items` WRITE;
/*!40000 ALTER TABLE `content_tool_items` DISABLE KEYS */;

INSERT INTO `content_tool_items` (`id`, `input_title`, `input_info_text`, `input_info_placeholder`, `slug`, `required`, `input_limit`, `input_options`, `input_type`, `status`, `content_tool_id`, `created_at`, `updated_at`, `key`)
VALUES
	(14,'Brand Name','','e. g. Typeskip','brand-name',1,80,NULL,'input','active',5,'2021-12-05 01:04:59','2021-12-23 01:18:09','brand_name'),
	(15,'Company or Product Description','','Write high quality content, product descriptions, and more using just a few keywords or one-liners','company-or-product-description',1,400,NULL,'textarea','active',5,'2021-12-05 01:04:59','2021-12-23 01:18:09','product_description'),
	(16,'Add Keywords','','Add Keyword','outputs',1,10,'','multi-select','active',5,'2021-12-05 01:04:59','2021-12-23 01:18:09','key_words'),
	(17,'Brand Name','','e. g. Typeskip','brand-name',1,80,NULL,'input','active',6,'2021-12-20 14:49:20','2021-12-23 01:17:10','brand_name'),
	(18,'Company or Product Description','','Write high quality content, product descriptions, and more using just a few keywords or one-liners','company-or-product-description',1,400,NULL,'textarea','active',6,'2021-12-20 14:49:20','2021-12-23 01:17:10','product_description'),
	(19,'Add Keywords','','Add Keyword','outputs',1,10,'','multi-select','active',6,'2021-12-20 14:49:20','2021-12-23 01:17:10','key_words'),
	(20,'Brand Name','','e. g. Typeskip','brand-name',1,80,NULL,'input','active',7,'2021-12-23 01:16:48','2021-12-23 01:16:48','brand_name'),
	(21,'Company or Product Description','','Write high quality content, product descriptions, and more using just a few keywords or one-liners','company-or-product-description',1,400,NULL,'textarea','active',7,'2021-12-23 01:16:48','2021-12-23 01:16:48','product_description'),
	(22,'Add Keywords','','Add Keyword','outputs',1,10,'','multi-select','active',7,'2021-12-23 01:16:48','2021-12-23 01:16:48','key_words'),
	(23,'Product Name','','e.g Press It','ProductName',1,80,NULL,'input','active',8,'2021-12-23 01:17:30','2021-12-23 01:17:30',NULL),
	(24,'Product Description','','e.g. Marketers','ProductDescription',1,80,NULL,'input','active',8,'2021-12-23 01:17:30','2021-12-23 01:17:30',NULL),
	(25,'Product Description','','e.g. Marketers','ProductDescription',1,80,NULL,'input','active',8,'2021-12-23 01:17:30','2021-12-23 01:17:30',NULL),
	(26,'Outputs','','Outputs','outputs',1,10,'1,2,3,4,5,6,7,8,9,10','select','active',8,'2021-12-23 01:17:30','2021-12-23 01:17:30',NULL),
	(27,'Brand Name','','e. g. Typeskip','brand-name',1,80,NULL,'input','active',9,'2021-12-23 01:17:39','2021-12-23 01:17:39','brand_name'),
	(28,'Company or Product Description','','Write high quality content, product descriptions, and more using just a few keywords or one-liners','company-or-product-description',1,400,NULL,'textarea','active',9,'2021-12-23 01:17:39','2021-12-23 01:17:39','product_description'),
	(29,'Add Keywords','','Add Keyword','outputs',1,10,'','multi-select','active',9,'2021-12-23 01:17:39','2021-12-23 01:17:39','key_words'),
	(30,'Image Description','','Wedding Cake on table','ImageDescription',1,400,NULL,'textarea','active',10,'2021-12-23 01:17:50','2021-12-23 01:17:50',NULL),
	(31,'Product Description','','e.g. Our three tiered, chocolate cake is perfect for your wedding','ProductDescription',1,400,NULL,'textarea','active',10,'2021-12-23 01:17:50','2021-12-23 01:17:50',NULL),
	(32,'Outputs','','Outputs','outputs',1,10,'1,2,3,4,5,6,7,8,9,10','select','active',10,'2021-12-23 01:17:50','2021-12-23 01:17:50',NULL),
	(33,'Brand Name','','e. g. Typeskip','brand-name',1,80,NULL,'input','active',11,'2021-12-23 01:17:59','2021-12-23 01:17:59','brand_name'),
	(34,'Company or Product Description','','Write high quality content, product descriptions, and more using just a few keywords or one-liners','company-or-product-description',1,400,NULL,'textarea','active',11,'2021-12-23 01:17:59','2021-12-23 01:17:59','product_description'),
	(35,'Add Keywords','','Add Keyword','outputs',1,10,'','multi-select','active',11,'2021-12-23 01:17:59','2021-12-23 01:17:59','key_words'),
	(36,'Topic','','How to write engaging Tweets','UserTopic',1,80,NULL,'input','active',12,'2021-12-23 01:18:20','2021-12-23 01:18:20',NULL),
	(37,'Product Description','','e.g. Marketers','UserAudience',1,80,NULL,'input','active',12,'2021-12-23 01:18:20','2021-12-23 01:18:20',NULL),
	(38,'Outputs','','Outputs','outputs',1,10,'1,2,3,4,5,6,7,8,9,10','select','active',12,'2021-12-23 01:18:20','2021-12-23 01:18:20',NULL);

/*!40000 ALTER TABLE `content_tool_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table content_tools
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content_tools`;

CREATE TABLE `content_tools` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `context` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_path_inverse` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','de-active') COLLATE utf8mb4_unicode_ci NOT NULL,
  `temperature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.7',
  `max_tokens` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '170',
  `top_p` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `frequency_penalty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `presence_penalty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `stop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '---',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#EB6E2D',
  PRIMARY KEY (`id`),
  UNIQUE KEY `content_tools_uri_unique` (`uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `content_tools` WRITE;
/*!40000 ALTER TABLE `content_tools` DISABLE KEYS */;

INSERT INTO `content_tools` (`id`, `title`, `short_description`, `uri`, `context`, `category`, `icon_path`, `icon_path_inverse`, `status`, `temperature`, `max_tokens`, `top_p`, `frequency_penalty`, `presence_penalty`, `stop`, `created_at`, `updated_at`, `color_code`)
VALUES
	(5,'Product Description','Launching a new product? Let\'s couple it with a catchy product description.','product-description','','product','/assets/admin/images/newTemplate/product-description.png','','active','0','0','0','0','0','---','2021-12-05 01:04:59','2021-12-23 01:18:09','#1DA1F2'),
	(6,'Facebook Video Script','Create video script for Facebook ads using a short description and keywords','facebook-video-script','Write a script for an advertisement using product description\\n-----------\\nName: Visight Massager\\nInput: Your eyes require special care. Whether it\'s from everyday eye fatigue from using computers, reading or watching TV, or if you suffer from headaches, insomnia, and even eyebags - Visight Massager will help to relieve all these problems. The scientifically-proven and patented combination of acupoint, warmth, and vibration massage plus music is a proven solution for the optimum care of your eyes.\\n-----------\\nOutput: \\nProblem: Suffering from insomnia and headaches?\\nSolution: Visight Massager relieves migraines and headaches in minutes using a combination of acupoint, warmth and vibrations.\\nBenefit 1: Visight massages your acupoints on your templates, and uses heat therapy to give you spa-like experience right at home.\\nBenefit 2: The vibration massage helps you relax your eyes, relieving eye fatigue, insomnia and eyebags.\\nBenefit 3: it is a proven solution for optimum care of your eyes and never struggling with headaches again.\\nCTA: Shop now before we run out of stock.\\n-----------\\nName: Mosquito Zapper\\nDescription: Introducing The Mosquito Zapper. Light up your world and stop disease carrying Mosquitos and other pesky insects with a simple push of a button. It’s Non-toxic, Kid-Safe And Pet Friendly. Push one button to activate the powerfully bright 3 mode (High-Medium-Low) 180 lumen lantern. It’s waterproof and built to last. For indoor and outdoor use.\\n-----------\\nScript: \\nProblem: Mosquitoes in your house and yard can be a nuisance\\nSolution: Introducing The Mosquito Zapper. Light up your world and stop disease carrying insects of all kinds with a simple push of a button.\\nBenefit 1: It’s Non-toxic, Kid-Safe And Pet Friendly making sure it’s safe for all ages.\\nBenefit 2: Durable, Lightweight, and water resistant to withstand any weather conditions, so you can enjoy life outside 24 hours a day without fear!\\nBenefit 3: It has 3 Lantern Modes\\nCTA: Shop now\\n-----------\\nName: BlendJet\\nDescription: We created the BlendJet portable blender so you can make anything healthy smoothies, anywhere in the world — from a mountaintop to your kitchen countertop. It’s easy and convenient to use at home, at work, outdoors, at the gym, in the car, at the beach, on vacation or wherever the day takes you.\\n-----------\\nScript:\\nProblem: Are you feeling bloated and struggling to eat healthy?\\nSolution: BlendJet Portable Blender allows you to make healthy smoothies anywhere! \\nBenefit 1: It’s easy to use - start the blender with a push of a button\\nBenefit 2: It’s convenient - use it anytime you want a smoothie\\nBenefit 3: It’s portable making it perfect for smoothies on the go\\nCTA: What are you waiting for?\\n-----------\\nName: Frisco\\nDescription: The Frisco pet bed is a rectangular bed that will keep any pet comfortable. It is made of high quality, comfy materials that are built to last.\\n-----------\\nScript: \\nProblem: Are your pets unable to sleep in their hard and uncomfortable beds? \\nSolution: Let your pets snooze the day away with the highly comfortable Frisco pet bet.\\nBenefit 1: It’s soft and comfortable\\nBenefit 2: It’s easy to clean\\nBenefit 3: It’s durable\\nCTA: Click to learn more\\n-----------\\nName:{{ Product Name }}\\n Description: {{ Description }} \\n-----------\\nScript: {{ Output }}','product','/assets/admin/images/newTemplate/facebook-new.png','','active','0','0','0','0','0','---','2021-12-20 14:49:20','2021-12-23 01:17:10','#3b5998'),
	(7,'Facebook Ad','A limitless supply of original Facebook Ad Copy','facebook-ad','Write a creative Facebook ad using the Product Description:\\n---\\nName: Goli\\nProduct Description: Goli gummies are apple cider vinegar gummies. Helps improve digestion, become more energetic, and get clearer skin.\\n---\\nKeywords: vegan, gluten-free, gelatine-free\\n---\\nFacebook Ad:\\nGoli gummies are a delicious, vegan, gluten-free and gelatine-free way to increase your intake of apple cider vinegar. Our formula will make Apple Cider Vinegar gummies accessible to anyone and everyone. Relieve digestion issues, experience more energy, watch your skin clear up and feel as your body detoxes with Goli Gummies. Enjoy all of the benefits of Apple Cider Vinegar without the downside of drinking it. Goli is an excellent and easy way to incorporate Apple Cider Vinegar into your daily routine.\\n---\\nName: Blendjet\\nProduct Description: We created the BlendJet portable blender so you can make anything you want, anywhere in the world — from a mountaintop to your kitchen countertop. It’s easy and convenient to use at home, at work, outdoors, at the gym, in the car, at the beach, on vacation or wherever the day takes you.\\n---\\nKeywords: protein shakes, no mess\\n---\\nFacebook Ad:\\nConvenient smoothies and protein shakes anywhere, even around the house! With BlendJet, you can make a smoothie in 20 seconds! The BlendJet is our latest portable blender, made so you can take it anywhere in the world, and make whatever you want wherever you are. It’s easy to use right out of the box—just add your ingredients, press a button and enjoy! No mess, no hassle and practically cleans itself!\\n---\\nName: Eyeology Eye Massager\\nProduct Description: The Eyeology Eye Massager uses safe air compression technology and adopts kneading, trigger point therapy and rhythmic percussion massaging to give you the gentle touch you need to battle against headaches, eye strain, sleeping problems, stress and more. \\n---\\nKeywords: relieve migraines, reduces eye-bags, improves sleep\\n---\\nFacebook Ad:\\nThe Eyeology Eye Massager is designed to provide your eyes with the gentle touch they need for combating headaches, eye strain, sleeping problems, stress and more. The unique air compression technology offers a safe alternative to manual pressure techniques that could result in injury or establish an undesirable habit when used too frequently.\\n\\n🧠 Relieves Migraines In Minutes\\n👀 Helps with Dry & Tired Eyes\\n👁 Reduces Eye-Bags & Dark Under-Eye Circles\\n💤 Improves Sleep Quality\\n---\\nName: Allbirds\\nProduct Description: Take stormy weather in stride with the running shoe that uses natural materials to give you extra grip, plus a mid cut knit sock collar to keep your feet warm and dry.\\n---\\nKeywords: rubber sole,  4mm midsole\\n---\\nFacebook Ad:\\nThe Allbirds running shoe is a game-changing approach to winter running and the ultimate in comfort. Striking the perfect balance between traction and lightness, our rubber sole brings refined grip for climbing hillsides or tracing an icy trail while also ensuring better protection from snow, slush, dirt clings, pockets of runoff water and all other hazards that accompany you on your adventures outside during these upcoming colder months. The high stretch knit upper provides both warmth and breathability without sacrificing support with a 4mm forefoot cushioning midsole for comfort.\\n---\\nName: Away\\nProduct Description: Our Large checked suitcase is built to last, with a durable polycarbonate hard shell and 360° spinner wheels that ensure a smooth ride. Plus, its interior compression system and hidden laundry bag make packing that much easier.\\n---\\nKeywords: 40% recycled, eco-friendly\\n---\\nFacebook Ad:\\nThe Away Large Checked suitcase is built to last. Designed for durability, convenience, and style this piece has everything you need to look professional whether you’re heading out for a two-week business trip or going on a family getaway abroad. Not only does it have durable polycarbonate hard shell with 360° rotating wheels that will allow you to glide through the airport effortlessly but also comes equipped with interior compression system and clever hidden laundry bag so packing your clothes just became easier than ever before. With 40% recycled premium material, this suitcase is eco-friendly and worry free unlike other big brands.\\n---\\nName: Spirit\\nProduct Description: Open your door to the world of grilling with the sleek Spirit II E-210 gas grill. This two burner grill is built to fit small spaces, and packed with features such as the powerful GS4 grilling system, iGrill capability, and convenient side tables for placing serving trays. Welcome to the Weber family.\\n---\\nKeywords: home, variety of tools\\n---\\nFacebook Ad:\\nThe Spirit II E-210 is the ideal grill to invite friends to enjoy your home-cooked food. It has a sleek design that will fit with any backyard, and is perfect for entertaining small groups of guests. It’s equipped with a powerful GS4 grilling system which provides an even heating surface that will cook your food evenly. You can control the temperature with the digital control panel, which allows you to set the temperature and timer. The side tables are perfect for serving food, and the porcelain enameled cast iron cooking grates ensure even heat distribution as you cook. Welcome to the Weber family.\\n---\\nName: Zameen\\nProduct Description: Online platform for real estate. Buy and sell houses and land\\n---\\nKeywords: Pakistan, Property\\n---\\nFacebook Ad:\\nZameen is Pakistan’s leading online platform for all real estate needs. We provide you with the best options for buying and selling your property, with a wide range of listings available on our website. With a secure and hassle-free platform, we allow you to easily search for your desired property by location or price range, and view all the vital information you need to make an informed decision.\\n---\\nName:{{ Company Name }}}\\nProduct Description: {{ Product Description }}\\n---\\nKeywords: {{ Keywords}}\\n---\\nFacebook Ad: {{ Output }}\\n','product','/assets/admin/images/newTemplate/facebook-new.png','','active','0','0','0','0','0','---','2021-12-23 01:16:48','2021-12-23 01:16:48','#3b5998'),
	(8,'Google My Business Updates','Keep your customers in the know on Google','GMBUpdates','Write a Google My Business Description using Product Description:\n---\nProduct Name: Pushpress\n--- \nDescription: Pushpress allows your gym to schedule and manage Gym Classes online.\n---\nProduct description:\nPushpress is a powerful and easy-to-use online booking system for your fitness facility. It makes it easier than ever to schedule classes, manage memberships, process payments, and more. If you`ve been looking for an affordable solution that will help you grow your business then look no further. Pushpress has the best features at the best price!\n---\nProduct Name: Candlesmith\n--- \nDescription: Candlesmith sells hand-poured candles with amazing fragrances that are made in the UK.\n---\nProduct description:\nCandlesmith was founded in 2012 by siblings, James and Charlotte. They wanted to create a sustainable business that would allow them to work together as well as with other talented people. Candlesmith started off selling candles on Etsy but quickly grew from there into what it is today - a lifestyle brand consisting of handmade English candles in an array of sophisticated scents. The company uses natural ingredients including soy wax, cotton wicks and high-quality fragrances which are made in the UK and shipped fresh worldwide. \nThe hand-poured candles come in glass jars or tins for easy storage or gifting; they last up to 50 hours each so you\'ll have plenty of time to enjoy your purchase! \n---\nProduct Name: QuickBands\n--- \nDescription: Quickbands are resistance bands that you can attach to any door which helps you workout at home and on the go\n---\nTone of Voice: Professional\n---\nProduct description:\nQuickbands are a set of resistance bands that attach to any door. This simple yet effective design allows you to work out anytime and anywhere, without the need for bulky gym equipment or expensive memberships. Quickbands come in four different levels of resistance so whether you\'re just getting started or looking for more advanced workouts, there\'s something for everyone.\n---\nProduct Name: AllBirds\n--- \nDescription: AllBirds are super comfortable knit shoes made from wool.\n---\nTone of Voice: Professional\n---\nProduct description:\nAllbirds are comfortable, sustainable, and stylish shoes. They\'re made from wool that doesn\'t itch because it\'s antimicrobial and moisture-wicking. The design is sleek enough to wear with a suit or jeans (or both). They come in a variety of colors that will go with anything you own. Allbirds are not just for anyone; they\'re for the good people who want to make an impact on the world by wearing comfortable shoes without sacrificing style.\n---\nProduct Name: Goli\n--- \nDescription: Goli gummies are apple cider vinegar gummies. Helps improve digestion, become more energetic, and get clearer skin.\n---\nTone of Voice: Professional\n---\nProduct description:\nGoli gummies are a delicious, healthy way to get the benefits of apple cider vinegar. They taste like candy and come in three flavors- green apple, strawberry banana, and mixed berry. Plus they\'re gluten-free, vegan, non-gmo, and made with all-natural ingredients. Goli is perfect for people who don\'t love the taste of apple cider vinegar or can`t stomach it because it helps improve digestion and become more energetic while also getting clearer skin. Give them a try!\n---\nProduct Name: Philadelphia Business Lawyer Sarah Holmes \n--- \nDescription: We\'re offering flat fee legal packages to small business owners. Whether you need a contract drafted, investor agreement or a full start-up package, Attorney Holmes provides help in a hands-on, no-nonsense manner.\n---\nTone of Voice: Professional\n---\nProduct description:\nBusiness announcement:  We\'re here to help you build your small business and want to make sure you know about our flat fee legal packages. If you need contracts, start-up packages or any other legal needs, we\'ll get the job done right the first time for a low price that won\'t break your bank! Contact us today for more information on how we can help building your dream company.  We look forward to hearing from you soon!\n---\nProduct Name:  The Fanklin Bar\n--- \nDescription: We have a new dish on the menu: Jumbo Lump Crab Cake, Truffle Mash, Sauteed Spinach \n---\nTone of Voice: Casual\n---\nProduct description:\nWe\'re not sure if you\'ve heard, but we have a new dish on the menu! Our Jumbo Lump Crab Cake is served with Truffle Mashed Potatoes and Sauteed Spinach. It\'s perfect for lunch or as an appetizer before dinner. We hope you\'ll stop by to try it soon! Remember, The Franklin Bar has been cooking up dishes in Nashville since 1884. For more information please visit our website at http://www.thefranklinbar.com/menu/dinner/. Have any questions about this new dish? Send us an email today!\n---\nProduct Name:  Houwzer Realtors\n--- \nDescription: For sale in Philadelphia, PA. 4 Bed / 2 Bath home for $359,900. Contact me to learn more.\n---\nTone of Voice: Professional\n---\nBusiness announcement:  \nLoving this 4 beds, 2 baths home for sale in Philadelphia? It has a lot of potential and I\'m ready to help you make it your own. Houwzer Realtors is here for all your real estate needs. Contact me today to learn more about the property or schedule an appointment with one of our agents. We hope we can be part of your next big move! Houwzer Realtors - Philadelphia\'s Choice For Real Estate.\n---\nProduct Name: {{ ProductName }}\n--- \nDescription: {{ ProductDescription  }}\n---\nTone of Voice:\n---\nBusiness Announcement:','GMB','public/ts/images/new-icons/twitter-icon-73.png','<i class=\"fab fa-twitter\" style=\"color: #1DA1F2;\"></i>','active','0.7','100','1','0','0','---','2021-12-23 01:17:30','2021-12-23 01:17:30','#1DA1F2'),
	(9,'Google Ad','Create Google Ad with exact requirement and layouts','google-ad','Use Input text and Tone to write a creative Google ad as Output.\\n-----------\\nName: Goli\\nInput: Each bottle of Goli contains 60 delicious vegan, non-GMO, gluten-free & gelatine-free Apple Cider gummies. Our formula will make Apple Cider Vinegar gummies accessible to anyone and everyone. Better digestion, more energy, clearer skin, detox, immunity: Relieve digestion issues, experience more energy, watch your skin clear up and feel as your body detoxes with Goli Gummies. Enjoy all of the benefits of Apple Cider Vinegar without the downside of drinking it. Goli is an excellent and easy way to incorporate Apple Cider Vinegar into your daily routine.\\nTone: Professional\\n-----------\\nOutput:\\nGoli Gummies are Gluten-Free, Vegan, Non-GMO & Gelatin Free - 100% Natural & Plant-Based. Try Goli risk-free & take advantage of our 30-Day Money-Back Guarantee! Shop Now! Infused With Superfoods. Helps Reduce Weight.\\n-----------\\nName: BlendJet\\nInput: We created the BlendJet portable blender so you can make anything you want, anywhere in the world — from a mountaintop to your kitchen countertop. It’s easy and convenient to use at home, at work, outdoors, at the gym, in the car, at the beach, on vacation or wherever the day takes you.\\nTone: Professional\\n-----------\\nOutput:\\nWith BlendJet, enjoy Big Blender Power on the Go. Perfectly Blended Smoothies Anywhere. Get Yours Now! Original Portable Blender. Durable & Built To Last. Portable Yet Powerful. Free 2-Day Shipping! \\n-----------\\nName: Magic Spoon\\nInput: Magic Spoon cereal is high-protein, low-sugar, keto-friendly, and gluten-free. Available in Cocoa, Frosted, Fruity, Blueberry, Peanut Butter, and Cinnamon.\\nTone: Friendly\\n-----------\\nOutput:\\nMagic Spoon, healthy Cereal That Tastes Too Good to be True. High Protein, Low Carb, Sweet & Delicious. Have Your Cereal and Eat It Too. Great Taste with Grown-Up Ingredients. Nothing Artificial. 5-Star Reviewed On Yotpo. Low Sugar. Gluten Free. 100% Money Back Guarantee.\\n-----------\\nName: AllBirds\\nInput: Take stormy weather in stride with AllBirds running shoes that use natural materials to give you extra grip, plus a mid cut knit sock collar to keep your feet warm and dry.\\nTone: Professional\\n-----------\\nOutput:\\nthe world\'s most comfortable shoes, flats, and clothing made with natural materials like merino wool and eucalyptus. FREE shipping & returns.\\n-----------\\nName: Away Bags\\nInput: Dream up your future travels with our second collection of Away Bags by Serena Williams. Our Large checked suitcase is built to last, with a durable polycarbonate hard shell and 360° spinner wheels that ensure a smooth ride. Plus, its interior compression system and hidden laundry bag make packing that much easier.\\nTone: Professional\\n-----------\\nOutput:\\nInspired by thousands of real travelers. Free shipping & returns. Thoughtfully designed for the way you actually travel. 100 Day Return Policy. Polycarbonate Shell. TSA-Approved Combo Lock. Lightweight.\\n-----------\\nName: Birchbox\\nInput: As a Birchbox subscriber, you’ll receive a monthly box (it’s reusable and recyclable) filled with five expert-selected premium samples and easy-to-follow insider tips. If you fall in love with a sample, we sell the full size version. Looking for something specific? It’s probably in our shop. Curious about Clean Beauty? We have a curated discovery kit. We’re here to make this easy. We’re here to make this fun.\\nTone: Professional\\n-----------\\nOutput:\\nGet Your Personalized Mix Of 5 Hair, Makeup, Skincare & Fragrance Samples. We\'ve Upgraded Your Beauty Box Experience. Sign Up Today To Get Started. 4+ Million Reviews. Exclusive Kits & Samplers. Find Products That Work. Customize Your Box.\\n-----------\\nName: Casper\\nInput: Get the sleep you\'ve always dreamed of. Casper\'s award-winning mattresses, sheets & more are quality-crafted and ethically built in the USA. Free shipping and returns.\\nTone: Professional\\n-----------\\nOutput:\\nShop Casper\'s best memory foam and hybrid mattresses for side, back, and stomach sleepers online. Find the perfect size and get free shipping and returns.\\n-----------\\nName:{{  }}}\\nInput: {$input[\'CompanyDescription\']}\\n keywords: {$input[\'add_keywords\']} \\nTone: Professional\\n-----------\\nOutput:\\n','product','/assets/admin/images/newTemplate/google-symbol.png','','active','0','0','0','0','0','---','2021-12-23 01:17:39','2021-12-23 01:17:39','#0F9D58'),
	(10,'Instagram Product Post','Create compelling posts for instagram','instagram-post','Write an Instagram Caption for a product using image description:\\n---\\nName: Coco Kind\\n---\\nImage Description: A woman holding Coco Kind sunscreen\\n---\\nProduct Description: This lightweight, non-irritating mineral-based daily sunscreen lotion with SPF 32 uses non-nano zinc oxide, blue phytoplankton, and microalgae to protect skin against everyday stressors such as UVA rays (aging) and UVB rays (burning), pollution blue light\\nin doing so, it helps prevent signs of premature aging, such as dark spots, fine lines, and wrinkles while protecting skin against sunburn. \\n---\\nInstagram Caption: \\nDo you carry spf in your bag on the go? Here\'s why you should! \\nRegardless of the SPF number, the sun\'s rays actually break down all sunscreens with exposure. Even the recommended amount of SPF will naturally break down on your skin over time when exposed to sunlight. Without reapplication, you\'re more at risk for skin damage from UV rays, so we always recommend reapplying every two hours (or after coming into contact with water) to keep skin protected.\\n---\\nName: JetPack Protein Smoothies\\n---\\nImage Description: Woman adding JetPack Smoothie powder to milk.\\n---\\nProduct Description:  We partnered with culinary experts behind some of the most iconic beverages in the world to craft the perfect formulas to fuel your body and flavors to delight your taste buds. Designed for use with your BlendJet portable blender, each single-serving JetPack Protein Smoothie is loaded with 15 grams of plant-based protein, plus the freshest fruits picked at peak ripeness.\\n---\\nInstagram Caption: \\nFuel to feel good. 💪\\n\\nGet your protein fix anywhere with our NEW JetPack Protein Smoothies. 🍓🍌 Made with real pieces of freeze-dried fruit and 15g of plant-based protein, they\'re packed with nutrients and bursting with fresh fruit flavor.\\n---\\nName: Acupressure Gua Sha Spoon\\n---\\nImage Description: Image of Acupressure Gua Sha Spoon in its box\\n---\\nProduct Description:  Designed specifically for more precise work and a deeper massage, this tool can help sculpt facial features like the cheeks, drain puffiness from the face, melt facial tension through acupressure points, and release jaw tension.\\n---\\nInstagram Caption:\\nOur Acupressure Gua Sha Spoon is designed for a deeper massage and more precise sculpting. Use it on acupressure points, the cheekbones + along the jaw and feel tension melt away. \\n---\\nName: Avacado Serum\\n---\\nImage Description: Picture of Avacado Serum.\\n---\\nProduct Description:  Reduce visible redness and support the skin barrier with the soothing and calming Avocado Ceramide Recovery Serum. Formulated to target dehydration, irritation, and redness, this lightweight milky texture wraps sensitive skin in a healing layer of actives to restore skin to its natural, healthy state. This innovative recipe is created with a blend of powerful plant-based ingredients such as nutrient-rich avocado extract + butter, strengthening ceramides, and calming allantoin and rice milk to help strengthen and recover irritated, compromised skin.\\n---\\nInstagram Caption:\\nOur favorite when we need a major boost of soothing hydration. ✨ Here\'s how our Avacado Serum works to nourish skin so you can glow: Avocado Serum actively soothes skin while strengthening the skin barrier with 5 skin-identical ceramides, allantoin, rice milk, and avocado.\\n---\\nName: Aloe Gua Sha\\n---\\nImage Description: Woman using the Aloe Gua Sha Jade Roller on her face\\n---\\nProduct Description: The jade facial roller is a Chinese skincare tool that has been used for thousands of years. Perfected throughout the centuries, this facial massager was built to have a de-puffing, soothing effect on the skin.\\n---\\nInstagram Caption: The Jade Facial Roller is a facial massage tool that\'s been used in Chinese skincare for thousands of years. Use it after cleansing to de-puff the skin + soothe with a gentle massage + the cooling effects of the jade. The Aloe Gua Sha Jade Roller is perfect for sensitive skin types and can be used on the face and neck to release stress.\\n---\\nImage Description: {{$ImageDescription}}\\n---\\nProduct Description: {{$ProductDescription}}\\n---\\nInstagram Caption:','instagram','public/ts/images/new-icons/instagram.png','<i class=\"fab fa-instagram\" style=\"color: #1DA1F2;\"></i>','active','0.7','100','1','0','0','---','2021-12-23 01:17:50','2021-12-23 01:17:50','#1DA1F2'),
	(11,'PAS Framework','Generate Problem - Agitate - Solution using product Description.','PAS-Framework','Generate Problem - Agitate - Solution using product Description:\\n---\\nName: Pushpress\\n---\\nProduct description: Pushpress allows your gym to schedule and manage Gym Classes online.\\n---\\nTone of Voice: Professional\\n---\\nProblem: Your gym is a community. You want to provide your members with an easy way for them to find out what\'s happening at the gym, and you also want a tool that lets you manage classes online.\\n\\nAgitate: Pushpress allows gyms to schedule and manage fitness classes online in one place, so that you can better engage with your members and increase retention rates.\\n\\nSolution: As soon as your members sign up for pushpress they\'ll be able to see upcoming class schedules, book their spot in advance or pay on arrival, view descriptions of each class (including photos), filter by instructor or time slot - all from their phone! They will also receive SMS reminders about booked classes which means no more missing workouts because they forgot! For instructors it\'s easy too - just login once to create new classes and upload photos/descriptions/schedule times etc., then sit back while people sign up!\\n---\\nName: Zameen\\n---\\nProduct description: Zameen is an online real estate platform where buyers can list land and houses and sellers can make offers to buy them\\n---\\nTone of Voice: Professional\\n---\\nProblem: Buying and selling land and houses in Pakistan is a cumbersome process. The real estate market is far from transparent, there are many middlemen involved, and the whole system lacks trust.\\n\\nAgitate: Zameen makes it easy to buy or sell any property online within minutes by connecting buyers with sellers directly. All you need to do is list your property on our website for free! We try to make the entire experience as simple as possible so that both buyers and sellers can save time, money, energy etc...\\n\\nSolution: Zameen provides a platform where everyone can get their dream home without going through the hassle of meeting multiple agents who only have their own interests in mind. It also helps people find good deals on land & houses which they can purchase immediately if they like what they see! Our user-friendly interface allows you to list properties quickly while making sure all information provided about them is accurate. You will be able to communicate directly with potential buyers via email or message.\\n---\\nName: Goli\\n---\\nProduct description: Goli gummies are apple cider vinegar gummies. Helps improve digestion, become more energetic, and get clearer skin.\\n---\\nTone of Voice: Professional\\n---\\nProblem: A lot of people are interested in taking apple cider vinegar but find it hard to take because the taste is so strong.\\n\\nAgitate: Goli gummies make it easier for you to get all the benefits of apple cider vinegar without having to deal with a bitter taste. The flavor is sweet and delicious, making it easy for anyone to take them daily.\\n\\nSolution: These gummies help improve digestion, become more energetic, and also clear up your skin! They\'re made with high-quality ingredients that provide real results. You can try these today by ordering from our website!\\n---\\nName: Blendjet\\n---\\nProduct description: We created the BlendJet portable blender so you can make anything you want, anywhere in the world — from a mountaintop to your kitchen countertop. It’s easy and convenient to use at home, at work, outdoors, at the gym, in the car, at the beach, on vacation or wherever the day takes you.\\n---\\nTone of Voice: Professional\\n---\\nProblem: Portable blenders are either too bulky and hard to clean, or they’re not powerful enough for the job.\\n\\nAgitate: Blending your favorite smoothie can be a hassle when you’re on the go. You have to schlep around heavy containers and hope that everything fits in your bag. And if you want to blend something more than just fruit, like ice cream or frozen yogurt, it becomes even harder. If you don’t have access to a blender at work or school, it can seem impossible to get a healthy meal in during the day.\\n\\nSolution: Blendjet is here for all of those situations — whether you need an extra boost of protein in the morning before work, want some fresh juice on your way home from class, or just need something cold after working out at the gym...Blendjet has got you covered! With Blendjet\'s portable blending technology built into its compact design (which fits conveniently into any bag.\\n---\\nName: AllBirds\\n---\\nProduct description: AllBirds are super comfortable knit shoes made from wool.\\n---\\nTone of Voice: Professional\\n---\\nProblem: Most shoes are made from leather, plastic and rubber. These materials don’t breathe well, which makes your feet sweat. This is bad for the environment and it also makes you stink!\\n\\nAgitate: AllBirds solve this problem by using wool instead of leather or plastic. Wool is a natural material that breathes really well so your feet stay cool and dry all day long. It also naturally absorbs odors so you can wear them longer before washing them!\\n\\nSolution: We use high-quality merino wool to make our shoes comfortable, soft and breathable so you can be active without smelling like a locker room at the end of the day!\\n---\\nName: { User Name }\\n---\\nProduct description: {{ Product Description }}\\n---\\nTone of Voice:  {{ Tone of Voice }} \\n---\\n {{ Output }}','product','assets/admin/images/newTemplate/pas-framework.png','','active','0','0','0','0','0','---','2021-12-23 01:17:59','2021-12-23 01:17:59','#800080'),
	(12,'TweetStorm','Create valuable TweetStorms to create engagment on Twitter.','tweetstorm','Write tweets using the given topic:\n---\nTopic: Tweets on how to launch a product\n---\nAudience: Entrepreneurs\n---\nTweets: \n1: Write out the spec of the launch in a detailed memo. Decide what type of launch this is:\n\n- New feature\n- Net new product\n- Site and product redesign\n- Improvements on existing feature\n\nAnswer the who, what, where, when, and why of the launch.\n\n2: Determine if this should be a small, medium, or large launch. Small - Small milestones and improvements on already existing features. Medium - A new feature that makes a clear difference in a current tool. Large - Net new product.\n\n3: Identify what specific group of people this launch is for. Is this for a subset of your current audience? Is this for a new audience entirely? Outline your niche and ideal customer personas.\n---\nTopic: Tweets on how to launch a product\n---\nAudience: Entrepreneurs\n---\nTweets:\nWant to start a business?\n\nHere are 5 ideas + strategies you can use to get started 🚀:\n\n1: Mission & Vision: Write a mission statement about why your company exists and a vision statement about where you want your brand to go.\n\n2: Target Audience: Describe who your customers are and why they need you (i.e. how your products or services solve their problems).\n\n3: Personality: Make a list of 3-5 adjectives that describe your brand. This will set the tone for both design and writing.\n\n4: Values: Determine the guiding principles for company decisions and actions.\n---\nTopic: Tweets on how to launch a product\n---\nAudience: Entrepreneurs\n---\nTweets:\nThe 4 best new productivity apps for 2021\n\nThese great apps will help you organize your digital life, avoid unwanted distractions, and more:\n\n1: A less-messy Gmail: Simplify Gmail is a revelation is a web browser extension centers your inbox so it’s easier to read, hides Google’s unnecessary app buttons, and tones down distracting colors. \n\n2: Write Minimalistically: As a minimalist writing tool, JotterPad cuts away features like adjustable fonts, colors, and page alignments, leaving only the words and a handful of basic formatting options to focus on. \n\n3: Illustrating on iPad: Let’s give Adobe its due, though. Last fall, the company brought Illustrator to the iPad, further making good on plans to treat Apple’s tablet as a first-class productivity tool. \n\n4: Focus on the work: As an alternative to Zoom, Around tries to fight video call fatigue by putting less emphasis on people’s faces.\n---\nTopic: Tweets on how to launch a product\n---\nAudience: Entrepreneurs\n---\nTweets:\nThe 4 best new productivity apps for 2021\n\nThese great apps will help you organize your digital life, avoid unwanted distractions, and more:\n\n1: A less-messy Gmail: Simplify Gmail is a revelation is a web browser extension that centers your inbox so it’s easier to read, hides Google’s unnecessary app buttons, and tones down distracting colors. \n\n2: Write Minimalistically: As a minimalist writing tool, JotterPad cuts away features like adjustable fonts, colors, and page alignments, leaving only the words and a handful of basic formatting options to focus on. \n\n3: Illustrating on iPad: Let’s give Adobe its due, though. Last fall, the company brought Illustrator to the iPad, further making good on plans to treat Apple’s tablet as a first-class productivity tool. \n\n4: Focus on the work: As an alternative to Zoom, Around tries to fight video call fatigue by putting less emphasis on people’s faces.\n---\nTopic: {{UserTopic}}\n---\nAudience: {{UserAudience}}\n---\nTweets:','twitter','public/ts/images/new-icons/twitter-icon-73.png','<i class=\"fab fa-twitter\" style=\"color: #1DA1F2;\"></i>','active','0.7','100','1','0','0','---','2021-12-23 01:18:20','2021-12-23 01:18:20','#1DA1F2');

/*!40000 ALTER TABLE `content_tools` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table docs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `docs`;

CREATE TABLE `docs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doccontent` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table gtags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gtags`;

CREATE TABLE `gtags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table logos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logos`;

CREATE TABLE `logos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2019_05_03_000001_create_customer_columns',1),
	(4,'2019_05_03_000002_create_subscriptions_table',1),
	(5,'2019_05_03_000003_create_subscription_items_table',1),
	(6,'2019_08_19_000000_create_failed_jobs_table',1),
	(7,'2021_03_03_210109_create_projects_table',1),
	(8,'2021_03_10_184658_create_trails_table',1),
	(9,'2021_03_10_185101_create_pricings_table',1),
	(10,'2021_03_10_190942_create_page_contents_table',1),
	(11,'2021_03_10_191220_create_news_letters_table',1),
	(12,'2021_03_10_191412_create_logos_table',1),
	(13,'2021_03_10_191513_create_gtags_table',1),
	(14,'2021_03_10_191814_create_ads_table',1),
	(15,'2021_03_10_192326_create_ad_responses_table',1),
	(16,'2021_03_11_053359_create_user_subscriptions_table',1),
	(17,'2021_03_11_181719_create_user_favourites_table',1),
	(18,'2021_03_11_181827_create_user_projects_table',1),
	(19,'2021_03_27_220116_create_webhook_calls_table',1),
	(20,'2021_03_31_141608_create_trail_histories_table',1),
	(21,'2021_04_01_221503_add_upgrade_preference_to_users_table',1),
	(22,'2021_04_12_221503_add_teammate_id_to_trail_histories_table',1),
	(23,'2021_04_13_221503_new_account_to_users_table',1),
	(24,'2021_05_06_091902_create_stripe_subscription_schedules_table',1),
	(25,'2021_05_20_151218_add_provider_id_to_users_table',1),
	(26,'2021_07_23_230129_create_content_tools_table',1),
	(27,'2021_07_23_230436_create_content_tool_items_table',1),
	(28,'2021_07_28_230129_create_ads_items_table',1),
	(29,'2021_07_30_114557_add_color_code_content_tool',1),
	(30,'2021_09_12_143509_create_jobs_table',1),
	(31,'2021_10_11_155149_create_user_sidebar_choices_table',1),
	(32,'2021_11_10_120202_create_docs_table',1),
	(33,'2014_10_12_200000_add_two_factor_columns_to_users_table',2),
	(34,'2019_12_14_000001_create_personal_access_tokens_table',2),
	(35,'2021_11_22_100554_create_sessions_table',2),
	(36,'2021_11_27_040222_add_user_name_table',3),
	(37,'2021_12_05_004248_add_data',4);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table news_letters
# ------------------------------------------------------------

DROP TABLE IF EXISTS `news_letters`;

CREATE TABLE `news_letters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table page_contents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_contents`;

CREATE TABLE `page_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `main_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content4` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content5` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content6` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content7` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content8` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table personal_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pricings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pricings`;

CREATE TABLE `pricings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_user_id_foreign` (`user_id`),
  CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;

INSERT INTO `projects` (`id`, `name`, `user_id`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'My Project',1,'2021-11-22 16:14:33','2021-11-22 16:14:33',NULL),
	(2,'My Project',2,'2021-11-25 16:49:22','2021-11-25 16:49:22',NULL);

/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`)
VALUES
	('4Sku8utxh5LJII713RrL2rJCjgiA55xnSfH8Da8h',2,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaWI4eVRDMktJcVJUZzh0S3hjNEw3SmJ6RHh2bnJBZndSRldiSnNzcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vdHlwZXNraXAudGVzdC9hcHAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkOE5DTFJiV216YUdDazFiTGFNSDdYdWoxQW14aU9IQVUuS01ROC9CWGxzcG10R3ZQcXZxRHEiO30=',1639671629),
	('DAwcbQiS2EX3RWm1IzPaKvH5sOo6ruyC86XckikC',2,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMnVIYWhLeUtkaWp6WnpXRTdnOGtFN3E1dWE2aW9JVU5aY3haNkdCayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vdHlwZXNraXAudGVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCQ4TkNMUmJXbXphR0NrMWJMYU1IN1h1ajFBbXhpT0hBVS5LTVE4L0JYbHNwbXRHdlBxdnFEcSI7fQ==',1640222496),
	('HSZDUpbMw6Dp4gszzyW2fARNnMffCe7dn7GLBpou',2,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTkVnV0RGNDlXcElLVkFSRkI1SjRPOXhoVXpOZUZPZXdrVDhmZWxRWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vdHlwZXNraXAudGVzdC9hcHAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkOE5DTFJiV216YUdDazFiTGFNSDdYdWoxQW14aU9IQVUuS01ROC9CWGxzcG10R3ZQcXZxRHEiO30=',1640012318),
	('l8THSCemgMPDERg3TEv5izKIeaNwMfZdwviySCBB',2,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQzRKSXNJUWxtOXNoZWZEcFcwMVVtRUZGZ1l0VEpNTE9DQlJiYm1pWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vdHlwZXNraXAudGVzdC9hcHAvcHJvZHVjdC1kZXNjcmlwdGlvbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCQ4TkNMUmJXbXphR0NrMWJMYU1IN1h1ajFBbXhpT0hBVS5LTVE4L0JYbHNwbXRHdlBxdnFEcSI7fQ==',1639220297),
	('uUV1RXnE8BFZkEiHaduGCo48JzPPsIlFoarCEfN5',2,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUkNqZUoyNUtyRE10S3BzRlFVOTFpNjhab1d4aEhxa29lOXJ6ekNlbCI7czozOiJ1cmwiO2E6MDp7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCQ4TkNMUmJXbXphR0NrMWJMYU1IN1h1ajFBbXhpT0hBVS5LTVE4L0JYbHNwbXRHdlBxdnFEcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vdHlwZXNraXAudGVzdC9hcHAvcHJvZHVjdC1kZXNjcmlwdGlvbiI7fX0=',1639234956);

/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table stripe_subscription_schedules
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stripe_subscription_schedules`;

CREATE TABLE `stripe_subscription_schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subscription_schedule_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table subscription_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subscription_items`;

CREATE TABLE `subscription_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` bigint(20) unsigned NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscription_items_subscription_id_stripe_plan_unique` (`subscription_id`,`stripe_plan`),
  KEY `subscription_items_stripe_id_index` (`stripe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table subscriptions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subscriptions`;

CREATE TABLE `subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table trail_histories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `trail_histories`;

CREATE TABLE `trail_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `trail_id` int(10) unsigned DEFAULT NULL,
  `ads_id` int(10) unsigned DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `trail_type` enum('trail_quantity','trail_bonus') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'trail_quantity',
  `status` enum('active','in-active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teammate_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table trails
# ------------------------------------------------------------

DROP TABLE IF EXISTS `trails`;

CREATE TABLE `trails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `trail_status` int(11) NOT NULL DEFAULT 1,
  `trail_quantity` int(11) NOT NULL,
  `trail_bonus` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trails_user_id_foreign` (`user_id`),
  CONSTRAINT `trails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `trails` WRITE;
/*!40000 ALTER TABLE `trails` DISABLE KEYS */;

INSERT INTO `trails` (`id`, `payment_status`, `trail_status`, `trail_quantity`, `trail_bonus`, `user_id`, `created_at`, `updated_at`)
VALUES
	(1,0,1,0,0,1,NULL,NULL),
	(2,0,1,0,0,2,NULL,NULL);

/*!40000 ALTER TABLE `trails` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_favourites
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_favourites`;

CREATE TABLE `user_favourites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `ad_response_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_favourites_user_id_foreign` (`user_id`),
  KEY `user_favourites_ad_response_id_foreign` (`ad_response_id`),
  CONSTRAINT `user_favourites_ad_response_id_foreign` FOREIGN KEY (`ad_response_id`) REFERENCES `ad_responses` (`id`),
  CONSTRAINT `user_favourites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table user_projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_projects`;

CREATE TABLE `user_projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_projects_user_id_foreign` (`user_id`),
  KEY `user_projects_project_id_foreign` (`project_id`),
  CONSTRAINT `user_projects_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  CONSTRAINT `user_projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_projects` WRITE;
/*!40000 ALTER TABLE `user_projects` DISABLE KEYS */;

INSERT INTO `user_projects` (`id`, `user_id`, `project_id`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'2021-11-22 16:14:33','2021-11-22 16:14:33'),
	(2,2,2,'2021-11-25 16:49:22','2021-11-25 16:49:22');

/*!40000 ALTER TABLE `user_projects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_sidebar_choices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_sidebar_choices`;

CREATE TABLE `user_sidebar_choices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `expand` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_sidebar_choices_user_id_foreign` (`user_id`),
  CONSTRAINT `user_sidebar_choices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table user_subscriptions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_subscriptions`;

CREATE TABLE `user_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stripe_subscription_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_amount` int(11) NOT NULL,
  `plan_amount_currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_interval_count` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_period_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_period_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_subscriptions_user_id_foreign` (`user_id`),
  CONSTRAINT `user_subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkout` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_of` int(11) NOT NULL DEFAULT 0,
  `parent_member` int(11) NOT NULL DEFAULT 0,
  `linked_user_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cmp_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cmp_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_project` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `upgrade_preference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'subscription',
  `new_account` tinyint(1) DEFAULT 1,
  `provider_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_stripe_id_index` (`stripe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `name`, `email`, `linkout`, `member_of`, `parent_member`, `linked_user_role`, `fname`, `lname`, `cmp_name`, `cmp_description`, `auth_token`, `role`, `status`, `phone`, `ip_address`, `country_name`, `current_project`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`, `upgrade_preference`, `new_account`, `provider_id`)
VALUES
	(1,'Mizan','Mizan','mizan@mizan.com','e42e08e1475a8da551093509853004de',0,1,'admin',NULL,NULL,NULL,NULL,NULL,'user',0,NULL,'127.0.0.1','Bangladesh',1,NULL,'$2y$10$BaDcIMeth/zBH91mVg4lIeMHaPGFy7JzBK0NzAro.IimH9hLqPjne',NULL,NULL,'azCKowD2t3DgWvQkpqF7FsnWECsgHIrnDzOSLDq95K3egGgaRbhONap5sBOe',NULL,'2021-11-27 04:26:25',NULL,NULL,NULL,NULL,'subscription',1,NULL),
	(2,'Mizan','Mizan','mizan@zazaaz.com','116c57ce18c1d5b3b2d41dc9255a8d6e',0,2,'admin',NULL,NULL,NULL,NULL,NULL,'user',0,NULL,'127.0.0.1','Bangladesh',2,NULL,'$2y$10$8NCLRbWmzaGCk1bLaMH7Xuj1AmxiOHAU.KMQ8/BXlspmtGvPqvqDq',NULL,NULL,NULL,NULL,'2021-11-27 04:26:25',NULL,NULL,NULL,NULL,'subscription',1,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table webhook_calls
# ------------------------------------------------------------

DROP TABLE IF EXISTS `webhook_calls`;

CREATE TABLE `webhook_calls` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exception` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
