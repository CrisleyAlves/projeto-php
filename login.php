<?php
session_start();
require('config.php');
require('biblioteca/adodb/adodb.inc.php');
require('conecta.php');
require('funcoes.php');

if($_POST['f_login'] == '' or $_POST['f_senha'] == '')
{
    mensagem(config_msg_acesso);
    redireciona('index.php');
}

if(isset($_POST['f_login']) and isset($_POST['f_senha']))
{
    $con = new conecta();
    //caracteres removidos evitando sql_injection
    $c = array('=','or','and',';',',','//','@','#');
    
    $login = $_POST['f_login'];
    $senha = $_POST['f_senha'];
    
    foreach($c as $v)
    {
        str_replace($v, '', $login);
        str_replace($v, '', $senha);
    }
    
    $sql = "SELECT * FROM tbl_administradores WHERE adm_login = '".$login."' and adm_senha = '".$senha."'";
    $res = $con->bd->Execute($sql);
    
    if($res->RecordCount() > 0)
    {
        $reg = $res->FetchNextObject();
        $_SESSION['adm_codigo'] = $reg->ADM_CODIGO;
        $_SESSION['adm_nome'] = $reg->ADM_NOME;
        $_SESSION['adm_login'] = $reg->ADM_LOGIN;
        $_SESSION['adm_senha'] = $reg->ADM_SENHA;
        redireciona('index.php');
    }
    else
    {
        mensagem(config_msg_acesso);
        redireciona('index.php');
    }
}
?>
