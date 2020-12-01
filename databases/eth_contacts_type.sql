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

 Date: 05/11/2020 20:35:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eth_contacts_type
-- ----------------------------
DROP TABLE IF EXISTS `eth_contacts_type`;
CREATE TABLE `eth_contacts_type`  (
  `cot_id` int(11) NOT NULL AUTO_INCREMENT,
  `cot_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `cot_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cot_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `cot_deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`cot_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_contacts_type
-- ----------------------------
INSERT INTO `eth_contacts_type` VALUES (1, '2020-08-23 15:11:27', 'site', NULL, NULL);
INSERT INTO `eth_contacts_type` VALUES (2, '2020-08-23 15:11:30', 'eventos', NULL, NULL);
INSERT INTO `eth_contacts_type` VALUES (3, '2020-08-23 15:11:34', 'palestras', NULL, NULL);
INSERT INTO `eth_contacts_type` VALUES (4, '2020-08-23 15:11:48', 'cursos', NULL, NULL);
INSERT INTO `eth_contacts_type` VALUES (5, '2020-08-23 15:12:22', 'enoturismo', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
