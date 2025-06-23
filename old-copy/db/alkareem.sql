SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `alkareem`
--




CREATE TABLE `tbl_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_code` int(11) DEFAULT NULL,
  `acode` int(11) DEFAULT NULL,
  `aname` text DEFAULT NULL,
  `opening_bal` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `opening_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_account VALUES
("2","100000000","100100000","Cash in Hand","1000000","2021-07-14","2021-08-28","1"),
("3","100000000","100200000","Accounts Receivable","","2021-07-14","0000-00-00","1"),
("4","100000000","100300000","Stock","50000","2021-07-14","2021-08-27","1"),
("12","200000000","200100000","Loans","","2021-07-14","0000-00-00","1"),
("13","200000000","200200000","Account Payable","","2021-07-14","0000-00-00","1"),
("14","200000000","200300000","Wages Payable","","2021-07-14","0000-00-00","1"),
("16","300000000","300100000","Cost of goods sold","","2021-07-14","0000-00-00","1"),
("17","400000000","400100000","Owners Capital","","2021-07-14","0000-00-00","1"),
("18","400000000","400200000","Owners Withdrawals","","2021-07-14","0000-00-00","1"),
("19","500000000","500100000","Direct Expenses","","2021-07-14","0000-00-00","1"),
("20","500000000","500200000","Other Expense","","2021-07-14","0000-00-00","1"),
("21","100000000","100600000","Land or Building","200000","2021-07-14","2021-08-27","1"),
("22","200000000","200500000","Cash","","2021-07-15","0000-00-00","1"),
("25","100000000","100700000","Cash at Bank","","2021-08-05","0000-00-00","1"),
("26","400000000","400300000","Abdul Qadeer sb","20000","2021-08-26","2021-08-27","1"),
("27","400000000","400400000","Kareem ullah sb","","2021-08-26","0000-00-00","1"),
("28","100000000","100800000","Equipment","10000","2021-08-27","2021-08-27","1"),
("29","100000000","100900000","Branch Stock","","2021-08-28","0000-00-00","1"),
("31","300000000","300200000","Others Revenue","","2021-09-01","0000-00-00","1");




CREATE TABLE `tbl_account_lv2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_code` int(11) DEFAULT NULL,
  `sub_child1` int(11) DEFAULT NULL,
  `acode` int(11) DEFAULT NULL,
  `aname` text DEFAULT NULL,
  `opening_bal` text DEFAULT NULL,
  `opening_date` date DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_account_lv2 VALUES
("3","500000000","500100000","500100200","Wages Expense","50000","2021-08-27","2021-07-14","1"),
("5","500000000","500200000","500200100","Utilities Expense","","2021-08-27","2021-07-14","1"),
("6","500000000","500200000","500200200","Rent Expense","20000","2021-08-27","2021-07-14","1"),
("7","300000000","300100000","300100100","Cash Sale","","2021-08-27","2021-07-14","1"),
("10","500000000","500100000","500100400","Salary Expense","","0000-00-00","2021-07-14","1"),
("12","300000000","300100000","300100300","Lease Sale","","0000-00-00","2021-07-15","1"),
("21","200000000","200200000","200200102","Vendor 1","","2021-08-27","2021-08-04","1"),
("28","500000000","500200000","500200300","Transport Expense","2000","2021-09-01","2021-08-17","1"),
("31","100000000","100700000","100700100","UBL Bank ","20000","2021-08-27","2021-08-24","1"),
("32","100000000","100700000","100700200","HBL Bank ","","0000-00-00","2021-08-24","1"),
("49","100000000","100100000","100100101","DEANS ","100000","2021-08-31","2021-08-31","1"),
("53","300000000","300200000","300200100","Forms","","0000-00-00","2021-09-01","1"),
("54","100000000","100100000","100100102","Bara Road Branch ","20000","0000-00-00","2021-09-03","1"),
("55","200000000","200200000","200200104","Safdar mobile","","0000-00-00","2021-09-03","1"),
("57","100000000","100100000","100100103","ISB Branch","","0000-00-00","2021-09-08","1"),
("59","100000000","100200000","100200107","Ali","","0000-00-00","2021-09-27","15"),
("60","100000000","100200000","100200108","khan","","0000-00-00","2021-09-27","15"),
("61","100000000","100100000","100100104","Dilzak Road ","","0000-00-00","2021-09-29","1"),
("62","100000000","100100000","100100105","asdasd1","","0000-00-00","2021-09-29","1"),
("63","100000000","100200000","100200109","ADIL NIAMAT ","","0000-00-00","2021-09-29","13"),
("64","100000000","100200000","100200110","FARAZ ALI ","","0000-00-00","2021-10-01","1"),
("65","100000000","100200000","100200111","SYED KHAN","","0000-00-00","2021-10-01","1"),
("67","200000000","200200000","200200105","test","","0000-00-00","2021-10-11","13"),
("68","100000000","100200000","100200112","test123","","","2021-10-25","1"),
("71","100000000","100200000","100200113","asdasd","","","2021-10-25","1"),
("73","100000000","100200000","100200114","osoro","","","2021-11-06","15"),
("75","200000000","200200000","200200106","osoro","","","2021-11-29","15"),
("76","100000000","100200000","100200115","edrtgert","","","2021-11-30","13"),
("77","100000000","100200000","100200116","asdasd","","","2021-12-13","1"),
("78","100000000","100100000","100100105","asdasd1","","","2021-12-22","1"),
("79","100000000","100100000","100100105","asdasd1","","","2021-12-22","1"),
("80","100000000","100100000","100100105","asdasd1","","","2021-12-22","1"),
("81","100000000","100100000","100100105","asdasd","","","2021-12-22","1"),
("82","300000000","300200000","300200200","Incentives ","50000","2021-12-23","2021-12-23","1"),
("83","100000000","100100000","100100105","asdasd","","","2021-12-27","1");




CREATE TABLE `tbl_acode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acode` int(11) NOT NULL,
  `aname` text NOT NULL,
  `atype` text NOT NULL,
  `effect` text DEFAULT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_acode VALUES
("1","100000000","Asset Accounts","Parent","None","2021-07-14","1"),
("2","200000000","Liability Accounts","Parent","None","2021-07-14","1"),
("3","300000000","Revenue Accounts","Parent","None","2021-07-14","1"),
("4","400000000","Equity Accounts","Parent","None","2021-07-14","1"),
("5","500000000","Expense Accounts","Parent","None","2021-07-14","1"),
("6","100100000","Cash","Child","Debit","2021-07-14","1"),
("7","100200000","Receivable","Child","Debit","2021-07-14","1"),
("8","100300000","Inventory","Child","Debit","2021-07-14","1"),
("9","100400000","Supplies","Child","Debit","2021-07-14","1"),
("10","100500000","Equipment","Child","Debit","2021-07-14","1"),
("11","100600000","Land or Building","Child","Debit","2021-07-14","1"),
("12","200100000","Loans","Child","Credit","2021-07-14","1"),
("13","200200000","Account Payable","Child","Credit","2021-07-14","1"),
("14","200300000","Wages Payable","Child","Credit","2021-07-14","1"),
("15","200400000","Unearned Revenues","Child","Credit","2021-07-14","1"),
("16","300100000","Sale\'s","Child","Credit","2021-07-14","1"),
("17","300100100","Cash Sale\'s","SubChild","Credit","2021-07-14","1"),
("18","300100200","Credit Sale\'s","SubChild","Credit","2021-07-14","1"),
("19","300100300","Lease Sale\'s","SubChild","Credit","2021-07-14","1"),
("20","400100000","Owner\'s Capital","Child","Credit","2021-07-14","1"),
("21","400200000","Owner\'s Withdrawals","Child","Debit","2021-07-14","1"),
("22","500100000","Direct Expense","Child","Debit","2021-07-14","1"),
("23","500200000","Other Expense","Child","Debit","2021-07-14","1"),
("24","500200100","Utilities Expense","SubChild","Debit","2021-07-14","1"),
("25","500200200","Rent Expense","SubChild","Debit","2021-07-14","1"),
("26","500100100","Supplies Expense","SubChild","Debit","2021-07-14","1"),
("27","500100200","Salary Expense","SubChild","Debit","2021-07-14","1"),
("28","500100300","Wages Expense","SubChild","Debit","2021-07-14","1");




CREATE TABLE `tbl_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_bank VALUES
("5","HABIB BANK LT"),
("6","ASKRI BANK");




CREATE TABLE `tbl_branch_target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `target` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_branch_target VALUES
("1","13","10000","2021-09-06","1"),
("3","15","20000","2021-09-06","1");




CREATE TABLE `tbl_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` text DEFAULT NULL,
  `brand_id` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_cat VALUES
("3","Mobiles/Tablets","16","1","2021-09-29"),
("6","Mobiles/Tablet","2","1","2021-07-15"),
("8","LCD","4","1","2021-07-15"),
("9","Refrigerator","11","1","2021-09-29"),
("10","Refrigerator","12","1","2021-09-29"),
("11","Mobiles","13","1","2021-09-29"),
("12","Mobiles/Tablets","14","1","2021-09-29"),
("13","Mobiles/Tablets","15","1","2021-09-29"),
("22","Mobiles/Tablets","17","1","2021-09-29"),
("23","Mobiles/Tablets","18","1","2021-09-29"),
("24","Mobiles/Tablets","19","1","2021-09-29"),
("25","AC","12","1","2021-10-01"),
("26","WASHING MACHINE","12","1","2021-10-01"),
("27","MICRO OVEN","12","1","2021-10-01"),
("28","DEEP FREEZER","12","1","2021-10-01"),
("29","Refrigerator","11","1","2021-10-01"),
("30","GD SERIES REFRIGERATOR","11","1","2021-10-01"),
("31","PEL LVS TURBO REFREIGERATOR","11","1","2021-10-01"),
("32","PEL VCM INVERTER REFRIGERATOR","11","1","2021-10-01"),
("34","PEL DEEP FREEZER","11","1","2021-10-01"),
("36"," PEL AC","11","1","2021-10-01"),
("37","E STAR SERIES FRIDGES","7","1","2021-10-01"),
("38","Refrigerator","7","1","2021-10-01"),
("39","INVERTER DIGITAL SERIES FRIDGES","7","1","2021-10-01"),
("40","TURBO FRIDGES","7","1","2021-10-01"),
("41","FREEZERS","7","1","2021-10-01"),
("42","WASHING MACHINE","7","1","2021-10-01"),
("43","AC","7","1","2021-10-01"),
("44","Motor Bike","22","1","2021-10-01"),
("45","Motor Bike","23","1","2021-10-01"),
("46","Motor Bike","24","1","2021-10-01"),
("47","Motor Bike","25","1","2021-10-01");




CREATE TABLE `tbl_catagory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` text DEFAULT NULL,
  `transfer_perc` text DEFAULT NULL,
  `cat_image` text DEFAULT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_catagory VALUES
("2","Samsung","8","uploads/catagory/9851289131626168582.jpg","2021-11-12","0"),
("4","Orient","","uploads/catagory/20028480461626168862.png","2021-07-13","0"),
("5","Asia","","uploads/catagory/6070138321626168874.png","2021-07-13","0"),
("7","Haier","","uploads/catagory/12215081721626168938.png","2021-07-13","1"),
("11","PEL","","","2021-09-29","1"),
("12","Dawlance","5","","2021-11-15","0"),
("13","Vivo","","","2021-09-29","1"),
("14","Infinix","","","2021-09-29","0"),
("15","OPPO","","","2021-09-29","1"),
("16","HUAWEI ","","","2021-09-29","1"),
("17","XIAOMI ","","","2021-09-29","1"),
("18","REALME ","","","2021-09-29","1"),
("19","Tecno","","","2021-09-29","1"),
("20","INFINIX MOBILES","","","2021-09-29","1"),
("21","IPHONE ","","","2021-09-29","1"),
("22","Atlas Honda","","","2021-10-01","1"),
("23","United","","","2021-10-01","1"),
("24","Zxmco","","","2021-10-01","1"),
("25","Yamaha","","","2021-10-01","1");




CREATE TABLE `tbl_company` (
  `comp_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` text DEFAULT NULL,
  `c_email` text DEFAULT NULL,
  `c_mobile` text DEFAULT NULL,
  `c_phone` text DEFAULT NULL,
  `user_profile` text DEFAULT NULL,
  `c_address` text DEFAULT NULL,
  `sale_per` text DEFAULT NULL,
  `avo_perc` float DEFAULT NULL,
  `mo_perc` text DEFAULT NULL,
  PRIMARY KEY (`comp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_company VALUES
