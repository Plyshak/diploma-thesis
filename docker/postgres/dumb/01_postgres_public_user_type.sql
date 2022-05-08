create table user_type
(
    id          serial,
    name        varchar(255) not null,
    code        varchar(255) not null,
    permissions integer default 0
);

alter table user_type
    owner to postgres;

create unique index user_type_id_uindex
    on user_type (id);

INSERT INTO public.user_type
    (name, code, permissions)
VALUES
    ('Host', 'GUEST', 0),
    ('Uživatel', 'USER', 1),
    ('Lektor', 'LECTOR', 2),
    ('Administrátor', 'ADMINISTRATOR', 3);
