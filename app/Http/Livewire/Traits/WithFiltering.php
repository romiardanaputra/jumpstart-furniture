<?php

namespace App\Http\Livewire\Traits;

trait WithFiltering
{
    public array $filters = [];

    /**
     * Initialize filters with default values.
     */
    public function initializeWithFiltering(): void
    {
        $this->filters = $this->getDefaultFilters();
    }

    /**
     * Get default filter values.
     * Override this method in the component to set defaults.
     */
    protected function getDefaultFilters(): array
    {
        return [];
    }

    /**
     * Update a filter value.
     */
    public function setFilter(string $key, $value): void
    {
        $this->filters[$key] = $value;

        // Reset to first page when filters change
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    /**
     * Reset all filters to default values.
     */
    public function resetFilters(): void
    {
        $this->filters = $this->getDefaultFilters();

        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    /**
     * Check if any filters are active.
     */
    public function hasActiveFilters(): bool
    {
        $defaults = $this->getDefaultFilters();

        foreach ($this->filters as $key => $value) {
            if (isset($defaults[$key]) && $defaults[$key] !== $value) {
                return true;
            }
            if (!isset($defaults[$key]) && !empty($value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Apply filters to a query builder.
     * Override this method in the component to apply specific filters.
     */
    protected function applyFilters($query)
    {
        return $query;
    }
}
