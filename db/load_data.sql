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
truncate "token" cascade;
truncate "token_i18n" cascade;


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
alter sequence "token_id" restart;
alter sequence "token_i18n_id" restart;


insert into "language" ("id", "name", "code", "native", "active") values (1, 'English', 'en', 'English', true);
insert into "language" ("id", "name", "code", "native", "active") values (2, 'Russian', 'ru', 'Русский', true);

insert into "unit" ("id", "sign") values (1, '&euro;');
insert into "unit" ("id", "sign") values (2, 'm<sup>2</sup>');
insert into "unit" ("id", "sign") values (3, '');
insert into "unit" ("id", "sign") values (4, '');	-- all internal options

insert into "unit_i18n" ("object_id", "language_id", "name") values (1, 1, 'money');
insert into "unit_i18n" ("object_id", "language_id", "name") values (2, 1, 'area');
insert into "unit_i18n" ("object_id", "language_id", "name") values (3, 1, 'quantity');
insert into "unit_i18n" ("object_id", "language_id", "name") values (4, 1, 'flag');	-- all internal options
alter sequence "token_id" restart with 5;

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

insert into "feature_type" ("id", "unit_id", "group_id", "weight") values (1, 1, 3, 10);
insert into "feature_type" ("id", "unit_id", "group_id", "weight") values (2, 2, 3, 10);
insert into "feature_type" ("id", "unit_id", "group_id", "weight") values (3, 3, 3, 10);
insert into "feature_type" ("id", "unit_id", "group_id", "weight") values (4, 3, 3, 10);
insert into "feature_type" ("id", "unit_id", "group_id", "weight") values (5, 3, 3, 10);
insert into "feature_type" ("id", "unit_id", "group_id", "weight") values (6, 3, 3, 10);

insert into "feature_type_i18n" ("object_id", "name", "language_id") values (1, 'price', 1);
insert into "feature_type_i18n" ("object_id", "name", "language_id") values (2, 'area', 1);
insert into "feature_type_i18n" ("object_id", "name", "language_id") values (3, 'bedrooms', 1);
insert into "feature_type_i18n" ("object_id", "name", "language_id") values (4, 'toylets', 1);
insert into "feature_type_i18n" ("object_id", "name", "language_id") values (5, 'parking lots', 1);
insert into "feature_type_i18n" ("object_id", "name", "language_id") values (6, 'monthly price', 1);

insert into "realty_type" ("id", "name") values (1, 'house');
insert into "realty_type" ("id", "name") values (2, 'appartments');
insert into "realty_type_i18n" ("object_id", "language_id", "name") select "id", 1, "name" from "realty_type";

insert into "token" ("id", "name") values (1, 'BUY');
insert into "token" ("id", "name") values (2, 'RENT');
insert into "token" ("id", "name") values (3, 'INDOOR');
insert into "token" ("id", "name") values (4, 'OUTDOOR');
insert into "token" ("id", "name") values (5, 'GENERAL');

insert into "token_i18n" ("object_id", "language_id", "value") values (1, 1, 'buy');
insert into "token_i18n" ("object_id", "language_id", "value") values (2, 1, 'rent');
insert into "token_i18n" ("object_id", "language_id", "value") values (3, 1, 'indoor options');
insert into "token_i18n" ("object_id", "language_id", "value") values (4, 1, 'outdoor features');
insert into "token_i18n" ("object_id", "language_id", "value") values (5, 1, 'general features');
alter sequence "token_id" restart with 6;

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

insert into person ("name", "surname", "created", "status_id", "email", "username", "password") values ('Mikhail', 'Cherviakov', now(), 5, 'htonus@cyprus-realty.com', 'htonus', '28f9e86b0d5f5739612a7fda378ade96f0c30ac9');

insert into custom_type ("id", "name") values (1, 'carousel');
insert into custom_type ("id", "name") values (2, 'recent');
insert into "section" ("id", "name") values (1, 'buy');
insert into "section" ("id", "name") values (2, 'rent');
insert into "section" ("id", "name") values (3, 'sell');
insert into "section" ("id", "name") values (4, 'lend');
insert into "section" ("id", "name") values (5, 'info');
insert into "section" ("id", "name") values (6, 'project');
insert into "section" ("id", "name") values (7, 'about');

insert into static_type ("id", "name") values (1, 'about');
insert into static_type ("id", "name") values (2, 'contact');
insert into static_type ("id", "name") values (3, 'twitter');
insert into static_type ("id", "name") values (4, 'legal');
insert into static_type ("id", "name") values (5, 'phone');
insert into static_type ("id", "name") values (6, 'email');
insert into static_type ("id", "name") values (7, 'address');
insert into static_type ("id", "name") values (8, 'company');

insert into article_type ("id", "name") values (1, 'information');
insert into article_type ("id", "name") values (2, 'project');
insert into article_type ("id", "name") values (3, 'about');

insert into country (country_code, phone_code) values ('CY', 357);
insert into country_i18n (object_id, language_id, "name") select id, 1, 'Cyprus' from country where country_code='CY';

alter sequence "language_id" restart with 10;
alter sequence "unit_id" restart  with 10;
alter sequence "city_id" restart  with 10;
alter sequence "feature_type_id" restart with 10;
alter sequence "realty_type_id" restart  with 10;

