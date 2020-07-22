<?php
namespace App\Presenters;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Gate;

/**
 * Class AccessoryPresenter
 * @package App\Presenters
 */
class AccessoryPresenter extends Presenter
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
                "title" => trans('general.id'),
                "visible" => false
            ], [
                "field" => "company",
                "searchable" => true,
                "sortable" => true,
                "switchable" => true,
                "title" => trans('admin/companies/table.title'),
                "visible" => false,
                "formatter" => "companiesLinkObjFormatter"
            ], [
                "field" => "name",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('Nama Asset'),
                "formatter" => "accessoriesLinkFormatter"
            ], [
                "field" => "company",
                "searchable" => false,
                "sortable" => true,
                "title" => trans('Nama Departemen'),
            ], [
                "field" => "category",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('PIC'),
                "formatter" => "accessoriesLinkFormatter"
            ],  [
                "field" => "manufacturer",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('PIC Teknisi'),
                "formatter" => "accessoriesLinkFormatter"
            ], [
                "field" => "supplier",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('Status'),
                "formatter" => "accessoriesLinkFormatter"
            ], [
                "field" => "nominalasset",
                "searchable" => false,
                "sortable" => false,
                "title" => trans('Nominal Asset'),
            ],  [
                "field" => "catatan",
                "searchable" => false,
                "sortable" => true,
                "title" => trans('Catatan'),
            ],  [
                "field" => "tgl_mulai",
                "searchable" => false,
                "sortable" => true,
                "title" => trans('Tanggal Mulai'),
            ],  [
                "field" => "tgl_end",
                "searchable" => false,
                "sortable" => true,
                "title" => trans('Tanggal Selesai'),
            ],[
                "field" => "order_number",
                "searchable" => true,
                "sortable" => true,
                "visible" => false,
                "title" => trans('general.order_number'),
            ], [
                "field" => "change",
                "searchable" => false,
                "sortable" => false,
                "visible" => true,
                "title" => trans('general.change'),
                "formatter" => "accessoriesInOutFormatter",
            ], [
                "field" => "actions",
                "searchable" => false,
                "sortable" => false,
                "switchable" => false,
                "title" => trans('table.actions'),
                "formatter" => "accessoriesActionsFormatter",
            ]
        ];

        return json_encode($layout);
    }


    /**
     * Pregenerated link to this accessories view page.
     * @return string
     */
    public function nameUrl()
    {
        return (string) link_to_route('accessories.show', $this->name, $this->id);
    }

    /**
     * Url to view this item.
     * @return string
     */
    public function viewUrl()
    {
        return route('accessories.show', $this->id);
    }

    public function name()
    {
        return $this->model->name;
    }
}
