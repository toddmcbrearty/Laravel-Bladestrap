<?php namespace Toddmcbrearty\Bladestrap;

use Illuminate\Html\FormBuilder as IlluminateFormBuilder;

/**
 * Class FormBuilder
 *
 * @package AcmeHtml
 */
class BladestrapFormBuilder extends IlluminateFormBuilder {

    /**
     * @param array $options
     *
     * @return string
     */
    public function siOpen($options = [])
    {
        $default_options = [
            'role' => 'form',
        ];

        $options = array_merge($default_options, $options);
        return $this->open($options);
    }

    /**
     * @param       $name
     * @param       $label
     * @param null  $value
     * @param array $options
     *
     * @return string
     */
    public function siText($name, $label, $value = null, $options = [])
    {
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
    public function siEmail($name, $label, $value = null, $options = [])
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
    public function siPassword($name, $label, $options = [])
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
    public function siTextarea($name, $label, $value = null, $options = []) {
        return $this->field('textarea', $name, $label, $value, $options);
    }

    /**
     * @param       $value
     * @param array $options
     *
     * @return string
     */
    public function siSubmit($value, $options = []) {
        return $this->buttons('submit', $value, $options);
    }

    /**
     * @param       $value
     * @param array $options
     *
     * @return string
     */
    public function siButton($value, $options = []) {
        return $this->buttons('button', $value, $options);
    }

    /**
     * @param $errors
     *
     * @return string
     */
    public function errors($errors) {
        $html = '<div class="alert alert-danger"><ul class="list-unstyled">';

        foreach($errors as $error) {
            $html .= "<li>{$error}</li>";
        }

        $html .= "</ul></div>";

        return $html;
    }

    /**
     * @param $html
     *
     * @return string
     */
    private function wrap($html)
    {
        return "<div class=\"form-group\">{$html}</div>";
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

        $options = array_merge($default_options, $options);
        $html = $this->label($name, ucwords($label));
        if($type == 'password')
            $html .= $this->$type($name, $options);
        else
            $html .= $this->$type($name, $value, $options);

        return $this->wrap($html);
    }

    /**
     * @param null|string $value
     * @param array       $options
     *
     * @return string
     */
    private function buttons($type, $value, $options)
    {
        $default_options = [
            'class' => 'btn btn-primary',
        ];

        $options = array_merge($default_options, $options);

        return $this->wrap($this->$type($value, $options));
    }
}