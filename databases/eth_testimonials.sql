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

 Date: 10/10/2020 15:38:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eth_testimonials
-- ----------------------------
DROP TABLE IF EXISTS `eth_testimonials`;
CREATE TABLE `eth_testimonials`  (
  `tes_id` int(11) NOT NULL AUTO_INCREMENT,
  `tes_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `tes_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tes_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tes_extra_information` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tes_testimonial_pt_br` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tes_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `tes_deleted_at` datetime(0) NULL DEFAULT NULL,
  `tes_show` int(1) NULL DEFAULT 1,
  `tes_testimonial_en` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`tes_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
