CREATE TABLE public.person
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
  ON public.person (code);

COMMENT ON COLUMN public.person.id IS 'Идентификатор';
COMMENT ON COLUMN public.person.insert_date IS 'Дата добавления';
COMMENT ON COLUMN public.person.is_hidden IS 'Скрытая';
COMMENT ON COLUMN public.person.code IS 'Код';
COMMENT ON COLUMN public.person.title IS 'Наименование';
COMMENT ON COLUMN public.person.description IS 'Примечание';
COMMENT ON TABLE public.person IS 'Человек';

CREATE TABLE public.service
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
  ON public.service (code);

COMMENT ON COLUMN public.service.id IS 'Идентификатор';
COMMENT ON COLUMN public.service.insert_date IS 'Дата добавления';
COMMENT ON COLUMN public.service.is_hidden IS 'Скрытая';
COMMENT ON COLUMN public.service.code IS 'Код';
COMMENT ON COLUMN public.service.title IS 'Наименование';
COMMENT ON COLUMN public.service.description IS 'Примечание';
COMMENT ON TABLE public.service IS 'Сервис';

CREATE TABLE public.account
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_account
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  service_id  INTEGER
    CONSTRAINT fk_account_service_id
    REFERENCES public.service (id),
  login       TEXT,
  password    TEXT,
  description TEXT
);
CREATE UNIQUE INDEX ux_account_service_id_login
  ON public.account (service_id, login);
CREATE INDEX ix_account_login ON public.account (login);

COMMENT ON COLUMN public.account.id IS 'Идентификатор';
COMMENT ON COLUMN public.account.insert_date IS 'Дата добавления';
COMMENT ON COLUMN public.account.is_hidden IS 'Скрытая';
COMMENT ON COLUMN public.account.service_id IS 'Ссылка на Сервис';
COMMENT ON COLUMN public.account.login IS 'Логин';
COMMENT ON COLUMN public.account.password IS 'Пароль';
COMMENT ON COLUMN public.account.description IS 'Примечание';
COMMENT ON TABLE public.account IS 'Аккаунт';

CREATE TABLE public.person_account
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_person_account
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  person_id   INTEGER
    CONSTRAINT fk_person_account_person_id
    REFERENCES public.person (id),
  account_id  INTEGER
    CONSTRAINT fk_person_account_account_id
    REFERENCES public.account (id)
);
CREATE UNIQUE INDEX ux_person_account_account_id
  ON public.person_account (account_id);
CREATE INDEX ix_person_account_person_id_account_id
  ON public.person_account (person_id, account_id);

COMMENT ON COLUMN public.person_account.id IS 'Идентификатор';
COMMENT ON COLUMN public.person_account.insert_date IS 'Дата добавления';
COMMENT ON COLUMN public.person_account.is_hidden IS 'Скрытая';
COMMENT ON COLUMN public.person_account.person_id IS 'Ссылка на Человека';
COMMENT ON COLUMN public.person_account.account_id IS 'Ссылка на Аккаунт';
COMMENT ON TABLE public.person_account IS 'Аккаунты Человека';

CREATE TABLE public.tag
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
  ON public.tag (code);

COMMENT ON COLUMN public.tag.id IS 'Идентификатор';
COMMENT ON COLUMN public.tag.insert_date IS 'Дата добавления';
COMMENT ON COLUMN public.tag.is_hidden IS 'Скрытая';
COMMENT ON COLUMN public.tag.code IS 'Код';
COMMENT ON COLUMN public.tag.title IS 'Наименование';
COMMENT ON COLUMN public.tag.description IS 'Примечание';
COMMENT ON TABLE public.tag IS 'Тэг';

CREATE TABLE public.tag_account
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_tag_account
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  tag_id      INTEGER
    CONSTRAINT fk_tag_account_tag_id
    REFERENCES public.tag (id),
  account_id  INTEGER
    CONSTRAINT fk_tag_account_account_id
    REFERENCES public.account (id)
);
CREATE UNIQUE INDEX ux_tag_account_tag_id_account_id
  ON public.tag_account (tag_id, account_id);
CREATE INDEX ix_tag_account_account_id_tag_id
  ON public.tag_account (account_id, tag_id);

COMMENT ON COLUMN public.tag_account.id IS 'Идентификатор';
COMMENT ON COLUMN public.tag_account.insert_date IS 'Дата добавления';
COMMENT ON COLUMN public.tag_account.is_hidden IS 'Скрытая';
COMMENT ON COLUMN public.tag_account.tag_id IS 'Ссылка на Тэг';
COMMENT ON COLUMN public.tag_account.account_id IS 'Ссылка на Аккаунт';
COMMENT ON TABLE public.tag_account IS 'Теги Аккаунта';

CREATE TABLE public.tag_service
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_tag_service
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  tag_id      INTEGER
    CONSTRAINT fk_tag_service_tag_id
    REFERENCES public.tag (id),
  service_id  INTEGER
    CONSTRAINT fk_tag_service_service_id
    REFERENCES public.service (id)
);
CREATE UNIQUE INDEX ux_tag_service_tag_id_service_id
  ON public.tag_service (tag_id, service_id);
CREATE INDEX ix_tag_service_service_id_tag_id
  ON public.tag_service (service_id, tag_id);

COMMENT ON COLUMN public.tag_service.id IS 'Идентификатор';
COMMENT ON COLUMN public.tag_service.insert_date IS 'Дата добавления';
COMMENT ON COLUMN public.tag_service.is_hidden IS 'Скрытая';
COMMENT ON COLUMN public.tag_service.tag_id IS 'Ссылка на Тэг';
COMMENT ON COLUMN public.tag_service.service_id IS 'Ссылка на Сервис';
COMMENT ON TABLE public.tag_service IS 'Теги Сервиса';

CREATE TABLE public.post
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_post
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  title       TEXT,
  body        TEXT
);

COMMENT ON COLUMN public.post.id IS 'Идентификатор';
COMMENT ON COLUMN public.post.insert_date IS 'Дата добавления';
COMMENT ON COLUMN public.post.is_hidden IS 'Скрытая';
COMMENT ON COLUMN public.post.title IS 'Наименование';
COMMENT ON COLUMN public.post.body IS 'Содержимое';
COMMENT ON TABLE public.post IS 'Заметки';

CREATE TABLE public.account_post
(
  id          SERIAL NOT NULL
    CONSTRAINT pk_account_post
    PRIMARY KEY,
  insert_date TIMESTAMP WITH TIME ZONE DEFAULT now(),
  is_hidden   BOOLEAN                  DEFAULT FALSE,
  account_id  INTEGER
    CONSTRAINT fk_account_post_account_id
    REFERENCES public.account (id),
  post_id     INTEGER
    CONSTRAINT fk_account_post_post_id
    REFERENCES public.post (id)
);
CREATE UNIQUE INDEX ux_account_post_account_id_post_id
  ON account_post (account_id, post_id);
CREATE INDEX ix_account_post_post_id_account_id
  ON account_post (post_id, account_id);

COMMENT ON COLUMN public.account_post.id IS 'Идентификатор';
COMMENT ON COLUMN public.account_post.insert_date IS 'Дата добавления';
COMMENT ON COLUMN public.account_post.is_hidden IS 'Скрытая';
COMMENT ON COLUMN public.account_post.account_id IS 'Ссылка на Аккаунт';
COMMENT ON COLUMN public.account_post.post_id IS 'Ссылка на Заметку';
COMMENT ON TABLE public.account_post IS 'Заметки Аккаунта';
