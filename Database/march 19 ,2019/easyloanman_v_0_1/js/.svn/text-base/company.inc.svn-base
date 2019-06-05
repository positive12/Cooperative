

    var Checkbox = new Ext.grid.CheckboxSelectionModel();

    function formatDate(value){
        return value ? value.dateFormat('Y-m-d H:i:s') : '';
    };

    function del(btn){        

        var m = grid.getSelections();
        var data = new Array;

        for(var i = 0, len = m.length; i < len; i++){ 
             data.push(m[i].get("companyid"));
        } 


        var conn = new Ext.data.Connection();
        conn.request({method: 'POST', url: 'cmd/savecompany.php', 
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
           header: "Company",
           dataIndex: 'company_name',
           width: 100,
           editor: new fm.TextField({
	                  allowBlank: false
           })

        },{           
           header: "Description",
           dataIndex: 'company_desc',
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
               displayField: 'comp_typename',               
               valueField: 'typeid',
               lazyRender: true,
               listClass: 'x-combo-list-small',
               store: new Ext.data.JsonStore({
                            autoLoad: true,
                            url: 'cmd/getcompanytype.php',
                            fields: [ 'typeid', 'comp_typename' ]
               })
               
            }),
            renderer: function(v, m, r) { return r.get('comp_typename'); }
           
        }
    ]);

    
    cm.defaultSortable = true;

    
    var Company = Ext.data.Record.create([           
           {name: 'companyid', type: 'string'},
           {name: 'company_name', type: 'string'},
           {name: 'company_desc', type: 'string'},
           {name: 'typeid', type: 'string'},
           {name: 'comp_typename', type: 'string'}           
      ]);

    
    var store = new Ext.data.Store({        
        
        reader: new Ext.data.JsonReader({               
               root: 'results.companies',
               id: 'companyid'
           }, Company),
           
        proxy: new Ext.data.HttpProxy({
             url: 'cmd/getcompany.php',
             method: 'POST'
        }),

        sortInfo:{field:'company_name', direction:'ASC'}
    });


    
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        cm: cm,
        sm: Checkbox,
        renderTo: 'editor-grid',
        width: 600,
        height: 300,
        //autoExpandColumn: 'common',
        title: 'Companies',
        frame: true,
        
        clicksToEdit: 1,

        tbar: [{
            text: 'Add Company',
            handler : function(){
                var p = new Company({                    
                    companyid: '',
                    company_name: 'Company',
                    company_desc: '',
                    typeid: 1,
                    comp_typename: 'Select Type'                    
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
                     Ext.MessageBox.confirm('Message', 'are you sure to delete?' ,
                                            del); 
                 } else{ Ext.MessageBox.alert('Message', 'please... Choose record to delete...!');
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
                conn.request({method: 'POST', url: 'cmd/savecompany.php', 
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
             var displayFieldName = e.field.replace('typeid', 'comp_typename');
             e.record.set(displayFieldName, combo.getRawValue());
             break;          
       }
    });


    // trigger the data store load
    store.load();
