<?php
require_once '../utils.php';
require_once '../models/Pet.php';
require_once '../models/PetDAO.php';

class DashboardController
{
    public function dashboard()
    {
        $petDAO = new PetDAO();
        $result = $petDAO->dashboard();
        response($result, 200);
    }
}
