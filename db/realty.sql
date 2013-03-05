CREATE TABLE "feature_type_group" (
    "id" INTEGER NOT NULL,
    "name" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);
insert into feature_type_group (id, name) values (1, 'indoor options');
insert into feature_type_group (id, name) values (2, 'outdoor options');
insert into feature_type_group (id, name) values (3, 'general options');


CREATE TABLE "offer_type" (
    "id" INTEGER NOT NULL,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);
insert into offer_type (id, name) values (1, 'sale');
insert into offer_type (id, name) values (2, 'rent');




CREATE SEQUENCE "feature_type_id";
CREATE TABLE "feature_type" (
    "id" INTEGER NOT NULL default nextval('feature_type_id'),
    "name" CHARACTER VARYING(16) NULL,
    "unit_id" INTEGER NULL REFERENCES "unit"("id") ON UPDATE CASCADE ON DELETE CASCADE,
	"group_id" INTEGER NULL REFERENCES "feature_type_group"("id") ON UPDATE CASCADE ON DELETE SET NULL,
	"weight" INTEGER NOT NULL DEFAULT '1',
    PRIMARY KEY("id")
);
CREATE SEQUENCE "feature_type_i18n_id";
CREATE TABLE "feature_type_i18n" (
    "id" INTEGER NOT NULL default nextval('feature_type_i18n_id'),
    "object_id" INTEGER NOT NULL REFERENCES "feature_type"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);
CREATE INDEX feature_type_i18n_object_id_idx ON feature_type_i18n(object_id);
CREATE INDEX feature_type_i18n_language_id_idx ON feature_type_i18n(language_id);
CREATE UNIQUE INDEX feature_type_i18n_object_id_language_id_uidx ON "feature_type_i18n"("object_id", "language_id");

-- The rest languages fillin with back-office editor
insert into "feature_type" ("id", "name", "unit_id", "group_id", "weight") values (1, 'price');
insert into "feature_type" ("id", "name", "unit_id", "group_id", "weight") values (1, 'area');
insert into "feature_type" ("id", "name", "unit_id", "group_id", "weight") values (1, 'bedrooms');
insert into "feature_type" ("id", "name", "unit_id", "group_id", "weight") values (1, 'toylets');
insert into "feature_type" ("id", "name", "unit_id", "group_id", "weight") values (1, 'parking lots');
insert into "feature_type" ("id", "name", "unit_id", "group_id", "weight") values (1, 'monthly price');

CREATE SEQUENCE "realty_type_id";
CREATE TABLE "realty_type" (
    "id" INTEGER NOT NULL,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);

CREATE SEQUENCE "realty_type_i18n_id";
CREATE TABLE "realty_type_i18n" (
    "id" INTEGER NOT NULL default nextval('realty_type_i18n_id'),
    "object_id" INTEGER NOT NULL REFERENCES "realty_type"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);
CREATE INDEX realty_type_i18n_object_id_idx ON realty_type_i18n(object_id);
CREATE INDEX realty_type_i18n_language_id_idx ON realty_type_i18n(language_id);
CREATE UNIQUE INDEX realty_type_i18n_object_id_language_id_uidx ON "realty_type_i18n"("object_id", "language_id");


CREATE SEQUENCE "realty_id";
CREATE TABLE "realty" (
    "id" BIGINT NOT NULL default nextval('realty_id'),
    "created" timestamp NOT NULL DEFAULT now(),
    "published" timestamp NULL,

    "name" CHARACTER VARYING(128) NULL,
    "text" CHARACTER VARYING(4096) NULL,

    "latitude" numeric(10,6) NULL,
    "longitude" numeric(10,6) NULL,

    "type_id" INTEGER NOT NULL REFERENCES "realty_type"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    "offer_id" INTEGER NOT NULL REFERENCES "offer_type"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    "city_id" INTEGER NOT NULL REFERENCES "city"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
	
    PRIMARY KEY("id")
);
CREATE INDEX realty_type_id_idx ON realty(type_id);
CREATE INDEX realty_city_id_idx ON realty(city_id);

CREATE SEQUENCE "realty_i18n_id";
CREATE TABLE "realty_i18n" (
    "id" BIGINT NOT NULL default nextval('realty_i18n_id'),
    "object_id" BIGINT NOT NULL REFERENCES "realty"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(128) NULL,
    "text" CHARACTER VARYING(4096) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX realty_i18n_object_id_idx ON realty_i18n(object_id);
CREATE INDEX realty_i18n_language_id_idx ON realty_i18n(language_id);
CREATE UNIQUE INDEX realty_i18n_object_id_language_id_uidx ON "realty_i18n"("object_id", "language_id");


CREATE SEQUENCE "feature_id";
CREATE TABLE "feature" (
    "id" BIGINT NOT NULL default nextval('feature_id'),
    "type_id" INTEGER NOT NULL REFERENCES "feature_type"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "realty_id" INTEGER NOT NULL REFERENCES "realty"("id") ON UPDATE CASCADE ON DELETE CASCADE,
	"value" BIGINT NULL,
    PRIMARY KEY("id")
);
CREATE INDEX feature_type_id_idx ON feature(type_id);
CREATE INDEX feature_realty_id_idx ON feature(realty_id);



CREATE SEQUENCE "picture_id";
CREATE TABLE "picture" (
    "id" BIGINT NOT NULL default nextval('picture_id'),
    "realty_id" BIGINT NOT NULL REFERENCES "realty"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "type_id" INTEGER NOT NULL,
    "name" CHARACTER VARYING(128) NOT NULL,
    "main" BOOLEAN NULL DEFAULT false,
	"width" INT NOT NULL,
	"height" INT NOT NULL,

    PRIMARY KEY("id")
);
CREATE INDEX picture_realty_id_idx ON picture(realty_id);
