create table plugin_test_form
(
    id                       serial
        primary key,
    created_at               timestamp    not null,
    updated_at               timestamp    not null,
    title                    varchar(255),
    show_title               boolean default true,
    configuration            text
);

alter table plugin_test_form
    owner to postgres;

insert into plugin_test_form
    (created_at, updated_at, title, show_title, configuration)
values
    (now(), now(), 'Testovací formulář', true, '{
    "0": {
        "question": "Vyberte 1 správnou odpověď:",
        "type": "single",
        "answers": {
            "0" : {
                "answer": "Toto je špatná odpověď",
                "points" : "0"
            },
            "1" : {
                "answer": "Toto je správná odpověď",
                "points": "1",
                "reason": "Protože je napsáno, že je správná."
            }
        }
    },
    "1": {
        "question": "Vyberte více správných odpovědí:",
        "type": "multi",
        "answers": {
            "0": {
                "answer": "Toto je špatná odpověď",
                "points" : "0"
            },
            "1": {
                "answer": "Toto je správná odpověď",
                "points": "1",
                "reason": "Protože je napsáno, že je správná."
            },
            "2": {
                "answer": "Toto je špatná odpověď",
                "points" : "0"
            },
            "3": {
                "answer": "Toto je správná odpověď",
                "points": "1",
                "reason": "Protože je napsáno, že je správná."
            }
        }
    }
}'), -- ID: 1
    (now(), now(), 'Testovací formulář', true, '{
    "0": {
        "question": "Vyberte 1 správnou odpověď:",
        "type": "single",
        "answers": {
            "0" : {
                "answer": "Toto je špatná odpověď",
                "points" : "0"
            },
            "1" : {
                "answer": "Toto je správná odpověď",
                "points": "1",
                "reason": "Protože je napsáno, že je správná."
            }
        }
    },
    "1": {
        "question": "Vyberte více správných odpovědí:",
        "type": "multi",
        "answers": {
            "0": {
                "answer": "Toto je špatná odpověď",
                "points" : "0"
            },
            "1": {
                "answer": "Toto je správná odpověď",
                "points": "1",
                "reason": "Protože je napsáno, že je správná."
            },
            "2": {
                "answer": "Toto je špatná odpověď",
                "points" : "0"
            },
            "3": {
                "answer": "Toto je správná odpověď",
                "points": "1",
                "reason": "Protože je napsáno, že je správná."
            }
        }
    }
}'), -- ID: 2
    (now(), now(), 'Testovací formulář', true, '{
    "0": {
        "question": "Vyberte 1 správnou odpověď:",
        "type": "single",
        "answers": {
            "0" : {
                "answer": "Toto je špatná odpověď",
                "points" : "0"
            },
            "1" : {
                "answer": "Toto je správná odpověď",
                "points": "1",
                "reason": "Protože je napsáno, že je správná."
            }
        }
    },
    "1": {
        "question": "Vyberte více správných odpovědí:",
        "type": "multi",
        "answers": {
            "0": {
                "answer": "Toto je špatná odpověď",
                "points" : "0"
            },
            "1": {
                "answer": "Toto je správná odpověď",
                "points": "1",
                "reason": "Protože je napsáno, že je správná."
            },
            "2": {
                "answer": "Toto je špatná odpověď",
                "points" : "0"
            },
            "3": {
                "answer": "Toto je správná odpověď",
                "points": "1",
                "reason": "Protože je napsáno, že je správná."
            }
        }
    }
}'); -- ID: 3