<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
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
            </div>
        </div>
    </div>
</div>