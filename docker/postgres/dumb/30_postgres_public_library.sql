create table library
(
    id         serial
        primary key,
    title      varchar(255) not null,
    image      varchar(255) not null,
    created_at timestamp    not null,
    updated_at timestamp    not null,
    author_id  integer      not null
        references users,
    perex      text
);

alter table library
    owner to postgres;

insert into library
    (title, image, created_at, updated_at, author_id, perex)
values
    ('Spuštění nového e-learningového portálu Czechitas', 'upload/library/TmKAl52p3yyAKQKW0zfnEKG0cy5TxecMMwHPysZaJEYIjz0qnS9chojrdCETWZw6vKMVP7KXDxwdzXnCVM6X5LbRT30U4geUOfcPtXy7OHGnpV1mw9zG2O07NIzmxRsf.jpg', now(), now(), 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis viverra diam non justo. Etiam posuere lacus quis dolor. Maecenas sollicitudin. Donec quis nibh at felis congue commodo. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Nulla accumsan, elit sit amet varius semper, nulla mauris mollis quam, tempor suscipit diam nulla vel leo. Etiam commodo dui eget wisi. Aliquam id dolor. Cras elementum.'), -- ID: 1
    ('Přednáška na FI MU - design webových stránek', 'upload/library/EDFIIKLYXZw0S4CN2bmZ6m3UiQie679SBCvYalMOgc0CKTWGAorfAHHW3vXw1JjHXGUULRMZuHrcKmp5p9vyvP8WOcRnkdwBCc0pdYbcJmrE8dhAv8EaXJat1lSb77J9.png', now(), now(), 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam ante. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'), -- ID: 2
    ('Přednáška na FI MU - úvod do PHP', 'upload/library/WSmYrcykqc1bmuRzSSzB73vYkPwktP4Ps2nQmIkBSca3H2zYXgXj7elHujPR8NXboGQgFY4nmr0qtdvDpMWr6GAbM3Jymur29wqJuUtUAQoK8HvMp45g4T0NPeYNKhRd.webp', now(), now(), 3, 'Nulla accumsan, elit sit amet varius semper, nulla mauris mollis quam, tempor suscipit diam nulla vel leo. Aliquam erat volutpat. Maecenas libero. Quisque porta. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit.'), -- ID: 3
    ('Mezinárodní IT konference v Praze', 'upload/library/JK32gO0n7Kd4WXzW1a1BwIUdZJAWfm9SlMRjfac2wVTslgUV5Hfk6pCQSfiqforGm7nxVGoIdWa3eoyXqVEtFEceSSZg2z1amf65iRz99KWuYdG35axipmrmRZ4Fi0lm.jpg', now(), now(), 4, 'Vivamus porttitor turpis ac leo. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Nulla quis diam. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse sagittis ultrices augue.'), -- ID: 4
    ('Mezinárodní IT konference v Brně', 'upload/library/OixNsXTqY4u3N3dx1S35hzp01DYScXsgx37ZIRqZzcgmtBspLGD2KboTLGgykjoloNmSLForDCt7Q3PXXlf4WIY3Dl2ScAsHjvFMVWfTanaXFZKTEclr1teFjN0yh7Ty.jpg', now(), now(), 4, 'Nullam eget nisl. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Curabitur sagittis hendrerit ante. Aliquam erat volutpat. Phasellus faucibus molestie nisl. Aliquam in lorem sit amet leo accumsan lacinia. Integer malesuada.'); -- ID: 5
