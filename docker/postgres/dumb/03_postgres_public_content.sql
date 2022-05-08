create table content
(
    id         serial
        primary key,
    module     varchar(255) not null,
    module_id  integer      not null,
    created_at timestamp    not null,
    updated_at timestamp    not null
);

alter table content
    owner to postgres;

INSERT INTO public.content
    (module, module_id, created_at, updated_at)
VALUES
    ('library', 5, '2022-05-04 12:06:09.626109', '2022-05-04 12:06:09.626109');
