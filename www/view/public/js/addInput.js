var counter = 1;
function addInput(divName)
{
     
          var newdiv = document.createElement('div');
		  newdiv.innerHTML = "GC " + (counter + 1) + " <input type='text' placeholder='username' name='uname[]'>" + 
        "<input type='text' placeholder='first name' name='firstname[]'>" +
        "<input type='password' placeholder='password' name='password[]'>" +
        "<input type='text' placeholder='last name' name='lastname[]'>" +
        "<input type='text' placeholder='email' name='email[]'>"; 
          document.getElementById(divName).appendChild(newdiv);
          counter++;
		  
}