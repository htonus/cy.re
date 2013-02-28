CREATE SEQUENCE "language_id";
CREATE TABLE "language" (
    "id" BIGINT NOT NULL default nextval('language_id'),
    "name" CHARACTER VARYING(16) NOT NULL,
    "code" CHARACTER VARYING(2) NOT NULL,
    "native" CHARACTER VARYING(16) NOT NULL,
    "active" BOOLEAN NOT NULL,
    PRIMARY KEY("id")
);

CREATE SEQUENCE "unit_id";
CREATE TABLE "unit" (
    "id" BIGINT NOT NULL default nextval('unit_id'),
    "name" CHARACTER VARYING(16) NULL,
    "sign" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);

CREATE SEQUENCE "unit_i18n_id";
CREATE TABLE "unit_i18n" (
    "id" BIGINT NOT NULL default nextval('unit_i18n_id'),
    "object_id" BIGINT NOT NULL REFERENCES "unit"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" BIGINT NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);
CREATE INDEX unit_i18n_unit_id_idx ON unit_i18n(unit_id);
CREATE INDEX unit_i18n_language_id_idx ON unit_i18n(language_id);


CREATE TABLE "feature_type_group" (
    "id" BIGINT NOT NULL,
    "name" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);

CREATE SEQUENCE "feature_type_id";
CREATE TABLE "feature_type" (
    "id" BIGINT NOT NULL default nextval('feature_type_id'),
    "name" CHARACTER VARYING(16) NULL,
    "unit_id" BIGINT NOT NULL REFERENCES "unit"("id") ON UPDATE CASCADE ON DELETE CASCADE,
	"weight" INTEGER NOT NULL DEFAULT '1',
	"group" INTEGER NOT NULL REFERENCES "feature_type_group"("id") ON UPDATE CASCADE ON DELETE SET NULL,
    PRIMARY KEY("id")
);

CREATE SEQUENCE "feature_type_i18n_id";
CREATE TABLE "feature_type_i18n" (
    "id" BIGINT NOT NULL default nextval('feature_type_i18n_id'),
    "object_id" BIGINT NOT NULL REFERENCES "feature_type"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" BIGINT NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);
CREATE INDEX feature_type_i18n_object_id_idx ON feature_type_i18n(object_id);
CREATE INDEX feature_type_i18n_language_id_idx ON feature_type_i18n(language_id);
