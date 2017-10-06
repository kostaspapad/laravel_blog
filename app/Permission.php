<?php 

// Defines the model namespace
namespace App;

// imports the entrust permission model that implements the EntrustPermissionInterface
// and uses the EntrustPermissionTrait trait. The trait is responsible for creating 
// relationships and perform other tasks.
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $table = 'permissions';
    protected $fillable = ['name', 'display_name', 'description'];
};