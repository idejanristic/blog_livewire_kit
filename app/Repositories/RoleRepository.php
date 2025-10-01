<?php

namespace App\Repositories;

use App\Dtos\SortDto;
use App\Acl\Models\Role;
use App\Dtos\PageDto;
use App\Dtos\Roles\RoleDto;
use Illuminate\Support\Str;
use App\Dtos\Roles\RoleFilterDto;
use App\Repositories\Filters\Roles\SearchFilter;
use Illuminate\Contracts\Pagination\Paginator;

class RoleRepository
{

    /**
     * Summary of create
     * @param \App\Dtos\Roles\RoleDto $dto
     * @return Role
     */
    public function create(RoleDto $dto): Role
    {
        return Role::create(
            attributes: [
                'name' => $dto->name,
                'slug' => Str::slug(title: $dto->name, separator: '.'),
                'description' => $dto->description
            ]
        );
    }

    public function permissionSync(RoleDto $dto, Role $role): void
    {
        $role->permissions()->sync(ids: $dto->permissions);
    }

    /**
     * @param \App\Dtos\Roles\RoleDto $dto
     * @param \App\Acl\Models\Role $role
     * @return bool
     */
    public function update(RoleDto $dto, Role $role): bool
    {
        return $role->update(
            attributes: [
                'name' => $dto->name,
                'slug' => Str::slug(title: $dto->name, separator: '.'),
                'description' => $dto->description
            ]
        );
    }

    /**
     * @param \App\Acl\Models\Role $role
     * @return bool|null
     */
    public function delete(Role $role): bool
    {
        return $role->delete();
    }

    /**
     * @param int $id
     * @return Role|null
     */
    public static function find(int $id): Role|null
    {
        return self::getRoleRelationQuery()
            ->where(column: 'id', operator: $id)
            ->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder<Role>
     */
    private static function getRoleRelationQuery()
    {
        return Role::query()
            ->with(relations: [
                'permissions',
            ])
            ->withCount(relations: [
                'users'
            ]);
    }

    /**
     * @param \App\Dtos\Roles\RoleFilterDto $filters
     * @param mixed $sortDto
     * @return \Illuminate\Database\Eloquent\Builder<Role>
     */
    private static function getRolesQuery(RoleFilterDto $filters, ?SortDto $sortDto = null)
    {
        if ($filters === null) {
            $filters = new RoleFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return self::getRoleRelationQuery()
            ->tap(callback: new SearchFilter(search: $filters->search))
            ->orderBy(column: $sortDto->sortBy, direction: $sortDto->sortDir)
            ->orderBy(column: 'id', direction: $sortDto->sortDir);
    }

    /**
     * @param \App\Dtos\PageDto $pageDto
     * @param \App\Dtos\Roles\RoleFilterDto $filters
     * @param mixed $sortDto
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getRoles(
        PageDto $pageDto,
        RoleFilterDto $filters,
        ?SortDto $sortDto = null
    ): Paginator {
        if ($filters === null) {
            $filters = new RoleFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return  self::getRolesQuery(filters: $filters, sortDto: $sortDto)
            ->paginate(
                perPage: $pageDto->perPage,
                columns: $pageDto->columns,
                pageName: $pageDto->pageName,
                page: $pageDto->page
            );
    }
}
