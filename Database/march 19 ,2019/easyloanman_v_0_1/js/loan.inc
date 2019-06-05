

    var Checkbox = new Ext.grid.CheckboxSelectionModel();

    function formatDate(value){
        return value ? value.dateFormat('Y-m-d H:i:s') : '';
    };

    function del(btn){         

        var m = grid.getSelections(); 

        var data = new Array;

        for(var i = 0, len = m.length; i < len; i++){ 
                data.push(m[i].get("loanid"));
         } 


        var conn = new Ext.data.Connection();
        conn.request({method: 'POST', url: 'cmd/saveloan.php', 
                      params: { action: 'delete', data: Ext.util.JSON.encode(data) } });

        conn.on('requestcomplete', function(sender, param) {
            var response = Ext.util.JSON.decode(param.responseText);
            if (response.success) {                	

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
           header: "Loan Name",
           dataIndex: 'loan_name',
           width: 95,
           editor: new fm.TextField({
	                  allowBlank: false
           })
        },{           
           header: "Account",
           dataIndex: 'accountid',
           width: 100,           

            editor: new Ext.form.ComboBox({
                           displayField: 'account_name',                           
                           valueField: 'accountid',                         
                           
                           store: new Ext.data.JsonStore({
                                autoLoad: true,
                                url: 'cmd/getaccount.php',
                                root: 'results.accounts',
                                fields: [ 'accountid', 'account_name' ]
                            })
                    }), 
            renderer: function(v, m, r) { return r.get('account_name'); }


        },{
          
           header: "Amount",
           dataIndex: 'amount',
           width: 100,
           renderer: 'usMoney',
           editor: new fm.NumberField({
               allowBlank: false,
               allowNegative: false,
               maxValue: 100000
           })
           
        },{
          
           header: "Balance",
           dataIndex: 'balance',
           width: 100,
           renderer: 'usMoney',
           editor: new fm.NumberField({
               allowBlank: false,
               allowNegative: false,
               maxValue: 100000
           })
           
        },{
           header: "Start Date",
           dataIndex: 'startdate',
           width: 70,
           align: 'right',
           renderer: formatDate,
           editor: new fm.DateField({
                format: 'Y-m-d H:i:s'               
                
            })
        },{
           header: "Due Date",
           dataIndex: 'duedate',
           width: 95,
           renderer: formatDate,
           editor: new fm.DateField({
                format: 'Y-m-d H:i:s'               
                
            })
           
        },{
           header: "Term",
           dataIndex: 'term',
           width: 95,
           editor: new fm.TextField({
	                  allowBlank: false
           })
        }
    ]);

    
    cm.defaultSortable = true;

    
    var Loan = Ext.data.Record.create([
           {name: 'loanid', type: 'string'},
           {name: 'loan_name', type: 'string'},
           {name: 'accountid', type: 'string'},
           {name: 'account_name', type: 'string'},
           {name: 'amount', type: 'string'},
           {name: 'balance', type: 'string'},
           {name: 'startdate', type: 'date', dateFormat: 'Y-m-d H:i:s'},
           {name: 'duedate', type: 'string'},
           {name: 'term', type: 'float'}  
           
      ]);

    
    var store = new Ext.data.Store({        
        
        reader: new Ext.data.JsonReader({               
               root: 'results.loans',
               id: 'loanid'
           }, Loan),
           
        proxy: new Ext.data.HttpProxy({
             url: 'cmd/getloan.php',
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
        title: 'Loans',
        frame: true,
        
        clicksToEdit: 1,

        tbar: [{
            text: 'Add Loan',
            handler : function(){
                var p = new Loan({
		   loanid: '',
		   loanname: 'Loan Name',
		   accountid: 1,
		   account_name: 'Select Account',
		   amount: '',
		   balance: '',
		   startdate: (new Date()).clearTime(),
		   duedate: (new Date()).clearTime(),
		   term: ''                    
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
                conn.request({method: 'POST', url: 'cmd/saveloan.php', 
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
          case "accountid":
             var combo = grid.getColumnModel().getCellEditor(e.column, e.row).field;
             var displayFieldName = e.field.replace('accountid', 'account_name');
             e.record.set(displayFieldName, combo.getRawValue());
             break;
       }
    });


    // trigger the data store load
    store.load();