var counter = 0;
function addPublication(tableName)
{
  var table = document.getElementById('publicationTable');
  var newRow = table.insertRow();

  var removeButton = newRow.insertCell(0);
  var title = newRow.insertCell(1);
  var citation = newRow.insertCell(2);

  removeButton.innerHTML = "<input type='button' value='Remove' onclick='deletePublication(this);'>";
  title.innerHTML = "<input type='text' placeholder='Title' name='pubTitle[" + counter + "]'>";
  citation.innerHTML = "<input type='text' placeholder='Citation' name='pubCitation[" + counter + "]'>";

  counter++;
  document.getElementById('numPublications').setAttribute('value', counter);
}

function deletePublication(removeButton)
{
  var index = removeButton.parentNode.parentNode.rowIndex;
  document.getElementById("publicationTable").deleteRow(index);

  // Update the counter
  counter--;
  document.getElementById('numPublications').setAttribute('value', counter);
}