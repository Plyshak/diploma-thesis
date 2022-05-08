create table users
(
    id          serial,
    external_id int          not null,
    name        varchar(255) not null,
    password    varchar(255) not null,
    type        int          not null
        constraint users_user_type_id_fk
            references user_type (id)
);

create unique index users_id_uindex
    on users (id);

insert into users
values
    (1, 0, 'Host', '33e9232989576b5cfaa06654217d7a1a', 1),
    (2, 0, 'Uživatel', 'a8ac0e63c009626bf756b0dfb111b3c1', 2),
    (3, 0, 'Lektor', '7ac3d3592e431c2c52f16fc2c083bf9c', 3),
    (4, 0, 'Administrátor', '6b272826eaa618d448a337c5af99d404', 4);