("1","Alkareem","Alkareem@gmail.com","03402244271","03402244271","uploads/company_img/12140707631626081798.png","RWP BHARIA TOWN","30","1.5","1");




CREATE TABLE `tbl_customer` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `seprate_customer_id` text NOT NULL,
  `blacklist` int(11) NOT NULL DEFAULT 0,
  `username` text DEFAULT NULL,
  `mobile_no1` text DEFAULT NULL,
  `mobile_no2` text DEFAULT NULL,
  `address_current` text DEFAULT NULL,
  `address_permanent` text DEFAULT NULL,
  `address_office` text DEFAULT NULL,
  `user_profile` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `client_cnic` text DEFAULT NULL,
  `client_fathername` text DEFAULT NULL,
  `client_residential` text DEFAULT NULL,
  `client_occupation` text DEFAULT NULL,
  `client_salary` text DEFAULT NULL,
  `zone` int(11) DEFAULT NULL,
  `sub_zone` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_customer VALUES
("15","100200107","6000","0","Ali","0323-1322313","","kbhgjhjhgj","jhfhghgghg","asdasd","","Male","35456-4564654-6","asdad","Personal","asdasd","200000","12","15","1","1","2021-09-29"),
("16","100200108","6001","0","khan","0331-2312312","","kbhgjhjhgj","jhfhghgghg","asdasd","","Male","12312-3123123-1","asdasd","Personal","asdasd","15000","12","15","1","1","2021-09-29"),
("17","100200109","6002","0","ADIL NIAMAT ","0345-0043381","0341-5646512","DEANS","SADDAR BAZAR ","KD MAIN LOBY DEANS TRADE ","","Male","17301-7768917-3","NIAMAT ULLAH ","Personal","OFFICE ","28000","12","15","13","13","2021-10-01"),
("18","100200110","6003","0","FARAZ ALI ","0303-1165446","0303-2224548","DEANS","HAYATABAD PESHAWAR ","KD MAIN LOBY DEANS TRADE ","","Male","17301-5484812-0","MUHAMMAD SHAFIQ ","Personal","OFFICE ","30000","12","15","1","1","2021-10-01"),
("19","100200111","6004","0","SYED KHAN","0300-9347129","0356-4564554","UNIVERSITY TOWN","MAKAN NEZD MALAK FAZAL RAHIM HUJRA TEHKAL PAYYAN","DEANS TRADE CENTER","","Male","17301-7687778-7","FAZAL RAHIM","Personal","OWN WORK","50000","12","15","1","1","2021-10-01"),
("20","100200112","6005","0","test123","0300-8347129","","","","","","Male","23123-1231231-2","","Personal","","","12","15","1","1","2021-10-25"),
("21","100200113","6006","0","asdasd","0300-9847129","","","","","","Male","21423-4234234-2","","Personal","","","12","15","1","1","2021-10-25"),
("22","100200114","6007","0","osoro","0300-9947129","","","","","","Male","32423-4234234-2","","Personal","","","12","15","15","15","2021-11-06"),
("23","100200115","6008","0","edrtgert","0336-3453453","","","","","","Male","45345-3453453-4","","Personal","","","0","0","13","13","2021-11-30"),
("24","100200116","6009","0","asdasd","0334-2523452","","","","","","Male","34523-4234234-_","","Personal","","","12","15","1","1","2021-12-13");




CREATE TABLE `tbl_designation` (
  `designation_id` int(11) NOT NULL AUTO_INCREMENT,
  `designation_name` text NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`designation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_designation VALUES
("1","GM","2021-11-09","1"),
("2","BM","2021-11-09","1"),
("3","SRO","2021-11-09","1"),
("4","MO","2021-11-09","1"),
("5","AVO","2021-11-09","1"),
("6","SALESMAN","2021-11-09","1"),
("7","SRM","2021-12-24","1"),
("8","RM","2021-12-24","1"),
("9","CRC","2021-12-24","1");




CREATE TABLE `tbl_emp_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) DEFAULT NULL,
  `leave_type` text DEFAULT NULL,
  `status` text NOT NULL DEFAULT 'Pending',
  `f_date` date DEFAULT NULL,
  `t_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_grn_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) DEFAULT NULL,
  `documents` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acode` int(11) NOT NULL,
  `aname` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_head VALUES
("1","100000000","Asset Accounts","1","2021-07-14"),
("2","200000000","Liability Accounts","1","2021-07-14"),
("4","300000000","Revenue Accounts","1","2021-07-14"),
("5","400000000","Equity Accounts","1","2021-07-14"),
("7","500000000","Expense Accounts","1","2021-07-14");




