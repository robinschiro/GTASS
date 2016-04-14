/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 4/14/2016
 * Time: 1:54 AM
 */

function validateForms()
{
    if (!document.getElementsByTagName) return false;
    elementsForms = document.getElementsByTagName("form");
    for (var intCounter = 0; intCounter < elementsForms.length; intCounter++)
    {
        if (validateForm(elementsForms[intCounter]))
        {
            return false;
        }
        else
            return true;
    }
}
function validateForm(currentForm)
{
    var blnvalidate = true;
    var elementsInputs;

    elementsInputs = currentForm.getElementsByTagName("input");
    var count = 0;

    for (var intCounter = 0; intCounter < elementsInputs.length; intCounter++)
    {
        if (elementsInputs[intCounter].id == "requi")
        {
            if (validateText(elementsInputs, intCounter))
            {
                blnvalidate = true;
                count++;
            }
        }
    }
    if (count > 0 )
    {
        alert('Please Fill Everything Out!');
        return blnvalidate;
    }
    else
        return false
}

function validateText(elementsInputs, intCounter)
{
    if (elementsInputs[intCounter].value == "")
    {
        return true;
    }
}