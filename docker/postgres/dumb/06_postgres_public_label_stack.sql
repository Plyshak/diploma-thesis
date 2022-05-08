create table label_stack
(
    id         serial
        primary key,
    module     varchar(255) not null,
    module_id  integer      not null,
    created_at timestamp    not null,
    updated_at timestamp    not null
);

alter table label_stack
    owner to postgres;

INSERT INTO public.label_stack
    (module, module_id, created_at, updated_at)
VALUES
    ('library', 5, '2022-05-05 18:12:43.821532', '2022-05-05 18:12:43.821532');
