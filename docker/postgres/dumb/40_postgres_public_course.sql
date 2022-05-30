create table course
(
    id          serial
        primary key,
    created_at  timestamp not null,
    updated_at  timestamp not null,
    title       varchar(255),
    author_id   integer not null
        references users,
    topic_id    integer
        references topic,
    annotation  text,
    public      boolean default false,
    visibility  boolean default false
);

alter table course
    owner to postgres;


insert into course
    (created_at, updated_at, title, author_id, topic_id, annotation, public, visibility)
values
    (now(), now(), 'Digitalni akademie: Testování v Brně', 4, 1, 'Culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptartem accusantium doloremque laudantium, totam rem aperiam.', true, true), -- ID: 1
    (now(), now(), 'Digitální akademie: Testování v Praze', 4, 1, 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam rhoncus aliquam metus. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis.', true, true), -- ID: 2
    (now(), now(), 'Úvod do PHP: PHP pro začátečníky', 5, 3, 'Pellentesque pretium lectus id turpis. Nullam at arcu a est sollicitudin euismod. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Donec ipsum massa, ullamcorper in, auctor et, scelerisque sed, est. Vivamus porttitor turpis ac leo. Integer vulputate sem a nibh rutrum consequat.', true, true), -- ID: 3
    (now(), now(), 'Úvod do PHP: PHP pro pokročilé', 5, 3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris elementum mauris vitae tortor. Integer lacinia. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Proin in tellus sit amet nibh dignissim sagittis. Vivamus luctus egestas leo.', false, false), -- ID: 4
    (now(), now(), 'Úvod do PHP: Třídy a funkce', 5, 3, 'Donec ipsum massa, ullamcorper in, auctor et, scelerisque sed, est. Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus. Phasellus enim erat, vestibulum vel, aliquam a, posuere eu, velit. ', false, true), -- ID: 5
    (now(), now(), 'Úvod do PHP: Cykly snadno a jednoduše', 5, 3, 'Praesent vitae arcu tempor neque lacinia pretium. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', false, false); -- ID: 6
