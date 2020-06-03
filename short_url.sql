



SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for short_url
-- ----------------------------
DROP TABLE IF EXISTS `short_url`;
CREATE TABLE `short_url`  (
  `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '要缩短的url',
  `short` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '生成的url',
  `createtime` int(15) UNSIGNED NOT NULL DEFAULT 0 COMMENT '生成短链时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `url`(`url`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


