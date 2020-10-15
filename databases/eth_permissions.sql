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

 Date: 10/10/2020 15:32:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eth_permissions
-- ----------------------------
DROP TABLE IF EXISTS `eth_permissions`;
CREATE TABLE `eth_permissions`  (
  `per_id` int(11) NOT NULL AUTO_INCREMENT,
  `per_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `per_permission` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `per_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `per_deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`per_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_permissions
-- ----------------------------
INSERT INTO `eth_permissions` VALUES (1, '2020-03-04 19:40:49', 'Administrator', NULL, NULL);
INSERT INTO `eth_permissions` VALUES (2, '2020-03-04 19:41:25', 'Editor', NULL, NULL);
INSERT INTO `eth_permissions` VALUES (3, '2020-03-04 19:41:50', 'Common', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
