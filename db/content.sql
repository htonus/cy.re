CREATE TABLE "custom_type" (
    "id" INTEGER NOT NULL,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);

CREATE TABLE "section" (
    "id" INTEGER NOT NULL,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);

CREATE SEQUENCE "custom_id";
CREATE TABLE "custom" (
    "id" BIGINT NOT NULL default nextval('custom_id'),
    "type_id" BIGINT NOT NULL REFERENCES "custom_type"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "section_id" BIGINT NOT NULL REFERENCES "section"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(256) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX custom_section_id_idx ON custom(section_id);

CREATE SEQUENCE "custom_item_id";
CREATE TABLE "custom_item" (
    "id" BIGINT NOT NULL default nextval('custom_item_id'),
    "order" INTEGER NULL,
    "parent_id" BIGINT NOT NULL REFERENCES "custom"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "realty_id" BIGINT NULL REFERENCES "realty"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "article_id" BIGINT NULL REFERENCES "article"("id") ON DELETE RESTRICT ON UPDATE CASCADE,
    "name" CHARACTER VARYING(256) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX custom_item_custom_id_idx ON custom_item(parent_id);
CREATE INDEX custom_item_realty_id_idx ON custom_item(realty_id);


CREATE TABLE "static_type" (
    "id" INTEGER NOT NULL,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);

CREATE SEQUENCE "static_page_id";
CREATE TABLE "static_page" (
    "id" BIGINT NOT NULL default nextval('static_page_id'),
    "created" timestamp NOT NULL DEFAULT now(),
    "type_id" BIGINT NOT NULL REFERENCES "static_type"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "section_id" BIGINT NULL REFERENCES "section"("id") ON UPDATE CASCADE ON DELETE CASCADE,

    PRIMARY KEY("id")
);

CREATE SEQUENCE "static_page_i18n_id";
CREATE TABLE "static_page_i18n" (
    "id" BIGINT NOT NULL default nextval('static_page_i18n_id'),
    "object_id" BIGINT NOT NULL REFERENCES "static_page"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(128) NULL,
    "anons" CHARACTER VARYING(512) NULL,
    "text" CHARACTER VARYING(4096) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX static_page_i18n_object_id_idx ON static_page_i18n(object_id);
CREATE INDEX static_page_i18n_language_id_idx ON static_page_i18n(language_id);
CREATE UNIQUE INDEX static_page_i18n_object_id_language_id_uidx ON "static_page_i18n"("object_id", "language_id");