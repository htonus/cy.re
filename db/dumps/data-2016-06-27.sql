--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- Data for Name: article; Type: TABLE DATA; Schema: public; Owner: -
--

SET SESSION AUTHORIZATION DEFAULT;

ALTER TABLE article DISABLE TRIGGER ALL;

INSERT INTO article VALUES (1, '2013-07-19 16:49:20', NULL, NULL, false, 1);


ALTER TABLE article ENABLE TRIGGER ALL;

--
-- Data for Name: article_category; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE article_category DISABLE TRIGGER ALL;

INSERT INTO article_category VALUES (1, '2016-06-20 17:48:10', NULL, NULL, NULL, 2, 3);


ALTER TABLE article_category ENABLE TRIGGER ALL;

--
-- Data for Name: language; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE language DISABLE TRIGGER ALL;

INSERT INTO language VALUES (1, 'English', 'en', 'English', true);
INSERT INTO language VALUES (2, 'Russian', 'ru', 'Русский', true);
INSERT INTO language VALUES (10, 'Chineese', 'cn', '中文简体', false);


ALTER TABLE language ENABLE TRIGGER ALL;

--
-- Data for Name: article_category_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE article_category_i18n DISABLE TRIGGER ALL;

INSERT INTO article_category_i18n VALUES (1, 1, 'about', '', 1);
INSERT INTO article_category_i18n VALUES (2, 2, '', '', 1);


ALTER TABLE article_category_i18n ENABLE TRIGGER ALL;

--
-- Name: article_category_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('article_category_i18n_id', 2, true);


--
-- Name: article_category_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('article_category_id', 1, true);


--
-- Data for Name: article_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE article_i18n DISABLE TRIGGER ALL;

INSERT INTO article_i18n VALUES (1, 1, 1, 'The acquisition of immovable property by EU citizens', '<div>The acquisition of immovable property by EU citizens</div><div>A national of an EU member country is permitted to own as much ‘immovable property’ (a term that includes both land and property) as they wish.</div><div><br></div><div>Once the Title Deeds for the property they are buying become available, they are required to provide proof of their citizenship by taking their passport to the District Lands office when they pay the Property Transfer Fees.</div>', NULL);
INSERT INTO article_i18n VALUES (3, 1, 2, '', '', NULL);


ALTER TABLE article_i18n ENABLE TRIGGER ALL;

--
-- Name: article_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('article_i18n_id', 5, true);


--
-- Name: article_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('article_id', 3, true);


--
-- Data for Name: article_picture; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE article_picture DISABLE TRIGGER ALL;



ALTER TABLE article_picture ENABLE TRIGGER ALL;

--
-- Data for Name: article_realty; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE article_realty DISABLE TRIGGER ALL;



ALTER TABLE article_realty ENABLE TRIGGER ALL;

--
-- Data for Name: article_type; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE article_type DISABLE TRIGGER ALL;

INSERT INTO article_type VALUES (1, 'information');
INSERT INTO article_type VALUES (2, 'project');
INSERT INTO article_type VALUES (3, 'about');


ALTER TABLE article_type ENABLE TRIGGER ALL;

--
-- Data for Name: city; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE city DISABLE TRIGGER ALL;

INSERT INTO city VALUES (1, 35.145214, 33.377237, NULL, 'NI', 1);
INSERT INTO city VALUES (2, 0.000000, 0.000000, NULL, 'LI', 1);
INSERT INTO city VALUES (3, 0.000000, 0.000000, NULL, 'LA', 1);
INSERT INTO city VALUES (4, 0.000000, 0.000000, NULL, 'PA', 1);
INSERT INTO city VALUES (10, 35.038887, 34.036160, NULL, 'FA', 1);
INSERT INTO city VALUES (12, 35.033440, 32.433357, NULL, 'PO', 1);
INSERT INTO city VALUES (13, NULL, NULL, 2, NULL, 1);
INSERT INTO city VALUES (14, NULL, NULL, 2, NULL, 1);
INSERT INTO city VALUES (15, NULL, NULL, 2, NULL, 1);
INSERT INTO city VALUES (16, NULL, NULL, 2, NULL, 1);
INSERT INTO city VALUES (17, NULL, NULL, 2, NULL, 1);
INSERT INTO city VALUES (18, NULL, NULL, 2, NULL, 1);
INSERT INTO city VALUES (19, NULL, NULL, 2, NULL, 1);


ALTER TABLE city ENABLE TRIGGER ALL;

--
-- Data for Name: city_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE city_i18n DISABLE TRIGGER ALL;

INSERT INTO city_i18n VALUES (1, 1, 1, 'Nicosia');
INSERT INTO city_i18n VALUES (2, 2, 1, 'Limassol');
INSERT INTO city_i18n VALUES (3, 3, 1, 'Larnaka');
INSERT INTO city_i18n VALUES (4, 4, 1, 'Paphos');
INSERT INTO city_i18n VALUES (5, 10, 1, 'Famagusta');
INSERT INTO city_i18n VALUES (7, 10, 2, 'Фамагуста');
INSERT INTO city_i18n VALUES (9, 12, 1, 'Polis');
INSERT INTO city_i18n VALUES (11, 12, 2, 'Полис');
INSERT INTO city_i18n VALUES (13, 1, 2, '');
INSERT INTO city_i18n VALUES (15, 2, 2, '');
INSERT INTO city_i18n VALUES (17, 3, 2, '');
INSERT INTO city_i18n VALUES (19, 4, 2, '');
INSERT INTO city_i18n VALUES (20, 13, 1, 'Kato Polemidia');
INSERT INTO city_i18n VALUES (22, 13, 2, '');
INSERT INTO city_i18n VALUES (23, 14, 1, 'Mouttagiaka');
INSERT INTO city_i18n VALUES (25, 14, 2, '');
INSERT INTO city_i18n VALUES (26, 15, 1, 'Moni');
INSERT INTO city_i18n VALUES (28, 15, 2, '');
INSERT INTO city_i18n VALUES (29, 16, 1, 'Agios Tychon');
INSERT INTO city_i18n VALUES (31, 16, 2, '');
INSERT INTO city_i18n VALUES (32, 17, 1, 'Kolossi');
INSERT INTO city_i18n VALUES (34, 17, 2, '');
INSERT INTO city_i18n VALUES (35, 18, 1, 'Ypsonas');
INSERT INTO city_i18n VALUES (37, 18, 2, '');
INSERT INTO city_i18n VALUES (38, 19, 1, 'Parekklisia');
INSERT INTO city_i18n VALUES (40, 19, 2, '');


