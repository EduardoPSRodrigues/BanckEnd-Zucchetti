<?php

class PetDAO
{
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO("pgsql:host=localhost;dbname=api_pets", "docker", "docker");
    }

    public function insert(Pet $pet)
    {

        try {
            $this->getConnection();
            //var_dump($connection); Testar se a conexão esta funcionando

            //Definir o sql sendo que o valor será um apelido para o bind realmente validar o valor
            $sql = "insert into pets
                    (
                        name,
                        race_id,
                        age,
                        size,
                        weight
                    )
                values
                    (
                        :name_value,
                        :race_id_value,
                        :age_value,
                        :size_value,
                        :weight_value
                    )";

            //Preparar o sql
            $statement = ($this->getConnection())->prepare($sql);

            //bindValue é um sistema de segurança para validar a informação antes de salvar
            $statement->bindValue(":name_value", $pet->getName());
            $statement->bindValue(":race_id_value", $pet->getRaceId());
            $statement->bindValue(":age_value", $pet->getAge());
            $statement->bindValue(":size_value", $pet->getSize());
            $statement->bindValue(":weight_value", $pet->getWeight());

            //Executar no banco de dados
            $statement->execute();

            return ['success' => true];
        } catch (PDOException $error) {
            //Mensagem para ver o erro que o banco de dados emitiu
            debug($error->getMessage());
            return ['success' => false];
        }
    }

    public function findMany()
    {
        $sql = "select
                    pets.id,
                    pets.name,
                    size,
                    age,
                    races.name as nome_raca
                        from pets
                            join races on pets.race_id = races.id
                                 order by name asc         
        ";

        $statement = ($this->getConnection())->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOne($id)
    {
        //o PDO orienta que passei o bind da variavel, poderia passar $id, poderia mas por questão de segurança
        // passa o :id_value
        $sql = "SELECT * from pets where id = :id_value";

        $statement = ($this->getConnection())->prepare($sql);
        $statement->bindValue(":id_value", $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteOne($id)
    {
        try {
            $sql = "delete from pets where id = :id_value";

            $statement = ($this->getConnection())->prepare($sql);
            $statement->bindValue(":id_value", $id);
            $statement->execute();

            return ['success' => true];
        } catch (PDOException $error) {
            debug($error->getMessage());
            return ['success' => false];
        }
    }

    public function updateOne($id, $data)
    {
        $petInDatabase = $this->findOne($id);

        $sql = "update pets 
                        set 
                            name=:name_value,
                            race_id=:race_id_value,
                            size=:size_value,
                            weight=:weight_value,
                            age=:age_value
                                where id = :id_value
            ";

        $statement = ($this->getConnection())->prepare($sql);

        $statement->bindValue(":id_value", $id);

        //No bind estou usando uma condição se a informação foi passada no body para atualizar o campo, então
        //uso essa informação, do contrário uso a informação que ja está no banco de dados
        //foi utilizado um if ternário sendo que no começo do codigo usei um find com base no id que foi passado
        //para trazer essas informações do pet
        $statement->bindValue(
            ":name_value",
            isset($data->name) ?
                $data->name :
                $petInDatabase['name']
        );

        $statement->bindValue(
            ":race_id_value",
            isset($data->race_id) ?
                $data->race_id :
                $petInDatabase['race_id']
        );

        $statement->bindValue(
            ":size_value",
            isset($data->size) ? $data->size : $petInDatabase['size']
        );

        $statement->bindValue(
            ":weight_value",
            isset($data->weight)
                ? $data->weight :
                $petInDatabase['weight']
        );

        $statement->bindValue(
            ":age_value",
            isset($data->age) ?
                $data->age :
                $petInDatabase['age']
        );

        $statement->execute();

        return ['success' => true];
    }

    public function dashboard()
    {
        $sql = "select  
                    p.size, 
                    count(p.size) 
                        from pets p
                            group by p.size
                            order by count(p.size) desc ";

        $statement = ($this->getConnection())->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
