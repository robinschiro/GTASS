var counter = 1;
function addInputNominator(divName) {

    var newdiv = document.createElement('div');
    newdiv.innerHTML = "<br><br><label for='fname'>First Name: </label>" +
        "<input type='text' name='fname[" + counter  + "]' placeholder='Nominee&#39s First Name' id='fname'>" + " " +
        "<label for='fname'>Last Name: </label>" +
        "<input type='text' name='lname[" + counter  + "]' placeholder='Nominee&#39s Last Name' id='lname'>" + " " +
        "<label for='pid'>PID: </label>" +
        "<input type='text' name='pid[" + counter  + "]' placeholder='Nominee&#39s PID' id='pid'>" + " " +
        "<label for='email'>Email: </label>" +
        "<input type='text' name='email[" + counter  + "]' placeholder='Nominee&#39s Email' id='email'>" + " " + "<br>" +
        "<label for='rank'>Rank Nominee: </label>" +
        "<input type='number' name='rank[" + counter  + "]' placeholder='Rank'  min='0' max='100' id='rank'>" + " " +
        "CS Graduate: " + "<label for='yes'>yes </label>" +
        "<input type='radio' value='yes' name='csgrad['" + counter + "']' id='yes'>" + " " +
        "<label for='no'>no </label>" +
        "<input type='radio' value='no' name='csgrad['" + counter + "']' id='no' >" + " " +
        "New Graduate: " + "<label for='yesnew'>yes </label>" +
        "<input type='radio' value='yes' name='newgrad['" + counter + "']' id='yes'>" + " " +
        "<label for='nonew'>no </label>" +
        "<input type='radio' value='no' name='newgrad['" + counter + "']' id='no' >" + " <br><br>";

    document.getElementById(divName).appendChild(newdiv);
    counter++;
    document.getElementById('gcCount').setAttribute('value', counter);
}
