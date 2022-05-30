create table users
(
    id          serial
        primary key,
    external_id integer      not null,
    name        varchar(255) not null,
    password    varchar(255) not null,
    type        integer
        references user_type
);

alter table users
    owner to postgres;

insert into users
    (external_id, name, password, type)
values
    (0, 'Tomáš Zábranský', '517100c13f9a130afe5718b4a2dcfe49', 1), -- ID: 1
    (10000, 'Student', 'f5c0a1c9384c2e25e79ba1abf5d9a037', 1), -- ID: 2
    (11111, 'Studentka', '7b268547ec345b87a32704fb4525f898', 1), -- ID: 3
    (11011, 'John Doe', '4c2a904bafba06591225113ad17b5cec', 2), -- ID: 4
    (10101, 'Jane Doe', '1c272047233576d77a9b9a1acfdf741c', 2), -- ID: 5
    (10001, 'Administrátor', '6b272826eaa618d448a337c5af99d404', 3); -- ID: 6

