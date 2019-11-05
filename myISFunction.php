<head>
<script>
function myValidion(inputEle, checkValue){
    let name = inputEle.name;
    let vid = "validation." + name;
    let vele = document.getElementbyId(vid);
    let value = inputEle.value;
    if(value == checkValue){
          if(vele){
	        vele.remove();
		}
    }
    else{
        if(!vele){
	     vele + document.createElement("span");
	     vele.id = vid;
	     document.body.appendchild(vele);
	}
	vele.innerText = name+ " has an invalid value";
   }
   return false;
}
</script>
</head>
</HTML>

     
