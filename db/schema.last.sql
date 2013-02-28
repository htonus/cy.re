CREATE SEQUENCE "language_id";
CREATE TABLE "language" (
    "id" BIGINT NOT NULL default nextval('language_id'),
    "name" CHARACTER VARYING(16) NOT NULL,
    "code" CHARACTER VARYING(2) NOT NULL,
    "native" CHARACTER VARYING(16) NOT NULL,
    "active" BOOLEAN NOT NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "i18n_id";
CREATE TABLE "i18n" (
    "id" BIGINT NOT NULL default nextval('unit_id'),
    "lang_id" BIGINT NOT NULL,
    "object" CHARACTER VARYING(16) NOT NULL,
    "object_id" BIGINT NOT NULL,
    "filed" CHARACTER VARYING(16) NOT NULL,
    "value" CHARACTER VARYING(4063) NOT NULL,
    PRIMARY KEY("id")
);
CREATE INDEX i18n_lang_id_idx ON i18n(lang_id);
CREATE INDEX i18n_object_idx ON i18n("object");
CREATE INDEX i18n_object_id_idx ON i18n("object_id");


CREATE SEQUENCE "unit_i18n_id";
CREATE TABLE "unit_i18n" (
    "id" BIGINT NOT NULL default nextval('unit_i18n_id'),
    "unit_id" BIGINT NOT NULL REFERENCES "unit"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" BIGINT NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);
CREATE INDEX unit_i18n_unit_id_idx ON unit_i18n(unit_id);
CREATE INDEX unit_i18n_language_id_idx ON unit_i18n(language_id);

CREATE SEQUENCE "property_type_id";
CREATE TABLE "property_type" (
    "id" BIGINT NOT NULL default nextval('property_type_id'),
    "lang_id" BIGINT NOT NULL,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "offer_type_id";
CREATE TABLE "offer_type" (
    "id" BIGINT NOT NULL default nextval('offer_type_id'),
    "lang_id" BIGINT NOT NULL,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "object_id";
CREATE TABLE "object" (
    "id" BIGINT NOT NULL default nextval('object_id'),
    "lang_id" BIGINT NOT NULL,
    "created" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    "published" TIMESTAMP WITHOUT TIME ZONE NULL,
    "type_id" BIGINT NOT NULL,
    "offer_id" BIGINT NOT NULL,
    "agent_id" BIGINT NULL,
    "owner_id" BIGINT NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "unit_id";
CREATE TABLE "unit" (
    "id" BIGINT NOT NULL default nextval('unit_id'),
    "lang_id" BIGINT NOT NULL,
    "name" CHARACTER VARYING(16) NOT NULL,
    "sign" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "feature_type_id";
CREATE TABLE "feature_type" (
    "id" BIGINT NOT NULL default nextval('feature_type_id'),
    "lang_id" BIGINT NOT NULL,
    "created" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    "published" TIMESTAMP WITHOUT TIME ZONE NULL,
    "type_id" BIGINT NOT NULL,
    "offer_id" BIGINT NOT NULL,
    "agent_id" BIGINT NULL,
    "owner_id" BIGINT NULL,
    "unit_id" BIGINT NOT NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "feature_id";
CREATE TABLE "feature" (
    "id" BIGINT NOT NULL default nextval('feature_id'),
    "lang_id" BIGINT NOT NULL,
    "created" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    "published" TIMESTAMP WITHOUT TIME ZONE NULL,
    "type_id" BIGINT NOT NULL,
    "offer_id" BIGINT NOT NULL,
    "agent_id" BIGINT NULL,
    "owner_id" BIGINT NULL,
    "value" CHARACTER VARYING(16) NOT NULL,
    "weight" INTEGER NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "property_id";
CREATE TABLE "property" (
    "id" BIGINT NOT NULL default nextval('property_id'),
    "lang_id" BIGINT NOT NULL,
    "object_id" BIGINT NOT NULL,
    "name" CHARACTER VARYING(128) NOT NULL,
    "content" CHARACTER VARYING(4096) NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "person_id";
CREATE TABLE "person" (
    "id" BIGINT NOT NULL default nextval('person_id'),
    "lang_id" BIGINT NOT NULL,
    "name" CHARACTER VARYING(16) NOT NULL,
    "phone" CHARACTER VARYING(16) NOT NULL,
    "email" CHARACTER VARYING(32) NULL,
    "created" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "company_id";
CREATE TABLE "company" (
    "id" BIGINT NOT NULL default nextval('company_id'),
    "lang_id" BIGINT NOT NULL,
    "name" CHARACTER VARYING(16) NOT NULL,
    "phone" CHARACTER VARYING(16) NOT NULL,
    "email" CHARACTER VARYING(32) NULL,
    "created" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "agent_id";
CREATE TABLE "agent" (
    "id" BIGINT NOT NULL default nextval('agent_id'),
    "lang_id" BIGINT NOT NULL,
    "name" CHARACTER VARYING(16) NOT NULL,
    "phone" CHARACTER VARYING(16) NOT NULL,
    "email" CHARACTER VARYING(32) NULL,
    "created" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    "active" BOOLEAN NOT NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "owner_id";
CREATE TABLE "owner" (
    "id" BIGINT NOT NULL default nextval('owner_id'),
    "lang_id" BIGINT NOT NULL,
    "name" CHARACTER VARYING(16) NOT NULL,
    "phone" CHARACTER VARYING(16) NOT NULL,
    "email" CHARACTER VARYING(32) NULL,
    "created" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    "proved" BOOLEAN NOT NULL,
    "code" CHARACTER VARYING(32) NULL,
    "auto_login" CHARACTER VARYING(32) NULL,
    PRIMARY KEY("id")
);
