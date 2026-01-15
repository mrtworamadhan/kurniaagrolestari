<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'invoice_number',
        'user_id',
        'status', 
        'payment_status', 
        'payment_method',
        'total_amount',
        'discount_amount',
        'paid_amount',
        'due_date',
        'notes',
    ];

    protected $casts = [
        'due_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->invoice_number)) {
                $model->invoice_number = 'INV-' . date('Ymd') . '-' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });

        static::updated(function ($order) {
            if ($order->isDirty('status')) {
                $newStatus = $order->status;
                $originalStatus = $order->getOriginal('status');

                $decrementStatuses = ['confirmed', 'processing', 'shipping', 'completed'];
                
                $neutralStatuses = ['pending', 'cancelled'];

                if (in_array($newStatus, $decrementStatuses) && in_array($originalStatus, $neutralStatuses)) {
                    foreach ($order->items as $item) {
                        $item->product->decrement('stock', $item->quantity);
                    }
                }

                if ($newStatus == 'cancelled' && in_array($originalStatus, $decrementStatuses)) {
                    foreach ($order->items as $item) {
                        $item->product->increment('stock', $item->quantity);
                    }
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    
    public function getRemainingBalanceAttribute()
    {
        return $this->total_amount - $this->paid_amount;
    }
}