create table users
(
    id          serial,
    external_id integer      not null,
    name        varchar(255) not null,
    password    varchar(255) not null,
    type        integer      not null
        constraint users_user_type_id_fk
            references user_type (id)
);

alter table users
    owner to postgres;

create unique index users_id_uindex
    on users (id);

INSERT INTO public.users
    (external_id, name, password, type)
VALUES
    (0, 'Host', '33e9232989576b5cfaa06654217d7a1a', 1),
    (0, 'Uživatel', 'a8ac0e63c009626bf756b0dfb111b3c1', 2),
    (0, 'Lektor', '43f76ee579f3f69ebc6ae6181d380290', 3),
    (0, 'Administrátor', '99fedb09f0f5da90e577784e5f9fdc23', 4);

