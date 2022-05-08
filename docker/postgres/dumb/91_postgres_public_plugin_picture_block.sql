create table plugin_picture_block
(
    id                       serial
        primary key,
    created_at               timestamp    not null,
    updated_at               timestamp    not null,
    title                    varchar(255),
    show_title               boolean default true,
    image                    varchar(255),
    picture_align            varchar(255) not null,
    picture_description      text,
    picture_show_description boolean default false,
    picture_width            varchar(255)
);

alter table plugin_picture_block
    owner to postgres;

