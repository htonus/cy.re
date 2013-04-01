truncate "language" cascade;
truncate "unit" cascade;
truncate "city" cascade;
truncate "feature_type" cascade;
truncate "feature_type_group" cascade;
truncate "offer_type" cascade;
truncate "realty_type" cascade;
truncate "resource_type" cascade;
truncate "access_type" cascade;
truncate "person_status" cascade;


alter sequence "language_id" restart;
alter sequence "unit_id" restart;
alter sequence "unit_i18n_id" restart;
alter sequence "city_id" restart;
alter sequence "city_i18n_id" restart;
alter sequence "feature_id" restart;
alter sequence "feature_type_id" restart;
alter sequence "feature_type_i18n_id" restart;
alter sequence "picture_id" restart;
alter sequence "realty_type_id" restart;
alter sequence "realty_type_i18n_id" restart;
alter sequence "realty_id" restart;
alter sequence "realty_i18n_id" restart;


insert into "language" ("id", "name", "code", "native", "active") values (1, 'English', 'en', 'English', true);
insert into "language" ("id", "name", "code", "native", "active") values (2, 'Russian', 'ru', 'Русский', true);

insert into "unit" ("id", "name", "sign") values (1, 'money', '&euro;');
insert into "unit" ("id", "name", "sign") values (2, 'area', 'm<sup>2</sup>');
insert into "unit" ("id", "name", "sign") values (3, 'quantity', '');
insert into "unit" ("id", "name", "sign") values (4, 'flag', '');	-- all internal options
insert into "unit_i18n" ("object_id", "language_id", "name") select "id", 1, "name" from "unit";

insert into "city" ("id", "name", "latitude", "longitude") values (1, 'Nicosia', 35.145214, 33.377237);
insert into "city" ("id", "name", "latitude", "longitude") values (2, 'Limassol', 0, 0);
insert into "city" ("id", "name", "latitude", "longitude") values (3, 'Larnaka', 0, 0);
insert into "city" ("id", "name", "latitude", "longitude") values (4, 'Paphos', 0, 0);
insert into "city_i18n" ("object_id", "language_id", "name") select "id", 1, "name" from "city";

insert into feature_type_group (id, name) values (1, 'indoor options');
insert into feature_type_group (id, name) values (2, 'outdoor options');
insert into feature_type_group (id, name) values (3, 'general options');

insert into offer_type (id, name) values (1, 'sale');
insert into offer_type (id, name) values (2, 'rent');

insert into "feature_type" ("id", "name", "unit_id", "group_id", "weight") values (1, 'price', 1, 3, 10);
insert into "feature_type" ("id", "name", "unit_id", "group_id", "weight") values (2, 'area', 2, 3, 10);
insert into "feature_type" ("id", "name", "unit_id", "group_id", "weight") values (3, 'bedrooms', 3, 3, 10);
insert into "feature_type" ("id", "name", "unit_id", "group_id", "weight") values (4, 'toylets', 3, 3, 10);
insert into "feature_type" ("id", "name", "unit_id", "group_id", "weight") values (5, 'parking lots', 3, 3, 10);
insert into "feature_type" ("id", "name", "unit_id", "group_id", "weight") values (6, 'monthly price', 3, 3, 10);
insert into "feature_type_i18n" ("object_id", "language_id", "name") select "id", 1, "name" from "feature_type";

insert into "realty_type" ("id", "name") values (1, 'house');
insert into "realty_type" ("id", "name") values (2, 'appartments');
insert into "realty_type_i18n" ("object_id", "language_id", "name") select "id", 1, "name" from "realty_type";

insert into "token" ("name", "value") values ('SALE', 'sale');
insert into "token" ("name", "value") values ('RENT', 'rent');
insert into "token" ("name", "value") values ('INDOOR', 'indoor options');
insert into "token" ("name", "value") values ('OUTDOOR', 'outdoor features');
insert into "token" ("name", "value") values ('GENERAL', 'general features');

insert into "token_i18n" ("object_id", "language_id", "value") select "id", 1, "value" from "token";

insert into resource_type ("id", "name") values (1, 'object');

-- insert into access_type ("id", "name") values (1, 'Add');
-- insert into access_type ("id", "name") values (2, 'Edit');
-- insert into access_type ("id", "name") values (3, 'Save');
-- insert into access_type ("id", "name") values (4, 'Drop');
-- insert into access_type ("id", "name") values (5, 'Index');
-- insert into access_type ("id", "name") values (6, 'Publish');

insert into person_status ("id", "name") values (1, 'No access');
insert into person_status ("id", "name") values (2, 'Readonly');
insert into person_status ("id", "name") values (3, 'Normal');
insert into person_status ("id", "name") values (4, 'Admin');
insert into person_status ("id", "name") values (5, 'Full access');

insert into person ("name", "surname", "created", "status_id", "email", "username", "password") values ('Mikhail', 'Cherviakov', now(), 5, 'htonus@cyprus-realty.com', 'htonus', '28f9e86b0d5f5739612a7fda378ade96f0c30ac9[crcom@bravo746');

alter sequence "language_id" restart with 10;
alter sequence "unit_id" restart  with 10;
alter sequence "city_id" restart  with 10;
alter sequence "feature_type_id" restart with 10;
alter sequence "realty_type_id" restart  with 10;

