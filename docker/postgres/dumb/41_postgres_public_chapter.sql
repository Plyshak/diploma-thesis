create table chapter
(
    id          serial
        primary key,
    created_at   timestamp not null,
    updated_at   timestamp not null,
    course_id    integer
        references course,
    annotation  text,
    position    integer default 1,
    repetition  boolean default false
);

alter table chapter
    owner to postgres;


insert into chapter
    (created_at, updated_at, course_id, annotation, position, repetition)
values
    -- course 1
    (now(), now(), 1, 'Nulla non arcu lacinia neque faucibus fringilla. Fusce nibh. Duis risus. Pellentesque ipsum. Nam quis nulla. Suspendisse sagittis ultrices augue.', 1, false), -- ID: 1
    (now(), now(), 1, 'Nullam lectus justo, vulputate eget mollis sed, tempor sed magna.', 2, true), -- ID: 2
    (now(), now(), 1, 'Curabitur bibendum justo non orci. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', 3, false), -- ID: 3
    (now(), now(), 1, 'Vestibulum erat nulla, ullamcorper nec, rutrum non, nonummy ac, erat.', 4, true), -- ID: 4
    -- course 2
    (now(), now(), 2, 'Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo.', 1, false), -- ID: 5
    (now(), now(), 2, 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.', 2, true), -- ID: 6
    -- course 3
    (now(), now(), 3, 'Nulla non arcu lacinia neque faucibus fringilla. Aliquam erat volutpat.', 1, false), -- ID: 7
    (now(), now(), 3, 'Phasellus enim erat, vestibulum vel, aliquam a, posuere eu, velit.', 2, false), -- ID: 8
    (now(), now(), 3, 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 3, false), -- ID: 9
    (now(), now(), 3, 'Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Pellentesque arcu. Nunc tincidunt ante vitae massa. Duis risus.', 4, true), -- ID: 10
    -- course 4
    (now(), now(), 4, 'Integer lacinia.',1, false), -- ID: 11
    (now(), now(), 4, 'Praesent in mauris eu tortor porttitor accumsan.', 2, true), -- ID: 12
    -- course 5
    (now(), now(), 5, 'Nulla accumsan, elit sit amet varius semper, nulla mauris mollis quam, tempor suscipit diam nulla vel leo. Nullam dapibus fermentum ipsum.', 1, false), -- ID: 13
    (now(), now(), 5, 'Cras elementum. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.', 2, true), -- ID: 14
    -- course 6
    (now(), now(), 6, 'Mauris elementum mauris vitae tortor.', 1, false), -- ID: 15
    (now(), now(), 6, 'Cras elementum.', 2, true); -- ID: 15