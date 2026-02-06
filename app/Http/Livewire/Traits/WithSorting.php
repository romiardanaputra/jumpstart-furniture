<?php

namespace App\Http\Livewire\Traits;

trait WithSorting
{
    public string $sortBy = '';
    public string $sortDirection = 'asc';

    /**
     * Sort by the given column.
     */
    public function sortBy(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }

        // Reset to first page when sorting changes
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    /**
     * Get the sort icon for a column.
     */
    public function getSortIcon(string $column): string
    {
        if ($this->sortBy !== $column) {
            return 'fa-sort';
        }

        return $this->sortDirection === 'asc' ? 'fa-sort-up' : 'fa-sort-down';
    }

    /**
     * Apply sorting to a query builder.
     */
    protected function applySorting($query)
    {
        if ($this->sortBy) {
            return $query->orderBy($this->sortBy, $this->sortDirection);
        }

        return $query;
    }
}
