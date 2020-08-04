<?php

Route::any('products/search', 'ProductController@search')->name('products.search')->middleware('auth');
//já substitui todas as rotas comentadas a baixo (faz o CRUD completo)
Route::resource('products', 'ProductController')->middleware(['auth', 'check.is.admin']); 
/*
Route::get ('products/create', 'ProductController@create')->name('products.create');
Route::get ('products/{id}', 'ProductController@show')->name('products.show');
Route::get ('products', 'ProductController@index')->name('products.index');
Route::get ('products/{id}/edit', 'ProductController@edit')->name('products.edit');
Route::post('products', 'ProductController@store')->name('products.store');
Route::put ('products/{id}', 'ProductController@update')->name('products.update');
Route::delete ('products/{id}', 'ProductController@destroy')->name('products.destroy');
*/

Route::get('/login',function (){
    return 'Login';
})->name('login');

Route::view('/', 'welcome', ['x' => '6.x']);


/*
                    //rotas com parametros

Route::get('/teste/{x?}', function($t = ''){
    if ($t != ''):
        return $t;
    else:
        return "Paramentro vazio";
    endif;
});

                    //passando a view

// Route::get('/', function () {
//     return view('welcome');
// });


                    //passando a view diretamente (recomendado passar por um controller)
Route::view('/', 'welcome', ['x' => '2']); //passando parametros para a view


                    //redirecionamento de rotas


//Route::redirect('/rota1', '/rota2');

 Route::get('/rota1',function (){
     return redirect ()->route('name.route2');
 });

                    //nomeando rotas
Route::get('/rota2',function (){
    return 'rota 2';
})->name('name.route2');

Route::get('/login',function (){
    return 'Login';
})->name('login');


                    //middlewares

//Route::get ('admin/dashboard', function(){
//    return 'Home Admin';
//})->middleware('auth'); //para acessar essa rota, precisa estar autenticado (é necessario a rota login!)

                    //grupos de rotas
/*
Route::middleware(['auth'])->group(function(){ //pode ser passado apenas um middleware ('auth') ou um array (['auth', 'outro', ...])
   
    Route::prefix('admin')->group(function(){//todas as rotas do grupo terão o prefixo admin (ex: .../admin/dasboard)
   
        Route::namespace('Admin')->group(function(){
            //caso nao estivecem no grupo com o namespace 'Admin', seria necessario passar Admin\TesteController@teste como parametro

            Route::name('admin.')->group(function(){ //adiciona o prefixo admin. ao nome das rotas do grupo
                Route::get ('dashboard', 'TesteController@teste')->name('dashbord');
        
                Route::get ('financeiro', 'TesteController@teste')->name('financeiro');
            
                Route::get ('produtos', 'TesteController@teste')->name('protutos');
    
                Route::get('/', function(){
                    return redirect()->route('admin.dashboard');
                })->name('home');
            });
        });
        
    });
});
/

//desra forma o group name não funciona
Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin',
    'namespace' => 'Admin',
    //'name' => 'admin.' nao funciona
    ],function(){
        Route::get ('dashboard', 'TesteController@teste')->name('dashbord');
        
        Route::get ('financeiro', 'TesteController@teste')->name('financeiro');
            
        Route::get ('produtos', 'TesteController@teste')->name('protutos');
    
        Route::get('/', function(){
            return redirect()->route('dashbord'); //da forma mostrada a cima, seria feita o admin.dashboard
        })->name('home');
    }
);

*/
Auth::routes(['register' => false]);