Bladestrap
==========

##Generates bootstrap blocks using blade functions
This is a simple class that will wrap form elements within bootstrap form wrappers. I do not have much done 
I am building it as I need it. If you update it please fork and add a push request. 

#Installation

###Composer

    composer require toddmcbrearty\bladestrap

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
* message($messages, $class = 'success')

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