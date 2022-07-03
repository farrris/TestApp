--
-- PostgreSQL database dump
--

-- Dumped from database version 12.11 (Ubuntu 12.11-0ubuntu0.20.04.1)
-- Dumped by pg_dump version 14.2

-- Started on 2022-07-03 15:54:36

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 207 (class 1259 OID 57360)
-- Name: app_like; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.app_like (
    id integer NOT NULL,
    app_user_id integer NOT NULL,
    article_id integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.app_like OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 57352)
-- Name: app_like_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.app_like_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.app_like_id_seq OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 57367)
-- Name: app_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.app_user (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    app_password character varying(255) NOT NULL,
    registered_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.app_user OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 57354)
-- Name: app_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.app_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.app_user_id_seq OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 57375)
-- Name: article; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.article (
    id integer NOT NULL,
    category_id integer NOT NULL,
    author_id integer NOT NULL,
    title character varying(255) NOT NULL,
    published_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.article OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 57356)
-- Name: article_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.article_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.article_id_seq OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 57382)
-- Name: category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.category (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.category OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 57358)
-- Name: category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.category_id_seq OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 57346)
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO postgres;

--
-- TOC entry 2969 (class 0 OID 57360)
-- Dependencies: 207
-- Data for Name: app_like; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.app_like (id, app_user_id, article_id, created_at) FROM stdin;
1	4	1	2022-07-03 15:45:15
2	5	1	2022-07-03 15:45:19
3	1	1	2022-07-03 15:45:29
5	2	1	2022-07-03 15:46:07
6	2	2	2022-07-03 15:46:23
7	4	2	2022-07-03 15:46:28
8	5	2	2022-07-03 15:46:38
9	5	3	2022-07-03 15:46:43
11	1	3	2022-07-03 15:47:29
12	4	3	2022-07-03 15:50:04
\.


--
-- TOC entry 2970 (class 0 OID 57367)
-- Dependencies: 208
-- Data for Name: app_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.app_user (id, username, app_password, registered_at) FROM stdin;
1	Petya	$2y$10$a5B4.xzJWYqTZprdfk40WuHHYbtGr5Jos6Bq0ZZGQF0lu9CmfQZ7W	2022-07-03 15:36:32
2	Vasya	$2y$10$IxcKHuO4ZAzDvY.QVRqxmelC8A0tLcBJfdKloFKcMe9J6ogUD/aN2	2022-07-03 15:36:39
3	Vanya	$2y$10$WgntVu3FhfOhD8ydmQ2ZcevUb.PUd5DJBX0rgj/VhgM9LDvjd8LGe	2022-07-03 15:36:52
4	faris	$2y$10$.GckkR9.bJukODk3GmAvTOm0wMR7NacTvemXr4wNk2jy1ao8GgxMa	2022-07-03 15:37:02
5	Masha	$2y$10$E/MEVn7lyHGLapo6e3jxouwMbGMGQqtNYIdAGEtgmrcGkbnFG2cou	2022-07-03 15:37:09
\.


--
-- TOC entry 2971 (class 0 OID 57375)
-- Dependencies: 209
-- Data for Name: article; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.article (id, category_id, author_id, title, published_at) FROM stdin;
1	1	4	Пылесос	2022-07-03 15:37:20
2	1	1	Стиральная машина	2022-07-03 15:37:36
3	1	5	Ноутбуки Lenovo	2022-07-03 15:37:50
4	1	2	Iphone	2022-07-03 15:38:03
5	2	2	Лев	2022-07-03 15:38:24
6	2	4	Овца	2022-07-03 15:38:35
7	2	5	Свинья	2022-07-03 15:38:50
8	2	2	Курица	2022-07-03 15:39:10
9	3	4	Аномальная жара	2022-07-03 15:41:18
10	3	5	Землетрясения	2022-07-03 15:41:36
11	3	3	Ураганы	2022-07-03 15:41:48
\.


--
-- TOC entry 2972 (class 0 OID 57382)
-- Dependencies: 210
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.category (id, title, created_at) FROM stdin;
1	Электроника	2022-07-03 15:34:39
2	Животные	2022-07-03 15:34:46
3	Природа	2022-07-03 15:34:56
\.


--
-- TOC entry 2964 (class 0 OID 57346)
-- Dependencies: 202
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20220703123311	2022-07-03 15:33:24	86
\.


--
-- TOC entry 2978 (class 0 OID 0)
-- Dependencies: 203
-- Name: app_like_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.app_like_id_seq', 12, true);


--
-- TOC entry 2979 (class 0 OID 0)
-- Dependencies: 204
-- Name: app_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.app_user_id_seq', 5, true);


--
-- TOC entry 2980 (class 0 OID 0)
-- Dependencies: 205
-- Name: article_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.article_id_seq', 11, true);


--
-- TOC entry 2981 (class 0 OID 0)
-- Dependencies: 206
-- Name: category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.category_id_seq', 6, true);


--
-- TOC entry 2823 (class 2606 OID 57364)
-- Name: app_like app_like_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.app_like
    ADD CONSTRAINT app_like_pkey PRIMARY KEY (id);


--
-- TOC entry 2827 (class 2606 OID 57374)
-- Name: app_user app_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.app_user
    ADD CONSTRAINT app_user_pkey PRIMARY KEY (id);


--
-- TOC entry 2829 (class 2606 OID 57379)
-- Name: article article_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_pkey PRIMARY KEY (id);


--
-- TOC entry 2833 (class 2606 OID 57386)
-- Name: category category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (id);


--
-- TOC entry 2821 (class 2606 OID 57351)
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- TOC entry 2830 (class 1259 OID 57380)
-- Name: idx_23a0e6612469de2; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_23a0e6612469de2 ON public.article USING btree (category_id);


--
-- TOC entry 2831 (class 1259 OID 57381)
-- Name: idx_23a0e66f675f31b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_23a0e66f675f31b ON public.article USING btree (author_id);


--
-- TOC entry 2824 (class 1259 OID 57365)
-- Name: idx_a94d65134a3353d8; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a94d65134a3353d8 ON public.app_like USING btree (app_user_id);


--
-- TOC entry 2825 (class 1259 OID 57366)
-- Name: idx_a94d65137294869c; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a94d65137294869c ON public.app_like USING btree (article_id);


--
-- TOC entry 2836 (class 2606 OID 57397)
-- Name: article fk_23a0e6612469de2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT fk_23a0e6612469de2 FOREIGN KEY (category_id) REFERENCES public.category(id);


--
-- TOC entry 2837 (class 2606 OID 57402)
-- Name: article fk_23a0e66f675f31b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT fk_23a0e66f675f31b FOREIGN KEY (author_id) REFERENCES public.app_user(id);


--
-- TOC entry 2834 (class 2606 OID 57387)
-- Name: app_like fk_a94d65134a3353d8; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.app_like
    ADD CONSTRAINT fk_a94d65134a3353d8 FOREIGN KEY (app_user_id) REFERENCES public.app_user(id);


--
-- TOC entry 2835 (class 2606 OID 57392)
-- Name: app_like fk_a94d65137294869c; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.app_like
    ADD CONSTRAINT fk_a94d65137294869c FOREIGN KEY (article_id) REFERENCES public.article(id);


-- Completed on 2022-07-03 15:54:36

--
-- PostgreSQL database dump complete
--

