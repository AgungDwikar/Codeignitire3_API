<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


function addBerita($request){
    $result = new stdClass;
    $result->responseCode = "";
    $result->responseDesc = "";

    $CI = & get_instance();
    $CI->load->model('user_model');
    $CI->load->model('activity_model');
    $datapost = json_decode($request);
    try{
        if(!isset($datapost->judul)){
            throw new Exception("Parameter Judul tidak valid");
        }
        if($datapost->judul == ""){
            throw new Exception("Judul tidak boleh kosong");
        }
        $judul = $datapost->judul;
        if (!isset($datapost->pembaca)) {
            throw new Exception("Parameter Pembaca tidak valid");
        }
        if ($datapost->pembaca == "") {
            throw new Exception("Pembaca tidak boleh kosong");
        }
        $pembaca = $datapost->pembaca;
        $resdata = $CI->user_model->addBerita($judul, $pembaca);
        if(!$resdata){
            throw new Exception("Gagal add berita");
        }

        $result->responseCode = '00';
        $result->responseDesc = 'Berhasil Add Berita';
    }catch (Exception $e){
        $result->responseCode = '99';
        $result->responseDesc = $e->getMessage() . " Ln." . $e->getLine();
    }

    $CI->activity_model->insert_activity((isset($datapost->requestMethod) ? $CI->security->xss_clean(trim($datapost->requestMethod)) : '') . ' RESPONSE ', json_encode(array("responseCode" => $result->responseCode, "responseDesc" => $result->responseDesc)));
    return $result;
}

function getAllUser($request) {
    $result = new stdClass;
    $result->responseCode = "";
    $result->responseDesc = "";

    $user = '';
    $CI = & get_instance();
    $CI->load->model('activity_model');
    $CI->load->model('user_model');
    $datapost = json_decode($request);
    try {
        $user = $datapost->user;
        if ($CI->libs_bearer->cekToken() == false) {
            throw new Exception("Access Forbidden");
        }

        if (!isset($datapost->user)) {
            throw new Exception("Parameter user tidak valid");
        }

        $resdata = $CI->user_model->getAllUser();
        if (!$resdata || $resdata->num_rows() == 0) {
            throw new Exception("Data tidak ditemukan.");
        }
        $result->responseCode = '00';
        $result->responseDesc = 'Inquiry Sukses.';
        $result->responseData = $resdata->result();
    } catch (Exception $e) {
        $result->responseCode = '99';
        $result->responseDesc = $e->getMessage() . " Ln." . $e->getLine();
    }

    $CI->activity_model->insert_activity((isset($datapost->requestMethod) ? $CI->security->xss_clean(trim($datapost->requestMethod)) : '') . ' RESPONSE ', json_encode(array("responseCode" => $result->responseCode, "responseDesc" => $result->responseDesc)));
    return $result;
}

function getUser($request) {
    $result = new stdClass;
    $result->responseCode = "";
    $result->responseDesc = "";

    $user = '';
    $CI = & get_instance();
    $CI->load->model('activity_model');
    $CI->load->model('user_model');
    $datapost = json_decode($request);
    try {
        $user = $datapost->user;
        if ($CI->libs_bearer->cekToken() == false) {
            throw new Exception("Access Forbidden");
        }

        if (!isset($datapost->user)) {
            throw new Exception("Parameter user tidak valid");
        }

        $resdata = $CI->user_model->getUser($user);
        if (!$resdata || $resdata->num_rows() == 0) {
            throw new Exception("Data tidak ditemukan.");
        }
        $result->responseCode = '00';
        $result->responseDesc = 'Inquiry Sukses.';
        $result->responseData = $resdata->result();
    } catch (Exception $e) {
        $result->responseCode = '99';
        $result->responseDesc = $e->getMessage() . " Ln." . $e->getLine();
    }

    $CI->activity_model->insert_activity((isset($datapost->requestMethod) ? $CI->security->xss_clean(trim($datapost->requestMethod)) : '') . ' RESPONSE ', json_encode(array("responseCode" => $result->responseCode, "responseDesc" => $result->responseDesc)));
    return $result;
}

