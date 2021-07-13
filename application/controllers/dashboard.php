<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->library('form_validation');
}

   public function index(){

    if($this->session->userdata('token') == ''){
      return redirect(base_url('dashboard/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'title' => 'Dashboard | Home'
        ];

        $this->load->view('layout/header',$data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar',$data);
        $this->load->view('dashboard');
        $this->load->view('layout/footer');
      }
     }
    }
    public function login(){

      $this->load->view('login');
        }
        public function prosesLogin(){
          $url = base_url('/api/auth/login');
      
          $username = $this->input->post('username');
          $password = $this->input->post('password');
      
          $data = array(
                  'username'      => $username,
                  'password' => $password 
          );
      
          $data_string = json_encode($data);
      
          $curl = curl_init($url);
      
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
      
          curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
          );
      
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data
      
          // Send the request
          $result = curl_exec($curl);
      
          // Free up the resources $curl is using
          curl_close($curl);
      
          $cekLogin = json_decode($result,true);
      
          if(isset($cekLogin['status'])){
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Invalid Login');
                window.location.href='".base_url('dashboard/login')."';
                </script>");
            return;
          }
          if(isset($cekLogin['token'])){
            if($cekLogin['role'] == 'admin'){
              $this->session->set_userdata('token', $cekLogin['token']);
              $this->session->set_userdata('username', $username);
              $this->session->set_userdata('isLoginAdmin', true);
              return redirect(base_url('dashboard'));
            }else{
              $this->session->set_userdata('isLoginAdmin', true);
              echo ("<script LANGUAGE='JavaScript'>
              window.alert('You dont have access');
              window.location.href='".base_url('dashboard/login')."';
              </script>");
              return;
            }
          }
         
        }
        public function logout(){
          if($this->session->userdata('token')){
            session_destroy();
          }
          return redirect(base_url('dashboard/login'));
        }

    public function list_user(){
      if($this->session->userdata('token') == ''){
        return redirect(base_url('dashboard/login'));
      }else{
        if($this->session->userdata('isLoginAdmin') == true){
          $data = [
            'username' => $this->session->userdata('username'),
            'title' => 'Dashboard | User'
          ];
       $url = base_url('/api/main/users');
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'Authorization: Bearer '.$this->session->userdata('token')
          )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
        // Send the request
        $result = curl_exec($curl);
        // Free up the resources $curl is using
        curl_close($curl);

        $getUser = json_decode($result,true);
        $user['datauser'] = $getUser['data'];
        
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('user',$user);
        $this->load->view('layout/footer');
      }
    }
   }
        
        public function delete_user($id){
          $url = base_url('/api/main/users/id/'.$id);
                 $curl = curl_init($url);
                 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
             
                 curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                  'Authorization: Bearer '.$this->session->userdata('token')
                   )
                 );
                 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                 // Send the request
                 $result = curl_exec($curl);
                 // Free up the resources $curl is using
                 curl_close($curl);
                 $deleteUser = json_decode($result,true);
                 if($deleteUser['status'] == 200){
                   echo ("<script LANGUAGE='JavaScript'>
                   window.alert('User deleted!');
                   window.location.href='".base_url('dashboard/list_user')."';
                   </script>");
                 }else{
                   echo ("<script LANGUAGE='JavaScript'>
                   window.alert('Failed to delete');
                   window.location.href='".base_url('dashboard/list_user')."';
                   </script>");
                 }
         
         }


         public function list_order(){
          if($this->session->userdata('token') == ''){
            return redirect(base_url('dashboard/login'));
          }else{
            if($this->session->userdata('isLoginAdmin') == true){
              $data = [
                'username' => $this->session->userdata('username'),
                'title' => 'Dashboard | User'
              ];
          $url = base_url('/api/main/pesanan');
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer '.$this->session->userdata('token')
              )
            );
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            // Send the request
            $result = curl_exec($curl);
            // Free up the resources $curl is using
            curl_close($curl);
    
            $getOrder = json_decode($result,true);
            $order['dataorder'] = $getOrder['data'];
            
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('layout/navbar');
            $this->load->view('order',$order);
            $this->load->view('layout/footer');
            }
          }
        }
            
            public function delete_order($id){
              $url = base_url('/api/main/order/id/'.$id);
                     $curl = curl_init($url);
                     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                 
                     curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                      'Authorization: Bearer '.$this->session->userdata('token')
                       )
                     );
                     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                     // Send the request
                     $result = curl_exec($curl);
                     // Free up the resources $curl is using
                     curl_close($curl);
                     $deleteUser = json_decode($result,true);
                     if($deleteUser['status'] == 200){
                       echo ("<script LANGUAGE='JavaScript'>
                       window.alert('User deleted!');
                       window.location.href='".base_url('dashboard/list_user')."';
                       </script>");
                     }else{
                       echo ("<script LANGUAGE='JavaScript'>
                       window.alert('Failed to delete');
                       window.location.href='".base_url('dashboard/list_user')."';
                       </script>");
                     }
             
             }

             public function list_menu(){
              if($this->session->userdata('token') == ''){
                return redirect(base_url('dashboard/login'));
              }else{
                if($this->session->userdata('isLoginAdmin') == true){
                  $data = [
                    'username' => $this->session->userdata('username'),
                    'title' => 'Dashboard | User'
                  ];
              $url = base_url('/api/main/menu');
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                  'Authorization: Bearer '.$this->session->userdata('token')
                  )
                );
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                // Send the request
                $result = curl_exec($curl);
                // Free up the resources $curl is using
                curl_close($curl);
        
                $getMenu = json_decode($result,true);
                $menu['datamenu'] = $getMenu['data'];
                
                $this->load->view('layout/header');
                $this->load->view('layout/sidebar');
                $this->load->view('layout/navbar');
                $this->load->view('menu',$menu);
                $this->load->view('layout/footer');
                }
              }
            }
                
                public function delete_menu($id){
                  $url = base_url('/api/main/menu/id/'.$id);
                         $curl = curl_init($url);
                         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                     
                         curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                          'Authorization: Bearer '.$this->session->userdata('token')
                           )
                         );
                         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                         // Send the request
                         $result = curl_exec($curl);
                         // Free up the resources $curl is using
                         curl_close($curl);
                         $deleteUser = json_decode($result,true);
                         if($deleteUser['status'] == 200){
                           echo ("<script LANGUAGE='JavaScript'>
                           window.alert('User deleted!');
                           window.location.href='".base_url('dashboard/list_user')."';
                           </script>");
                         }else{
                           echo ("<script LANGUAGE='JavaScript'>
                           window.alert('Failed to delete');
                           window.location.href='".base_url('dashboard/list_user')."';
                           </script>");
                         }
                 
                 }


                 public function list_meja(){
                  if($this->session->userdata('token') == ''){
                    return redirect(base_url('dashboard/login'));
                  }else{
                    if($this->session->userdata('isLoginAdmin') == true){
                      $data = [
                        'username' => $this->session->userdata('username'),
                        'title' => 'Dashboard | User'
                      ];
                  $url = base_url('/api/main/meja');
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                      'Authorization: Bearer '.$this->session->userdata('token')
                      )
                    );
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                    // Send the request
                    $result = curl_exec($curl);
                    // Free up the resources $curl is using
                    curl_close($curl);
            
                    $getMeja = json_decode($result,true);
                    $meja['datameja'] = $getMeja['data'];
                    
                    $this->load->view('layout/header');
                    $this->load->view('layout/sidebar');
                    $this->load->view('layout/navbar');
                    $this->load->view('meja',$meja);
                    $this->load->view('layout/footer');
                    }
                  }
                }

                    
                    public function delete_meja($id){
                      $url = base_url('/api/main/meja/id/'.$id);
                             $curl = curl_init($url);
                             curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                         
                             curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                              'Authorization: Bearer '.$this->session->userdata('token')
                               )
                             );
                             curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                             // Send the request
                             $result = curl_exec($curl);
                             // Free up the resources $curl is using
                             curl_close($curl);
                             $deleteUser = json_decode($result,true);
                             if($deleteUser['status'] == 200){
                               echo ("<script LANGUAGE='JavaScript'>
                               window.alert('User deleted!');
                               window.location.href='".base_url('dashboard/list_user')."';
                               </script>");
                             }else{
                               echo ("<script LANGUAGE='JavaScript'>
                               window.alert('Failed to delete');
                               window.location.href='".base_url('dashboard/list_user')."';
                               </script>");
                             }
                     
                     }

                      public function create_menu(){
                        if($this->session->userdata('token') == ''){
                          return redirect(base_url('dashboard/login'));
                        }else{
                          if($this->session->userdata('isLoginAdmin') == true){
                            $data = [
                              'username' => $this->session->userdata('username'),
                              'title' => 'Dashboard | Menu'
                            ];
                            $dataCreate = [
                              'name'=> $this->input->post('name'),
                              'price'=> $this->input->post('price'),
                              'type'=> $this->input->post('type')
                            ];
                    
                            $config = array(
                              'upload_path' => "./uploads/",             //path for upload
                              'allowed_types' => "gif|jpg|png|jpeg",   //restrict extension
                              'max_size' => '10000',
                              'max_width' => '10242',
                              'max_height' => '768323',
                              'file_name' => 'menu_'.date('ymdhis')
                              );
                    
                              $this->load->library('upload',$config);
                    
                              if($this->upload->do_upload('image')) 
                              {
                    
                                $data = array('upload_data' => $this->upload->data());
                                $path = $config['upload_path'].'/'.$data['upload_data']['orig_name'];
                                $filename = $data['upload_data']['orig_name'];
                                $dataCreate['image'] = $filename;
                  
                                $url = base_url('/api/main/menu');
                                $curl = curl_init($url);
                                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                            
                                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                  'Authorization: Bearer '.$this->session->userdata('token')
                                  )
                                );
                        
                                /* Set JSON data to POST */
                                curl_setopt($curl, CURLOPT_POSTFIELDS, $dataCreate);
                        
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                // Send the request
                                $result = curl_exec($curl);
                                // Free up the resources $curl is using
                                curl_close($curl);
                        
                                $getMenu = json_decode($result,true);
                                $menu['datamenu'] = $getMenu['data'];
                        
                                
                                echo ("<script LANGUAGE='JavaScript'>
                                window.alert('Berhasil di simpan');
                                window.location.href='".base_url('dashboard/list_menu')."';
                                </script>");
                                return;
                  
                            }
                        }
                      }
    }
                          public function edit_menu($id){
                            if($this->session->userdata('token') == ''){
                              return redirect(base_url('dashboard/login'));
                            }else{
                              if($this->session->userdata('isLoginAdmin') == true){
                                $data = [
                                  'username' => $this->session->userdata('username'),
                                  'title' => 'Dashboard | Menu'
                                ];
                                $url = base_url('/api/main/menu/id/'.$id);
                                $curl = curl_init($url);
                                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                            
                                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                  'Authorization: Bearer '.$this->session->userdata('token')
                                  )
                                );
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                // Send the request
                                $result = curl_exec($curl);
                                // Free up the resources $curl is using
                                curl_close($curl);
                        
                                $getMenu = json_decode($result,true);
                                $menu['datamenu'] = $getMenu['data'];
                        
                        
                        
                                $this->load->view('layout/header',$data);
                                $this->load->view('layout/sidebar');
                                $this->load->view('layout/navbar',$data);
                                $this->load->view('edit_menu',$menu);
                                $this->load->view('layout/footer');
                              }
                            }
      
                          }
  
                          public function proses_edit_menu($id){
                            if($this->session->userdata('token') == ''){
                              return redirect(base_url('dashboard/login'));
                            }else{
                              if($this->session->userdata('isLoginAdmin') == true){
                                $data = [
                                  'username' => $this->session->userdata('username'),
                                  'title' => 'Dashboard | Menu'
                                ];
                                $dataCreate = [
                                  'name'=> $this->input->post('name'),
                                  'price'=> $this->input->post('price'),
                                  'type'=> $this->input->post('type')
                                ];
                        
                                $url = base_url('/api/main/menu/id/'.$id);
                                $curl = curl_init($url);
                                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                            
                                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                  'Authorization: Bearer '.$this->session->userdata('token')
                                  )
                                );
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                // Send the request
                                $result = curl_exec($curl);
                                // Free up the resources $curl is using
                                curl_close($curl);
                        
                                $getMenu = json_decode($result,true);
                                $datamenu = $getMenu['data'];
                        
                        
                                $config = array(
                                  'upload_path' => "./uploads/",             //path for upload
                                  'allowed_types' => "gif|jpg|png|jpeg",   //restrict extension
                                  'max_size' => '10000',
                                  'max_width' => '10242',
                                  'max_height' => '768323',
                                  'file_name' => 'menu_'.date('ymdhis')
                                  );
                        
                                  $this->load->library('upload',$config);
                        
                                  if($this->upload->do_upload('image')) 
                                  {
                                      $data = array('upload_data' => $this->upload->data());
                                      $path = $config['upload_path'].'/'.$data['upload_data']['orig_name'];
                                      $filename = $data['upload_data']['orig_name'];
                                      $dataCreate['image'] = $filename;
                                      $dataPut= json_encode($dataCreate);
                        
                        
                                      // var_dump($dataCreate);die();
                                      $url = base_url('/api/main/menu/id/'.$id);
                                      $curl = curl_init($url);
                                      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                                  
                                      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                        'Authorization: Bearer '.$this->session->userdata('token'),
                                        'Content-Type:application/json'
                                        )
                                      );
                        
                                      /* Set JSON data to POST */
                                      curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
                              
                                      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                      // Send the request
                                      $result = curl_exec($curl);
                                      // Free up the resources $curl is using
                                      curl_close($curl);
                              
                                      $getMenu = json_decode($result,true);
                                      $menu['datamenu'] = $getMenu['status'];
                              
                                      echo ("<script LANGUAGE='JavaScript'>
                                      window.alert('Berhasil di edit');
                                      window.location.href='".base_url('dashboard/list_menu')."';
                                      </script>");
                                      return;
                        
                                  }else{
                                    
                                      $dataCreate['image'] = $datamenu[0]['image'];
                        
                                      $dataPut= json_encode($dataCreate);
                                      $url = base_url('/api/main/menu/id/'.$id);
                                      $curl = curl_init($url);
                                      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                                  
                                      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                        'Authorization: Bearer '.$this->session->userdata('token'),
                                        'Content-Type:application/json'
                                        )
                                      );
                              
                                      /* Set JSON data to POST */
                                      curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
                              
                                      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                      // Send the request
                                      $result = curl_exec($curl);
                                      // Free up the resources $curl is using
                                      curl_close($curl);
                              

                                      $getMenu = json_decode($result,true);
                                      $menu['datamenu'] = $getMenu['status'];
                        
                                      echo ("<script LANGUAGE='JavaScript'>
                                      window.alert('Berhasil di edit');
                                      window.location.href='".base_url('dashboard/list_menu')."';
                                      </script>");
                                      return;
                                  }
                              }
                            }
                          }
                          public function create_order(){
                            if($this->session->userdata('token') == ''){
                              return redirect(base_url('dashboard/login'));
                            }else{
                              if($this->session->userdata('isLoginAdmin') == true){
                                $data = [
                                  'username' => $this->session->userdata('username'),
                                  'title' => 'Dashboard | Menu'
                                ];
                                $dataCreate = [
                                  'no_meja'=> $this->input->post('no_meja'),
                                  'waktu_order'=> $this->input->post('waktu_order'),
                                ];
                        
                
                      
                                    $url = base_url('/api/main/order');
                                    $curl = curl_init($url);
                                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                                
                                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                      'Authorization: Bearer '.$this->session->userdata('token')
                                      )
                                    );
                            
                                    /* Set JSON data to POST */
                                    curl_setopt($curl, CURLOPT_POSTFIELDS, $dataCreate);
                            
                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                    // Send the request
                                    $result = curl_exec($curl);
                                    // Free up the resources $curl is using
                                    curl_close($curl);
                            
                                    $getOrder = json_decode($result,true);
                                    $order['datamenu'] = $getOrder['data'];
                            
                                    
                                    echo ("<script LANGUAGE='JavaScript'>
                                    window.alert('Berhasil di simpan');
                                    window.location.href='".base_url('dashboard/list_order')."';
                                    </script>");
                                    return;
                      
                                }
                            }
                          }
                          public function edit_order($id){
                            if($this->session->userdata('token') == ''){
                              return redirect(base_url('dashboard/login'));
                            }else{
                              if($this->session->userdata('isLoginAdmin') == true){
                                $data = [
                                  'username' => $this->session->userdata('username'),
                                  'title' => 'Dashboard | Menu'
                                ];
                                $url = base_url('/api/main/order/id/'.$id);
                                $curl = curl_init($url);
                                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                            
                                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                  'Authorization: Bearer '.$this->session->userdata('token')
                                  )
                                );
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                // Send the request
                                $result = curl_exec($curl);
                                // Free up the resources $curl is using
                                curl_close($curl);
                        
                                $getMenu = json_decode($result,true);
                                $menu['datamenu'] = $getMenu['data'];
                        
                        
                        
                                $this->load->view('layout/header',$data);
                                $this->load->view('layout/sidebar');
                                $this->load->view('layout/navbar',$data);
                                $this->load->view('edit_order',$menu);
                                $this->load->view('layout/footer');
                              }
                            }
      
                          }     
                          public function proses_edit_order($id){
                            if($this->session->userdata('token') == ''){
                              return redirect(base_url('dashboard/login'));
                            }else{
                              if($this->session->userdata('isLoginAdmin') == true){
                                $data = [
                                  'username' => $this->session->userdata('username'),
                                  'title' => 'Dashboard | Order'
                                ];
                                $dataCreate = [
                                  'no_meja'=> $this->input->post('no_meja'),
                                  'waktu_order'=> $this->input->post('waktu_order'),
                                ];
                          
                                $url = base_url('/api/main/order/id/'.$id);
                                $curl = curl_init($url);
                                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                            
                                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                  'Authorization: Bearer '.$this->session->userdata('token')
                                  )
                                );
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                // Send the request
                                $result = curl_exec($curl);
                                // Free up the resources $curl is using
                                curl_close($curl);
                          
                                $getMenu = json_decode($result,true);
                                $datamenu = $getMenu['data'];
                          
                          
                                      $dataPut= json_encode($dataCreate);
                          
                          
                                      // var_dump($dataCreate);die();
                                      $url = base_url('/api/main/order/id/'.$id);
                                      $curl = curl_init($url);
                                      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                                  
                                      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                        'Authorization: Bearer '.$this->session->userdata('token'),
                                        'Content-Type:application/json'
                                        )
                                      );
                          
                                      /* Set JSON data to POST */
                                      curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
                              
                                      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                      // Send the request
                                      $result = curl_exec($curl);
                                      // Free up the resources $curl is using
                                      curl_close($curl);
                              
                                      $getMenu = json_decode($result,true);
                                      $menu['datamenu'] = $getMenu['status'];
                              
                                      echo ("<script LANGUAGE='JavaScript'>
                                      window.alert('Berhasil di edit');
                                      window.location.href='".base_url('dashboard/list_order')."';
                                      </script>");
                                      return;
                          
                              }
                            }
                          } 
                          public function create_meja(){
                            if($this->session->userdata('token') == ''){
                              return redirect(base_url('dashboard/login'));
                            }else{
                              if($this->session->userdata('isLoginAdmin') == true){
                                $data = [
                                  'username' => $this->session->userdata('username'),
                                  'title' => 'Dashboard | Menu'
                                ];
                                $dataCreate = [
                                  'no_meja'=> $this->input->post('no_meja'),
                                ];
                        
                                $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
                                $config['cacheable']    = true; //boolean, the default is true
                                $config['cachedir']     = './uploads/'; //string, the default is application/cache/
                                $config['errorlog']     = './uploads/'; //string, the default is application/logs/
                                $config['imagedir']     = './uploads/'; //direktori penyimpanan qr code
                                $config['quality']      = true; //boolean, the default is true
                                $config['size']         = '1024'; //interger, the default is 1024
                                $config['black']        = array(224,255,255); // array, default is array(255,255,255)
                                $config['white']        = array(70,130,180); // array, default is array(0,0,0)
                                $this->ciqrcode->initialize($config);
                         
                                $image_name=$dataCreate['no_meja'].date('ymdhis').'.png'; //buat name dari qr code sesuai dengan nim
                         
                                $params['data'] = $dataCreate['no_meja']; //data yang akan di jadikan QR CODE
                                $params['level'] = 'H'; //H=High
                                $params['size'] = 10;
                                $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
                                $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
                
                                $dataCreate['barcode']= $image_name;
                      
                                    $url = base_url('/api/main/meja');
                                    $curl = curl_init($url);
                                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                                
                                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                      'Authorization: Bearer '.$this->session->userdata('token')
                                      )
                                    );
                            
                                    /* Set JSON data to POST */
                                    curl_setopt($curl, CURLOPT_POSTFIELDS, $dataCreate);
                            
                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                    // Send the request
                                    $result = curl_exec($curl);
                                    // Free up the resources $curl is using
                                    curl_close($curl);
                            
                                    $getOrder = json_decode($result,true);
                                    $order['datamenu'] = $getOrder['data'];
                            
                                    
                                    echo ("<script LANGUAGE='JavaScript'>
                                    window.alert('Berhasil di simpan');
                                    window.location.href='".base_url('dashboard/list_meja')."';
                                    </script>");
                                    return;
                      
                                }
                            }
                          }  
                          public function edit_meja($id){
                            if($this->session->userdata('token') == ''){
                              return redirect(base_url('dashboard/login'));
                            }else{
                              if($this->session->userdata('isLoginAdmin') == true){
                                $data = [
                                  'username' => $this->session->userdata('username'),
                                  'title' => 'Dashboard | Menu'
                                ];
                                $url = base_url('/api/main/meja/id/'.$id);
                                $curl = curl_init($url);
                                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                            
                                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                  'Authorization: Bearer '.$this->session->userdata('token')
                                  )
                                );
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                // Send the request
                                $result = curl_exec($curl);
                                // Free up the resources $curl is using
                                curl_close($curl);
                        
                                $getMenu = json_decode($result,true);
                                $menu['datamenu'] = $getMenu['data'];
                        
                        
                        
                                $this->load->view('layout/header',$data);
                                $this->load->view('layout/sidebar');
                                $this->load->view('layout/navbar',$data);
                                $this->load->view('edit_meja',$menu);
                                $this->load->view('layout/footer');
                              }
                            }
      
                          }  
                          public function proses_edit_meja($id){
                            if($this->session->userdata('token') == ''){
                              return redirect(base_url('dashboard/login'));
                            }else{
                              if($this->session->userdata('isLoginAdmin') == true){
                                $data = [
                                  'username' => $this->session->userdata('username'),
                                  'title' => 'Dashboard | Meja'
                                ];
                                $dataCreate = [
                                  'no_meja'=> $this->input->post('no_meja'),
                                ];
                          
                                $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
                                $config['cacheable']    = true; //boolean, the default is true
                                $config['cachedir']     = './uploads/'; //string, the default is application/cache/
                                $config['errorlog']     = './uploads/'; //string, the default is application/logs/
                                $config['imagedir']     = './uploads/'; //direktori penyimpanan qr code
                                $config['quality']      = true; //boolean, the default is true
                                $config['size']         = '1024'; //interger, the default is 1024
                                $config['black']        = array(224,255,255); // array, default is array(255,255,255)
                                $config['white']        = array(70,130,180); // array, default is array(0,0,0)
                                $this->ciqrcode->initialize($config);
                         
                                $image_name=$dataCreate['no_meja'].date('ymdhis').'.png'; //buat name dari qr code sesuai dengan nim
                         
                                $params['data'] = $dataCreate['no_meja']; //data yang akan di jadikan QR CODE
                                $params['level'] = 'H'; //H=High
                                $params['size'] = 10;
                                $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
                                $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
                
                                $dataCreate['barcode']= $image_name;
              


                                $url = base_url('/api/main/meja/id/'.$id);
                                $curl = curl_init($url);
                                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                            
                                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                  'Authorization: Bearer '.$this->session->userdata('token')
                                  )
                                );
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                // Send the request
                                $result = curl_exec($curl);
                                // Free up the resources $curl is using
                                curl_close($curl);
                          
                                $getMenu = json_decode($result,true);
                                $datamenu = $getMenu['data'];
                          
                          
                                      $dataPut= json_encode($dataCreate);
                          
                          
                                      // var_dump($dataCreate);die();
                                      $url = base_url('/api/main/meja/id/'.$id);
                                      $curl = curl_init($url);
                                      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                                  
                                      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                        'Authorization: Bearer '.$this->session->userdata('token'),
                                        'Content-Type:application/json'
                                        )
                                      );
                          
                                      /* Set JSON data to POST */
                                      curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
                              
                                      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                                      // Send the request
                                      $result = curl_exec($curl);
                                      // Free up the resources $curl is using
                                      curl_close($curl);
                              
                                      $getMenu = json_decode($result,true);
                                      $menu['datamenu'] = $getMenu['status'];
                              
                                      echo ("<script LANGUAGE='JavaScript'>
                                      window.alert('Berhasil di edit');
                                      window.location.href='".base_url('dashboard/list_meja')."';
                                      </script>");
                                      return;
                          
                              }
                            }
                          }                    
                        }
          

       

