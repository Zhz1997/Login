create table users(
	user_id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    user_name TINYTEXT not null,
    user_pwd LONGTEXT not null,
    user_createDate DATE
);
