<?php

namespace Javan\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Javan\Product;

class ProductsController extends Controller
{
	/**
	 * ProductsController constructor.
	 */
	public function __construct()
	{
		$this->middleware(['auth', 'admin'], ['except' => ['index']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$sortBy    = request()->get('sortBy');
		$direction = request()->get('direction');
		$params    = compact('sortBy', 'direction');

		if ($sortBy && $direction) {
			$products = Product::orderBy($params['sortBy'], $params['direction'])->get();
		} else {
			$products = Product::all();
		}

		return view('products.index', compact('products'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('products.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'    => 'required',
			'price'    => 'required|numeric',
			'category' => 'required',
		]);

		$product = Product::create($request->all());

		flash()->success('Success', 'Product has been added to the menu');

		return redirect()->route('products.show', $product->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \Javan\Product $products
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $products)
	{
		return view('products.show', compact('products'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \Javan\Product $products
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Product $products)
	{
		return view('products.edit', compact('products'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param \Javan\Product $products
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Product $products)
	{
		$this->validate($request, [
			'title'    => 'required',
			'price'    => 'required|numeric',
			'category' => 'required',
		]);

		$products->update($request->all());

		flash()->success('Success', 'Menu has been updated');

		return redirect()->route('products.show', $products->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \Javan\Product $products
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy(Product $products)
	{
		$products->delete();

		flash()->success('Success', 'Product has been removed');

		return back();
	}

	/**
	 * @param \Javan\Product $product
	 * @param \Illuminate\Http\Request $request
	 * @return \Symfony\Component\HttpFoundation\File\File
	 * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
	 */
	public function addPhoto(Product $product, Request $request)
	{
		$this->validate($request, [
			'photo' => 'mimes:jpg,jpeg,png,bmp',
		]);

		$file = $request->file('photo');
		$name = time() . '-' . $file->getClientOriginalName();
		$product->update(['image_path' => 'images/products/' . $name]);

		return $file->move('images/products', $name);
	}

	/**
	 * @param \Javan\Product $product
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deletePhoto(Product $product)
	{
		File::delete([$product->image_path]);

		$product->update(['image_path' => NULL]);

		flash()->success('Success', 'Image has been deleted');

		return back();
	}
}
