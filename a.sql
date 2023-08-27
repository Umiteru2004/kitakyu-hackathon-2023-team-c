-- データベースの作成と権限付与
drop database if exists hakkason;
create database hakkason default character set utf8 collate utf8_general_ci;
grant all on hakkason.* to 'staff'@'localhost' identified by 'password';
use hakkason;

-- ユーザー
create table admin (
    admin_id int auto_increment primary key,
    username varchar(100) not null unique,
    address varchar(100) not null,
    password varchar(100) not null
);

-- ポイント情報
create table points (
    point_id int auto_increment primary key,
    admin_id int not null,
    points int not null,
    foreign key (admin_id) references admin(admin_id)
);

-- ユーザーデータの挿入
insert into admin (username, address, password) values ('Miyosi', '福岡市', 'aaa_admin');
