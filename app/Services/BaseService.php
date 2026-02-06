<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

abstract class BaseService
{
    /**
     * Execute callback within a database transaction with error handling
     * 
     * @param callable $callback The business logic to execute
     * @param int $attempts Number of retry attempts for deadlocks
     * @return mixed Result of the callback
     * @throws Exception If all retries fail
     */
    protected function handleTransaction(callable $callback, int $attempts = 5)
    {
        DB::beginTransaction();
        
        try {
            $result = $callback();
            DB::commit();
            
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            
            // Centralized error logging
            Log::error("Service Transaction Error: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'class' => static::class,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            throw $e;
        }
    }

    /**
     * Execute callback with retry logic for external API calls
     * 
     * @param callable $callback The API call to execute
     * @param int $maxRetries Maximum retry attempts
     * @param int $baseDelayMs Base delay in milliseconds (exponential backoff)
     * @return mixed Result of the callback
     * @throws Exception If all retries fail
     */
    protected function executeWithRetry(callable $callback, int $maxRetries = 3, int $baseDelayMs = 100)
    {
        $attempt = 0;
        $lastException = null;
        
        while ($attempt < $maxRetries) {
            try {
                return $callback();
            } catch (Exception $e) {
                $lastException = $e;
                $attempt++;
                
                // Log retry attempt
                Log::warning("Retry attempt {$attempt}/{$maxRetries}", [
                    'class' => static::class,
                    'error' => $e->getMessage(),
                ]);
                
                if ($attempt < $maxRetries) {
                    // Exponential backoff
                    usleep($baseDelayMs * 1000 * pow(2, $attempt - 1));
                }
            }
        }
        
        Log::error("All retry attempts failed", [
            'class' => static::class,
            'error' => $lastException->getMessage(),
        ]);
        
        throw $lastException;
    }

    /**
     * Log service action for audit trail
     */
    protected function logAction(string $action, array $context = []): void
    {
        Log::info("Service Action: {$action}", array_merge([
            'class' => static::class,
            'timestamp' => now()->toIso8601String(),
        ], $context));
    }
}
