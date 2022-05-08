create table label_bridge
(
    id             serial
        primary key,
    label_stack_id serial
        references label_stack,
    label_id       serial
        references label
);

alter table label_bridge
    owner to postgres;

INSERT INTO public.label_bridge
    (label_stack_id, label_id)
VALUES
    (1, 1),
    (1, 2),
    (1, 6),
    (1, 7),
    (1, 15),
    (1, 16);
