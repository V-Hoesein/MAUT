<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//GENERAL
function is_able($action)
{
    $role = [
        'admin' => [
            'home.dashboard',
            'user.index',
            'user.create',
            'user.store',
            'user.edit',
            'user.update',
            'user.destroy',
            'user.cetak',
            'user.password',
            'user.password.update',
            'user.logout',
            'user.profil',
            'user.profil.update',
            'kelas.index',
            'kelas.create',
            'kelas.store',
            'kelas.edit',
            'kelas.update',
            'kelas.destroy',
            'kelas.cetak',
            'mapel.index',
            'mapel.create',
            'mapel.store',
            'mapel.edit',
            'mapel.update',
            'mapel.destroy',
            'mapel.cetak',
            'topik.index',
            'topik.create',
            'topik.store',
            'topik.edit',
            'topik.update',
            'topik.destroy',
            'topik.cetak',
            'guru.index',
            'guru.create',
            'guru.store',
            'guru.edit',
            'guru.update',
            'guru.destroy',
            'guru.cetak',
            'alternatif.index',
            'alternatif.create',
            'alternatif.store',
            'alternatif.edit',
            'alternatif.update',
            'alternatif.destroy',
            'alternatif.cetak',
            'kriteria.index',
            'kriteria.create',
            'kriteria.store',
            'kriteria.edit',
            'kriteria.update',
            'kriteria.destroy',
            'kriteria.cetak',
            'nilai.index',
            'nilai.create',
            'nilai.store',
            'nilai.edit',
            'nilai.update',
            'nilai.destroy',
            'nilai.cetak',
            'maut.index',
            'maut.maut',
            'maut.maut.cetak',
            'maut.waspas',
            'maut.waspas.cetak',
            'maut.hasil',
            'maut.hasil.cetak',
        ],
        'user' => [
            'home.dashboard',
            'user.password',
            'user.password.update',
            'user.logout',
            'user.profil',
            'user.profil.update',
            'maut.hasil',
            'maut.hasil.cetak',
        ],
        'guest' => [
            'home.public',
        ]
    ];
    $user = Auth::user();
    $level = 'guest';
    if ($user) {
        if (in_array(strtolower($user->level), array_keys($role))) {
            $level = $user->level;
        }
    }
    return in_array($action, $role[strtolower($level)]);
}

function is_hidden($action)
{
    return is_able($action) ? '' : 'hidden';
}

function get_kriteria_option($selected = '')
{
    $arr = get_kriteria();
    $a = '';
    foreach ($arr as $key => $val) {
        if ($key == $selected)
            $a .= '<option value="' . $key . '" selected>' . $val->nama_kriteria . '</option>';
        else
            $a .= '<option value="' . $key . '">' . $val->nama_kriteria . '</option>';
    }
    return $a;
}

function get_kriteria()
{
    $rows = get_results("SELECT * FROM kriteria ORDER BY kode_kriteria");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_kriteria] = $row;
    }
    return $arr;
}

function get_alternatif()
{
    $rows = get_results("SELECT * FROM alternatif ORDER BY kode_alternatif");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_alternatif] = $row;
    }
    return $arr;
}


function get_subkriteria()
{
    $rows = get_results("SELECT * FROM subkriteria ORDER BY kode_kriteria, bobot_subkriteria");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->id_subkriteria] = $row;
    }
    return $arr;
}

function get_kriteria_subkriteria()
{
    $subkriteria = get_subkriteria();
    foreach ($subkriteria as $key => $val) {
        $arr[$val->kode_kriteria][$val->id_subkriteria] = $val->id_subkriteria;
    }
    return $arr;
}

function current_user()
{
    return User::find(Auth::id());
}

function get_level_option($selected = '')
{
    $arr = [
        'Admin' => 'Admin',
        'Manager' => 'Manager'
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_status_user_option($selected = '')
{
    $arr = [
        1 => 'Aktif',
        0 => 'NonAktif'
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}


function show_error($errors)
{
    if ($errors->any()) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <ul class="m-0 pl-3">';
        foreach ($errors->all() as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul><button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
    }
}
function show_msg()
{
    if ($messsage = session()->get('message')) {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">'
            . $messsage . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        </div>';
    }
}

function kode_oto($field, $table, $prefix, $length)
{
    $var = get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . ((int) substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function get_row($sql = '')
{
    $rows = DB::select($sql);
    if ($rows)
        return $rows[0];
}

function get_results($sql = '')
{
    return DB::select($sql);
}

function get_var($sql = '')
{
    $row = DB::select($sql);
    if ($row) {
        return current(current($row));
    }
}

function query($sql, $params = [])
{
    return DB::statement($sql, $params);
}
