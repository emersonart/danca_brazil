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

 Date: 10/10/2020 15:32:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eth_user_status
-- ----------------------------
DROP TABLE IF EXISTS `eth_user_status`;
CREATE TABLE `eth_user_status`  (
  `stu_id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `stu_status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `stu_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `stu_deleted_at` datetime(0) NULL DEFAULT NULL,
  `stu_active` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`stu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_user_status
-- ----------------------------
INSERT INTO `eth_user_status` VALUES (1, '2020-03-21 11:08:09', 'Ativo', NULL, NULL, 1);
INSERT INTO `eth_user_status` VALUES (2, '2020-03-21 11:08:20', 'Inativo', NULL, NULL, 0);

SET FOREIGN_KEY_CHECKS = 1;
