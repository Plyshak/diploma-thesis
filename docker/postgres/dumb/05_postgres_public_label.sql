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

INSERT INTO public.label
    (title, created_at, updated_at)
VALUES
    ('PHP', now(), now()),
    ('Javascript', now(), now()),
    ('Java', now(), now()),
    ('C++', now(), now()),
    ('C#', now(), now()),
    ('Ruby', now(), now()),
    ('jQuery', now(), now()),
    ('Design', now(), now()),
    ('Kurz', now(), now()),
    ('Přednáška', now(), now()),
    ('iPhone', now(), now()),
    ('Grafika', now(), now()),
    ('UI', now(), now()),
    ('MUNI', now(), now()),
    ('CSIRT', now(), now()),
    ('František', now(), now());
