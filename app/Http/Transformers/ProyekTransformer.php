<?php
namespace App\Http\Transformers;

use App\Models\Proyek;
use Gate;
use Illuminate\Database\Eloquent\Collection;
use App\Helpers\Helper;

class ProyekTransformer
{

    public function transformProjek (Collection $projek, $total)
    {
        $array = array();
        foreach ($projek as $projek) {
            $array[] = self::transformProyek($projek);
        }
        return (new DatatablesTransformer)->transformDatatables($array, $total);
    }

    public function transformProyek (Proyek $proyek)
    {
        $array = [
            'id' => $proyek->id,
            'nama_asset' => $proyek->nama_asset,
            'nama_pic' => $proyek->nama_pic,
            'nama_teknisi' => $proyek->nama_teknisi,
            'status' => $proyek->status,
            'nominal' => $proyek->nominal,
            'tanggal_mulai' => $proyek->tanggal_mulai,
            'tanggal_selesai' => $proyek->tanggal_selesai,
            'catatan' => $proyek->catatan,
            'nama_dept' => $proyek->nama_dept,
            'created_at' => Helper::getFormattedDateObject($accessory->created_at, 'datetime'),
            'updated_at' => Helper::getFormattedDateObject($accessory->updated_at, 'datetime'),

        ];

        $permissions_array['available_actions'] = [
            'checkout' => Gate::allows('checkout', Proyek::class) ? true : false,
            'checkin' =>  false,
            'update' => Gate::allows('update', Proyek::class) ? true : false,
            'delete' => Gate::allows('delete', Proyek::class) ? true : false,
        ];

        $permissions_array['user_can_checkout'] = false;

        if ($proyek->numRemaining() > 0) {
            $permissions_array['user_can_checkout'] = true;
        }

        $array += $permissions_array;

        return $array;
    }


    public function transformCheckedoutProyek ($accessory_users, $total)
    {


        // $array = array();
        // foreach ($accessory_users as $user) {
        //     $array[] = [
        //         'assigned_pivot_id' => $user->pivot->id,
        //         'id' => (int) $user->id,
        //         'username' => e($user->username),
        //         'name' => e($user->getFullNameAttribute()),
        //         'first_name'=> e($user->first_name),
        //         'last_name'=> e($user->last_name),
        //         'employee_number' =>  e($user->employee_num),
        //         'type' => 'user',
        //         'available_actions' => ['checkin' => true]
        //     ];

        // }

        return (new DatatablesTransformer)->transformDatatables($array, $total);
    }



}
