<?php

// Defines the model namespace
namespace App;

// Imports the Entrust role model that implements the EntrustRoleInterface
// and uses the EntrustRoleTrait trait. The trait is responsible for creating
// relationships and performing other tasks.
use Zizaco\Entrust\EntrustRole; 

// The model Role extends the class EntrustRole and not eloquent directly.
class Role extends EntrustRole
{
    protected $table = 'roles';
    protected $fillable = ['name', 'display_name', 'description'];
};
