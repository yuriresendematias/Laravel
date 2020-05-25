<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, Product $product)
    {
        $this->request = $request;
        $this->repository = $product;
        //$this->middleware('auth');
        //$this->middleware('auth')->only(['create', 'store']);
        //$this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderby('name')->paginate(20);
        //return view('teste', ['teste'=> $teste]);
        return view('admin.pages.products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductRequest $request)
    {
        //dd('OK');
        /*
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'nullable|min:3|max:10000',
            'photo' => 'required|image'
        ]);

        dd('OK');
        */

       /* if ($request->file('photo')->isValid())
        {
            $nameFile = $request->name . '.' . $request->photo->extension(); //pega o nome (valor do campo name do formulario) e a extensao do arquivo
            dd($request->photo->storeAs('products', $nameFile)); //atribui o valor de nameFile ao nome do arquivo
            //dd($request->photo->store('products')); //o arquivo sera armazenado dentro de storage/app/products
            //dd($request->photo->getClientOriginalName()); //não é bom salvar o arquivo com o nome original, pois podem colocar dois arquivos com o mesmo nome e um substituir o outro
        }*/
        //dd($request->except('name'));
        //dd($request->input('asdasd', 'noma aleatorio')); //primeiro parametro é o nome do parametro passado, se o parametro não existir, ele substitui o pelo segundo parametro
        // dd($request->has('description'));
        // dd($request->description);
        //dd($request->name);
        // dd($request->all());
        // dd($request->only(['name', 'description']));

        //$data = $request->only('name', 'description', 'price');
        $data = $request->only('name', 'description', 'price');

        if ($request->hasFile('image') && $request->image->isValid()) {
            dd('asdasd');
        }

        $product = $this->repository->create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$product = Product::where('id', $id)->first();
        //$product = Product::find($id);
        //if(!$product = Product::find($id))
        if(!$product = $this->repository->find($id))
            return redirect()->back();
        

        return view('admin.pages.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$product = $this->repository->find($id))
            return redirect()->back();

        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductRequest $request, $id)
    {
        //dd("Editando o produto {$id}");
        if(!$product = $this->repository->find($id))
            return redirect()->back();

        $product->update($request->all());

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //if (!$product = Product::find($id))
        if (!$product = $this->repository->find($id))
            return redirect()->back();

        $product->delete();
        
        return redirect()->route('products.index');

        dd("deletando o produto $id");
    }


    /**
     * Search Products
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $products = $this->repository->search($request->filter);

        return view('admin.pages.products.index', [
            'products' => $products,
            'filters' => $filters,
        ]);
    }

}
