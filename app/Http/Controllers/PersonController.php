<?php
namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Support\Arr;

class PersonController extends Controller
{

    public function render()
    {
        $arrayView = Array(
            "persons" => Person::getAll(),
        );

        return view('insert-person')->with($arrayView);
    }

    public function insertPerson()
    {
        $requiredFields = array('full_name', 'email');
        $arrayJson = array();
        if(!$this->verifyRequiredFields($requiredFields, $_POST))
        {
            $arrayJson['status'] = false;
            $arrayJson['message'] = 'Fill in the required fields';
            return json_encode($arrayJson);
        }

        try
        {
            Person::insertPerson($_POST);
            $arrayJson['status'] = true;
            $arrayJson['message'] = 'Registration performed successfully';
            return json_encode($arrayJson);
        }
        catch(\Exception $e)
        {
            $arrayJson['status'] = false;
            $arrayJson['message'] = 'An error occurred with the code '.$e->getCode();
            return json_encode($arrayJson);
        }

    }

    public function getPerson()
    {
        $arrayJson = array();
        try
        {
            $idPerson = $_POST['id_person'];

            $person = Person::getPersonById($idPerson);

            if(!$person)
            {
                $arrayJson['status'] = false;
                $arrayJson['message'] = 'Person not found';
                return json_encode($arrayJson);
            }

            $arrayJson['status'] = true;
            $arrayJson['person'] = $person;
            return json_encode($arrayJson);
        }
        catch(\Exception $e)
        {
            $arrayJson['status'] = false;
            $arrayJson['message'] = 'An error occurred with the code '.$e->getCode();
            return json_encode($arrayJson);
        }
        
    }
    public function editPerson()
    {
        $requiredFields = array('id_person', 'full_name', 'email');
        $arrayJson = array();
        if(!$this->verifyRequiredFields($requiredFields, $_POST))
        {
            $arrayJson['status'] = false;
            $arrayJson['message'] = 'Fill in the required fields';
        }

        try
        {
            Person::updatePerson($_POST);
            $arrayJson['status'] = true;
            $arrayJson['message'] = 'Registration performed successfully';
        }
        catch(\Exception $e)
        {
            $arrayJson['status'] = false;
            $arrayJson['message'] = 'An error been occurred with the code '.$e->getCode();
        }

        return json_encode($arrayJson);
    }

    public function deletePerson()
    {
        $arrayJson = array();
        try
        {
            $idPerson = $_POST['id_person'];

            Person::deletePerson($idPerson);

            $arrayJson['status'] = true;
            $arrayJson['message'] = 'Person deleted successfully';
            return json_encode($arrayJson);
        }
        catch(\Exception $e)
        {
            $arrayJson['status'] = false;
            $arrayJson['message'] = 'An error occurred with the code '.$e->getCode();
            return json_encode($arrayJson);
        }
    }

    public function verifyRequiredFields($requiredFields, $data)
    {
        $verified = true;
        for($i = 0; $i < count($requiredFields); $i++)
        {
            if(!isset($data[$requiredFields[$i]]))
            {
                $verified = false;
            }
        }
        return $verified;
    }
}