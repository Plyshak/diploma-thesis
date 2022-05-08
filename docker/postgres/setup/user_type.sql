create table user_type
(
    id          serial,
    name        varchar(255) not null,
    code        varchar(255) not null,
    permissions int default 0
);

create unique index user_type_id_uindex
    on user_type (id);

insert into user_type
values
    (1, 'Host', 'GUEST', 0),
    (2, 'Uživatel', 'USER', 1),
    (3, 'Lektor', 'LECTOR', 2),
    (4, 'Administrátor', 'ADMINISTRATOR', 3)
;