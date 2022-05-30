create table user_type
(
    id          serial
        primary key,
    name        varchar(255) not null,
    code        varchar(255) not null,
    permissions integer default 0
);

alter table user_type
    owner to postgres;

insert into user_type
    (name, code, permissions)
values
    ('Uživatel', 'USER', 1),
    ('Lektor', 'LECTOR', 2),
    ('Administrátor', 'ADMINISTRATOR', 3);
