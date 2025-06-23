-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2025 at 05:19 PM
-- Server version: 10.3.39-MariaDB
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_alitownsnooker`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `id` int(11) NOT NULL,
  `parent_code` int(11) DEFAULT NULL,
  `acode` int(11) DEFAULT NULL,
  `aname` text DEFAULT NULL,
  `opening_bal` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `opening_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_lv2`
--

CREATE TABLE `tbl_account_lv2` (
  `id` int(11) NOT NULL,
  `parent_code` int(11) DEFAULT NULL,
  `sub_child1` int(11) DEFAULT NULL,
  `acode` bigint(20) DEFAULT NULL,
  `aname` text DEFAULT NULL,
  `opening_bal` text DEFAULT NULL,
  `opening_date` date DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_account_lv2`
--

INSERT INTO `tbl_account_lv2` (`id`, `parent_code`, `sub_child1`, `acode`, `aname`, `opening_bal`, `opening_date`, `created_date`, `created_by`) VALUES
(1, 100000000, 100200000, 100200101, 'ashraf', NULL, NULL, '2025-01-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acode`
--

CREATE TABLE `tbl_acode` (
  `id` int(11) NOT NULL,
  `acode` int(11) NOT NULL,
  `aname` text NOT NULL,
  `atype` text NOT NULL,
  `effect` text DEFAULT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendence`
--

CREATE TABLE `tbl_attendence` (
  `att_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `attadance_date` datetime NOT NULL,
  `attadance_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id` int(11) NOT NULL,
  `bank` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bonus`
--

CREATE TABLE `tbl_bonus` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `bonus` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branch_target`
--

CREATE TABLE `tbl_branch_target` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `target` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cat`
--

CREATE TABLE `tbl_cat` (
  `id` int(11) NOT NULL,
  `catagory_name` text DEFAULT NULL,
  `brand_id` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_cat`
--

INSERT INTO `tbl_cat` (`id`, `catagory_name`, `brand_id`, `created_by`, `created_date`) VALUES
(5, 'Single Frame', 'Choose Brand', 1, '2025-01-28'),
(6, 'single frame ', '12', 1, '2025-01-28'),
(7, 'Double Frame', 'Choose Brand', 1, '2025-01-28'),
(8, 'Double Frame', '12', 1, '2025-01-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_catagory`
--

CREATE TABLE `tbl_catagory` (
  `id` int(11) NOT NULL,
  `cat_name` text DEFAULT NULL,
  `transfer_perc` text DEFAULT NULL,
  `cat_image` text DEFAULT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_catagory`
--

INSERT INTO `tbl_catagory` (`id`, `cat_name`, `transfer_perc`, `cat_image`, `created_date`, `created_by`) VALUES
(11, 'xyz', '', NULL, '2025-01-28', 1),
(12, '199 Snooker Lounge', '', NULL, '2025-01-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_type`
--

CREATE TABLE `tbl_client_type` (
  `type_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `comp_id` int(11) NOT NULL,
  `c_name` text DEFAULT NULL,
  `c_email` text DEFAULT NULL,
  `c_mobile` text DEFAULT NULL,
  `c_phone` text DEFAULT NULL,
  `user_profile` text DEFAULT NULL,
  `c_address` text DEFAULT NULL,
  `sale_per` text DEFAULT NULL,
  `avo_perc` float DEFAULT NULL,
  `mo_perc` text DEFAULT NULL,
  `color` text DEFAULT NULL,
  `lang` text DEFAULT NULL,
  `secret` text DEFAULT NULL,
  `over_selling` int(11) NOT NULL DEFAULT 0,
  `comp_status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`comp_id`, `c_name`, `c_email`, `c_mobile`, `c_phone`, `user_profile`, `c_address`, `sale_per`, `avo_perc`, `mo_perc`, `color`, `lang`, `secret`, `over_selling`, `comp_status`) VALUES
(1, '199 SNOOKER', 'rishy0000@gmail.com', '03067990000', '03067990000', 'uploads/company_img/18089675931726914211.jpg', 'rashid brothers jampur', '', NULL, NULL, 'green', 'an', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contacts`
--

CREATE TABLE `tbl_contacts` (
  `contact_id` int(11) NOT NULL,
  `contact_name` text NOT NULL,
  `contact_number` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `c_id` int(11) NOT NULL,
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
  `customer_type` int(11) NOT NULL DEFAULT 0,
  `fixed_discount` int(11) NOT NULL DEFAULT 0,
  `zone` text DEFAULT NULL,
  `sub_zone` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`c_id`, `customer_id`, `seprate_customer_id`, `blacklist`, `username`, `mobile_no1`, `mobile_no2`, `address_current`, `address_permanent`, `address_office`, `user_profile`, `gender`, `client_cnic`, `client_fathername`, `client_residential`, `client_occupation`, `client_salary`, `customer_type`, `fixed_discount`, `zone`, `sub_zone`, `created_by`, `parent_id`, `created_date`) VALUES
(170, 100200101, '6000', 0, 'ashraf', '03336450000', NULL, '', '', NULL, NULL, NULL, '1234512345671', '', NULL, NULL, NULL, 0, 0, NULL, NULL, 1, 1, '2025-01-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designation`
--

CREATE TABLE `tbl_designation` (
  `designation_id` int(11) NOT NULL,
  `designation_name` text NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_leave`
--

CREATE TABLE `tbl_emp_leave` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `leave_type` text DEFAULT NULL,
  `status` text NULL,
  `f_date` date DEFAULT NULL,
  `t_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense`
--

CREATE TABLE `tbl_expense` (
  `id` int(11) NOT NULL,
  `expense` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn_documents`
--

CREATE TABLE `tbl_grn_documents` (
  `id` int(11) NOT NULL,
  `po_id` int(11) DEFAULT NULL,
  `documents` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_head`
--

CREATE TABLE `tbl_head` (
  `id` int(11) NOT NULL,
  `acode` int(11) NOT NULL,
  `aname` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_head`
--

INSERT INTO `tbl_head` (`id`, `acode`, `aname`, `created_by`, `created_date`) VALUES
(1, 100000000, 'Asset Accounts', 1, '2021-07-14'),
(2, 200000000, 'Liability Accounts', 1, '2021-07-14'),
(4, 300000000, 'Revenue Accounts', 1, '2021-07-14'),
(5, 400000000, 'Equity Accounts', 1, '2021-07-14'),
(7, 500000000, 'Expense Accounts', 1, '2021-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_installment`
--

CREATE TABLE `tbl_installment` (
  `plan_id` int(11) NOT NULL,
  `location` int(11) DEFAULT NULL,
  `iemi` int(11) NOT NULL DEFAULT 0,
  `customer` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_serial` text NULL,
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` text NULL,
  `total_price` float DEFAULT NULL,
  `down_payment` float NOT NULL,
  `period` int(11) NOT NULL,
  `per_month_amount` float NOT NULL,
  `amount_recieved` text NULL,
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
  `end_date` text DEFAULT NULL,
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
  `local` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_installment_payment`
--

CREATE TABLE `tbl_installment_payment` (
  `payment_id` int(11) NOT NULL,
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
  `prev_balance` text DEFAULT NULL,
  `remaing` text DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `from_date` text DEFAULT NULL,
  `to_date` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `brand_id` text DEFAULT NULL,
  `item_name` text DEFAULT NULL,
  `barcode` varchar(500) DEFAULT NULL,
  `item_model` text DEFAULT NULL,
  `sub_category` text DEFAULT NULL,
  `category` text DEFAULT NULL,
  `item_image` text DEFAULT NULL,
  `item_description` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `purchase` text NOT NULL,
  `retail` text DEFAULT NULL,
  `mini_wholesale` text DEFAULT NULL,
  `wholesale` text DEFAULT NULL,
  `type_a` text DEFAULT NULL,
  `type_b` text DEFAULT NULL,
  `type_c` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`id`, `item_id`, `brand_id`, `item_name`, `barcode`, `item_model`, `sub_category`, `category`, `item_image`, `item_description`, `created_date`, `created_by`, `purchase`, `retail`, `mini_wholesale`, `wholesale`, `type_a`, `type_b`, `type_c`) VALUES
(1, 1001, '12', 'Single Frame', '123456', '', '3', '5', NULL, '                                      ', '2025-01-28', 1, '0', '200', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_price`
--

CREATE TABLE `tbl_item_price` (
  `item_price_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `cash_price` text DEFAULT NULL,
  `installment_price` text DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jv`
--

CREATE TABLE `tbl_jv` (
  `jv_id` int(11) NOT NULL,
  `location` int(11) DEFAULT NULL,
  `acc_id` text DEFAULT NULL,
  `accid_2` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `narration` text DEFAULT NULL,
  `narration2` text DEFAULT NULL,
  `debit` text DEFAULT NULL,
  `credit` text DEFAULT NULL,
  `vou_status` text DEFAULT NULL,
  `voc_type` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_local_purchase`
--

CREATE TABLE `tbl_local_purchase` (
  `local_id` int(11) NOT NULL,
  `pur_req_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `iemi` int(11) NOT NULL,
  `product` text DEFAULT NULL,
  `qty_allowed` int(11) DEFAULT NULL,
  `qty_purchased` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `cash_rate` text DEFAULT NULL,
  `inst_rate` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `allowed_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_read` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `page_id` int(11) NOT NULL,
  `page_name` text DEFAULT NULL,
  `page_link` text DEFAULT NULL,
  `group_id` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `visibility` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`page_id`, `page_name`, `page_link`, `group_id`, `parent_id`, `icon`, `visibility`) VALUES
(1, 'Branch', '', 'hr_menu', 1, 'icon-bar-chart', 0),
(2, 'Branch List', 'branch_list', 'hr_menu', 1, 'icon-list', 0),
(3, 'Users', '', 'hr_menu', 0, 'icon-users', 1),
(4, 'User List', 'users', 'hr_menu', 3, 'icon-list', 1),
(5, 'Add Branch', 'adding_branch', 'hr_menu', 1, 'icon-list', 0),
(6, 'Update Branch', 'branch_update', 'hr_menu', 1, 'icon-list', 0),
(7, 'Add User', 'add_users', 'hr_menu', 3, 'icon-list', 0),
(8, 'User Profile', 'user_profile', 'hr_menu', 3, 'icon-list', 0),
(9, 'Vendors', '', 'hr_menu', 0, 'icon-users', 1),
(10, 'Vendor List', 'vendor_list', 'hr_menu', 9, 'icon-list', 1),
(11, 'Add Vendor', 'add_vendors', 'hr_menu', 9, 'icon-list', 0),
(12, 'Customers', '', 'hr_menu', 0, 'icon-users', 1),
(13, 'Client List', 'client_list', 'hr_menu', 12, 'icon-users', 1),
(14, 'Add Clients', 'add_clients', 'hr_menu', 12, 'icon-users', 0),
(15, 'Employees', '', 'hr_menu', 0, 'icon-users', 1),
(16, 'Employee List', 'salesmen_list', 'hr_menu', 15, 'icon-users', 1),
(17, 'Employee Add', 'add_salemen', 'hr_menu', 15, 'icon-users', 0),
(18, 'Employee Leaves', 'emp_leave_list', 'hr_menu', 15, 'icon-users', 1),
(19, 'AVO Assign', 'avo_assign', 'hr_menu', 15, 'icon-users', 0),
(20, 'Installment Period', '', 'hr_menu', 20, 'icon-badge', 0),
(21, 'Period List', 'period_list', 'hr_menu', 20, 'icon-users', 1),
(22, 'Period Add', 'add_period', 'hr_menu', 20, 'icon-users', 0),
(23, 'Product', '', 'hr_menu', 0, 'icon-diamond', 1),
(24, 'Company List', 'brand_list', 'hr_menu', 23, '', 1),
(25, 'Company Add', 'add_brand', 'hr_menu', 23, '', 0),
(26, 'Catagory List', 'catagory_list', 'hr_menu', 23, '', 1),
(27, 'Catagory Add', 'add_catagory', 'hr_menu', 23, '', 0),
(28, 'Sub Catagory List', 'sub_catagory_list', 'hr_menu', 23, '', 1),
(29, 'Sub Catagory Add', 'add_sub_catagory', 'hr_menu', 23, '', 0),
(30, 'Product List', 'item_list', 'hr_menu', 23, '', 1),
(31, 'Product Add', 'add_item', 'hr_menu', 23, '', 0),
(38, 'Sale Return ', 'sale_return_list', 'pos_menu', 156, '', 1),
(39, 'Add Sale Return ', 'sale_return', 'pos_menu', 156, '', 0),
(40, 'Purchase', '', 'project_menu', 0, 'fa fa-usd', 1),
(41, 'Purchase', 'purchase_list', 'project_menu', 40, '', 1),
(54, 'Purchase Return', 'purchase_return_list', 'project_menu', 40, '', 1),
(59, 'Chart of Account', '', 'sub_menu', 0, 'icon-bar-chart', 1),
(60, 'Chart of Account', 'chart_of_account', 'sub_menu', 59, 'icon-bar-chart', 1),
(61, 'Add Account', 'add_account', 'sub_menu', 59, 'icon-bar-chart', 0),
(62, 'Add Opening', 'add_opening', 'sub_menu', 59, 'icon-bar-chart', 0),
(63, 'Accounts Voucher', '', 'sub_menu', 0, 'icon-briefcase', 1),
(65, 'Add Cash/Bank Vouchers', 'add_cash_payment', 'sub_menu', 63, 'icon-bar-chart', 0),
(66, 'Add JV Payment', 'add_jv_payment', 'sub_menu', 63, 'icon-bar-chart', 0),
(67, 'Reports', '', 'sub_menu', 0, 'fa fa-files-o', 1),
(68, 'Trial Balance', 'trail_balance_sum', 'sub_menu', 67, 'fa fa-files-o', 1),
(69, 'General Ledger', 'general_ledger_report', 'sub_menu', 67, 'fa fa-files-o', 1),
(70, 'Balance Sheet', 'balance_sheet', 'sub_menu', 67, 'fa fa-files-o', 1),
(71, 'Transaction History', 'get_ledger', 'sub_menu', 67, 'fa fa-files-o', 1),
(72, 'Profit/Loss Report', 'profit_report', 'sub_menu', 67, 'fa fa-files-o', 1),
(73, 'PO Report', 'single', 'sub_menu', 67, 'fa fa-files-o', 1),
(76, 'Stock Report', 'stock', 'sub_menu', 67, 'fa fa-files-o', 1),
(77, 'Vendor Detail Report', 'get_vendor_item', 'sub_menu', 67, 'fa fa-files-o', 1),
(78, 'Sale Report', 'single_sale', 'sub_menu', 67, 'fa fa-files-o', 1),
(79, 'Customer Report', 'get_customer_item', 'sub_menu', 67, 'fa fa-files-o', 1),
(81, 'Salary Report', 'single_salary', 'sub_menu', 67, 'fa fa-files-o', 1),
(82, 'Payroll', '', 'sub_menu', 0, 'icon-credit-card', 1),
(83, 'Employee Salary', 'salaries', 'sub_menu', 82, 'icon-credit-card', 1),
(84, 'Employee SalarySlip', 'payroll', 'sub_menu', 82, 'icon-credit-card', 0),
(85, 'Paid Salary', 'salary_paid', 'sub_menu', 82, 'icon-credit-card', 1),
(87, 'Add Purchase Return', 'purchase_return', 'project_menu', 40, '', 0),
(91, 'Inventory Report', 'inventory', 'sub_menu', 67, 'fa fa-files-o', 1),
(103, 'Purchase PO', 'purchase_po', 'project_menu', 40, '', 0),
(104, 'Grn', 'grn', 'project_menu', 40, '', 0),
(105, 'PO Payment', 'po_payment', 'project_menu', 40, '', 0),
(106, 'Pending PO Payment', 'pending_po_payment', 'project_menu', 40, '', 0),
(120, 'Designation List', 'designation_list', 'hr_menu', 15, 'icon-users', 1),
(133, 'Notification', 'notification', 'hr_menu', 1, 'icon-list', 0),
(141, 'Product Price List', 'item_price', 'hr_menu', 23, '', 1),
(153, 'Expense Report', 'expense_report', 'sub_menu', 67, 'fa fa-files-o', 1),
(154, 'Add JV Payment Invalid', 'add_invalid_jv', 'sub_menu', 63, 'icon-bar-chart', 0),
(155, 'Employee Attendance', 'employee_attandence', 'hr_menu', 15, 'icon-users', 1),
(156, 'POS', '', 'pos_menu', 0, 'fa fa-usd', 1),
(157, 'Add POS Sale', 'pos', 'pos_menu', 156, 'fa fa-usd', 1),
(158, 'POS Sale List', 'pos_sale_list', 'pos_menu', 156, 'fa fa-usd', 1),
(159, 'Product Import', 'import_item', 'hr_menu', 23, '', 1),
(160, 'Vendor Report', 'get_vendor_balance', 'sub_menu', 67, 'fa fa-files-o', 1),
(161, 'Client Type', 'client_type', 'hr_menu', 12, 'icon-users', 0),
(162, 'Add Client Type', 'add_client_type', 'hr_menu', 12, 'icon-users', 0),
(163, 'Add Vouchers', 'add_payment', 'sub_menu', 63, 'icon-bar-chart', 1),
(164, 'Tables', '', 'hr_menu', 0, ' icon-basket', 1),
(165, 'Tables List', 'table_list', 'hr_menu', 164, 'icon-users', 1),
(166, 'Add Tables', 'add_table', 'hr_menu', 164, 'icon-users', 0),
(167, 'Backup/Restore', '', 'hr_menu', 0, 'icon-folder', 1),
(168, 'Backup/Reset', 'backup', 'hr_menu', 167, 'icon-users', 1),
(169, 'Restore', 'restore', 'hr_menu', 167, 'icon-users', 1),
(171, 'Attendance Report', 'attandence_report', 'hr_menu', 15, 'icon-users', 1),
(172, 'Customer Balance Report', 'get_customer_balance', 'sub_menu', 67, 'fa fa-files-o', 1),
(173, 'Expense Sum Report', 'expense_report_sum', 'sub_menu', 67, 'fa fa-files-o', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `message_id` int(11) NOT NULL,
  `contact_id` text NOT NULL,
  `contact_number` text NOT NULL,
  `message` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message_main`
--

CREATE TABLE `tbl_message_main` (
  `message_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `location` int(11) DEFAULT NULL,
  `acc_id` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `total` text DEFAULT NULL,
  `payment_type` text DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_period`
--

CREATE TABLE `tbl_period` (
  `id` int(11) NOT NULL,
  `months` text DEFAULT NULL,
  `percentage` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission`
--

CREATE TABLE `tbl_permission` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `parent_page_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `W` int(11) DEFAULT NULL,
  `R` int(11) DEFAULT NULL,
  `D` int(11) DEFAULT NULL,
  `P` int(11) NOT NULL DEFAULT 0,
  `U` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_permission`
--

INSERT INTO `tbl_permission` (`id`, `user_id`, `parent_page_id`, `page_id`, `W`, `R`, `D`, `P`, `U`) VALUES
(8312, 38, 3, 4, 0, 0, 0, 0, 0),
(8313, 38, 3, 7, 0, 0, 0, 0, 0),
(8314, 38, 3, 8, 0, 0, 0, 0, 0),
(8315, 38, 9, 10, 0, 0, 0, 0, 0),
(8316, 38, 9, 11, 0, 0, 0, 0, 0),
(8317, 38, 12, 13, 1, 1, 0, 1, 1),
(8318, 38, 12, 14, 1, 1, 0, 1, 1),
(8319, 38, 12, 161, 1, 1, 0, 1, 1),
(8320, 38, 12, 162, 1, 1, 0, 1, 1),
(8321, 38, 15, 16, 0, 0, 0, 0, 0),
(8322, 38, 15, 17, 0, 0, 0, 0, 0),
(8323, 38, 15, 18, 0, 0, 0, 0, 0),
(8324, 38, 15, 19, 0, 0, 0, 0, 0),
(8325, 38, 15, 120, 0, 0, 0, 0, 0),
(8326, 38, 15, 155, 0, 0, 0, 0, 0),
(8327, 38, 15, 171, 0, 0, 0, 0, 0),
(8328, 38, 23, 24, 0, 0, 0, 0, 0),
(8329, 38, 23, 25, 0, 0, 0, 0, 0),
(8330, 38, 23, 26, 0, 0, 0, 0, 0),
(8331, 38, 23, 27, 0, 0, 0, 0, 0),
(8332, 38, 23, 28, 0, 0, 0, 0, 0),
(8333, 38, 23, 29, 0, 0, 0, 0, 0),
(8334, 38, 23, 30, 0, 0, 0, 0, 0),
(8335, 38, 23, 31, 0, 0, 0, 0, 0),
(8336, 38, 23, 141, 0, 0, 0, 0, 0),
(8337, 38, 23, 159, 0, 0, 0, 0, 0),
(8338, 38, 40, 41, 1, 1, 0, 1, 1),
(8339, 38, 40, 54, 1, 1, 0, 1, 1),
(8340, 38, 40, 87, 1, 1, 0, 1, 1),
(8341, 38, 40, 103, 1, 1, 0, 1, 1),
(8342, 38, 40, 104, 1, 1, 0, 1, 1),
(8343, 38, 40, 105, 1, 1, 0, 1, 1),
(8344, 38, 40, 106, 1, 1, 0, 1, 1),
(8345, 38, 59, 60, 1, 1, 0, 1, 1),
(8346, 38, 59, 61, 1, 1, 0, 1, 1),
(8347, 38, 59, 62, 1, 1, 0, 1, 1),
(8348, 38, 63, 65, 1, 1, 0, 1, 1),
(8349, 38, 63, 66, 0, 0, 0, 0, 0),
(8350, 38, 63, 154, 0, 0, 0, 0, 0),
(8351, 38, 63, 163, 1, 1, 0, 1, 1),
(8352, 38, 67, 68, 1, 1, 0, 1, 1),
(8353, 38, 67, 69, 1, 1, 0, 1, 1),
(8354, 38, 67, 70, 1, 1, 0, 1, 1),
(8355, 38, 67, 71, 1, 1, 0, 1, 1),
(8356, 38, 67, 72, 1, 1, 0, 1, 1),
(8357, 38, 67, 73, 1, 1, 0, 1, 1),
(8358, 38, 67, 76, 1, 1, 0, 1, 1),
(8359, 38, 67, 77, 1, 1, 0, 1, 1),
(8360, 38, 67, 78, 1, 1, 0, 1, 1),
(8361, 38, 67, 79, 1, 1, 0, 1, 1),
(8362, 38, 67, 81, 1, 1, 0, 1, 1),
(8363, 38, 67, 91, 1, 1, 0, 1, 1),
(8364, 38, 67, 153, 1, 1, 0, 1, 1),
(8365, 38, 67, 160, 1, 1, 0, 1, 1),
(8366, 38, 67, 172, 1, 1, 0, 1, 1),
(8367, 38, 82, 83, 1, 1, 0, 1, 1),
(8368, 38, 82, 84, 1, 1, 0, 1, 1),
(8369, 38, 82, 85, 1, 1, 0, 1, 1),
(8370, 38, 156, 38, 0, 0, 0, 0, 0),
(8371, 38, 156, 39, 1, 1, 0, 1, 1),
(8372, 38, 156, 157, 1, 1, 0, 1, 1),
(8373, 38, 156, 158, 1, 1, 0, 1, 1),
(8374, 38, 164, 165, 0, 0, 0, 0, 0),
(8375, 38, 164, 166, 0, 0, 0, 0, 0),
(8376, 38, 167, 168, 0, 0, 0, 0, 0),
(8377, 38, 167, 169, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plans`
--

CREATE TABLE `tbl_plans` (
  `id` int(11) NOT NULL,
  `plan_name` text NOT NULL,
  `plan_rate` float NOT NULL,
  `total_credit` text NOT NULL,
  `plan_duration` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plan_notes`
--

CREATE TABLE `tbl_plan_notes` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `plan_notes` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

CREATE TABLE `tbl_purchase` (
  `purchase_id` int(11) NOT NULL,
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
  `discount` text DEFAULT NULL,
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
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_detail`
--

CREATE TABLE `tbl_purchase_detail` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `invoice_no` text NOT NULL,
  `product` int(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_rec` int(11) DEFAULT NULL,
  `item_serial` text NULL,
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` varchar(500) DEFAULT '0',
  `rate` float NOT NULL,
  `sale_rate` text DEFAULT NULL,
  `amount` float NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `transfer` int(11) NOT NULL DEFAULT 0,
  `iemi` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_req`
--

CREATE TABLE `tbl_purchase_req` (
  `purchase_req_id` int(11) NOT NULL,
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
  `stock_receive_status` text NULL,
  `item_total` int(11) DEFAULT NULL,
  `item_transfer` int(11) DEFAULT NULL,
  `item_recieved` int(11) NOT NULL DEFAULT 0,
  `stock_tranfer_date` date DEFAULT NULL,
  `stock_rec_date` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `admin_read` int(11) NOT NULL DEFAULT 0,
  `branch_read` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_req_detail`
--

CREATE TABLE `tbl_purchase_req_detail` (
  `id` int(11) NOT NULL,
  `purchase_req_id` int(11) DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `product` text DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `qty_rec` text DEFAULT NULL,
  `item_serial` text NULL,
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` text DEFAULT NULL,
  `cash_rate` text DEFAULT NULL,
  `inst_rate` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `trans_parent_id` int(11) DEFAULT NULL,
  `transfer` int(11) NOT NULL DEFAULT 0,
  `iemi` int(11) NOT NULL DEFAULT 0,
  `recieved` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_return`
--

CREATE TABLE `tbl_purchase_return` (
  `purchase_return_id` int(11) NOT NULL,
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
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_return_detail`
--

CREATE TABLE `tbl_purchase_return_detail` (
  `id` int(11) NOT NULL,
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
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary`
--

CREATE TABLE `tbl_salary` (
  `id` int(11) NOT NULL,
  `staff_mem_id` int(11) DEFAULT NULL,
  `staff_mem_salary` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale`
--

CREATE TABLE `tbl_sale` (
  `sale_id` int(11) NOT NULL,
  `location` int(11) DEFAULT NULL,
  `iemi` int(11) NOT NULL DEFAULT 0,
  `local` int(11) NOT NULL DEFAULT 0,
  `pos` int(11) NOT NULL DEFAULT 0,
  `sale_type` varchar(255) DEFAULT NULL,
  `table_id` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `sales_men` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `new_name` text DEFAULT NULL,
  `sale_status` text DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `customer_cnic` text DEFAULT NULL,
  `customer_email` text DEFAULT NULL,
  `net_amount` text DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `gross_amount` text DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `fixed_discount` text NULL,
  `amount_recieved` text DEFAULT NULL,
  `amount_remaining` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salesmen`
--

CREATE TABLE `tbl_salesmen` (
  `s_id` int(11) NOT NULL,
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
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale_detail`
--

CREATE TABLE `tbl_sale_detail` (
  `id` int(11) NOT NULL,
  `sale_id` int(255) NOT NULL,
  `invoice_no` text DEFAULT NULL,
  `product` text DEFAULT NULL,
  `item_serial` text NULL,
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` text NULL,
  `qty` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `amount` text NOT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `local` int(11) NOT NULL DEFAULT 0,
  `returned` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale_return`
--

CREATE TABLE `tbl_sale_return` (
  `sale_return_id` int(11) NOT NULL,
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
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale_return_detail`
--

CREATE TABLE `tbl_sale_return_detail` (
  `id` int(11) NOT NULL,
  `iemi` int(11) NOT NULL DEFAULT 0,
  `sale_id` int(11) DEFAULT NULL,
  `sale_return_id` int(11) DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `product` text DEFAULT NULL,
  `item_serial` text NULL,
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` text NULL,
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
  `local` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale_temp`
--

CREATE TABLE `tbl_sale_temp` (
  `temp_id` int(11) NOT NULL,
  `ref_id` text DEFAULT NULL,
  `customer` text DEFAULT NULL,
  `sales_men` text DEFAULT NULL,
  `item_id` text DEFAULT NULL,
  `barcode` text DEFAULT NULL,
  `item_serial` text NULL,
  `pur_item_id` text DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `sale_rate` text DEFAULT NULL,
  `amount` text NOT NULL,
  `stock` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_single_purchase`
--

CREATE TABLE `tbl_single_purchase` (
  `purchase_id` int(11) NOT NULL,
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
  `payment_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_single_purchase_detail`
--

CREATE TABLE `tbl_single_purchase_detail` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `invoice_no` text NOT NULL,
  `product` text NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_rec` int(11) DEFAULT NULL,
  `item_serial` text NULL,
  `pur_item_id` varchar(50) NOT NULL DEFAULT '0',
  `barcode` text NULL,
  `rate` float NOT NULL,
  `amount` float NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `iemi` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_cat`
--

CREATE TABLE `tbl_sub_cat` (
  `id` int(11) NOT NULL,
  `cat_name` text DEFAULT NULL,
  `sub_cat_name` text DEFAULT NULL,
  `brand_id` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_sub_cat`
--

INSERT INTO `tbl_sub_cat` (`id`, `cat_name`, `sub_cat_name`, `brand_id`, `created_by`, `created_date`) VALUES
(1, '6', 'abc', '12', 1, '2025-01-28'),
(2, '6', 'def', '12', 1, '2025-01-28'),
(3, '8', 'xyz', '12', 1, '2025-01-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tables`
--

CREATE TABLE `tbl_tables` (
  `table_id` int(11) NOT NULL,
  `table_name` text DEFAULT NULL,
  `table_status` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_tables`
--

INSERT INTO `tbl_tables` (`table_id`, `table_name`, `table_status`, `created_by`, `created_date`) VALUES
(1, 'Table No. 1', 0, 1, '2025-01-28'),
(2, 'Table No. 2', 0, 1, '2025-01-28'),
(3, 'Table No. 3', 0, 1, '2025-01-28'),
(4, 'Table No. 5', 0, 1, '2025-01-28'),
(5, 'Table No. 6', 0, 1, '2025-01-28'),
(6, 'Table No. 4', 0, 1, '2025-01-28'),
(7, 'Table No. 7', 0, 1, '2025-01-28'),
(8, 'Table No. 8', 0, 1, '2025-01-28'),
(9, 'Table No. 9', 0, 1, '2025-01-28'),
(10, 'Table No. 10', 0, 1, '2025-01-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `task_id` int(11) NOT NULL,
  `task_name` text NOT NULL,
  `task_description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans`
--

CREATE TABLE `tbl_trans` (
  `trans_id` int(11) NOT NULL,
  `vendor_id` text DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `account_id` text DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `narration` text DEFAULT NULL,
  `total_amount` text DEFAULT NULL,
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
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans_detail`
--

CREATE TABLE `tbl_trans_detail` (
  `trans_detail_id` int(11) NOT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `acode` text DEFAULT NULL,
  `d_amount` text DEFAULT NULL,
  `c_amount` text DEFAULT NULL,
  `bill_status` text DEFAULT NULL,
  `narration` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendors`
--

CREATE TABLE `tbl_vendors` (
  `v_id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `username` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `mobile_no` text DEFAULT NULL,
  `user_profile` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voucher`
--

CREATE TABLE `tbl_voucher` (
  `trans_id` int(11) NOT NULL,
  `account_id` text DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `narration` text DEFAULT NULL,
  `bank_id` text DEFAULT NULL,
  `check_no` text DEFAULT NULL,
  `total_amount` text DEFAULT NULL,
  `v_type` text DEFAULT NULL,
  `bill_status` text DEFAULT NULL,
  `payment_method` text DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voucher_detail`
--

CREATE TABLE `tbl_voucher_detail` (
  `trans_detail_id` int(11) NOT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `acode` text DEFAULT NULL,
  `d_amount` text DEFAULT NULL,
  `c_amount` text DEFAULT NULL,
  `narration` text DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_zone`
--

CREATE TABLE `tbl_zone` (
  `zone_id` int(11) NOT NULL,
  `zone_name` text NOT NULL,
  `parent_zone_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
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
  `dashboard` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `branch_id`, `user_name`, `user_email`, `user_password`, `user_privilege`, `user_country`, `user_state`, `user_city`, `user_address`, `user_phone`, `user_birthday`, `user_gender`, `user_profile`, `contact_no`, `created_date`, `created_by`, `permission`, `c_read`, `c_write`, `c_delete`, `s_read`, `s_write`, `s_delete`, `p_read`, `p_write`, `p_delete`, `a_read`, `a_write`, `a_delete`, `dashboard`) VALUES
(1, '', 'Head Office', 'alitownsnooker@logix199.com', '$2y$10$Ap3pYbxNbOzsdH5L/pzi0.g0L9VdS/hWLmqT8aBKNl.cKK6XqLXym', 'superadmin', 'PK', 'islamabad', 'islamabad', 'Address  Plot No -33 Riaz Business Center  Business Park Gulburg Greens Gulbarg Islamabad  Pakistan', '03067990000', '1980-02-03', 'male', 'uploads/Profiles/13576482481625145883.jpg', '', '2021-07-01', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_account_lv2`
--
ALTER TABLE `tbl_account_lv2`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_acode`
--
ALTER TABLE `tbl_acode`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_attendence`
--
ALTER TABLE `tbl_attendence`
  ADD PRIMARY KEY (`att_id`) USING BTREE;

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_bonus`
--
ALTER TABLE `tbl_bonus`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_branch_target`
--
ALTER TABLE `tbl_branch_target`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_cat`
--
ALTER TABLE `tbl_cat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_catagory`
--
ALTER TABLE `tbl_catagory`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_client_type`
--
ALTER TABLE `tbl_client_type`
  ADD PRIMARY KEY (`type_id`) USING BTREE;

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`comp_id`) USING BTREE;

--
-- Indexes for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  ADD PRIMARY KEY (`contact_id`) USING BTREE;

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`c_id`) USING BTREE,
  ADD KEY `customer_id` (`customer_id`) USING BTREE;

--
-- Indexes for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  ADD PRIMARY KEY (`designation_id`) USING BTREE;

--
-- Indexes for table `tbl_emp_leave`
--
ALTER TABLE `tbl_emp_leave`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_grn_documents`
--
ALTER TABLE `tbl_grn_documents`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_head`
--
ALTER TABLE `tbl_head`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_installment`
--
ALTER TABLE `tbl_installment`
  ADD PRIMARY KEY (`plan_id`) USING BTREE;

--
-- Indexes for table `tbl_installment_payment`
--
ALTER TABLE `tbl_installment_payment`
  ADD PRIMARY KEY (`payment_id`) USING BTREE;

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `item_id` (`item_id`) USING BTREE;

--
-- Indexes for table `tbl_item_price`
--
ALTER TABLE `tbl_item_price`
  ADD PRIMARY KEY (`item_price_id`) USING BTREE;

--
-- Indexes for table `tbl_jv`
--
ALTER TABLE `tbl_jv`
  ADD PRIMARY KEY (`jv_id`) USING BTREE;

--
-- Indexes for table `tbl_local_purchase`
--
ALTER TABLE `tbl_local_purchase`
  ADD PRIMARY KEY (`local_id`) USING BTREE;

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`page_id`) USING BTREE;

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`message_id`) USING BTREE;

--
-- Indexes for table `tbl_message_main`
--
ALTER TABLE `tbl_message_main`
  ADD PRIMARY KEY (`message_id`) USING BTREE;

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_period`
--
ALTER TABLE `tbl_period`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `W` (`W`,`R`,`D`,`U`) USING BTREE;

--
-- Indexes for table `tbl_plan_notes`
--
ALTER TABLE `tbl_plan_notes`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`purchase_id`) USING BTREE;

--
-- Indexes for table `tbl_purchase_detail`
--
ALTER TABLE `tbl_purchase_detail`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `pur_item_id` (`pur_item_id`) USING BTREE,
  ADD KEY `product` (`product`) USING BTREE,
  ADD KEY `barcode` (`barcode`) USING BTREE,
  ADD KEY `barcode_2` (`barcode`) USING BTREE;

--
-- Indexes for table `tbl_purchase_req`
--
ALTER TABLE `tbl_purchase_req`
  ADD PRIMARY KEY (`purchase_req_id`) USING BTREE;

--
-- Indexes for table `tbl_purchase_req_detail`
--
ALTER TABLE `tbl_purchase_req_detail`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_purchase_return`
--
ALTER TABLE `tbl_purchase_return`
  ADD PRIMARY KEY (`purchase_return_id`) USING BTREE;

--
-- Indexes for table `tbl_purchase_return_detail`
--
ALTER TABLE `tbl_purchase_return_detail`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_salary`
--
ALTER TABLE `tbl_salary`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  ADD PRIMARY KEY (`sale_id`) USING BTREE,
  ADD KEY `sale_id` (`sale_id`) USING BTREE,
  ADD KEY `sale_id_2` (`sale_id`) USING BTREE;

--
-- Indexes for table `tbl_salesmen`
--
ALTER TABLE `tbl_salesmen`
  ADD PRIMARY KEY (`s_id`) USING BTREE;

--
-- Indexes for table `tbl_sale_detail`
--
ALTER TABLE `tbl_sale_detail`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `sale_id` (`sale_id`) USING BTREE,
  ADD KEY `sale_id_2` (`sale_id`) USING BTREE;

--
-- Indexes for table `tbl_sale_return`
--
ALTER TABLE `tbl_sale_return`
  ADD PRIMARY KEY (`sale_return_id`) USING BTREE;

--
-- Indexes for table `tbl_sale_return_detail`
--
ALTER TABLE `tbl_sale_return_detail`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_sale_temp`
--
ALTER TABLE `tbl_sale_temp`
  ADD PRIMARY KEY (`temp_id`) USING BTREE;

--
-- Indexes for table `tbl_single_purchase`
--
ALTER TABLE `tbl_single_purchase`
  ADD PRIMARY KEY (`purchase_id`) USING BTREE;

--
-- Indexes for table `tbl_single_purchase_detail`
--
ALTER TABLE `tbl_single_purchase_detail`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `pur_item_id` (`pur_item_id`) USING BTREE;

--
-- Indexes for table `tbl_sub_cat`
--
ALTER TABLE `tbl_sub_cat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_tables`
--
ALTER TABLE `tbl_tables`
  ADD PRIMARY KEY (`table_id`) USING BTREE;

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`task_id`) USING BTREE;

--
-- Indexes for table `tbl_trans`
--
ALTER TABLE `tbl_trans`
  ADD PRIMARY KEY (`trans_id`) USING BTREE;

--
-- Indexes for table `tbl_trans_detail`
--
ALTER TABLE `tbl_trans_detail`
  ADD PRIMARY KEY (`trans_detail_id`) USING BTREE;

--
-- Indexes for table `tbl_vendors`
--
ALTER TABLE `tbl_vendors`
  ADD PRIMARY KEY (`v_id`) USING BTREE;

--
-- Indexes for table `tbl_voucher`
--
ALTER TABLE `tbl_voucher`
  ADD PRIMARY KEY (`trans_id`) USING BTREE;

--
-- Indexes for table `tbl_voucher_detail`
--
ALTER TABLE `tbl_voucher_detail`
  ADD PRIMARY KEY (`trans_detail_id`) USING BTREE;

--
-- Indexes for table `tbl_zone`
--
ALTER TABLE `tbl_zone`
  ADD PRIMARY KEY (`zone_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_account_lv2`
--
ALTER TABLE `tbl_account_lv2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_acode`
--
ALTER TABLE `tbl_acode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_attendence`
--
ALTER TABLE `tbl_attendence`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bonus`
--
ALTER TABLE `tbl_bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_branch_target`
--
ALTER TABLE `tbl_branch_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cat`
--
ALTER TABLE `tbl_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_catagory`
--
ALTER TABLE `tbl_catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_client_type`
--
ALTER TABLE `tbl_client_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_emp_leave`
--
ALTER TABLE `tbl_emp_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_grn_documents`
--
ALTER TABLE `tbl_grn_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_head`
--
ALTER TABLE `tbl_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_installment`
--
ALTER TABLE `tbl_installment`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_installment_payment`
--
ALTER TABLE `tbl_installment_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_item_price`
--
ALTER TABLE `tbl_item_price`
  MODIFY `item_price_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_jv`
--
ALTER TABLE `tbl_jv`
  MODIFY `jv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_local_purchase`
--
ALTER TABLE `tbl_local_purchase`
  MODIFY `local_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_message_main`
--
ALTER TABLE `tbl_message_main`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_period`
--
ALTER TABLE `tbl_period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8847;

--
-- AUTO_INCREMENT for table `tbl_plan_notes`
--
ALTER TABLE `tbl_plan_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_detail`
--
ALTER TABLE `tbl_purchase_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_req`
--
ALTER TABLE `tbl_purchase_req`
  MODIFY `purchase_req_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_req_detail`
--
ALTER TABLE `tbl_purchase_req_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_return`
--
ALTER TABLE `tbl_purchase_return`
  MODIFY `purchase_return_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_return_detail`
--
ALTER TABLE `tbl_purchase_return_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_salary`
--
ALTER TABLE `tbl_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_salesmen`
--
ALTER TABLE `tbl_salesmen`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sale_detail`
--
ALTER TABLE `tbl_sale_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sale_return`
--
ALTER TABLE `tbl_sale_return`
  MODIFY `sale_return_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sale_return_detail`
--
ALTER TABLE `tbl_sale_return_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sale_temp`
--
ALTER TABLE `tbl_sale_temp`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_single_purchase`
--
ALTER TABLE `tbl_single_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_single_purchase_detail`
--
ALTER TABLE `tbl_single_purchase_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sub_cat`
--
ALTER TABLE `tbl_sub_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_tables`
--
ALTER TABLE `tbl_tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trans`
--
ALTER TABLE `tbl_trans`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trans_detail`
--
ALTER TABLE `tbl_trans_detail`
  MODIFY `trans_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_vendors`
--
ALTER TABLE `tbl_vendors`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_voucher`
--
ALTER TABLE `tbl_voucher`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_voucher_detail`
--
ALTER TABLE `tbl_voucher_detail`
  MODIFY `trans_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_zone`
--
ALTER TABLE `tbl_zone`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
