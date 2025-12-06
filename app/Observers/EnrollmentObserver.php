<?php

namespace App\Observers;

use App\Models\Enrollments;
use App\Models\Wallet;

class EnrollmentObserver
{
    /**
     * Handle the Enrollments "created" event.
     */
    public function created(Enrollments $enrollment): void
    {
        // Only process if enrollment is successful
        if ($enrollment->enrolled === 'yes') {
            if ($enrollment->transaction_status === 'success' || 
                $enrollment->transaction_type === 'cash' || 
                $enrollment->transaction_type === 'api') {
                $this->addToTeacherWallet($enrollment);
            }
        }
    }

    /**
     * Handle the Enrollments "updated" event.
     */
    public function updated(Enrollments $enrollment): void
    {
        // If enrollment status changed to success, add to wallet
        if ($enrollment->isDirty('enrolled') && $enrollment->enrolled === 'yes') {
            if ($enrollment->transaction_status === 'success' || 
                $enrollment->transaction_type === 'cash' || 
                $enrollment->transaction_type === 'api') {
                $this->addToTeacherWallet($enrollment);
            }
        }
        
        // Also check if transaction_status changed to success
        if ($enrollment->isDirty('transaction_status') && $enrollment->transaction_status === 'success') {
            if ($enrollment->enrolled === 'yes') {
                $this->addToTeacherWallet($enrollment);
            }
        }
    }

    /**
     * Add earnings to teacher wallet
     */
    private function addToTeacherWallet(Enrollments $enrollment): void
    {
        if (!$enrollment->courses_id) {
            return; // Skip if it's a diploma enrollment
        }

        $course = $enrollment->course;
        if (!$course || !$course->user_id) {
            return;
        }

        $teacher = $course->user;
        if ($teacher->role !== 'teacher') {
            return;
        }

        // Get teacher price (not admin price)
        $teacherPrice = $course->price ?? 0;
        
        if ($teacherPrice <= 0) {
            return;
        }

        // Get or create wallet
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $teacher->id],
            ['balance' => 0, 'total_earned' => 0, 'total_withdrawn' => 0]
        );

        // Check if this enrollment was already processed
        $existingTransaction = \App\Models\WalletTransaction::where('wallet_id', $wallet->id)
            ->where('reference_type', 'enrollment')
            ->where('reference_id', $enrollment->id)
            ->first();

        if (!$existingTransaction) {
            // Add balance to teacher wallet
            $wallet->addBalance(
                $teacherPrice,
                "بيع دورة: {$course->title}",
                'enrollment',
                $enrollment->id,
                null
            );
        }
    }
}
