-- TRUNCATE
TRUNCATE TABLE `event_artiste`;
TRUNCATE TABLE `event_date`;
TRUNCATE TABLE `event_group_related`;
TRUNCATE TABLE `event_hour`;
TRUNCATE TABLE `event_media`;
TRUNCATE TABLE `event_organisateur`;
TRUNCATE TABLE `event_place`;
TRUNCATE TABLE `event_thematic`;
TRUNCATE TABLE `artiste_artiste`;
TRUNCATE TABLE `artiste_media`;
TRUNCATE TABLE `organisateur_media`;
TRUNCATE TABLE `place_media`;
--
DELETE FROM `event_group` WHERE parent_id IS NOT NULL;
DELETE FROM `event_group` ;
DELETE FROM `artiste`;
DELETE FROM `commune`;
DELETE FROM `date`;
DELETE FROM `fake_data`;
DELETE FROM `hour`;
DELETE FROM `keyword_search`;
DELETE FROM `member_event`;
DELETE FROM `media`;
DELETE FROM `organisateur`;
DELETE FROM `place`;
DELETE FROM `quartier`;
DELETE FROM `region`;
DELETE FROM `status`;
DELETE FROM `subscriber`;
DELETE FROM `thematic`;
DELETE FROM `event`;
DELETE FROM `api`;
DELETE FROM `access_type`;
DELETE FROM `user`;
-- thematic
INSERT INTO `thematic` (`id`, `name`, `created_at`, `updated_at`, `disabled_at`, `slug`)
SELECT `id`, `name`, `created_at`, `updated_at`, NULL,  `slug` FROM `madatsara`.`event_type`;
-- api
INSERT INTO `api` (`id`, `name`, `created_at`, `updated_at`, `disabled_at`)
SELECT `id`, `name`, `created_at`, `updated_at`, NULL FROM `madatsara`.`api`;
-- artiste
INSERT INTO `artiste` (`id`, `name`, `updated_at`, `disabled_at`, `slug`)
SELECT `id`, `name`, `updated_at`, NULL,  `slug` FROM `madatsara`.`event_artistes_dj_organisateurs` WHERE `type` IN('artiste','--- Choisir ---');
-- artiste_artiste
INSERT INTO `artiste_artiste` (`artiste_source`, `artiste_target`)
SELECT `child_id`, `parent_id` FROM `madatsara`.artiste_by_groupartists;
-- media
INSERT INTO `media` (`file`)
SELECT `photo` FROM `madatsara`.`event_artistes_dj_organisateurs` WHERE `type` IN('artiste','--- Choisir ---') AND `photo` IS NOT NULL;
-- Artiste media
INSERT INTO `artiste_media` (`artiste_id`, `media_id`)
SELECT x.`id`, b.`id` FROM `media` b
INNER JOIN `madatsara`.`event_artistes_dj_organisateurs` x ON x.photo = b.`file`
WHERE x.`type` IN('artiste','--- Choisir ---') AND x.`photo` IS NOT NULL;
-- organisateur
INSERT INTO `organisateur` (`id`, `name`, `updated_at`, `disabled_at`, `slug`)
SELECT `id`, `name`, `updated_at`, NULL,  `slug` FROM `madatsara`.`event_artistes_dj_organisateurs` WHERE `type` IN('organisateur');
-- media artistes
INSERT INTO `media` (`file`)
SELECT `photo` FROM `madatsara`.`event_artistes_dj_organisateurs` WHERE `type` IN('organisateur') AND `photo` IS NOT NULL;
-- media flyers
INSERT INTO `media` (`file`, `main`)
SELECT `image`, `ismain` FROM `madatsara`.`event_flyers` WHERE `image` IS NOT NULL;
-- Artiste media
INSERT INTO `organisateur_media` (`organisateur_id`, `media_id`)
SELECT x.`id`, b.`id` FROM `media` b
INNER JOIN `madatsara`.`event_artistes_dj_organisateurs` x ON x.photo = b.`file`
WHERE x.`type` IN('organisateur') AND x.`photo` IS NOT NULL;
-- Date
INSERT INTO `date` (`id`, `date`)
SELECT `id`, `date` FROM `madatsara`.`event_date`;
-- access
INSERT INTO `access_type` (`id`, `name`, `created_at`, `updated_at`, `disabled_at`)
SELECT `id`, `name`, `created_at`, `updated_at`, NULL FROM `madatsara`.`entree_type`;
-- event
INSERT INTO `event` (`id`, `name`, `description`, `api_id`, `created_at`, `disabled_at`, `slug`, `access_type_id`)
SELECT `id`, `name`, `description`, `api_id`, `created_at`, `deletedAt`, `slug`, `entreetype_id` FROM `madatsara`.`event` WHERE `name` IS NOT NULL;
-- event_artiste
INSERT INTO `event_artiste` (`event_id`, `artiste_id`)
SELECT b.`id`, x.`event_artistes_dj_organisateurs_id` FROM `event` b
INNER JOIN `madatsara`.`event_event_artistes_dj_organisateurs` x ON x.event_id = b.`id`
INNER JOIN `madatsara`.`event_artistes_dj_organisateurs` y ON y.id = x.`event_artistes_dj_organisateurs_id`
WHERE y.`type` IN('artiste','--- Choisir ---');
-- event_date
INSERT INTO `event_date` (`event_id`, `date_id`)
SELECT `event_id`, `event_date_id` FROM `madatsara`.`event_by_date` x
INNER JOIN `event` a ON a.id = x.`event_id`;
-- event_group
INSERT INTO `event_group` (`id`, `name`, `slug`, `parent_id`, `is_parent`)
SELECT `id`, `name`, `slug`, `parent_id`, CASE WHEN `parent_id` IS NULL THEN 0 ELSE 1 END  FROM `madatsara`.`event_local`;
-- event_group_related
INSERT INTO `event_group_related` (`event_id`, `event_group_id`)
SELECT `event_id`, `event_local_id` FROM `madatsara`.`event_event_local` x
INNER JOIN `event` a ON a.id = x.`event_id`;
-- hour
INSERT IGNORE INTO `hour` (`hour`)
SELECT CASE WHEN LENGTH(TRIM(SUBSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),  INSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),' ')))) = 8 THEN TRIM(SUBSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),  INSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),' '))) ELSE CONCAT(TRIM(SUBSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),  INSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),' '))),':00') END hour
FROM `madatsara`.`event` x
WHERE `dateclair` != '' AND TRIM(SUBSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),  INSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),' '))) !='';
-- event_hour
INSERT IGNORE INTO `event_hour` (`event_id`, `hour_id`)
SELECT x.`id`, b.`id` FROM `madatsara`.`event` x
INNER JOIN `hour` b ON b.hour = CASE WHEN LENGTH(TRIM(SUBSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),  INSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),' ')))) = 8 THEN TRIM(SUBSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),  INSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),' '))) ELSE CONCAT(TRIM(SUBSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),  INSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),' '))),':00') END
WHERE TRIM(SUBSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),  INSTR(SUBSTR(`dateclair`,1,INSTR(`dateclair`,'---')-1),' '))) !='';
-- Event media
INSERT INTO `event_media` (`event_id`, `media_id`)
SELECT y.`event_id`, b.`id` FROM `media` b
INNER JOIN `madatsara`.`event_flyers` x ON x.image = b.`file`
INNER JOIN `madatsara`.`event_event_flyers` y ON y.event_flyers_id = x.`id`;
-- event_organisateur
INSERT INTO `event_organisateur` (`event_id`, `organisateur_id`)
SELECT b.`id`, x.`event_artistes_dj_organisateurs_id` FROM `event` b
INNER JOIN `madatsara`.`event_event_artistes_dj_organisateurs` x ON x.event_id = b.`id`
INNER JOIN `madatsara`.`event_artistes_dj_organisateurs` y ON y.id = x.`event_artistes_dj_organisateurs_id`
WHERE y.`type` IN('organisateur');
-- place
INSERT INTO `place` (`id`, `name`, `contacts`, `gps`, `slug`)
SELECT `id`, `name`, CONCAT_WS("\n", address,tel,email,facebook,www), `gps`, `slug` FROM `madatsara`.`event_lieu`;
-- event_place
INSERT INTO `event_place` (`event_id`, `place_id`)
SELECT `event_id`, `event_lieu_id` FROM `madatsara`.`event_event_lieu` x
INNER JOIN `place` a ON a.id = x.`event_lieu_id`;
-- event_thematic
INSERT INTO `event_thematic` (`event_id`, `thematic_id`)
SELECT `event_id`, `event_type_id` FROM `madatsara`.`event_event_type` x
INNER JOIN `thematic` a ON a.id = x.`event_type_id`;
-- media lieux
INSERT INTO `media` (`file`)
SELECT `logo` FROM `madatsara`.`event_lieu` WHERE `logo` != "";
-- place_media
INSERT INTO `place_media` (`place_id`, `media_id`)
SELECT x.`id`, b.`id` FROM `media` b
INNER JOIN `madatsara`.`event_lieu` x ON x.logo = b.`file` AND x.logo != "";
-- keyword_search
INSERT INTO `keyword_search` (`id`, `name`, `hits`)
SELECT `id`, `query`, `hits` FROM `madatsara`.`esquerylog`;
-- subscriber
INSERT INTO `subscriber` (`id`, `email`, `created_at`)
SELECT `id`, `email`, `inscrit_date` FROM `madatsara`.`newsletter_abonne`;
-- user
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `created_at`, `updated_at`, `lastlogin_at`, `settings`, `token_social_network`, `nick_name`, `first_name`, `last_name`, `email_social_network`, `id_social_network`, `social_network_id`)
SELECT `id`, `username`, "{}", `password`, `created_at`, `updated_at`, `last_login`, `infos`, CASE WHEN facebook_access_token IS NOT NULL THEN facebook_access_token WHEN google_access_token IS NOT NULL THEN google_access_token WHEN twitter_token IS NOT NULL THEN twitter_token ELSE "" END, `nickname`, `first_name`, `last_name`, `email_rs`, CASE WHEN facebook_id IS NOT NULL THEN facebook_id WHEN google_id IS NOT NULL THEN google_id WHEN twitterid IS NOT NULL THEN twitterid ELSE "" END, CASE WHEN facebook_id IS NOT NULL THEN 2 WHEN google_id IS NOT NULL THEN 1 WHEN twitterid IS NOT NULL THEN 3 ELSE NULL END FROM `madatsara`.`fos_user`;
-- status
INSERT INTO `status` (`id`, `name`)
SELECT `id`, `name` FROM `madatsara`.`event_by_member_status`;
-- flyer member event
INSERT INTO `media` (`file`)
SELECT `flyer` FROM `madatsara`.`event_by_member` WHERE `flyer` != "" AND `name` IS NOT NULL AND `description` IS NOT NULL;
-- member_event
INSERT INTO `member_event` (`id`, `name`, `description`, `created_at`, `updated_at`, `status_id`, `event_id`, `user_id`, `media_id`)
SELECT a.`id`, a.`name`, a.`description`, a.`created_at`, a.`updated_at`, a.`status_id`, a.`event_id`, a.`author_id`, x.`id`
FROM `madatsara`.`event_by_member` a
INNER JOIN `media` x ON x.file = a.flyer AND a.flyer != ""
WHERE `name` IS NOT NULL AND `description` IS NOT NULL;
