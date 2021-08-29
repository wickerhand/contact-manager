<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Person extends Model
{
    public static function getAll()
    {
        return DB::select('SELECT * from person');
    }

    public static function getPersonById($idPerson)
    {
        return DB::select('SELECT * FROM person WHERE id_person = ?', [$idPerson]);
    }

    public static function insertPerson($person){
        DB::insert("INSERT INTO person (full_name, email, phone_number, whatsapp) VALUES  (?, ?, ?, ?)", [$person['full_name'], $person['email'], $person['phone_number'], $person['whatsapp']]);
    }

    public static function updatePerson($person)
    {
        DB::update('UPDATE person SET full_name = ?, email = ?, phone_number = ?, whatsapp = ? WHERE id_person = ?', [$person['full_name'], $person['email'], $person['phone_number'], $person['whatsapp'], $person['id_person']]);
    }

    public static function deletePerson($idPerson)
    {
        DB::delete('DELETE FROM person WHERE id_person = ?', [$idPerson]);
    }
}