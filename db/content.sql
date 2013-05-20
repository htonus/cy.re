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
    "realty_id" BIGINT NOT NULL REFERENCES "realty"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(256) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX custom_item_custom_id_idx ON custom_item(parent_id);
CREATE INDEX custom_item_realty_id_idx ON custom_item(realty_id);
