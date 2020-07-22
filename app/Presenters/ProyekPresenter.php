<?php

namespace App\Presenters;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Gate;

/**
 * Class LicensePresenter
 * @package App\Presenters
 */
class ProyekPresenter extends Presenter
{
    /**
     * Json Column Layout for bootstrap table
     * @return string
     */
    public static function dataTableLayout()
    {
        $layout = [
            [
                "field" => "id",
                "searchable" => false,
                "sortable" => true,
                "switchable" => true,
                "title" => trans('id'),
                "visible" => false
            ], [
                "field" => "nama asset",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('nama asset'),
                "formatter" => "licensesLinkFormatter"
            ], [
                "field" => "nama pic",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('nama pic'),
                "formatter" => "licensesLinkFormatter"
            ], [
                "field" => "nama teknisi",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('nama teknisi'),
                "formatter" => "licensesLinkFormatter"
            ], [
                "field" => "status",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('status'),
                'formatter' => 'dateDisplayFormatter'
            ], [
                "field" => "nominal",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('nominal')
            ], [
                "field" => "catatan",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('catatan'),
            ], [
                "field" => "tanggal mulai",
                "searchable" => true,
                "sortable" => true,
                "switchable" => true,
                "title" => trans('tanggal mulai'),
                "formatter" => "categoriesLinkObjFormatter"
            ], [
                "field" => "tangal selesai",
                "searchable" => true,
                "sortable" => true,
                "switchable" => true,
                "title" => trans('tanggal selesai'),
                "formatter" => "suppliersLinkObjFormatter"
            ], [
                "field" => "nama departemen",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('nama departemen'),
                "formatter" => "manufacturersLinkObjFormatter",
            ]
        ];

        return json_encode($layout);
    }


    /**
     * Json Column Layout for bootstrap table
     * @return string
     */
    public static function dataTableLayoutSeats()
    {
        $layout = [
           [
                "field" => "name",
                "searchable" => false,
                "sortable" => false,
                "switchable" => true,
                "title" => trans('admin/licenses/general.seat'),
                "visible" => true,
            ], [
                "field" => "assigned_user",
                "searchable" => false,
                "sortable" => false,
                "switchable" => true,
                "title" => trans('admin/licenses/general.user'),
                "visible" => true,
                "formatter" => "usersLinkObjFormatter"
            ], [
                "field" => "department",
                "searchable" => false,
                "sortable" => true,
                "switchable" => true,
                "title" => trans('general.department'),
                "visible" => false,
                "formatter" => "departmentNameLinkFormatter"
            ],
            [
                "field" => "assigned_asset",
                "searchable" => false,
                "sortable" => false,
                "switchable" => true,
                "title" => trans('admin/licenses/form.asset'),
                "visible" => true,
                "formatter" => "hardwareLinkObjFormatter"
            ], [
                "field" => "location",
                "searchable" => false,
                "sortable" => false,
                "switchable" => true,
                "title" => trans('general.location'),
                "visible" => true,
                "formatter" => "locationsLinkObjFormatter"
            ],
            [
                "field" => "checkincheckout",
                "searchable" => false,
                "sortable" => false,
                "switchable" => true,
                "title" => trans('general.checkin').'/'.trans('general.checkout'),
                "visible" => true,
                "formatter" => "licenseSeatInOutFormatter"
            ]
        ];

        return json_encode($layout);
    }


    /**
     * Link to this licenses Name
     * @return string
     */
    public function nameUrl()
    {
        return (string)link_to_route('licenses.show', $this->name, $this->id);
    }

    /**
     * Link to this licenses Name
     * @return string
     */
    public function fullName()
    {
        return $this->name;
    }


    /**
     * Link to this licenses serial
     * @return string
     */
    public function serialUrl()
    {
        return (string) link_to('/licenses/'.$this->id, mb_strimwidth($this->serial, 0, 50, "..."));
    }

    /**
     * Url to view this item.
     * @return string
     */
    public function viewUrl()
    {
        return route('licenses.show', $this->id);
    }
}
