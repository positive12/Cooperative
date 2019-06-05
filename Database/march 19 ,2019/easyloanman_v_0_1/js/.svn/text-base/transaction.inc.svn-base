

    var Checkbox = new Ext.grid.CheckboxSelectionModel();

    function formatDate(value){
        return value ? value.dateFormat('Y-m-d H:i:s') : '';
    };

    function del(btn){         

        var m = grid.getSelections(); 

        var data = new Array;

        for(var i = 0, len = m.length; i < len; i++){ 
                data.push(m[i].get("tranid"));
         } 


        var conn = new Ext.data.Connection();
        conn.request({method: 'POST', url: 'cmd/savetransaction.php', 
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
           header: "Loan",
           dataIndex: 'loanid',
           width: 130,           

            editor: new Ext.form.ComboBox({
                           displayField: 'loan_name',                           
                           valueField: 'loanid',                         
                           
                           store: new Ext.data.JsonStore({
                                autoLoad: true,
                                url: 'cmd/getloan.php',
                                root: 'results.loans',
                                fields: [ 'loanid', 'loan_name' ]
                            })
                    }), 
            renderer: function(v, m, r) { return r.get('loan_name'); }


        },{
          
           header: "Tran Type",
           dataIndex: 'trantype',
           width: 100,
	   editor: new fm.TextField({
	                  allowBlank: false
           })           
           
        },{
           header: "Tran Date",
           dataIndex: 'trandate',
           width: 120,
           align: 'right',
           renderer: formatDate,
           editor: new fm.DateField({
                format: 'Y-m-d H:i:s'               
                
            })
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
           
        }
    ]);

    
    cm.defaultSortable = true;

    
    var Loan = Ext.data.Record.create([
           {name: 'tranid', type: 'string'},
           {name: 'loanid', type: 'string'},
           {name: 'loan_name', type: 'string'},
           {name: 'amount', type: 'string'},
           {name: 'trantype', type: 'string'},
           {name: 'trandate', type: 'date', dateFormat: 'Y-m-d H:i:s'}           
      ]);

    
    var store = new Ext.data.Store({        
        
        reader: new Ext.data.JsonReader({               
               root: 'results.transactions',
               id: 'tranid'
           }, Loan),
           
        proxy: new Ext.data.HttpProxy({
             url: 'cmd/gettransaction.php',
             method: 'POST'
        }),

        sortInfo:{field:'loan_name', direction:'ASC'}
    });


    
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        cm: cm,
        sm: Checkbox,
        renderTo: 'editor-grid',
        width: 600,
        height: 300,
        //autoExpandColumn: 'common',
        title: 'Transactions',
        frame: true,
        
        clicksToEdit: 1,

        tbar: [{
            text: 'Add',
            handler : function(){
                var p = new Loan({
		   tranid: '',
		   loanid: 1,
		   loan_name: 'Select Loan',
		   amount: '',		   
		   trandate: (new Date()).clearTime(),
		   trantype: '1'                    
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
                conn.request({method: 'POST', url: 'cmd/savetransaction.php', 
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
          case "loanid":
             var combo = grid.getColumnModel().getCellEditor(e.column, e.row).field;
             var displayFieldName = e.field.replace('loanid', 'loan_name');
             e.record.set(displayFieldName, combo.getRawValue());
             break;
       }
    });


    // trigger the data store load
    store.load();