<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_user($username, $password) {
        $belajarapi = $this->load->database('belajarapi', TRUE);
        $belajarapi->select('username,nama');
        $pass = md5($password);
        $belajarapi->where('username', $username);
        $belajarapi->where('password', $pass);
        $qryget = $belajarapi->get('user');
        $belajarapi->close();
        return $qryget;
    }

    function addBerita($judul,$pembaca){
        $belajarapi = $this->load->database('belajarapi', TRUE);
        $berita = array(
            'judul' => $judul,
            'pembaca' => $pembaca
        );
        $belajarapi->insert('berita', $berita);
        $belajarapi->close();
        return $belajarapi;
    }

    function getAllUser() {
        $belajarapi = $this->load->database('belajarapi', TRUE);
        $belajarapi->select('username,nama,email,phone');
        $qryget = $belajarapi->get('user');
        $belajarapi->close();
        return $qryget;
    }

    function getUser($username) {
        $belajarapi = $this->load->database('belajarapi', TRUE);
        $belajarapi->select('username,nama,email,phone,bio,password');
        $belajarapi->where('username', $username);
        $qryget = $belajarapi->get('user');
        $belajarapi->close();
        return $qryget;
    }

    function postUser($id_user) {
        $belajarapi = $this->load->database('belajarapi', TRUE);
        $belajarapi->select('*');
        $belajarapi->where('id_user', $id_user);
        $qryget = $belajarapi->get('user');
        $belajarapi->close();
        return $qryget;
    }

    function cek_user($username) {
        $belajarapi = $this->load->database('belajarapi', TRUE);
        $belajarapi->select('username');
        $belajarapi->where('username', $username);
        $qryget = $belajarapi->get('user');
        $belajarapi->close();
        return $qryget;
    }

    function cek_nohp($nohp) {
        $belajarapi = $this->load->database('belajarapi', TRUE);
        $belajarapi->select('phone');
        $belajarapi->where('phone', $nohp);
        $qryget = $belajarapi->get('user');
        $belajarapi->close();
        return $qryget;
    }

    function cek_pw($username)
    {
        $belajarapi = $this->load->database('belajarapi', TRUE);
        $belajarapi->select('password');
        $belajarapi->where('username', $username);
        $qryget = $belajarapi->get('user');
        $belajarapi->close();
        return $qryget->row();
    }

    function cek_fielduser($field, $username)
    {
        $belajarapi = $this->load->database('belajarapi', TRUE);
        $belajarapi->select($field);
        $belajarapi->where('username', $username);
        $qryget = $belajarapi->get('user');
        $belajarapi->close();
        return $qryget->row();
    }

    function create_user($username, $nama, $password, $email, $phone, $foto) {
        $belajarapi = $this->load->database('belajarapi', TRUE);
        $pass = md5($password);
        $data = array(
            'username' => $username,
            'nama' => $nama,
            'password' => $pass,
            'email' => $email,
            'phone' => $phone,
            'foto' => $foto
        );
        $belajarapi->insert('user', $data);
        $belajarapi->close();
        return $belajarapi;
    }

}
