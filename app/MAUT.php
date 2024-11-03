<?php

namespace App;

class MAUT
{
    public $rel_alternatif;
    public $atribut;
    public $bobot;

    public $total, $rank, $terbobot, $normal, $bobot_normal, $minmax, $rata, $hasil;

    function __construct($rel_alternatif, $atribut, $bobot)
    {
        $this->rel_alternatif = $rel_alternatif;
        $this->atribut = $atribut;
        $this->bobot = $bobot;
        $this->bobot_normal();
        $this->normal();
        $this->terbobot();
        $this->total();
        $this->hasil();
        $this->rank();
    }
    function rank()
    {
        $temp = $this->total;
        arsort($temp);
        $no = 1;
        $this->rank = array();
        foreach ($temp as $key => $value) {
            $this->rank[$key] = $no++;
        }
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
        foreach ($this->terbobot as $key => $val) {
            $this->total[$key] = array_sum($val);
        }
    }
    function terbobot()
    {
        $this->terbobot = array();
        foreach ($this->normal as $key => $val) {
            foreach ($val as $k => $v) {
                $this->terbobot[$key][$k] = $v * $this->bobot_normal[$k];
            }
        }
    }
    function normal()
    {
        $arr = array();
        foreach ($this->rel_alternatif as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$k][$key] = $v;
            }
        }
        foreach ($arr as $key => $val) {
            $this->minmax[$key]['min'] = min($val);
            $this->minmax[$key]['max'] = max($val);
        }
        foreach ($this->rel_alternatif as $key => $val) {
            foreach ($val as $k => $v) {
                $min = $this->minmax[$k]['min'];
                $max = $this->minmax[$k]['max'];
                $this->normal[$key][$k] = ($v - $min) / ($max - $min);
            }
        }
    }
    function bobot_normal()
    {
        $total = array_sum($this->bobot);
        foreach ($this->bobot as $key => $val) {
            $this->bobot_normal[$key] = $val / $total;
        }
    }
}
