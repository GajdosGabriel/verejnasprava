<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding.');
        }

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('category');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedBigInteger('permission_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(['permission_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_permissions_permission_model_type_primary');
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedBigInteger('role_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['role_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_roles_role_model_type_primary');
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id'], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));


        $permissions = [
//            'post view' => 'post',
//            'post edit' => 'post',
//            'post create' => 'post',
//            'post delete' => 'post',

//            'contact view' => 'contact',
//            'contact edit' => 'contact',
//            'contact create' => 'contact',
//            'contact delete' => 'contact',

//            'organization view' => 'organization',
//            'organization edit' => 'organization',
//            'organization create' => 'organization',
//            'organization delete' => 'organization',

//            'council view' => 'council',
//            'council edit' => 'council',
//            'council create' => 'council',
//            'council delete' => 'council',

//            'task view' => 'task',
//            'task edit' => 'task',
//            'task create' => 'task',
//            'task delete' => 'task',
//
//            'order view' => 'order',
//            'order edit' => 'order',
//            'order create' => 'order',
//            'order delete' => 'order',

        ];

        foreach ($permissions as $permission => $category) {
            Permission::create([
                'name' => $permission,
                'category' => $category,
            ]);
        }
        \DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => 'post view',
                'title' => 'Zobraziť',
                'category' => 'post',
                'guard_name' => 'web',
            ],
            [
                'id' => 2,
                'name' => 'post edit',
                'title' => 'Upraviť',
                'category' => 'post',
                'guard_name' => 'web',
            ],
            [
                'id' => 3,
                'name' => 'post create',
                'title' => 'Vytvoriť',
                'category' => 'post',
                'guard_name' => 'web',
            ],
            [
                'id' => 4,
                'name' => 'post delete',
                'title' => 'Zmazať',
                'category' => 'post',
                'guard_name' => 'web',
            ],

            [
                'id' => 5,
                'name' => 'council view',
                'title' => 'Zobraziť',
                'category' => 'council',
                'guard_name' => 'web',
            ],
            [
                'id' => 6,
                'name' => 'council edit',
                'title' => 'Upraviť',
                'category' => 'council',
                'guard_name' => 'web',
            ],
            [
                'id' => 7,
                'name' => 'council create',
                'title' => 'Vytvoriť',
                'category' => 'council',
                'guard_name' => 'web',
            ],
            [
                'id' => 8,
                'name' => 'council delete',
                'title' => 'Zmazať',
                'category' => 'council',
                'guard_name' => 'web',
            ],

            [
                'id' => 9,
                'name' => 'contact view',
                'title' => 'Zobraziť',
                'category' => 'contact',
                'guard_name' => 'web',
            ],
            [
                'id' => 10,
                'name' => 'contact edit',
                'title' => 'Upraviť',
                'category' => 'contact',
                'guard_name' => 'web',
            ],
            [
                'id' => 11,
                'name' => 'contact create',
                'title' => 'Vytvoriť',
                'category' => 'contact',
                'guard_name' => 'web',
            ],
            [
                'id' => 12,
                'name' => 'contact delete',
                'title' => 'Zmazať',
                'category' => 'contact',
                'guard_name' => 'web',
            ],
            [
                'id' => 13,
                'name' => 'organization view',
                'title' => 'Zobraziť',
                'category' => 'organization',
                'guard_name' => 'web',
            ],
            [
                'id' => 14,
                'name' => 'organization edit',
                'title' => 'Upraviť',
                'category' => 'organization',
                'guard_name' => 'web',
            ],
            [
                'id' => 15,
                'name' => 'organization create',
                'title' => 'Vytvoriť',
                'category' => 'organization',
                'guard_name' => 'web',
            ],
            [
                'id' => 16,
                'name' => 'organization delete',
                'title' => 'Zmazať',
                'category' => 'organization',
                'guard_name' => 'web',
            ],

            [
                'id' => 17,
                'name' => 'task view',
                'title' => 'Zobraziť',
                'category' => 'task',
                'guard_name' => 'web',
            ],
            [
                'id' => 18,
                'name' => 'task edit',
                'title' => 'Upraviť',
                'category' => 'task',
                'guard_name' => 'web',
            ],
            [
                'id' => 19,
                'name' => 'task create',
                'title' => 'Vytvoriť',
                'category' => 'task',
                'guard_name' => 'web',
            ],
            [
                'id' => 20,
                'name' => 'task delete',
                'title' => 'Zmazať',
                'category' => 'task',
                'guard_name' => 'web',
            ],

            [
                'id' => 21,
                'name' => 'order view',
                'title' => 'Zobraziť',
                'category' => 'order',
                'guard_name' => 'web',
            ],
            [
                'id' => 22,
                'name' => 'order edit',
                'title' => 'Upraviť',
                'category' => 'order',
                'guard_name' => 'web',
            ],
            [
                'id' => 23,
                'name' => 'order create',
                'title' => 'Vytvoriť',
                'category' => 'order',
                'guard_name' => 'web',
            ],
            [
                'id' => 24,
                'name' => 'order delete',
                'title' => 'Zmazať',
                'category' => 'order',
                'guard_name' => 'web',
            ],


        ]);


        $roles = [
            'super-admin',
            'admin'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }


//        $permissions = [
////        'role-list',
////        'role-create',
////        'role-edit',
////        'role-delete',
////        'product-list',
////        'product-create',
////        'product-edit',
////        'product-delete'
////    ];
////

//        foreach ($permissions as $permission) {
//            Permission::create(['name' => $permission]);
//        }
//
//        $roles = [
//            'super-admin',
//            'admin',
//            'editor',
//            'publisher',
//            'user',
//        ];
//
//        foreach ($roles as $permission) {
//            \Spatie\Permission\Models\Role::create(['name' => $permission]);
//        }


//
        \DB::table('model_has_permissions')->insert([
            [
                'permission_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 1,
            ],
            [
                'permission_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 1,
            ],
            [
                'permission_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 1,
            ],
            [
                'permission_id' => 4,
                'model_type' => 'App\Models\User',
                'model_id' => 1,
            ],
            [
                'permission_id' => 5,
                'model_type' => 'App\Models\User',
                'model_id' => 1,
            ],
            [
                'permission_id' => 6,
                'model_type' => 'App\Models\User',
                'model_id' => 1,
            ],
        ]);

        \DB::table('model_has_roles')->insert([
            //  Super admin
            [
                'role_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 1
            ],
            // Admin
            [
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 1
            ],
        ]);

        \DB::table('organization_user')->insert([

            [
                'organization_id' => 1,
                'user_id' => 1,
            ],
            [
                'organization_id' => 1,
                'user_id' => 2,
            ],
            [
                'organization_id' => 1,
                'user_id' => 3,
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
