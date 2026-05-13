<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeModel extends Model
{
    protected $table            = 'employes';
    protected $primaryKey       = 'id';
    
    protected $allowedFields    = [
        'nom', 'prenom', 'email', 'password', 'date_embauche', 
        'departement_id', 'role','actif'
    ];

    public function getProfileSummary(int $EmpId): ?array
    {
        return $this->db
            ->table('employes e')
            ->select('
                e.id,
                e.nom,
                e.prenom,
                e.email,
                e.departement_id,
                e.date_embauche,
                e.role,
                e.actif
            ')
            ->where('e.id', $EmpId)
            ->where('e.role', 'employe')
            ->get()
            ->getRowArray();
    }
}