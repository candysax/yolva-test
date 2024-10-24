create table users
(
    id int auto_increment
        primary key,
    login varchar(255) not null,
    password varchar(255) null,
    constraint users_login_unique
        unique (login)
);

