var counter = 0;
function addCourse(tableName)
{
  var table = document.getElementById('courseTable');
  var newRow = table.insertRow();

  var removeButton = newRow.insertCell(0);
  var courseName = newRow.insertCell(1);
  var courseGrade = newRow.insertCell(2);

  removeButton.innerHTML = "<input type='button' value='Remove' onclick='deleteCourse(this);'>";
  courseName.innerHTML = "<input type='text' placeholder='Course Name' name='courseName[" + counter + "]'>";
  courseGrade.innerHTML = "<input type='text' placeholder='Letter Grade' name='courseGrade[" + counter + "]'>";

  counter++;
  document.getElementById('numCourses').setAttribute('value', counter);
}

function deleteCourse(removeButton)
{
  var index = removeButton.parentNode.parentNode.rowIndex;
  document.getElementById("courseTable").deleteRow(index);

  // Update the counter
  counter--;
  document.getElementById('numCourses').setAttribute('value', counter);
}