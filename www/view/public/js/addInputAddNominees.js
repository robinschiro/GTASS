var counter = 1;
function addInput(divName)
{
  var newdiv = document.createElement('div');

  newdiv.innerHTML = "First Name: <input type='text'  id='requi' name='fname[" + counter  + "]' placeholder='Nominee&#39s First Name' id='fname'>" + " " +
  "Last Name: <input type='text'  id='requi' name='lname[" + counter  + "]' placeholder='Nominee&#39s Last Name' id='lname'>" + " " +
  "PID: <input type='text'  id='requi' name='pid[" + counter  + "]' placeholder='Nominee&#39s PID' id='pid'>" + " " +
  "Email: <input type='text'  id='requi' name='email[" + counter  + "]' placeholder='Nominee&#39s Email' id='email'>" + " " + "<br>" +
  "Nominee's Rank: <input type='number'  id='requi' name='rank[" + counter  + "]' placeholder='Rank'  min='0' max='100' id='rank'>" + " " +
  "CS Graduate:  <select name='test1[" + counter + "]'> <option value='1'>Yes</option> <option value='0'>No</option>" + "</select>" + " " +
  "New Graduate:  <select name='test2[" + counter + "]'> <option value='0'>No</option> <option value='1'>Yes</option>" + "</select>" + " " +
  "<input type='button' value='Remove' name='remove['" + counter + "']' onclick='this.parentNode.parentNode.removeChild(this.parentNode);removeOthers();'> " + " <br><br>";

  document.getElementById(divName).appendChild(newdiv);
  counter++;
  document.getElementById('count').setAttribute('value', counter);
}

function removeFirst()
{
  var ele = document.getElementById('dynamicInput');
  ele.parentNode.removeChild(ele);
  counter--;
  document.getElementById('NomCount').setAttribute('value', counter);
}

function removeOthers()
{
  counter--;
  document.getElementById('NomCount').setAttribute('value', counter);
}
