create table plugin_text_block
(
    id           serial
        primary key,
    created_at   timestamp not null,
    updated_at   timestamp not null,
    title        varchar(255),
    show_title   boolean default true,
    perex        text,
    body         text,
    button_title varchar(255),
    button_show  boolean default true,
    button_url   varchar(255),
    button_blank boolean default false
);

alter table plugin_text_block
    owner to postgres;

INSERT INTO public.plugin_text_block
    (created_at, updated_at, title, show_title, perex, body, button_title, button_show, button_url, button_blank)
VALUES
    ('2022-05-05 14:46:07.010964', '2022-05-05 14:46:07.010964', 'Prvni textovy block', true, 've zkratce je o nicem :D', '<p>Ale v textu se daji vymyslet pekny vocasoviny</p><p>jako treba psat odstavce</p><ul><li>s</li><li>e</li><li>z</li><li>n</li><li>a</li><li>m</li><li>y</li></ul><p>a dalsi <b>p</b><i>ici</i>c<u>inky</u>...</p>', 'COOL odkaz', true, 'http://www.google.com', true);