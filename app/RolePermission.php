<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RolePermission
 *
 * @property int $id
 * @property int $role_id
 * @property int $permission_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RolePermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RolePermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RolePermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RolePermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RolePermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RolePermission wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RolePermission whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RolePermission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RolePermission extends Model
{
    //
}