ALTER TABLE city_i18n ENABLE TRIGGER ALL;

--
-- Name: city_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('city_i18n_id', 40, true);


--
-- Name: city_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('city_id', 19, true);


--
-- Data for Name: country; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE country DISABLE TRIGGER ALL;

INSERT INTO country VALUES (1, 'CY', 357);


ALTER TABLE country ENABLE TRIGGER ALL;

--
-- Data for Name: country_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE country_i18n DISABLE TRIGGER ALL;

INSERT INTO country_i18n VALUES (1, 1, 1, 'Cyprus');


ALTER TABLE country_i18n ENABLE TRIGGER ALL;

--
-- Name: country_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('country_i18n_id', 1, true);


--
-- Name: country_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('country_id', 1, true);


--
-- Data for Name: custom_type; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE custom_type DISABLE TRIGGER ALL;

INSERT INTO custom_type VALUES (1, 'carousel');
INSERT INTO custom_type VALUES (2, 'recent');
INSERT INTO custom_type VALUES (3, 'projects');


ALTER TABLE custom_type ENABLE TRIGGER ALL;

--
-- Data for Name: section; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE section DISABLE TRIGGER ALL;

INSERT INTO section VALUES (1, 'buy');
INSERT INTO section VALUES (2, 'rent');
INSERT INTO section VALUES (3, 'sell');
INSERT INTO section VALUES (4, 'lend');
INSERT INTO section VALUES (5, 'info');
INSERT INTO section VALUES (6, 'project');
INSERT INTO section VALUES (7, 'about');


ALTER TABLE section ENABLE TRIGGER ALL;

--
-- Data for Name: custom; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE custom DISABLE TRIGGER ALL;

