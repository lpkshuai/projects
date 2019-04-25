 
$('#excelbtn').click(function(){  
    console.log(1)  
    $("#datatable").table2excel({  
        exclude: ".noExl",//      exclude：不被导出的表格行的CSS class类。  
        name: "表格-" + new Date().getTime(),//      name：导出的Excel文档的名称。  
        filename: "表格-" + new Date().getTime() + ".xls",//      filename：Excel文件的名称。  
        exclude_img: true,//      exclude_img：是否导出图片。  
        exclude_links: true,//      exclude_links：是否导出超链接  
        exclude_inputs: true//      exclude_inputs：是否导出输入框中的内容。  
    });  
})






        
 