function postUser($request) {
    $result = new stdClass;
    $result->responseCode = "";
    $result->responseDesc = "";

    $user = '';
    $CI = & get_instance();
    $CI->load->model('activity_model');
    $CI->load->model('user_model');
    $datapost = json_decode($request);
    try {
        $user = $datapost->user;
        if ($CI->libs_bearer->cekToken() == false) {
            throw new Exception("Access Forbidden");
        }

        if (!isset($datapost->user)) {
            throw new Exception("Parameter user tidak valid");
        }
        if (!isset($datapost->id_user)) {
            throw new Exception("Parameter id_user tidak valid");
        }
        $id_user = $datapost->id_user;

        $resdata = $CI->user_model->getUser($id_user);
        if (!$resdata || $resdata->num_rows() == 0) {
            throw new Exception("Data tidak ditemukan.");
        }
        $result->responseCode = '00';
        $result->responseDesc = 'Inquiry Sukses.';
        $result->responseData = $resdata->result();
    } catch (Exception $e) {
        $result->responseCode = '99';
        $result->responseDesc = $e->getMessage() . " Ln." . $e->getLine();
    }

    $CI->activity_model->insert_activity((isset($datapost->requestMethod) ? $CI->security->xss_clean(trim($datapost->requestMethod)) : '') . ' RESPONSE ', json_encode(array("responseCode" => $result->responseCode, "responseDesc" => $result->responseDesc)));
    return $result;
}

function login($request) {
    $result = new stdClass;
    $result->responseCode = "";
    $result->responseDesc = "";

    $user = '';
    $CI = & get_instance();
    $CI->load->model('activity_model');
    $CI->load->model('user_model');
    $datapost = json_decode($request);
    try {
        $requestData = $datapost->requestData;
        if ($CI->libs_bearer->cekToken() == false) {
            throw new Exception("Access Forbidden");
        }

        $username = $requestData->username;
        if (!isset($requestData->username)) {
            throw new Exception("Parameter username tidak valid");
        }

        $password = $requestData->password;
        if (!isset($requestData->password)) {
            throw new Exception("Parameter password tidak valid");
        }

        $resdata = $CI->user_model->get_user($username, $password);
        if (!$resdata || $resdata->num_rows() == 0) {
            throw new Exception("Akun tidak ditemukan.");
        }
        $result->responseCode = '00';
        $result->responseDesc = 'Login Sukses.';
        $result->responseData = $resdata->result();
    } catch (Exception $e) {
        $result->responseCode = '99';
        $result->responseDesc = $e->getMessage() . " Ln." . $e->getLine();
    }

    $CI->activity_model->insert_activity((isset($datapost->requestMethod) ? $CI->security->xss_clean(trim($datapost->requestMethod)) : '') . ' RESPONSE ', json_encode(array("responseCode" => $result->responseCode, "responseDesc" => $result->responseDesc)));
    return $result;
}

function register($request) {
    $result = new stdClass;
    $result->responseCode = "";
    $result->responseDesc = "";

    $user = '';
    $CI = & get_instance();
    $CI->load->model('activity_model');
    $CI->load->model('user_model');
    $datapost = json_decode($request);
    try {
        $requestData = $datapost->requestData;
        $username = $requestData->username;
        if ($CI->libs_bearer->cekToken() == false) {
            throw new Exception("Access Forbidden");
        }
        if (!isset($requestData->username)) {
            throw new Exception("Parameter username tidak valid");
        }
        $nama = $requestData->nama;
        if (!isset($requestData->nama)) {
            throw new Exception("Parameter nama tidak valid");
        }
        $password = $requestData->password;
        if (!isset($requestData->password)) {
            throw new Exception("Parameter password tidak valid");
        }
        $email = $requestData->email;
        if (!isset($requestData->email)) {
            throw new Exception("Parameter email tidak valid");
        }
        $foto = $requestData->foto;
        if (!isset($requestData->foto)) {
            throw new Exception("Parameter email tidak valid");
        }
        $phone = $requestData->phone;
        if (!isset($requestData->phone)) {
            throw new Exception("Parameter phone tidak valid");
        }
        $cekuser = $CI->user_model->cek_user($username);
        $ceknohp = $CI->user_model->cek_nohp($phone);
        if ($cekuser->num_rows() != 0) {
            throw new Exception("Username sudah digunakan");
        }
        if ($ceknohp->num_rows() != 0) {
            throw new Exception("Nomor HP sudah digunakan");
        }

        $resdata = $CI->user_model->create_user($username, $nama, $password, $email, $phone, $foto);
        if (!$resdata) {
            throw new Exception("Data tidak berhasil disimpan.");
        }
        $result->responseCode = '00';
        $result->responseDesc = 'Registrasi Sukses.';
    } catch (Exception $e) {
        $result->responseCode = '99';
        $result->responseDesc = $e->getMessage() . " Ln." . $e->getLine();
    }

    $CI->activity_model->insert_activity((isset($datapost->requestMethod) ? $CI->security->xss_clean(trim($datapost->requestMethod)) : '') . ' RESPONSE ', json_encode(array("responseCode" => $result->responseCode, "responseDesc" => $result->responseDesc)));
    return $result;
}
