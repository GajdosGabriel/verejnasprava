<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
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
            $table->string('category');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
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
            'view'   => 'role',
            'create' => 'role',
            'edit'   => 'role',
            'delete' => 'role',

            'customer edit'    => 'customer',
            'customer view'    => 'customer',
            'customer create'  => 'customer',
            'customer delete'  => 'customer',

            'organization edit'    => 'organization',
            'organization view'    => 'organization',
            'organization create'  => 'organization',
            'organization delete'  => 'organization',

            'order edit'    => 'order',
            'order view'    => 'order',
            'order create'  => 'order',
            'order delete'  => 'order',

            'post edit'    => 'post',
            'post view'    => 'post',
            'post create'  => 'post',
            'post delete'  => 'post',

            'council view'    => 'council',
            'council edit'    => 'council',
            'council create'  => 'council',
            'council delete'  => 'council',
            ];

foreach ($permissions as $permission => $category) {
    Permission::create([
        'name'     => $permission,
        'category' => $category,
    ]);
}

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
                'permission_id' => 4,
                'model_type' => 'App\Models\User',
                'model_id' => 1,
            ],
        ]);

        \DB::table('model_has_roles')->insert([
            [
                'role_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 1
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
