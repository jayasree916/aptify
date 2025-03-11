<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table            = 'menus';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['parent_id', 'name', 'url', 'display_order', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    public function getMenuByRole($role)
    {
        $menus = $this->join('menu_roles', 'menus.id = menu_roles.menu_id')
                      ->where('menu_roles.role_id', $role)
                      ->orderBy('display_order', 'ASC')
                      ->findAll();

        return $this->buildMenuHierarchy($menus);
    }

    private function buildMenuHierarchy($menus)
    {
        $menuTree = [];
        $menuMap = [];

        // First pass: Organize by ID
        foreach ($menus as $menu) {
            $menu['submenus'] = [];
            $menuMap[$menu['id']] = $menu;
        }

        // Second pass: Arrange as parent-child hierarchy
        foreach ($menus as $menu) {
            if ($menu['parent_id'] && isset($menuMap[$menu['parent_id']])) {
                $menuMap[$menu['parent_id']]['submenus'][] = &$menuMap[$menu['id']];
            } else {
                $menuTree[] = &$menuMap[$menu['id']];
            }
        }

        return $menuTree;
    }
}
