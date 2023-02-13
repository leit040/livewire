<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class AbstractTable extends Component
{
    use WithPagination;

    private array $fields = [
        'id',
        'name',
        'nickName',
        'phone',
        'email',
        'address',
        'created_at'
    ];
    private array $searchFields = [
        'id',
        'name',
        'nickName',
        'email',
        'address'
    ];
    private array $sortByFields = [
        'id',
        'name',
        'nickName',
        'email',
        'phone',
        'created_at'
    ];
    public string $needle = '';
    public string $orderByField = '';
    private string $view = "livewire.abstract-table";
    private string $model = "App\Models\User";


    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $items = $this->searchBy()->simplePaginate(15);

        $data = [
            'items' => $items,
            'fields' => $this->fields,
            'sortByFields' => $this->sortByFields,
        ];
        return view($this->view, compact('data'));
    }


    public function orderBy(string $field): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->orderByField = $field;
        return $this->render();
    }

    public function searchBy()
    {
        $query = $this->model::query();
        if (strlen($this->needle) && count($this->searchFields)) {

            foreach ($this->searchFields as $field) {
                if ($field == 'id') {
                    $query->orWhere('id', $this->needle);
                } else {
                    $query->orWhere($field, 'like', '%' . $this->needle . '%');
                }

            }
        }
        if ($this->orderByField) {
            $query->orderBy($this->orderByField);
        }

        return $query;

    }


}
