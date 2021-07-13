<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->model('Crud');
    }
	
	public function test_post()
	{
       
        $theCredential = $this->user_data;
        $this->response($theCredential, 200); // OK (200) being the HTTP response code
        
	}

    public function users_get()
   {
       $id = $this->get('id');

       if ($id == NULL)
       {
           $getUser =  $this->Crud->readData('id,name,username,role,notelpon','table_user')->result();
           if ($getUser)
           {
               // set the response and exit
               $output= [
                   'status' => 200,
                   'error' => false,
                   'massage' => 'Success get user',
                   'data' => $getUser
               ];
               $this->response($output, REST_Controller::HTTP_OK); //OK (200) being the HTTP response code
           }
           else
           {
               // set the response and exit
               $output=[
                   'status' => 404,
                   'error' => false,
                   'massage' => 'No user were found',
                   'data' => $getUser
               ];
               $this->response($output, REST_Controller::HTTP_NOT_FOUND); //OK (200) being the HTTP response code
           }
       }

       if($id){
           $where =[
               'id'=> $id
           ];
           $getUserById = $this->Crud->readData('id,name,username,role,notelpon','table_user',$where)->result();

           if($getUserById){
               $output = [
                'status' => 200,
                'error' => false,
                'massage' => 'Success get user',
                'data' => $getUserById
               ];
               $this->response($output, REST_Controller::HTTP_OK);
           }else{
               $output = [
                'status' => 404,
                'error' => false,
                'massage' => 'Faileed get User or id Not found',
                'data' => []
               ];
               $this->response($output, REST_Controller::HTTP_NOT_FOUND);
           }
       }
   }

   public function users_put(){

    $id = (int) $this->get('id');
    if($id){
        $where = [
            'id'=> $id
        ];
        $cekId = $this->Crud->readData('id','table_user',$where)->num_rows();

        if($cekId > 0){
            $data = [
                "name"      => $this->put('name'),
                "username"  => $this->put('username'),
                "password"  => sha1($this->put('password')),
                "role"      => $this->put('role'),
                "notelpon"      => $this->put('notelpon')
            ];

            $updateData = $this->Crud->updateData('table_user',$data,$where);
            if($updateData){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success edit user',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 400,
                    'error' => false,
                    'message' => 'Failed edit user',

                ];
                $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
            }
        }else{
            $output = [
                'status' => 404,
                'error' => false,
                'message' => 'Failed delete user or id not found',
            ];
            $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    }

    public function users_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_user',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('table_user',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete user',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete user or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }

    public function menu_post(){
        $name = $this->post('name');
        $type = $this->post('type');
        $image = $this->post('image');
        $price = $this->post('price');

        $data = [

        "name"=>$name,
        "type"=>$type,
        "image"=>$image,
        "price"=>$price
        ];

        $createMenu = $this->Crud->createData('table_menu',$data);

        if($createMenu){
            $output = [
                'status' => 200,
                'error' => false,
                'message' => 'Success Create Menu',
                'data' => $data
            ];

            
            $this->set_response($output, REST_Controller::HTTP_OK);
          
            
        }else{
            $output = [
                'status' => 400,
                'error' => false,
                'message' => 'Failed Create Menu',
                'data' => []
                ];
                $this->set_response($output, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function menu_get()
   {
       $id = $this->get('id');

       if ($id == NULL)
       {
           $getMenu =  $this->Crud->readData('id,name,image,price,type','table_menu')->result();
           if ($getMenu)
           {
               // set the response and exit
               $output= [
                   'status' => 200,
                   'error' => false,
                   'massage' => 'Success get Menu',
                   'data' => $getMenu
               ];
               $this->response($output, REST_Controller::HTTP_OK); //OK (200) being the HTTP response code
           }
           else
           {
               // set the response and exit
               $output=[
                   'status' => 404,
                   'error' => false,
                   'massage' => 'No Menus were found',
                   'data' => $getMenu
               ];
               $this->response($output, REST_Controller::HTTP_NOT_FOUND); //OK (200) being the HTTP response code
           }
       }

       if($id){
           $where =[
               'id'=> $id
           ];
           $getMenuById = $this->Crud->readData('id,name,image,price,type','table_menu',$where)->result();

           if($getMenuById){
               $output = [
                'status' => 200,
                'error' => false,
                'massage' => 'Success get Menu',
                'data' => $getMenuById
               ];
               $this->response($output, REST_Controller::HTTP_OK);
           }else{
               $output = [
                'status' => 404,
                'error' => false,
                'massage' => 'Faileed get Menu or id Not found',
                'data' => []
               ];
               $this->response($output, REST_Controller::HTTP_NOT_FOUND);
           }
       }
   }
   public function menu_put(){
    $id = (int) $this->get('id');
    if($id){
        $where = [
            'id'=> $id
        ];
        $cekId = $this->Crud->readData('id','table_menu',$where)->num_rows();

        if($cekId > 0){
            $data = [
                "name"   => $this->put('name'),
                "image"  => $this->put('image'),
                "price"  => $this->put('price'),
                "type"   => $this->put('type')
            ];

            $updateData = $this->Crud->updateData('table_menu',$data,$where);
            if($updateData){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success edit Menu',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 400,
                    'error' => false,
                    'message' => 'Failed edit Menu',

                ];
                $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
            }
        }else{
            $output = [
                'status' => 404,
                'error' => false,
                'message' => 'Failed delete user or id not found',
            ];
            $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
        }
    }
}

public function menu_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_menu',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('table_menu',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete Menu',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete Menu or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }
    public function meja_post(){
        $no_meja = $this->post('no_meja');
        $barcode = $this->post('barcode');


        $data = [

        "no_meja"=>$no_meja,
        "barcode"=>$barcode
        ];

        $createMeja = $this->Crud->createData('table_meja',$data);

        if($createMeja){
            $output = [
                'status' => 200,
                'error' => false,
                'message' => 'Success Create No Meja',
                'data' => $data
            ];

            
            $this->set_response($output, REST_Controller::HTTP_OK);
          
            
        }else{
            $output = [
                'status' => 400,
                'error' => false,
                'message' => 'Failed Create No Meja',
                'data' => []
                ];
                $this->set_response($output, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function meja_get()
   {
       $id = $this->get('id');

       if ($id == NULL)
       {
           $getMeja =  $this->Crud->readData('id,no_meja,barcode','table_meja')->result();
           if ($getMeja)
           {
               // set the response and exit
               $output= [
                   'status' => 200,
                   'error' => false,
                   'massage' => 'Success get Meja',
                   'data' => $getMeja
               ];
               $this->response($output, REST_Controller::HTTP_OK); //OK (200) being the HTTP response code
           }
           else
           {
               // set the response and exit
               $output=[
                   'status' => 404,
                   'error' => false,
                   'massage' => 'Number meja not found',
                   'data' => $getMeja
               ];
               $this->response($output, REST_Controller::HTTP_NOT_FOUND); //OK (200) being the HTTP response code
           }
       }

       if($id){
           $where =[
               'id'=> $id
           ];
           $getMejaById = $this->Crud->readData('id,no_meja,barcode','table_meja',$where)->result();

           if($getMejaById){
               $output = [
                'status' => 200,
                'error' => false,
                'massage' => 'Success get Meja',
                'data' => $getMejaById
               ];
               $this->response($output, REST_Controller::HTTP_OK);
           }else{
               $output = [
                'status' => 404,
                'error' => false,
                'massage' => 'Faileed get No Meja or id Not found',
                'data' => []
               ];
               $this->response($output, REST_Controller::HTTP_NOT_FOUND);
           }
       }
   }
   public function meja_put(){
    $id = (int) $this->get('id');
    if($id){
        $where = [
            'id'=> $id
        ];
        $cekId = $this->Crud->readData('id','table_meja',$where)->num_rows();

        if($cekId > 0){
            $data = [
                "no_meja"   => $this->put('no_meja'),
                "barcode"   => $this->put('barcode')
            ];

            $updateData = $this->Crud->updateData('table_meja',$data,$where);
            if($updateData){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success edit Meja',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 400,
                    'error' => false,
                    'message' => 'Failed edit Meja',

                ];
                $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
            }
        }else{
            $output = [
                'status' => 404,
                'error' => false,
                'message' => 'Failed delete user or id not found',
            ];
            $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
        }
    }
    }
    public function meja_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_meja',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('table_meja',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete Meja',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete Meja or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }
    public function order_post(){
        $no_meja = $this->post('no_meja');
        $waktu_order = $this->post('waktu_order');
 

        $data = [

        "no_meja"=>$no_meja,
        "waktu_order"=>$waktu_order
        ];

        $createOrder = $this->Crud->createData('table_order',$data);

        if($createOrder){
            $output = [
                'status' => 200,
                'error' => false,
                'message' => 'Success Create Order',
                'data' => $data
            ];

            
            $this->set_response($output, REST_Controller::HTTP_OK);
          
            
        }else{
            $output = [
                'status' => 400,
                'error' => false,
                'message' => 'Failed Create Order',
                'data' => []
                ];
                $this->set_response($output, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function order_get()
    {
        $id = $this->get('id');
 
        if ($id == NULL)
        {
            $getOrder =  $this->Crud->readData('id,no_meja,waktu_order','table_order')->result();
            if ($getOrder)
            {
                // set the response and exit
                $output= [
                    'status' => 200,
                    'error' => false,
                    'massage' => 'Success get Order',
                    'data' => $getOrder
                ];
                $this->response($output, REST_Controller::HTTP_OK); //OK (200) being the HTTP response code
            }
            else
            {
                // set the response and exit
                $output=[
                    'status' => 404,
                    'error' => false,
                    'massage' => 'Number Order not found',
                    'data' => $getOrder
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); //OK (200) being the HTTP response code
            }
        }
 
        if($id){
            $where =[
                'id'=> $id
            ];
            $getOrderById = $this->Crud->readData('id,no_meja,waktu_order','table_order',$where)->result();
 
            if($getOrderById){
                $output = [
                 'status' => 200,
                 'error' => false,
                 'massage' => 'Success get Order',
                 'data' => $getOrderById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                 'status' => 404,
                 'error' => false,
                 'massage' => 'Faileed get Order or id Not found',
                 'data' => []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
    public function order_put(){
        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_order',$where)->num_rows();
    
            if($cekId > 0){
                $data = [
                    "no_meja"   => $this->put('no_meja'),
                    "waktu_order"   => $this->put('waktu_order')
                ];
    
                $updateData = $this->Crud->updateData('table_order',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit Order',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit Order',
    
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete user or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
     }
     public function order_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_order',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('table_order',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete Order',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete order or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }

    public function  cart_post(){
        $name = $this->post('name');
        $idmenu = $this->post('idmenu');
        $user = $this->post('user');
        $qty  = $this->post('qty');
        $subtotal  = $this->post('subtotal');
        $price  = $this->post('price');
        $meja  = $this->post('meja');
        $dataArray = [
            "name"=>$name,
            "idmenu"=>$idmenu,
            "user"=>$user,
            "qty"=>$qty,
            "price"=>$price,
            "subtotal"=>$subtotal,
            "meja"=>$meja,
        ];

        $createUser = $this->Crud->createData('keranjang',$dataArray);
                
        if($createUser){
            $output = [
                'status' => 200,
                'error' => false,
                'message' => 'Success create cart',
                'data'=> $dataArray
            ];
            $this->set_response($output, REST_Controller::HTTP_OK); 
        }else{
            $output = [
                'status' => 400,
                'error' => false,
                'message' =>'Failed create cart',
                'data'=> []
            ];
            $this->set_response($output, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function cart_get($user)
    {
        if($user){
            $where = [
                'user'=> $user
            ];
            $getUserById = $this->Crud->readData('*','keranjang',$where)->result();

            if($getUserById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get cart',
                    'data'=> $getUserById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get cart or user Not found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }

    public function cart_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','keranjang',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('keranjang',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete cart',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete cart or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }

    public function  pesanan_post(){
        $tanggal = $this->post('tanggal');
        $nama = $this->post('nama');
        $item = $this->post('item');
        $meja = $this->post('meja');
      

        $itemnya =  json_encode($item);

        $dataArray = [
            "tanggal" => $tanggal,
            "nama" => $nama,
            "item"=> $itemnya,
            "meja" => $meja,
        ];

        $createUser = $this->Crud->createData('pesanan',$dataArray);
                
        if($createUser){
            $output = [
                'status' => 200,
                'error' => false,
                'message' => 'Success create order',
                'data'=> $dataArray
            ];
            $this->set_response($output, REST_Controller::HTTP_OK); 
        }else{
            $output = [
                'status' => 400,
                'error' => false,
                'message' =>'Failed create order',
                'data'=> []
            ];
            $this->set_response($output, REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    public function pesanan_get()
    {

        $id = $this->get('id');


        if ($id === NULL)
        {
            $getUser = $this->Crud->readData('*','pesanan')->result();
            if ($getUser)
            {
                // Set the response and exit
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get pesanan',
                    'data'=> $getUser
                ];
                $this->response($output, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'No pesananan were found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        if($id){
            $where = [
                'id'=> $id
            ];
            $getUserById = $this->Crud->readData('*','menu',$where)->result();

            if($getUserById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get pesanan',
                    'data'=> $getUserById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get pesanan or id Not found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }

    public function pesananpribadi_get($user)
    {
        if($user){
            $where = [
                'nama'=> $user
            ];
            $getUserById = $this->Crud->readData('*','pesanan',$where)->result();

            if($getUserById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get pesanan',
                    'data'=> $getUserById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get pesanan or user Not found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }
}