CREATE TABLE `tbl_installment` (
  `plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) DEFAULT NULL,
  `iemi` int(11) NOT NULL DEFAULT 0,
  `customer` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_serial` text NOT NULL DEFAULT '0',
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` text NOT NULL DEFAULT '0',
  `total_price` float DEFAULT NULL,
  `down_payment` float NOT NULL,
  `period` int(11) NOT NULL,
  `per_month_amount` float NOT NULL,
  `amount_recieved` text DEFAULT NULL,
  `gran1_name` text DEFAULT NULL,
  `gran1_fname` text DEFAULT NULL,
  `gran1_mobile_no` text DEFAULT NULL,
  `gran1_office_no` text DEFAULT NULL,
  `gran1_client_cnic` text DEFAULT NULL,
  `gran1_relation` text DEFAULT NULL,
  `gran1_occup` text DEFAULT NULL,
  `gran1_address` text DEFAULT NULL,
  `gran1_office` text DEFAULT NULL,
  `gran2_name` text NOT NULL,
  `gran2_fname` text DEFAULT NULL,
  `gran2_mobile_no` text DEFAULT NULL,
  `gran2_office_no` text DEFAULT NULL,
  `gran2_client_cnic` text DEFAULT NULL,
  `gran2_relation` text DEFAULT NULL,
  `gran2_occup` text DEFAULT NULL,
  `gran2_address` text DEFAULT NULL,
  `gran2_office` text DEFAULT NULL,
  `gran3_name` text DEFAULT NULL,
  `gran3_fname` text DEFAULT NULL,
  `gran3_mobile_no` text DEFAULT NULL,
  `gran3_office_no` text DEFAULT NULL,
  `gran3_client_cnic` text DEFAULT NULL,
  `gran3_relation` text DEFAULT NULL,
  `gran3_occup` text DEFAULT NULL,
  `gran3_address` text DEFAULT NULL,
  `gran3_office` text DEFAULT NULL,
  `gran4_name` text DEFAULT NULL,
  `gran4_fname` text DEFAULT NULL,
  `gran4_mobile_no` text DEFAULT NULL,
  `gran4_office_no` text DEFAULT NULL,
  `gran4_client_cnic` text DEFAULT NULL,
  `gran4_relation` text DEFAULT NULL,
  `gran4_occup` text DEFAULT NULL,
  `gran4_address` text DEFAULT NULL,
  `gran4_office` text DEFAULT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `installment_status` text DEFAULT NULL,
  `client_cnic` text DEFAULT NULL,
  `mobile_no1` text DEFAULT NULL,
  `client_mobile_no` text DEFAULT NULL,
  `client_email` text DEFAULT NULL,
  `client_address` text DEFAULT NULL,
  `sales_men` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `avo` text DEFAULT NULL,
  `old_avo` int(11) DEFAULT NULL,
  `assigned_avo` int(11) NOT NULL DEFAULT 0,
  `avo_per_amt` float DEFAULT NULL,
  `rec_status` int(11) NOT NULL DEFAULT 0,
  `mo` text DEFAULT NULL,
  `mo_per_amt` text DEFAULT NULL,
  `mo_rec_status` int(11) NOT NULL DEFAULT 0,
  `bm` int(11) DEFAULT NULL,
  `srm` int(11) DEFAULT NULL,
  `rm` int(11) DEFAULT NULL,
  `crc` int(11) DEFAULT NULL,
  `pto` text DEFAULT NULL,
  `local` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_installment_payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `installment_number` int(11) DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `customer` int(11) NOT NULL,
  `customer_cnic` text DEFAULT NULL,
  `customer_email` text DEFAULT NULL,
  `customer_address` text NOT NULL,
  `customer_phone` text NOT NULL,
  `sales_men` int(11) DEFAULT NULL,
  `avo` int(11) DEFAULT NULL,
  `avo_per_amt` float DEFAULT NULL,
  `mo` int(11) DEFAULT NULL,
  `per_month_amount` float NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `brand_id` text DEFAULT NULL,
  `item_name` text DEFAULT NULL,
  `item_model` text DEFAULT NULL,
  `sub_category` text DEFAULT NULL,
  `category` text DEFAULT NULL,
  `item_image` text DEFAULT NULL,
  `item_description` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_items VALUES
("1","1001","2","Note 10 fs","Model fs","5","6","uploads/items/12052661021626350036.jpg","                                                                                                                                                                                                                                    ","2021-08-18","1"),
("9","1006","2","Note 9 fs","FSD","6","6","uploads/items/8207714481626351029.jpg","                                      ","2021-08-18","1"),
("13","1007","2","Note 9 ","mod1","6","6","","                                                                                                                                                        ","2021-08-10","1"),
("14","1008","14","Hot 10 4/64Gb","Hot 10 4/64Gb","","12","","                                      ","2021-09-29","1"),
("15","1009","2","A32 6/128GB","A32 6/128GB","","6","","                                      ","2021-09-29","1"),
("16","1010","2","A10s 2/32 GB","A10s 2/32 GB","","6","","                                      ","2021-09-29","1"),
("17","1011","2","M11 3/32GB","M11 3/32GB","","6","","                                      ","2021-09-29","1"),
("18","1012","2","A12 4/64GB","A12 4/64GB","","6","","                                      ","2021-09-29","1"),
("19","1013","2","A12 4/128GB","A12 4/128GB","","6","","                                      ","2021-09-29","1"),
("20","1014","2","A31 4/128GB","A31 4/128GB","","6","","                                      ","2021-09-29","1"),
("21","1015","2","A52 8/128GB","A52 8/128GB","","6","","                                      ","2021-09-29","1"),
("22","1016","2","A72 8/128GB","A72 8/128GB","","6","","                                      ","2021-09-29","1"),
("23","1017","2","A72 8/256","A72 8/256","","6","","                                      ","2021-09-29","1"),
("24","1018","2","A02S 3/32GB","A02S 3/32GB","","6","","                                      ","2021-09-29","1"),
("25","1019","2","A02S 4/64","A02S 4/64","","6","","                                      ","2021-09-29","1"),
("26","1020","13","Y51 4/128GB","Y51 4/128GB","","11","","                                      ","2021-09-29","1"),
("27","1021","13","Y51 S 8/128GB","Y51 S 8/128GB","","11","","                                      ","2021-09-29","1"),
("28","1022","13","Y20 4/64GB","Y20 4/64GB","","11","","                                      ","2021-09-29","1"),
("29","1023","13","Y20 S 4/128GB","Y20 S 4/128GB","","11","","                                      ","2021-09-29","1"),
("30","1024","13","Y12S 3/32GB","Y12S 3/32GB","","11","","                                      ","2021-09-29","1"),
("31","1025","13","V20 8/128GB","V20 8/128GB","","11","","                                      ","2021-09-29","1"),
("32","1026","13","V20 SE 8/128GB","V20 SE 8/128GB","","11","","                                      ","2021-09-29","1"),
("33","1027","13","Y31 4/128GB","Y31 4/128GB","","11","","                                      ","2021-09-29","1"),
("34","1028","13","X60 15/256","X60 15/256","","11","","                                      ","2021-09-29","1"),
("35","1029","13","V21 8+3/128","V21 8+3/128","","11","","                                      ","2021-09-29","1"),
("36","1030","13","V21E 8/128GB","V21E 8/128GB","","11","","                                      ","2021-09-29","1"),
("37","1031","13","Y53s 8+3/128","Y53s 8+3/128","","11","","                                      ","2021-09-29","1"),
("38","1032","13","Y12A 3/32GB","Y12A 3/32GB","","11","","                                      ","2021-09-29","1"),
("39","1033","15","F15 S 4/64GB","F15 S 4/64GB","16","13","","                                      ","2021-09-29","1"),
("40","1034","15","A54 4/128GB","A54 4/128GB","16","13","","                                      ","2021-09-29","1"),
("41","1035","15","A53 4/64 GB","A53 4/64 GB","16","13","","                                      ","2021-09-29","1"),
("42","1036","15","RENO 5 PRO 12/256GB","RENO 5 PRO 12/256GB","16","13","","                                      ","2021-09-29","1"),
("43","1037","15","A15S 4/64GB","A15S 4/64GB","16","13","","                                      ","2021-09-29","1"),
("44","1038","15","F19 PRO 8/128GB","F19 PRO 8/128GB","16","13","","                                      ","2021-09-29","1"),
("45","1039","15","F19 6/128GB","F19 6/128GB","16","13","","                                      ","2021-09-29","1"),
("46","1040","15","F17 PRO 8/128GB","F17 PRO 8/128GB","16","13","","                                      ","2021-09-29","1"),
("47","1041","15","F17 8/128GB","F17 8/128GB","16","13","","                                      ","2021-09-29","1"),
("48","1042","15","RENO 58/128GB","RENO 58/128GB","16","13","","                                      ","2021-09-29","1"),
("49","1043","16","Y9 A 8/128GB","Y9 A 8/128GB","","3","","                                      ","2021-09-29","1"),
("50","1044","16","Y6 P 3/32GB","Y6 P 3/32GB","","3","","                                      ","2021-09-29","1"),
("51","1045","16","Y7 A 4/64GB","Y7 A 4/64GB","","3","","                                      ","2021-09-29","1"),
("52","1046","16","Y9 PRIME 4/64GB","Y9 PRIME 4/64GB","","3","","                                      ","2021-09-29","1"),
("53","1047","16","Y9 PRIME 4/128GB","Y9 PRIME 4/128GB","","3","","                                      ","2021-09-29","1"),
("54","1048","16","Y8 P 6/128GB","Y8 P 6/128GB","","3","","                                      ","2021-09-29","1"),
("55","1049","16","Y9 S 6/128GB","Y9 S 6/128GB","","3","","                                      ","2021-09-29","1"),
("56","1050","16","NOVA 7i 8/128GB","NOVA 7i 8/128GB","","3","","                                      ","2021-09-29","1"),
("57","1051","16","P30 8/128GB","P30 8/128GB","","3","","                                      ","2021-09-29","1"),
("58","1052","16","P30 PRO 8/128GB","P30 PRO 8/128GB","","3","","                                      ","2021-09-29","1"),
("59","1053","16","Mate 20 pro 6/128GB","Mate 20 pro 6/128GB","","3","","                                      ","2021-09-29","1"),
("60","1054","17","Redmi 9C 3/64GB","Redmi 9C 3/64GB","","22","","                                      ","2021-09-29","1"),
("61","1055","17","Poco X3 6/128GB","Poco X3 6/128GB","","22","","                                      ","2021-09-29","1"),
("62","1056","17","Poco X3 Pro 8/256GB","Poco X3 Pro 8/256GB","","22","","                                      ","2021-09-29","1"),
("63","1057","17","Redmi note 10 4/128GB","Redmi note 10 4/128GB","","22","","                                      ","2021-09-29","1"),
("64","1058","17","Redmi Note 10 Pro 6/128GB","Redmi Note 10 Pro 6/128GB","","22","","                                      ","2021-09-29","1"),
("65","1059","17","Redmi Note 10/5G 4/128GB","Redmi Note 10/5G 4/128GB","","22","","                                      ","2021-09-29","1"),
("66","1060","17","Redmi 10S 6/128GB","Redmi 10S 6/128GB","","22","","                                      ","2021-09-29","1"),
("67","1061","17","Redmi Note 10S 8/128GB","Redmi Note 10S 8/128GB","","22","","                                      ","2021-09-29","1"),
("68","1062","17","REDMI NOTE 10 PRO 8/128GB","REDMI NOTE 10 PRO 8/128GB","","22","","                                      ","2021-09-29","1"),
("69","1063","17","Mi Lite 6/128GB","Mi Lite 6/128GB","","22","","                                      ","2021-09-29","1"),
("70","1064","17","Mi 10T 8/128GB","Mi 10T 8/128GB","","22","","                                      ","2021-09-29","1"),
("71","1065","17","Poco X3 Pro 8/256GB","Poco X3 Pro 8/256GB","","22","","                                      ","2021-09-29","1"),
("72","1066","17","MI 11 8/256","MI 11 8/256","","22","","                                      ","2021-09-29","1"),
("73","1067","18","Realmi C21 4/64GB","Realmi C21 4/64GB","","23","","                                      ","2021-09-29","1"),
("74","1068","18","Realme 88/128GB","Realme 88/128GB","","23","","                                      ","2021-09-29","1"),
("75","1069","18","Reaalme 8 pro 8/128Gb","Reaalme 8 pro 8/128Gb","","23","","                                      ","2021-09-29","1"),
("76","1070","18","Realme 6 8/128GB","Realme 6 8/128GB","","23","","                                      ","2021-09-29","1"),
("77","1071","18","Realme 6 Pro 8/128GB","Realme 6 Pro 8/128GB","","23","","                                      ","2021-09-29","1"),
("78","1072","18","Realme C11 2/32GB","Realme C11 2/32GB","","23","","                                      ","2021-09-29","1"),
("79","1073","18","Realme C12 3/32GB","Realme C12 3/32GB","","23","","                                      ","2021-09-29","1"),
("80","1074","18","Realmi 7i 8/128GB","Realmi 7i 8/128GB","","23","","                                      ","2021-09-29","1"),
("81","1075","18","Realme 7 Pro 8/128GB","Realme 7 Pro 8/128GB","","23","","                                      ","2021-09-29","1"),
("82","1076","18","Realme C 17 6/128GB","Realme C 17 6/128GB","","23","","                                      ","2021-09-29","1"),
("83","1077","18","Realme XT 8/128GB","Realme XT 8/128GB","","23","","                                      ","2021-09-29","1"),
("84","1078","14","Hot 10 4/64Gb","Hot 10 4/64Gb","","12","","                                      ","2021-09-29","1"),
("85","1079","14","Hot 10 4/128GB","Hot 10 4/128GB","","12","","                                      ","2021-09-29","1"),
("86","1080","14","Hot 10 6/128GB","Hot 10 6/128GB","","12","","                                      ","2021-09-29","1"),
("87","1081","14","Hot 9 play 4/64GB","Hot 9 play 4/64GB","","12","","                                      ","2021-09-29","1"),
("88","1082","14","Note 10 6/128GB","Note 10 6/128GB","","12","","                                      ","2021-09-29","1"),
("89","1083","14","Note 10 6/128GB","Note 10 6/128GB","","12","","                                      ","2021-09-29","1"),
("90","1084","14","Note 8 6/128GB","Note 8 6/128GB","","12","","                                      ","2021-09-29","1"),
("91","1085","14","Zero 8 8/128GB","Zero 8 8/128GB","","12","","                                      ","2021-09-29","1"),
("92","1086","14","Zero 8i 8/128GB","Zero 8i 8/128GB","","12","","                                      ","2021-09-29","1"),
("93","1087","14","Hot 10i 4/128GB","Hot 10i 4/128 GB","","12","","                                      ","2021-09-29","1"),
("94","1088","14","HOT 10S 6/128 GB","HOT 10S 6/128 GB","","12","","                                      ","2021-09-29","1"),
("95","1089","14","NOTE 10 PRO 8/128GB","NOTE 10 PRO 8/128GB","","12","","                                      ","2021-09-29","1"),
("96","1090","14","NOTE 10 PRO 8/256GB","NOTE 10 PRO 8/256GB","","12","","                                      ","2021-09-29","1"),
("97","1091","14","HOT 10 PLAY 4/64 GB","HOT 10 PLAY 4/64 GB","","12","","                                      ","2021-09-29","1"),
("98","1092","19","Pova 6/128GB","Pova 6/128GB","","24","","                                      ","2021-09-29","1"),
("99","1093","19","Cammon 16 Pro 6/128 GB","Cammon 16 Pro 6/128 GB","","24","","                                      ","2021-09-29","1"),
("100","1094","19","Cammon 16 Premier 8/128GB","Cammon 16 Premier 8/128GB","","24","","                                      ","2021-09-29","1"),
("101","1095","19","Cammon 16 SE 6/128GB","Cammon 16 SE 6/128GB","","24","","                                      ","2021-09-29","1"),
("102","1096","19","Spark 6 4/64GB","Spark 6 4/64GB","","24","","                                      ","2021-09-29","1"),
("103","1097","19","Spark 6 GO 4/64 GB","Spark 6 GO 4/64 GB","","24","","                                      ","2021-09-29","1"),
("104","1098","19","Cammon 16 8/128GB","Cammon 16 8/128GB","","24","","                                      ","2021-09-29","1"),
("105","1099","19","Spark 7 4/64GB","Spark 7 4/64GB","","24","","                                      ","2021-09-29","1"),
("106","1100","19","Spark 7 Pro 4/64","Spark 7 Pro 4/64","","24","","                                      ","2021-09-29","1"),
("107","1101","19","Camon 17 6/128GB","Camon 17 6/128GB","","24","","                                      ","2021-09-29","1"),
("108","1102","12","9101S DBS","9101S DBS","","10","","                                      ","2021-09-29","1"),
("109","1103","12","9122D FP","9122D FP","","10","","                                      ","2021-09-29","1"),
("110","1104","12","9150 LF/GD","9150 LF/GD","","10","","                                      ","2021-09-29","1");
INSERT INTO tbl_items VALUES
("111","1105","12","9166WB GD","9166WB GD","","10","","                                      ","2021-09-29","1"),
("112","1106","12","9166WB GD INVERTER","9166WB GD INVERTER","","10","","                                      ","2021-09-29","1"),
("113","1107","12","9144 LVS","9144 LVS","","10","","                                      ","2021-09-29","1"),
("114","1108","12","9173WB LVS CHROME","9173WB LVS CHROME","","10","","                                      ","2021-09-29","1"),
("115","1109","12","9173 CHROME INVERTER","9173 CHROME INVERTER","","10","","                                      ","2021-09-29","1"),
("117","1110","12","9178 LF CHROME INVERTER","9178 LF CHROME INVERTER","","10","","                                      ","2021-09-29","1"),
("118","1111","12","9178 LF LVS CHROME","9178 LF LVS CHROME","","10","","                                      ","2021-09-29","1"),
("119","1112","12","9191 WB  CHROME INVERTER","9191 WB  CHROME INVERTER","","10","","                                      ","2021-09-29","1"),
("121","1113","12","9191 WB LVS CHROME","9191 WB LVS CHROME","","10","","                                      ","2021-09-29","1"),
("122","1114","12","9193 LF CHROME INVERTER","9193 LF CHROME INVERTER","","10","","                                      ","2021-09-29","1"),
("123","1115","12","9193 LF LVS CHROME","9193 LF LVS CHROME","","10","","                                      ","2021-09-29","1"),
("124","1116","12","9173GD LVS AVANTE","9173GD LVS AVANTE","","10","","                                      ","2021-09-29","1"),
("125","1117","12","9178 LF LVS AVANTE GD","9178 LF LVS AVANTE GD","","10","","                                      ","2021-09-29","1"),
("126","1118","12","9191WB LVS AVANTE GD","9191WB LVS AVANTE GD","","10","","                                      ","2021-09-29","1"),
("127","1119","12","9193 LVS AVANTE GD","9193 LVS AVANTE GD","","10","","                                      ","2021-09-29","1"),
("128","1120","12","9173 WB AVANTE GD INVERTR","9173 WB AVANTE GD INVERTR","","10","","                                      ","2021-09-29","1"),
("130","1122","2","INFINIX ","hot 10 pro ","","6","","                                      ","2021-10-01","1"),
("131","1123","18","INFINIX ","hot 10 pro ","","23","","                                      ","2021-10-01","1"),
("132","1124","2","SAMSUNG","SAMSUNG A72","","6","","                                      ","2021-10-01","1"),
("133","1125","12","9178 LF AVANTE GD INVERTER","9178 LF AVANTE GD INVERTER","","10","","                                      ","2021-10-01","1"),
("134","1126","12","9191 WB GD AVANTE INVERTER","9191 WB GD AVANTE INVERTER","","10","","                                      ","2021-10-01","1"),
("135","1127","12","9193 GD AVANTE INVERTER","9193 GD AVANTE INVERTER","","10","","                                      ","2021-10-01","1"),
("136","1128","12","91999 CHROME LVS","91999 CHROME LVS","","10","","                                      ","2021-10-01","1"),
("137","1129","12","91999 CHROME INVERTER","91999 CHROME INVERTER","","10","","                                      ","2021-10-01","1"),
("138","1130","12","91999 LVS AVANTE GD","91999 LVS AVANTE GD","","10","","                                      ","2021-10-01","1"),
("139","1131","12","91999 AVANTE GD INVERTER","91999 AVANTE GD INVERTER","","10","","                                      ","2021-10-01","1"),
("140","1132","12","ENCON 30","ENCON 30","","25","","                                      ","2021-10-01","1"),
("141","1133","12","PowerCon-30 White","PowerCon-30 White","","25","","                                      ","2021-10-01","1"),
("142","1134","12","Sprinter Series-30","Sprinter Series-30","","25","","                                      ","2021-10-01","1"),
("143","1135","12","SPRINTER-15","SPRINTER-15","","25","","                                      ","2021-10-01","1"),
("144","1136","12","SUAVE 15","SUAVE 15","","25","","                                      ","2021-10-01","1"),
("145","1137","12","AWM DWF 8120 GR INV GREY","AWM DWF 8120 GR INV GREY","","26","","                                      ","2021-10-01","1"),
("146","1138","12","AWM DWF 7200 INV INVERTER","AWM DWF 7200 INV INVERTER","","26","","                                      ","2021-10-01","1"),
("147","1139","12","AWM DWF 7120 W INVERTER","AWM DWF 7120 W INVERTER","","26","","                                      ","2021-10-01","1"),
("148","1140","12","DAWLANCE WASHING MACHINE AWM DWT 1775 PL","DAWLANCE WASHING MACHINE AWM DWT 1775 PL","","26","","                                      ","2021-10-01","1"),
("149","1141","12","DWT-270 LVS","DWT-270 LVS","","26","","                                      ","2021-10-01","1"),
("150","1142","12","DWT-260 LVS","DWT-260 LVS","","26","","                                      ","2021-10-01","1"),
("151","1143","12","DM DW 6550","DM DW 6550","","26","","                                      ","2021-10-01","1"),
("152","1144","12","DM DW 6100","DM DW 6100","","26","","                                      ","2021-10-01","1"),
("153","1145","12","DW-7500 G TWINTUB","DW-7500 G TWINTUB","","26","","                                      ","2021-10-01","1"),
("154","1146","12","DW-374 C","DW-374 C","","27","","                                      ","2021-10-01","1"),
("155","1147","12","DW-MD-10","DW-MD-10","","27","","                                      ","2021-10-01","1"),
("156","1148","12","DW-MD-4","DW-MD-4","","27","","                                      ","2021-10-01","1"),
("157","1149","12","DW-115-CHZP","DW-115-CHZP","","27","","                                      ","2021-10-01","1"),
("158","1150","12","DW-133-G","DW-133-G","","27","","                                      ","2021-10-01","1"),
("159","1151","12","DW-162-HZP","DW-162-HZP","","27","","                                      ","2021-10-01","1"),
("160","1152","12","CF 91998 LVS","CF 91998 LVS","","28","","                                      ","2021-10-01","1"),
("161","1153","12","CF 19998 INVERTER","CF 19998 INVERTER","","28","","                                      ","2021-10-01","1"),
("162","1154","12","DF 5000 DD","DF 5000 DD","","28","","                                      ","2021-10-01","1"),
("163","1155","12","DF 400ES","DF 400ES","","28","","                                      ","2021-10-01","1"),
("164","1156","12","DF 200GD","DF 200GD","","28","","                                      ","2021-10-01","1"),
("165","1157","11","PEL 2000","PEL 2000","","9","","                                      ","2021-10-01","1"),
("166","1158","11","PEL 2200","PEL 2200","","29","","                                      ","2021-10-01","1"),
("167","1159","11","PEL 2350","PEL 2350","","9","","                                      ","2021-10-01","1"),
("168","1160","11","PEL 2550","PEL 2550","","9","","                                      ","2021-10-01","1"),
("169","1161","11","PEL 6450","PEL 6450","","9","","                                      ","2021-10-01","1"),
("170","1162","11","2000 GD","2000 GD","","30","","                                      ","2021-10-01","1"),
("171","1163","11","2350 GD","2350 GD","","30","","                                      ","2021-10-01","1"),
("172","1164","11","2550 GD","2550 GD","","30","","                                      ","2021-10-01","1"),
("173","1165","11","6350 GD","6350 GD","","30","","                                      ","2021-10-01","1"),
("174","1166","11","6450 GD","6450 GD","","30","","                                      ","2021-10-01","1"),
("175","1167","11","21850 GD","21850 GD","","30","","                                      ","2021-10-01","1"),
("176","1168","11","21950 GD","21950 GD","","30","","                                      ","2021-10-01","1"),
("177","1169","11","22250 GD","22250 GD","","30","","                                      ","2021-10-01","1"),
("178","1170","11","PEL 2350 LVS","PEL 2350 LVS","","31","","                                      ","2021-10-01","1"),
("179","1171","11","PEL 2550 LVS","PEL 2550 LVS","","31","","                                      ","2021-10-01","1"),
("180","1172","11","PEL 2350 VCM","PEL 2350 VCM","","32","","                                      ","2021-10-01","1"),
("181","1173","11","PEL 2550 VCM","PEL 2550 VCM","","32","","                                      ","2021-10-01","1"),
("182","1174","11","DF-155 INVERTER","DF-155 INVERTER","","34","","                                      ","2021-10-01","1"),
("183","1175","11","WAVE INVERTOR 309","WAVE INVERTOR 309","","34","","                                      ","2021-10-01","1"),
("184","1176","11","PEL INVERTER 1.5FIT","PEL INVERTER 1.5FIT","","36","","                                      ","2021-10-01","1"),
("185","1177","11","APEX 1.5 INVERTER","APEX 1.5 INVERTER","","36","","                                      ","2021-10-01","1"),
("186","1178","11","APEX 1TON INVERTER","APEX 1TON INVERTER","","36","","                                      ","2021-10-01","1"),
("187","1179","11","1.5 JAMBO","1.5 JAMBO","","36","","                                      ","2021-10-01","1"),
("188","1180","7","HRF 216 EPR+EPC","HRF 216 EPR+EPC","","37","","                                      ","2021-10-01","1"),
("189","1181","7","HRF 306 EPR","HRF 306 EPR","","37","","                                      ","2021-10-01","1"),
("190","1182","7","HRF 276EPR/EPC/EPB","HRF 276EPR/EPC/EPB","","37","","                                      ","2021-10-01","1"),
("191","1183","7","HRF 336EPR/EPC","HRF 336EPR/EPC","","37","","                                      ","2021-10-01","1"),
("192","1184","7","HRF 398 EPR","HRF 398 EPR","","37","","                                      ","2021-10-01","1"),
("193","1185","7","HRF 398 TPB","HRF 398 TPB","","37","","                                      ","2021-10-01","1"),
("194","1186","7","HRF-368EPR","HRF-368EPR","","37","","                                      ","2021-10-01","1"),
("195","1187","7","HRF 216 EBS/EDB","HRF 216 EBS/EDB","","37","","                                      ","2021-10-01","1"),
("196","1188","7","HRF-276 EBD/EBS","HRF-276 EBD/EBS","","38","","                                      ","2021-10-01","1"),
("197","1189","7","HRF 306 EBS","HRF 306 EBS","","38","","                                      ","2021-10-01","1"),
("198","1190","7","HRF-368 EBS/EBD","HRF-368 EBS/EBD","","38","","                                      ","2021-10-01","1"),
("199","1191","7","HRF-438 EBS/EBD","HRF-438 EBS/EBD","","38","","                                      ","2021-10-01","1"),
("200","1192","7","HRF 438 IDB/IDR/ITB","HRF 438 IDB/IDR/ITB","","39","","                                      ","2021-10-01","1"),
("201","1193","7","HRF 398 IDR/IDB/ITB","HRF 398 IDR/IDB/ITB","","39","","                                      ","2021-10-01","1"),
("202","1194","7","HRF 336 IDB/IDR/ITB","HRF 336 IDB/IDR/ITB","","39","","                                      ","2021-10-01","1"),
("203","1195","7","HRF 368 IDB/IDR","HRF 368 IDB/IDR","","39","","                                      ","2021-10-01","1"),
("204","1196","7","HRF 306 IDB/IDR","HRF 306 IDB/IDR","","39","","                                      ","2021-10-01","1"),
("205","1197","7","HRF 336TPB/TPR","HRF 336TPB/TPR","","40","","                                      ","2021-10-01","1"),
("206","1198","7","HRF 306 TPB/TPR","HRF 306 TPB/TPR","","40","","                                      ","2021-10-01","1"),
("207","1199","7","HDF 385 H WHITE","HDF 385 H WHITE","","41","","                                      ","2021-10-01","1"),
("208","1200","7","HDF-385 INVERTER","HDF-385 INVERTER","","41","","                                      ","2021-10-01","1"),
("209","1201","7","HDF-405 FC","HDF-405 FC","","41","","                                      ","2021-10-01","1"),
("210","1202","7","HDF 405 INVERTER","HDF 405 INVERTER","","41","","                                      ","2021-10-01","1"),
("211","1203","7","HDF 245 SD (FULL FREEZER)","HDF 245 SD (FULL FREEZER)","","41","","                                      ","2021-10-01","1"),
("212","1204","7","HDF 285 SD","HDF 285 SD","","41","","                                      ","2021-10-01","1"),
("213","1205","7","HDF 285 IM","HDF 285 IM","","41","","                                      ","2021-10-01","1");
INSERT INTO tbl_items VALUES
("214","1206","7","HDF 325 H","HDF 325 H","","41","","                                      ","2021-10-01","1"),
("215","1207","7","HDF-545 DD","HDF-545 DD","","41","","                                      ","2021-10-01","1"),
("216","1208","7","HDF 545 DD","HDF 545 DD","","41","","                                      ","2021-10-01","1"),
("217","1209","7","HDF 535 FC","HDF 535 FC","","41","","                                      ","2021-10-01","1"),
("218","1210","7","100 BS-HAIR TWIN TUB","100 BS-HAIR TWIN TUB","","42","","                                      ","2021-10-01","1"),
("219","1211","7","120-AS-HAIER TWIN TUB","120-AS-HAIER TWIN TUB","","42","","                                      ","2021-10-01","1"),
("220","1212","7","120.35-FF-HAIER TWIN TUB","120.35-FF-HAIER TWIN TUB","","42","","                                      ","2021-10-01","1"),
("221","1213","7","SD-540-SUPER ASIA SPIN","SD-540-SUPER ASIA SPIN","","42","","                                      ","2021-10-01","1"),
("222","1214","7","505-WC-COOKING RANG","505-WC-COOKING RANG","","42","","                                      ","2021-10-01","1"),
("223","1215","7","666-WC-COOKING RANG","666-WC-COOKING RANG","","42","","                                      ","2021-10-01","1"),
("224","1216","7","240-SHAWAR WASH","240-SHAWAR WASH","","42","","                                      ","2021-10-01","1"),
("225","1217","7","244 SUPER STYLE SA","244 SUPER STYLE SA","","42","","                                      ","2021-10-01","1"),
("226","1218","7","245 EASY WASH","245 EASY WASH","","42","","                                      ","2021-10-01","1"),
("227","1219","7","18-HFC/2021 HAIER DC INVERTER","18-HFC/2021 HAIER DC INVERTER","","43","","                                      ","2021-10-01","1"),
("228","1220","7","18-HFP/2021 HAIER DC INVERTER","18-HFP/2021 HAIER DC INVERTER","","43","","                                      ","2021-10-01","1"),
("229","1221","7","18-HFM/2021 HAIER DC INVERTER","18-HFM/2021 HAIER DC INVERTER","","43","","                                      ","2021-10-01","1"),
("230","1222","7","12-HFC 2021 HAIER DC INVERTER","12-HFC 2021 HAIER DC INVERTER","","43","","                                      ","2021-10-01","1"),
("231","1223","7","12-HFM 2021 HAIER INVERTER","12-HFM 2021 HAIER INVERTER","","43","","                                      ","2021-10-01","1"),
("232","1224","7","12-HFP 2021 HAIER DC INVERTER","12-HFP 2021 HAIER DC INVERTER","","43","","                                      ","2021-10-01","1"),
("233","1225","23","UNITED US 70","UNITED US 70","","45","","                                      ","2021-10-01","1"),
("234","1226","24","ZXMCO ZX 70","ZXMCO ZX 70","","46","","                                      ","2021-10-01","1"),
("235","1227","24","ZXMCO ZX 100","ZXMCO ZX 100","","46","","                                      ","2021-10-01","1"),
("236","1228","25","YBR 125 DX","YBR 125 DX","","47","","                                      ","2021-10-01","1"),
("237","1229","25","YBR 125 G","YBR 125 G","","47","","                                      ","2021-10-01","1"),
("238","1230","25","YBR 125","YBR 125","","47","","                                      ","2021-10-01","1"),
("239","1231","22","CD 70","CD 70","","44","","                                      ","2021-10-01","1"),
("240","1232","22","CD 70 DREAM","CD 70 DREAM","","44","","                                      ","2021-10-01","1"),
("241","1233","22","PRIDOR","PRIDOR","","44","","                                      ","2021-10-01","1"),
("242","1234","22","CG 125","CG 125","","44","","                                      ","2021-10-01","1"),
("243","1235","22","CG 125 S","CG 125 S","","44","","                                      ","2021-10-01","1"),
("244","1236","22","CG 125 F SE","CG 125 F SE","","44","","                                      ","2021-10-01","1");




CREATE TABLE `tbl_menu` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` text DEFAULT NULL,
  `page_link` text DEFAULT NULL,
  `group_id` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `visibility` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_menu VALUES
("1","Branch","","hr_menu","0","icon-bar-chart","1"),
("2","Branch List","branch_list","hr_menu","1","icon-list","1"),
("3","Users","","hr_menu","0","icon-users","1"),
("4","User List","users","hr_menu","3","icon-list","1"),
("5","Add Branch","adding_branch","hr_menu","1","icon-list","0"),
("6","Update Branch","branch_update","hr_menu","1","icon-list","0"),
("7","Add User","add_users","hr_menu","3","icon-list","0"),
("8","User Profile","user_profile","hr_menu","3","icon-list","0"),
("9","Vendors","","hr_menu","0","icon-users","1"),
("10","Vendor List","vendor_list","hr_menu","9","icon-list","1"),
("11","Add Vendor","add_vendors","hr_menu","9","icon-list","0"),
("12","Customers","","hr_menu","0","icon-users","1"),
("13","Client List","client_list","hr_menu","12","icon-users","1"),
("14","Add Clients","add_clients","hr_menu","12","icon-users","0"),
("15","Employees","","hr_menu","0","icon-users","1"),
("16","Employee List","salesmen_list","hr_menu","15","icon-users","1"),
("17","Employee Add","add_salemen","hr_menu","15","icon-users","0"),
("18","Employee Leaves","emp_leave_list","hr_menu","15","icon-users","1"),
("19","AVO Assign","avo_assign","hr_menu","15","icon-users","1"),
("20","Installment Period","","hr_menu","0","icon-badge","1"),
("21","Period List","period_list","hr_menu","20","icon-users","1"),
("22","Period Add","add_period","hr_menu","20","icon-users","0"),
("23","Product","","hr_menu","0","icon-diamond","1"),
("24","Brand List","brand_list","hr_menu","23","","1"),
("25","Brand Add","add_brand","hr_menu","23","","0"),
("26","Catagory List","catagory_list","hr_menu","23","","1"),
("27","Catagory Add","add_catagory","hr_menu","23","","0"),
("28","Sub Catagory List","sub_catagory_list","hr_menu","23","","1"),
("29","Sub Catagory Add","add_sub_catagory","hr_menu","23","","0"),
("30","Product List","item_list","hr_menu","23","","1"),
("31","Product Add","add_item","hr_menu","23","","0"),
("32","Sale","","project_menu","0","fa fa-usd","1"),
("33","Cash Sale","sale_list","project_menu","32","","1"),
("34","Add Cash Sale","add_sale","project_menu","32","","0"),
("35","Installment","installment_customer","project_menu","32","","1"),
("36","Add installment","installment","project_menu","32","","0"),
("37","Installment Payment","installment_payment","project_menu","32","","1"),
("38","Sale Return ","sale_return_list","project_menu","32","","1"),
("39","Add Sale Return ","sale_return","project_menu","32","","0"),
("40","Purchase","","project_menu","0","fa fa-usd","1"),
("41","Purchase","purchase_list","project_menu","40","","1"),
("42","Purchase PO","add_purchase_po","project_menu","40","","0"),
("43","Add Grn","add_grn","project_menu","40","","0"),
("44","Add PO Payment","add_po_payment","project_menu","40","","0"),
("45","Add Pending PO Payment","add_pending_po_payment","project_menu","40","","0"),
("46","Purchase Req","main_purchase_req_list","project_menu","40","","1"),
("47","Add Req Transfer","add_req_transfer","project_menu","40","","0"),
("48","Local Purchase","single_purchase","project_menu","40","","1"),
("49","Local Purchase PO","add_single_purchase_po","project_menu","40","","0"),
("50","Local Purchase Payment","add_single_po","project_menu","40","","0"),
("51","Local Purchase Pending Payment","add_single_pending_po_payment","project_menu","40","","0"),
("52","Local Purchase Return","loc_purchase_return_list","project_menu","40","","1"),
("53","Add Local Purchase Return","loc_purchase_return","project_menu","40","","0"),
("54","Purchase Return","purchase_return_list","project_menu","40","","1"),
("55","Branch Purchase Req","","project_menu","0","fa fa-usd","1"),
("56","Purchase Req List","purchase_req_list","project_menu","55","","1"),
("57","Add Purchase Req","add_purchase_req","project_menu","55","","0"),
("58","Add Purchase GRN","req_transfer_grn","project_menu","55","","0"),
("59","Chart of Account","","sub_menu","0","icon-bar-chart","1"),
("60","Chart of Account","chart_of_account","sub_menu","59","icon-bar-chart","1"),
("61","Add Account","add_account","sub_menu","59","icon-bar-chart","0"),
("62","Add Opening","add_opening","sub_menu","59","icon-bar-chart","0"),
("63","Accounts Voucher","","sub_menu","0","icon-briefcase","1"),
("64","Add Vouchers","add_payment","sub_menu","63","icon-bar-chart","1"),
("65","Add Cash/Bank Vouchers","add_cash_payment","sub_menu","63","icon-bar-chart","0"),
("66","Add JV Payment","add_jv_payment","sub_menu","63","icon-bar-chart","0"),
("67","Reports","","sub_menu","0","fa fa-files-o","1"),
("68","Trial Balance","trail_balance_sum","sub_menu","67","fa fa-files-o","1"),
("69","General Ledger","general_ledger_report","sub_menu","67","fa fa-files-o","1"),
("70","Balance Sheet","balance_sheet","sub_menu","67","fa fa-files-o","1"),
("71","Transaction History","get_ledger","sub_menu","67","fa fa-files-o","1"),
("72","Profit/Loss Report","profit_report","sub_menu","67","fa fa-files-o","1"),
("73","PO Report","single","sub_menu","67","fa fa-files-o","1"),
("74","Local Purchase Report","loc_single","sub_menu","67","fa fa-files-o","1"),
("75","Purchase Req Report","req_single","sub_menu","67","fa fa-files-o","1"),
("76","Stock Report","stock","sub_menu","67","fa fa-files-o","1"),
("77","Vendor Report","get_vendor_item","sub_menu","67","fa fa-files-o","1"),
("78","Sale Report","single_sale","sub_menu","67","fa fa-files-o","1"),
("79","Customer Report","get_customer_item","sub_menu","67","fa fa-files-o","1"),
("80","Recovery Report","search_installment","sub_menu","67","fa fa-files-o","1"),
("81","Salary Report","single_salary","sub_menu","67","fa fa-files-o","1"),
("82","Payroll","","sub_menu","0","icon-credit-card","1"),
("83","Employee Salary","salaries","sub_menu","82","icon-credit-card","1"),
("84","Employee SalarySlip","payroll","sub_menu","82","icon-credit-card","0"),
("85","Paid Salary","salary_paid","sub_menu","82","icon-credit-card","1"),
("86","User List","permissions","hr_menu","3","icon-list","0"),
("87","Purchase Return","purchase_return","project_menu","40","","0"),
("88","Add Local Cash Sale","add_local_sale","project_menu","32","","0"),
("89","Add Local installment","local_installment","project_menu","32","","0"),
("90","Add Req Branch Transfer (IEMI)","add_req_branch_transfer","project_menu","40","","0"),
("91","Inventory Report","inventory","sub_menu","67","fa fa-files-o","1"),
("92","Zones","","hr_menu","0","icon-users","1"),
("93","Zones","zone_list","hr_menu","92","icon-users","1"),
("94","Zones","zone","hr_menu","92","icon-users","0"),
("95","Sub Zones","sub_zone_list","hr_menu","92","icon-users","1"),
("96","Sub Zones","subzone","hr_menu","92","icon-users","0"),
("97","Installment Edit","installment_detail_list","project_menu","32","","0"),
("98","Installment Edit Detail","installment_edit","project_menu","32","","0"),
("99","Backup/Restore","","hr_menu","0","icon-folder","1"),
("100","Backup/Reset","backup","hr_menu","99","icon-users","1");
INSERT INTO tbl_menu VALUES
("101","Restore","restore","hr_menu","99","icon-users","1"),
("103","Purchase PO","purchase_po","project_menu","40","","0"),
("104","Grn","grn","project_menu","40","","0"),
("105","PO Payment","po_payment","project_menu","40","","0"),
("106","Pending PO Payment","pending_po_payment","project_menu","40","","0"),
("107","Local Purchase PO","single_purchase_po","project_menu","40","","0"),
("108","Local Purchase Payment","single_po","project_menu","40","","0"),
("109","Local Purchase Pending Payment","single_pending_po_payment","project_menu","40","","0"),
("110","Cash Sale (IEMI)","add_sale_iemi","project_menu","32","","0"),
("111","Local Cash Sale (IEMI)","add_local_sale_iemi","project_menu","32","","0"),
("112","Add installment (IEMI)","installment_iemi","project_menu","32","","0"),
("113","Add Local installment (IEMI)","local_installment_iemi","project_menu","32","","0"),
("114","Add Sale Return (IEMI)","sale_return_iemi","project_menu","32","","0"),
("115","Add Purchase Req (IEMI)","add_purchase_req_iemi","project_menu","55","","0"),
("116","Add Req Transfer IEMI","add_req_transfer_iemi","project_menu","40","","0"),
("117","Add Purchase GRN (IEMI)","req_transfer_grn_iemi","project_menu","55","","0"),
("118","Add Req Branch Transfer","add_req_branch_transfer_gen","project_menu","40","","0"),
("119","Edit installment","edit_installment","project_menu","32","","0"),
("120","Designation List","designation_list","hr_menu","15","icon-users","1"),
("121","Direct Transfer","direct_transfer_branch","project_menu","40","","1"),
("122","Add Items IEMI","add_items_iemi","project_menu","40","","0"),
("123","Add Transfer Items","add_transfer_items_gen","project_menu","40","","0"),
("124","Add Transfer IEMI","add_direct_transfer_iemi","project_menu","40","","0"),
("125","Add Transfer General","add_direct_transfer_gen","project_menu","40","","0"),
("126","Direct Branch Transfer","","project_menu","0","fa fa-usd","1"),
("127","Direct Transfer List","transfer_list","project_menu","126","","1"),
("128","Direct Transfer Grn IEMI","dir_transfer_grn_iemi","project_menu","126","","0"),
("129","Direct Transfer Grn ","direct_transfer_grn_gen","project_menu","126","","0"),
("130","Edit Grn IEMI","edit_grn_iemi","project_menu","40","","0"),
("131","Edit Grn","edit_grn","project_menu","40","","0"),
("132","Local Purchase GRN","add_local_grn","project_menu","40","","0"),
("133","Notification","notification","hr_menu","1","icon-list","0"),
("134","Stock Tracking","stock_single","sub_menu","67","fa fa-files-o","0"),
("135","Stock Report IEMI/Serial Wise","stock_itemwise","sub_menu","67","fa fa-files-o","0"),
("136","Stock Report Sale Wise","stock_sale_wise","sub_menu","67","fa fa-files-o","0"),
("137","Stock Report Profit Wise","stock_sale_profit","sub_menu","67","fa fa-files-o","0"),
("138","Stock Report Aging Wise","stock_report_aging","sub_menu","67","fa fa-files-o","0");




CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) DEFAULT NULL,
  `acc_id` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `total` text DEFAULT NULL,
  `payment_type` text DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `months` text DEFAULT NULL,
  `percentage` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_period VALUES
