<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pajak_ctrl extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct(){
        parent::__construct();
        $this->load->model('M_pajak');
    }
	public function index()
	{
		$this->load->view('login');
	}
	public function login(){
	    $username = $this->input->post('username');
	    $password = $this->input->post('pass');
	    $where = array(
	        'username' => $username,
	        'password' => $password
	        // Hash ganti jadi 'password' => md5($password)
	    );
	    $cek = $this->M_pajak->cek_login("User_Pass",$where)->num_rows();
	    $cekrole = $this->M_pajak->cek_login("User_Pass",$where)->row_array();
	    $role = $cekrole['id_role'];
	    if($cek > 0){
	        $data_session = array(
	            'username' => $username
	        );
	        $this->session->set_userdata($data_session);
	        if($role == "1"){
	            $this->load->view('cs/home');
	        }
	        else if($role == "2"){
	            $this->load->view('approve/home');
	        }
	        else{
	            $this->load->view('user/home');
	        }
	    }
	    else{
	        echo "<script type='text/javascript'>
               alert ('Maaf Username Dan Password Anda Salah !');
                window.location = 'index';
				</script>";
	        
	    }
	    
	}
	public function menu($a)
	{
	    if ($a == "cshome"){
	        $this->load->view('cs/home');
	    }
	    else if($a == "cscari"){
	        $data['user'] = $this->M_pajak->data_pelanggan();
	        $this->load->view('cs/table',$data);
	    }
	    else if ($a == "csupload"){
	        $this->load->view('cs/forms');
	    }
	    else if ($a == "approvehome"){
	        $where = array(
	            'id_status' => "1"
	            // Hash ganti jadi 'password' => md5($password)
	        );
	        $data['pengajuan'] = $this->M_pajak->data_pengajuan("Status_pengajuan",$where)->result_array();
	        $this->load->view('approve/home');
	    }
	    else if ($a == "approvetable"){
	        $where = array(
	            'id_status' => "1"
	            // Hash ganti jadi 'password' => md5($password)
	        );
	        $data['pengajuan'] = $this->M_pajak->data_pengajuan("Status_pengajuan",$where)->result_array();
	        $this->load->view('approve/table',$data);
	    }
	    else if ($a == "userhome"){
	        $this->load->view('user/home');
	    }
	    else if ($a == "usertable"){
	        $username = $this->session->userdata('username');
	        $data['status']=$this->M_pajak->cek_status($username);
	        $where = array(
	            'No_KTP' => $username
	            // Hash ganti jadi 'password' => md5($password)
	        );
	        $data['STNK'] = $this->M_pajak->data_pengajuan("Data_Pelanggan",$where)->row_array();
	        $this->load->view('user/table',$data);
	    }
	    else if ($a == "usercetak"){
	        $data['user'] = array('id' => $this->session->userdata('username'));
	        $where = array(
	            'id_role' => '1'
	            // Hash ganti jadi 'password' => md5($password)
	        );
	        $data['STNK'] = $this->M_pajak->data_pengajuan("User_Pass",$where)->result_array();
	        $this->load->view('user/forms',$data);
	        
	    }
	    else if ($a == "cscetak"){
	        $username = $this->session->userdata('username');
	        $where = array(
	            'Tempat_Cetak' => $username,
	            'id_status' => '2'
	            // Hash ganti jadi 'password' => md5($password)
	        );
	        $data['list'] = $this->M_pajak->data_pengajuan("Status_pengajuan",$where)->result_array();
	        $this->load->view('cs/cetak',$data);
	        
	    }
	}
	function logout(){
	    $this->session->sess_destroy();
	    redirect(base_url());
	}
	function random_str(
	    int $length = 64,
	    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
	    ): string {
	        if ($length < 1) {
	            throw new \RangeException("Length must be a positive integer");
	        }
	        $pieces = [];
	        $max = mb_strlen($keyspace, '8bit') - 1;
	        for ($i = 0; $i < $length; ++$i) {
	            $pieces []= $keyspace[random_int(0, $max)];
	        }
	        return implode('', $pieces);
	}
	
	function senddb($data){
	    $random = $this->random_str(8,'abcdefghijklsmnopqrstuvwxyz0123456789');
	    $isi = array(
	        'id_pengajuan' => $random,
	        'No_KTP' => $data['noktp'],
	        'Scan_STNK' => $data['sstnk'],
	        'Scan_KTP' => $data['sstnk'],
	        'Scan_No_Rangka' => $data['srangka'],
	        'id_status' => "1",
	        'email' => $data['email']
	    );
	    $this->M_pajak->input_data('Status_pengajuan',$isi);
	    $this->send_email($data['noktp'], $random,$data['email']);
	}
	function tagihan(){
	    $no_ktp = $this->input->post('no_ktp');
	    $no_stnk = $this->input->post('no_stnk');
	    $email = $this->input->post('e_mail');
	    $nama = $_FILES['File1']['name'];
	    $file_tmp = $_FILES['File1']['tmp_name'];
	    $nama2 = $_FILES['File2']['name'];
	    $file_tmp2 = $_FILES['File2']['tmp_name'];
	    $nama3 = $_FILES['File3']['name'];
	    $file_tmp3 = $_FILES['File3']['tmp_name'];
	    $send = array(
	        'noktp' => $no_ktp,
	        'sktp' => $nama,
	        'sstnk' => $nama2,
	        'srangka'=> $nama3,
	        'email' => $email
	    );
	    $where = array(
	        'no_ktp' => $no_ktp
	    );
	    $cek = $this->M_pajak->cek_tagihan("Data_Pelanggan",$where)->row_array();
	    $cek1 = $this->M_pajak->cek_tagihan("Data_Pelanggan",$where)->num_rows();
	    $cek2 = $this->M_pajak->cek_tagihan("Status_pengajuan",$where)->num_rows();
	    $tagihan1=$cek['Tagihan_1'];
	    $tagihan2=$cek['Tagihan_2'];
	    $tagihan3=$cek['Tagihan_3'];
	    $tagihan4=$cek['Tagihan_4'];
	    $tagihan5=$cek['Tagihan_5'];
	    $totaltag = $tagihan1 + $tagihan2 + $tagihan3 + $tagihan4 + $tagihan5; 
	    if($totaltag == 0 && $cek1 > 0 && $cek2 == 0) {
	        move_uploaded_file($file_tmp, './uploads/'.$nama);
	        move_uploaded_file($file_tmp2, './uploads/'.$nama2);
	        move_uploaded_file($file_tmp3, './uploads/'.$nama3);
	        $this->senddb($send);
	    }
	    else if($totaltag != 0 && $cek1 > 0 && $cek2 == 0){
	        echo "<script type='text/javascript'>
               alert ('Maaf Anda masih memiliki tagihan mohon untuk melunasi terlebih dahulu');
				</script>";
	    }
	    else if($cek1 > 0 && $cek2!=0){
	        echo "<script type='text/javascript'>
               alert ('Maaf anda Sudah mengajukan sebelumnya');
				</script>";
	    }
	    else {
	        echo "<script type='text/javascript'>
               alert ('Maaf anda Belum terdaftar');
				</script>";
	    }
	}
	function send_email1($email){
	    $config['mailtype'] = 'text';
	    $config['protocol'] = 'smtp';
	    $config['smtp_host'] = 'ssl://smtp.gmail.com';
	    $config['smtp_user'] = 'harisbakhtiar27@gmail.com';
	    $config['smtp_pass'] = 'Sasuke981002';
	    $config['smtp_port'] = 465;
	    $config['newline'] = "\r\n";
	    
	    $this->load->library('email', $config);
	    
	    $this->email->from('no-reply@polri.com', 'Polri');
	    $this->email->to($email);
	    $this->email->subject('Username dan Password track STNK');
	    $this->email->message('Mohon Maaf Data anda kurang tepat silakan ajukan kembali. dengan menghubungi cs kami');
	    $this->email->send();
	}
	function send_email($user, $pass, $email) {
	    $config['mailtype'] = 'text';
          $config['protocol'] = 'smtp';
          $config['smtp_host'] = 'ssl://smtp.gmail.com';
          $config['smtp_user'] = 'harisbakhtiar27@gmail.com';
          $config['smtp_pass'] = 'Sasuke981002';
          $config['smtp_port'] = 465;
          $config['newline'] = "\r\n";

          $this->load->library('email', $config);

          $this->email->from('no-reply@polri.com', 'Polri');
          $this->email->to($email);
          $this->email->subject('Username dan Password track STNK');
          $this->email->message('Username :'.$user.'Password :'.$pass);

          if($this->email->send()) {
              $isi = array(
                  'Username' => $user,
                  'Password' => $pass,
                  'date_created' => date("Y-m-d"),
                  'id_role' => "3"
              );
              $this->M_pajak->input_data('User_Pass',$isi);
              $this->load->view('cs/forms');
          } 
          else {
               echo 'Email tidak berhasil dikirim';
               echo '<br />';
               echo $this->email->print_debugger();
          }
	}
	function download($file){
	    force_download('./uploads/'.$file, NULL);
	}
	function approve($id){
	    $nomer = $this->random_str(4,'123456789');
	    $digitbel = $this->random_str(2,'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
	    $platbaru = "N".$nomer.$digitbel;
	    $data = array(
	        'no_ken_new' => $platbaru,
	        'id_status' => "3"
	    );
	    $this->M_pajak->update_pengajuan('Status_pengajuan',$id,$data);
	    $this->menu("approvetable");
	}
	function reject($id){
	    $data= array('id_pengajuan' => $id);
	    $email=$this->M_pajak->data_pengajuan("Status_pengajuan",$data)->row_array();
	    $email = $email['email'];
	    echo $email;
	    $this->M_pajak->delete($id);
	    $this->send_email1($email);
	    $this->menu("approvetable");
	}
	function cetak(){
	    $id = $this->input->post('no_ktp');
	    $cetak = $this->input->post('cetak');
	    $where = array(
	        'No_KTP' => $id
	    );
	    $cek = $this->M_pajak->cek_tagihan("Status_pengajuan",$where)->row_array();
	    if ($cek['id_status'] == '3'){
	        $data = array(
	            'Tempat_Cetak' => $cetak,
	            'id_status' => "2"
	        );
	        $this->M_pajak->update_pengajuan1('Status_pengajuan',$id,$data);
	        $this->menu("usertable");
	    }
	    else{
	        echo "<script type='text/javascript'>
               alert ('Maaf data anda belum di approve');
				</script>";
	        $this->menu("usertable");
	    }
	}
	function done($id){
	    $id = array(
	        'id_pengajuan' => $id,
	    );
	    $data = array(
	        'id_status' => "4"
	    );
	    $data1 = $this->M_pajak->data_pengajuan("Status_pengajuan",$id)->row_array();
	    $ktp = $data1['No_KTP'];
	    $user = array(
	        'No_KTP' => $ktp,
	    );
	    $update = array(
	        'No_Kendaraan' => $data1['no_ken_new'],
	        'Tanggal_Cetal_STNK' => date("Y-m-d")
	    );
	    $this->M_pajak->update_done('Status_pengajuan',$id,$data);
	    $this->M_pajak->update_done('Data_Pelanggan',$user,$update);
	    $this->menu("cshome");
	}
}
