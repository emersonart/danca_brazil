/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : danca_brazil

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 27/10/2020 20:29:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eth_contacts
-- ----------------------------
DROP TABLE IF EXISTS `eth_contacts`;
CREATE TABLE `eth_contacts`  (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `con_subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `con_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `con_contact` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_message` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_ip_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_city` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_region` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_region_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_country` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_country_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_browser` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_browser_version` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_mobile` int(1) NULL DEFAULT NULL,
  `con_os` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_captcha` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_deleted_at` datetime(0) NULL DEFAULT NULL,
  `con_extra` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`con_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_contacts
-- ----------------------------
INSERT INTO `eth_contacts` VALUES (10, '2020-10-22 01:10:46', 'teste', 'teste', 'teste@teste.com', NULL, 'teste', '127.0.0.1', NULL, NULL, NULL, NULL, NULL, 'Opera', '71.0.3770.287', 0, 'Windows 10', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for eth_courses
-- ----------------------------
DROP TABLE IF EXISTS `eth_courses`;
CREATE TABLE `eth_courses`  (
  `cur_id` int(11) NOT NULL AUTO_INCREMENT,
  `cur_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `cur_title_pt_br` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cur_title_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cur_description_pt_br` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `cur_description_en` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `cur_show` int(1) NULL DEFAULT 1,
  `cur_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `cur_deleted_at` datetime(0) NULL DEFAULT NULL,
  `cur_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`cur_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_courses
-- ----------------------------
INSERT INTO `eth_courses` VALUES (1, '2020-10-26 01:08:27', 'teste 1', 'test 1', 'taeasd as ', ' sdfsdg sdfgsd gsdf', 1, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for eth_items
-- ----------------------------
DROP TABLE IF EXISTS `eth_items`;
CREATE TABLE `eth_items`  (
  `ite_id` int(11) NOT NULL AUTO_INCREMENT,
  `ite_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `ite_title_pt_br` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ite_title_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ite_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `ite_deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ite_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_menus
-- ----------------------------
INSERT INTO `eth_menus` VALUES (2, '2020-03-01 18:33:19.17', 1, '2020-10-14 19:42:45', NULL, 'Horários', 'Schedules', '#horarios', '_self', 1);
INSERT INTO `eth_menus` VALUES (3, '2020-03-01 18:33:42.49', 1, '2020-10-14 19:43:45', NULL, 'Autenticidade', 'Authenticity', '#autenticidade', '_self', 1);
INSERT INTO `eth_menus` VALUES (4, '2020-03-01 18:33:57.32', 1, '2020-10-14 19:44:25', NULL, 'Depoimentos', 'Testimonials', '#depoimentos', '_self', 1);
INSERT INTO `eth_menus` VALUES (5, '2020-03-01 18:34:19.27', 1, '2020-10-14 19:44:55', NULL, 'Aulas', 'Lessons', '#aulas', '_self', 1);
INSERT INTO `eth_menus` VALUES (6, '2020-03-01 18:34:34.45', 1, '2020-10-14 19:45:48', NULL, 'Mídia', 'Media', '#canal', '_self', 1);
INSERT INTO `eth_menus` VALUES (7, '2020-10-14 22:46:23.02', 1, '2020-10-19 21:15:16', NULL, 'Equipe', 'Team', '#team', '_self', 1);
INSERT INTO `eth_menus` VALUES (8, '2020-10-14 22:46:41.65', 1, '2020-10-14 19:46:55', NULL, 'Contato', 'Contact', '#contato', '_self', 1);

-- ----------------------------
-- Table structure for eth_newsletters
-- ----------------------------
DROP TABLE IF EXISTS `eth_newsletters`;
CREATE TABLE `eth_newsletters`  (
  `new_id` int(11) NOT NULL AUTO_INCREMENT,
  `new_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `new_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `new_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `new_contact` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `new_ip_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `new_city` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `new_region` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `new_country` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `new_region_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `new_country_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `new_browser` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `new_browser_version` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `new_mobile` int(1) NULL DEFAULT NULL,
  `new_os` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `new_deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`new_id`, `new_email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for eth_options
-- ----------------------------
DROP TABLE IF EXISTS `eth_options`;
CREATE TABLE `eth_options`  (
  `opt_id` int(11) NOT NULL AUTO_INCREMENT,
  `opt_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `opt_option` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `opt_value` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `opt_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`opt_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_options
-- ----------------------------
INSERT INTO `eth_options` VALUES (1, '2020-10-14 20:37:13', 'site_heading_pt_br', 'Você está prestes a mudar <br><i>seu estilo de vida</i>', '2020-10-14 19:35:22');
INSERT INTO `eth_options` VALUES (2, '2020-10-14 20:37:48', 'site_pre_heading_pt_br', 'PRIMEIRO CURSO DE DANÇA BRASILEIRA DE ADELAIDE', NULL);
INSERT INTO `eth_options` VALUES (3, '2020-10-14 20:38:12', 'button_pre_matricula_pt_br', 'FAÇA SUA PRÉ-MATRÍCULA', NULL);
INSERT INTO `eth_options` VALUES (4, '2020-10-14 20:38:51', 'site_heading_en', 'You are about to change <br><i>your lifestyle</i>', '2020-10-14 19:37:31');
INSERT INTO `eth_options` VALUES (5, '2020-10-14 20:39:25', 'site_pre_heading_en', 'FIRST BRAZILIAN DANCE COURSE BY ADELAIDE', NULL);
INSERT INTO `eth_options` VALUES (6, '2020-10-14 20:40:54', 'site_sharing_love_pt_br', 'Compartilhando o amor pela dança', NULL);
INSERT INTO `eth_options` VALUES (7, '2020-10-14 20:41:01', 'site_sharing_love_en', 'Sharing the love of dance', '2020-10-14 17:41:09');
INSERT INTO `eth_options` VALUES (8, '2020-10-14 20:42:05', 'site_sharing_love_desc_pt_br', '<p>Além de ensinar os fundamentos do Samba - uma dança de muita energia, vista no carnaval nas ruas do Rio de Janeiro a cada ano - Dança Brasil tem um autêntico programa de ensino, divertido e com coreografias profissionais em estilos como Machado, Samba Reggae, Lambada, Afoxe \'Afro, Maculele\', Rio Samba no Pé e Samba estilo Passista.</p><p>\r\rNossa equipe é extremamente versátil e foi convidada a se apresentar e ensinar por toda a Austrália em festivais, congressos e competições. Nosso grupo se apresenta regularmente em funções corporativas, festivais, noites de premiação, inaugurações, casamentos, aniversários, lançamentos de produtos, eventos universitários, noites de despedida de solteiro, eventos de caridade, festas privadas e muito mais!</p>', '2020-10-14 19:55:16');
INSERT INTO `eth_options` VALUES (9, '2020-10-14 20:45:55', 'site_sharing_love_desc_en', '<p> In addition to teaching the fundamentals of Samba - a dance of great energy, seen at the carnival in the streets of Rio de Janeiro every year - Dança Brasil has an authentic teaching program, fun and with professional choreography in styles like Machado, Samba Reggae, Lambada, Afoxe \'Afro, Maculele\', Rio Samba no Pé and Passista style Samba. </p> <p>\r\n\r\nOur team is extremely versatile and has been invited to perform and teach across Australia at festivals, congresses and competitions. Our group regularly performs at corporate functions, festivals, awards nights, inaugurations, weddings, birthdays, product launches, university events, bachelor party nights, charity events, private parties and more! </p>', '2020-10-14 19:55:21');
INSERT INTO `eth_options` VALUES (10, '2020-10-14 20:47:10', 'site_online_classes_pt_br', 'Aulas online disponíveis', NULL);
INSERT INTO `eth_options` VALUES (11, '2020-10-14 20:47:20', 'site_online_classes_en', 'Online classes available', '2020-10-14 17:47:29');
INSERT INTO `eth_options` VALUES (12, '2020-10-14 20:49:15', 'site_online_classes_desc_pt_br', '<p>Devido aos regulamentos do COVID19, todas as nossas aulas são atualmente oferecidas apenas ONLINE.<br/>Estamos oferecendo aulas particulares individuais para um ou 2 alunos ao mesmo tempo.</p>', NULL);
INSERT INTO `eth_options` VALUES (13, '2020-10-14 20:49:39', 'site_online_classes_desc_en', '<p> Due to COVID19 regulations, all of our classes are currently offered ONLINE ONLY. <br/> We are offering individual private lessons for one or 2 students at the same time. </p>', NULL);
INSERT INTO `eth_options` VALUES (14, '2020-10-14 20:50:15', 'button_pre_matricula_en', 'MAKE YOUR PRE-ENROLLMENT', '2020-10-14 17:50:25');
INSERT INTO `eth_options` VALUES (15, '2020-10-14 20:51:21', 'button_see_classes_pt_br', 'VEJA NOSSAS AULAS ONLINE', NULL);
INSERT INTO `eth_options` VALUES (16, '2020-10-14 20:51:30', 'button_see_classes_en', 'SEE OUR ONLINE CLASSES', NULL);
INSERT INTO `eth_options` VALUES (17, '2020-10-14 20:52:38', 'site_heading_videos_pt_br', 'O maior canal de dança brasileira na Austrália!', NULL);
INSERT INTO `eth_options` VALUES (18, '2020-10-14 20:52:48', 'site_heading_videos_en', 'The largest Brazilian dance channel in Australia!', NULL);
INSERT INTO `eth_options` VALUES (19, '2020-10-19 23:12:33', 'site_heading_videos_desc_pt_br', 'Inscreva-se e veja nossos vídeos no Youtube', '2020-10-19 20:13:23');
INSERT INTO `eth_options` VALUES (20, '2020-10-19 23:12:58', 'site_heading_videos_desc_en', 'Subscribe and see ours videos on Youtube', '2020-10-19 20:13:26');
INSERT INTO `eth_options` VALUES (21, '2020-10-22 00:45:35', 'site_heading_contact_pt_br', 'Informações para contato', NULL);
INSERT INTO `eth_options` VALUES (22, '2020-10-22 00:45:51', 'site_heading_contact_en', 'Contact Info', NULL);
INSERT INTO `eth_options` VALUES (23, '2020-10-22 00:46:14', 'site_desc_contact_pt_br', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elementum urna elit, sagittis bibendum turpis feugiat quis. Morbi mollis vel lectus nec dictum.', '2020-10-21 21:46:25');
INSERT INTO `eth_options` VALUES (24, '2020-10-22 00:46:21', 'site_desc_contact_en', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elementum urna elit, sagittis bibendum turpis feugiat quis. Morbi mollis vel lectus nec dictum.', '2020-10-21 21:46:31');
INSERT INTO `eth_options` VALUES (25, '2020-10-22 00:48:38', 'site_email', 'info@example.com', NULL);
INSERT INTO `eth_options` VALUES (26, '2020-10-22 00:48:56', 'site_address', '10111 Santa Monica Boulevard, LA', NULL);
INSERT INTO `eth_options` VALUES (27, '2020-10-22 00:49:09', 'site_phone', '+44 987 065 908', NULL);
INSERT INTO `eth_options` VALUES (28, '2020-10-22 00:49:22', 'site_fax', '+44 987 065 909', NULL);
INSERT INTO `eth_options` VALUES (29, '2020-10-27 22:52:18', 'site_btn_link_contrate', '#', NULL);
INSERT INTO `eth_options` VALUES (30, '2020-10-27 22:52:25', 'site_btn_link_orcamento', '#', NULL);
INSERT INTO `eth_options` VALUES (31, '2020-10-27 22:52:41', 'site_btn_link_classes', '#', NULL);

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
INSERT INTO `eth_permissions` VALUES (1, '2020-03-04 22:40:49', 'Administrator', NULL, NULL);
INSERT INTO `eth_permissions` VALUES (2, '2020-03-04 22:41:25', 'Editor', NULL, NULL);
INSERT INTO `eth_permissions` VALUES (3, '2020-03-04 22:41:50', 'Common', NULL, NULL);

-- ----------------------------
-- Table structure for eth_schedules
-- ----------------------------
DROP TABLE IF EXISTS `eth_schedules`;
CREATE TABLE `eth_schedules`  (
  `sch_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `sch_title_pt_br` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sch_title_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sch_day_pt_br` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sch_day_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sch_hour` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sch_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sch_show` int(1) NOT NULL DEFAULT 1,
  `sch_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `sch_deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`sch_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_schedules
-- ----------------------------
INSERT INTO `eth_schedules` VALUES (1, '2020-10-26 01:08:12', 'teste 1', 'test 1', 'Domingo', 'Sunday', '15:00 PM', 'domingo_1_teste', 1, NULL, NULL);

-- ----------------------------
-- Table structure for eth_schedules_courses
-- ----------------------------
DROP TABLE IF EXISTS `eth_schedules_courses`;
CREATE TABLE `eth_schedules_courses`  (
  `scr_id` int(11) NOT NULL AUTO_INCREMENT,
  `scr_datetime` timestamp(0) NULL DEFAULT current_timestamp(0),
  `scr_sch_id` int(11) NOT NULL,
  `scr_cur_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`scr_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_schedules_courses
-- ----------------------------
INSERT INTO `eth_schedules_courses` VALUES (1, '2020-10-26 01:07:35', 1, 1);

-- ----------------------------
-- Table structure for eth_services
-- ----------------------------
DROP TABLE IF EXISTS `eth_services`;
CREATE TABLE `eth_services`  (
  `ser_id` int(11) NOT NULL AUTO_INCREMENT,
  `ser_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `ser_title_pt_br` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `ser_title_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `ser_show` int(11) NOT NULL DEFAULT 1,
  `ser_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `ser_deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ser_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_services
-- ----------------------------
INSERT INTO `eth_services` VALUES (1, '2020-10-23 22:36:44', 'Dançarinos, Bateristas e Modelos para \"atender e cumprimentar\" convidados', 'Dancers, Drummers and Models to \"meet and greet\" guests', 1, NULL, NULL);
INSERT INTO `eth_services` VALUES (2, '2020-10-23 22:37:20', 'Jogadores de futebol freestyle realizando manobras', 'Freestyle football players performing tricks', 1, NULL, NULL);
INSERT INTO `eth_services` VALUES (3, '2020-10-23 22:37:50', 'Músicos acústicos', 'Acoustic musicians', 1, NULL, NULL);
INSERT INTO `eth_services` VALUES (4, '2020-10-23 22:38:11', 'Cantores', 'Singers', 1, NULL, NULL);
INSERT INTO `eth_services` VALUES (5, '2020-10-23 22:38:32', 'Artistas Itinerantes', 'Itinerant Artists', 1, NULL, NULL);
INSERT INTO `eth_services` VALUES (6, '2020-10-23 22:38:57', 'Bandas brasileiras ao vivo', 'Brazilian bands live', 1, NULL, NULL);
INSERT INTO `eth_services` VALUES (7, '2020-10-23 22:39:13', 'Percussionistas', 'Percussionists', 1, NULL, NULL);
INSERT INTO `eth_services` VALUES (8, '2020-10-23 22:39:20', 'Djs', 'Djs', 1, NULL, NULL);
INSERT INTO `eth_services` VALUES (9, '2020-10-23 22:39:27', 'Mc\'s', 'Mcs', 1, NULL, NULL);

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
INSERT INTO `eth_social_medias` VALUES (1, '2020-03-04 20:52:24', 'Facebook', '#', 'fa-facebook-f', '2020-10-23 18:56:13', NULL, 1);
INSERT INTO `eth_social_medias` VALUES (2, '2020-03-04 20:52:40', 'Instagram', '#', 'fa-instagram', '2020-10-23 18:56:11', NULL, 1);
INSERT INTO `eth_social_medias` VALUES (3, '2020-09-25 12:05:58', 'Twitter', '#', 'fa-twitter', '2020-10-23 18:56:09', NULL, 1);

-- ----------------------------
-- Table structure for eth_team
-- ----------------------------
DROP TABLE IF EXISTS `eth_team`;
CREATE TABLE `eth_team`  (
  `tea_id` int(11) NOT NULL AUTO_INCREMENT,
  `tea_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `tea_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tea_description_pt_br` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `tea_description_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `tea_show` int(11) NOT NULL DEFAULT 1,
  `tea_social` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tea_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tea_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tea_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `tea_deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`tea_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_team
-- ----------------------------
INSERT INTO `eth_team` VALUES (1, '2020-10-20 00:19:04', 'Emerson Bruno', 'teste sdfg dgh hdfg hdgg hd hdgh df ghe df', 'test', 1, NULL, 'photo01.jpg', '', '2020-10-23 19:23:01', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_testimonials
-- ----------------------------
INSERT INTO `eth_testimonials` VALUES (7, '2020-10-19 22:19:20', 'angela faith mccrystal', '', '', '', '2020-10-19 19:33:29', NULL, 1, 'Thank you, Silvi - I love working with yout! You inspire me a dancer,\rinstructor & business woman in out crazy dance industry!');
INSERT INTO `eth_testimonials` VALUES (8, '2020-10-19 22:19:20', 'angela faith mccrystal', '', '', '', '2020-10-19 19:33:29', NULL, 1, 'Thank you, Silvi - I love working with yout! You inspire me a dancer,\rinstructor & business woman in out crazy dance industry!');
INSERT INTO `eth_testimonials` VALUES (9, '2020-10-25 18:17:37', 'teste', '', NULL, 'asdasdas', NULL, NULL, 1, 'asdad');

-- ----------------------------
-- Table structure for eth_testimonials_type
-- ----------------------------
DROP TABLE IF EXISTS `eth_testimonials_type`;
CREATE TABLE `eth_testimonials_type`  (
  `tet_id` int(11) NOT NULL AUTO_INCREMENT,
  `tet_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `tet_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tet_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `tet_deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`tet_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_testimonials_type
-- ----------------------------
INSERT INTO `eth_testimonials_type` VALUES (1, '2020-10-10 18:41:07', 'Sem imagem', NULL, NULL);
INSERT INTO `eth_testimonials_type` VALUES (2, '2020-10-10 18:41:11', 'Com imagem', NULL, NULL);

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
INSERT INTO `eth_user_status` VALUES (1, '2020-03-21 14:08:09', 'Ativo', NULL, NULL, 1);
INSERT INTO `eth_user_status` VALUES (2, '2020-03-21 14:08:20', 'Inativo', NULL, NULL, 0);

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
INSERT INTO `eth_users` VALUES (1, '2020-03-21 15:19:53', 'adminemerson', 'Emerson Bruno', 'ethernalcreativeid@outlook.com', '$2y$10$Ybap5889KBTiWOgSu5N/ouENmYOxrImUDWUXZdeHHGjGqAKdO2Wsa', NULL, 2, 1, NULL, NULL);
INSERT INTO `eth_users` VALUES (2, '2020-09-04 01:32:50', 'adminteste', 'teste 2', 'teste@teste.com', '$2y$10$LO3gaUEDbUxfZ4kyn9pB.ecnPooK8m0lFiKuzriAJUV6QFAUhTnh6', 'c26630cfef887ca506efa4b57ccbaa6f.jpeg', 1, 1, '2020-09-03 22:50:28', NULL);

-- ----------------------------
-- Table structure for eth_videos
-- ----------------------------
DROP TABLE IF EXISTS `eth_videos`;
CREATE TABLE `eth_videos`  (
  `vid_id` int(11) NOT NULL AUTO_INCREMENT,
  `vid_datetime` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `vid_title_pt_br` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vid_title_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `vid_description_pt_br` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vid_description_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `vid_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vid_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `vid_show` int(1) NOT NULL DEFAULT 1,
  `vid_updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `vid_deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`vid_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eth_videos
-- ----------------------------
INSERT INTO `eth_videos` VALUES (1, '2020-10-19 23:35:25', 'teste', 'test', 'teste', 'test', 'https://www.youtube.com/watch?v=2VupLY7s6tw', NULL, 1, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