("7","12","30","2021-09-03","1"),
("8","8","15","2021-09-13","1"),
("9","6","10","2021-09-13","1");




CREATE TABLE `tbl_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `parent_page_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `W` int(11) DEFAULT NULL,
  `R` int(11) DEFAULT NULL,
  `D` int(11) DEFAULT NULL,
  `P` int(11) NOT NULL DEFAULT 0,
  `U` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1830 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_permission VALUES
("294","0","","2","1","1","1","0","0"),
("295","0","","4","0","0","0","0","0"),
("296","0","","10","1","1","1","0","0"),
("297","0","","13","0","0","0","0","0"),
("298","0","","16","0","0","0","0","0"),
("299","0","","18","0","0","0","0","0"),
("300","0","","19","0","0","0","0","0"),
("301","0","","21","0","0","0","0","0"),
("302","0","","24","0","0","0","0","0"),
("303","0","","26","0","0","0","0","0"),
("304","0","","28","0","0","0","0","0"),
("305","0","","30","0","0","0","0","0"),
("306","0","","33","0","0","0","0","0"),
("307","0","","35","0","0","0","0","0"),
("308","0","","37","0","0","0","0","0"),
("309","0","","38","0","0","0","0","0"),
("310","0","","41","0","0","0","0","0"),
("311","0","","46","0","0","0","0","0"),
("312","0","","48","0","0","0","0","0"),
("313","0","","52","0","0","0","0","0"),
("314","0","","54","0","0","0","0","0"),
("315","0","","56","0","0","0","0","0"),
("316","0","","60","0","0","0","0","0"),
("317","0","","64","0","0","0","0","0"),
("318","0","","68","0","0","0","0","0"),
("319","0","","69","0","0","0","0","0"),
("320","0","","70","0","0","0","0","0"),
("321","0","","71","0","0","0","0","0"),
("322","0","","72","0","0","0","0","0"),
("323","0","","73","0","0","0","0","0"),
("324","0","","74","0","0","0","0","0"),
("325","0","","75","0","0","0","0","0"),
("326","0","","76","0","0","0","0","0"),
("327","0","","77","0","0","0","0","0"),
("328","0","","78","0","0","0","0","0"),
("329","0","","79","0","0","0","0","0"),
("330","0","","80","0","0","0","0","0"),
("331","0","","81","0","0","0","0","0"),
("332","0","","83","0","0","0","0","0"),
("333","0","","85","1","1","1","0","0"),
("654","17","","2","1","1","1","0","0"),
("655","17","","4","1","1","1","0","0"),
("656","17","","10","1","1","1","0","0"),
("657","17","","13","1","1","1","0","0"),
("658","17","","16","1","1","1","0","0"),
("659","17","","18","1","1","1","0","0"),
("660","17","","19","1","1","1","0","0"),
("661","17","","21","1","1","1","0","0"),
("662","17","","24","1","1","1","0","0"),
("663","17","","26","1","1","1","0","0"),
("664","17","","28","1","1","1","0","0"),
("665","17","","30","1","1","1","0","0"),
("666","17","","33","1","1","1","0","0"),
("667","17","","35","1","1","1","0","0"),
("668","17","","37","1","1","1","0","0"),
("669","17","","38","1","1","1","0","0"),
("670","17","","41","0","0","0","0","0"),
("671","17","","46","0","0","0","0","0"),
("672","17","","48","1","1","1","0","0"),
("673","17","","52","1","1","1","0","0"),
("674","17","","54","0","0","0","0","0"),
("675","17","","56","1","1","1","0","0"),
("676","17","","60","0","0","0","0","0"),
("677","17","","64","1","1","1","0","0"),
("678","17","","68","0","0","0","0","0"),
("679","17","","69","1","1","1","0","0"),
("680","17","","70","0","0","0","0","0"),
("681","17","","71","1","1","1","0","0"),
("682","17","","72","1","1","1","0","0"),
("683","17","","73","1","1","1","0","0"),
("684","17","","74","1","1","1","0","0"),
("685","17","","75","1","1","1","0","0"),
("686","17","","76","1","1","1","0","0"),
("687","17","","77","1","1","1","0","0"),
("688","17","","78","1","1","1","0","0"),
("689","17","","79","1","1","1","0","0"),
("690","17","","80","1","1","1","0","0"),
("691","17","","81","1","1","1","0","0"),
("692","17","","83","1","1","1","0","0"),
("693","17","","85","1","1","1","0","0"),
("934","14","","2","0","0","0","0","0"),
("935","14","","4","0","0","0","0","0"),
("936","14","","10","0","0","0","0","0"),
("937","14","","13","0","0","0","0","0"),
("938","14","","16","0","0","0","0","0"),
("939","14","","18","0","0","0","0","0"),
("940","14","","19","0","0","0","0","0"),
("941","14","","21","0","0","0","0","0"),
("942","14","","24","0","0","0","0","0"),
("943","14","","26","0","0","0","0","0"),
("944","14","","28","0","0","0","0","0"),
("945","14","","30","0","0","0","0","0"),
("946","14","","33","1","1","1","0","0"),
("947","14","","35","1","1","1","0","0"),
("948","14","","37","1","1","1","0","0"),
("949","14","","38","1","1","1","0","0"),
("950","14","","41","0","0","0","0","0"),
("951","14","","46","0","0","0","0","0"),
("952","14","","48","0","0","0","0","0"),
("953","14","","52","0","0","0","0","0");
INSERT INTO tbl_permission VALUES
("954","14","","54","0","0","0","0","0"),
("955","14","","56","0","0","0","0","0"),
("956","14","","60","0","0","0","0","0"),
("957","14","","64","0","0","0","0","0"),
("958","14","","68","0","0","0","0","0"),
("959","14","","69","0","0","0","0","0"),
("960","14","","70","0","0","0","0","0"),
("961","14","","71","0","0","0","0","0"),
("962","14","","72","0","0","0","0","0"),
("963","14","","73","0","0","0","0","0"),
("964","14","","74","0","0","0","0","0"),
("965","14","","75","0","0","0","0","0"),
("966","14","","76","0","0","0","0","0"),
("967","14","","77","0","0","0","0","0"),
("968","14","","78","0","0","0","0","0"),
("969","14","","79","0","0","0","0","0"),
("970","14","","80","0","0","0","0","0"),
("971","14","","81","0","0","0","0","0"),
("972","14","","83","0","0","0","0","0"),
("973","14","","85","0","0","0","0","0"),
("974","10","","2","0","0","0","0","0"),
("975","10","","4","0","0","0","0","0"),
("976","10","","10","0","0","0","0","0"),
("977","10","","13","0","0","0","0","0"),
("978","10","","16","0","0","0","0","0"),
("979","10","","18","0","0","0","0","0"),
("980","10","","19","0","0","0","0","0"),
("981","10","","21","0","0","0","0","0"),
("982","10","","24","0","0","0","0","0"),
("983","10","","26","0","0","0","0","0"),
("984","10","","28","0","0","0","0","0"),
("985","10","","30","0","0","0","0","0"),
("986","10","","33","1","1","1","0","0"),
("987","10","","35","1","1","1","0","0"),
("988","10","","37","1","1","1","0","0"),
("989","10","","38","1","1","1","0","0"),
("990","10","","41","1","1","1","0","0"),
("991","10","","46","0","0","0","0","0"),
("992","10","","48","0","0","0","0","0"),
("993","10","","52","0","0","0","0","0"),
("994","10","","54","0","0","0","0","0"),
("995","10","","56","0","0","0","0","0"),
("996","10","","60","0","0","0","0","0"),
("997","10","","64","1","1","1","0","0"),
("998","10","","68","0","0","0","0","0"),
("999","10","","69","0","0","0","0","0"),
("1000","10","","70","0","0","0","0","0"),
("1001","10","","71","0","0","0","0","0"),
("1002","10","","72","0","0","0","0","0"),
("1003","10","","73","0","0","0","0","0"),
("1004","10","","74","0","0","0","0","0"),
("1005","10","","75","0","0","0","0","0"),
("1006","10","","76","0","0","0","0","0"),
("1007","10","","77","0","0","0","0","0"),
("1008","10","","78","0","0","0","0","0"),
("1009","10","","79","0","0","0","0","0"),
("1010","10","","80","0","0","0","0","0"),
("1011","10","","81","0","0","0","0","0"),
("1012","10","","83","0","0","0","0","0"),
("1013","10","","85","0","0","0","0","0"),
("1446","15","1","2","0","0","0","0","0"),
("1447","15","3","4","1","1","1","0","0"),
("1448","15","9","10","1","1","1","0","0"),
("1449","15","12","13","1","1","1","0","0"),
("1450","15","15","16","1","1","1","0","0"),
("1451","15","15","18","1","1","1","0","0"),
("1452","15","15","19","0","0","0","0","0"),
("1453","15","15","120","0","0","0","0","0"),
("1454","15","20","21","0","0","0","0","0"),
("1455","15","23","24","0","0","0","0","0"),
("1456","15","23","26","0","0","0","0","0"),
("1457","15","23","28","0","0","0","0","0"),
("1458","15","23","30","0","0","0","0","0"),
("1459","15","32","33","1","1","1","0","0"),
("1460","15","32","35","1","1","1","0","0"),
("1461","15","32","37","1","1","1","0","0"),
("1462","15","32","38","1","1","1","0","0"),
("1463","15","40","41","0","0","0","0","0"),
("1464","15","40","46","0","0","0","0","0"),
("1465","15","40","48","1","1","1","0","0"),
("1466","15","40","52","1","1","1","0","0"),
("1467","15","40","54","0","0","0","0","0"),
("1468","15","40","121","0","0","0","0","0"),
("1469","15","55","56","1","1","1","0","0"),
("1470","15","59","60","0","0","0","0","0"),
("1471","15","63","64","1","1","1","0","0"),
("1472","15","67","68","1","1","1","0","0"),
("1473","15","67","69","1","1","1","0","0"),
("1474","15","67","70","1","1","1","0","0"),
("1475","15","67","71","1","1","1","0","0"),
("1476","15","67","72","1","1","1","0","0"),
("1477","15","67","73","1","1","1","0","0"),
("1478","15","67","74","1","1","1","0","0"),
("1479","15","67","75","1","1","1","0","0"),
("1480","15","67","76","1","1","1","0","0"),
("1481","15","67","77","1","1","1","0","0"),
("1482","15","67","78","1","1","1","0","0"),
("1483","15","67","79","1","1","1","0","0"),
("1484","15","67","80","1","1","1","0","0"),
("1485","15","67","81","1","1","1","0","0");
INSERT INTO tbl_permission VALUES
("1486","15","67","91","0","0","0","0","0"),
("1487","15","82","83","1","1","1","0","0"),
("1488","15","82","85","1","1","1","0","0"),
("1489","15","92","93","0","0","0","0","0"),
("1490","15","92","95","0","0","0","0","0"),
("1491","15","99","100","0","0","0","0","0"),
("1492","15","99","101","0","0","0","0","0"),
("1493","15","126","127","0","0","0","0","0"),
("1782","13","1","2","0","0","0","0","0"),
("1783","13","3","4","1","1","1","0","0"),
("1784","13","9","10","1","1","1","0","0"),
("1785","13","12","13","1","1","1","0","0"),
("1786","13","15","16","1","1","1","0","0"),
("1787","13","15","18","1","1","1","0","0"),
("1788","13","15","19","1","1","1","0","0"),
("1789","13","15","120","0","0","0","0","0"),
("1790","13","20","21","0","0","0","0","0"),
("1791","13","23","24","0","0","0","0","0"),
("1792","13","23","26","0","0","0","0","0"),
("1793","13","23","28","0","0","0","0","0"),
("1794","13","23","30","0","0","0","0","0"),
("1795","13","32","33","1","1","1","1","1"),
("1796","13","32","35","1","1","1","1","0"),
("1797","13","32","37","1","1","1","0","0"),
("1798","13","32","38","1","1","1","0","0"),
("1799","13","40","41","0","0","0","0","0"),
("1800","13","40","46","0","0","0","0","0"),
("1801","13","40","48","1","1","1","0","0"),
("1802","13","40","52","1","1","1","0","0"),
("1803","13","40","54","0","0","0","0","0"),
("1804","13","40","121","0","0","0","0","0"),
("1805","13","55","56","1","1","1","0","0"),
("1806","13","59","60","0","0","0","0","0"),
("1807","13","63","64","1","1","1","0","0"),
("1808","13","67","68","0","0","0","0","0"),
("1809","13","67","69","1","1","1","0","0"),
("1810","13","67","70","0","0","0","0","0"),
("1811","13","67","71","1","1","1","0","0"),
("1812","13","67","72","1","1","1","0","0"),
("1813","13","67","73","0","0","0","0","0"),
("1814","13","67","74","1","1","1","0","0"),
("1815","13","67","75","1","1","1","0","0"),
("1816","13","67","76","1","1","1","0","0"),
("1817","13","67","77","1","1","1","0","0"),
("1818","13","67","78","1","1","1","0","0"),
("1819","13","67","79","1","1","1","0","0"),
("1820","13","67","80","1","1","1","0","0"),
("1821","13","67","81","1","1","1","0","0"),
("1822","13","67","91","0","0","0","0","0"),
("1823","13","82","83","1","1","1","0","0"),
("1824","13","82","85","1","1","1","0","0"),
("1825","13","92","93","0","0","0","0","0"),
("1826","13","92","95","0","0","0","0","0"),
("1827","13","99","100","0","0","0","0","0"),
("1828","13","99","101","0","0","0","0","0"),
("1829","13","126","127","1","1","1","0","0");




