-- psql -U postgres -h localhost -f db.sql

drop database if exists clinics;

drop user if exists clinics_web;
drop user if exists clinics;

create user clinics password 'xxx';
create user clinics_web password 'xxx';

create database clinics owner clinics;

\c clinics
drop schema public;
