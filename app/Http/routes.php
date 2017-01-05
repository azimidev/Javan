<?php

# Pages
Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('Persian-Food-Delivery-London', 'PagesController@menu')->name('menu');
Route::get('menu', function() { return redirect()->route('menu'); });
Route::get('persian-live-music', 'PagesController@liveMusic');
Route::post('deliverable', 'PagesController@deliverable');
Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');
Route::get('information', 'PagesController@information');
Route::get('feed', 'PagesController@feed');
Route::post('contact', 'PagesController@sendEmailEnquiry')->name('send.email');
Route::get('blog/{slug?}', 'PagesController@blog')->name('blog');
Route::get('guest/reservation', 'PagesController@createReservation')->name('create.reservation');
Route::post('guest/reservation', 'PagesController@storeReservation')->name('store.reservation');

# Authentications
Route::auth();

# Member Profile
Route::group(['prefix' => 'member', 'as' => 'member.'], function() {
	Route::get('profile', 'SessionsController@show')->name('show');
	Route::get('{user}/edit', 'SessionsController@edit')->name('edit');
	Route::patch('{user}', 'SessionsController@update')->name('update');
	Route::get('reservations', 'SessionsController@reservations')->name('reservations');
	Route::get('orders', 'SessionsController@orders')->name('orders');
	Route::get('bookings', 'SessionsController@bookings')->name('bookings');
});

# Admin & Manager Profile
Route::get('admin', 'UsersController@adminIndex')->name('admin.index');
Route::get('manager', 'UsersController@managerIndex')->name('manager.index');

# Resources
Route::resource('user', 'UsersController');
Route::resource('reservations', 'ReservationsController');
Route::resource('post', 'PostsController');
Route::resource('products', 'ProductsController');
Route::resource('cart', 'ShoppingCartsController');
Route::resource('bookings', 'BookingsController');
Route::resource('events', 'EventsController');

# Products Photo
Route::post('/products/{product}/photo', 'ProductsController@addPhoto')->name('add.product.photo');
Route::delete('/products/{product}/photo', 'ProductsController@deletePhoto')->name('delete.product.photo');
# Events Photo
Route::post('/events/{event}/photo', 'EventsController@addPhoto')->name('add.event.photo');
Route::delete('/events/{event}/photo', 'EventsController@deletePhoto')->name('delete.event.photo');
# Posts Photo
Route::post('/post/{slug}/photos', 'PhotosController@store')->name('add.photo');
Route::delete('/photo/{photo}', 'PhotosController@destroy')->name('delete.photo');
# Product Cart
Route::get('cart/add/{product}', 'PagesController@addToCart')->name('add.to.cart');
Route::get('cart/remove/{productId}/{qty}', 'PagesController@removeFromCart')->name('remove.from.cart');
Route::get('cart/destroy/all', 'PagesController@destroyCart')->name('destroy.cart');

Route::get('event/add/{event}', 'PagesController@addEventToCart')->name('add.event.to.cart');
Route::get('event/remove/{eventId}/{qty}', 'PagesController@removeEventFromCart')->name('remove.event.from.cart');
Route::get('event/destroy/all', 'PagesController@destroyEventCart')->name('destroy.event.cart');
