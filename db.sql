-- psql -U postgres -h localhost -f db.sql

create user clinics password 'xxx';
create database clinics owner clinics;

create user clinics_web password 'xxx';
