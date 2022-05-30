create table label
(
    id         serial
        primary key,
    title      varchar(255) not null
        unique,
    created_at timestamp    not null,
    updated_at timestamp    not null
);

alter table label
    owner to postgres;

insert into label
    (title, created_at, updated_at)
values
    -- labels for courses and discussions
    ('PHP', now(), now()), -- ID: 1
    ('Javascript', now(), now()), -- ID: 2
    ('Java', now(), now()), -- ID: 3
    ('C++', now(), now()), -- ID: 4
    ('C#', now(), now()), -- ID: 5
    ('Ruby', now(), now()), -- ID: 6
    ('jQuery', now(), now()), -- ID: 7
    -- labels for library
    ('Kurz', now(), now()), -- ID: 8
    ('Icon', now(), now()), -- ID: 9
    ('Design', now(), now()), -- ID: 10
    ('Web design', now(), now()), -- ID: 11
    ('Přednáška', now(), now()), -- ID: 12
    ('iPhone', now(), now()), -- ID: 13
    ('Graphics', now(), now()), -- ID: 14
    ('UI', now(), now()), -- ID: 15
    ('Zajímavost', now(), now()); -- ID: 16
