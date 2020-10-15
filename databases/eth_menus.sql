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

 Date: 10/10/2020 15:31:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eth_menus
-- ----------------------------
DROP TABLE IF EXISTS `eth_menus`;
CREATE TABLE `eth_menus`  (
  `men_id` int(11) NOT NULL AUTO_INCREMENT,
  `men_datetime` timestamp(2) NOT NULL DEFAULT current_timestamp(2),
  `men_type_id` int(11) NOT NULL,
  `men_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `men_deleted_at` datetime(0) NULL DEFAULT NULL,
  `men_title_pt_br` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `men_title_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `men_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `men_target` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '_self',
  `men_show` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`men_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_menus
-- ----------------------------
INSERT INTO `eth_menus` VALUES (1, '2020-03-01 15:32:57.26', 1, NULL, NULL, 'Blog', 'News', 'blog', '_self', 1);
INSERT INTO `eth_menus` VALUES (2, '2020-03-01 15:33:19.17', 1, '2020-09-15 20:32:56', NULL, 'Consultoria e palestras', 'Consultancy and Presentation', 'consultoria-e-palestras', '_self', 1);
INSERT INTO `eth_menus` VALUES (3, '2020-03-01 15:33:42.49', 1, '2020-08-17 23:20:52', NULL, 'Cursos online', 'Online courses', 'cursos', '_self', 1);
INSERT INTO `eth_menus` VALUES (4, '2020-03-01 15:33:57.32', 1, '2020-08-17 23:21:19', NULL, 'Enoturismo', 'Wine Tourism', 'enoturismo', '_self', 1);
INSERT INTO `eth_menus` VALUES (5, '2020-03-01 15:34:19.27', 1, NULL, NULL, 'Eventos', 'Events', 'eventos', '_self', 1);
INSERT INTO `eth_menus` VALUES (6, '2020-03-01 15:34:34.45', 1, '2020-08-17 23:21:39', NULL, 'Quem Sou', 'About me', 'quem-sou', '_self', 1);

SET FOREIGN_KEY_CHECKS = 1;
