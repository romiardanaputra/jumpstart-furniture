<?php

namespace App\Http\Livewire\Traits;

trait WithDataTable
{
    use WithSorting, WithFiltering;

    public string $search = '';
    public int $perPage = 10;

    /**
     * Search query string configuration for URL binding.
     */
    protected function queryStringWithDataTable(): array
    {
        return [
            'search' => ['except' => ''],
            'sortBy' => ['except' => ''],
            'sortDirection' => ['except' => 'asc'],
            'perPage' => ['except' => 10],
        ];
    }

    /**
     * Update the search term.
     */
    public function updatedSearch(): void
    {
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    /**
     * Update items per page.
     */
    public function updatedPerPage(): void
    {
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    /**
     * Reset the data table state.
     */
    public function resetDataTable(): void
    {
        $this->search = '';
        $this->sortBy = '';
        $this->sortDirection = 'asc';
        $this->perPage = 10;
        $this->resetFilters();

        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    /**
     * Apply search to a query builder.
     * Override this method in the component to specify searchable columns.
     */
    protected function applySearch($query, array $searchableColumns)
    {
        if (empty($this->search)) {
            return $query;
        }

        return $query->where(function ($q) use ($searchableColumns) {
            foreach ($searchableColumns as $column) {
                $q->orWhere($column, 'like', '%' . $this->search . '%');
            }
        });
    }

    /**
     * Get available per-page options.
     */
    public function getPerPageOptions(): array
    {
        return [10, 25, 50, 100];
    }
}
