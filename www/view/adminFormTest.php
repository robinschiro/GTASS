<?php
/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 7:06 PM
 *
 *
 *
 * Use the same naming convention used in the input names!
 */
?>
<form action="/createSession" method="post">

    <input type="datetime" placeholder="insert date time" name="nomDeadline"><br>
    <input type="datetime" placeholder="insert date time" name="resDeadline"><br>
    <input type="datetime" placeholder="insert date time" name="verDeadline"><br>

    <input type="text" placeholder="select chairman" name="chairman"><br><br>
    <div>
        <input type="text" placeholder="username" name="uname[0]">
        <input type="text" placeholder="first name" name="firstname[0]">
        <input type="password" placeholder="password" name="password[0]">
        <input type="text" placeholder="last name" name="lastname[0]">
        <input type="text" placeholder="email" name="email[0]">
    </div>

    <div>
        <input type="text" placeholder="username" name="uname[1]">
        <input type="text" placeholder="first name" name="firstname[1]">
        <input type="password" placeholder="password" name="password[1]">
        <input type="text" placeholder="last name" name="lastname[1]">
        <input type="text" placeholder="email" name="email[1]">
    </div>

    <div>
        <input type="text" placeholder="username" name="uname[2]">
        <input type="text" placeholder="first name" name="firstname[2]">
        <input type="password" placeholder="password" name="password[2]">
        <input type="text" placeholder="last name" name="lastname[2]">
        <input type="text" placeholder="email" name="email[2]">
    </div>

    <!-- For controller, so it knows which function to call -->
    <input type="hidden" name="createSession">

    <!-- Initially 1 will be incremented each time a new gc member is added -->
    <input type="hidden" name="gcCount" value="3">

    <input type="submit" name="submit">

</form>