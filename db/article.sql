
CREATE SEQUENCE "article_category_id";
CREATE TABLE "article_category" (
    "id" BIGINT NOT NULL default nextval('article_id'),
    "created" timestamp NOT NULL DEFAULT now(),
    "published" timestamp NULL,
    "slug" varchar(16) NULL,
    "left" integer NULL,
    "right" integer NULL,
    PRIMARY KEY("id")
);
CREATE SEQUENCE "article_category_i18n_id";
CREATE TABLE "article_category_i18n" (
    "id" BIGINT NOT NULL default nextval('article_category_i18n_id'),
    "object_id" BIGINT NOT NULL REFERENCES "article_category"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(64) NULL,
    "brief" CHARACTER VARYING(512) NULL,
    "text" CHARACTER VARYING(4096) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX article_category_i18n_object_id_idx ON article_category_i18n(object_id);
CREATE INDEX article_category_i18n_language_id_idx ON article_category_i18n(language_id);
CREATE UNIQUE INDEX article_category_i18n_object_id_language_id_uidx ON "article_category_i18n"("object_id", "language_id");



CREATE SEQUENCE "article_id";
CREATE TABLE "article" (
    "id" BIGINT NOT NULL default nextval('article_id'),
    "created" timestamp NOT NULL DEFAULT now(),
    "published" timestamp NULL,
    "category_id" BIGINT NOT NULL REFERENCES "article_category"("id") ON UPDATE CASCADE ON DELETE CASCADE,

    "name" CHARACTER VARYING(128) NULL,
    "text" CHARACTER VARYING(4096) NULL,

    PRIMARY KEY("id")
);

CREATE SEQUENCE "article_i18n_id";
CREATE TABLE "article_i18n" (
    "id" BIGINT NOT NULL default nextval('article_i18n_id'),
    "object_id" BIGINT NOT NULL REFERENCES "article"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(128) NULL,
    "text" CHARACTER VARYING(4096) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX article_i18n_object_id_idx ON article_i18n(object_id);
CREATE INDEX article_i18n_language_id_idx ON article_i18n(language_id);
CREATE UNIQUE INDEX article_i18n_object_id_language_id_uidx ON "article_i18n"("object_id", "language_id");



CREATE TABLE "article_picture" (
    "id" BIGINT NOT NULL default nextval('picture_id'),
    "object_id" BIGINT NOT NULL REFERENCES "article"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "type_id" INTEGER NOT NULL,
    "name" CHARACTER VARYING(128) NOT NULL,
    "main" BOOLEAN NULL DEFAULT false,
	"size" BIGINT NULL default 0,
	"width" INT NOT NULL,
	"height" INT NOT NULL,

    PRIMARY KEY("id")
);
CREATE INDEX article_picture_object_id_idx ON article_picture(object_id);



CREATE SEQUENCE "news_id";
CREATE TABLE "news" (
    "id" BIGINT NOT NULL default nextval('news_id'),
    "created" timestamp NOT NULL DEFAULT now(),
    "published" timestamp NULL,

    "name" CHARACTER VARYING(128) NULL,
    "text" CHARACTER VARYING(4096) NULL,

    PRIMARY KEY("id")
);

CREATE SEQUENCE "news_i18n_id";
CREATE TABLE "news_i18n" (
    "id" BIGINT NOT NULL default nextval('news_i18n_id'),
    "object_id" BIGINT NOT NULL REFERENCES "news"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(128) NULL,
    "text" CHARACTER VARYING(4096) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX news_i18n_object_id_idx ON news_i18n(object_id);
CREATE INDEX news_i18n_language_id_idx ON news_i18n(language_id);
CREATE UNIQUE INDEX news_i18n_object_id_language_id_uidx ON "news_i18n"("object_id", "language_id");

CREATE TABLE "news_picture" (
    "id" BIGINT NOT NULL default nextval('picture_id'),
    "object_id" BIGINT NOT NULL REFERENCES "news"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "type_id" INTEGER NOT NULL,
    "name" CHARACTER VARYING(128) NOT NULL,
    "main" BOOLEAN NULL DEFAULT false,
	"size" BIGINT NULL default 0,
	"width" INT NOT NULL,
	"height" INT NOT NULL,

    PRIMARY KEY("id")
);
CREATE INDEX news_picture_object_id_idx ON news_picture(object_id);
