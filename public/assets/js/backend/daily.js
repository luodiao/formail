define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'daily/index' + location.search,
                    add_url: 'daily/add',
                    edit_url: 'daily/edit',
                    del_url: 'daily/del',
                    multi_url: 'daily/multi',
                    table: 'daily',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id'),operate:false},
                        {field: 'write_date', title: __('Write_date'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'add_num', title: __('Add_num'),operate:false},
                        {field: 'service_num', title: __('Service_num'),operate:false},
                        {field: 'dingyue_num', title: __('Dingyue_num'),operate:false},
                        {field: 'off_num', title: __('Off_num'),operate:false},
                        {field: 'personal_num', title: __('Personal_num'),operate:false},
                        {field: 'intention_num', title: __('Intention_num'),operate:false},
                        {field: 'callback_num', title: __('Callback_num'),operate:false},
                        {field: 'admin_id', title: __('Admin_id')},
                        {field: 'admin_text', title: "管理员名称",operate:false},
                        {field: 'createtime', title: __('Createtime'), operate:false, addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ],
                responseHandler: function (res) {
                    console.log(res.count)
                    $("#add_num_total").html(res.count.add_num_total);
                    $("#intention_num_total").html(res.count.intention_num_total);
                    $("#callback_num_total").html(res.count.callback_num_total);
                    $("#order_total").html(res.count.order_total);
                    return res;
                }
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});