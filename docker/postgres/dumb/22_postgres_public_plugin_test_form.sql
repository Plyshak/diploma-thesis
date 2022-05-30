create table plugin_test_form
(
    id                       serial
        primary key,
    created_at               timestamp    not null,
    updated_at               timestamp    not null,
    title                    varchar(255),
    show_title               boolean default true,
    configuration      text
);

alter table plugin_test_form
    owner to postgres;

insert into plugin_test_form
    (created_at, updated_at, title, show_title, configuration)
values
    (now(), now(), 'Testovací formulář', true, ''), -- ID: 1
    (now(), now(), 'Testovací formulář', true, ''), -- ID: 2
    (now(), now(), 'Testovací formulář', true, ''); -- ID: 3