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

 Date: 10/10/2020 15:32:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eth_social_medias
-- ----------------------------
DROP TABLE IF EXISTS `eth_social_medias`;
CREATE TABLE `eth_social_medias`  (
  `soc_id` int(11) NOT NULL AUTO_INCREMENT,
  `soc_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `soc_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `soc_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `soc_icon` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `soc_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `soc_deleted_at` datetime(0) NULL DEFAULT NULL,
  `soc_show` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`soc_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_social_medias
-- ----------------------------
INSERT INTO `eth_social_medias` VALUES (1, '2020-03-04 17:52:24', 'Facebook', 'https://www.facebook.com/hennekam', 'fa-facebook-square', '2020-08-25 00:05:53', NULL, 1);
INSERT INTO `eth_social_medias` VALUES (2, '2020-03-04 17:52:40', 'Instagram', 'https://www.instagram.com/hennekamwines', 'fa-instagram-square', '2020-08-25 00:04:23', NULL, 1);
INSERT INTO `eth_social_medias` VALUES (3, '2020-09-25 09:05:58', 'Linkedin', 'https://www.linkedin.com/in/priscilla-hennekam-bb3243123/', 'fa-linkedin', NULL, NULL, 1);

SET FOREIGN_KEY_CHECKS = 1;
