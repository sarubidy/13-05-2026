<?php

namespace App\Controllers;

use App\Models\EmployeModel;
use CodeIgniter\RESTful\ResourceController;

class EmployeController extends ResourceController
{
    protected $employeModel;

    public function __construct()
    {
        $this->employeModel = new EmployeModel();
    }

    public function index()
    {
        $employes = $this->employeModel->findAll();

        return $this->respond([
            'success' => true,
            'data' => $employes
        ]);
    }

    public function show($id = null)
    {
        $employe = $this->employeModel->find($id);

        if (!$employe) {
            return $this->failNotFound("Utilisateur introuvable");
        }

        return $this->respond([
            'success' => true,
            'data' => $employe
        ]);
    }

    public function profile($id)
    {
        $profile = $this->employeModel->getProfileSummary($id);

        if (!$profile) {
            return $this->failNotFound("Profil introuvable");
        }

        return $this->respond([
            'success' => true,
            'data' => $profile
        ]);
    }

    public function update($id = null)
    {
        $employe = $this->employeModel->find($id);

        if (!$employe) {
            return $this->failNotFound("Utilisateur introuvable");
        }

        $data = [
            'nom' => $this->request->getVar('nom'),
            'prenom' => $this->request->getVar('prenom'),
            'email' => $this->request->getVar('email'),
            'departement_id' => $this->request->getVar('departement_id')
        ];

        $this->employeModel->update($id, $data);

        return $this->respond([
            'success' => true,
            'message' => 'Utilisateur modifié'
        ]);
    }

    public function dashboard()
    {
        return view('employe/dashboard', ['title' => 'Tableau de bord']);
    }

    public function demandes()
    {
        return view('employe/mes_conges', ['title' => 'Mes demandes', 'breadcrumb' => 'Mes demandes']);
    }

    public function create()
    {
        return view('employe/form_conge', ['title' => 'Nouvelle demande', 'breadcrumb' => 'Nouvelle demande']);
    }
}