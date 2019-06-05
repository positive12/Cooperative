

    var Checkbox = new Ext.grid.CheckboxSelectionModel();

    function formatDate(value){
        return value ? value.dateFormat('d M Y') : '';
    };

    function del(btn){         

        var m = grid.getSelections(); 

        var data = new Array;

        for(var i = 0, len = m.length; i < len; i++){ 
                data.push(m[i].get("scheduleid"));
         } 


        var conn = new Ext.data.Connection();
        conn.request({method: 'POST', url: 'cmd/saveschedule.php', 
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
           header: "SlNo",
           dataIndex: 'slno',
           width: 40
        },{           
           header: "Loan Name",
           dataIndex: 'loan_name',
           width: 100
        },{
          
           header: "Account Name",
           dataIndex: 'account_name',
           width: 120        
           
        },{
          
           header: "Instalment",
           dataIndex: 'instalment',
           width: 90,
           renderer: 'usMoney'  
           
        },{
           header: "Due Date",
           dataIndex: 'duedate',
           width: 80,
           align: 'right',
	   renderer: formatDate           
           
        },{
           header: "Status",
           dataIndex: 'status',
           width: 60,
	   renderer: function(val) {if (val == 1) return "Paid"; else return "";},
           editor: new fm.TextField({
	                  allowBlank: false
           })
        }
    ]);

    
    cm.defaultSortable = true;

    
    var Schedule = Ext.data.Record.create([
           {name: 'scheduleid', type: 'string'},
           {name: 'loanid', type: 'string'},
           {name: 'loan_name', type: 'string'},
	   {name: 'slno', type: 'string'},
           {name: 'account_name', type: 'string'},           
           {name: 'instalment', type: 'string'},
           {name: 'duedate', type: 'date', dateFormat: 'Y-m-d'},
           {name: 'status', type: 'string'}  
           
      ]);

    
    var store = new Ext.data.Store({        
        
        reader: new Ext.data.JsonReader({               
               root: 'results.schedules',
               id: 'scheduleid'
           }, Schedule),
           
        proxy: new Ext.data.HttpProxy({
             url: 'cmd/getschedule.php',
             method: 'POST'
        }),

        sortInfo:{field:'loanid', direction:'ASC'}
    });


    
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        cm: cm,
        sm: Checkbox,
        renderTo: 'editor-grid',
        width: 600,
        height: 300,
        //autoExpandColumn: 'common',
        title: 'Schedules',
        frame: true,
        
        clicksToEdit: 1,

        tbar: [{
            text: 'Add Loan',
            handler : function(){
                var p = new Schedule({
		   loanid: '',
		   loan_name: '',
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