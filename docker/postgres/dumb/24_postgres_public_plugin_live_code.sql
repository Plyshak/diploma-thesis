create table plugin_live_code
(
    id                       serial
        primary key,
    created_at               timestamp    not null,
    updated_at               timestamp    not null,
    title                    varchar(255),
    show_title               boolean default true,
    language                 varchar(255)
);

alter table plugin_live_code
    owner to postgres;

insert into plugin_live_code
    (created_at, updated_at, title, show_title, language)
values
    (now(), now(), '', false, 'php'), -- ID: 1
    (now(), now(), '', false, 'js'), -- ID: 2
    (now(), now(), '', false, 'python'), -- ID: 3
    (now(), now(), '', false, 'sql'); -- ID: 4