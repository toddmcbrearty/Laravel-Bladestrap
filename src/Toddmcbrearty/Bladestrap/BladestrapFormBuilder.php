<?php namespace Toddmcbrearty\Bladestrap;

use Illuminate\Html\FormBuilder as IlluminateFormBuilder;

/**
 * Class FormBuilder
 *
 * @package AcmeHtml
 */
class BladestrapFormBuilder extends IlluminateFormBuilder {

    /**
     * @var array
     */
    private $wrapper_options = [];


    /**
     * @param array $options
     *
     * @return string
     */
    public function elOpen($options = [])
    {
        $default_options = [
            'role' => 'form',
        ];

        $options = array_merge($default_options, $options);

        return $this->open($options);
    }

    /**
     * This just make its stay uniform in the views
     *
     * @return mixed
     */
    public function elClose()
    {
        return $this->close();
    }

    /**
     * @param       $name
     * @param       $label
     * @param null  $value
     * @param array $options
     * @param array $wrapper_options
     *
     * @return string
     */
    public function elText($name, $label, $value = null, $options = [], $wrapper_options = [])
    {
        $this->wrapper_options = $wrapper_options;

        return $this->field('text', $name, $label, $value, $options);
    }

    /**
     * @param       $name
     * @param       $label
     * @param null  $value
     * @param array $options
     *
     * @return string
     */
    public function elNumber($name, $label, $value = null, $options = [])
    {
        return $this->field('number', $name, $label, $value, $options);
    }

    /**
     * @param       $name
     * @param       $label
     * @param null  $value
     * @param array $options
     *
     * @return string
     */
    public function elEmail($name, $label, $value = null, $options = [])
    {
        return $this->field('email', $name, $label, $value, $options);
    }

    /**
     * @param       $name
     * @param       $label
     * @param null  $value
     * @param array $options
     *
     * @return string
     */
    public function elPassword($name, $label, $options = [])
    {
        return $this->field('password', $name, $label, null, $options);
    }

    /**
     * @param       $name
     * @param       $label
     * @param null  $value
     * @param array $options
     *
     * @return string
     */
    public function elTextarea($name, $label, $value = null, $options = [])
    {
        return $this->field('textarea', $name, $label, $value, $options);
    }

    /**
     * @param       $name
     * @param       $label
     * @param int   $value
     * @param null  $checked
     * @param array $options
     *
     * @return string
     */
    public function elRadio($name, $label, $value = 1, $checked = null, $options = array())
    {

        $radio = $this->radio($name, $value, $checked, $options);

        $html = $radio . ' ' . $label;

        return $this->wrapCheckboxRadioGroup($html, 'radio');
    }

    /**
     * @param       $name
     * @param       $label
     * @param int   $value
     * @param null  $checked
     * @param array $options
     *
     * @return string
     */
    public function elCheckbox($name, $label, $value = 1, $checked = null, $options = array())
    {

        $checkbox = $this->checkbox($name, $value, $checked, $options);

        $html = $checkbox . ' ' . $label;

        return $this->wrapCheckboxRadioGroup($html, 'checkbox');
    }

    /**
     * @param       $value
     * @param array $options
     *
     * @return string
     */
    public function elSubmit($value, $options = [], $class = 'warning')
    {
        return $this->buttons('submit', $value, $options, $class);
    }

    /**
     * @param       $value
     * @param array $options
     *
     * @return string
     */
    public function elButton($value, $options = [], $class = 'success')
    {
        return $this->buttons('button', $value, $options, $class);
    }

    /**
     * @param $name
     * @param $label
     * @param $list
     * @param $selected
     * @param $options
     *
     * @return string
     */
    public function elSelect($name, $label, $list, $selected = null, $options = [])
    {
        $default_options = [
            'class' => 'form-control',
        ];

        $options = $this->parseOptions($options, $default_options);

        $html = $this->label($name, ucwords($label));
        $html .= $this->select($name, $list, $selected, $options);

        return $this->wrapFormGroup($html);

    }

    /**
     * @param $messages
     *
     * @return string
     */
    public function message($messages, $class = 'success')
    {
        $html = '<div class="alert alert-'.$class.'"><ul class="list-unstyled">';

        foreach($messages as $message)
        {
            $html .= "<li>{$message}</li>";
        }

        $html .= "</ul></div>";

        return $html;
    }

    /**
     * @param $html
     *
     * @return string
     */
    private function wrapCheckboxRadioGroup($html, $checkRadio)
    {
        return "<div class=\"{$checkRadio}\"><label>{$html}</label></div>";
    }

    /**
     * @param $html
     *
     * @return string
     */
    private function wrapFormGroup($html)
    {
        $default_options = [
            'class' => 'form-group',
        ];

        $options = $this->parseOptions($this->wrapper_options, $default_options);
        
        return "<div ".$this->html->attributes($options).">{$html}</div>";
    }

    /**
     * @param $name
     * @param $label
     * @param $value
     * @param $options
     *
     * @return string
     */
    public function field($type, $name, $label, $value, $options = [])
    {
        $default_options = [
            'class' => 'form-control',
        ];

        $options = $this->parseOptions($options, $default_options);

        $html = $this->label($name, ucwords($label));
        if($type == 'password')
            $html .= $this->$type($name, $options);
        else
            $html .= $this->$type($name, $value, $options);

        return $this->wrapFormGroup($html);
    }

    /**
     * @param null|string $value
     * @param array       $options
     *
     * @return string
     */
    private function buttons($type, $value, $options, $class)
    {

        $default_options = [
            'class' => 'btn btn-'.$class,
        ];

        if(isset($options['class'])) {
            $options['class'] = $default_options['class'] . ' ' . $options['class'];
            unset($default_options['class']);
        }

        $options = array_merge($default_options, $options);

        return $this->wrapFormGroup($this->$type($value, $options));
    }

    /**
     * @param $value
     * @param $options
     * @param $default_options
     *
     * @return array
     */
    private function parseOptions($options, $default_options)
    {
        foreach($options as $option => $value)
        {
            if($option == 'class')
            {
                $default_options['class'] = $default_options['class'] . ' ' . $value;
            }
        }

        return array_merge($options, $default_options);

    }


}