define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'authinfolog/index' + location.search,
                    table: 'authinfolog',
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
                        {field: 'fk_id', title: __('A_tite'),searchList: {"1":__('A_tite 1'),"2":__('A_tite 2'),"3":__('A_tite 3'),"4":__('A_tite 4'),"5":__('A_tite 5'),"6":__('A_tite 6')}, formatter: Table.api.formatter.normal},
                        {field: 'wx_id', title: __('Wx_id')},
                        {field: 'wechat_name', title: '公众号名称'},
                        {field: 'user_name', title: '用户名称'},
                        {field: 'create_dt', title:'开始时间', operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'validity_dt', title:'结束时间', operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        
                        {
                            field: 'operate',
                            title: __('Operate'),
                            table: table,
                            buttons: [
                                {name: 'logs', text: '查看历史回访', title: '历史回访', icon: 'glyphicon glyphicon-search', classname: 'btn btn-xs btn-success btn-dialog', url: 'authinfolog/logslist'},
                                {name: 'addlog', text: '添加回访', title: '添加回访', icon: 'fa fa-plus', classname: 'btn btn-xs btn-danger btn-dialog', url: 'authinfo/loglist'}
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
        loglist: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'authinfolog/loglist' + location.search,
                    add_url: 'authinfolog/add',
                    edit_url: 'authinfolog/edit',
                    del_url: 'authinfolog/del',
                    multi_url: 'authinfolog/multi',
                    table: 'authinfolog',
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
                        {field: 'auth', title: __('Auth'), searchList: {"1":__('Auth 1'),"2":__('Auth 2'),"3":__('Auth 3'),"4":__('Auth 4'),"5":__('Auth 5')}, formatter: Table.api.formatter.normal},
                        {field: 'type', title: __('Type'), searchList: {"0":__('Type 0'),"1":__('Type 1'),"2":__('Type 2'),"3":__('Type 3'),"4":__('Type 4')}, formatter: Table.api.formatter.normal},
                        {field: 'wx_id', title: __('Wx_id')},
                        {field: 'wxname', title: __('Wxname')},
                        {field: 'username', title: __('Username')},
                        {field: 'level', title: __('Level'), searchList: {"0":__('Level 0'),"1":__('Level 1'),"2":__('Level 2'),"3":__('Level 3')}, formatter: Table.api.formatter.normal},
                        {field: 'adminname', title: __('Adminname')},
                        {field: 'desc', title: __('Desc')},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {
                            field: 'operate',
                            title: __('Operate'),
                            table: table,
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
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});