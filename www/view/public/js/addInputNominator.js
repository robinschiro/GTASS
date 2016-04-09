var counter = 1;
function addInputNominator(divName)
{
  var newdiv = document.createElement('div');

  newdiv.innerHTML = "<label for='fname'>First Name: </label>" +
  "<input type='text' name='fname[" + counter  + "]' placeholder='Nominee&#39s First Name' id='fname'>" + " " +
  "<label for='fname'>Last Name: </label>" +
  "<input type='text' name='lname[" + counter  + "]' placeholder='Nominee&#39s Last Name' id='lname'>" + " " +
  "<label for='pid'>PID: </label>" +
  "<input type='text' name='pid[" + counter  + "]' placeholder='Nominee&#39s PID' id='pid'>" + " " +
  "<label for='email'>Email: </label>" +
  "<input type='text' name='email[" + counter  + "]' placeholder='Nominee&#39s Email' id='email'>" + " " + "<br>" +
  "<label for='rank'>Rank Nominee: </label>" +
  "<input type='number' name='rank[" + counter  + "]' placeholder='Rank'  min='0' max='100' id='rank'>" + " " +
  "CS Graduate: " + "<label for='yes" + counter  + "'>yes </label>" +
  "<input type='radio' value='1' name='csgrad[" + counter + "]' id='yes" + counter  + "'>" + " " +
  "<label for='no" + counter  + "'>no </label>" +
  "<input type='radio' value='0' name='csgrad[" + counter + "]' id='no" + counter  + "' >" + " " +
  "New Graduate: " + "<label for='yesnew" + counter  + "'>yes </label>" +
  "<input type='radio' value='1' name='newgrad[" + counter + "]' id='yesnew" + counter  + "'>" + " " +
  "<label for='nonew" + counter  + "'>no </label>" +
  "<input type='radio' value='0' name='newgrad[" + counter + "]' id='nonew" + counter  + "' >" +
  "<input type='button' value='Remove' name='remove['" + counter + "']' onclick='this.parentNode.parentNode.removeChild(this.parentNode);'> " + " <br><br>";

  document.getElementById(divName).appendChild(newdiv);
  counter++;
  document.getElementById('count').setAttribute('value', counter);
}

function removeFirst(divName)
{
  var ele = document.getElementById('dynamicInput');
  ele.parentNode.removeChild(ele);
  counter--;
}
