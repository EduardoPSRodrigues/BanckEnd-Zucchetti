<?php

class RaceDAO
{

    private $connection;

    public function __construct()
    {
        $this->connection = new PDO("pgsql:host=localhost;dbname=api_pets", "docker", "docker");
    }

    public function insert(Race $race)
    {

        try {
            //var_dump($connection); Testar se a conexão esta funcionando

            //Definir o sql sendo que o valor será um apelido para o bind realmente validar o valor
            $sql = "insert into races 
                (
                name
                )
                    values 
                        (
                        :name_value
                        )";

            //Preparar o sql
            $statement = ($this->getConnection())->prepare($sql);
            //bindValue é um sistema de segurança para validar a informação antes de salvar
            $statement->bindValue(":name_value", $race->getName());

            //Executar no banco de dados
            $statement->execute();

            return ['success' => true];
        } catch (PDOException $error) {
            //Mensagem para ver o erro que o banco de dados emitiu
            //debug($error->getMessage());
            return ['success' => false];
        }
    }

    //Função para fazer um filter e encontrar todas as raças no banco de dados
    public function findMany()
    {
        $sql = "SELECT * from races";

        $statement = ($this->getConnection())->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);


        //$sql = "SELECT id,name from races";

        //$statement = ($this->getConnection())->prepare($sql);
        //$statement->execute();

        //return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
