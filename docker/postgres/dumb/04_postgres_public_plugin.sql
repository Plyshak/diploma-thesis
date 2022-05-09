create table plugin
(
    id         serial
        primary key,
    content_id integer              not null
        references content
            on update cascade on delete cascade,
    plugin     varchar(255)         not null,
    plugin_id  integer              not null,
    created_at timestamp            not null,
    updated_at timestamp            not null,
    visibility boolean default true not null,
    position   integer default 0    not null,
    unique (id, content_id)
);

alter table plugin
    owner to postgres;

INSERT INTO public.plugin
    (content_id, plugin, plugin_id, created_at, updated_at, visibility, position)
VALUES
    (1, 'textBlock', 1, now(), now(), true, 0);
