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

insert into plugin_picture_block
    (created_at, updated_at, title, show_title, image, picture_align, picture_description, picture_width)
values
    (now(), now(), 'Obrázek', true, 'upload/plugin/pictureBlock/KpR4F5XKllEGRuFH6JiLALWTnRivXNaEoU8PiVPWgrVA5tCacmsXaZwj7iJpa5hkLPIe9d5kUWCTkptk1nRWHhdgxTVqKgM63lMFtcBf9rq8cClH4Y1B5y8UFdHn53vd.jpg', 'center', 'alt: Lorem ipsum', 'common'); -- ID: 1
