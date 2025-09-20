<?php

namespace App\Livewire\Backend\Users;

use Livewire\Component;
use Illuminate\Contracts\View\View;

class RolesSelect extends Component
{
    public ?int $select;

    public array $selected = [];

    public array $roles = [];

    public function mount(array $roles = [], array $selected = []): void
    {
        $this->roles = $roles;
        $this->selected = $selected;
    }

    public function updatedSelect($id): void
    {
        $role = array_values(
            array: array_filter(
                array: $this->roles,
                callback: function (array $v) use ($id): bool {
                    return $v['id'] == $id;
                }
            )
        );

        if (empty($role)) {
            return;
        }

        $selectedIds = array_column(array: $this->selected, column_key: 'id');

        $exists = in_array(needle: $id, haystack: $selectedIds);

        if (!$exists) {
            $this->selected[] = $role[0];
        }

        $this->dispatch('rolesSelected',  $this->selected);

        $this->select = null;
    }

    public function remove($id): void
    {
        $tmp = array_values(
            array: array_filter(
                array: $this->selected,
                callback: function ($s) use ($id) {
                    return $s['id'] != $id;
                }
            )
        );

        $this->selected = $tmp;

        $this->dispatch('rolesSelected',  $tmp);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.backend.users.roles-select'
        );
    }
}
