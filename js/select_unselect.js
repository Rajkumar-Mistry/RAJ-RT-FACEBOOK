function selectAll_single_image() 
{
         
        var items = document.getElementsByClassName('image-checkbox');
        var add_class ="image-checkbox-checked";
        
        
        var items1 = document.getElementsByClassName('album');
      
        for (var index = 0; index < items1.length; index++) 
        {
            if (items1[index].type == 'checkbox')
                items1[index].checked = true;
        }
        
       for (var position = 0; position < items.length; position++) 
       {

            if (items[position].tagName == 'LABEL')
            {
              
                  var arr = items[position].className.split(" ");
                  if (arr.indexOf(add_class) == -1)
                   {
                      items[position].className += " " + add_class;
                  }
                  
            }
           

        }
    }
    function UnSelectAll_single_image() {
         
        var items = document.getElementsByClassName('image-checkbox');
        
        var items1 = document.getElementsByClassName('album');
     
       for (var index = 0; index < items1.length; index++) 
       {
            if (items1[index].type == 'checkbox')
            {
                 if(items1[index].checked === true)
                 {
                   items1[index].checked = false;   
                 }
            }     
        }
        
       
       for (var position = 0; position < items.length; position++) 
       {
            if (items[position].tagName == 'LABEL')
            {
              
                  
                  items[position].className = items[position].className.replace(/\bimage-checkbox-checked\b/g, "");
                  //window.alert(items[i].className);
                  
            }
           

        }
    }
 function selectAll() 
    {
         var items = document.getElementsByClassName('profile_Albums');
        for (var index = 0; index < items.length; index++) 
        {
            if (items[index].type == 'checkbox')
                items[index].checked = true;
        }
    }

    function UnSelectAll() {
        var items = document.getElementsByClassName('profile_Albums');
        for (var index = 0; index < items.length; index++) {
            if (items[index].type == 'checkbox')
                items[index].checked = false;
        }
    }  

function login_user(name) 
{
         
        document.getElementById("name").innerHTML =name;
}
function downloadlink(path) 
{
        
         document.getElementById("link").href = path+'.zip';
         document.getElementById("downloadlink").innerHTML = path;
         
}
function show_message() 
{
   window.alert("please select images");
} 

function show_message_album() 
{
   window.alert("Please Select Album");
    
    
} 