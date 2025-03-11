alter table users
add unique (email);

ALTER TABLE `users` CHANGE `role` `role` VARCHAR(10) NOT NULL DEFAULT 'user';
