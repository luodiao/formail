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
                        {field: 'mobile', title: '联系电话'}
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