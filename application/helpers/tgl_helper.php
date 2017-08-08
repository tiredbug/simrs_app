<?php

function tgl_biasa($tgl)
{
    return date("d-m-Y",strtotime($tgl));
}

function tgl_mysql($tgl)
{
    return date("Y-m-d",strtotime($tgl));
}

