<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' => 'Omar ElGohary',
            'email' => 'admin@rscoder.com',
            'password' => bcrypt('12345678'),
            'roles_name' => ['Owner'],
            'status' => 'مفعل'
        ]);

        $role = Role::create(['name' => 'Owner']);
        $permissions = Permission::pluck('id' , 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
