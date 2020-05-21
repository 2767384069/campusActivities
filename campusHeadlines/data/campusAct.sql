DROP DATABASE IF EXISTS campusAct;
CREATE DATABASE campusAct charset utf8;
USE campusAct;

DROP TABLE IF EXISTS act_admin;
CREATE TABLE act_admin(
id smallint unsigned auto_increment key comment '自增ID',
adminName varchar(20) not null unique comment '管理员名称',
password char(32) not null comment '密码',
email varchar(50) not null comment '邮箱',
isSuper tinyint(1) default '0' comment '是否是超级管理员：0-不是 1-是'
)ENGINE=InnoDB COMMENT='管理员表';


DROP TABLE IF EXISTS campus_act;
CREATE TABLE campus_act(
id int unsigned auto_increment key comment '自增ID',
title varchar(255) not null unique comment '标题',
labelImg varchar(255) not null comment '标签图',
content text comment '内容',
cName varchar(50) comment '分类名称',
pubName varchar(255) not null comment '发布方',
adminName varchar(255) not null comment '发布者姓名',
pubTime int unsigned not null comment '发布时间',
readNum int unsigned default 0 comment '浏览量',
praiseNum int unsigned default 0 comment '点赞量'
) ENGINE=InnoDB COMMENT='活动表';

DROP TABLE IF EXISTS act_user;
CREATE TABLE act_user(
id int unsigned auto_increment key comment '自增ID',
userName varchar(20) not null unique comment '用户名',
password char(32) not null comment '密码',
sex enum('男','女','保密') not null default '保密' comment '性别'
) ENGINE=InnoDB COMMENT='用户表';

DROP TABLE IF EXISTS act_rev;
CREATE TABLE act_rev(
id int unsigned auto_increment key comment '自增ID',
revContent text not null comment '评论内容',
actId int(11) not null comment '被评论活动id',
revName varchar(255) not null comment '评论用户姓名',
pubTime int unsigned not null comment '发布时间',
praiseNum int unsigned default 0 comment '点赞量'
) ENGINE=InnoDB COMMENT='评论表';

DROP TABLE IF EXISTS act_apply;
CREATE TABLE act_apply(
id int unsigned auto_increment key comment '自增ID',
university varchar(255) not null comment '学校名称',
applyImg varchar(255) not null comment '图片',
cause text comment '申请原因',
userName varchar(255) not null comment '用户姓名',
applyTime int unsigned not null comment '申请时间'
) ENGINE=InnoDB COMMENT='申请表';