CREATE TABLE `tbl_plan_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) DEFAULT NULL,
  `plan_notes` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_plans` (
  `id` int(11) NOT NULL,
  `plan_name` text NOT NULL,
  `plan_rate` float NOT NULL,
  `total_credit` text NOT NULL,
  `plan_duration` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_plans VALUES
("1","BASIC PLAN","10","1200","1","2021-10-02"),
("2","STANDARD PLAN","20","2400","2","2021-10-01"),
("3","LIMITED PLAN","50","6000","4","2021-10-01"),
("5","UNLIMITED PLAN","99","12000","5","2021-10-01");




CREATE TABLE `tbl_purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `iemi` int(11) NOT NULL DEFAULT 0,
  `location` text DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `po_remarks` text DEFAULT NULL,
  `narration` text DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `net_amount` float DEFAULT NULL,
  `gross_amount` float DEFAULT NULL,
  `amount_payed` float DEFAULT 0,
  `amount_remaining` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `bill_status` text DEFAULT NULL,
  `payment_status` text DEFAULT NULL,
  `bank_id` text DEFAULT NULL,
  `check_no` text DEFAULT NULL,
  `payment_method` text DEFAULT NULL,
  `item_total` int(11) DEFAULT NULL,
  `item_recieved` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `grn_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_purchase_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `invoice_no` text NOT NULL,
  `product` text NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_rec` int(11) DEFAULT NULL,
  `item_serial` text DEFAULT '0',
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` text DEFAULT '0',
  `rate` float NOT NULL,
  `amount` float NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `transfer` int(11) NOT NULL DEFAULT 0,
  `iemi` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `pur_item_id` (`pur_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_purchase_req` (
  `purchase_req_id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_type` int(11) NOT NULL DEFAULT 0,
  `transfer_status` int(11) NOT NULL DEFAULT 0,
  `iemi` int(11) NOT NULL DEFAULT 0,
  `location` int(11) DEFAULT NULL,
  `from_location` int(11) NOT NULL DEFAULT 0,
  `invoice_no` text DEFAULT NULL,
  `invoice_date` text DEFAULT NULL,
  `po_remarks` text DEFAULT NULL,
  `net_amount` text DEFAULT NULL,
  `gross_amount` text DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `stock_status` text DEFAULT NULL,
  `stock_receive_status` text NOT NULL DEFAULT 'Pending',
  `item_total` int(11) DEFAULT NULL,
  `item_transfer` int(11) DEFAULT NULL,
  `item_recieved` int(11) NOT NULL DEFAULT 0,
  `stock_tranfer_date` date DEFAULT NULL,
  `stock_rec_date` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `admin_read` int(11) NOT NULL DEFAULT 0,
  `branch_read` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`purchase_req_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_purchase_req_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_req_id` int(11) DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `product` text DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `qty_rec` text DEFAULT NULL,
  `item_serial` text DEFAULT NULL,
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` text DEFAULT NULL,
  `rate` text DEFAULT NULL,
  `amount` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `trans_parent_id` int(11) DEFAULT NULL,
  `transfer` int(11) NOT NULL DEFAULT 0,
  `iemi` int(11) NOT NULL DEFAULT 0,
  `recieved` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_purchase_return` (
  `purchase_return_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) DEFAULT NULL,
  `return_type` text DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `po_remarks` text DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `net_amount` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `amount_received` float DEFAULT NULL,
  `payment_method` text DEFAULT NULL,
  `bank_id` text DEFAULT NULL,
  `check_no` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`purchase_return_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_purchase_return_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_return_id` int(11) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `product` text DEFAULT NULL,
  `return_qty` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `return_amount` float DEFAULT NULL,
  `item_serial` text DEFAULT NULL,
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_mem_id` int(11) DEFAULT NULL,
  `staff_mem_salary` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_sale` (
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) DEFAULT NULL,
  `iemi` int(11) NOT NULL DEFAULT 0,
  `local` int(11) NOT NULL DEFAULT 0,
  `sale_type` varchar(255) DEFAULT NULL,
  `sales_men` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `customer_cnic` text DEFAULT NULL,
  `customer_email` text DEFAULT NULL,
  `net_amount` float DEFAULT NULL,
  `gross_amount` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `amount_recieved` float DEFAULT NULL,
  `amount_remaining` float DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`sale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_sale_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` text DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `product` text DEFAULT NULL,
  `item_serial` text NOT NULL DEFAULT '0',
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` text NOT NULL DEFAULT '0',
  `qty` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `amount` float NOT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `local` int(11) NOT NULL DEFAULT 0,
  `returned` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_sale_return` (
  `sale_return_id` int(11) NOT NULL AUTO_INCREMENT,
  `iemi` int(11) NOT NULL DEFAULT 0,
  `sale_id` int(11) DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `sale_type` text DEFAULT NULL,
  `sales_men` int(11) DEFAULT NULL,
  `customer_name` text DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `customer_phone` text DEFAULT NULL,
  `customer_cnic` text DEFAULT NULL,
  `customer_email` text DEFAULT NULL,
  `net_amount` float DEFAULT NULL,
  `amount_returned` float DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`sale_return_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_sale_return_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iemi` int(11) NOT NULL DEFAULT 0,
  `sale_id` int(11) DEFAULT NULL,
  `sale_return_id` int(11) DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `product` text DEFAULT NULL,
  `item_serial` text NOT NULL DEFAULT '0',
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` text NOT NULL DEFAULT '0',
  `returned_qty` text DEFAULT NULL,
  `qty` text DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `return_amount` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `returned` int(11) NOT NULL DEFAULT 0,
  `local` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_salesmen` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text DEFAULT NULL,
  `username` text DEFAULT NULL,
  `designation` text DEFAULT NULL,
  `mobile_no1` text DEFAULT NULL,
  `mobile_no2` text DEFAULT NULL,
  `address_current` text DEFAULT NULL,
  `address_permanent` text DEFAULT NULL,
  `user_profile` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `salemen_cnic` text DEFAULT NULL,
  `salemen_fathername` text DEFAULT NULL,
  `salemen_residential` text DEFAULT NULL,
  `salary` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_salesmen VALUES
("15","MANSOORAHMAD@GMAIL.COM","MANSOOR AHMAD ","BM,MO,AVO,SALESMAN","0303-1644947","0341-6545446","SADDAR CANT ","HAYATABAD PESHAWAR ","","Male","17451-2023645-4","AHMAD ","Personal","25000","1","2021-11-10"),
("16","MOSHINBANGASH@GMAIL COM ","MOHSIN BANGASH ","MO","0303-1545465","0346-5465465","SADDAR CANT ","HAYATABAD PESHAWAR ","","Male","15468-5486540-2","KHAN ","Personal","10000","1","2021-09-29"),
("17","ATIFULLAH@GMAIL.COM","ATIF ULLAH ","AVO","0312-3154654","0341-6546548","SADDAR CANT ","HAYATABAD PESHAWAR ","","Male","56484-7116548-4","KHAZAR","Personal","","1","2021-10-14"),
("18","1541654654612301","BAHRAM KHAN ","AVO","0303-1554220","0303-1154464","DEANS","SADDAR BAZAR ","","Other","17301-6546546-4","SAHIL ","Personal","15000","1","2021-09-29"),
("19","TEST1@GMAIL.COM","BAHRAM KHAN ","MO,AVO,SALESMAN","0304-6546546","0345-4654654","SADDAR CANT ","HAYATABAD PESHAWAR ","","Male","17301-5420015-1","LIQAT ALI ","Personal","15000","1","2021-12-24"),
("20","TEST2@GMAIL.COM","MOHSIN BANGASH ","MO","0302-1541654","0323-5416546","SADAR CANT ","SADDAR BAZAR ","","Male","17301-6544654-6","IHSAN KHAN ","Personal","15000","13","2021-09-29"),
("21","TEST3@GMAIL.COM","BILAL KHAN ","SALESMAN","0305-2165464","0354-6546464","SADDAR CANT ","DALZAK ROAD PESHAWAR ","","Male","54648-2011644-4","SYED JAMAL ","Personal","15000","1","2021-11-09"),
("22","TEST4@GMAIL.COM","ASAD SAIB ","BM","0311-6541650","0303-2051541","SADDAR CANT ","BARA GATE RAOD PESHAWAR ","","Male","17301-4464213-2","ALI AKBAR ","Personal","100000","13","2021-09-29"),
("23","umarfarooq@gmail.com","UMAR FAROOQ","SRO","0332-5558555","0356-5555655","UNIVERSITY TOWN","KOHAT ROAD ","","Male","17301-5885658-9","Ghulam Sabir","Personal","25000","13","2021-10-01"),
("24","admin@gmail.com","Naeem","SALESMAN,SRM,RM,CRC","0300-0882001","0300-0882001","asd","Address  Plot No -33 Riaz Business Center  Business Park Gulburg Greens Gulbarg Islamabad  Pakistan","","Male","98465-4465465-4","asd","Personal","12000","1","2021-12-24"),
("25","","Qadir","BM","0312-3123121","","","","","Male","21312-3123123-1","","Personal","","1","2021-10-12");




CREATE TABLE `tbl_single_purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `iemi` int(11) NOT NULL DEFAULT 0,
  `location` text DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `invoice_date` text DEFAULT NULL,
  `po_remarks` text DEFAULT NULL,
  `narration` text DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `net_amount` float DEFAULT NULL,
  `gross_amount` float DEFAULT NULL,
  `amount_payed` float DEFAULT 0,
  `amount_remaining` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `bill_status` text DEFAULT NULL,
  `payment_status` text DEFAULT NULL,
  `bank_id` text DEFAULT NULL,
  `check_no` text DEFAULT NULL,
  `payment_method` text DEFAULT NULL,
  `item_total` int(11) DEFAULT NULL,
  `item_recieved` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `grn_date` text DEFAULT NULL,
  `payment_date` text DEFAULT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_single_purchase_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `invoice_no` text NOT NULL,
  `product` text NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_rec` int(11) DEFAULT NULL,
  `item_serial` text NOT NULL DEFAULT '0',
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` text NOT NULL DEFAULT '0',
  `rate` float NOT NULL,
  `amount` float NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `iemi` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `pur_item_id` (`pur_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_sub_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` text DEFAULT NULL,
  `sub_cat_name` text DEFAULT NULL,
  `brand_id` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_sub_cat VALUES
("5","6","A32 6/128GB","2","1","2021-09-29"),
("6","6","A10S 2/32","2","1","2021-09-29"),
("7","6","M11 3/32GB","2","1","2021-09-29"),
("10","3","Roof Fan","5","1","2021-07-15"),
("11","3","Water Cooler","5","1","2021-07-15"),
("14","8","Smart Tv","4","1","2021-07-15"),
("15","8","Non Smart TV","4","1","2021-07-15"),
("16","11","Y20","13","1","2021-09-29"),
("17","11","Y20s","13","1","2021-09-29"),
("18","11","Y1s 2+32G","13","1","2021-09-29"),
("19","11","Y12s 3+32G","13","1","2021-09-29"),
("20","11","Y31 4+128G","13","1","2021-09-29"),
("21","11","Y51 8+128G","13","1","2021-09-29"),
("22","11","Y53s 8+128G","13","1","2021-09-29"),
("23","11","V21 8+128G","13","1","2021-09-29"),
("24","11","V21e 8+128G","13","1","2021-09-29"),
("25","11","X60 Pro 12+256G","13","1","2021-09-29"),
("26","11","V20 8/128GB","13","1","2021-09-29"),
("27","6","A12 4/64GB","2","1","2021-09-29"),
("28","6","A12 4/128GB","2","1","2021-09-29"),
("29","6","A31 4/128GB","2","1","2021-09-29"),
("30","6","A52 8/128GB","2","1","2021-09-29"),
("31","6","A72 8/128GB","2","1","2021-09-29"),
("32","6","A72 8/256","2","1","2021-09-29"),
("33","6","A02S 3/32","2","1","2021-09-29"),
("34","6","A02S 4/64","2","1","2021-09-29"),
("35","12","Hot 10 4/64GB","14","1","2021-09-29"),
("36","12","Hot 10 4/128GB","14","1","2021-09-29"),
("37","12","Hot 10 6/128 GB","14","1","2021-09-29"),
("38","12","Hot 9 Play 4/64 GB","14","1","2021-09-29"),
("39","12","NOTE 10 6/128 GB","14","1","2021-09-29"),
("40","12","Note 8 6/128 GB","14","1","2021-09-29"),
("41","12","Zero 8 8/128 GB","14","1","2021-09-29"),
("42","12","Zero 8i 8/128 GB","14","1","2021-09-29"),
("43","12","hot 10i 4/128 GB","14","1","2021-09-29"),
("44","12","HOT 10S 6/128 GB","14","1","2021-09-29"),
("45","12","NOTE 10PRO 8/128 GB","14","1","2021-09-29"),
("46","12","NOTE 10 PRO 8/256 GB","14","1","2021-09-29"),
("47","12","HOT 10 PLAY 4/64 GB","14","1","2021-09-29"),
("48","13","F15S 4/64 GB","15","1","2021-09-29"),
("49","13","454 4/128 GB","15","1","2021-09-29"),
("50","13","A53 4/64 GB","15","1","2021-09-29"),
("51","13","RENO 5 PRO 12/256 GB","15","1","2021-09-29"),
("52","13","A15S 4/64 GB","15","1","2021-09-29"),
("53","13","F19 PRO 6/128 GB","15","1","2021-09-29"),
("54","13","F17 PRO 8/128 GB","15","1","2021-09-29"),
("55","13","F17 8/128 GB","15","1","2021-09-29"),
("56","13","RENO 5 8/128 GB","15","1","2021-09-29"),
("57","3","Y9 A 8/128 GB","16","1","2021-09-29"),
("58","3","Y6 P 3/32 GB","16","1","2021-09-29"),
("59","3","Y7 A 4/64 GB","16","1","2021-09-29"),
("60","3","Y9 PRIME 4/64 GB","16","1","2021-09-29"),
("61","3","Y9 Prime 4/128 GB","16","1","2021-09-29"),
("62","3","Y8 P 6/128 GB","16","1","2021-09-29"),
("63","3","Y9 S 6/128 GB","16","1","2021-09-29"),
("64","3","Nova 7i 8/128 GB","16","1","2021-09-29"),
("65","3","P30 8/128 GB","16","1","2021-09-29"),
("66","3","P30 Pro 8/128 GB","16","1","2021-09-29"),
("67","3","Mate 20 Pro 6/128 GB","16","1","2021-09-29"),
("68","22","Redmi 9C 3/64 GB","17","1","2021-09-29"),
("69","22","Poco X3 6/128 GB","17","1","2021-09-29"),
("70","22","Poco X3 6/128 GB","17","1","2021-09-29"),
("71","22","Poco X3 PRO 8/256 GB","17","1","2021-09-29"),
("72","22","Redmi note 10 4/128 GB","17","1","2021-09-29"),
("73","22","Redmi Note 10 PRO 6/128 GB","17","1","2021-09-29"),
("74","22","REDMI NOTE 10 5G","17","1","2021-09-29"),
("75","22","REDMI NOTE 10S 6/128 GB","17","1","2021-09-29"),
("76","22","REDMI NOTE 10 S 6/128 GB","17","1","2021-09-29"),
("77","22","REDMI NOTE 10S 8/128 GB","17","1","2021-09-29"),
("78","22","Mi11 lite 6/128 GB","17","1","2021-09-29"),
("79","22","Mi 10T 8/128 GB","17","1","2021-09-29"),
("80","22","POCO X3 6/128 GB","17","1","2021-09-29"),
("81","22","MI 11 8/256","17","1","2021-09-29"),
("82","23","Realme C21 4/64GB","18","1","2021-09-29"),
("83","23","Realme 8 8/128GB","18","1","2021-09-29"),
("84","23","Realme 8 Pro 8/128GB","18","1","2021-09-29"),
("85","23","Realme 6 8/128GB","18","1","2021-09-29"),
("86","23","Realme 6 pro 8/128GB","18","1","2021-09-29"),
("87","23","Realme C11 2/32GB","18","1","2021-09-29"),
("88","23","Realme C123/32GB","18","1","2021-09-29"),
("89","23","REALME 7i 8/128GB","18","1","2021-09-29"),
("90","23","Realme 7 Pro 8/128GB","18","1","2021-09-29"),
("91","22","Realme C 17 6/128GB","17","1","2021-09-29"),
("92","23","Realme XT 8/128GB","18","1","2021-09-29"),
("93","24","Pova 6/128GB","19","1","2021-09-29"),
("94","24","Cammon 16 pro 6/128GB","19","1","2021-09-29");




CREATE TABLE `tbl_trans` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` text DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `account_id` text DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `narration` text DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `amount_payed` float DEFAULT NULL,
  `amount_recieved` int(11) DEFAULT NULL,
  `v_type` text DEFAULT NULL,
  `bill_status` text DEFAULT NULL,
  `payment_status` text DEFAULT NULL,
  `bank_id` text DEFAULT NULL,
  `check_no` text DEFAULT NULL,
  `payment_method` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`trans_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_trans_detail` (
  `trans_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_id` int(11) DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `acode` text DEFAULT NULL,
  `d_amount` float DEFAULT NULL,
  `c_amount` float DEFAULT NULL,
  `bill_status` text DEFAULT NULL,
  `narration` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`trans_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `tbl_vendors` (
  `v_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) DEFAULT NULL,
  `username` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `mobile_no` text DEFAULT NULL,
  `user_profile` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;


INSERT INTO tbl_vendors VALUES
("14","200200102","Vendor 1","vendor1@gmail.com","Address  Plot No -33 Riaz Business Center  Business Park Gulburg Greens Gulbarg Islamabad  Pakistan","03000882001","uploads/userprofiles/2632357091628069567.jpg","2021-08-24","1"),
("19","200200104","Safdar mobile","asd@gmail.com","","0333333333333","","2021-09-03","1"),
("21","200200105","test","","","323232323232","","2021-10-11","13"),
("26","200200106","osoro","","","0321-3154564","","2021-11-29","15");




CREATE TABLE `tbl_zone` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_name` text NOT NULL,
  `parent_zone_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;


INSERT INTO tbl_zone VALUES
("12","Peshawar","0","1","2021-09-22"),
("15","Phase 1","12","1","2021-09-22"),
("16","Phase 2","12","1","2021-09-22"),
("17","Phase 3","12","1","2021-09-22");




CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` text DEFAULT NULL,
  `user_name` text NOT NULL,
  `user_email` text NOT NULL,
  `user_password` text NOT NULL,
  `user_privilege` text NOT NULL,
  `user_country` text DEFAULT NULL,
  `user_state` text DEFAULT NULL,
  `user_city` text DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_phone` text DEFAULT NULL,
  `user_birthday` date DEFAULT NULL,
  `user_gender` text DEFAULT NULL,
  `user_profile` text DEFAULT NULL,
  `contact_no` text DEFAULT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `permission` int(11) NOT NULL DEFAULT 1,
  `c_read` int(11) NOT NULL DEFAULT 1,
  `c_write` int(11) NOT NULL DEFAULT 1,
  `c_delete` int(11) NOT NULL DEFAULT 1,
  `s_read` int(11) NOT NULL DEFAULT 1,
  `s_write` int(11) NOT NULL DEFAULT 1,
  `s_delete` int(11) NOT NULL DEFAULT 1,
  `p_read` int(11) DEFAULT 1,
  `p_write` int(11) DEFAULT 1,
  `p_delete` int(11) DEFAULT 1,
  `a_read` int(11) NOT NULL DEFAULT 1,
  `a_write` int(11) NOT NULL DEFAULT 1,
  `a_delete` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;


INSERT INTO users VALUES
("1","","Head Office","admin@gmail.com","$2y$10$d1nf7aQTAtJVbusntpssH.6NTIRqB/2VXQWQP7j9vhbTiXfMJ4Gfm","superadmin","PK","islamabad","islamabad","Address  Plot No -33 Riaz Business Center  Business Park Gulburg Greens Gulbarg Islamabad  Pakistan","03000882001","0000-00-00","male","uploads/Profiles/13576482481625145883.jpg","","2021-07-01","1","1","1","1","1","1","1","1","1","1","1","1","1","1"),
("10","","Ahmed","ahmed@gmail.com","$2y$10$d1nf7aQTAtJVbusntpssH.6NTIRqB/2VXQWQP7j9vhbTiXfMJ4Gfm","operator","PK","","","","","2021-12-22","male","","","2021-08-30","1","1","1","1","1","1","1","1","1","1","1","1","1","1"),
("13","100100101","DEANS ","branch@gmail.com","$2y$10$d1nf7aQTAtJVbusntpssH.6NTIRqB/2VXQWQP7j9vhbTiXfMJ4Gfm","branch","","","","Saddar  Peshawar","091 3026218","0000-00-00","","","091 3026218","2021-08-31","1","1","1","1","1","1","1","1","1","1","1","1","1","1"),
("14","","BranchOperator","branchop@gmail.com","$2y$10$ezQS5NA8TSVXWpyHV.9pAOpWSqoeKrunxrnANj8NJfdViFRxCx.s6","operator","","","","","","0000-00-00","","","","2021-08-31","13","1","1","1","1","1","1","1","1","1","1","1","1","1"),
("15","100100102","Bara Road Branch ","test@gmail.com","$2y$10$5mJQ041cQuAG8yCq77eAdO5m9NMWGHQpB/g83Zo6SWAAIJMZZtcM2","branch","PK","","","Bara Road Peshawar","03338087280","0000-00-00","male","","03338087280","2021-09-03","1","1","1","1","1","1","1","1","1","1","1","1","1","1"),
("16","","Zubair","test1@gmail.com","$2y$10$GtPh7MpNO5WHBJScLcdDPO1YDbeTu19Gl8MsdW/fByWVuPqAYjU3m","operator","","","","","","0000-00-00","","","","2021-09-03","15","1","1","1","1","1","1","1","1","1","1","1","1","1"),
("19","100100103","Dilzak Road ","Dilzak@321","$2y$10$3bS2iglmjjYKgk4h0ta4zey5izNRVI7VFd3Audhg/SifG1fYpWz3W","branch","","","","","03139655802","0000-00-00","","","091 3026218","2021-09-29","1","1","1","1","1","1","1","1","1","1","1","1","1","1"),
("20","100100104","University Road","Uni@321","$2y$10$IsHARj8GHXHayClvynKgk.U3XZBqTLdS2CDP1uC7KQkDAVG70w94a","branch","","","","","03139655802","0000-00-00","","","091 3026218","2021-09-29","1","1","1","1","1","1","1","1","1","1","1","1","1","1"),
("25","100100105","asdasd","asd@gmail.com","$2y$10$ocIE5mNtQ0I/Capf4zG9eecI8a05WFQK9batW4mmHyWgBC5rkK2Su","branch","","","","	Zzxc","","","","","","2021-12-27","1","1","1","1","1","1","1","1","1","1","1","1","1","1");




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;