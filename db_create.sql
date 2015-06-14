-- 创建数据库
CREATE SCHEMA `sogou_wechat` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
-- 创建数据结果数据表
CREATE TABLE `sogou_wechat`.`result_1` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL COMMENT '标题',
  `content` TEXT NOT NULL COMMENT '内容概述',
  `from` VARCHAR(45) NOT NULL COMMENT '来源',
  `time` VARCHAR(45) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`));
-- 创建任务管理数据表
CREATE TABLE `sogou_wechat`.`task` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `total` INT UNSIGNED NOT NULL COMMENT '总共记录数',
  `keyword` VARCHAR(45) NOT NULL COMMENT '搜索关键字',
  `page` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '完成的页数，初始为0',
  `count` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '已抓取的数目，初始为0',
  `state` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否完成，0未完成，1完成',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));


