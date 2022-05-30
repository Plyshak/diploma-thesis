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

insert into label_bridge
    (label_stack_id, label_id)
values
    (1, 16),
    (2, 12),
    (2, 10),
    (2, 11),
    (2, 14),
    (3, 10),
    (3, 11),
    (3, 12),
    (3, 1),
    (4, 12),
    (5, 12),
    (4, 16),
    (5, 16),
    (6, 8),
    (6, 2),
    (7, 8),
    (7, 2),
    (8, 1),
    (8, 8),
    (9, 1),
    (9, 8),
    (10, 1),
    (10, 8),
    (11, 1),
    (11, 8),
    (12, 1),
    (12, 8),
    (13, 1),
    (13, 8),
    (14, 1),
    (14, 8);
