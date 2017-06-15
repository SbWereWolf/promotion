CREATE TABLE person
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_person
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  code        TEXT,
  title       TEXT,
  description TEXT
);
CREATE UNIQUE INDEX ux_person_code
  ON person (code);

CREATE TABLE service
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_service
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  code        TEXT,
  title       TEXT,
  description TEXT
);
CREATE UNIQUE INDEX ux_service_code
  ON service (code);

CREATE TABLE account
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_account
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  service_id  INTEGER
    CONSTRAINT fk_account_service_id
    REFERENCES service (id),
  login       TEXT,
  password    TEXT,
  description TEXT
);
CREATE UNIQUE INDEX ux_account_service_id_login
  ON service_account (service_id, login);

CREATE TABLE person_account
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_person_account
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  person_id   INTEGER
    CONSTRAINT fk_person_account_person_id
    REFERENCES person (id),
  account_id  INTEGER
    CONSTRAINT fk_person_account_account_id
    REFERENCES account (id)
);
CREATE UNIQUE INDEX ux_person_account_account_id
  ON person_account (account_id);
CREATE INDEX ix_person_account_person_id_account_id
  ON person_account (person_id, account_id);

CREATE TABLE tag
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_tag
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  code        TEXT,
  title       TEXT,
  description TEXT
);
CREATE UNIQUE INDEX ux_tag_code
  ON tag (code);

CREATE TABLE tag_account
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_tag_account
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  tag_id      INTEGER
    CONSTRAINT fk_tag_account_tag_id
    REFERENCES tag (id),
  account_id  INTEGER
    CONSTRAINT fk_tag_account_account_id
    REFERENCES account (id)
);
CREATE UNIQUE INDEX ux_tag_account_tag_id_account_id
  ON tag_account (tag_id, account_id);
CREATE INDEX ix_tag_account_account_id_tag_id
  ON tag_account (account_id, tag_id);

CREATE TABLE tag_service
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_tag_service
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  tag_id      INTEGER
    CONSTRAINT fk_tag_service_tag_id
    REFERENCES tag (id),
  service_id  INTEGER
    CONSTRAINT fk_tag_service_service_id
    REFERENCES service (id)
);
CREATE UNIQUE INDEX ux_tag_service_tag_id_service_id
  ON tag_service (tag_id, service_id);
CREATE INDEX ix_tag_service_service_id_tag_id
  ON tag_service (service_id, tag_id);

CREATE TABLE post
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_post
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  account_id  INTEGER
    CONSTRAINT fk_post_account_id
    REFERENCES account (id),
  title       TEXT,
  body        TEXT
);
CREATE UNIQUE INDEX ux_post_account_id
  ON post (account_id);
