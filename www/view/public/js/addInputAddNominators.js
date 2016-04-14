var counter = 1;
function addInput(divName)
{
  var newdiv = document.createElement('div');

  newdiv.innerHTML = "Nominator: " +
  "<input type='text'  id='requi' placeholder='username' name='uname[" + counter + "]'>" + " " +
  "<input type='password' id='requi' placeholder='password' name='password[" + counter + "]'>" + " " +
  "<input type='text' id='requi' placeholder='first name' name='firstname[" + counter + "]'>" + " " +
  "<input type='text' id='requi' placeholder='last name' name='lastname[" + counter + "]'>" + " " +
  "<input type='text' id='requi' placeholder='email' name='email[" + counter + "]'>" + " " +
  "<input type='button' value='Remove' name='remove['" + counter + "']' onclick='this.parentNode.parentNode.removeChild(this.parentNode);removeOthers();'> " + " <br><br>";

  document.getElementById(divName).appendChild(newdiv);
  counter++;
  document.getElementById('gcCount').setAttribute('value', counter);
}

function removeFirst()
{
  var ele = document.getElementById('dynamicInput');
  ele.parentNode.removeChild(ele);
  counter--;
  document.getElementById('gcCount').setAttribute('value', counter);
}

function removeOthers()
{
  counter--;
  document.getElementById('gcCount').setAttribute('value', counter);
}
