// script type="text/javascript" language="javascript" //

    var Checkbox = new Ext.grid.CheckboxSelectionModel();

    function formatDate(value){
        return value ? value.dateFormat('Y-m-d H:i:s') : '';
    };

    function del(btn){ 
        /* if(btn == 'yes') { 
            var m = grid.getSelections(); 
            store.load({params:{del:m[0].get("id"),start:0,limit:6}}); 
        }*/

        var m = grid.getSelections();

        //alert(m[0].get("accountid"));
        console.log(m);

        var data = new Array;

        for(var i = 0, len = m.length; i < len; i++){ 
                data.push(m[i].get("accountid"));
         } 


        var conn = new Ext.data.Connection();
        conn.request({method: 'POST', url: 'cmd/saveaccount.php', 
                      params: { action: 'delete', data: Ext.util.JSON.encode(data) } });

        conn.on('requestcomplete', function(sender, param) {
            var response = Ext.util.JSON.decode(param.responseText);
            if (response.success) {
                //grid.getStore().commitChanges();	

                for(var i = 0, len = m.length; i < len; i++){ 
                    store.remove(m[i]);
                }
            }
        }, { scope: this });
    };
    
    var fm = Ext.form;
    
    
    var cm = new Ext.grid.ColumnModel([
           Checkbox,
         {           
           header: "Company",
           dataIndex: 'companyid',
           width: 100,
           /*editor: new Ext.form.ComboBox({
               //name: 'company_name',
               //typeAhead: true,
               //triggerAction: 'all',
               //transform: 'selcompany',
               displayField: 'company_name',
               hiddenName: 'compid',
               valueField: 'companyid',
               lazyRender: true,
               listClass: 'x-combo-list-small',
               //mode: 'local'
               store: new Ext.data.JsonStore({
                    autoLoad: true,
                    url: 'getcompany.php',
                    fields: [ 'companyid', 'company_name' ]
                })

            })*/


            editor: new Ext.form.ComboBox({
                           displayField: 'company_name',                           
                           valueField: 'companyid',                         
                           
                           store: new Ext.data.JsonStore({
                                autoLoad: true,
                                url: 'cmd/getcompany.php',
                                root: 'results.companies',
                                fields: [ 'companyid', 'company_name' ]
                            })
                    }), 
            renderer: function(v, m, r) { return r.get('company_name'); }


        },{
           id: 'account_name',
           header: "Account Name",
           dataIndex: 'account_name',
           width: 100,
           editor: new fm.TextField({
	                  allowBlank: false
           })
           
        },{
           
           header: "Type Name",
           dataIndex: 'typeid',
           width: 80,
           editor: new Ext.form.ComboBox({      
               emptyText: 'Select Type',
               displayField: 'typename',               
               valueField: 'typeid',
               lazyRender: true,
               listClass: 'x-combo-list-small',
               store: new Ext.data.JsonStore({
                            autoLoad: true,
                            url: 'cmd/getaccounttype.php',
                            fields: [ 'typeid', 'typename' ]
               })
               
            }),
            renderer: function(v, m, r) { return r.get('typename'); }
           
        },{
           header: "Balance",
           dataIndex: 'balance',
           width: 70,
           align: 'right',
           renderer: 'usMoney',
           editor: new fm.NumberField({
               allowBlank: false,
               allowNegative: false,
               maxValue: 100000
           })
        },{
           header: "Due Date",
           dataIndex: 'duedate',
           width: 95,
           editor: new fm.TextField({
	                  allowBlank: false
           })
           
        },{
           header: "Start Date",
           dataIndex: 'startdate',
           width: 95,
           renderer: formatDate,
           editor: new fm.DateField({
                format: 'Y-m-d H:i:s'               
                
            })
        }
    ]);

    
    cm.defaultSortable = true;

    
    var Account = Ext.data.Record.create([
           // the "name" below matches the tag name to read, except "availDate"
           // which is mapped to the tag "availability"
           {name: 'accountid', type: 'string'},
           {name: 'companyid', type: 'string'},
           {name: 'typeid', type: 'string'},
           {name: 'typename', type: 'string'},
           {name: 'account_name', type: 'string'},
           {name: 'company_name', type: 'string'},
           {name: 'startdate', type: 'date', dateFormat: 'Y-m-d H:i:s'},
           {name: 'duedate', type: 'string'},
           {name: 'balance', type: 'float'}             // automatic date conversions
           
      ]);

    
    var store = new Ext.data.Store({        
        
        reader: new Ext.data.JsonReader({               
               root: 'results.accounts',
               id: 'accountid'
           }, Account),
           
        proxy: new Ext.data.HttpProxy({
             url: 'cmd/getaccount.php',
             method: 'POST'
        }),

        sortInfo:{field:'account_name', direction:'ASC'}
    });


    
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        cm: cm,
        sm: Checkbox,
        renderTo: 'editor-grid',
        width: 600,
        height: 300,
        //autoExpandColumn: 'common',
        title: 'Accounts',
        frame: true,
        
        clicksToEdit: 1,

        tbar: [{
            text: 'Add Account',
            handler : function(){
                var p = new Account({
                    accountid: '',
                    companyid: 1,
                    company_name: 'Select Company',
                    account_name: '',
                    typeid: 1,
                    typename: 'Select Type',
                    balance: 0,
                    duedate: '',
                    startdate: (new Date()).clearTime()
                    //startdate: (new Date()).clearTime()
                });
                grid.stopEditing();
                store.insert(0, p);
                grid.startEditing(0, 0);
            }
           },
           { text:'Delete', 
             iconCls:'delete',
             handler: function() { 
                 var m = grid.getSelections();
                 if(m.length > 0){ 
                     Ext.MessageBox.confirm('Message', 'are you sure to delete this file?' ,
                                            del); 
                 } else{ Ext.MessageBox.alert('Message', 'please... Choose one of file...!');
                 }
             }
           },
           {
            text: 'Save',
            handler: function() {


                var mr = grid.getStore().getModifiedRecords();
                var data = new Array;
                for (var index in mr) {
                    data.push(mr[index].data);
                }
                var conn = new Ext.data.Connection();
                conn.request({method: 'POST', url: 'cmd/saveaccount.php', 
                              params: { action: 'update', data: Ext.util.JSON.encode(data) } });
                conn.on('requestcomplete', function(sender, param) {
                    var response = Ext.util.JSON.decode(param.responseText);
                    if (response.success) {
                        grid.getStore().commitChanges();				
                    }
                }, { scope: this });

            }
        }]
    });

    grid.on('validateedit', function(e) {
       var dataIndex = e.field;
       switch(dataIndex) {
          case "typeid":
             var combo = grid.getColumnModel().getCellEditor(e.column, e.row).field;
             var displayFieldName = e.field.replace('typeid', 'typename');
             e.record.set(displayFieldName, combo.getRawValue());
             break;
          case "companyid":
             var combo = grid.getColumnModel().getCellEditor(e.column, e.row).field;
             var displayFieldName = e.field.replace('companyid', 'company_name');
             e.record.set(displayFieldName, combo.getRawValue());
             break;
       }
    });


    // trigger the data store load
    store.load();