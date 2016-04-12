var counter = 0;
function addAdvisor(tableName)
{
  var table = document.getElementById('advisorTable');
  var newRow = table.insertRow();

  var removeButton = newRow.insertCell(0);
  var firstName = newRow.insertCell(1);
  var lastName = newRow.insertCell(2);
  var startDate = newRow.insertCell(3);
  var endDate = newRow.insertCell(4);

  removeButton.innerHTML = "<input type='button' value='Remove' onclick='deleteAdvisor(this);'>";
  firstName.innerHTML = "<input type='text' placeholder='First Name' name='advFirstName[" + counter + "]'>";
  lastName.innerHTML = "<input type='text' placeholder='Last Name' name='advLastName[" + counter + "]'>";
  startDate.innerHTML = "<input type='date' placeholder='Start Date' name='advStartDate[" + counter + "]'>";
  endDate.innerHTML = "<input type='date' placeholder='End Date' name='advEndDate[" + counter + "]'>";

  counter++;
}

function deleteAdvisor(removeButton)
{
  var index = removeButton.parentNode.parentNode.rowIndex;
  document.getElementById("advisorTable").deleteRow(index);

  // Update the counter
  counter--;
}