-- Table uses for storing influencer general information
CREATE TABLE `m001influencer` (
  `f001id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `f001name` varchar(255) NOT NULL,
  `f001phone` varchar(255) NULL,
  `f001birthday` date NOT NULL,
  `f001gender` int NOT NULL COMMENT 'f002gender',
  `f001email` varchar(255) NOT NULL,
  `f001address` varchar(255) NOT NULL,
  `f001interaction_average_number` int DEFAULT 0 NOT NULL,
  `f001identification_number` bigint NULL,
  `f001bank_number` bigint NULL,
  `f001flag_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active;0:deactive',
  `f001create_at` datetime NOT NULL,
  `f001update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Table use for gender type
CREATE TABLE `m002gender` (
    `f002id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `f002name` varchar(255) NOT NULL,
    `f002flag_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active;0:deactive',
    `f002create_at` datetime NOT NULL,
    `f002update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Table use for job information 
CREATE TABLE `m003job` (
    `f003id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `f003job_title` varchar(255) NOT NULL,
    `f003job_description` text NULL,
    `f003flag_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active;0:deactive',
    `f003create_at` datetime NOT NULL,
    `f003update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Table use for influencer post
CREATE TABLE `m004post` (
    `f004id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `f004influencer_id` int NOT NULL COMMENT 'f001id',
    `f004post_content` text NULL,
    `f004post_date` datetime NULL,
    `f004flag_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active;0:deactive',
    `f004create_at` datetime NOT NULL,
    `f004update_at` datetime NOT NULL,
    FOREIGN KEY (`f004influencer_id`)
        REFERENCES `m001influencer` (`f001id`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Table use for media type
CREATE TABLE `m005media_type` (
    `f005id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `f005media_name` varchar(255) NOT NULL,
    `f005flag_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active;0:deactive',
    `f005create_at` datetime NOT NULL,
    `f005update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- TABLE use for influencer job connection
CREATE TABLE `m006influencer_job` (
    `f006influencer_id` int NOT NULL COMMENT 'f001id',
    `f006job_id` int NOT NULL COMMENT 'f003id',
    `f006flag_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active;0:deactive',
    `f006create_at` datetime NOT NULL,
    `f006update_at` datetime NOT NULL,
    FOREIGN KEY (`f006influencer_id`)
        REFERENCES `m001influencer` (`f001id`)
        ON DELETE CASCADE,
    FOREIGN KEY (`f006job_id`)
        REFERENCES `m003job` (`f003id`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- TABLE use for influencer media link
CREATE TABLE `m007influencer_media_link` (
    `f007id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `f007influencer_id` int NOT NULL COMMENT 'f001id',
    `f007media_id` int NOT NULL COMMENT 'f005id',
    `f007link` varchar(255) NOT NULL,
    `f007flag_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active;0:deactive',
    `f007create_at` datetime NOT NULL,
    `f007update_at` datetime NOT NULL,
    FOREIGN KEY (`f007influencer_id`)
        REFERENCES `m001influencer` (`f001id`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- TABLE use for facebook account
CREATE TABLE `m008facebook_page`(
    `f008id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `f008facebook_id` int NOT NULL COMMENT 'f007id',
    `f008link` varchar(255) NOT NULL,
    `f008flag_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active;0:deactive',
    `f008create_at` datetime NOT NULL,
    `f008update_at` datetime NOT NULL,
    FOREIGN KEY (`f008facebook_id`)
        REFERENCES `m007influencer_media_link` (`f007id`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `m002gender`(`f002name`) VALUES 
('Male'),('Female'),('Undefined');

INSERT INTO `m005media_type`(`f005media_name`) VALUES
('Facebook'),('Gmail'),('Instagram');
