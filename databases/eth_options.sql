/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : hennekam

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 10/10/2020 15:32:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eth_options
-- ----------------------------
DROP TABLE IF EXISTS `eth_options`;
CREATE TABLE `eth_options`  (
  `opt_id` int(11) NOT NULL AUTO_INCREMENT,
  `opt_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `opt_option` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `opt_value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `opt_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`opt_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
