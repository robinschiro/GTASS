var counter = 1;
function addInput(divName) {

    var newdiv = document.createElement('div');
    newdiv.innerHTML = "GC " + (counter + 1) + ": " +
        "<input type='text' placeholder='username' name='uname[" + counter + "]'>" + " " +
        "<input type='password' placeholder='password' name='password[" + counter + "]'>" + " " +
        "<input type='text' placeholder='first name' name='firstname[" + counter + "]'>" + " " +
        "<input type='text' placeholder='last name' name='lastname[" + counter + "]'>" + " " +
        "<input type='text' placeholder='email' name='email[" + counter + "]'>" + " " +
        "Chairman <input type='radio' value='" + counter + "' name='chairmanBool'>" +
		    "<input type='button' value='Remove' name='remove['" + counter + "']' onclick='this.parentNode.parentNode.removeChild(this.parentNode);'> " + " <br><br>";

    document.getElementById(divName).appendChild(newdiv);
    counter++;
    document.getElementById('gcCount').setAttribute('value', counter);
}

function removeFirst(divName)
{
	var ele = document.getElementById('dynamicInput');
	ele.parentNode.removeChild(ele)
}
