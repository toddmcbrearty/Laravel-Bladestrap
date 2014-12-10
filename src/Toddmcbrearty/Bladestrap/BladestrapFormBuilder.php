<?php namespace Toddmcbrearty\Bladestrap;

use Illuminate\Html\FormBuilder as IlluminateFormBuilder;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\HTML;

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
        $this->setWrapperOptions($wrapper_options);

        return $this->field('text', $name, $label, $value, $options);
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
    public function elNumber($name, $label, $value = null, $options = [], $wrapper_options = [])
    {
        $this->setWrapperOptions($wrapper_options);

        return $this->field('number', $name, $label, $value, $options);
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
    public function elEmail($name, $label, $value = null, $options = [], $wrapper_options = [])
    {
        $this->setWrapperOptions($wrapper_options);

        return $this->field('email', $name, $label, $value, $options);
    }

    /**
     * @param       $name
     * @param       $label
     * @param array $options
     * @param array $wrapper_options
     *
     * @return string
     */
    public function elPassword($name, $label, $options = [], $wrapper_options = [])
    {
        $this->setWrapperOptions($wrapper_options);

        return $this->field('password', $name, $label, null, $options);
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
    public function elTextarea($name, $label, $value = null, $options = [], $wrapper_options = [])
    {
        $this->setWrapperOptions($wrapper_options);

        return $this->field('textarea', $name, $label, $value, $options);
    }

    /**
     * @param       $name
     * @param       $label
     * @param int   $value
     * @param null  $checked
     * @param array $options
     * @param bool  $inline
     *
     * @return string
     */
    public function elRadio($name, $label, $value = 1, $checked = null, $options = array(), $inline = false, $wrapper_options = [])
    {
        $this->setWrapperOptions($wrapper_options);

        $radio = $this->radio($name, $value, $checked, $options);

        $html = $radio . ' ' . $label;

        $class = ! $inline?'checkbox':'checkbox-inline';

        return $this->wrapCheckboxRadioGroup($html, $class);
    }


    /**
     * @param       $name
     * @param       $label
     * @param int   $value
     * @param null  $checked
     * @param array $options
     * @param bool  $inline
     *
     * @return string
     */
    public function elCheckbox($name, $label, $value = 1, $checked = null, $options = array(), $inline = false, $wrapper_options = [])
    {
        $this->setWrapperOptions($wrapper_options);

        $checkbox = $this->checkbox($name, $value, $checked, $options);

        $html = $checkbox . ' ' . $label;

        $class = ! $inline?'checkbox':'checkbox-inline';

        return $this->wrapCheckboxRadioGroup($html, $class);
    }

    /**
     * @param       $value
     * @param array $options
     *
     * @return string
     */
    public function elSubmit($value, $options = [], $class = 'primary', $wrapper_options = [])
    {
        $this->setWrapperOptions($wrapper_options);

        return $this->buttons('submit', $value, $options, $class);
    }

    /**
     * @param       $value
     * @param array $options
     *
     * @return string
     */
    public function elButton($value, $options = [], $class = 'primary', $wrapper_options = [])
    {
        $this->setWrapperOptions($wrapper_options);

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
     * @param       $name
     * @param       $label
     * @param       $begin
     * @param       $end
     * @param null  $selected
     * @param array $options
     *
     * @return string
     */
    public function elSelectRange($name, $label, $begin, $end, $selected = null, $options = [])
    {

        $default_options = [
            'class' => 'form-control',
        ];

        $options = $this->parseOptions($options, $default_options);

        $html = $this->label($name, ucwords($label));
        $html .= $this->selectRange($name, $begin, $end, $selected, $options);

        return $this->wrapFormGroup($html);

    }

    public function elSelectMonth($name, $label, $selected = null, $options = [])
    {

        $default_options = [
            'class' => 'form-control',
        ];

        $options = $this->parseOptions($options, $default_options);

        $html = $this->label($name, ucwords($label));
        $html .= $this->selectMonth($name, $selected, $options);

        return $this->wrapFormGroup($html);

    }

    public function elDate($name, $label, $startYear = 1900) {
        $ele[] = $this->elSelectMonth('month', 'Month');
        $ele[] = $this->elSelectRange('day', 'Day', 1, 31);
        $ele[] = $this->elSelectRange('day', 'Day', $startYear, date('Y'), 1990);

        $html  = $this->label($name, $label);
        $html .= $this->elCols(4, $ele);

        return $this->wrapFormGroup($html);
    }

    /**
     * @param $messages
     *
     * @return string
     */
    public function elMessage($messages, $class = 'success')
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
     * @param $size
     * @param $data
     *
     * @return string
     */
    public function elCols($size, $data) {
        $html = '<div class="row">';

        foreach($data as $d) {
            $html .= '<div class="col-md-' . $size . '">';
            $html .= $d;
            $html .= '</div>';
        }

        $html .= "</div>";

        return $html;
    }

    /**
     * @param $html
     *
     * @return string
     */
    private function wrapCheckboxRadioGroup($html, $checkRadio)
    {
        $options = $this->parseOptions($this->wrapper_options, ['class' => $checkRadio]);

        return "<div ".$this->html->attributes($options)."><label>{$html}</label></div>";
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
    private function field($type, $name, $label, $value, $options = [])
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

    /**
     * @param $wrapper_options
     */
    private function setWrapperOptions($wrapper_options)
    {
        $this->wrapper_options = $wrapper_options;
    }


}