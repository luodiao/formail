define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'work/index' + location.search,
                    add_url: 'work/add',
                    edit_url: 'work/edit',
                    del_url: 'work/del',
                    multi_url: 'work/multi',
                    table: 'work',
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
                        {field: 'wechat_nickname', title: __('Wechat_nickname')},
                        {field: 'mobile', title: __('Mobile')},
                        {field: 'wechat_name', title: __('Wechat_name')},
                        {field: 'wechat_type', title: __('Wechat_type'), searchList: {"1":__('Wechat_type 1'),"2":__('Wechat_type 2'),"3":__('Wechat_type 3')}, formatter: Table.api.formatter.normal},
                        {field: 'industry_type', title: __('Industry_type'), searchList: {"1":__('Industry_type 1'),"2":__('Industry_type 2')}, formatter: Table.api.formatter.normal},
                        {field: 'project', title: __('Project'), searchList: {"1":__('Project 1'),"2":__('Project 2'),"3":__('Project 3'),"98":__('Project 98'),"99":__('Project 99')}, formatter: Table.api.formatter.normal},
                        {field: 'admin_id', title: __('Admin_id')},
                        {field: 'admin_text', title: __('Admin_text')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'level', title: __('Level'), searchList: {"5":__('Level 5'),"4":__('Level 4'),"3":__('Level 3'),"2":__('Level 2'),"1":__('Level 1')}, formatter: Table.api.formatter.normal},
                        {field: 'frist_time', title: __('Frist_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'callback_time', title: __('Callback_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {
                            field: 'operate', 
                            title: __('Operate'), 
                            table: table, 
                            buttons: [
                                {name: 'setok', text: '认定成交', title: '认定成交', icon: 'glyphicon glyphicon-saved', classname: 'btn btn-xs btn-success btn-dialog', url: 'work/setok'}
                            ], 
                            events: Table.api.events.operate, 
                            formatter: Table.api.formatter.operate
                        }
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
        setok: function () {
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