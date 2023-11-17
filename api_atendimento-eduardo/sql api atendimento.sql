CREATE TYPE "status_enum" AS ENUM (
  'EM_ANDAMENTO',
  'PENDENTE',
  'FINALIZADO'
);

CREATE TABLE "guiches" (
  "id" serial PRIMARY KEY,
  "name" varchar(30) NOT NULL,
  "created_at" timestamptz DEFAULT (now())
);

CREATE TABLE "tickets" (
  "id" serial PRIMARY KEY,
  "guiche_id" integer,
  "name" varchar(150) NOT NULL,
  "cpf" varchar(20) NOT NULL,
  "priority" boolean DEFAULT false,
  "status" status_enum DEFAULT 'PENDENTE',
  "created_at" timestamptz DEFAULT (now()),
  FOREIGN KEY ("guiche_id") REFERENCES "guiches" ("id")
);

INSERT INTO "tickets" ("name", "cpf", "priority", "status")
VALUES
  ('João Silva', '123.456.789-00', true, 'EM_ANDAMENTO'),
  ('Maria Souza', '987.654.321-00', false, 'PENDENTE'),
  ('Pedro Santos', '456.789.123-00', false, 'FINALIZADO'),
  ('Ana Oliveira', '789.123.456-00', true, 'EM_ANDAMENTO'),
  ('Lucas Pereira', '321.654.987-00', false, 'PENDENTE'),
  ('Julia Costa', '555.555.555-00', false, 'PENDENTE'),
  ('Marcos Lima', '666.666.666-00', false, 'PENDENTE'),
  ('Larissa Gomes', '777.777.777-00', true, 'FINALIZADO'),
  ('Mateus Fernandes', '888.888.888-00', false, 'EM_ANDAMENTO'),
  ('Camila Rodrigues', '999.999.999-00', true, 'PENDENTE');
  
 --Selecionar todos os tickets com status pendente e por ordem de prioridade e pela
 --data da hora de chegada
 select * from tickets
 	where status = 'PENDENTE'
		order by priority desc, created_at;
	
--Guiche para chamar um cliente
update tickets set guiche_id = 1, status = 'EM_ANDAMENTO' where ID=5;

--Finalizar um atendimento
update tickets set status = 'FINALIZADO' where ID=5;

select count(*) from tickets where guiche_id =1