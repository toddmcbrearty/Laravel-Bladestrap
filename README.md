Bladestrap
==========

##Generates bootstrap blocks using blade functions
This is a simple class that will wrap form elements within bootstrap form wrappers. I do not have much done 
I am building it as I need it. If you update it please fork and add a push request. 

#Installation

###Composer

   add "toddmcbrearty/bladestrap": "dev-master" to your composer file

####Laravel 4.2.*

Open you app/config/app.php file
Look within your providers key 

**Find and comment line** 

    'Illuminate\Html\HtmlServiceProvider',
    
**then add line**

    'Toddmcbrearty\Bladestrap\BladestrapServiceProvider',
    
#Usage

You have all the blade function already extended through this package.
You can still use all your Form:: methods but now you can
also use the bootstrap methods.

**New available methods:**

* elOpen(options = [])
* elClose()
* elText($name, $label, $value = null, $options = [], $wrapper_options = [])
* elNumber($name, $label, $value = null, $options = [])
* elPassword($name, $label, $value = null, $options = [])
* elEmail($name, $label, $options = [])
* elTextarea($name, $label, $value = null, $options = [])
* elRadio($name, $label, $value = 1, $checked = null, $options = array())
* elCheckbox($name, $label, $value = 1, $checked = null, $options = array())
* elSelect($name, $label, $list, $selected = null, $options = [])
* elSubmit($value, $options = [], $class = 'warning')
* elButton($value, $options = [], $class = 'success')
* elMessage($messages, $class = 'success')
* elCols($size, $data)
    * $size is the size of each column. (soon you'll be able to pass an array of column sizes)
    * $data will be an array of html that will be loaded into the column
    * Columns are created based on the amount of data elements there are
#Example:
###Blade Code

    {{ Form::elOpen() }}
        {{ Form::elText('username', 'Username:') }}
        {{ Form::elPassword('password', 'Password:') }}
        {{ Form::elSubmit('Login')
    {{ Form::close() }} or {{ Form::elClose() }}
    
###Generates

    <form method="POST" action="http://example.com" accept-charset="UTF-8" role="form"><input name="_token" type="hidden" value="BylLDNnkl76JX7kySeCtz8t4IelgHLwdy0lvlxs">
        <div class="form-group"><label for="username">Username:</label><input class="form-control" name="username" type="text" id="username"></div>
        <div class="form-group"><label for="password">Password:</label><input class="form-control" name="password" type="password" value="" id="password"></div>
        <div class="form-group"><input class="btn btn-warning" type="submit" value="Login"></div>
    </form>
    
###Blade Code
 
    {{ Form::elOpen(['url' => 'login']) }}
        {{ Form::elText('company', 'Company:', null, ['placeholder' => 'Company']) }}
        {{ Form::elCols(6, [
            Form::elText('firstname', 'First Name:', null, ['placeholder' => 'First Name']),
            Form::elText('lastname', 'Last Name:', null, ['placeholder' => 'Last Name'])
        ]) }}
        {{ Form::elEmail('email', 'Email:', null, ['placeholder' => 'Email']) }}
        {{ Form::elPassword('password', 'Password:', ['placeholder' => 'Password']) }}
        {{ Form::label('Subscribe to emails:') }}
        {{ Form::elRadio('subscribe', 'Yes', 1, true, [], true) }}
        {{ Form::elRadio('subscribe', 'No', 0, true, [], true) }}
        {{ Form::elSelect('type', 'Account Type:', ['1' => 'Business', '2' => 'Personal']) }}
        {{ Form::elCheckbox('agree', 'Agree to terms', 1, false) }}
        {{ Form::elSubmit('Register!', [], 'success') }}
    {{ Form::elClose() }}
    
###Generates
 
     <form method="POST" action="http://localhost:8000/login" accept-charset="UTF-8" role="form"><input name="_token" type="hidden" value="6tWO8sy85oiCjXICGIHVRjarBHIYFpB5gf1OJxmu">
         <div  class="form-group"><label for="company">Company:</label><input placeholder="Company" class="form-control" name="company" type="text" id="company"></div>
    
         <div class="row"><div class="col-md-6"><div  class="form-group"><label for="firstname">First Name:</label><input placeholder="First Name" class="form-control" name="firstname" type="text" id="firstname"></div></div><div class="col-md-6"><div  class="form-group"><label for="lastname">Last Name:</label><input placeholder="Last Name" class="form-control" name="lastname" type="text" id="lastname"></div></div></div>
         <div  class="form-group"><label for="email">Email:</label><input placeholder="Email" class="form-control" name="email" type="email" id="email"></div>
         <div  class="form-group"><label for="password">Password:</label><input placeholder="Password" class="form-control" name="password" type="password" value="" id="password"></div>
         <label for="Subscribe to emails:">Subscribe To Emails:</label>
         <div class="checkbox-inline"><label><input checked="checked" name="subscribe" type="radio" value="1"> Yes</label></div>
         <div class="checkbox-inline"><label><input checked="checked" name="subscribe" type="radio" value="0"> No</label></div>
         <div  class="form-group"><label for="type">Account Type:</label><select class="form-control" id="type" name="type"><option value="1">Business</option><option value="2">Personal</option></select></div>
         <div class="checkbox"><label><input name="agree" type="checkbox" value="1"> Agree to terms</label></div>
         <div  class="form-group"><input class="btn btn-success" type="submit" value="Register!"></div>
     </form>
