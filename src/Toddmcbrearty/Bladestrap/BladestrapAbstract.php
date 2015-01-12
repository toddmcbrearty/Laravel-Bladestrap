<?php namespace Toddmcbrearty\Bladestrap;

use Illuminate\Html\FormBuilder as IlluminateFormBuilder;

abstract class BladestrapAbstract extends IlluminateFormBuilder {
    /**
     * @var array
     */
    protected $wrapper_options = [];

    /**
     * @param array $options
     */
    public function elOpen($options = []) {}

    /**
     * @param       $name
     * @param       $label
     * @param null  $value
     * @param array $options
     * @param array $wrapper_options
     */
    public function elText($name, $label, $value = null, $options = [], $wrapper_options = []) {}

    /**
     * @param       $name
     * @param       $label
     * @param null  $value
     * @param array $options
     * @param array $wrapper_options
     */
    public function elNumber($name, $label, $value = null, $options = [], $wrapper_options = []) {}

    /**
     * @param       $name
     * @param null  $label
     * @param null  $value
     * @param array $options
     * @param array $wrapper_options
     */
    public function elEmail($name, $label = null, $value = null, $options = [], $wrapper_options = []) {}

    /**
     * @param       $name
     * @param null  $label
     * @param array $options
     * @param array $wrapper_options
     */
    public function elPassword($name, $label = null, $options = [], $wrapper_options = []) {}

    /**
     * @param       $name
     * @param null  $label
     * @param null  $value
     * @param array $options
     * @param array $wrapper_options
     */
    public function elTextarea($name, $label = null, $value = null, $options = [], $wrapper_options = []) {}

    /**
     * @param       $name
     * @param null  $label
     * @param int   $value
     * @param null  $checked
     * @param array $options
     * @param bool  $inline
     * @param array $wrapper_options
     */
    public function elRadio( $name, $label = null, $value = 1, $checked = null, $options = array(), $inline = false, $wrapper_options = []) {}

    /**
     * @param       $name
     * @param       $label
     * @param int   $value
     * @param null  $checked
     * @param array $options
     * @param bool  $inline
     * @param array $wrapper_options
     */
    public function elCheckbox( $name, $label, $value = 1, $checked = null, $options = array(), $inline = false, $wrapper_options = []) {}

    /**
     * @param        $value
     * @param array  $options
     * @param string $class
     * @param array  $wrapper_options
     */
    public function elSubmit($value, $options = [], $class = 'primary', $wrapper_options = []){}

    /**
     * @param        $value
     * @param array  $options
     * @param string $class
     * @param array  $wrapper_options
     */
    public function elButton($value, $options = [], $class = 'primary', $wrapper_options = []){}

    /**
     * @param       $name
     * @param       $label
     * @param       $list
     * @param null  $selected
     * @param array $options
     */
    public function elSelect($name, $label, $list, $selected = null, $options = []){}

    /**
     * @param       $name
     * @param       $label
     * @param       $begin
     * @param       $end
     * @param null  $selected
     * @param array $options
     */
    public function elSelectRange($name, $label, $begin, $end, $selected = null, $options = []){}

    /**
     * @param       $name
     * @param       $label
     * @param null  $selected
     * @param array $options
     */
    public function elSelectMonth($name, $label, $selected = null, $options = []) {}

    /**
     * @param     $name
     * @param     $label
     * @param int $startYear
     */
    public function elDate($name, $label, $startYear = 1900) {}

    /**
     * @param        $messages
     * @param string $class
     */
    public function elMessage($messages, $class = 'success') {}

    /**
     * @param $size
     * @param $data
     */
    public function elCols($size, $data) {}

    /**
     * @param $html
     */
    protected function wrapFormGroup($html) {}

    /**
     * @param       $type
     * @param       $name
     * @param       $label
     * @param       $value
     * @param array $options
     */
    protected function field($type, $name, $label, $value, $options = []) {}

    /**
     * @param $type
     * @param $value
     * @param $options
     * @param $class
     */
    protected function buttons($type, $value, $options, $class) {}

    /**
     * @param $html
     *
     * @return string
     */
    protected function wrapCheckboxRadioGroup($html, $checkRadio)
    {
        $options = $this->parseOptions($this->wrapper_options, ['class' => $checkRadio]);

        return "<div " . $this->html->attributes($options) . "><label>{$html}</label></div>";
    }

    /**
     * @param $options
     * @param $default_options
     *
     * @return array
     */
    protected function parseOptions($options, $default_options)
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

    /**
     * @param $wrapper_options
     */
    protected function setWrapperOptions($wrapper_options)
    {
        $this->wrapper_options = $wrapper_options;
    }

    /**
     * @param $name
     * @param $label
     * @param $html
     *
     * @return string
     */
    protected function setLabel($name, $label)
    {
        $html = '';

        if( ! is_null($label))
            $html = $this->label($name, ucwords($label));

        return $html;
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
}