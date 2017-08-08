<?php

function hitung_umur($param){
    $tgl_lahir=$param;
    $bd=new DateTime($tgl_lahir);
    $today=new DateTime();
        
    $dif=$today->diff($bd);
    return $respon=array(
        'tahun'=>$dif->y,
        'bulan'=>$dif->m,
        'hari'=>$dif->d
    );
}

