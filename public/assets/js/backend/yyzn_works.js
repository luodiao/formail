define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'yyzn_works/index' + location.search,
                    add_url: 'yyzn_works/add',
                    edit_url: 'yyzn_works/edit',
                    del_url: 'yyzn_works/del',
                    multi_url: 'yyzn_works/multi',
                    table: 'yyzn_works',
                }
            });
ellStyle: function () {return {css: {"width": "600px"}}}
            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                         {field: 'image', title: '头像', events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'username', title: '用户昵称'},
                        {field: 'mobile', title: '联系电话'},
                        {field: 'type', title: __('Type'), searchList: {"1":__('Type 1'),"2":__('Type 2'),"3":__('Type 3')}, formatter: Table.api.formatter.normal},
                        {field: 'auth', title: __('Auth')},
                        // {field: 'auth_id', title: __('Auth_id')},
                        // {field: 'wx_id', title: __('Wx_id')},
                        {field: 'wxname', title: __('Wxname')},
                        // {field: 'user_id', title: __('User_id')},
                        
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'admin_id', title: __('Admin_id')},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2')}, formatter: Table.api.formatter.status},
                        {field: 'assigntime', title: __('Assigntime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
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