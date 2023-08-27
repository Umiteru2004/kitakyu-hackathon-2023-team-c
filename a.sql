-- データベースの作成と権限付与
drop database if exists hakkason;
create database hakkason default character set utf8 collate utf8_general_ci;
grant all on hakkason.* to 'staff'@'localhost' identified by 'password';
use hakkason;

-- ユーザー
create table customer (
    id int auto_increment primary key,
    username varchar(100) not null unique,
    address varchar(100) not null,
    password varchar(100) not null
);

-- ポイント情報
create table points (
    point_id int auto_increment primary key,
    customer_id int not null,
    points int not null,
    foreign key (customer_id) references customer(id) -- customerテーブルのidカラムを参照
);

-- ユーザーデータの挿入
insert into customer (username, address, password) values ('Miyosi', '福岡市', 'aaa_admin');
