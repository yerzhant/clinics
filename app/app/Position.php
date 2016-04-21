<?php

namespace App;

class Position extends Model
{
    public function getRolesAsStringAttribute($value)
    {
        $roles = substr($this->roles, 1, -1);
        $roles = str_replace('admin', 'Администратор', $roles);
        $roles = str_replace('doctor', 'Врач', $roles);
        $roles = str_replace('accountant', 'Бухгалтер', $roles);
        $roles = str_replace('receptionist', 'Рисепшенист', $roles);
        
        return $roles;
    }
}
