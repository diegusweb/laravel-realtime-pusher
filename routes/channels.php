<?php

Broadcast::channel('cart-updated.{user_id}', function ($user, $user_id) {
	return (int) $user->id === (int) $user_id;
});

Broadcast::channel('new-order', function ($user) {
	return $user->role === \App\User::ADMIN;
});

Broadcast::channel('processing-order-{order_id}', function ($user, $order_id) {
	return true;
});

