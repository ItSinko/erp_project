<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SamplingController extends Controller
{
    public function jumlah_sampling($jumlah)
    {
        $jumlahsample = 0;
        if($jumlah > 1 && $jumlah <= 8)
        {
            if($jumlah = 1)
            {
                $jumlahsample = 1;
            }
            else if($jumlah > 1)
            {
                $jumlahsample = 2;
            }
        }
        else if($jumlah > 8 && $jumlah <= 15)
        {
            $jumlahsample = 3;
        }
        else if($jumlah > 15 && $jumlah <= 25)
        {
            $jumlahsample = 5;
        }
        else if($jumlah > 25 && $jumlah <= 50)
        {
            $jumlahsample = 8;
        }
        else if($jumlah > 50 && $jumlah <= 90)
        {
            $jumlahsample = 13;
        }
        else if($jumlah > 90 && $jumlah <= 150)
        {
            $jumlahsample = 20;
        }
        else if($jumlah > 150 && $jumlah <= 280)
        {
            $jumlahsample = 32;
        }
        else if($jumlah > 280 && $jumlah <= 500)
        {
            $jumlahsample = 50;
        }
        else if($jumlah > 500 && $jumlah <= 1200)
        {
            $jumlahsample = 80;
        }
        else if($jumlah > 1200 && $jumlah <= 3200)
        {
            $jumlahsample = 125;
        }
        else if($jumlah > 3200 && $jumlah <= 10000)
        {
            $jumlahsample = 200;
        }
        else if($jumlah > 10000 && $jumlah <= 35000)
        {
            $jumlahsample = 315;
        }
        else if($jumlah > 35000)
        {
            $jumlahsample = 500;
        }

        echo $jumlahsample;
    }

    public function hasil_sampling($jumlah, $jumlahrusak)
    {
        $ket = "";
        if($jumlah > 1 && $jumlah <= 8)
        {
            if($jumlahrusak <= 0)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 0)
            {
                $ket = "re";
            }
        }
        else if($jumlah > 8 && $jumlah <= 15)
        {
            if($jumlahrusak <= 0)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 0)
            {
                $ket = "re";
            }
        }
        else if($jumlah > 15 && $jumlah <= 25)
        {
            if($jumlahrusak <= 0)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 1)
            {
                $ket = "re";
            }
        }
        else if($jumlah > 25 && $jumlah <= 50)
        {
            if($jumlahrusak <= 1)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 2)
            {
                $ket = "re";
            }
        }
        else if($jumlah > 50 && $jumlah <= 90)
        {
            if($jumlahrusak <= 2)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 3)
            {
                $ket = "re";
            }
        }
        else if($jumlah > 90 && $jumlah <= 150)
        {
            if($jumlahrusak <= 3)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 5)
            {
                $ket = "re";
            }
        }
        else if($jumlah > 150 && $jumlah <= 280)
        {
            if($jumlahrusak <= 5)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 7)
            {
                $ket = "re";
            }
        }
        else if($jumlah > 280 && $jumlah <= 500)
        {
            if($jumlahrusak <= 7)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 10)
            {
                $ket = "re";
            }
        }
        else if($jumlah > 500 && $jumlah <= 1200)
        {
            if($jumlahrusak <= 10)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 14)
            {
                $ket = "re";
            }
        }
        else if($jumlah > 1200 && $jumlah <= 3200)
        {
            if($jumlahrusak <= 14)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 21)
            {
                $ket = "re";
            }
        }
        else if($jumlah > 3200 && $jumlah <= 10000)
        {
            if($jumlahrusak <= 21)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 21)
            {
                $ket = "re";
            }
        }
        else if($jumlah > 10000 && $jumlah <= 35000)
        {
            if($jumlahrusak <= 21)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 21)
            {
                $ket = "re";
            }
        }
        else if($jumlah > 35000)
        {
            if($jumlahrusak <= 21)
            {
                $ket = "ac";
            }
            else if($jumlahrusak > 21)
            {
                $ket = "re";
            }
        }

        echo $ket;
    }
}
