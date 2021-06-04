<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class HomeController extends Controller
{
    public function index( Request $req ){
		// $api_url        = "https://portal.panelo.co/paneloresto/api/productlist/18";
		// $connection_c   = curl_init(); // initializing
		// curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
		// curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // Return the result, do not print
		// curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
		// $json_return    = curl_exec( $connection_c ); // Connect and get json data
		// curl_close( $connection_c ); // Close connection
		// $insta          = json_decode( $json_return ); // Decode and return
    	// $data['db'] = DB::table('product as p')
    	// 				->leftjoin('category as c','c.id','p.category_id')
    	// 				->select('p.*', 'c.name')
    	// 				->get();
    	$input= $req->all();
    	$data['input'] = $req->all();
    	$category = (isset($input['category']) ? $input['category'] : '');
        // $price_max = (isset($input['price_max']) ? $input['price_max'] : '');
        $data['db'] = DB::table('product as p')
    					->leftjoin('category as c','c.id','p.category_id')
    					->select('p.*', 'c.name')
                        ->when($category, function($query, $category) {
                        return $query->where('p.category_id', $category);
                        })
                        ->get();
        $data['cat'] = DB::table('category as c')->get();

        // $arr = get_defined_vars(); dd($arr);
        return view('home.index', $data);
    }

    public function pageUpdate($id = null)
    {
        $params = [];

        if($id){
            $object = DB::table('product')->where('id', $id)->first();
            if(!$object)
                {
                    return redirect()->route('/');
                }
            $params['title_form'] = "Update Page";
        }else{
            $object = "";
            $params['title_form'] = "Add Page";
        }

        $params['page'] = $object;
// $arr = get_defined_vars();
//             dd($arr);
        return view('home.update', $params);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function savePage($id = Null)
    {
        // $arr = get_defined_vars();
        // dd($arr);

        if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
          $data = Input::all();
          
          if($id == 0 ){
            $rules =  ['page_title'  => 'required|unique:page,title' , 'page_slug' => 'required'];
            $atributname = [
                'page_title.required' => 'The page title field is required.',
                'page_title.unique' => 'The page title can not be the same.',
                'page_slug.required' => 'The page slug field is required.',
            ];
          }else{
            $rules =  ['page_title'  => 'required' , 'page_slug' => 'required'];
            $atributname = [
                'page_title.required' => 'The page title field is required.',
                'page_slug.required' => 'The page slug field is required.',
            ];
          }

          $validator = Validator:: make($data, $rules, $atributname);

          if($validator->fails()){
            return redirect()->back()
            ->withInput()
            ->withErrors( $validator );
          }
          else{

            if($id == 0 ){
                $p        =  new Page; 

                $p->title                = Input::get('page_title');
                $p->slug                 = Input::get('page_slug');
                $p->content              = Input::get('page_content');
                $p->seo_schema           = Input::get('page_schema');
                $p->seo_title            = Input::get('page_meta_title');
                $p->seo_description      = Input::get('page_meta_description');
                $p->seo_keywords         = Input::get('page_meta_keywords');
                $p->created              = date("y-m-d H:i:s", strtotime('now'));
                $p->save();

                Session::flash('success-message', "Success add page" );
                return redirect()->route('admin.page_list');

            }else{

                $data = array(
                  'title'               => Input::get('page_title'),
                  'slug'                => Input::get('page_slug'),
                  'content'             => Input::get('page_content'),
                  'seo_schema'          => Input::get('page_schema'),
                  'seo_title'           => Input::get('page_meta_title'),
                  'seo_description'     => Input::get('page_meta_description'),
                  'seo_keywords'        => Input::get('page_meta_keywords'),
                  'created'             => date("y-m-d H:i:s", strtotime('now'))
                );
                Page::where('id', $id)->update($data);

                Session::flash('success-message', "Success update page" );
                return redirect()->route('admin.page_list');

            }
          }
        }

    }

    public function exportXML(){
    	$sales = DB::table('product')->get();

		try
		{

		    $xml = new XMLWriter();

		    $xml->openURI('documents/mailouts/example.xml');

		    $xml->startDocument('1.0');

		    $xml->startElement('product');

		    foreach ($sales as $sale) {


		        $xml->startElement('product');

		        $xml->writeElement('REF', $sale->title);
		        $xml->writeElement('COUNTY', $sale->price);


		        $xml->endElement();
		    }

		    $xml->endElement();
		    $xml->endDocument();

		    $xml->flush();

		    Session::flash('success', 'success.');
		}
		catch(Exception $e)
		{
		    Session::flash('error','problem');
		}


		return Redirect::route('/');
    }
}