INSERT INTO custom VALUES (3, 1, 1, '			"
		');


ALTER TABLE custom ENABLE TRIGGER ALL;

--
-- Name: custom_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('custom_id', 3, true);


--
-- Data for Name: district; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE district DISABLE TRIGGER ALL;

INSERT INTO district VALUES (1, NULL, NULL, 2);
INSERT INTO district VALUES (2, NULL, NULL, 2);
INSERT INTO district VALUES (3, NULL, NULL, 2);
INSERT INTO district VALUES (4, NULL, NULL, 2);
INSERT INTO district VALUES (5, NULL, NULL, 2);
INSERT INTO district VALUES (7, NULL, NULL, 2);
INSERT INTO district VALUES (8, NULL, NULL, 2);


ALTER TABLE district ENABLE TRIGGER ALL;

--
-- Data for Name: realty; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE realty DISABLE TRIGGER ALL;

INSERT INTO realty VALUES (26, '2016-06-20 18:06:08', '2016-06-27 13:14:14', NULL, NULL, 2, 1, 307, NULL, '{''type'':''polygon'',''points'':[[34.692463718135784,33.02771544436837],[34.69262250411806,33.028058767122275],[34.691916786309605,33.028573751253134],[34.69178446355064,33.02816605548287]]}', NULL, NULL, 5);


ALTER TABLE realty ENABLE TRIGGER ALL;

--
-- Data for Name: custom_item; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE custom_item DISABLE TRIGGER ALL;

INSERT INTO custom_item VALUES (7, 1, 3, 26, NULL, NULL);


ALTER TABLE custom_item ENABLE TRIGGER ALL;

--
-- Name: custom_item_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('custom_item_id', 7, true);


--
-- Data for Name: district_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE district_i18n DISABLE TRIGGER ALL;

INSERT INTO district_i18n VALUES (3, 1, 2, '');
INSERT INTO district_i18n VALUES (6, 2, 2, '');
INSERT INTO district_i18n VALUES (9, 3, 2, '');
INSERT INTO district_i18n VALUES (12, 4, 2, '');
INSERT INTO district_i18n VALUES (15, 5, 2, '');
INSERT INTO district_i18n VALUES (21, 7, 2, '');
INSERT INTO district_i18n VALUES (1, 1, 1, 'Limassol');
INSERT INTO district_i18n VALUES (4, 2, 1, 'Nicosia');
INSERT INTO district_i18n VALUES (7, 3, 1, 'Larnaka');
INSERT INTO district_i18n VALUES (10, 4, 1, 'Paphos');
INSERT INTO district_i18n VALUES (13, 5, 1, 'Famagusta');
INSERT INTO district_i18n VALUES (19, 7, 1, 'Polis');
INSERT INTO district_i18n VALUES (22, 8, 1, 'Ayia Napa');
INSERT INTO district_i18n VALUES (24, 8, 2, '');


ALTER TABLE district_i18n ENABLE TRIGGER ALL;

--
-- Name: district_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('district_i18n_id', 24, true);


--
-- Name: district_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('district_id', 8, true);


--
-- Data for Name: feature; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE feature DISABLE TRIGGER ALL;

INSERT INTO feature VALUES (283, 7, 26, 1);
INSERT INTO feature VALUES (284, 2, 26, 1);
INSERT INTO feature VALUES (285, 6, 26, 1);
INSERT INTO feature VALUES (286, 1, 26, 1);


ALTER TABLE feature ENABLE TRIGGER ALL;

--
-- Name: feature_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_id', 286, true);


--
-- Data for Name: feature_type_group; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE feature_type_group DISABLE TRIGGER ALL;

INSERT INTO feature_type_group VALUES (1, 'general options');
INSERT INTO feature_type_group VALUES (3, 'outdoor options');
INSERT INTO feature_type_group VALUES (2, 'indoor options');
INSERT INTO feature_type_group VALUES (4, 'distance');


ALTER TABLE feature_type_group ENABLE TRIGGER ALL;

--
-- Data for Name: unit; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE unit DISABLE TRIGGER ALL;

INSERT INTO unit VALUES (1, '&euro;', 1);
INSERT INTO unit VALUES (2, 'm<sup>2</sup>', 1);
INSERT INTO unit VALUES (3, '', 1);
INSERT INTO unit VALUES (4, '', 1);


ALTER TABLE unit ENABLE TRIGGER ALL;

--
-- Data for Name: feature_type; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE feature_type DISABLE TRIGGER ALL;

INSERT INTO feature_type VALUES (1, 1, 1, 10, '');
INSERT INTO feature_type VALUES (2, 2, 1, 10, '');
INSERT INTO feature_type VALUES (3, 3, 1, 10, '');
INSERT INTO feature_type VALUES (5, 3, 1, 10, '');
INSERT INTO feature_type VALUES (22, 4, 3, 1, '');
INSERT INTO feature_type VALUES (23, 4, 3, 1, '');
INSERT INTO feature_type VALUES (24, 4, 3, 1, '');
INSERT INTO feature_type VALUES (34, 4, 3, 1, '');
INSERT INTO feature_type VALUES (35, 4, 3, 1, '');
INSERT INTO feature_type VALUES (36, 4, 3, 1, '');
INSERT INTO feature_type VALUES (38, 4, 3, 1, '');
INSERT INTO feature_type VALUES (39, 4, 3, 1, '');
INSERT INTO feature_type VALUES (7, 1, 2, 10, '');
INSERT INTO feature_type VALUES (11, 4, 2, 1, '');
INSERT INTO feature_type VALUES (13, 4, 2, 1, '');
INSERT INTO feature_type VALUES (14, 4, 2, 1, '');
INSERT INTO feature_type VALUES (15, 4, 2, 1, '');
INSERT INTO feature_type VALUES (16, 4, 2, 1, '');
INSERT INTO feature_type VALUES (17, 4, 2, 1, '');
INSERT INTO feature_type VALUES (18, 4, 2, 1, '');
INSERT INTO feature_type VALUES (19, 4, 2, 1, '');
INSERT INTO feature_type VALUES (20, 4, 2, 1, '');
INSERT INTO feature_type VALUES (25, 4, 2, 1, '');
INSERT INTO feature_type VALUES (27, 4, 2, 1, '');
INSERT INTO feature_type VALUES (21, 4, 2, 1, '');
INSERT INTO feature_type VALUES (26, 4, 2, 1, '');
INSERT INTO feature_type VALUES (28, 4, 2, 1, '');
INSERT INTO feature_type VALUES (29, 4, 2, 1, '');
INSERT INTO feature_type VALUES (30, 4, 2, 1, '');
INSERT INTO feature_type VALUES (31, 4, 2, 1, '');
INSERT INTO feature_type VALUES (33, 4, 2, 1, '');
INSERT INTO feature_type VALUES (10, 4, 2, 1, '');
INSERT INTO feature_type VALUES (37, 4, 2, 1, '');
INSERT INTO feature_type VALUES (42, 4, 2, 1, '');
INSERT INTO feature_type VALUES (43, 4, 2, 1, '');
INSERT INTO feature_type VALUES (6, 1, 1, 10, NULL);
INSERT INTO feature_type VALUES (4, 3, 1, 10, NULL);
INSERT INTO feature_type VALUES (41, 4, 3, 10, NULL);


ALTER TABLE feature_type ENABLE TRIGGER ALL;

--
-- Data for Name: feature_type_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE feature_type_i18n DISABLE TRIGGER ALL;

INSERT INTO feature_type_i18n VALUES (1, 1, 1, 'price');
INSERT INTO feature_type_i18n VALUES (2, 2, 1, 'area');
INSERT INTO feature_type_i18n VALUES (3, 3, 1, 'bedrooms');
INSERT INTO feature_type_i18n VALUES (5, 5, 1, 'parking lots');
INSERT INTO feature_type_i18n VALUES (6, 6, 1, 'monthly price');
INSERT INTO feature_type_i18n VALUES (7, 7, 1, 'daily price');
INSERT INTO feature_type_i18n VALUES (8, 10, 2, '');
INSERT INTO feature_type_i18n VALUES (9, 10, 10, '');
INSERT INTO feature_type_i18n VALUES (10, 4, 10, '');
INSERT INTO feature_type_i18n VALUES (11, 4, 2, '');
INSERT INTO feature_type_i18n VALUES (12, 11, 1, 'dish washer');
INSERT INTO feature_type_i18n VALUES (14, 11, 2, '');
INSERT INTO feature_type_i18n VALUES (16, 13, 1, 'electric fan oven');
INSERT INTO feature_type_i18n VALUES (18, 13, 2, '');
INSERT INTO feature_type_i18n VALUES (21, 14, 2, 'Электроплита');
INSERT INTO feature_type_i18n VALUES (24, 15, 2, 'Вытяжка');
INSERT INTO feature_type_i18n VALUES (27, 16, 2, 'Газовая плита');
INSERT INTO feature_type_i18n VALUES (30, 17, 2, 'Газовая духовка');
INSERT INTO feature_type_i18n VALUES (33, 18, 2, 'Галогенная плита');
INSERT INTO feature_type_i18n VALUES (36, 19, 2, ' СВЧ');
INSERT INTO feature_type_i18n VALUES (39, 20, 2, 'Холодильник');
INSERT INTO feature_type_i18n VALUES (42, 21, 2, 'Стиральная машина');
INSERT INTO feature_type_i18n VALUES (13, 11, 10, 'Πλυντήριο πιάτων');
INSERT INTO feature_type_i18n VALUES (17, 13, 10, ' ΗΛΕΚΤΡΙΚΟΣ ΦΟΥΡΝΟΣ FAN');
INSERT INTO feature_type_i18n VALUES (20, 14, 10, 'Ηλεκτρικές εστίες');
INSERT INTO feature_type_i18n VALUES (23, 15, 10, 'Απορροφητήρα');
INSERT INTO feature_type_i18n VALUES (26, 16, 10, 'Εστίες αερίου');
INSERT INTO feature_type_i18n VALUES (29, 17, 10, 'Φούρνος γκαζιού');
INSERT INTO feature_type_i18n VALUES (32, 18, 10, 'Εστία αλογόνου');
INSERT INTO feature_type_i18n VALUES (35, 19, 10, 'ΜΙΚΡΟΚΥΜΑΤΩΝ');
INSERT INTO feature_type_i18n VALUES (38, 20, 10, 'Ψυγείο');
INSERT INTO feature_type_i18n VALUES (41, 21, 10, 'Πλυντήριο ρούχων');
INSERT INTO feature_type_i18n VALUES (43, 22, 1, 'Covered parking');
INSERT INTO feature_type_i18n VALUES (44, 22, 10, '');
INSERT INTO feature_type_i18n VALUES (45, 22, 2, '');
INSERT INTO feature_type_i18n VALUES (46, 23, 1, 'Swiming Pool');
INSERT INTO feature_type_i18n VALUES (47, 23, 10, '');
INSERT INTO feature_type_i18n VALUES (48, 23, 2, '');
INSERT INTO feature_type_i18n VALUES (49, 24, 1, 'Garden');
INSERT INTO feature_type_i18n VALUES (50, 24, 10, '');
INSERT INTO feature_type_i18n VALUES (51, 24, 2, '');
INSERT INTO feature_type_i18n VALUES (19, 14, 1, 'electric hob');
INSERT INTO feature_type_i18n VALUES (22, 15, 1, 'extractor fan ');
INSERT INTO feature_type_i18n VALUES (25, 16, 1, 'gas hob ');
INSERT INTO feature_type_i18n VALUES (28, 17, 1, 'gas oven');
INSERT INTO feature_type_i18n VALUES (31, 18, 1, 'halogen hob');
INSERT INTO feature_type_i18n VALUES (34, 19, 1, 'microwave ');
INSERT INTO feature_type_i18n VALUES (37, 20, 1, 'refrigerator ');
INSERT INTO feature_type_i18n VALUES (52, 25, 1, 'fireplace');
INSERT INTO feature_type_i18n VALUES (53, 25, 10, '');
INSERT INTO feature_type_i18n VALUES (54, 25, 2, '');
INSERT INTO feature_type_i18n VALUES (56, 26, 10, '');
INSERT INTO feature_type_i18n VALUES (57, 26, 2, '');
INSERT INTO feature_type_i18n VALUES (58, 27, 1, 'provision for A/C  ');
INSERT INTO feature_type_i18n VALUES (59, 27, 10, '');
INSERT INTO feature_type_i18n VALUES (60, 27, 2, '');
INSERT INTO feature_type_i18n VALUES (40, 21, 1, ' Washing machine ');
INSERT INTO feature_type_i18n VALUES (55, 26, 1, ' Double glazing ');
INSERT INTO feature_type_i18n VALUES (61, 28, 1, 'Underfloor heating');
INSERT INTO feature_type_i18n VALUES (62, 28, 10, '');
INSERT INTO feature_type_i18n VALUES (63, 28, 2, '');
INSERT INTO feature_type_i18n VALUES (65, 29, 10, '');
INSERT INTO feature_type_i18n VALUES (66, 29, 2, '');
INSERT INTO feature_type_i18n VALUES (64, 29, 1, 'Air conditioner');
INSERT INTO feature_type_i18n VALUES (67, 30, 1, 'Ceiling fans');
INSERT INTO feature_type_i18n VALUES (68, 30, 10, '');
INSERT INTO feature_type_i18n VALUES (69, 30, 2, '');
INSERT INTO feature_type_i18n VALUES (70, 31, 1, 'Double garage');
INSERT INTO feature_type_i18n VALUES (71, 31, 10, '');
INSERT INTO feature_type_i18n VALUES (72, 31, 2, '');
INSERT INTO feature_type_i18n VALUES (74, 33, 1, 'Shoot for clothes to laundry ');
INSERT INTO feature_type_i18n VALUES (75, 33, 10, '');
INSERT INTO feature_type_i18n VALUES (76, 33, 2, '');
INSERT INTO feature_type_i18n VALUES (77, 34, 1, 'Garden shed');
INSERT INTO feature_type_i18n VALUES (78, 34, 10, '');
INSERT INTO feature_type_i18n VALUES (79, 34, 2, '');
INSERT INTO feature_type_i18n VALUES (80, 35, 1, 'Tool room');
INSERT INTO feature_type_i18n VALUES (81, 35, 10, '');
INSERT INTO feature_type_i18n VALUES (82, 35, 2, '');
INSERT INTO feature_type_i18n VALUES (83, 36, 1, 'Barbecue area');
INSERT INTO feature_type_i18n VALUES (84, 36, 10, '');
INSERT INTO feature_type_i18n VALUES (85, 36, 2, '');
INSERT INTO feature_type_i18n VALUES (86, 37, 1, 'Central vacuum system');
INSERT INTO feature_type_i18n VALUES (87, 37, 10, '');
INSERT INTO feature_type_i18n VALUES (88, 37, 2, '');
INSERT INTO feature_type_i18n VALUES (89, 38, 1, 'Double garage');
INSERT INTO feature_type_i18n VALUES (90, 38, 10, '');
INSERT INTO feature_type_i18n VALUES (91, 38, 2, '');
INSERT INTO feature_type_i18n VALUES (93, 39, 10, '');
INSERT INTO feature_type_i18n VALUES (94, 39, 2, '');
INSERT INTO feature_type_i18n VALUES (92, 39, 1, 'Balcony');
INSERT INTO feature_type_i18n VALUES (98, 41, 1, 'Sea view');
INSERT INTO feature_type_i18n VALUES (99, 41, 10, '');
INSERT INTO feature_type_i18n VALUES (100, 41, 2, '');
INSERT INTO feature_type_i18n VALUES (101, 42, 1, 'Sea view');
INSERT INTO feature_type_i18n VALUES (102, 42, 10, '');
INSERT INTO feature_type_i18n VALUES (103, 42, 2, '');
INSERT INTO feature_type_i18n VALUES (104, 43, 1, 'Jacuzzi');
INSERT INTO feature_type_i18n VALUES (105, 43, 10, '');
INSERT INTO feature_type_i18n VALUES (106, 43, 2, '');
INSERT INTO feature_type_i18n VALUES (107, 6, 2, '');
INSERT INTO feature_type_i18n VALUES (108, 6, 10, '');
INSERT INTO feature_type_i18n VALUES (4, 4, 1, 'toilets');


ALTER TABLE feature_type_i18n ENABLE TRIGGER ALL;

--
-- Name: feature_type_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_type_i18n_id', 108, true);


--
-- Name: feature_type_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_type_id', 43, true);


--
-- Data for Name: group; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE "group" DISABLE TRIGGER ALL;

INSERT INTO "group" VALUES (2, 'Users', 'User and access management');
INSERT INTO "group" VALUES (4, 'Editor', 'Acces to create and update Realty, Article and News');
INSERT INTO "group" VALUES (1, 'Setup', 'Access to set up dictionaries');
INSERT INTO "group" VALUES (3, 'Moderator', 'Update and publish');


ALTER TABLE "group" ENABLE TRIGGER ALL;

--
-- Data for Name: resource_type; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE resource_type DISABLE TRIGGER ALL;

INSERT INTO resource_type VALUES (1, 'object');


ALTER TABLE resource_type ENABLE TRIGGER ALL;

--
-- Data for Name: resource; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE resource DISABLE TRIGGER ALL;

INSERT INTO resource VALUES (1, 'Language', 1);
INSERT INTO resource VALUES (2, 'Unit', 1);
INSERT INTO resource VALUES (3, 'FeatureType', 1);
INSERT INTO resource VALUES (4, 'RealtyType', 1);
INSERT INTO resource VALUES (5, 'Resource', 1);
INSERT INTO resource VALUES (6, 'Group', 1);
INSERT INTO resource VALUES (7, 'Person', 1);
INSERT INTO resource VALUES (8, 'Realty', 1);
INSERT INTO resource VALUES (9, 'City', 1);
INSERT INTO resource VALUES (10, 'Article', 1);
INSERT INTO resource VALUES (11, 'District', 1);


ALTER TABLE resource ENABLE TRIGGER ALL;

--
-- Data for Name: group_access; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE group_access DISABLE TRIGGER ALL;



ALTER TABLE group_access ENABLE TRIGGER ALL;

--
-- Name: group_access_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('group_access_id', 22, true);


--
-- Name: group_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('group_id', 4, true);


--
-- Name: language_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('language_id', 10, true);


--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE news DISABLE TRIGGER ALL;



ALTER TABLE news ENABLE TRIGGER ALL;

--
-- Data for Name: news_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE news_i18n DISABLE TRIGGER ALL;



ALTER TABLE news_i18n ENABLE TRIGGER ALL;

--
-- Name: news_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('news_i18n_id', 1, false);


--
-- Name: news_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('news_id', 1, false);


--
-- Data for Name: news_picture; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE news_picture DISABLE TRIGGER ALL;



ALTER TABLE news_picture ENABLE TRIGGER ALL;

--
-- Data for Name: person_status; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE person_status DISABLE TRIGGER ALL;

INSERT INTO person_status VALUES (1, 'No access');
INSERT INTO person_status VALUES (2, 'Readonly');
INSERT INTO person_status VALUES (3, 'Normal');
INSERT INTO person_status VALUES (4, 'Admin');
INSERT INTO person_status VALUES (5, 'Full access');


ALTER TABLE person_status ENABLE TRIGGER ALL;

--
-- Data for Name: person; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE person DISABLE TRIGGER ALL;

INSERT INTO person VALUES (1, '2016-06-20 10:55:17.14858', 'Mikhail', 'Cherviakov', 5, 'htonus@cyprus-realty.com', 'htonus', '28f9e86b0d5f5739612a7fda378ade96f0c30ac9', NULL, NULL, NULL);
INSERT INTO person VALUES (4, '2016-06-20 16:02:15', 'nobody', 'nobody', 2, 'nobody@gmail.com', 'nobody', '9ac20922b054316be23842a5bca7d69f29f69d77', NULL, NULL, NULL);
INSERT INTO person VALUES (5, '2016-06-20 18:06:08', '', '', 3, '', NULL, NULL, NULL, '', NULL);


ALTER TABLE person ENABLE TRIGGER ALL;

--
-- Data for Name: person_group; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE person_group DISABLE TRIGGER ALL;



ALTER TABLE person_group ENABLE TRIGGER ALL;

--
-- Name: person_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('person_id', 5, true);


--
-- Name: picture_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('picture_id', 311, true);


--
-- Data for Name: realty_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE realty_i18n DISABLE TRIGGER ALL;

INSERT INTO realty_i18n VALUES (76, 26, 1, '', '');
INSERT INTO realty_i18n VALUES (77, 26, 2, '', '');


ALTER TABLE realty_i18n ENABLE TRIGGER ALL;

--
-- Name: realty_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_i18n_id', 77, true);


--
-- Name: realty_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_id', 26, true);


--
-- Data for Name: realty_picture; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE realty_picture DISABLE TRIGGER ALL;

INSERT INTO realty_picture VALUES (308, 26, 2, '1.jpg', false, 115303, 940, 625, NULL, 5);
INSERT INTO realty_picture VALUES (309, 26, 2, '3.jpg', false, 215547, 940, 1253, NULL, 4);
INSERT INTO realty_picture VALUES (310, 26, 2, '5.jpg', false, 151016, 940, 627, NULL, 3);
INSERT INTO realty_picture VALUES (311, 26, 2, '4.jpg', false, 154481, 940, 628, NULL, 2);
INSERT INTO realty_picture VALUES (307, 26, 2, '2.jpg', false, 172959, 940, 627, 'REALTYPICTURE307', 1);


ALTER TABLE realty_picture ENABLE TRIGGER ALL;

--
-- Data for Name: realty_type; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE realty_type DISABLE TRIGGER ALL;

INSERT INTO realty_type VALUES (12, NULL, NULL);
INSERT INTO realty_type VALUES (13, NULL, NULL);
INSERT INTO realty_type VALUES (16, NULL, NULL);
INSERT INTO realty_type VALUES (19, NULL, NULL);
INSERT INTO realty_type VALUES (22, NULL, NULL);
INSERT INTO realty_type VALUES (17, NULL, NULL);
INSERT INTO realty_type VALUES (10, 'B', NULL);
INSERT INTO realty_type VALUES (11, 'L', NULL);
INSERT INTO realty_type VALUES (14, 'F', NULL);
INSERT INTO realty_type VALUES (18, 'S', NULL);
INSERT INTO realty_type VALUES (21, 'V', NULL);
INSERT INTO realty_type VALUES (26, 'B', NULL);
INSERT INTO realty_type VALUES (27, NULL, NULL);
INSERT INTO realty_type VALUES (1, 'H', NULL);
INSERT INTO realty_type VALUES (2, 'A', NULL);


ALTER TABLE realty_type ENABLE TRIGGER ALL;

--
-- Data for Name: realty_type_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE realty_type_i18n DISABLE TRIGGER ALL;

INSERT INTO realty_type_i18n VALUES (1, 1, 1, 'house');
INSERT INTO realty_type_i18n VALUES (2, 2, 1, 'appartments');
INSERT INTO realty_type_i18n VALUES (3, 10, 1, 'bungalow');
INSERT INTO realty_type_i18n VALUES (4, 10, 10, '');
INSERT INTO realty_type_i18n VALUES (5, 10, 2, '');
INSERT INTO realty_type_i18n VALUES (6, 11, 1, 'land');
INSERT INTO realty_type_i18n VALUES (7, 11, 10, '');
INSERT INTO realty_type_i18n VALUES (8, 11, 2, '');
INSERT INTO realty_type_i18n VALUES (9, 12, 1, 'maisonette');
INSERT INTO realty_type_i18n VALUES (10, 12, 10, '');
INSERT INTO realty_type_i18n VALUES (11, 12, 2, '');
INSERT INTO realty_type_i18n VALUES (12, 13, 1, 'mobile home');
INSERT INTO realty_type_i18n VALUES (13, 13, 10, '');
INSERT INTO realty_type_i18n VALUES (14, 13, 2, '');
INSERT INTO realty_type_i18n VALUES (15, 14, 1, 'office');
INSERT INTO realty_type_i18n VALUES (16, 14, 10, '');
INSERT INTO realty_type_i18n VALUES (17, 14, 2, '');
INSERT INTO realty_type_i18n VALUES (21, 16, 1, 'penthouse');
INSERT INTO realty_type_i18n VALUES (22, 16, 10, '');
INSERT INTO realty_type_i18n VALUES (23, 16, 2, '');
INSERT INTO realty_type_i18n VALUES (24, 17, 1, 'plot');
INSERT INTO realty_type_i18n VALUES (26, 17, 2, '');
INSERT INTO realty_type_i18n VALUES (27, 18, 1, 'shop');
INSERT INTO realty_type_i18n VALUES (28, 18, 10, '');
INSERT INTO realty_type_i18n VALUES (29, 18, 2, '');
INSERT INTO realty_type_i18n VALUES (30, 19, 1, 'showroom');
INSERT INTO realty_type_i18n VALUES (31, 19, 10, '');
INSERT INTO realty_type_i18n VALUES (32, 19, 2, '');
INSERT INTO realty_type_i18n VALUES (36, 21, 1, 'villa');
INSERT INTO realty_type_i18n VALUES (37, 21, 10, '');
INSERT INTO realty_type_i18n VALUES (38, 21, 2, '');
INSERT INTO realty_type_i18n VALUES (39, 22, 1, 'village house');
INSERT INTO realty_type_i18n VALUES (40, 22, 10, '');
INSERT INTO realty_type_i18n VALUES (41, 22, 2, '');
INSERT INTO realty_type_i18n VALUES (42, 1, 10, '');
INSERT INTO realty_type_i18n VALUES (43, 1, 2, 'Дом');
INSERT INTO realty_type_i18n VALUES (44, 2, 10, '');
INSERT INTO realty_type_i18n VALUES (45, 2, 2, '');
INSERT INTO realty_type_i18n VALUES (25, 17, 10, 'Οικόπεδα');
INSERT INTO realty_type_i18n VALUES (54, 26, 2, '');
INSERT INTO realty_type_i18n VALUES (55, 26, 10, '');
INSERT INTO realty_type_i18n VALUES (53, 26, 1, 'business');
INSERT INTO realty_type_i18n VALUES (57, 27, 10, '');
INSERT INTO realty_type_i18n VALUES (58, 27, 2, '');
INSERT INTO realty_type_i18n VALUES (56, 27, 1, 'studio');


ALTER TABLE realty_type_i18n ENABLE TRIGGER ALL;

--
-- Name: realty_type_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_type_i18n_id', 58, true);


--
-- Name: realty_type_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_type_id', 27, true);


--
-- Data for Name: region; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE region DISABLE TRIGGER ALL;

INSERT INTO region VALUES (1, NULL, NULL, 1);
INSERT INTO region VALUES (2, NULL, NULL, 1);


ALTER TABLE region ENABLE TRIGGER ALL;

--
-- Data for Name: region_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE region_i18n DISABLE TRIGGER ALL;

INSERT INTO region_i18n VALUES (1, 1, 1, 'Limassol');
INSERT INTO region_i18n VALUES (2, 1, 2, '');
INSERT INTO region_i18n VALUES (3, 2, 1, 'Nicosia');
INSERT INTO region_i18n VALUES (4, 2, 2, '');


ALTER TABLE region_i18n ENABLE TRIGGER ALL;

--
-- Name: region_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('region_i18n_id', 4, true);


--
-- Name: region_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('region_id', 2, true);


--
-- Name: resource_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('resource_id', 11, true);


--
-- Data for Name: static_type; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE static_type DISABLE TRIGGER ALL;

INSERT INTO static_type VALUES (1, 'about');
INSERT INTO static_type VALUES (2, 'contact');
INSERT INTO static_type VALUES (3, 'twitter');
INSERT INTO static_type VALUES (4, 'legal');
INSERT INTO static_type VALUES (5, 'phone');
INSERT INTO static_type VALUES (6, 'email');
INSERT INTO static_type VALUES (7, 'address');
INSERT INTO static_type VALUES (8, 'company');


ALTER TABLE static_type ENABLE TRIGGER ALL;

--
-- Data for Name: static_page; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE static_page DISABLE TRIGGER ALL;

INSERT INTO static_page VALUES (5, 1, NULL);
INSERT INTO static_page VALUES (6, 2, NULL);
INSERT INTO static_page VALUES (7, 7, NULL);


ALTER TABLE static_page ENABLE TRIGGER ALL;

--
-- Data for Name: static_page_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE static_page_i18n DISABLE TRIGGER ALL;

INSERT INTO static_page_i18n VALUES (11, 5, 1, 'About', 'About', '');
INSERT INTO static_page_i18n VALUES (12, 5, 2, 'О нас', 'О нас', 'О нас');
INSERT INTO static_page_i18n VALUES (13, 6, 1, 'Contact', 'Contact', '');
INSERT INTO static_page_i18n VALUES (14, 6, 2, '', '', '');
INSERT INTO static_page_i18n VALUES (15, 7, 1, 'Address', 'Address', '');
INSERT INTO static_page_i18n VALUES (16, 7, 2, '', '', '');


ALTER TABLE static_page_i18n ENABLE TRIGGER ALL;

--
-- Name: static_page_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('static_page_i18n_id', 16, true);


--
-- Name: static_page_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('static_page_id', 7, true);


--
-- Data for Name: token; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE token DISABLE TRIGGER ALL;

INSERT INTO token VALUES (1, 'BUY', NULL, NULL);
INSERT INTO token VALUES (2, 'RENT', NULL, NULL);
INSERT INTO token VALUES (3, 'INDOOR', NULL, NULL);
INSERT INTO token VALUES (4, 'OUTDOOR', NULL, NULL);
INSERT INTO token VALUES (5, 'GENERAL', NULL, NULL);
INSERT INTO token VALUES (21, 'REALTYPICTURE307', 'RealtyPicture', 307);
INSERT INTO token VALUES (22, 'ANY', NULL, NULL);
INSERT INTO token VALUES (6, 'LIST-TYPE-1', NULL, NULL);
INSERT INTO token VALUES (7, 'LIST-TYPE-2', NULL, NULL);
INSERT INTO token VALUES (8, 'LIST-TYPE-3', NULL, NULL);
INSERT INTO token VALUES (9, 'LIST-TYPE-4', NULL, NULL);
INSERT INTO token VALUES (10, 'LIST-TYPE-5', NULL, NULL);
INSERT INTO token VALUES (11, 'ESPERIA-COMPANY', NULL, NULL);
INSERT INTO token VALUES (12, 'TTL-CONTACT-INFO', NULL, NULL);
INSERT INTO token VALUES (13, 'TTL-LEGAL-INFO', NULL, NULL);
INSERT INTO token VALUES (14, 'TTL-ESPERIA-COMPANY', NULL, NULL);
INSERT INTO token VALUES (15, 'TTL-FOLLOW-US', NULL, NULL);
INSERT INTO token VALUES (16, 'TTL-TWITTER-FEED', NULL, NULL);
INSERT INTO token VALUES (17, 'ABOUT-US', NULL, NULL);
INSERT INTO token VALUES (18, 'TWEET-NOTE', NULL, NULL);
INSERT INTO token VALUES (19, 'TTL-RECENT', NULL, NULL);
INSERT INTO token VALUES (20, 'TTL-SUBMIT', NULL, NULL);


ALTER TABLE token ENABLE TRIGGER ALL;

--
-- Data for Name: token_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE token_i18n DISABLE TRIGGER ALL;

INSERT INTO token_i18n VALUES (1, 1, 1, 'buy');
INSERT INTO token_i18n VALUES (2, 2, 1, 'rent');
INSERT INTO token_i18n VALUES (3, 3, 1, 'indoor options');
INSERT INTO token_i18n VALUES (4, 4, 1, 'outdoor features');
INSERT INTO token_i18n VALUES (5, 5, 1, 'general features');
INSERT INTO token_i18n VALUES (76, 21, 1, 'aaaa ssss ddd');
INSERT INTO token_i18n VALUES (77, 21, 2, '');
INSERT INTO token_i18n VALUES (78, 22, 1, 'Any');
INSERT INTO token_i18n VALUES (79, 22, 2, 'Любой');
INSERT INTO token_i18n VALUES (31, 6, 1, 'Big preview list');
INSERT INTO token_i18n VALUES (32, 6, 10, '');
INSERT INTO token_i18n VALUES (33, 6, 2, '');
INSERT INTO token_i18n VALUES (34, 7, 1, '2 columns');
INSERT INTO token_i18n VALUES (35, 7, 10, '');
INSERT INTO token_i18n VALUES (36, 7, 2, '');
INSERT INTO token_i18n VALUES (37, 8, 1, '3 columns');
INSERT INTO token_i18n VALUES (38, 8, 10, '');
INSERT INTO token_i18n VALUES (39, 8, 2, '');
INSERT INTO token_i18n VALUES (40, 9, 1, '4 columns');
INSERT INTO token_i18n VALUES (41, 9, 10, '');
INSERT INTO token_i18n VALUES (42, 9, 2, '');
INSERT INTO token_i18n VALUES (43, 10, 1, 'Simple list');
INSERT INTO token_i18n VALUES (44, 10, 10, '');
INSERT INTO token_i18n VALUES (45, 10, 2, '');
INSERT INTO token_i18n VALUES (46, 11, 1, 'Members of: The International Real Estate Federation, The Cyprus Real Estate Agents Association, Association of Cyprus Travel Agents, The Cyprus Chamber of Commerce and Industry, The Technical Chamber of Cyprus (ETEK), The Institution of Civil Engineers, The Cyprus Institute of Civil Engineers, The Cyprus Institute of Architects and Civil Engineers');
INSERT INTO token_i18n VALUES (47, 11, 10, '');
INSERT INTO token_i18n VALUES (48, 11, 2, '');
INSERT INTO token_i18n VALUES (49, 12, 1, 'Contact information');
INSERT INTO token_i18n VALUES (50, 12, 10, '');
INSERT INTO token_i18n VALUES (51, 12, 2, '');
INSERT INTO token_i18n VALUES (52, 13, 1, 'Legal info');
INSERT INTO token_i18n VALUES (53, 13, 10, '');
INSERT INTO token_i18n VALUES (54, 13, 2, '');
INSERT INTO token_i18n VALUES (55, 14, 1, 'Esperia Company');
INSERT INTO token_i18n VALUES (56, 14, 10, '');
INSERT INTO token_i18n VALUES (57, 14, 2, '');
INSERT INTO token_i18n VALUES (58, 15, 1, 'Follow Us');
INSERT INTO token_i18n VALUES (59, 15, 10, '');
INSERT INTO token_i18n VALUES (60, 15, 2, '');
INSERT INTO token_i18n VALUES (61, 16, 1, 'Twitter Feed');
INSERT INTO token_i18n VALUES (62, 16, 10, '');
INSERT INTO token_i18n VALUES (63, 16, 2, '');
INSERT INTO token_i18n VALUES (64, 17, 1, 'About Us');
INSERT INTO token_i18n VALUES (65, 17, 10, '');
INSERT INTO token_i18n VALUES (66, 17, 2, '');
INSERT INTO token_i18n VALUES (67, 18, 1, 'Find out what''s happening, right now, with the people and organizations you care about.');
INSERT INTO token_i18n VALUES (68, 18, 10, '');
INSERT INTO token_i18n VALUES (69, 18, 2, '');
INSERT INTO token_i18n VALUES (70, 19, 1, 'Recent offers');
INSERT INTO token_i18n VALUES (71, 19, 10, '');
INSERT INTO token_i18n VALUES (72, 19, 2, '');
INSERT INTO token_i18n VALUES (73, 20, 1, 'Submit');
INSERT INTO token_i18n VALUES (74, 20, 10, '');
INSERT INTO token_i18n VALUES (75, 20, 2, 'Отправить');


ALTER TABLE token_i18n ENABLE TRIGGER ALL;

--
-- Name: token_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('token_i18n_id', 79, true);


--
-- Name: token_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('token_id', 22, true);


--
-- Data for Name: unit_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

ALTER TABLE unit_i18n DISABLE TRIGGER ALL;

INSERT INTO unit_i18n VALUES (1, 1, 1, 'money');
INSERT INTO unit_i18n VALUES (2, 2, 1, 'area');
INSERT INTO unit_i18n VALUES (3, 3, 1, 'quantity');
INSERT INTO unit_i18n VALUES (4, 4, 1, 'flag');


ALTER TABLE unit_i18n ENABLE TRIGGER ALL;

--
-- Name: unit_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('unit_i18n_id', 8, true);


--
-- Name: unit_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('unit_id', 10, false);


--
-- PostgreSQL database dump complete
--

