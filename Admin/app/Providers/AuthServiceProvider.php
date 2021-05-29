<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Phân quyền
        //Danh mục
        Gate::define('category-list', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.list-category'));
        });
        Gate::define('category-add', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.add-category'));
        });
        Gate::define('category-edit', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-category'));
        });
        Gate::define('category-delete', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-category'));
        });

        //sản phẩm
        Gate::define('product-list', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.list-product'));
        });
        Gate::define('product-add', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.add-product'));
        });
        Gate::define('product-edit', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-product'));
        });
        Gate::define('product-delete', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-product'));
        });

        //Tài khoản
        Gate::define('acount-list', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.list-acount'));
        });
        Gate::define('acount-add', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.add-acount'));
        });
        Gate::define('acount-edit', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-acount'));
        });
        Gate::define('acount-delete', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-acount'));
        });

        //Đơn hàng
        Gate::define('order-list', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.list-order'));
        });
        Gate::define('order-delete', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-order'));
        });

        //Giảm giá
        Gate::define('discount-list', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.list-discount'));
        });
        Gate::define('discount-add', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.add-discount'));
        });
        Gate::define('discount-edit', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-discount'));
        });
        Gate::define('discount-delete', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-discount'));
        });

        //Chức năng
        Gate::define('role-list', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.list-role'));
        });
        Gate::define('role-add', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.add-role'));
        });
        Gate::define('role-edit', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-role'));
        });
        Gate::define('role-delete', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-role'));
        });

        //Tạo quyền
        Gate::define('role-premisson-add', function (User $user) {
            return $user->checkPermissionAccess(config('permissions.access.add-role-permiss'));
        });

    }
}
