<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function confirm(User $user, Order $order)
    {
        return $user->id === $order->user_id; // Дозволяємо підтвердження, якщо замовлення належить користувачу
    }
    public function cancel(User $user, Order $order)
    {
        return $user->id === $order->user_id; // дозволяємо скасування, якщо замовлення належить користувачу
    }
}

