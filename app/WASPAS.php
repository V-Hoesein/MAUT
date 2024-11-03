<?php

namespace App;

class WASPAS
{
    public $data;
    public $bobot;
    public $bobot_normal;
    public $atribut;
    public $lambda;
    public $total;
    public $q1;
    public $q2;
    public $terbobot;
    public $pangkat;
    public $normal;
    public $rank, $rata, $hasil;
    function __construct($data, $bobot, $atribut, $lambda = 0.5)
    {
        $this->data = $data;
        $this->bobot = $bobot;
        $this->atribut = $atribut;
        $this->lambda = $lambda;
        $this->bobot_normal();
        $this->normal();
        $this->bobot();
        $this->pangkat();
        $this->q();
        $this->total();
        $this->hasil();
        $this->rank = $this->get_rank($this->total);
    }
    function get_rank($array)
    {
        $data = $array;
        arsort($data);
        $no = 1;
        $new = array();
        foreach ($data as $key => $value) {
            $new[$key] = $no++;
        }
        return $new;
    }
    function hasil()
    {
        $min = min($this->total);
        $max = max($this->total);
        $this->rata = $min + ($max - $min) / 2;
        foreach ($this->total as $key => $val) {
            $this->hasil[$key] = $val >= $this->rata ? 'Layak' : 'Tidak Layak';
        }
    }
    function total()
    {
        $this->total = array();
        foreach ($this->q1 as $key => $val) {
            $this->total[$key] = $val * $this->lambda + $this->q2[$key] * $this->lambda;
            $this->total[$key] = $this->lambda * ($val  + 1 - $this->lambda * $this->q2[$key]);
        }
    }
    function q()
    {
        $this->q1 = array();
        foreach ($this->terbobot as $key => $val) {
            $this->q1[$key] = array_sum($val);
        }
        $this->q2 = array();
        foreach ($this->pangkat as $key => $val) {
            $this->q2[$key] = 1;
            foreach ($val as $k => $v) {
                $this->q2[$key] *= $v;
            }
        }
    }
    function pangkat()
    {
        $arr = array();
        foreach ($this->normal as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$key][$k] = pow($v, $this->bobot_normal[$k]);
            }
        }
        $this->pangkat = $arr;
    }
    function bobot()
    {
        $arr = array();
        foreach ($this->normal as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$key][$k] = $v * $this->bobot_normal[$k];
            }
        }
        $this->terbobot = $arr;
    }
    function normal()
    {
        $arr = array();
        foreach ($this->data as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$k][$key] = $v;
            }
        }
        $max = array();
        $min = array();
        foreach ($arr as $key => $val) {
            $max[$key] = max($val);
            $min[$key] = min($val);
        }
        $arr = array();
        foreach ($this->data as $key => $val) {
            foreach ($val as $k => $v) {
                if ($this->atribut[$k] == 'benefit')
                    $arr[$key][$k] = $v / $max[$k];
                else
                    $arr[$key][$k] = $min[$k] / $v;
            }
        }
        $this->normal = $arr;
    }
    function bobot_normal()
    {
        $arr = array();
        $total = array_sum($this->bobot);
        foreach ($this->bobot as $key => $val) {
            $arr[$key] = $val / $total;
        }
        //echo '<pre>' . print_r($arr, 1) . '</pre>';
        $this->bobot_normal = $arr;
    }
}
