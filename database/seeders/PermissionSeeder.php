<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
      /**
      * Run the database seeds.
      *
      * @return void
      */
      public function run()
      {
            $permissions = [ 
                  'roles-list', 
                  'roles-view', 
                  'roles-create', 
                  'roles-edit', 
                  'roles-delete',

                  'users-list', 
                  'users-view', 
                  'users-create', 
                  'users-edit', 
                  'users-delete',

                  'packagings-list', 
                  'packagings-view', 
                  'packagings-create', 
                  'packagings-edit', 
                  'packagings-delete',

                  'consignees-list', 
                  'consignees-view', 
                  'consignees-create', 
                  'consignees-edit', 
                  'consignees-delete',

                  'chemicals-list', 
                  'chemicals-view', 
                  'chemicals-create', 
                  'chemicals-edit', 
                  'chemicals-delete',

                  'invoices-list', 
                  'invoices-view', 
                  'invoices-create', 
                  'invoices-edit', 
                  'invoices-delete',

                  'subscriptions-list', 
                  'subscriptions-view', 
                  'subscriptions-create', 
                  'subscriptions-edit', 
                  'subscriptions-delete',

                  'notifications-list', 
                  'notifications-view', 
                  'notifications-create', 
                  'notifications-edit', 
                  'notifications-delete',

                  'audits-list', 
                  'audits-view', 
                  'audits-create', 
                  'audits-edit', 
                  'audits-delete',

                  'logs-list', 
                  'logs-view', 
                  'logs-create', 
                  'logs-edit', 
                  'logs-delete',

                  'settings-list',
                  'settings-create',
            ];
        
            foreach ($permissions as $permission) {
                  Permission::create(['name' => $permission]);
            }
      }
}