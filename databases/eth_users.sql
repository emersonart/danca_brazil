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

 Date: 10/10/2020 15:32:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eth_users
-- ----------------------------
DROP TABLE IF EXISTS `eth_users`;
CREATE TABLE `eth_users`  (
  `use_id` int(11) NOT NULL AUTO_INCREMENT,
  `use_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `use_nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `use_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `use_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `use_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `use_avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `use_per_id` int(11) NOT NULL DEFAULT 2,
  `use_stu_id` int(11) NOT NULL DEFAULT 1,
  `use_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `use_deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`use_id`) USING BTREE,
  INDEX `FK_permision`(`use_per_id`) USING BTREE,
  INDEX `FK_status`(`use_stu_id`) USING BTREE,
  CONSTRAINT `FK_permision` FOREIGN KEY (`use_per_id`) REFERENCES `eth_permissions` (`per_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_status` FOREIGN KEY (`use_stu_id`) REFERENCES `eth_user_status` (`stu_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_users
-- ----------------------------
INSERT INTO `eth_users` VALUES (1, '2020-03-21 12:19:53', 'adminemerson', 'Emerson Bruno', 'ethernalcreativeid@outlook.com', '$2y$10$Ybap5889KBTiWOgSu5N/ouENmYOxrImUDWUXZdeHHGjGqAKdO2Wsa', NULL, 2, 1, NULL, NULL);
INSERT INTO `eth_users` VALUES (2, '2020-09-03 22:32:50', 'adminteste', 'teste 2', 'teste@teste.com', '$2y$10$LO3gaUEDbUxfZ4kyn9pB.ecnPooK8m0lFiKuzriAJUV6QFAUhTnh6', 'c26630cfef887ca506efa4b57ccbaa6f.jpeg', 1, 1, '2020-09-03 22:50:28', NULL);

SET FOREIGN_KEY_CHECKS = 1;
