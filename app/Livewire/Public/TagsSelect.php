<?php

namespace App\Livewire\Public;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class TagsSelect extends Component
{
    public ?int $select;

    public array $selected = [];

    public array $tags = [];

    public function mount(array $tags = [], array $selected = []): void
    {
        $this->tags = $tags;
        $this->selected = $selected;
    }

    public function updatedSelect($id): void
    {
        $tag = array_values(
            array: array_filter(
                array: $this->tags,
                callback: function (array $v) use ($id): bool {
                    return $v['id'] == $id;
                }
            )
        );

        if (empty($tag)) {
            return;
        }

        $selectedIds = array_column(array: $this->selected, column_key: 'id');

        $exists = in_array(needle: $id, haystack: $selectedIds);

        if (!$exists) {
            $this->selected[] = $tag[0];
        }

        $this->dispatch('tagsSelected',  $this->selected);

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

        $this->dispatch('tagsSelected',  $tmp);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.public.tags-select'
        );
    }
}
