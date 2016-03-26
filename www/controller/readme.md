Forms will be passed to the controller as such:


    <form action="controllerName" method="methodName (like Post)">
        <input type="text" name="name">
        <input type="text" name="email">
        <button type="submit">Submit</button>
        <input type="hidden" name="identifier for form on controller"
    </form>

Controller

a bunch of if statements initially like:

    if(isset($_POST['submit'])){
        functionCall();
    }

the parameter in $_POST[ ] is the name of the hidden input,
then we would simply call the appropriate function in our model.  Make
sure to import the appropriate files that are used.
