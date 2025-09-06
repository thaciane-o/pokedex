<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'chat.view',
            'chat.send',
            'chat.edit',
            'chat.delete',
            'chat.manage',
            'config.edit',
            'empresa.view',
            'empresa.create',
            'empresa.edit',
            'empresa.delete',
            'empresa.manage',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
