DROP TABLE IF EXISTS answers, questions CASCADE;

CREATE TABLE IF NOT EXISTS questions
(
    question_id     int AUTO_INCREMENT NOT NULL,
    submission_time timestamp          NOT NULL,
    view_number     int,
    vote_number     int,
    title           varchar(20)        NOT NULL,
    message         text               NOT NULL,
    image           text,
    PRIMARY KEY (question_id)
);

CREATE TABLE IF NOT EXISTS answers
(
    answer_id       int AUTO_INCREMENT NOT NULL,
    submission_time timestamp          NOT NULL,
    vote_number     int,
    question_id     int                NOT NULL,
    message         text               NOT NULL,
    image           text,
    PRIMARY KEY (answer_id),
    FOREIGN KEY (question_id) REFERENCES questions (question_id) ON DELETE CASCADE
);

