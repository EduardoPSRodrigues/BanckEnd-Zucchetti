CREATE TYPE "porte_raca" AS ENUM (
  'PEQUENO',
  'MEDIO',
  'GRANDE',
  'GIGANTE'
);

CREATE TABLE "races" (
  "id" serial PRIMARY KEY,
  "name" varchar(50) UNIQUE NOT NULL,
  "created_at" timestamptz DEFAULT (now())
);

CREATE TABLE "pets" (
  "id" serial PRIMARY KEY,
  "race_id" integer,
  "client_id" integer,
  "name" varchar(100),
  "age" integer,
  "weight" float,
  "size" porte_raca DEFAULT 'medio',
  "created_at" timestamptz DEFAULT (now())
);

CREATE TABLE "peoples" (
  "id" serial PRIMARY KEY,
  "name" varchar(150) NOT NULL,
  "cpf" varchar(20),
  "contact" varchar(20)
);

CREATE TABLE "clients" (
  "id" serial PRIMARY KEY,
  "people_id" integer
);

CREATE TABLE "profissionais" (
  "id" serial PRIMARY KEY,
  "especialidades_id" integer,
  "people_id" integer,
  "register" varchar(20)
);

CREATE TABLE "especialidades" (
  "id" serial PRIMARY KEY,
  "name" varchar(50) UNIQUE NOT NULL,
  "created_at" timestamptz DEFAULT (now())
);

CREATE TABLE "vacinas" (
  "id" serial PRIMARY KEY,
  "pets_id" integer,
  "profissional_id" integer,
  "dose" float,
  "name" varchar(100),
  "created_at" timestamptz DEFAULT (now())
);

ALTER TABLE "pets" ADD FOREIGN KEY ("race_id") REFERENCES "races" ("id");

ALTER TABLE "pets" ADD FOREIGN KEY ("client_id") REFERENCES "clients" ("id");

ALTER TABLE "clients" ADD FOREIGN KEY ("people_id") REFERENCES "peoples" ("id");

ALTER TABLE "profissionais" ADD FOREIGN KEY ("people_id") REFERENCES "peoples" ("id");

ALTER TABLE "especialidades" ADD FOREIGN KEY ("id") REFERENCES "profissionais" ("especialidades_id");

ALTER TABLE "vacinas" ADD FOREIGN KEY ("pets_id") REFERENCES "pets" ("id");

ALTER TABLE "vacinas" ADD FOREIGN KEY ("profissional_id") REFERENCES "profissionais" ("id");
